<?php
function setActive($name, $activeClass = 'active') {
    $active = preg_match('/' . $name . '(\.*\w)*/', Route::currentRouteName());
    return $active? $activeClass : '' ;
}
