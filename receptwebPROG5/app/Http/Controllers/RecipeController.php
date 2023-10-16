<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class RecipeController extends Controller
{
    public function index()
    {
//        $recipes = DB::select('SELECT * FROM `recipes`');


        if (request('search')) {
            $recipes = Recipe::where('name', 'like', '%' . request('search') . '%')->get();
        } else {
            $recipes = Recipe::all();
        }


        return view('recipes.index', ['recipes' => $recipes]);
    }

    public function create()
    {
        return view('recipes.create');
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

    public function destroy($id) {
        DB::delete('delete from recipes where id = ?',[$id]); // TODO: aanpassen naar eloquent
//        echo "Recipe deleted successfully.<br/>";
//        echo '<a href = "/recipes">Click Here</a> to go back.';

        return redirect()->route('recipes.index');
    }

    public function edit($id)
    {
        $recipe = Recipe::find($id);
        return view('recipes.edit', compact('recipe'));
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
        $recipe->name = $request->input('name');
        $recipe->origin = $request->input('origin');
        $recipe->ingredients = $request->input('ingredients');
        $recipe->instructions = $request->input('instructions');
        $recipe->update();
        return redirect()->back()->with([
            'message' => 'Recipe updated successfully!',
            'status' => 'success'
        ]);
    }
}
