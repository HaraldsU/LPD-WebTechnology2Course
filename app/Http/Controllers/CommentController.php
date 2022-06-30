<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Validator;

class CommentController extends Controller
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

        // $rules = array(
        //     'comment' => 'min:1|max:280|string',
        // );
        // $validated = $this->validate($request, $rules);

        $validator = Validator::make($request->all(), [
            'comment' => 'min:1|max:300|string',
        ]);

        if ($validator->fails()) {
            return redirect('/blog/'.$request->blog.'#validate')
                        ->withErrors($validator);
                        // ->withInput();
        }

        // echo("he llo");

        $comment = new Comment();
        $comment->comment = $request->comment;
        $user = Auth::id();
        $comment->user = $user;
        $comment->blog_id = $request->blog;

        $comment->save();
        return redirect('/blog/'.$request->blog.'#end');
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
        $user = Auth::id();
        $user1 = User::find($user);
        $comment = Comment::find($id);
        $id = $comment->blog_id;

        if ($comment->user == $user1->id or $user1->isAdmin == true){
            echo($comment);
            echo($id);
            $comment->delete();
            return redirect('/blog/'.$id.'#end');
        }
        else {
            return redirect('/blog/'.$id.'#end')->with('message', 'ACCESS DENIED!');
            // return redirect('/blog/'.$id);
        }
    }
}
