<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Session;
use Image;
use App\Models\Parohije;

class ParohijeController extends Controller
{
    public function parohije(){
        Session::put('page', 'parohije');
        $css = "parohije";
        $page = "Парохије";

        $parohije = Parohije::get();

        return view('admin.parohije.parohije')->with(compact('page','css','parohije'));
    }

    public function editParohija(Request $request, $id){
        Session::put('page', 'parohije');
        $css = "parohija";
        $page = "Ажурирање парохије";
        $parohije = Parohije::where('id',$id)->first();

        if($request->isMethod('post')){
            $data = $request->all();
            $parohije = Parohije::find($id);
            //echo "<pre>"; print_r($data); die;

            if($request->hasFile('paroh_image')){
                $image_tmp = $request->file('paroh_image');
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imageName = rand(100,999).date("Ymdhis").'.'.$extension;
                    $imagePath = 'front/images/parohije/'.$imageName;
                    //echo "<pre>"; print_r($imageName); die;
                    Image::make($image_tmp)->save($imagePath);
                }

                if(!empty($data['current_paroh_image'])){
                    $parohImageName = $data['current_paroh_image'];
                    $parohImagePath = 'front/images/parohije/';
                    if(file_exists($parohImagePath.$parohImageName)){
                        unlink($parohImagePath.$parohImageName);
                    }
                }

            }else if(!empty($data['current_paroh_image'])){
                $imageName = $data['current_paroh_image'];
            }else{
                $imageName = "";
            }

            // DB Seed
            $parohije->name = $data['name'];
            $parohije->paroh = $data['paroh'];
            $parohije->paroh_phone = $data['paroh_phone'];
            $parohije->paroh_email = $data['paroh_email'];
            $parohije->paroh_image = $imageName;
            $parohije->about = $data['about'];
            $parohije->save();

            Session::flash('success_message','Успјешно сте ажурирали податке!');
            return redirect('admin/parohije');
        }

        return view('admin.parohije.parohija')->with(compact('page','css','parohije'));
    }
}
