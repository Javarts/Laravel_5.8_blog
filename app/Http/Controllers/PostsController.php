<?php

namespace App\Http\Controllers;

use App\Http\Requests\Posts\CreatePostRequest;
use App\Posts;
use App\Category;
use App\Http\Requests\Posts\UpdatePostRequest;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('verifyCategoriesCount')->only(['store', 'create']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index')->with('posts', Posts::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create')->with('categories', Category::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        //upload the image to storage
        $image = $request->image->store('posts');

        //create the post
        Posts::create([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'image' => $image,
            'published_at' => $request->published_at,
            'category_id' => $request->category
        ]);

        //flash a session message
        session()->flash('success', 'Post was created successfully');

        //redirect the user
        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Posts $post)
    {
        return view('posts.create')->with('post', $post)->with('categories', Category::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Posts $post)
    {
        /* the only() method is an alternative for using all() method but this time
        you can specify which data you want to collect from the database */
        $data = $request->only(['title', 'description', 'published_at', 'content', 'category_id']);

        /* check if new image */
        if ($request->hasFile('image')) {

            /* upload it */
            $image = $request->image->store('posts');

            /* delete old one */
            $post->deleteImage();

            $data['image'] = $image;
        }

        /* update attributes */
        $post->update($data);

        /* flash message */
        session()->flash('success', 'Post was successfully updated');

        /* redirect */
        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){

        $post = Posts::withTrashed()->where('id', $id)->firstOrFail();

        if ($post->trashed()) {

            /* deleting posts with the images */
            $post->deleteImage();

            $post->forceDelete();
        }else {
            $post->delete();
        }

        session()->flash('success', 'Post Deleted sucessfully');

        return redirect(route('posts.index'));
    }

    /**
     * Display a list of all trashed posts
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function trashed(){

        $trashed = Posts::onlyTrashed()->get();

        return view('posts.index')->with('posts', $trashed);
    }

    public function restore($id){

        $post = Posts::withTrashed()->where('id', $id)->firstOrFail();
         
        $post->restore();

        session()->flash('success', 'Post was successfully restored');

        return redirect()->back();
    }

}
