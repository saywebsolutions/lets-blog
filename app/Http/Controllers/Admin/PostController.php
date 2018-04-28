<?php

namespace SayWebSolutions\LetsBlog\Http\Controllers\Admin;

use SayWebSolutions\LetsBlog\Models\Post;
use SayWebSolutions\LetsBlog\Models\Tag;
use SayWebSolutions\LetsBlog\Models\Series;

//Form Request post validation rules
use SayWebSolutions\LetsBlog\Http\Requests\StorePostRequest;

use Illuminate\Support\Facades\Session;
use Illuminate\Routing\Controller;

class PostController extends Controller {

  /**
  * Create a new controller instance.
  *
  * @return void
  */
  public function __construct()
  {
  }

  /**
   * Display a listing of posts
   *
   * @return Response
   */
  public function index()
  {

    $posts = Post::orderBy('created_at', 'desc')->get();

    return view('letsblog::themes.master', [
      'view' => lb_view('admin.posts.index'),
      'posts' => $posts,
    ]);

  }

  /**
   * Show the form for creating a new post
   *
   * @return Response
   */
  public function create()
  {

    return view('letsblog::themes.master', [
      'view' => lb_view('admin.posts.create'),
      'types' => Post::getAllTypes()
    ]);

  }

  /**
   * Store a newly created post in storage.
   *
   * @param  StorePostRequest $request
   * @return Response
   */
  public function store(StorePostRequest $request)
  {

    $post = new Post;

    foreach($request->except('_token') as $key => $value)
    {
      $post->{$key} = $value;
    }

    $post->user_id = Auth::user()->id;

    if($post->published_at > 0)
    {
      $post->published_at = time($post->published_at);
    }

    if($post->save())
    {
      Session::flash('message', 'Successfully created post!');
    }
    else
    {
      Session::flash('message', 'Failed to create post!');
    }

    return Redirect::to('admin/posts/' . $post->id . '/edit');

  }

  /**
   * Display the specified post.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {

    return view('admin/posts/show')
      ->with('post', Post::findOrFail($id))
      ->with('types', Post::getAllTypes())
    ;

  }

  /**
   * Show the form for editing the specified post.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {

    $post = Post::findOrFail($id);

    $tags = ($tags = $post->tags) ? $tags->implode('name', ',') : false;

    return view('letsblog::themes.master', [
      'view' => lb_view('admin.posts.edit'),
      'post' => $post,
      'tags' => $tags,
      'types' => Post::getAllTypes(),
    ]);

  }

  /**
   * Update the specified post in storage if valid based on
   *  StorePostRequest Form Request Validator
   *
   * @param  int  $id
   * @param  StorePostRequest $request
   * @return Response
   */
  public function update($id, StorePostRequest $request)
  {

    $post = Post::findOrFail($id);

    $post->title = $request->get('title');
    $post->slug = $request->get('slug');
    $post->keywords = $request->get('keywords');
    $post->meta = $request->get('meta');
    $post->type = $request->get('type');
    $post->body = $request->get('body');
    $post->published_at = $request->get('published_at', null);

    $tags = $request->get('tags', null);

    \SayWebSolutions\LetsBlog\Parser\Field\Tags::handle('Tags', $tags, $post);
    Tag::updateCounts();

    if( ! empty($post->published_at) AND ! is_null($post->published_at)) {
      $post->published_at = strtotime($post->published_at);
    }

    if($post->save()) {
      Session::flash('message', 'Successfully updated post!');
    } else {
      Session::flash('message', 'Failed to update post!');
    }

    return Redirect::to('admin/posts/' . $post->id . '/edit');

  }

  /**
   * Remove the specified post from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    Post::destroy($id);

    Session::flash('message', 'Post deleted!');
    return Redirect::route('admin/posts');

  }

}
