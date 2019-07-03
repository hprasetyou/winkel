<?php

namespace App\Http\Controllers\Admin;

use App\User;

class StoreController extends ResourceController
{
    protected function prepareData()
    {
        $user = request()->user();
        $userStores = User::find($user->id)->stores();
        return $userStores;
    }
}
