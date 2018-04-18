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
function checkChildActive($key){
    if($key == request()->segment(1)){
        return "active";
    }
}

?>
