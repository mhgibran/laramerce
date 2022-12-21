<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('pages.user', [
            'title' => 'User List - Laramerce',
            'users' => User::withCount(['transaction'])->isCustomer()->get()
        ]);
    }
}
