<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Models\Keyword;
use App\Models\Blog;
use App\Models\User;
use Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class KeywordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $user = Auth::id();
        $user1 = User::find($user);
        if ($user1->isAdmin == true){
            $keywords = Keyword::all();
            $blogs = Blog::all();
            $categories = BlogCategory::all();
            // echo($keywords);
            return view('keywords')->with('keywords', $keywords)->with('blogs', $blogs)->with('categories', $categories);
        }
        else {
            return redirect('/')->with('message', __('ACCESS DENIED!'));
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
            'id' => 'required|string|min:1|max:50'
        ]);
        if ($validator->fails()) {
            return redirect('/keywords')
                        ->withErrors($validator);
                        // ->withInput();
        }

        $keyword = new Keyword();
        $keyword->id = $request->id;
        $keyword->save();
        return redirect('/keywords');
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
        $validator = Validator::make($request->all(), [
            'id1' => 'required|string|min:1|max:50',
            'value' => 'required|string|min:1|max:50'
        ]);
        if ($validator->fails()) {
            return redirect('/keywords')
                        ->withErrors($validator);
                        // ->withInput();
        }

        $keyword = Keyword::find($request->id1);
        if ($request->input('id1') != 0 and $request->input('value') != 0){
            // echo($keyword);
            // echo($request->value);
            // echo($request->id1);
            $keyword->id = $request->value;
            $keyword->update();
        }

        return redirect ('/keywords');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
        // if ($request->id2 != null){
        //     $keyword = Keyword::find($request->id2);
        //     $keyword->delete();
        // }
        // return redirect('/keywords');
    }
}
