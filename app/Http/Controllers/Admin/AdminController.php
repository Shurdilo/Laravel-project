<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Session;
use Image;
use App\Models\Admin;
use App\Models\Hero;
use App\Models\Mitropolit;

class AdminController extends Controller
{

    public function dashboard(){
        Session::put('page', 'dashboard');
        $css = "dashboard";
        $page = "Почетна";
        return view('admin.dashboard')->with(compact('page','css'));
    }

    public function login(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;

            $rules = [
                'email' => 'required|email|max:255',
                'password' => 'required',
            ];

            $customMesssages = [
                // Custom error messages for validation
                'email.required' => 'Унесите Е-маил!',
                'email.email' => 'Унесите исправан Е-маил!',
                'password.required' => 'Унесите лозинку!',
            ];

            $this->validate($request,$rules,$customMesssages);

            if(Auth::guard('admin')->attempt(['email'=>$data['email'],'password'=>$data['password'],'status'=>1])){
                return redirect('admin/dashboard')->with('success_message','Успјешно сте пријављени!');
            }else{
                return redirect()->back()->with('error_message','Погрешан Е-маил или лозинка!');
            }
        }

        return view('admin.login');
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }

    public function settings(Request $request){
        $page = "Подешавања";
        Session::put('page', 'settings');
        $css = "settings";

        if($request->isMethod('post')){
            $data = $request->all();
            $imageSeed = new Hero;
            //echo "<pre>"; print_r($data); die;

            if($request->hasFile('heroimage')){
                $image_tmp = $request->file('heroimage');
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imageName = rand(100,999).date("Ymdhis").'.'.$extension;
                    $imagePath = 'front/images/hero/'.$imageName;
                    //echo "<pre>"; print_r($imageName); die;
                    Image::make($image_tmp)->save($imagePath);
                }

                $imageSeed->image = $imageName;
                $imageSeed->save();

                Session::flash('success_message', 'Успјешно сте додали слику!');
                return redirect('admin/settings');
            }
        }

        $heroes = Hero::get();
        $mitro = Mitropolit::where('id', "1")->first();
        //$heroes = json_decode(json_encode($heroes));

        return view('admin.settings')->with(compact('heroes','page','css','mitro'));
    }

    public function deleteHero($id){
        if(!empty(Hero::select('image')->where('id',$id)->first()->image)){
            // Get Hero image
            $heroImage = Hero::select('image')->where('id',$id)->first();
            // Get Hero image path
            $heroImagePath = 'front/images/hero/';
            // Delete image from folder
            if(file_exists($heroImagePath.$heroImage->image)){
                unlink($heroImagePath.$heroImage->image);
            }
        }

        Hero::where('id',$id)->delete();

        Session::flash('success_message','Успјешно сте обрисали слику');
        return redirect()->back();
    }

    public function setHero($id){
        Hero::where('status', "1")->update(['status' => "0"]);
        Hero::where('id',$id)->update(['status' => "1"]);

        Session::flash('success_message','Успјешно сте поставили насловну слику');
        return redirect()->back();
    }

    public function mitropolit(Request $request, $id){
        if($request->isMethod('post')){
            $data = $request->all();
            $mitropolit = Mitropolit::find($id);
            //echo "<pre>"; print_r($data); die;

            $rules = [
                'name' => 'required|max:255',
                'mitrotext' => 'required',
            ];

            $customMesssages = [
                // Custom error messages for validation
                'name.required' => 'Унесите Име/Титулу!',
                'mitrotext.required' => 'Унесите текст!',
            ];

            $this->validate($request,$rules,$customMesssages);

            if($request->hasFile('mitroimage')){
                $image_tmp = $request->file('mitroimage');
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imageName = rand(100,999).date("Ymdhis").'.'.$extension;
                    $imagePath = 'front/images/'.$imageName;
                    //echo "<pre>"; print_r($imageName); die;
                    Image::make($image_tmp)->save($imagePath);
                }

                if(!empty($data['current_mitro_mitroimage'])){
                    $mitroImageName = $data['current_mitro_mitroimage'];
                    $mitroImagePath = 'front/images/';
                    if(file_exists($mitroImagePath.$mitroImageName)){
                        unlink($mitroImagePath.$mitroImageName);
                    }
                }

            }else if(!empty($data['current_mitro_mitroimage'])){
                $imageName = $data['current_mitro_mitroimage'];
            }else{
                $imageName = "";
            }

            $mitropolit->mitroimage = $imageName;
            $mitropolit->name = $data['name'];
            $mitropolit->mitrotext = $data['mitrotext'];
            $mitropolit->save();

            Session::flash('success_message','Успјешно сте ажурирали биографију Митрополита!');
            return redirect()->back();
        }
    }

    public function admins(){
        Session::put('page', 'admins');
        $css = "admins";
        $page = "Админи";

        $admins = Admin::orderBy('id', 'DESC')->paginate(6);
        //echo Auth::guard('admin')->id(); die;

        return view('admin.admins.admins')->with(compact('page','css','admins'));
    }

    public function addAdmin(Request $request){
        Session::put('page', 'admins');
        $css = "admin";
        $page = "Додавање админа";

        if($request->isMethod('post')){
            $data = $request->all();
            $admins = new Admin;
            //echo "<pre>"; print_r($data); die;

            // DB Seed
            $admins->name = $data['name'];
            $admins->email = $data['email'];
            $admins->password = Hash::make($data['password']);
            $admins->save();

            Session::flash('success_message','Успјешно сте додалли админа!');
            return redirect('admin/admins');
        }

        return view('admin.admins.addadmin')->with(compact('page','css'));
    }

    public function editAdmin(Request $request, $id){
        Session::put('page', 'admins');
        $css = "admin";
        $page = "Ажурирање админа";
        $admins = Admin::where('id',$id)->first();

        if($request->isMethod('post')){
            $data = $request->all();
            $admins = Admin::find($id);
            //echo "<pre>"; print_r($data); die;

            // DB Seed
            $admins->name = $data['name'];
            $admins->email = $data['email'];
            $admins->password = Hash::make($data['password']);
            $admins->save();

            Session::flash('success_message','Успјешно сте ажурирали податке!');
            return redirect('admin/admins');
        }

        return view('admin.admins.editadmin')->with(compact('page','css','admins'));
    }

    public function deleteAdmin($id){
        Admin::where('id',$id)->delete();

        Session::flash('success_message','Успјешно сте обрисали админа');
        return redirect()->back();
    }

}
