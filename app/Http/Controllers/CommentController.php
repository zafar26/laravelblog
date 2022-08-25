<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;

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
    public function create(Request $request)
    {
        //
        $formFields = $request->validate([
            'message' => 'required',
        ]);
        $formFields['user_id'] = auth()->id();
        $formFields['listing_id'] = $request->query('listingId');

        // dd($formFields);

        Comment::create($formFields);
        return redirect('/')->with('message', 'Comment Added successfully!');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCommentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCommentRequest $request)
    {
        //
        dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCommentRequest  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        // dd($request->isMethod('put'));
        // Make sure logged in user is owner
        // if($comment->user_id != auth()->id()) {
        //     abort(403, 'Unauthorized Action');
        // }
        
        $formFields = $request->validate([
            'message' => 'required',
            // 'listing_id' => 'required',
        ]);
        $formFields['user_id'] = auth()->id();

        $comment->update($formFields);

        return back()->with('message', 'Comment updated successfully!');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
        // if($comment->user_id != auth()->id()) {
        //     abort(403, 'Unauthorized Action');
        // }
        
        $comment->delete();
        return redirect('/')->with('message', 'Comment deleted successfully');
    
    }
}
