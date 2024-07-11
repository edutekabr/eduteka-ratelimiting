<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::select('id', 'name', 'email')->get();

        return response([
            'status' => 'success',
            'data' => [
                'users' => $users
            ]
        ], 200);
    }
}
