<?php

$slug = request()->segment(1);
$controller = "Admin\\".str_replace(' ','',ucwords(str_replace('_',' ',str_singular($slug))))."Controller";
Route::get($slug.'/helper/index',$controller.'@index');
Route::post($slug.'/helper/datatables/ajax', $controller.'@ajaxDatatables');
Route::get($slug.'/helper/create', ['uses' => $controller.'@create','as' => 'roles.create']);
Route::post($slug.'/helper/store', ['uses' => $controller.'@store','as' => 'roles.store']);
Route::get($slug.'/helper/edit/{id}', ['uses' => $controller.'@edit','as' => 'roles.edit']);
Route::post($slug.'/helper/update', ['uses' => $controller.'@update','as' => 'roles.update']);
Route::post($slug.'/helper/delete', ['uses' => $controller.'@delete','as' => 'roles.delete']);

?>
