<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //index
    public function index()
    {
        return view('User.Profile.Index');
    }
}
