<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Recipe;
class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('add-recipe-post-form');
    }

    public function store(Request $request)
    {   
        $request->validate([
            'name' => 'required',
            'origin' => 'required',
            'ingredients' => 'required',
            'instructions' => 'required',
        ]);

        $recipe = new Recipe;
        $recipe->name = $request->input('name');
        $recipe->origin = $request->input('origin');
        $recipe->ingredients = $request->input('ingredients');
        $recipe->instructions = $request->input('instructions');
        $recipe->save();

        return redirect()->back()->with([
            'message' => 'Recipe added successfully!', 
            'status' => 'success'
        ]);
    }
}