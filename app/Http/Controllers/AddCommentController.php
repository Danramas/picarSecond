<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AddCommentPost;

use Illuminate\Http\Request;

class AddCommentController extends Controller
{
    public function store(AddCommentPost $request)
    {
        Comment::create([
            'text' => $request->input('text_comment'),
            'user_id' => Auth::user()->id,
            'advert_id' => $request->input('advert_id'),

        ]);
        return redirect('/adverts/'.$request->input('advert_id'));
    }
}
