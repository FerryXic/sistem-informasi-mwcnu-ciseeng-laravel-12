<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Letter;
use Illuminate\Http\Request;

class SuratController extends Controller
{
    //index
    public function index($tipe)
    {
        // ambil data lewat model
        $surat = Letter::where('type', $tipe)->get();

        return view('User.Surat.Index', compact('surat'));
    }
}
