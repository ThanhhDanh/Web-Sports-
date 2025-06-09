<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManagementUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view('pages.users.management-user');
    }
}
