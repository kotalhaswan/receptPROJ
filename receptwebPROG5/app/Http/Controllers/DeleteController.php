<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class DeleteController extends Controller {
   public function index() {
      $recipes = DB::select('SELECT * FROM `recipes`');
      return view('recipes',['recipes'=>$recipes]);
   }
   public function destroy($id) {
      DB::delete('delete from recipes where id = ?',[$id]);
      echo "Recipe deleted successfully.<br/>";
      echo '<a href = "/delete-records">Click Here</a> to go back.';
   }
}