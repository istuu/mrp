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
      * hanlde action table
      *
      * @return string
      */
     public function handleAction($id, $actions){
         $button = "";
         if(in_array('edit', $actions)){
             $button = $button."<a href='".url(request()->segment(1)).'/edit/'.$id."' class='btn btn-xs btn-warning'><i class='fa fa-edit'></i>Edit</a>";
         }
         if(in_array('delete', $actions)){
             $button = $button."<a href='".url(request()->segment(1)).'/delete/'.$id."' class='btn btn-xs btn-danger'><i class='fa fa-trash'></i>Delete</a>";
         }
         return $button;
     }
}
