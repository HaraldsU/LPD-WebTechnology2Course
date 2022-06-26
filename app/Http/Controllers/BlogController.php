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

    public function search(Request $request)
    {

        // dd($request->all());
        if ($request->name != null and $request->keyword != null and $request->search != null){
            $blogs = DB::table('blogs')
                ->where('name', 'LIKE', '%'.$request->search.'%')
                ->orwhere('keyword1', 'LIKE', '%'.$request->search.'%')
                ->orwhere('keyword2', 'LIKE', '%'.$request->search.'%')
                ->orwhere('keyword3', 'LIKE', '%'.$request->search.'%')
                ->orwhere('keyword4', 'LIKE', '%'.$request->search.'%')
                ->orwhere('keyword5', 'LIKE', '%'.$request->search.'%')->get();
        }
        else if ($request->name != null and $request->search != null){
            $blogs = DB::table('blogs')->where('name', 'LIKE', '%'.$request->search.'%')->get();
        }
        else if ($request->keyword != null and $request->search != null){
            $blogs = DB::table('blogs')
                ->where('keyword1', 'LIKE', '%'.$request->search.'%')
                ->orwhere('keyword2', 'LIKE', '%'.$request->search.'%')
                ->orwhere('keyword3', 'LIKE', '%'.$request->search.'%')
                ->orwhere('keyword4', 'LIKE', '%'.$request->search.'%')
                ->orwhere('keyword5', 'LIKE', '%'.$request->search.'%')->get();
        }
        else{
            $blogs = [];
        }
        return view('blogsearch', compact('blogs'));
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
        $blog = Blog::where('id','=',$id)->get();
        $keywords = Keyword::all();
        $categories = BlogCategory::all();
        return view('editblog')->with('keywords', $keywords)->with('categories', $categories)->with('blog', $blog);
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
        $blog = Blog::find($id);
        if ($request->input('name') != 0) $blog->name = $request->input('name');
        if ($request->input('content') != 0) $blog->content = $request->input('content');
        if ($request->input('link') != 0) $blog->link = $request->input('link');
        if ($request->input('keyword1') != 0) $blog->keyword1 = $request->input('keyword1');
        if ($request->input('keyword2') != 0) $blog->keyword2 = $request->input('keyword2');
        if ($request->input('keyword3') != 0) $blog->keyword3 = $request->input('keyword3');
        if ($request->input('keyword4') != 0) $blog->keyword4 = $request->input('keyword4');
        if ($request->input('keyword5') != 0) $blog->keyword5 = $request->input('keyword5');
        if ($request->input('category_id') != 0) $blog->category_id = $request->input('category_id');

        $blog->update();

        return redirect('/blog/'.$id);
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
