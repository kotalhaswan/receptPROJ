<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile');
    }

    public function update(User $user, Request $request)
    {
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'updated_at' => now()
        ]);

        return redirect()->back()->with([
            'message' => 'Profile updated successfully',
            'status' => 'success'
        ]);
    }
}
