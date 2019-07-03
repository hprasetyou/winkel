<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;

class StoreController extends ResourceController
{
    public function prepareData()
    {
        $user = request()->user();
        $userStores = User::find($user->id)->stores();
        return $userStores;
    }
}
