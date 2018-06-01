<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Models\InfoDiklat as Model;
use App\Forms\DiklatForm;
use Carbon\Carbon;
use Table;
use Excel;
use DB;
class InfoDiklatController extends AdminController
{
    /**
     * Class model
     *
     * @doc Inherit
     */
    protected $title = 'Info Diklat';

    /**
     * Column that will be shown in listing
     *
     */
    protected $columns = ['nip', 'judul_diklat', 'tanggal_mulai', 'tanggal_selesai', 'tanggal_sertifikat', 'kode_sertifikat', 'kelompok_prestasi', 'nilai_angka', 'hasil'];

    /**
     * Initiate actions
     *
     * @doc ['create', 'edit', 'delete', 'detail', 'import', 'export']
     */
    protected $actions = ['create', 'edit', 'delete', 'import', 'export'];

    /**
     * Initiate global variable and middleware
     *
     * @return string
     */
    public function __construct()
    {
        $this->model = Model::select($this->columns);
        return $this->middleware('auth');
    }

    /**
     * Set action get index
     *
     * @return string view
     */
    public function index()
    {
        return view('pages.base.index',[
            'title' => $this->title,
            'columns' => $this->columns,
            'actions' => $this->actions,
            'tables' => $this->tableBuilder($this->columns),
        ]);
    }

    /**
     * Set action ajax datatable
     *
     * @return array json_encode
     */
     public function ajaxDatatables(){
         $model = Model::all();
         $table = Table::of($model)
                     ->addColumn('action',function($model){
                         return $this->handleAction($model->id, $this->actions);
                     })
                    ->make(true);
         return $table;
     }

     /**
      * Set action get create
      *
      * @return string view
      */
     public function create(FormBuilder $formBuilder)
     {
         $title = $this->title;
         $form  = $formBuilder->create(DiklatForm::class, [
             'method' => 'POST',
             'url' => route('info_diklats.store')
         ]);

         return view('pages.base.form', compact(['form','title']));
     }

     /**
      * Set action post store
      *
      * @return string redirect
      */
     public function store(Request $request, FormBuilder $formBuilder)
     {
         $form = $formBuilder->create(DiklatForm::class);

         if (!$form->isValid()) {
             return redirect()->back()->withErrors($form->getErrors())->withInput();
         }

         $this->model->create($request->all());
         return redirect('info_diklats')->with('success','Data Berhasil ditambahkan!');
    }

    /**
     * Set action get create
     *
     * @return string view
     */
    public function edit(FormBuilder $formBuilder,$id)
    {
        $title = $this->title;
        $form  = $formBuilder->create(DiklatForm::class, [
            'method' => 'POST',
            'model'  => Model::findOrFail($id),
            'url' => url('info_diklats/update/'.$id)
        ]);

        return view('pages.base.form', compact(['form','title']));
    }

    /**
     * Set action post update
     *
     * @return string redirect
     */
    public function update(Request $request, FormBuilder $formBuilder, $id)
    {
        $form = $formBuilder->create(DiklatForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $this->model->where('id',$id)->update($request->except(['_token']));
        return redirect('info_diklats')->with('success','Data Berhasil ditambahkan!');
   }

   /**
    * Set action get delete
    *
    * @return string redirect
    */
    public function delete($id){
        $this->model->where('id',$id)->delete();
        return redirect('info_diklats')->with('success','Data Berhasil dihapus!');
    }

    /**
     * Export Data
     * @return mixed redirect file export
     */
    public function export()
    {
        $this->path  = 'site/exports/Diklat Database.xls';
        return $this->handleExport(Model::get(), 'Diklat Database', $this->path);
    }

	/**
     * Set action get view for import
     *
     * @return string
     */
    public function import()
    {
        $title = $this->title;

        return view('pages.base.import',compact(['title']));
    }

    /**
     * Set action post import
     *
     * @return string redirect
     */
     public function postImport(Request $request){
         $file = $request->file('qqfile');
         $uuid = $request->all()['qquuid'];
         try{
             DB::beginTransaction();
             Excel::load($file, function($reader) {
                 foreach($reader->get() as $data){
					 $cek = Model::where([['nip',$data->nip],['judul_diklat',$data->judul_diklat],['tanggal_mulai',$data->tanggal_mulai],])->count();
					 if($cek > 0){
						 $model = Model::where([['nip',$data->nip],['judul_diklat',$data->judul_diklat],['tanggal_mulai',$data->tanggal_mulai],])->first();
						 $model->nip    = $data->nip;
						 $model->judul_diklat    = $data->judul_diklat;
						 $model->tanggal_mulai   = $data->tanggal_mulai;
						 $model->tanggal_selesai   = $data->tanggal_selesai;
						 $model->tanggal_sertifikat   = $data->tanggal_sertifikat;
						 $model->kode_sertifikat   = $data->kode_sertifikat;
                         $model->nilai_angka   = $data->nilai_angka;
						 $model->kelompok_prestasi   = $data->kelompok_prestasi;
						 $model->hasil   = $data->hasil;
						 $model->updated_at  = Carbon::now();
						 $model->save();
					 }else{
						 $model = new Model;
						 $model->nip    = $data->nip;
                         $model->judul_diklat    = $data->judul_diklat;
                         $model->tanggal_mulai   = $data->tanggal_mulai;
                         $model->tanggal_selesai   = $data->tanggal_selesai;
                         $model->tanggal_sertifikat   = $data->tanggal_sertifikat;
                         $model->kode_sertifikat   = $data->kode_sertifikat;
                         $model->nilai_angka   = $data->nilai_angka;
                         $model->kelompok_prestasi   = $data->kelompok_prestasi;
                         $model->hasil   = $data->hasil;
						 $model->created_at  = Carbon::now();
						 $model->save();
					 }

                 }
             });
             DB::commit();
             return array("success" => true, "uuid" => $uuid);
         }catch(\Exception $e){
             DB::rollback();
             return array("success" => false, "uuid" => $uuid, "message" => $e->getMessage());
         }
     }
}
