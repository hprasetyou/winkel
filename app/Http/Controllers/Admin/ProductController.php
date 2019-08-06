<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends ResourceController
{
    /**
     * Prepare data before submit
     * 
     * @param  \Illuminate\Http\Request  $request
     */
    protected function prepareStoreData(Request $request, int $id = null){
        $data = parent::prepareStoreData($request, $id);
        $data->store_id = $request->header('Active-Store');
        return $data;
    }
    protected function prepareData(Request $request){
        $data = $this->model::with('prices');
        $data->where('store_id','=',$request->header('Active-Store'));
        return $data;
    }
}
