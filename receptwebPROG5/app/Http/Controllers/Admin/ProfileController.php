<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Recipe;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile');
    }

    public function update(User $user, Request $request)
    {
        $post_check = Auth::user()->id;
        $posts_checked = Recipe::where('users_id', 'like', '%'. $post_check . '%')->get();
        if ($posts_checked->count()>=3 || Auth::user()->is_admin) {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'updated_at' => now()
            ]);

        } else{
            return redirect()->back()->with([
                'message' => 'You havent made 3 recipes yet.',
                'status' => 'error'
            ]);
        }
        return redirect()->back()->with([
            'message' => 'Profile updated successfully',
            'status' => 'success'
        ]);
    }
}
