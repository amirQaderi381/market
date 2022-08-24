<?php

namespace App\Http\Controllers\Admin\Content;

use Illuminate\Http\Request;
use App\Models\Content\Comment;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\CommentRequest;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unseenComments = Comment::where('commentable_type','App\Models\Content\Post')->where('seen',0)->get();
        foreach($unseenComments as $unseenComment)
        {
            $unseenComment->seen = 1;
            $result= $unseenComment->save();
        }
        $comments = Comment::where('commentable_type','App\Models\Content\Post')->orderBy('created_at', 'desc')->simplePaginate(15);
        return view('admin.content.comment.index',compact('comments'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        return view('admin.content.comment.show',compact('comment'));
    }


    public function status(Comment $comment)
    {
        $comment->status = $comment->status == 0 ?  1 : 0;
        $result = $comment->save();

        if($result)
        {
            if($comment->status == 0)
            {
               return response()->json(['status' => true , 'checked' => false]);

            }else{

                return response()->json(['status' => true , 'checked' => true]);
            }

        }else{

            return response()->json(['status' => false]);
        }
    }

    public function approved(Comment $comment)
    {
        $comment->approved = $comment->approved == 0 ? 1 : 0;
        $result=$comment->save();
        if($result){
            return redirect()->route('admin.content.comment.index')->with('swal-success', '  وضعیت نظر با موفقیت تغییر کرد');
        }
        else{
            return redirect()->route('admin.content.comment.index')->with('swal-error', '  وضعیت نظر با خطا مواجه شد');
        }
    }

    public function answer(CommentRequest $request , Comment $comment)
    {
        if($comment->parent_id == null)
        {
            $inputs = $request->all();
            $inputs['parent_id'] = $comment->id;
            $inputs['author_id'] = 1;
            $inputs['commentable_id'] = $comment->commentable_id;
            $inputs['commentable_type'] = $comment->commentable_type;
            $inputs['approved'] = 1;
            $inputs['status'] = 1;
            Comment::create($inputs);
            return redirect()->route('admin.content.comment.index')->with('swal-success','پاسخ شما با موفقیت ثبت شد');

        }else{

            return redirect()->route('admin.content.comment.index')->with('swal-error','خطایی رخ داده');
        }
    }
}
