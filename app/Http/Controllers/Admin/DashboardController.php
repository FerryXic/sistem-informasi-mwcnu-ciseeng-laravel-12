<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activitie;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users   = User::where('level', 1)->count();
        $artikel = Post::where('category', 'article')->count();
        $berita  = Post::where('category', 'news')->count();

        $store   = Activitie::where('method', 'store')->latest()->first();
        $update  = Activitie::where('method', 'update')->latest()->first();
        $delete  = Activitie::where('method', 'delete')->latest()->first();

        return view('Admin.Dashboard.Index', compact(
            'users',
            'artikel',
            'berita',
            'store',
            'update',
            'delete'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
