<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\SK;
use Illuminate\Http\Request;

class SkController extends Controller
{
    //index
    public function index()
    {
        $skItems = SK::orderBy('start_year', 'desc')->get();

        return view('User.Tupoksi.SK.Index', compact('skItems'));
    }
}
