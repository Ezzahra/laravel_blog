<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PostOfPublisherController extends Controller
{
   
    
    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $posts = $user->posts()->get();
        return view('blog.posts', [
            'posts' => $posts])->with('id', $id);
    }
      
    /**
    *
    * @param  string  $id
    * @return \Illuminate\Http\Response
    */
    public function block($id)
    {
        User::where('id', $id)
             ->update([
            'canPublish' => false,
        ]);
        return redirect('/')->with('message', 'the user has been blocked');
    }
}
