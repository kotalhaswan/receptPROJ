<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{

    public function index()
    {

        if (request('search')) {
            $recipes = Recipe::where('name', 'like', '%' . request('search') . '%')->get();
        } else {
            $recipes = Recipe::all();
        }


        return view('recipes.index', ['recipes' => $recipes]);
    }

//    public function detail($id)
//    {
//        $recipe = Recipe::find($id);
//        return view('recipes.index', ['recipes' => $recipe]);
//    }

    public function create()
    {
        if (Auth::check()) {
            return view('recipes.create');
        } else{
            $this->middleware('auth');
            return "You need to be logged in to create a new recipe";
        }

//        return view('recipes.create');
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

    public function destroy($id) {
        DB::delete('delete from recipes where id = ?',[$id]); // TODO: aanpassen naar eloquent

        return redirect()->back()->with([
            'message' => 'Recipe deleted',
            'status' => 'success'
        ]);
    }

    public function edit($id)
    {
        if (Auth::check()) {
            $recipe = Recipe::find($id);
            return view('recipes.edit', compact('recipe'));
        } else{
            $this->middleware('auth');
            return "Nice try, jackass";
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

        if (Auth::user()) {
            $recipe = Recipe::find($id);
            $recipe->name = $request->input('name');
            $recipe->origin = $request->input('origin');
            $recipe->ingredients = $request->input('ingredients');
            $recipe->instructions = $request->input('instructions');
            $recipe->update();
        }
        else{
            return redirect()->back()->with([
                'message' => 'You cant edit someone elses work bruh',
                'status' => 'Error',
            ]);
        }
        return redirect()->back()->with([
            'message' => 'Recipe updated successfully!',
            'status' => 'success'
        ]);
    }
}
