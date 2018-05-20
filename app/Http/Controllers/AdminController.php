<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

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
}
