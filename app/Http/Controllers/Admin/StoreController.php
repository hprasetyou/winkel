<?php

namespace App\Http\Controllers\Admin;

class StoreController extends ResourceController
{
    function __construct(){
        $this->model = '\App\Store';
    }
}
