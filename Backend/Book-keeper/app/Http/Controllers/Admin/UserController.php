<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\User;

class UserController extends Controller
{
    public  function index()
    {
        $users = User::all();
        return response()->json([
            'status' => 'success',
            'data' => $users
        ], 200);
    }
}
