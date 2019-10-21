<?php

namespace App\Http\Controllers;

use Session;

use App\Tag;

use App\Post;

use App\Catagory;

use Illuminate\Http\Request;

class postController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.posts.index')->with('posts',Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $catagories = Catagory::all();

        $tags = Tag::all();

        if($catagories->count() == 0 || $tags->count() == 0) 
        {
            Session::flash('info','You must have a catagory before creating a post!');
            return redirect()->back();
        }


        return view('admin.posts.create')->with('catagories',$catagories)

                                        ->with('tags', $tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
       
        $this->validate($request,[
            'title'=>'required|max:255',
            'featured'=>'required|image',
            'content'=>'required',
            'catagory_id'=>'required',
            'tags'  => 'required'
            
        ]);


        $featured = $request->featured;
        $featured_new_name = time().$featured->getClientOriginalName();
        $featured->move('uploads/posts',$featured_new_name);


        $post = Post::create([
            'title'     =>  $request->title,
            'featured'  =>  'uploads/posts/' . $featured_new_name,
            'catagory_id'  =>  $request->catagory_id,
            'content'   =>  $request->content,
            'slug'=> str_slug($request->title)
        ]);


        $post->tags()->attach($request->tags);


        Session::flash('success', 'A new post is created!');

        

        return redirect()->back();



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
    public function edit($id)
    {
        $post = Post::find($id);

        return view('admin.posts.edit')->with('post',$post)->with('catagories',Catagory::all());

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        

        $this->validate($request,[
            'title'=>'required|max:255',
            'content'=>'required',
            'catagory_id'=>'required'
            ]);

        $post = Post::find($id); 

        if($request->hasFile('featured'))
        {

            $featured = $request->featured;
            $featured_new_name = time() . $featured->getClientOriginalName();
            $featured->move('uploads/posts',$featured_new_name);

            $post->featured = 'uploads/posts/' . $featured_new_name;
        }

        $post->title = $request->title;
        $post->content = $request->content;
        $post->catagory_id = $request->catagory_id;

        $post->save();

        Session::flash('success','Post updated successfully!');

        return redirect()->route('posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        
        $post->delete();

        Session::flash('success', 'Post is trashed!');

        return redirect()->back();

    }

    public function trashed()
    {
        $posts = Post::onlyTrashed()->get();
        return view('admin.posts.trash')->with('posts', $posts);
    }


    public function kill($id)
    {
        $post = Post::withTrashed()->where('id', $id)->first();
        
        $post->forceDelete();

        Session::flash('success', 'Post deleted permanently!');

        return redirect()->back();
    }


    public function restore($id)
    {
        $post = Post::withTrashed()->where('id', $id)->first();

        $post->restore();

        Session::flash('success', 'Post successfully restored!');

        return redirect()->back();
    }

}
