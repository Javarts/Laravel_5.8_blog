<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Http\Requests\Tags\CreateTagRequest;
use App\Http\Requests\Tags\UpdateTagsRequest;

class TagsController extends Controller
{
    
    public function index(){
        return view('tags.index')->with('tags', Tag::all());
    }


    public function create(){
        return view('tags.create');
    }

    
    public function store(CreateTagRequest $request){
        Tag::create([
            'name' => $request->name
        ]);

        session()->flash('success', 'Tag created successfully');
        return redirect(route('tags.index'));
    }


    public function show($id){

    }


    public function edit(Tag $tag){
        return view('tags.create')->with('tag', $tag);
    }

   
    public function update(UpdateTagsRequest $request, Tag $tag){
        $tag->update([
            'name' => $request->name
        ]);

        $tag->save();

        session()->flash('success', 'Tag was successfully Updated');
        return redirect(route('tags.index'));
    }


    public function destroy(Tag $tag){
        $tag->delete();

        session()->flash('success', 'Tag deleted successfully');

        return redirect(route('tags.index'));
    }
}
