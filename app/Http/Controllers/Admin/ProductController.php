<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProductImage;

class ProductController extends ResourceController
{

    protected $with = ['prices','parentProduct'];
    /**
     * Prepare data before submit
     * 
     * @param  \Illuminate\Http\Request  $request
     */
    protected function prepareStoreData(Request $request, int $id = null){
        $data = parent::prepareStoreData($request, $id);
        $user = request()->user();
        $data->company_id = $user->company_id;
        return $data;
    }


    protected function save(Request $request, $id = null){
        $data = parent::save($request, $id);
        $formData = json_decode($request->getContent(), false);
        if($formData->mainImage){
            $image = ProductImage::where('name','=',$formData->mainImage)->first();
            if(!$image){
                $image = new ProductImage();
                $image->product_id = $data->id;
                $image->name = $formData->mainImage;
                $image->tag = 'main';
                $image->save();
            }
        }
        return $data;
    }


    protected function prepareData(Request $request){
        $data = parent::prepareData($request);
        $user = request()->user();
        $data->where('company_id','=', $user->company_id);
        return $data;
    }

    
    protected function prepareShowData(Request $request, $id){
        $data = $this->model::with(['images','prices','parentProduct'])->find($id);
        $data->mainImage = null;
        if(count($data->images)>0){
            $data->mainImage = $data->images[0]->name;
        }
        return $data;
    }
}
