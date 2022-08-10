<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Photo;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::search()
            ->when(Auth::user()->isAuthor(),fn($q)=>$q->where("user_id",Auth::id()))
            ->latest("id")
//            ->with(['category','user','photos'])
            ->paginate(30)->withQueryString();
        return $posts;
        return view('post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $links = ["post"=>route('post.index'),"create post"=>route('post.create')];
        return view('post.create',compact('links'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {

        //saving post
        $post = new Post();
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->description = $request->description;
        $post->excerpt = Str::words($request->description,50," .....");
        $post->user_id = Auth::id();
        $post->category_id = $request->category;

        if($request->hasFile('featured_image')){
            $newName = uniqid()."_featured_image.".$request->file('featured_image')->extension();
            $request->file('featured_image')->storeAs("public",$newName);
//            $request->file('featured_image')->storeAs("public",$newName,'public');
//            Storage::putFileAs("/",$request->featured_image,$newName);
//            $request->featured_image->storeAs();
            $post->featured_image = $newName;
        }

//        return $post;

        $post->save();

//        return $post;


        // saving photo
        $savedPhotos = [];
        foreach ($request->photos as $key=>$photo){
            // 1.save to storage
            $newName = uniqid()."_post_photo.".$photo->extension();
            $photo->storeAs("public",$newName);
//            Storage::putFileAs("/",$photo,$newName,'public');
            $savedPhotos[$key] = [
                "post_id" => $post->id,
                "name" => $newName
            ];
        }

//        dd($savedPhotos);

        // 2.save to db
//        $photo = new Photo();
//        $photo->post_id = $post->id;
//        $photo->name = $newName;
//        $photo->save();

        Photo::insert($savedPhotos);




        return redirect()->route('post.index')->with("status", $post->title .' is added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
//        return $post->user;
        Gate::authorize('view',$post);
        return $post;
        return view('post.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        Gate::authorize('update',$post);
        $links = ["post"=>route('post.index'),"Edit Post"=>route('post.create')];

        return view('post.edit',compact('post','links'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        if(Gate::denies('update',$post)){
            return abort(403,"U are not allowed to update");
        }

        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->description = $request->description;
        $post->excerpt = Str::words($request->description,50," .....");
        $post->user_id = Auth::id();
        $post->category_id = $request->category;

        if($request->hasFile('featured_image')){

            //delete old photo
            Storage::delete("public/".$post->featured_image);

            // update and upload new photo
            $newName = uniqid()."_featured_image.".$request->file('featured_image')->extension();
            $request->file('featured_image')->storeAs("public",$newName);
//            $request->featured_image->storeAs();
            $post->featured_image = $newName;

        }

        $post->update();

        // saving photo
        foreach ($request->photos as $photo){
            // 1.save to storage
            $newName = uniqid()."_post_photo.".$photo->extension();
            $photo->storeAs("public",$newName);

            // 2.save to db
            $photo = new Photo();
            $photo->post_id = $post->id;
            $photo->name = $newName;
            $photo->save();
        }

        return redirect()->route('post.index')->with("status", $post->title .' is updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {

        if(Gate::denies('delete',$post)){
            return abort(403,"U are not allowed to delete");
        }


//        dd($post->photos->pluck('id'));

        $postTitle = $post->title;
        if(isset($post->featured_image)){
            Storage::delete("public/".$post->featured_image);
        }

//        foreach ($post->photos as $photo){
//            //remove from storage
//            Storage::delete("public/".$photo->name);
//        }


        Storage::delete($post->photos->map(fn($photo)=>"public/".$photo->name)->toArray());

//        Photo::destroy($post->photos->pluck('id'));
        Photo::where("post_id",$post->id)->delete();


        //delete from table
//        $photo->delete();

        $post->delete();

        return redirect()->route('post.index')->with("status", $postTitle .' is deleted Successfully');

    }
}
