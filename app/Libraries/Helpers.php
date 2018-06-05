<?php

/**
 * Check parent menu is active or not
 * @param  array $array array_menu
 * @return string
 */
function checkParentActive($array)
{
    $slug = request()->segment(1);
    if(in_array($slug,$array)){
        return "active";
    }
}

/**
 * Check child menu is active or not
 * @param  string $key
 * @return string
 */
function checkChildActive($key)
{
    if($key == request()->segment(1)){
        return "active";
    }
}

/**
 * Get Legacy Child From Legacy Code Parent
 * @param  string $legacy_parent
 * @return array  model legacy child
 */
function getLegacyChild($legacy_parent)
{
    $model = DB::table('legacies')->where('legacy_code_induk',$legacy_parent)->get();
    return $model;
}

/**
 * get action create and edit
 * @param  array $legacy model Legacy
 * @return string html
 */
function actionTree($legacy)
{
    return "<span onclick='createLegacy(".$legacy->legacy_code.")' class='pointer glyphicon glyphicon-plus-sign'></span>
            <span onclick='editLegacy(".$legacy->id.")' class='pointer glyphicon glyphicon-edit'></span>
            ";
}

/**
 * action get Formasi Jabatan
 * @param  int $id [description]
 * @return array     [description]
 */
function getFormasiJabatan($id)
{
    // return App\FormasiJabatan::where('id',$id)->count();
    if(App\FormasiJabatan::where('id',$id)->count()){
        $model = \App\FormasiJabatan::find($id);
        return $model;
    }else{
        return null;
    }
}

?>
