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
        'telepon',
        'email',
    ];

    /**
     * Initiate actions
     *
     * @doc ['create', 'edit', 'delete', 'detail', 'import', 'export']
     */
    protected $actions = ['edit', 'import', 'export', 'view'];

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
            $image = Model::find($id)->image;
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
                             $model->perner  = $data->perner;
                             $model->nama_pegawai  = $data->nama;
                             $model->employee_group  = $data->employee_group;
                             $model->employee_subgroup  = $data->employee_subgroup;
                             $model->ps_group  = $data->ps_group;
                             $model->jenjang_mgid  = $data->jenjang_mgid;
                             $model->jenjang_mgt  = $data->jenjang_mgt;
                             $model->jenjang_sgid  = $data->jenjang_sgid;
                             $model->jenjang_sgt  = $data->jenjang_sgt;
                             $model->formasi_jabatan_id  = $this->getFormasiJabatan($data);
                             $model->legacy_code     = $data->legacy_code;
                             $model->talent_pool_position  = $data->talent_pool_position;
                             $model->company_code  = $data->company_code;
                             $model->personnel_area_id  = $this->getPersonnelAreaDapeg($data);
                             // $model->tanggal_grade = Carbon::parse(strtotime($data->tanggal_grade));
                             // $model->tanggal_lahir = Carbon::parse(strtotime($data->birth_date));
                             // $model->tanggal_masuk = Carbon::parse(strtotime($data->tanggal_masuk));
                             // $model->tanggal_capeg = Carbon::parse(strtotime($data->tanggal_capeg));
                             // $model->tanggal_pegawai = Carbon::parse(strtotime($data->tanggal_pegawai_tetap));
                             // $model->start_date = Carbon::parse(strtotime($data->start_date));
                             // $model->end_date = Carbon::parse(strtotime($data->end_date));
                             $model->email = $data->email;
                             $model->telepon = $data->telepon;
                             $model->kali_jenjang = $data->kali_jenjang;
                             $model->lama_jabat_di_unit_terakhir = $data->lama_jabat_di_unit_terakhir;
                             // $model->lama_di_unit_induk_terakhir = $data->lama_di_unit_induk_terakhir;
                             $model->sisa_masa_kerja = $data->sisa_masa_kerja;
                             $model->masa_kerja = $data->masa_kerja;
                             $model->updated_at  = Carbon::now();
                             $model->save();
                         }else{
                             $model = new Model;
                             $model->id = \Uuid::generate();
                             $model->nip  = $data->nip;
                             $model->perner  = $data->perner;
                             $model->nama_pegawai  = $data->nama;
                             $model->employee_group  = $data->employee_group;
                             $model->employee_subgroup  = $data->employee_subgroup;
                             $model->ps_group  = $data->ps_group;
                             $model->jenjang_mgid  = $data->jenjang_mgid;
                             $model->jenjang_mgt  = $data->jenjang_mgt;
                             $model->jenjang_sgid  = $data->jenjang_sgid;
                             $model->jenjang_sgt  = $data->jenjang_sgt;
                             $model->formasi_jabatan_id  = $this->getFormasiJabatan($data);
                             $model->legacy_code     = $data->legacy_code;
                             $model->talent_pool_position  = $data->talent_pool_position;
                             $model->company_code  = $data->company_code;
                             $model->personnel_area_id  = $this->getPersonnelAreaDapeg($data,'nama');
                             // $model->tanggal_grade = Carbon::parse(strtotime(isset($data->tanggal_grade) ? $data->tanggal_grade:'9999-01-01'));
                             // $model->tanggal_lahir = Carbon::parse(strtotime(isset($data->birth_date) ? $data->birth_date:'9999-01-01'));
                             // $model->tanggal_masuk = Carbon::parse(strtotime(isset($data->tanggal_masuk) ? $data->tanggal_masuk:'9999-01-01'));
                             // $model->tanggal_capeg = Carbon::parse(strtotime(isset($data->tanggal_capeg) ? $data->tanggal_capeg:'9999-01-01'));
                             // $model->tanggal_pegawai = Carbon::parse(strtotime(isset($data->tanggal_pegawai_tetap) ? $data->tanggal_pegawai_tetap:'9999-01-01'));
                             // $model->start_date = Carbon::parse(strtotime(isset($data->start_date) ? $data->start_date:'9999-01-01'));
                             // $model->end_date = Carbon::parse(strtotime(isset($data->end_date) ? $data->end_date:'9999-01-01'));
                             $model->email = $data->email;
                             $model->telepon = $data->telepon;
                             $model->kali_jenjang = $data->kali_jenjang;
                             $model->lama_jabat_di_unit_terakhir = $data->lama_jabat_di_unit_terakhir;
                             // $model->lama_di_unit_induk_terakhir = $data->lama_di_unit_induk_terakhir;
                             $model->sisa_masa_kerja = $data->sisa_masa_kerja;
                             $model->masa_kerja = $data->masa_kerja;
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
