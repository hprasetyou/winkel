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
    protected function afterStoreData(Request $request, $data, $id = null){
        $formData = json_decode($request->getContent(), true);
        

    }
    protected function prepareData(Request $request){
        $data = $this->model::with('prices');
        $data->where('store_id','=',$request->header('Active-Store'));
        return $data;
    }
    protected function prepareShowData(Request $request, $id){
        $data = $this->model::with('images')->find($id);
        $data->mainImage = null;
        if(count($data->images)>0){
            $data->mainImage = '/uploads/images'.$data->images[0]->name;
        }
        return $data;
    }
}
