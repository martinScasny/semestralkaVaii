<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function MongoDB\BSON\toJSON;

class PostController extends Controller
{
    public function __construct()
    {
    
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $post = DB::table('posts')->orderBy('created_at', 'DESC')->get();

        return view('news.index', ['posts' => $post]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
       return view('news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'title' => 'required|max:100',
            'text' => 'required',
            'image' => 'required|image',
        ]);

        $imagePath = request('image')->store('uploads','public');

        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200,500);
        $image->save();

        \App\Models\Post::create([
            'title' => $data['title'],
            'text' => $data['text'],
            'image' => $imagePath,
        ]);

        return redirect('/news/index');
    }


    public function show($id)
    {

    }


    public function edit(Post $post)
    {
        return view('news.edit',compact('post'));
    }


    public function update(Request $request, $id)
    {
        $data = request()->validate([
            'title' => 'required|max:100',
            'text' => 'required',
            'image' => 'required|image',
        ]);
        $oldPath = Post::find($id)['image'];

        $imagePath = request('image')->store('uploads','public');
        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200,500);
        $image->save();

        Storage::delete('public/' . $oldPath);

        Post::find($id)->update([
            'title' => $data['title'],
            'text' => $data['text'],
            'image' => $imagePath,
        ]);
        return redirect('/news/index');
    }


    public function destroy(Post $post)
    {
        $oldPath = Post::find($post->id)['image'];
        Storage::delete('public/' . $oldPath);
        $post->delete();
        return redirect()->route('news');
    }
}
