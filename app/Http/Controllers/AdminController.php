<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::whereHas('role', fn ($q) => $q->where('id', '<>', Role::ROLE_ADMIN))->with('role:id,name')->withCount('referrers')->paginate(15);
        // ddd($users);
        return view('admin.index', compact('users'));
    }

    public function make_affiliated_user()
    {

        $users = User::where('role_id', Role::ROLE_GENERAL)->select(['id', 'name'])->get();
        return view('admin.make_aff', compact('users'));
    }

    public function change_role(Request $request)
    {
        User::where('id', $request->selected_id)->update([
            'role_id' => Role::ROLE_AFFILIATOR
        ]);
        return redirect()->back();
    }
}
