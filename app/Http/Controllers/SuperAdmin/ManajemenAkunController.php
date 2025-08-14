<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Activitie;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ManajemenAkunController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->q;

        $users = User::where('level', 1)
        ->when($keyword, function ($query, $keyword) {
            $query->where('name', 'like', "%$keyword%")
                ->orWhere('email', 'like', "%$keyword%");
        })->orderBy('id', 'DESC')->get();

        if ($request->ajax()) {
            return view('SuperAdmin.ManajemenAkun.Read', compact('users'))->render();
        }

        return view('SuperAdmin.ManajemenAkun.Index', compact('users'));
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
        $user = Auth::user();

        try {
            // Validasi input
            $validated = $request->validate([
                'name'     => 'required|string|max:255',
                'email'    => 'required|email|unique:users,email',
                'password' => 'required|string|min:6',
            ]);

            // Simpan ke database
            User::create([
                'name'     => $validated['name'],
                'email'    => $validated['email'],
                'password' => Hash::make($validated['password']),
                'level'    => 1,
            ]);

            Activitie::create([
                'user_id' => $user->id,
                'method' => 'store',
                'value' => $user->name . ' Menambahkan Admin: ' . $validated['name'],
            ]);

            return redirect()->back()->with('success', 'Admin berhasil ditambahkan.');
        } catch (\Exception $e) {
            // Tangani error
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
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
    public function update(Request $request, $id)
    {
        $currentUser = Auth::user(); // User yang melakukan update

        try {
            // Validasi input
            $validated = $request->validate([
                'name'     => 'required|string|max:255',
                'email'    => 'required|email|max:255|unique:users,email,' . $id,
                'password' => 'nullable|string|min:6',
            ]);

            // Ambil data user yang akan diperbarui
            $user = User::findOrFail($id);

            // Simpan data lama untuk log jika perlu
            $oldName = $user->name;

            // Update nama & email
            $user->name  = $validated['name'];
            $user->email = $validated['email'];

            // Update password jika diisi
            if (!empty($validated['password'])) {
                $user->password = Hash::make($validated['password']);
            }

            $user->save();

            // Catat aktivitas update
            Activitie::create([
                'user_id' => $currentUser->id, // Yang melakukan update
                'method' => 'update',
                'value'  => $currentUser->name . ' memperbarui akun admin: ' . $oldName . ' menjadi ' . $validated['name'],
            ]);

            return redirect()->back()->with('success', 'Admin berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui Admin: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $currentUser = Auth::user();

        try {
            $userToDelete = User::findOrFail($id);
            $deletedUserName = $userToDelete->name;

            $userToDelete->delete();

            // Catat aktivitas: siapa yang menghapus siapa
            Activitie::create([
                'user_id' => $currentUser->id, // yang melakukan
                'method' => 'delete',
                'value' => $currentUser->name . ' menghapus akun admin: ' . $deletedUserName,
            ]);

            return redirect()->back()->with('success', 'Admin berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus Admin: ' . $e->getMessage());
        }
    }
}
