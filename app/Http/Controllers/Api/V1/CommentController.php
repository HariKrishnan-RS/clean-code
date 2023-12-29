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

class CommentController extends Controller
{

    public function store(Request $request,$id)
    {
        if( $request->has('comment') )
        {
            $newComment = new Comment();
            $newComment->comment = $request->input('comment');
            $newComment->user_id = auth()->user()->id;
            $newComment->post_id = $id;
            $newComment->save();

            $post = Post::find($id);
            $join = Join::where('post_id', $id)->first();
            $user = User::find($join->user_id);
            $comments = Comment::all()->where('post_id', $post->id);
            return view("read",['id'=>$id,'post' => $post,'user_name'=>$user->name,'comments'=>$comments]);

        }
    }


}