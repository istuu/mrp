<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Pegawai as Model;
use App\FormasiJabatan as Formasi;
use App\Forms\PegawaiForm;
use Table;
use Excel;
use DB;

class PegawaiController extends AdminController
{
    /**
     * Class model
     *
     * @doc Inherit
     */
    protected $title = 'Data Pegawai';

    /**
     * Column that will be shown in listing
     *
     */
    protected $columns = [
        'image',
        'perner',
        'nama_pegawai',
        'nip',
        'no_hp',
        'email',
    ];

    /**
     * Initiate actions
     *
     * @doc ['create', 'edit', 'delete', 'detail', 'import', 'export']
     */
    protected $actions = ['create', 'edit', 'delete', 'import', 'export', 'view'];

    /**
     * Initiate global variable and middleware
     *
     * @return string
     */
    public function __construct()
    {
        $this->model = Model::select($this->columns);
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
            'tables' => $this->tableBuilder($this->columns)
        ]);
    }

    /**
     * Set action ajax datatable
     *
     * @return array json_encode
     */
     public function ajaxDatatables(Request $request){
         $model = Model::get();
         $table = Table::of($model)
                     ->addColumn('image',function($model){
                         return $this->handleViewImage($model->image);
                     })
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
         $form  = $formBuilder->create(PegawaiForm::class, [
             'method' => 'POST',
             'url' => route('pegawais.store')
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
         $form = $formBuilder->create(PegawaiForm::class);

         if (!$form->isValid()) {
             return redirect()->back()->withErrors($form->getErrors())->withInput();
         }

         $this->model->create($request->all());
         return redirect('pegawais')->with('success','Data Berhasil ditambahkan!');
    }

    /**
     * Set action get create
     *
     * @return string view
     */
    public function edit(FormBuilder $formBuilder,$id)
    {
        $title = $this->title;
        $form  = $formBuilder->create(PegawaiForm::class, [
            'method' => 'POST',
            'model'  => Model::findOrFail($id),
            'url' => url('pegawais/update/'.$id)
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
        $form = $formBuilder->create(PegawaiForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $this->model->where('id',$id)->update($request->except(['_token']));
        return redirect('pegawais')->with('success','Data Berhasil ditambahkan!');
   }

   /**
    * Set action get delete
    *
    * @return string redirect
    */
    public function delete($id){
        $this->model->where('id',$id)->delete();
        return redirect('Pegawais')->with('success','Data Berhasil dihapus!');
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
                     if($data->kode_olah !== null){
                         //Legacy Code aslinya ga boleh sama
                         $cek = Model::where('kode_olah',$data->kode_olah)->count();
                         if($cek > 0){
                             $model = Model::where('kode_olah',$data->kode_olah)->first();
                             $model->kode_olah  = $data->kode_olah;
                             $model->legacy_code   = $data->kodeorganak;
                             $model->urut       = $data->urut;
                             $model->direktorat = $data->direktorat;
                             $model->level      = $data->lvl;
                             $model->kelas_unit = $data->kls_unit;
                             $model->personnel_area   = $data->personnel_area;
                             $model->level      = $data->lv;
                             $model->formasi    = $data->formasi;
                             $model->jabatan    = $data->jabatan;
                             $model->jenjang_main = $data->jenjang_main;
                             $model->jenjang_sub  = $data->jenjang_sub;
                             $model->posisi_unit  = $data->posisi_pada_unit;
                             $model->kode_profesi = $data->kode_profesi;
                             $model->jenis      = $data->jenis;
                             $model->hitung     = $data->hitung;
                             $model->revisi     = $data->revisi;
                             $model->updated_at  = date('Y-m-d H:i:s');
                             $model->save();
                         }else{
                             $model = new Model;
                             $model->kode_olah  = $data->kode_olah;
                             $model->legacy_code   = $data->kodeorganak;
                             $model->urut       = $data->urut;
                             $model->direktorat = $data->direktorat;
                             $model->level      = $data->lvl;
                             $model->kelas_unit = $data->kls_unit;
                             $model->personnel_area   = $data->personnel_area;
                             $model->level      = $data->lv;
                             $model->formasi    = $data->formasi;
                             $model->jabatan    = $data->jabatan;
                             $model->jenjang_main = $data->jenjang_main;
                             $model->jenjang_sub  = $data->jenjang_sub;
                             $model->posisi_unit  = $data->posisi_pada_unit;
                             $model->kode_profesi = $data->kode_profesi;
                             $model->jenis      = $data->jenis;
                             $model->hitung     = $data->hitung;
                             $model->revisi     = $data->revisi;
                             $model->created_at = date('Y-m-d H:i:s');
                             $model->save();
                         }
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
