<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Models\Legacy as Model;
use App\Forms\LegacyForm;
use Table;
use Excel;
use DB;

class LegacyController extends AdminController
{
    /**
     * Class model
     *
     * @doc Inherit
     */
    protected $title = 'Legacy Codes';

    /**
     * Column that will be shown in listing
     *
     */
    protected $columns = ['legacy_code_induk', 'legacy_code','nama_panjang' ,'nama_singkat'];

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
         $form  = $formBuilder->create(LegacyForm::class, [
             'method' => 'POST',
             'url' => route('legacies.store')
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
         $form = $formBuilder->create(LegacyForm::class);

         if (!$form->isValid()) {
             return redirect()->back()->withErrors($form->getErrors())->withInput();
         }

         $this->model->create($request->all());
         return redirect('legacies')->with('success','Data Berhasil ditambahkan!');
    }

    /**
     * Set action get create
     *
     * @return string view
     */
    public function edit(FormBuilder $formBuilder,$id)
    {
        $title = $this->title;
        $form  = $formBuilder->create(LegacyForm::class, [
            'method' => 'POST',
            'model'  => Model::findOrFail($id),
            'url' => url('legacies/update/'.$id)
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
        $form = $formBuilder->create(LegacyForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $this->model->where('id',$id)->update($request->except(['_token']));
        return redirect('legacies')->with('success','Data Berhasil ditambahkan!');
   }

   /**
    * Set action get delete
    *
    * @return string redirect
    */
    public function delete($id){
        $this->model->where('id',$id)->delete();
        return redirect('legacies')->with('success','Data Berhasil dihapus!');
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
                     if($data->kodeorganak !== null){
                         if($data->oc == 'C'){
                             $cek = Model::where('legacy_code',$data->kodeorganak)->count();
                             if($cek > 0){
                                 $model = Model::where('legacy_code',$data->kodeorganak)->first();
                                 $model->legacy_code_induk    = $data->kodeorginduk;
                                 $model->legacy_code    = $data->kodeorganak;
                                 $model->lookup      = $data->namabaru !== '' ? $data->namabaru:$data->namapanjang;
                                 $model->nama_panjang= $data->namapanjang;
                                 $model->nama_singkat   = $data->namabaru;
                                 $model->updated_at  = date('Y-m-d H:i:s');
                                 $model->save();
                             }else{
                                 $model = new Model;
                                 $model->legacy_code_induk    = $data->kodeorginduk;
                                 $model->legacy_code    = $data->kodeorganak;
                                 $model->lookup      = $data->namabaru !== '' ? $data->namabaru:$data->namapanjang;
                                 $model->nama_panjang= $data->namapanjang;
                                 $model->nama_singkat   = $data->namabaru;
                                 $model->created_at  = date('Y-m-d H:i:s');
                                 $model->save();
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
