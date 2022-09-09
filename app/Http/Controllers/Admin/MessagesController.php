<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Models\Messages;
use Carbon\Carbon;

class MessagesController extends Controller
{
    public function messages(Request $request){
        Session::put('page', 'messages');
        $css = "messages";
        $page = "Поруке";

        $messages = Messages::orderBy('id', 'DESC')->paginate(6);
        $now = Carbon::now();

        return view('admin.messages.messages')->with(compact('page','css','messages','now'));
    }

    public function viewMessages($id){
        Session::put('page', 'messages');
        $css = "message";
        $page = "Поруке";

        $message = Messages::where('id', $id)->first();
        $now = Carbon::now();

        return view('admin.messages.message')->with(compact('page','css','message','now'));
    }

    public function updateMessageStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            if($data['status']== 0){
                $status = 1;
            }else{
                $status = 1;
            }

            Messages::where('id',$data['message_id'])->update(['status'=>$status]);
            return;
        }
    }

    public function deleteMessage($id){
        Messages::where('id',$id)->delete();

        Session::flash('success_message','Успјешно сте обрисали поруку');
        return redirect()->back();
    }

}
