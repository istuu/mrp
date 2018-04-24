<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;
use Kris\LaravelFormBuilder\FormBuilder;
use App\FormasiJabatan as Model;
use App\Models\Legacy;
use App\Forms\FormationForm;
use Table;
use Excel;
use DB;

class FormationController extends AdminController
{
    /**
     * Class model
     *
     * @doc Inherit
     */
    protected $title = 'Formasi Jabatan';

    /**
     * Column that will be shown in listing
     *
     */
    protected $columns = [
        'legacy_code',
        'kode_olah',
        'personnel_area_id',
        'level',
        'formasi',
        'jabatan',
    ];

    /**
     * Initiate actions
     *
     * @doc ['create', 'edit', 'delete', 'detail', 'import', 'export']
     */
    protected $actions = ['create', 'edit', 'delete', 'import', 'export', 'filter','view'];

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
        return view('pages.formation.tree',[
            'title' => $this->title,
            'actions' => $this->actions,
            'columns' => $this->columns,
            'legacies' => Legacy::where('legacy_code',15)->get(),
            'tables' => $this->tableBuilder($this->columns),
            // 'filter' => Model::select('personnel_area')->groupBy('personnel_area')->get()
        ]);
    }

    /**
     * Set action ajax datatable
     *
     * @return array json_encode
     */
     public function ajaxDatatables(Request $request){
         // $filter = $request->personnel_area !== null ? $request->personnel_area: 'PLN';
         // $model = Model::where('personnel_area',$filter)->get();
         $model = Model::limit(500)->get();
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
         $form  = $formBuilder->create(FormationForm::class, [
             'method' => 'POST',
             'url' => route('formations.store')
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
         $form = $formBuilder->create(FormationForm::class);

         if (!$form->isValid()) {
             return redirect()->back()->withErrors($form->getErrors())->withInput();
         }

         $this->model->create($request->all());
         return redirect('formations')->with('success','Data Berhasil ditambahkan!');
    }

    /**
     * Set action get create
     *
     * @return string view
     */
    public function edit(FormBuilder $formBuilder,$id)
    {
        $title = $this->title;
        $form  = $formBuilder->create(FormationForm::class, [
            'method' => 'POST',
            'model'  => Model::findOrFail($id),
            'url' => url('formations/update/'.$id)
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
        $form = $formBuilder->create(FormationForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $this->model->where('id',$id)->update($request->except(['_token']));
        return redirect('formations')->with('success','Data Berhasil ditambahkan!');
   }

   /**
    * Set action get delete
    *
    * @return string redirect
    */
    public function delete($id){
        $this->model->where('id',$id)->delete();
        return redirect('formations')->with('success','Data Berhasil dihapus!');
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
                             $model->legacy_code = $data->kodeorganak;
                             // $model->urut       = $data->urut;
                             // $model->direktorat = $data->direktorat;
                             $model->level      = $data->lv;
                             $model->kelas_unit = $data->kls_unit;
                             $model->personnel_area_id   = $data->personnel_area;
                             $model->formasi    = $data->formasi;
                             $model->jabatan    = $data->jabatan;
                             $model->jenjang_id = $data->jenjang_main;
                             $model->jenjang_txt  = $data->jenjang_sub;
                             $model->posisi  = $data->posisi_pada_unit;
                             // $model->kode_profesi = $data->kode_profesi;
                             // $model->jenis      = $data->jenis;
                             // $model->hitung     = $data->hitung;
                             // $model->revisi     = $data->revisi;
                             $model->pagu        = 1;
                             $model->spfj        = $data->revisi;
                             $model->updated_at  = date('Y-m-d H:i:s');
                             $model->save();
                         }else{
                             $model = new Model;
                             $model->id          = \Uuid::generate();
                             $model->kode_olah   = $data->kode_olah;
                             $model->legacy_code = $data->kodeorganak;
                             // $model->urut       = $data->urut;
                             // $model->direktorat = $data->direktorat;
                             $model->level      = $data->lv;
                             $model->kelas_unit = $data->kls_unit;
                             $model->personnel_area_id   = $data->personnel_area;
                             $model->formasi    = $data->formasi;
                             $model->jabatan    = $data->jabatan;
                             $model->jenjang_id = $data->jenjang_main;
                             $model->jenjang_txt  = $data->jenjang_sub;
                             $model->posisi  = $data->posisi_pada_unit;
                             // $model->kode_profesi = $data->kode_profesi;
                             // $model->jenis      = $data->jenis;
                             // $model->hitung     = $data->hitung;
                             // $model->revisi     = $data->revisi;
                             $model->pagu       = 1;
                             $model->spfj       = $data->revisi;
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