<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Activitie;
use Illuminate\Http\Request;

class AktivitasController extends Controller
{
    //index
    public function index()
    {
        $activities = Activitie::latest()->get(); 
        return view('SuperAdmin.Aktivitas.index', compact('activities'));
    }
}
