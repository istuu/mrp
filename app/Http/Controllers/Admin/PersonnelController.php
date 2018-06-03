<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;
use Kris\LaravelFormBuilder\FormBuilder;
use App\PersonnelArea as Model;
use App\Direktorat;
use App\Forms\PersonnelForm;
use Carbon\Carbon;
use Table;
use Excel;
use DB;

class PersonnelController extends AdminController
{
    /**
     * Class model
     *
     * @doc Inherit
     */
    protected $title = 'Personnel Area';

    /**
     * Column that will be shown in listing
     *
     */
    protected $columns = ['personnel_area', 'sub_area', 'nama_panjang', 'nama_pendek'];

    /**
     * Initiate actions
     *
     * @doc ['create', 'edit', 'delete', 'detail', 'import', 'export']
     */
    protected $actions = ['create', 'edit', 'delete', 'import'];

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
         $model = Model::where('user_role','<>',0)->get();
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
         $form  = $formBuilder->create(PersonnelForm::class, [
             'method' => 'POST',
             'url' => route('personnels.store')
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
         $form = $formBuilder->create(PersonnelForm::class);

         if (!$form->isValid()) {
             return redirect()->back()->withErrors($form->getErrors())->withInput();
         }

         $this->model->create($request->all());
         return redirect('personnels')->with('success','Data Berhasil ditambahkan!');
    }

    /**
     * Set action get create
     *
     * @return string view
     */
    public function edit(FormBuilder $formBuilder,$id)
    {
        $title = $this->title;
        $form  = $formBuilder->create(PersonnelForm::class, [
            'method' => 'POST',
            'model'  => Model::findOrFail($id),
            'url' => url('personnels/update/'.$id)
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
        $form = $formBuilder->create(PersonnelForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $this->model->where('id',$id)->update($request->except(['_token']));
        return redirect('personnels')->with('success','Data Berhasil ditambahkan!');
   }

   /**
    * Set action get delete
    *
    * @return string redirect
    */
    public function delete($id){
        $this->model->where('id',$id)->delete();
        return redirect('personnels')->with('success','Data Berhasil dihapus!');
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
                     if($data->singkatan_pa !== null){
                         $cek = Model::where([['personnel_area',$data->personnel_area],['sub_area',$data->personnel_subarea],])->count();
                         if($cek > 0){
                             $user = Model::where([['personnel_area',$data->personnel_area],['sub_area',$data->personnel_subarea],])->first();
                             // $user->personnel_area = $data->personnel_area;
                             // $user->sub_area = $data->personnel_subarea;
                             $user->personnel_area_dapeg = $data->personnel_area_dapeg;
                             $user->sub_area_dapeg = $data->personnel_subarea_dapeg;
                             $user->nama_panjang = $data->nama_panjang;
                             $user->nama_pendek = $data->singkatan_pa;
                             $user->username = strtolower($data->singkatan_pa);
                             $user->password = bcrypt(strtolower($data->singkatan_pa));
                             $user->user_role = 1;
                             $user->save();
                         }else{
                             if(Model::where('username',strtolower($data->singkatan_pa))->count() < 1){
                                 $user = new Model;
                                 $user->id = \Uuid::generate();
                                 $user->personnel_area = $data->personnel_area;
                                 $user->sub_area = $data->personnel_subarea;
                                 $user->personnel_area_dapeg = $data->personnel_area_dapeg;
                                 $user->sub_area_dapeg = $data->personnel_subarea_dapeg;
                                 $user->nama_panjang = $data->nama_panjang;
                                 $user->nama_pendek = $data->singkatan_pa;
                                 $user->username = strtolower($data->singkatan_pa);
                                 $user->password = bcrypt(strtolower($data->singkatan_pa));
                                 $user->direktorat_id = Direktorat::first()->id;
                                 $user->user_role = 1;
                                 $user->save();
                             }
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
