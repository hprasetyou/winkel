<?php

namespace App\Http\Controllers\Admin;

class UserController extends ResourceController
{
    function __construct(){
        $this->model = '\App\User';
    }
}
