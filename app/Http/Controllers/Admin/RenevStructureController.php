<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;
use Kris\LaravelFormBuilder\FormBuilder;
use App\FormasiJabatan as Model;
use App\Direktorat;
use App\Models\Legacy;
use App\Forms\FormationForm;
use Carbon\Carbon;
use Table;
use Excel;
use DB;

class RenevStructureController extends AdminController
{
    /**
     * Class model
     *
     * @doc Inherit
     */
    protected $title = 'Renev Struktur';

    /**
     * Column that will be shown in listing
     *
     */
    protected $columns = [
        'legacy_code',
        // 'kode_olah',
        // 'personnel_area_id',
        'level',
        'formasi',
        'jabatan',
    ];

    /**
     * Initiate actions
     *
     * @doc ['create', 'edit', 'delete', 'detail', 'import', 'export']
     */
    protected $actions = ['create', 'edit', 'delete', 'import','view'];

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
        return view('pages.organisation.renev',[
            'title' => $this->title,
            // 'actions' => $this->actions,
            // 'columns' => $this->columns,
            'legacies' => Legacy::where('legacy_code','15')->get(),
            // 'tables' => $this->tableBuilder($this->columns),
            // 'filter' => Model::select('personnel_area')->groupBy('personnel_area')->get()
        ]);
    }

    /**
     * Set action ajax datatable
     *
     * @return array json_encode
     */
     public function ajaxDatatables(Request $request){
         $legacy_code = isset($request->legacy_code) ? $request->legacy_code:'15';
         // $filter = $request->personnel_area !== null ? $request->personnel_area: 'PLN';
         // $model = Model::where('personnel_area',$filter)->get();
         $model = Model::where('legacy_code',$legacy_code)->get();
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
                         $cek = Model::where('kode_olah',$data->kode_olah)->count();
                         if($cek > 0){
                             $model = Model::where('kode_olah',$data->kode_olah)->first();
                             $model->kode_olah  = $data->kode_olah;
                             $model->direktorat_id   = $this->getDirektorat($data);
                             $model->personnel_area_id   = $this->getPersonnelArea($data,'personnel_area');
                             $model->level      = $data->lv;
                             $model->kode_induk = $data->kode_induk;
                             $model->kode_formasi_jabatan = $data->kode_formasi_jabatan;
                             $model->formasi    = $data->formasi;
                             $model->jabatan    = $data->jabatan;
                             $model->pagu       = 1;
                             $model->hasil = $data->hasil;
                             $model->kelas_unit = $data->kls_unit;
                             $model->hgl = $data->hgl;
                             $model->jenjang_main = $data->jenjang_main;
                             $model->jenjang_sub  = $data->jenjang_sub;
                             $model->posisi_pada_unit  = $data->posisi_pada_unit;
                             $model->profesi  = $data->profesi;
                             $model->kode_profesi  = $data->kode_profesi;
                             $model->legacy_code = $data->kodeorganak;
                             $model->spfj        = $data->spfj;
                             $model->accountable = $data->accountable;
                             $model->updated_at  = Carbon::now();
                             $model->save();
                         }else{
                             $model = new Model;
                             $model->id          = \Uuid::generate();
                             $model->kode_olah   = $data->kode_olah;
                             $model->direktorat_id   = $this->getDirektorat($data);
                             $model->personnel_area_id   = $this->getPersonnelArea($data,'personnel_area');
                             $model->level      = $data->lv;
                             $model->kode_induk      = $data->kode_induk;
                             $model->kode_formasi_jabatan = $data->kode_formasi_jabatan;
                             $model->formasi    = $data->formasi;
                             $model->jabatan    = $data->jabatan;
                             $model->pagu       = 1;
                             $model->hasil = $data->hasil;
                             $model->kelas_unit = $data->kls_unit;
                             $model->hgl = $data->hgl;
                             $model->jenjang_main = $data->jenjang_main;
                             $model->jenjang_sub  = $data->jenjang_sub;
                             $model->posisi_pada_unit  = $data->posisi_pada_unit;
                             $model->profesi  = $data->profesi;
                             $model->kode_profesi  = $data->kode_profesi;
                             $model->legacy_code = $data->kodeorganak;
                             $model->spfj        = $data->spfj;
                             $model->accountable = $data->accountable;
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
      * Handle Modal Ajax Create
      * @return string html
      */
     public function ajaxCreate(Request $request){
         return view('includes.superadmin.create-modal',['legacy' => $request->legacy_code]);
     }

     /**
      * Handle Modal Ajax Edit
      * @return string html
      */
     public function ajaxEdit(Request $request){
         $legacy = Legacy::find($request->id);
         return view('includes.superadmin.edit-modal',['legacy' => $legacy]);
     }

     /**
      * Set action post store legacy
      *
      * @return string redirect
      */
     public function legacyStore(Request $request)
     {
         Legacy::create($request->all());
         return redirect('formations')->with('success','Legacy Code Berhasil ditambahkan!');
    }

    /**
     * Set action post updateLegacy
     *
     * @return string redirect
     */
    public function legacyUpdate(Request $request, $id)
    {
        Legacy::where('id',$id)->update($request->except(['_token']));
        return redirect('formations')->with('success','Legacy Code Berhasil diubah!');
   }

   /**
    * action view
    * @param  string $id uuid
    * @return string html
    */
   public function view($id)
   {
       $model = Model::select('legacy_code','level','posisi_pada_unit','kelas_unit','hgl','formasi','jenjang_main',
                              'jenjang_sub','pagu','spfj')
                  ->find($id);
       return view('pages.base.view',[
           'title' => $this->title,
           'model' => $model->toArray()
       ]);
   }
}
