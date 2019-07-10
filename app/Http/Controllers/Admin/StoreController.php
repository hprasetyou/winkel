<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;

class StoreController extends ResourceController
{
    protected function prepareData(Request $request)
    {
        $user = request()->user();
        $userStores = User::find($user->id)->stores();
        return $userStores;
    }
}
