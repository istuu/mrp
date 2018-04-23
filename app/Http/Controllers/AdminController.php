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
         if($image !== ''){
             return "<img src='".url($image)."' width='100' />";
         }else{
             return \Html::image(url('assets/images/noavatar.jpg'),'Picture',array('height'=>100));
         }
     }
}
