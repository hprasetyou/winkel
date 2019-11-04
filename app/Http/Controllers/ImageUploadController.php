<?php

namespace App\Http\Controllers;

use Storage;
use Illuminate\Http\Request;

class ImageUploadController extends Controller
{
    public function upload(Request $request){
        $data = json_decode($request->getContent());
        $image = $data->image;
        $imageInfo = explode(";base64,", $image);
        $imgExt = str_replace('data:image/', '', $imageInfo[0]);      
        $image = str_replace(' ', '+', $imageInfo[1]);
        $imageName = "img-".time().".".$imgExt;
        $imagePath = 'uploads/images/'.$imageName;
        $ifp = fopen( $imagePath, 'wb' ); 
        fwrite($ifp, base64_decode($image));
        fclose($ifp);
        return response()->json([
            'img' => $imagePath
        ]);
    }
}
