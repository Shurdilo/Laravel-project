<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Session;
use Image;
use App\Models\News;
use App\Models\NewsImages;

class NewsController extends Controller
{
    
    public function news(){
        Session::put('page', 'news');
        $css = "news";
        $page = "Новости";

        $news = News::get();

        return view('admin.news.news')->with(compact('news','page','css'));
    }

    public function addNews(Request $request){
        Session::put('page', 'news');
        $page = "Новости";
        $css = "addnews";

        if($request->isMethod('post')){
            $data = $request->all();
            $news = new News;
            //echo "<pre>"; print_r($data); die;

            $rules = [
                'title' => 'required|max:255',
                'newstext' => 'required',
            ];

            $customMesssages = [
                // Custom error messages for validation
                'title.required' => 'Унесите наслов!',
                'newstext.required' => 'Унесите текст!',
            ];

            $this->validate($request,$rules,$customMesssages);

            if($request->hasFile('titleimage')){
                $image_tmp = $request->file('titleimage');
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imageName = rand(100,999).date("Ymdhis").'.'.$extension;
                    $imagePath = 'front/images/news/cover/'.$imageName;
                    //echo "<pre>"; print_r($imageName); die;
                    Image::make($image_tmp)->save($imagePath);
                }
            }else{
                $imageName = "";
            }

            // DB Seed
            $news->titleimage = $imageName;
            $news->title = $data['title'];
            $news->newstext = $data['newstext'];
            $news->admin_id = Auth::guard('admin')->id();
            $news->save();

            $news_id = $news->id;
            Session::put('news_id',$news_id);
            return redirect('admin/news/add-news-images');
        }

        return view('admin.news.add_news')->with(compact('page','css'));
    }

    public function addNewsImages(Request $request){
        if(!Session::has('news_id')){
            return redirect('admin/add-news');
        }
        Session::put('page', 'news');
        $page = "Новости";
        $css = "addnews";

        if($request->isMethod('post')){
            $data = $request->all();

            if($request->hasFile('newsimage')){
                $files = $request->file('newsimage');

                foreach($files as $file){
                    $image = new NewsImages;
                    $extension = $file->getClientOriginalExtension();
                    $imageName = rand(100,999).date("Ymdhis").'.'.$extension;
                    $imagePath = 'front/images/news/images/'.$imageName;
                    Image::make($file)->save($imagePath);
    
                    $image->news_id = $data['news_id'];
                    $image->newsimage = $imageName;
                    $image->save();

                    News::where('id',$data['news_id'])->update(['status' => "1"]);
                }
            }
            Session::forget('news_id');
            Session::flash('success_message','Успјешно сте додалли вијест!');
            return redirect('admin/news');
        }

        return view('admin.news.add_news_images')->with(compact('page','css'));
    }

    public function skipNews($id){
        News::where('id',$id)->update(['status' => "1"]);
        Session::forget('news_id');
        Session::flash('success_message','Успјешно сте додалли вијест!');
        return redirect('admin/news');
    }

    public function updateNewsStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            if($data['status']=="Активан"){
                $status = 0;
            }else{
                $status = 1;
            }

            News::where('id',$data['news_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'news_id'=>$data['news_id']]);
        }
    }

    public function deleteNews($id){
        if(!empty(NewsImages::select('newsimage')->where('news_id',$id)->first()->newsimage)){
            $news = NewsImages::select('newsimage')->where('news_id',$id)->get();
            foreach (json_decode($news) as $new){
                // Get News images path
                $newsImagesPath = 'front/images/news/images/';
                // Delete images from folder
                if(file_exists($newsImagesPath.$new->newsimage)){
                    unlink($newsImagesPath.$new->newsimage);
                }
            }
            NewsImages::where('news_id',$id)->delete();
        }

        if(!empty(News::select('titleimage')->where('id',$id)->first()->titleimage)){
            // Get News image
            $newsImage = News::select('titleimage')->where('id',$id)->first();
            // Get News image path
            $newsImagePath = 'front/images/news/cover/';
            // Delete image from folder
            if(file_exists($newsImagePath.$newsImage->titleimage)){
                unlink($newsImagePath.$newsImage->titleimage);
            }
        }

        News::where('id',$id)->delete();

        Session::flash('success_message','Успјешно сте обрисали вијест');
        return redirect()->back();
    }

    public function editNews(Request $request, $id){
        Session::put('page', 'news');
        $page = "Ажурирање вијести";
        $css = "editnews";
        $images = NewsImages::where('news_id',$id)->get();
        $news = News::where('id',$id)->first();
        
        if($request->isMethod('post')){
            $data = $request->all();
            $news = News::find($id);
            //echo "<pre>"; print_r($data); die;

            $rules = [
                'title' => 'required|max:255',
                'newstext' => 'required',
            ];

            $customMesssages = [
                // Custom error messages for validation
                'title.required' => 'Унесите наслов!',
                'newstext.required' => 'Унесите текст!',
            ];

            $this->validate($request,$rules,$customMesssages);

            if($request->hasFile('titleimage')){
                $image_tmp = $request->file('titleimage');
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imageName = rand(100,999).date("Ymdhis").'.'.$extension;
                    $imagePath = 'front/images/news/cover/'.$imageName;
                    //echo "<pre>"; print_r($imageName); die;
                    Image::make($image_tmp)->save($imagePath);
                }

                if(!empty($data['current_news_titleimage'])){
                    $newsImageName = $data['current_news_titleimage'];
                    $newsImagePath = 'front/images/news/cover/';
                    if(file_exists($newsImagePath.$newsImageName)){
                        unlink($newsImagePath.$newsImageName);
                    }
                }

            }else if(!empty($data['current_news_titleimage'])){
                $imageName = $data['current_news_titleimage'];
            }else{
                $imageName = "";
            }

            $news->titleimage = $imageName;
            $news->title = $data['title'];
            $news->newstext = $data['newstext'];
            $news->save();

            Session::flash('success_message','Успјешно сте ажурирали вијест!');
            return redirect('admin/news');
        }
    
        return view('admin.news.edit_news')->with(compact('page','css','news','images'));
    }

    public function deleteNewsTitleImage($id){
        if(!empty(News::select('titleimage')->where('id',$id)->first()->titleimage)){
            // Get News image
            $newsImage = News::select('titleimage')->where('id',$id)->first();
            // Get News image path
            $newsImagePath = 'front/images/news/cover/';
            // Delete image from folder
            if(file_exists($newsImagePath.$newsImage->titleimage)){
                unlink($newsImagePath.$newsImage->titleimage);
            }
        }

        $titleImage = "";

        News::where('id',$id)->update(['titleimage'=>$titleImage]);

        Session::flash('success_message','Успјешно сте обрисали насловну фотографију');
        return redirect()->back();
    }

    public function editNewsImages(Request $request, $id){
        if($request->isMethod('post')){
            $data = $request->all();

            if($request->hasFile('newsimage')){
                $files = $request->file('newsimage');

                foreach($files as $file){
                    $image = new NewsImages;
                    $extension = $file->getClientOriginalExtension();
                    $imageName = rand(100,999).date("Ymdhis").'.'.$extension;
                    $imagePath = 'front/images/news/images/'.$imageName;
                    Image::make($file)->save($imagePath);
    
                    $image->news_id = $id;
                    $image->newsimage = $imageName;
                    $image->save();
                }
            }
            Session::flash('success_message','Успјешно сте додали слику/е');
            return redirect()->back();
        }
    }

    public function deleteNewsImage($id){
        if(!empty(NewsImages::select('newsimage')->where('id',$id)->first()->newsimage)){
            // Get News image
            $newsImage = NewsImages::select('newsimage')->where('id',$id)->first();
            // Get News image path
            $newsImagePath = 'front/images/news/images/';
            // Delete image from folder
            if(file_exists($newsImagePath.$newsImage->newsimage)){
                unlink($newsImagePath.$newsImage->newsimage);
            }
        }

        NewsImages::where('id',$id)->delete();

        Session::flash('success_message','Успјешно сте обрисали фотографију');
        return redirect()->back();
    }

    public function updateNewsImageStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            if($data['status']=="Активна"){
                $status = 0;
            }else{
                $status = 1;
            }

            NewsImages::where('id',$data['image_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'image_id'=>$data['image_id']]);
        }
    }

}
