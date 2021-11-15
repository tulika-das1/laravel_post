<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function homepage(){

        return view('home')->with(["name"=>'<h1>TULIKA</h1>',"age"=>'<h1>22</h1>']);
    }

    public function createPost(){

        return view('create-post');
    }

    public function createPostProcess(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:191',
            'description' => 'required|string|max:500',
        ]);

        // $post = new Post();
        // $post->title = $request->input('title');
        // $post->description = $request->input('description');
        // $post->save();

        Post::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'user_id' => Auth::user()->id,
        ]);

        dd('Post Saved');
    }

    public function allPosts()
    {
        $posts = Post::all();

        return view('all-posts')->with([
            'posts' => $posts
        ]);
    }

    public function singlePost(Post $post)
    {
        // $post = Post::findOrFail($id);

        return view('single-post')->with([
            'post' => $post,
        ]);
    }
     
    public function editPost(Post $post)
    {
        // dd($post->created_at->addDay()->setTime(13, 0)->format('Y-m-d | h:i:sa'));
        // dd($post->is_active);
        // $id = $post->user_id;
        // $user = User::find($id);
        $user = $post->user;
        // $name= $user->name;
        
           dd($user->email);
        return view('edit-post')->with([
            'post' => $post,
        ]);
        
    }

    public function updatePost(Post $post , Request $request)
    {
        $post->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        return redirect()->route('all-posts',['post'=>$post->id]);
        // $post->title = $request->input('title');
        // $post->description = $request->input('description');
        // $post->save();
    }

    public function home()
    {
        // $user = Auth::user()->id;
        // $user_post = Post::where('user_id', $user)->get();
        $user_post = Auth::user()->posts;

        // dd($user_post);
        return view('user-post')->with([
            'posts' => $user_post,
        ]);
        
        // dd($user->name, $user->email);
    }
}
