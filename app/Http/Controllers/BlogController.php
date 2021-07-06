<?php

namespace App\Http\Controllers;

use App\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::all();
//        return ($blogs);
        return view('welcome', ["blogs" => $blogs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "title" => "required|string|max:255|min:3",
            "description" => "required|string|max:65535|min:3",
            "tag.*" => "required|regex:/^[a-z]+[0-9]*[a-z]*$/i",
            "image" => "required|mimes:jpeg,jpg,png|max:100"
        ]);
        $input = $request->all();
        $input['tags'] = implode(",", $input['tag']);
        $input['user_id'] = Auth::user()->id;
        $blog = new Blog();
        $blog->fill($input);
        $blog->save();

        return redirect(route('blog.index'))->withSuccess("Blog Added");
//        dd($blog);
//        Blog::create();
//        dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Blog $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Blog $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        if ($blog->user_id != Auth::user()->id)
            return redirect()->back();
        return view('blog.update', ['blog' => $blog]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Blog $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        if ($blog->user_id != Auth::user()->id)
            return redirect("/");
        $request->validate([
            "title" => "required|string|max:255|min:3",
            "description" => "required|string|max:65535|min:3",
            "tag.*" => "required|regex:/^[a-z]+[0-9]*[a-z]*$/i",
            "image" => "mimes:jpeg,jpg,png|max:100"
        ]);
        $input = $request->all();
        $input['tags'] = implode(",", $input['tag']);
//        $input['user_id'] = Auth::user()->id;
        $blog->fill($input);
        $blog->save();
        return redirect(route('blog.index'))->withSuccess("Blog updated");
//        dd($blog, $request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Blog $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        if ($blog->user_id != Auth::user()->id)
            return redirect("/");

        $blog->delete();
        return redirect(route('blog.index'))->withSuccess("Blog deleted");
    }
}
