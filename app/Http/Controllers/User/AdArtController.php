<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\AdArt;
use Illuminate\Http\Request;

class AdArtController extends Controller
{
    //index
    public function index()
    {
        $AdArt = AdArt::first();

        return view('User.Tupoksi.AdArt.Index', compact('AdArt'));
    }
}
