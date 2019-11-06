<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SaleController extends ResourceController
{
    //
    protected function prepareShowData(Request $request, $id){
        $data = $this->model::with('sales_items.product');
        return $data->find($id);
    }
    /**
     * Prepare data before submit
     * 
     * @param  \Illuminate\Http\Request  $request
     */
    protected function prepareStoreData(Request $request, int $id = null){
        $data = parent::prepareStoreData($request, $id);
        $user = request()->user();
        $data->user_id = $user->id;
        $data->company_id = $user->company_id;
        return $data;
    }
}
