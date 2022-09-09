<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EditorController extends Controller
{
    public function uploadImage(Request $request){
        if($request->hasFile('upload')){
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = rand(100,999).date("Ymdhis").'.'.$extension;

            $request->file('upload')->move(public_path('front/images/ljetopis'), $fileName);

            $url = asset('front/images/ljetopis/'.$fileName);
            return response()->json(['fileName' => $fileName, 'uploaded'=> 1, 'url' => $url]);
        }
    }
}
