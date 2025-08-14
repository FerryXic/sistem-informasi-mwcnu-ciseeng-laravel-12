<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Activitie;
use App\Models\Letter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ManajemenSuratController extends Controller
{
    // Tampilkan semua surat
    public function index()
    {
        $letters = Letter::latest()->get();
        return view('SuperAdmin.ManajemenSurat.Index', compact('letters'));
    }

    // Simpan surat baru
    public function store(Request $request)
    {
        try {
            $request->validate([
                'number' => 'required',
                'description' => 'required',
                'file' => 'required|mimes:pdf|max:5120',
                'type' => 'required|in:masuk,keluar',
            ]);

            $filePath = $request->file('file')->store('letters', 'public');

            Letter::create([
                'letter_number' => $request->number,
                'type' => $request->type,
                'description' => $request->description,
                'file' => basename($filePath),
            ]);

            Activitie::create([
                'user_id' => Auth::id(),
                'method' => 'store',
                'value' => Auth::user()->name . ' menambahkan surat baru bertipe: ' . $request->type,
            ]);

            return redirect()->back()->with('success', 'Surat berhasil ditambahkan.');
        } catch (\Throwable $e) {
            Log::error('Gagal menyimpan surat: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ups, terjadi kesalahan saat menyimpan surat.');
        }
    }

    // Perbarui surat
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'letter_number' => 'required',
                'description' => 'required',
                'file' => 'nullable|mimes:pdf|max:5120',
                'type' => 'required|in:masuk,keluar',
            ]);

            $letter = Letter::findOrFail($id);
            $changes = [];

            if ($request->letter_number !== $letter->letter_number) {
                $changes['letter_number'] = $request->letter_number;
            }

            if ($request->type !== $letter->type) {
                $changes['type'] = $request->type;
            }

            if ($request->description !== $letter->description) {
                $changes['description'] = $request->description;
            }

            if ($request->hasFile('file')) {
                if ($letter->file && Storage::disk('public')->exists('letters/' . $letter->file)) {
                    Storage::disk('public')->delete('letters/' . $letter->file);
                }

                $newFilePath = $request->file('file')->store('letters', 'public');
                $changes['file'] = basename($newFilePath);
            }

            if (!empty($changes)) {
                $letter->update($changes);

                Activitie::create([
                    'user_id' => Auth::id(),
                    'method'  => 'update',
                    'value'   => Auth::user()->name . ' mengupdate surat: ' . $letter->letter_number,
                ]);
            }

            return redirect()->back()->with('success', 'Surat berhasil diperbarui.');

        } catch (\Exception $e) {
            Log::error("Gagal memperbarui surat ID $id: " . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui surat.');
        }
    }

    // Hapus surat
    public function destroy($id)
    {
        try {
            $letter = Letter::findOrFail($id);

            if ($letter->file && Storage::disk('public')->exists('letters/' . $letter->file)) {
                Storage::disk('public')->delete('letters/' . $letter->file);
            }

            $letterNumber = $letter->letter_number;
            $letter->delete();

            Activitie::create([
                'user_id' => Auth::id(),
                'method' => 'delete',
                'value' => Auth::user()->name . ' menghapus surat: ' . $letterNumber,
            ]);

            return redirect()->back()->with('success', 'Surat berhasil dihapus.');
        } catch (\Throwable $e) {
            Log::error('Gagal menghapus surat ID ' . $id . ': ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus surat.');
        }
    }
}
