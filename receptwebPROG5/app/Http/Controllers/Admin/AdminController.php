<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
            $users = User::all();
        return view('admin', ['users' => $users]);
    }

    public function enable($id){
        $users = User::find($id);
        $users->is_enabled = $users->is_enabled === 1 ? 0 : 1;
        $users->save();
        return redirect()->back()->with([
            'message' => 'User updated',
            'status' => 'success'
        ]);
    }

    protected function majorenable(){
        User::where('is_enabled', 1)
            ->update(['is_enabled' => 0]);

            return redirect()->back()->with([
                'message' => 'All users disabled',
                'status' => 'success'
            ]);

    }
}
