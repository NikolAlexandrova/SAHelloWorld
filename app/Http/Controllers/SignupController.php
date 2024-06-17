<?php

namespace App\Http\Controllers;

use App\Models\Activity;

class SignupController extends Controller
{
    public function index()
    {
        $activities = Activity::all();

        return view('signup', compact('activities'));
    }

}
