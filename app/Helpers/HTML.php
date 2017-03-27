<?php
function setActive($name, $activeClass = 'active') {
    return (Route::currentRouteNamed($name)) ? $activeClass : '' ;
}