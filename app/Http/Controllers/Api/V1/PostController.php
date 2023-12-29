<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Mail\conformNotification;
use App\Models\Comment;
use App\Models\Join;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

//use http\Env\Request;

class PostController extends Controller
{
    public function show(Request $request,$id)
    {
        $post = Post::find($id);
        $join = Join::where('post_id', $id)->first();
        $user = User::find($join->user_id);
        $comments = Comment::all()->where('post_id', $id);
        return view("read",['id'=>$id,'post' => $post,'user_name'=>$user->name,'comments'=>$comments]);
//        if( $request->has('create') )
//        {
//            $tags = Tag::all();
//            return view("create",['tags'=>$tags]);
//        }
//        else if( $request->has('edit')  )
//        {
//            $post = Post::find($id);
//            return view("edit",['post'=>$post]);
//        }
//        else                                                    //read post
//        {
//            $post = Post::find($id);
//            $join = Join::where('post_id', $id)->first();
//            $user = User::find($join->user_id);
//            $comments = Comment::all()->where('post_id', $post->id);
//            return view("read",['id'=>$id,'post' => $post,'user_name'=>$user->name,'comments'=>$comments]);
//        }
    }

    public function update(Request $request,$id)
    {


        if( $request->has('approve') and auth()->user()->role ==="admin")
        {
            $post = Post::find($id);
            $post->approved = true;
            $post->save();
            $userEmail = "harikrishnan.radhakrishnan@qburst.com";
//            Mail::to($userEmail)->queue(new conformNotification());
            return "true";
        }

        return "false";
    }

    public function destroy(Request $request,$id)
    {
        $post = Post::find($id);
        $post->delete();
        return "true";
    }


}