<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Pegawai as Model;
use App\FormasiJabatan as Formasi;
use App\Forms\PegawaiForm;
use Carbon\Carbon;
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
        $this->query = $model = Model::select('image','legacy_code',
                               'perner','nip','nama_pegawai','no_hp','email','kota_asal',
                               'status_domisili','employee_subgroup','ps_group','talent_pool_position',
                               'tanggal_grade','tanggal_lahir','tanggal_masuk','tanggal_capeg',
                               'tanggal_pegawai','start_date','end_date','kali_jenjang');
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
            'tables' => $this->tableBuilder($this->columns)
        ]);
    }

    /**
     * Set action ajax datatable
     *
     * @return array json_encode
     */
     public function ajaxDatatables(Request $request){
         $model = Model::where('perner','<>','000');
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

         $inputs = $request->all();
         $inputs['image'] = $this->handleUpload($request,'image');

         $this->model->create($inputs);
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

        $inputs = $request->except(['_token']);
        if(isset($request->image)){
            $inputs['image'] = $this->handleUpload($request,'image');
        }else{
            $image = Pegawai::find($id)->image;
            $inputs['image'] = $image;
        }

        $this->model->where('id',$id)->update($inputs);
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
                     if($data->nip !== null){
                         //Legacy Code aslinya ga boleh sama
                         $cek = Model::where('nip',$data->nip)->count();
                         if($cek > 0){
                             $model = Model::where('nip',$data->nip)->first();
                             $model->legacy_code     = $data->legacy_code;
                             $model->perner  = $data->perner;
                             $model->nama_pegawai  = $data->nama;
                             $model->employee_subgroup  = $data->employee_subgroup;
                             $model->ps_group  = $data->ps_group;
                             $model->talent_pool_position  = $data->talent_pool_position;
                             $model->tanggal_grade = $data->tanggal_grade;
                             $model->tanggal_lahir = $data->tanggal_lahir;
                             $model->tanggal_masuk = $data->tanggal_masuk;
                             $model->tanggal_capeg = $data->tanggal_capeg;
                             $model->tanggal_pegawai = $data->tanggal_pegawai;
                             $model->start_date = $data->start_date;
                             $model->end_date = $data->end_date;
                             $model->updated_at  = Carbon::now();
                             $model->save();
                         }else{
                             $model = new Model;
                             $model->id      = \Uuid::generate();
                             $model->legacy_code     = $data->legacy_code;
                             $model->nip     = $data->nip;
                             $model->perner  = $data->perner;
                             $model->nama_pegawai  = $data->nama;
                             $model->employee_subgroup  = $data->employee_subgroup;
                             $model->ps_group  = $data->ps_group;
                             $model->talent_pool_position  = $data->talent_pool_position;
                             $model->tanggal_grade = $data->tanggal_grade;
                             $model->tanggal_lahir = $data->tanggal_lahir;
                             $model->tanggal_masuk = $data->tanggal_masuk;
                             $model->tanggal_capeg = $data->tanggal_capeg;
                             $model->tanggal_pegawai = $data->tanggal_pegawai;
                             $model->start_date = $data->start_date;
                             $model->end_date = $data->end_date;
                             $model->created_at = Carbon::now();
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

     /**
      * action view
      * @param  string $id uuid
      * @return string html
      */
     public function view($id)
     {
         $model = $this->query->find($id);
         return view('pages.base.view',[
             'title' => $this->title,
             'model' => $model->toArray()
         ]);
     }

     /**
      * Export Data
      * @return mixed redirect file export
      */
     public function export()
     {
         $this->path  = 'site/exports/Pegawai Database.xls';
         return $this->handleExport($this->query->get(), 'Pegawai Database', $this->path);
     }

}
