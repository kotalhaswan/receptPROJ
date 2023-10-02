<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Post;
class PostController extends Controller
{
    public function index()
    {
        return view('add-recipe-post-form');
    }
    public function store(Request $request)
    {
        $post = new Post;
        $post->name = $request->name;
        $post->origin = $request->origin;
        $post->ingredients = $request->ingredients;
        $post->instructions = $request->instructions;
        $post->save();
        return redirect('add-recipe-post-form')->with('status', 'Recipe has been made!');
    }
}