<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the home page with the first user.
     */
    public function index(): View
    {
        // Retrieve the first user from the database
        $user = User::first();

        // Pass the user to the view
        return view('welcome', ['user' => $user]);
    }
}
