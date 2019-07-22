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
}
