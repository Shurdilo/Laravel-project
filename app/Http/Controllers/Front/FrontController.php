<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use DB;
use App\Models\Hero;
use App\Models\News;
use App\Models\Mitropolit;
use App\Models\Messages;
use App\Models\NewsImages;
use App\Models\Parohije;
use App\Models\Ljetopis;

class FrontController extends Controller
{
    public function index(Request $request){
        $css = "index";
        $page = "index";
        $heroText = "<h2>Мокро</h2><h1>Храм Успења Пресвете Богородице</h1>";

        $heroImage = Hero::where('status', "1")->first();
        $heroImage = $heroImage->image;
        $news = News::where('status', "1")->latest()->take(3)->get();
        $mitro = Mitropolit::where('id', "1")->first();

        if($request->isMethod('post')){
            $data = $request->all();
            $message = new Messages;
            //echo "<pre>"; print_r($data); die;

            $message->name = $data['name'];
            $message->email = $data['email'];
            $message->theme = $data['theme'];
            $message->phone = $data['phone'];
            $message->message = $data['message'];
            $message->save();

            Session::flash('success_message','Успјешно сте послали поруку!');
            return redirect()->back();
        }

        return view('front.index')->with(compact('heroImage','news','mitro','css','page','heroText'));

    }

    public function mitropolit(){
        $css = "mitropolit";
        $page = "mitropolit";
        $heroText = "<h1>Митрополит</h1>";

        $heroImage = Hero::where('status', "1")->first();
        $heroImage = $heroImage->image;
        $mitro = Mitropolit::where('id', "1")->first();

        return view('front.mitropolit')->with(compact('css','page','heroImage','heroText','mitro'));
    }

    public function news(Request $request){
        $css = "news";
        $page = "novosti";
        $heroText = "<h1>Новости</h1>";

        $heroImage = Hero::where('status', "1")->first();
        $heroImage = $heroImage->image;

        $news = News::select('news.*','admins.name')->join('admins', 'news.admin_id', '=', 'admins.id')->orderBy('id', 'DESC')->where('news.status', "1")->paginate(5);
        if($request->ajax()){
            $view = view('front.news.data')->with(compact('news'))->render();
            return response()->json(['html'=>$view]);
        }

        return view('front.news.news')->with(compact('css','page','heroImage','heroText','news'));
    }

    public function post($id){
        $css = "posts";
        $page = "novosti";
        $heroText = "<h1>Новости</h1>";

        $heroImage = Hero::where('status', "1")->first();
        $heroImage = $heroImage->image;

        $new = News::where('news.id', $id)->select('news.*','admins.name')->join('admins', 'news.admin_id', '=', 'admins.id')->first();
        $news = News::where('status', "1")->latest()->take(3)->get();
        $images = NewsImages::where('news_id',$id)->get();
        //echo "<pre>"; print_r($new); die;

        if($new->status == 0){
            return redirect('/');
        }

        return view('front.news.post')->with(compact('css','page','heroImage','heroText','new','news','images'));
    }

    public function parohije(){
        $css = "parohije";
        $page = "parohije";
        $heroText = "<h1>Парохије</h1>";

        $heroImage = Hero::where('status', "1")->first();
        $heroImage = $heroImage->image;
        $news = News::where('status', "1")->latest()->take(3)->get();

        return view('front.parohije.parohije')->with(compact('css','page','heroImage','heroText','news'));
    }

    public function parohija($id){
        $css = "parohija";
        $page = "parohije";
        $heroText = "<h1>Парохије</h1>";

        $heroImage = Hero::where('status', "1")->first();
        $heroImage = $heroImage->image;
        $parohija = Parohije::where('id', $id)->first();
        //echo "<pre>"; print_r($new); die;

        return view('front.parohije.parohija')->with(compact('css','page','heroImage','heroText','parohija'));
    }

    public function ljetopis(){
        $css = "ljetopis";
        $page = "ljetopis";
        $heroText = "<h1>Љетопис</h1>";

        $heroImage = Hero::where('status', "1")->first();
        $heroImage = $heroImage->image;
        $ljetopis = Ljetopis::where('id', "1")->first();

        return view('front.ljetopis')->with(compact('css','page','heroImage','heroText','ljetopis'));
    }
}
