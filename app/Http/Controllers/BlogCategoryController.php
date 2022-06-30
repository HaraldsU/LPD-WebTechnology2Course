<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogCategory;
use App\Models\Blog;
use App\Models\Keyword;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Validator;

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
        // echo("hello");
        $user = Auth::id();
        $user1 = User::find($user);
        if ($user1->isAdmin == true){
            $keywords = Keyword::all();
            return view('createcategory')->with('keywords', $keywords);
        }
        else{
            throw ValidationException::withMessages(['categorycreate' => __("Access FORBIDDEN (admin only)")]);
            return redirect()::back();
        }
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
        $validator = Validator::make($request->all(), [
            'id' => 'required|string|min:1|max:100',
            'link' => 'required|active_url|max:300'
        ]);
        if ($validator->fails()) {
            return redirect('/createcategory')
                        ->withErrors($validator);
                        // ->withInput();
        }

        $category = new BlogCategory();
        $category->id = $request->id;
        $category->link = $request->link;
        $category->keyword1 = $request->keyword1;
        $category->keyword2 = $request->keyword2;
        $category->keyword3 = $request->keyword3;
        $category->keyword4 = $request->keyword4;
        $category->keyword5 = $request->keyword5;
        $category->user_id = Auth::id();
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

    public function search(Request $request)
    {
        // $blogs = collect();
        // echo($blogs);
        // echo("<br>");
        if ($request->name != null and $request->keyword != null and $request->search != null){
            // echo("test4");
            $categories = DB::table('blogcategories')
                ->where('id', 'LIKE', '%'.$request->search.'%')
                ->orwhere('keyword1', 'LIKE', '%'.$request->search.'%')
                ->orwhere('keyword2', 'LIKE', '%'.$request->search.'%')
                ->orwhere('keyword3', 'LIKE', '%'.$request->search.'%')
                ->orwhere('keyword4', 'LIKE', '%'.$request->search.'%')
                ->orwhere('keyword5', 'LIKE', '%'.$request->search.'%')->get();
            // $blogs = [];
            // $i = 0;
            // foreach ($categories as $category){
            //     $blogs[$i] = DB::table('blogs')->where('category_id', '=', $category->id);
            //     $i++;
            // }
        }
        else if ($request->name != null and $request->search != null){
            // echo("test3");
            $categories = DB::table('blogcategories')->where('id', 'LIKE', '%'.$request->search.'%')->get();
            // echo($categories);
            // foreach ($categories as $category){
            //     $blog = DB::table('blogs')->where('category_id', '=', $category->id)->get();
            //     // echo("<br>");
            //     // echo($blog);
            //     // echo("<br>");
            //     if (count($blog) != null) $blogs->push($blog);
            // }
        }
        else if ($request->keyword != null and $request->search != null){
            // echo("test2");
            $categories = DB::table('blogcategories')
                ->where('keyword1', 'LIKE', '%'.$request->search.'%')
                ->orwhere('keyword2', 'LIKE', '%'.$request->search.'%')
                ->orwhere('keyword3', 'LIKE', '%'.$request->search.'%')
                ->orwhere('keyword4', 'LIKE', '%'.$request->search.'%')
                ->orwhere('keyword5', 'LIKE', '%'.$request->search.'%')->get();
            // $blogs = [];
            // $i = 0;
            // foreach ($categories as $category){
            //     $blogs[$i] = DB::table('blogs')->where('category_id', '=', $category->id);
            //     $i++;
            // }
        }
        else{
            // echo("test1");
            $categories = [];
            // $blogs = [];
        }

        // echo($categories);
        // echo("<br>");
        // echo("<br>");
        // echo($blogs);
        return view('categorysearch')->with('categories', $categories);
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
        $user = Auth::id();
        $user1 = User::find($user);
        if ($user1->isAdmin == true){
            $keywords = Keyword::all();
            $category = BlogCategory::where('id','=',$id)->get();
            return view('editcategory')->with('keywords', $keywords)->with('category', $category);
        }
        else{
            throw ValidationException::withMessages(['categoryedit' => __("Access FORBIDDEN (admin only)")]);
            return redirect('/edit/'.$id);
        }
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
        $validator = Validator::make($request->all(), [
            'id' => 'string|max:100|nullable',
            'link' => 'active_url|max:300|nullable'
        ]);
        if ($validator->fails()) {
            return redirect('/category/edit/'.$id)
                        ->withErrors($validator);
                        // ->withInput();
        }

        $category = BlogCategory::find($id);
        if ($request->input('id') != 0) $category->id = $request->input('id');
        if ($request->input('link') != 0) $category->link = $request->input('link');
        if ($request->input('keyword1') != 0) $category->keyword1 = $request->input('keyword1');
        if ($request->input('keyword2') != 0) $category->keyword2 = $request->input('keyword2');
        if ($request->input('keyword3') != 0) $category->keyword3 = $request->input('keyword3');
        if ($request->input('keyword4') != 0) $category->keyword4 = $request->input('keyword4');
        if ($request->input('keyword5') != 0) $category->keyword5 = $request->input('keyword5');

        $category->update();

        return redirect('/category');
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
        $user = Auth::id();
        $user1 = User::find($user);
        if ($user1->isAdmin == true){
            $blog = Blog::where('category_id','=',$id);
            $blog->delete();
            $category = BlogCategory::find($id);
            $category->delete();
            return redirect('/category');
        }
        else{
            throw ValidationException::withMessages(['categorydel' => __("Access FORBIDDEN (admin only)")]);
            return redirect('/category/'.$id);
        }
    }

    public function getData(){
        $get = DB::table('blogcategories')->get();
        return view('category', ['blogcategories' => $get]);
    }
}
