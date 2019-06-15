<?php

namespace SayWebSolutions\LetsBlog\Http\Controllers\Admin;

use Auth;
use Session;
use Input;
use View;
use Redirect;

use SayWebSolutions\LetsBlog\Models\Post;
use SayWebSolutions\LetsBlog\Models\Tag;
use SayWebSolutions\LetsBlog\Models\Series;

//Form Request tag validation rules
use SayWebSolutions\LetsBlog\Http\Requests\TagRequest;

use App\Http\Controllers\Controller;

class TagController extends Controller
{

  /**
  * Create a new controller instance.
  *
  * @return void
  */
    public function __construct()
    {
    }

  /**
   * Display a listing of tags
   *
   * @return Response
   */
    public function index()
    {

        $tags = Tag::orderBy('count', 'desc')->get();

        return view('letsblog::themes.master', [
        'view' => lb_view('admin.tags.index'),
        'tags' => $tags,
        ]);
    }

  /**
   * Show the form for creating a new tag
   *
   * @return Response
   */
    public function create()
    {
        return view('admin/tags/create');
    }

  /**
   * Store a newly created tag in storage.
   *
   * @param  TagRequest $request
   * @return Response
   */
    public function store(TagRequest $request)
    {

        $tag = new Tag;

        foreach (Input::except('_token') as $key => $value) {
            $tag->{$key} = $value;
        }

        $tag->user_id = Auth::user()->id;

        if ($tag->published_at > 0) {
            $tag->published_at = time($tag->published_at);
        }

        if ($tag->save()) {
            Session::flash('message', 'Successfully created tag!');
        } else {
            Session::flash('message', 'Failed to create tag!');
        }

        return Redirect::to('admin/tags');
    }

  /**
   * Display the specified tag.
   *
   * @param  int  $id
   * @return Response
   */
    public function show($id)
    {
        $tag = Tag::findOrFail($id);
        return view('admin/tags/show')->with('tag', $tag);
    }

  /**
   * Show the form for editing the specified tag.
   *
   * @param  int  $id
   * @return Response
   */
    public function edit($id)
    {

        $tag = Tag::findOrFail($id);

        $tags = ($tags = $tag->tags) ? $tags->implode('name', ',') : false;

        return view('admin/tags/edit')
        ->with('tag', $tag)
        ->with('tags', $tags)
        ;
    }

  /**
   * Update the specified tag in storage if valid based on
   *  TagRequest Form Request Validator
   *
   * @param  int  $id
   * @param  StoreTagRequest $request
   * @return Response
   */
    public function update($id, TagRequest $request)
    {

        $tag = Tag::findOrFail($id);

        $tag->name = Input::get('name');
        $tag->slug = Input::get('slug');

        if ($tag->save()) {
            Session::flash('message', 'Successfully updated tag!');
        } else {
            Session::flash('message', 'Failed to update tag!');
        }

        return Redirect::to('admin/tags');
    }

  /**
   * Remove the specified tag from storage.
   *
   * @param  int  $id
   * @return Response
   */
    public function destroy($id)
    {
        Tag::destroy($id);

        Session::flash('message', 'Tag deleted!');
        return Redirect::route('admin/tags');
    }
}
