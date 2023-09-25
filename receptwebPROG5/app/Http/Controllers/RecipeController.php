<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class RecipeController extends Controller
{
    public function recipes()
    { 
        $recipes = DB::select('SELECT * FROM `recipes`');
 
        return view('recipes', ['recipes' => $recipes]);
    }
}
