<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Constructor to apply 'auth' middleware to all methods in the controller
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Method to display the home page
    public function index()
    {
        // Retrieve all users except the authenticated user
        $users = User::where('id', '!=', auth()->id())->get();

        // notify()->success('Welcome Thanks For Login⚡️');
        // Return the 'home' view with the list of users
        return view('home')->with('users', $users);
    }
}
