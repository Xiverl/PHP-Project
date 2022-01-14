<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Topic;
use App\Comment;
use Auth;

class TopicsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => 'show']);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($forumId, $categoryId)
    { 
        return view('topics.create', compact('forumId', 'categoryId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $forumId, $categoryId)
    {
        $this->validate($request, [
          'title' => 'required|max:50',
          'body' => 'required|max:10000',
          'g-recaptcha-response' => 'required'
        ]);

        $topic = new Topic;
        $topic->title = $request->title;
        $topic->body = $request->body;
        $topic->user_id = Auth::user()->id;
        $topic->category_id = $categoryId;
        $topic->views = 1;
        $topic->save();

        return redirect()->route('topics.show', ['id'=>$topic->id]);


    }

/* resource nested di pisah supaya url show topic nya lebih bersih */

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id=1)
    {
        if(isset($_GET['id']) && !empty($_GET['id']))
            $id = $_GET['id'];
        
		$topic = Topic::findOrFail($id);
        $topic->views += 1;
        $topic->save();
		
        $comments = Comment::where('commentable_id', '=', $id)->get();
        return view('topics.show', compact('topic', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id=1)
    {
        $topic = Topic::findOrFail($_GET['id']);;
        if ($topic->user->id == Auth::id()) {
          return view('topics.edit', compact('topic'));
        }

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id=1)
    {
        $topic = Topic::findOrFail($_POST['id']);
        if (!$topic->user->id == Auth::id()) {
          return redirect()->back();
        }

        $this->validate($request, [
            'id' => 'required',
          'title' => 'required|max:50',
          'body' => 'required|max:10000',
        ]);

        $topic->update($request->all());

        return redirect()->route('topics.show', ['id'=>$topic->id]);
    }


    public function postStar(Request $request, $slug)
    {
        $topic = Topic::findBySlug($slug);
        $validate =  $topic->ratings()->where('user_id', \Auth::id())->first();

        if (count($validate)) {
          return 'Memberi rating hanya bisa di lakukan sekali';      
        } else {
          $rating = new Rating;
          $rating->rating = $request->rating;
          $rating->user_id = \Auth::id();
          $topic->ratings()->save($rating);

          return 'Thanks for rating';
        }

    }

}
