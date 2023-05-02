<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {

        $blogs = Blog::query()
            ->where('estado',1)
            ->orderBy('fecha',"desc")->get();

        return view('web.blog.index')->with(compact('blogs'));
    }


    public function detalle($slug)
    {
        $blog = Blog::query()->where('slug',$slug)->first();

        if (!$blog) {
            return abort(404);
        }

        return view('web.blog.detalle')->with(compact('blog'));

    }

}
