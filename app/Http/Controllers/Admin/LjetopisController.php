<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Models\Ljetopis;

class LjetopisController extends Controller
{
    public function ljetopis(Request $request){
        Session::put('page', 'ljetopis');
        $css = "ljetopis";
        $page = "Љетопис";
        $ljetopis = Ljetopis::where('id', 1)->first();

        if($request->isMethod('post')){
            $data = $request->all();
            $ljetopis = Ljetopis::find(1);
            //echo "<pre>"; print_r($data); die;

            // DB Update
            $ljetopis->ljetopistext = $data['ljetopistext'];
            $ljetopis->save();

            Session::flash('success_message','Успјешно сте ажурирали податке!');
            return redirect('admin/ljetopis');
        }

        return view('admin.ljetopis')->with(compact('page','css','ljetopis'));
    }
}
