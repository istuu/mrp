<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\FormasiJabatan;
use App\PersonnelArea;
use App\Direktorat;
class AdminController extends Controller
{
    /**
     * hanlde table builder
     *
     * @return array json_encode
     */
     public function tableBuilder($columns){
         foreach($columns as $column){
             $data[] = [
                 'data' => $column
             ];
         }
         $data[] = ["data" => "action", "orderable"=> false];
         return json_encode($data);
     }

     /**
      * handle action table
      *
      * @return string
      */
     public function handleAction($id, $actions){
         $button = "";
         if(in_array('edit', $actions)){
             $button = $button."<a href='".url(request()->segment(1)).'/edit/'.$id."' class='btn btn-xs btn-warning btn-ico fa fa-edit'></a>";
         }
         if(in_array('view', $actions)){
             $button = $button."<a href='".url(request()->segment(1)).'/view/'.$id."' class='btn btn-xs btn-info btn-ico fa fa-eye'></a>";
         }
         if(in_array('delete', $actions)){
             $button = $button."<a href='".url(request()->segment(1)).'/delete/'.$id."' class='btn btn-xs btn-danger btn-ico fa fa-trash'></a>";
         }
         return $button;
     }

     /**
      * hanlde View Image Table
      * @param  string $image model->image
      * @return string  html img
      */
     public function handleViewImage($image){
         if($image == '' || $image == null){
             return \Html::image(asset('assets/images/noavatar.jpg'),'Picture',array('height'=>100));
         }else{
             return \Html::image(asset($image),'Picture',array('height'=>100));
         }
     }

     /**
      * handle upload file image
      * @param  mixed $request
      * @param  string $name
      * @return string file name & directory
      */
     public function handleUpload($request,$name)
     {
         $input = $request->all();
         $rules = array(
             $name => 'image|max:3000',
         );

         $validation = Validator::make($input, $rules);

         if ($validation->fails()) {
             return false;
         }

         $destinationPath = 'site/uploads/images';
         $extension       = $request->file($name)->getClientOriginalExtension();
         $originalName    = $request->file($name)->getClientOriginalName();
         $fileName        = $originalName."-".str_random(5).'.' . $extension;
         $upload          = $request->file($name)->move($destinationPath, $fileName);
         return $destinationPath.'/'.$fileName;
     }

     /**
      * hanlde export data
      * @param  array $model    [description]
      * @param  string $filename [description]
      * @param  string $path     [description]
      * @return mixed           [description]
      */
     public function handleExport($model, $filename, $path)
     {
         try{
             foreach ($model as $key => $value) {
                 foreach($value->toArray() as $key2 => $value2){
                     $key2 = ucwords(str_replace("_"," ",$key2));
                     $data[$key][$key2] = $value2;
                 }
             }

             @unlink(public_path($path));

             \Excel::create($filename, function($excel)  use($data) {

                 $excel->sheet('Sheet 1', function($sheet) use($data)  {

                     $sheet->fromArray($data);

                 });
             })->store('xls',public_path('site/exports'));

             return redirect($path);

         }catch(\Exception $e){
             return redirect()->back()->with('error',$e->getMessage());
         }
     }

     /**
      * Get Personnel Area ID
      * @param  array $data [description]
      * @return int        [description]
      */
     public function getPersonnelArea($data,$column)
     {
         if(PersonnelArea::where($column,$data->personnel_area)->count() < 1){
             $model = new PersonnelArea;
             $model->id = \Uuid::generate();
             $model->personnel_area = $data->personnel_area;
             $model->sub_area = $data->personnel_subarea;
             // $model->nama_panjang = $data->personnel_area;
             $model->nama_pendek = '';
             $model->username = strtolower($data->personnel_area);
             $model->password = bcrypt($data->personnel_area);
             $model->direktorat_id = isset($data->direktorat) ? $this->getDirektorat($data):'0';
             $model->user_role = 1;
             $model->save();
         }else{
             $model = PersonnelArea::where($column,$data->personnel_area)->first();
             $model->personnel_area = $data->personnel_area;
             $model->sub_area = $data->personnel_subarea;
             // $model->nama_panjang = $data->personnel_area;
             $model->nama_pendek = '';
             $model->username = strtolower($data->personnel_area);
             $model->password = bcrypt($data->personnel_area);
             $model->direktorat_id = isset($data->direktorat) ? $this->getDirektorat($data):'0';
             $model->user_role = 1;
             $model->save();
         }
         return $model->id;
     }


     /**
      * Get Direktorat ID
      * @param  array $model [description]
      * @return int        [description]
      */
     public function getDirektorat($data)
     {
         if(Direktorat::where('nama_pendek',$data->direktorat)->count() < 1){
             $dir = new Direktorat;
             $dir->id = \Uuid::generate();
             $dir->nama = $data->direktorat;
             $dir->nama_pendek = $data->direktorat;
             $dir->save();
         }else{
             $dir = Direktorat::where('nama_pendek',$data->direktorat)->first();
             $dir->nama = $data->direktorat;
             $dir->nama_pendek = $data->direktorat;
             $dir->save();
         }
         return $dir->id;
     }

     /**
      * Get Formasi Jabatan
      * @param  array $data [description]
      * @return int        [description]
      */
     public function getFormasiJabatan($data)
     {
         if(FormasiJabatan::where([['legacy_code',$data->legacy_code],['jenjang_sub',$data->jenjang_sgt],])->count() < 1){
             return "0";
         }else{
             $model = FormasiJabatan::where([['legacy_code',$data->legacy_code],['jenjang_sub',$data->jenjang_sgt],])->first();
             return $model->id;
         }
     }

     /**
      * Get Personnel Area untuk data pegawai
      * @param  array $data [description]
      * @return int        [description]
      */
     public function getPersonnelAreaDapeg($data)
     {
         if(PersonnelArea::where([['personnel_area_dapeg',$data->personnel_area],['sub_area_dapeg',$data->personnel_subarea],])->count() < 1){
             return "0";
         }else{
             $model = PersonnelArea::where([['personnel_area_dapeg',$data->personnel_area],['sub_area_dapeg',$data->personnel_subarea],])->first();
             return $model->id;
         }
     }
     /**
      * get formasi jabatan in karir 1
      * @return array formasi jabatan
      */
     public function formasiJabatanK1()
     {
         $model = FormasiJabatan::select('id')
                             ->where(function($query){
                                    $query->where('jenjang_sub', '=', 'Manajemen Atas');
                                    $query->orWhere('level', '=', 'UI');
                                    $query->orWhere('level', '=', 'UP');
                                    $query->orWhere('level', '=', 'KP');
                             })
                             ->where(function($query){
                                    $query->where('jenjang_sub', '=', 'Manajemen Menengah');
                                    $query->orWhere('level', '=', 'UI');
                                    $query->orWhere('level', '=', 'UP');
                                    $query->orWhere('level', '=', 'KP');
                             })
                             ->where(function($query){
                                    $query->where('jenjang_sub', '=', 'Manajemen Dasar');
                                    $query->orWhere('level', '=', 'UP');
                             })
                             ->where(function($query){
                                    $query->where('jenjang_sub', '=', 'Fungsional I');
                                    $query->orWhere('level', '=', 'UI');
                                    $query->orWhere('level', '=', 'UP');
                                    $query->orWhere('level', '=', 'KP');
                             })
                             ->where(function($query){
                                    $query->where('jenjang_sub', '=', 'Fungsional II');
                                    $query->orWhere('level', '=', 'UI');
                                    $query->orWhere('level', '=', 'UP');
                                    $query->orWhere('level', '=', 'KP');
                             })
                             ->get();
         return $model;
     }
}
