<?php

/**
 * convert route name to class name
 */
if (!function_exists('route_class')) {
    function route_class()
    {
        return str_replace('.', '-', Route::currentRoutename());
    }
}