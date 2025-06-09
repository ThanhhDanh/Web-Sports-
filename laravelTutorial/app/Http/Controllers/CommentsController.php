<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $comments = Comments::with(['user'])
            ->where('product_id', $request->product_id)
            ->get();
        if ($request->wantsJson()) {
            return response()->json([
                'comments' => $comments->map(function ($comment) {
                    return [
                        'comment' => $comment,
                        'user' => [
                            'id' => $comment->user->id,
                            'name' => $comment->user->name,
                            'avatar' => $comment->user->image,
                        ]
                    ];
                }),
            ]);
        }
        return view('pages.comments.comments');
    }

    /**
     * Display the specified resource.
     */
    public function show($id, Request $request)
    {
        $comment = Comments::with(['user', 'product'])->findOrFail($id);
        // Trả JSON nếu là request từ JS
        if ($request->wantsJson()) {

            return response()->json(['comment' => $comment]);
        }
        return view('pages.comments.show-comment', compact('comment'));
    }

    /**
     * Reply the specified resource.
     */
    public function reply(Request $request, Comments $comment)
    {
        $request->validate([
            'reply' => 'required|string|max:1000',
        ], [
            'reply.required' => 'Bạn chưa trả lời bình luận'
        ]);

        Comments::create([
            'description' => $request->reply,
            'user_id' => auth()->id(),
            'product_id' => $comment->product_id,
            'parent_id' => $comment->id,
            'is_reply' => true
        ]);

        return back()->with('success', 'Đã gửi phản hồi thành công!');
    }
}
