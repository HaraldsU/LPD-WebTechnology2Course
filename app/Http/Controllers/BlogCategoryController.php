<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogCategory;
use App\Models\Blog;
use App\Models\Keyword;
use Illuminate\Support\Facades\DB;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        // $category = BlogCategory::where('id','=',$id)->get();
        // return view('blogsbycateg',['category' => $category]);
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
        return view('createcategory')->with('keywords', $keywords);
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
        $category = new BlogCategory();
        $category->id = $request->id;
        $category->link = $request->link;
        $category->keyword1 = $request->keyword1;
        $category->keyword2 = $request->keyword2;
        $category->keyword3 = $request->keyword3;
        $category->keyword4 = $request->keyword4;
        $category->keyword5 = $request->keyword5;
        $category->save();
        return redirect('/category');
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
        $blog = Blog::where('category_id','=',$id);
        $blog->delete();
        $category = BlogCategory::find($id);
        $category->delete();
        return redirect('/category');
    }

    public function getData(){
        $get = DB::table('blogcategories')->get();
        return view('category', ['blogcategories' => $get]);
    }
}
