<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Keyword;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        $blog = Blog::where('id','=',$id)->get();
        return view('blog',['blog' => $blog]);
    }

    public function index2($id)
    {
        //
        $blogs = Blog::where('category_id','=',$id)->get();
        $category = BlogCategory::where('id','=',$id)->get();
        return view('blogsbycateg',['blogs' => $blogs, 'category' => $category]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $keywords = Keyword::all();
        $categories = BlogCategory::all();
        return view('createblog')->with('keywords', $keywords)->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $blog = new Blog();
        $blog->name = $request->name;
        $blog->content = $request->content;
        $blog->link = $request->link;
        $blog->keyword1 = $request->keyword1;
        $blog->keyword2 = $request->keyword2;
        $blog->keyword3 = $request->keyword3;
        $blog->keyword4 = $request->keyword4;
        $blog->keyword5 = $request->keyword5;
        $blog->category_id = $request->category_id;
        $blog->save();
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $blog = Blog::find($id);
        $blog->delete();
        return redirect('/');
    }

    public function getData(){
        $get = DB::table('blogs')->get();
        return view('landing', ['blogs' => $get]);
    }
}
