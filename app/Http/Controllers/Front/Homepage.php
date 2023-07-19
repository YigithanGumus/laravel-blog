<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Mail;
use Illuminate\Support\Facades\Validator;

// models
use App\Models\Article;
use App\Models\Category;
use App\Models\Page;
use App\Models\Contact;

class Homepage extends Controller
{
    public function __construct()
    {
        view()->share('pages', Page::orderBy('order', 'ASC')->get());
        view()->share('categories', Category::orderBy('name')->get());
    }

    public function index()
    {

        $data['articles'] = Article::orderBy('created_at', 'DESC')->paginate(2);
        $data['articles']->withPath(url('sayfa'));
        $data['categories'] = Category::orderBy('name')->get();

        return view('front.homepage', $data);
    }

    public function single($category, $slug)
    {
        $category = Category::whereSlug($category)->first() ?? abort(403, 'Böyle bir kategori bulunamadı!');
        $article = Article::whereSlug($slug)->whereCategoryId($category->id)->first() ?? abort(403, 'Böyle bir yazı bulamadı!');
        // Article::where('slug',$slug)->firstOrFail() -> Yukarıdaki ile aynı işlevi görür
        $article->increment('hit');
        // $categories =Category::orderBy('name')->get();

        return view('front.single')->with([
            "article" => $article
            // "categories" => $categories
        ]);
    }

    public function category($slug)
    {
        $category = Category::whereSlug($slug)->first() ?? abort(403, 'Böyle bir kategori bulunamadı!');
        $data['category'] = $category;
        $data['articles'] = Article::where('category_id', $category->id)->orderBy('created_at', 'DESC')->paginate(1);
        return view('front.category', $data);
    }

    public function page($slug)
    {
        $page = Page::whereSlug($slug)->first() ?? abort(403, 'Böyle bir sayfa bulunamadı!');
        $data['page'] = $page;
        return view('front.page', $data);
    }

    public function contact()
    {
        return view('front.contact');
    }

    public function contactpost(Request $request)
    {

        $rules = [
            'name' => 'required|min:5',
            'email' => 'required|email',
            'topic' => 'required',
            'message' => 'required|min:10'
        ];
        $validate = Validator::make($request->post(), $rules);

        if ($validate->fails()) {
            return redirect()->route('contact')->withErrors($validate)->withInput();
        }

        Mail::send([],[],
            function ($message) use ($request) {
                $message->from('yigithangumuss@gmail.com', 'Blog sitesi');
                $message->to('yigithangumuss@gmail.com');
                $message->setBody(
                    ' Mesajı Gönderen:' . $request->name . '<br>
                          Mesajı Gönderen Mail:' . $request->email . '<br>
                          Mesaj Konusu:' . $request->topic . '<br>
                          Mesaj:' . $request->message . '<br>
                          Mesaj gönderilme tarihi:' . now() . '','text/html');
                $message->subject($request->name.'İletişimden mesaj gönderdi!');
            }
        );


        // $contact = new Contact;
        // $contact->name=$request->name;
        // $contact->email=$request->email;
        // $contact->topic=$request->topic;
        // $contact->message=$request->message;
        // $contact->save();
        return redirect()->route('contact')->with('success', 'İletişim mesajınız bize iletildi, teşekkür ederiz!');
    }
}
