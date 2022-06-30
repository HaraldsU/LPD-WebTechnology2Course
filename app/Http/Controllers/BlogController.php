<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Keyword;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Validation\ValidationException;

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
        $blog = Blog::find($id);
        $comments = Comment::where('blog_id', '=', $id)->get();
        $users = collect();
        $author = User::find($blog->user_id);
        foreach ($comments as $comment){
            $user = User::find($comment->user);
            $users->push($user);
        }
        $blog = Blog::where('id','=',$id)->get();
        // echo($blog);
        // echo("<br>");
        // echo("<br>");
        // echo($comments);
        // echo("<br>");
        // echo("<br>");
        // echo($users);
        // echo("<br>");
        // echo("<br>");
        // echo($author);
        return view('blog',['blog' => $blog, 'comments' => $comments, 'users' => $users, 'author' => $author]);
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
        // echo("test");
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:1|max:100',
            'content' => 'required|string|min:1|max:10000',
            'link' => 'required|active_url|max:300'
        ]);
        if ($validator->fails()) {
            return redirect('/createblog')
                        ->withErrors($validator);
                        // ->withInput();
        }

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
        $blog->user_id = Auth::id();
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

    public function search1 (Request $request)
    {
        // echo("test");
        if ($request->name != null and $request->keyword != null and $request->search != null){
            // echo("test1");
            $search = $request->search;
            $blogs = DB::table('blogs')
                ->where('category_id', '=', $request->category)
                ->where(function($q) use ($search){
                    $q->orwhere('name', 'LIKE', '%'.$search.'%')
                    ->orwhere('keyword1', 'LIKE', '%'.$search.'%')
                    ->orwhere('keyword2', 'LIKE', '%'.$search.'%')
                    ->orwhere('keyword3', 'LIKE', '%'.$search.'%')
                    ->orwhere('keyword4', 'LIKE', '%'.$search.'%')
                    ->orwhere('keyword5', 'LIKE', '%'.$search.'%');
                })
                ->get();
        }
        else if ($request->name != null and $request->search != null){
            // echo("test2");
            $blogs = DB::table('blogs')
                ->where('category_id', '=', $request->category)
                ->where('name', 'LIKE', '%'.$request->search.'%')
                ->get();
        }
        else if ($request->keyword != null and $request->search != null){
            // echo("test3");
            $search = $request->search;
            $blogs = DB::table('blogs')
                ->where('category_id', '=', $request->category)
                ->where(function($q) use ($search){
                    $q->orwhere('keyword1', 'LIKE', '%'.$search.'%')
                    ->orwhere('keyword2', 'LIKE', '%'.$search.'%')
                    ->orwhere('keyword3', 'LIKE', '%'.$search.'%')
                    ->orwhere('keyword4', 'LIKE', '%'.$search.'%')
                    ->orwhere('keyword5', 'LIKE', '%'.$search.'%');
                })
                ->get();
        }
        else{
            // echo("test4");
            $blogs = [];
        }
        $category = $request->category;
        // echo($category);
        // echo("<br>");
        // echo($blogs);
        return view('blogsbycategsearch')->with('blogs', $blogs)->with('category', $category);
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
        $blog = Blog::find($id);
        $user = Auth::id();
        $user1 = User::find($user);
        if ($user == $blog->user_id or $user1->isAdmin == true){
            $blog = Blog::where('id','=',$id)->get();
            $keywords = Keyword::all();
            $categories = BlogCategory::all();
            return view('editblog')->with('keywords', $keywords)->with('categories', $categories)->with('blog', $blog);
        }
        else{
            throw ValidationException::withMessages(['blogedit' => __("Can't EDIT other user's blogs!")]);
            return redirect('/blog/'.$id);
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
        // echo("hello");
        $validator = Validator::make($request->all(), [
            'name' => 'string|max:100|nullable',
            'content' => 'string|max:10000|nullable',
            'link' => 'active_url|max:300|nullable'
        ]);
        if ($validator->fails()) {
            return redirect('/blog/edit/'.$id)
                        ->withErrors($validator);
                        // ->withInput();
        }

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
        $user = Auth::id();
        $user1 = User::find($user);
        if ($user == $blog->user_id or $user1->isAdmin == true){
            $comments = Comment::where('blog_id', '=', $id);
            $comments->delete();
            $blog->delete();
            return redirect('/');
        }
        else{
            throw ValidationException::withMessages(['blogdel' => __("Can't DELETE other user's blogs!")]);
            return redirect('/blog/'.$id);
        }
    }

    public function getData(){
        $get = DB::table('blogs')->get();
        return view('landing', ['blogs' => $get]);
    }
}
