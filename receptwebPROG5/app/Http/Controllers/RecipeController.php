<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{

    public function index()
    {

        if (request('search')) {
            $recipes = Recipe::where('name', 'like', '%' . request('search') . '%')
                ->orWhere('origin', 'like', '%' . request('search') . '%')->get();
        } else {
            $recipes = Recipe::all();
        }


        return view('recipes.index', ['recipes' => $recipes]);
    }
    public function create()
    {
        $user = Auth::user();

        if (Auth::check()) {
            return view('recipes.create');
        } else{
            return redirect()->back()->with([
                'message' => 'You need to log in first.',
                'status' => 'error'
            ]);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'origin' => 'required',
            'ingredients' => 'required',
            'instructions' => 'required',
        ]);
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $recipe = new Recipe;
            $recipe->users_id = $user_id;
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
        else{
            return redirect()->back()->with([
                'message' => 'User not authenticated',
                'status' => 'Error',
            ]);
        }
    }

    public function destroy(Request $request, $id) {
        $post_check = Auth::user()->id;
        $posts_checked = Recipe::where('users_id', 'like', '%'. $post_check . '%')->get();
        $recipe = Recipe::find($id);
        if ($recipe->users_id === auth()->id() && $posts_checked->count()>=3 || Auth::user()->is_admin){
            $recipe->name = $request->input('name');
            $recipe->origin = $request->input('origin');
            $recipe->ingredients = $request->input('ingredients');
            $recipe->instructions = $request->input('instructions');
            $recipe->delete();
        }
        else{
            return redirect()->back()->with([
                'message' => 'You either dont own this post or you havent made 3 recipes yet.',
                'status' => 'success'
            ]);
        }
        return redirect()->back()->with([
            'message' => 'Recipe deleted',
            'status' => 'success'
        ]);
    }

    public function edit($id)
    {
        $post_check = Auth::user()->id;
        $posts_checked = Recipe::where('users_id', 'like', '%'. $post_check . '%')->get();
        if (Auth::user()  && $posts_checked->count()>=3) {
            $recipe = Recipe::find($id);
            return view('recipes.edit', compact('recipe'));
        } else{
            return redirect()->back()->with([
                'message' => 'You either do not own this post or you havent made 3 recipes yet.',
                'status' => 'error'
            ]);
        }

    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'origin' => 'required',
            'ingredients' => 'required',
            'instructions' => 'required',
        ]);

        $recipe = Recipe::find($id);
        if ($recipe->users_id === auth()->id() || Auth::user()->is_admin) {
            $recipe->name = $request->input('name');
            $recipe->origin = $request->input('origin');
            $recipe->ingredients = $request->input('ingredients');
            $recipe->instructions = $request->input('instructions');
            $recipe->update();
        }
        else{
            return redirect()->back()->with([
                'message' => 'You do not own this post',
                'status' => 'Error',
            ]);
        }
        return redirect()->back()->with([
            'message' => 'Recipe updated successfully!',
            'status' => 'success'
        ]);
    }
}
