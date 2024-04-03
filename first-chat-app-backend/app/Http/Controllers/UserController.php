<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all(); // Misalnya, mengambil semua pengguna dari database
        return response()->json($users);
    }
}
