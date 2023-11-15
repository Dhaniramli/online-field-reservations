<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersDataController extends Controller
{
    public function index()
    {
        $items = User::where('is_admin', false)->get();

        return view('admin.usersData.index', compact('items'));
    }

    public function destroy($id)
    {
        User::destroy($id);

        return redirect('/admin/pengguna');
    }
}
