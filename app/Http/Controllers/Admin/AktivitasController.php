<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activitie;
use Illuminate\Http\Request;

class AktivitasController extends Controller
{
    //index
    public function index()
    {
        $activities = Activitie::latest()->get(); 
        return view('Admin.Aktivitas.index', compact('activities'));
    }
}
