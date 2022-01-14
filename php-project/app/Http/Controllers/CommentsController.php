<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Topic;
use App\Comment;
use Auth;

class CommentsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($topicSlug)
    {
        return view('comments.create', compact('topicSlug'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $topicSlug)
    {
        $this->validate($request, [
          'body' => 'required|max:10000'
        ]);

        $comment = new Comment;
        $comment->body = $request->body;
        $comment->user_id = Auth::user()->id;
        $topic = Topic::findOrFail($topicSlug);

        $topic->comments()->save($comment);
        // redirect to last page
        $lastPage = Topic::findOrFail($topicSlug)->comments()->paginate(15)->lastPage();

        return redirect()->route('topics.show', ['id'=>$topicSlug, 'page' => (int)$lastPage]);
        
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($topicSLug, $id=1)
    {
        //$topic  = Topic::findOrFail($_GET['id']);
        $comment = Comment::find($_GET['id']);
       // if ($comment->user_id == Auth::id()) {
          return view('comments.edit', compact('comment'));
       // }
     /*   return redirect()->back();*/

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $topic  = Topic::findOrFail($_POST['topicSlug']);
        $comment = Comment::find($_POST['id']);
      //  if (!$comment->user_id == Auth::id()) {
      //    return redirect()->back();
      ///  }

        $this->validate($request, [
          'body' => 'required'
        ]);

        $comment->update($request->all());

        return redirect()->route('topics.show', ['id'=>$_POST['topicSlug'], 'page' => request('page')]);
    }
}
