<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activitie;
use App\Models\AdArt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdArtController extends Controller
{
    //index
    public function index()
    {
        $AdArtItems = AdArt::first();

        return view('Admin.ManajemenTupoksi.AdArt.Index', compact('AdArtItems'));
    }

    //store
    public function store(Request $request)
    {
        if (AdArt::exists()) {
            return redirect()->back()->with('error', 'Data AdArt sudah tersedia. Hapus terlebih dahulu sebelum menambahkan yang baru.');
        }

        $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'pdf'    => 'required|mimes:pdf|max:5120',
        ]);

        $gambarPath = $request->file('gambar')->store('AdArt', 'public');

        $pdfPath = $request->file('pdf')->store('AdArt', 'public');

        AdArt::create([
            'gambar' => basename($gambarPath),
            'pdf'    => basename($pdfPath),
        ]);

        Activitie::create([
            'user_id' => Auth::id(),
            'method'  => 'store',
            'value'   => Auth::user()->name . ' Menambahkan AdArt',
        ]);

        return redirect()->back()->with('success', 'File AdArt berhasil diunggah.');
    }

    public function destroy(Request $request, $id)
    {
        $AdArt = AdArt::findOrFail($id);

        if ($AdArt->gambar && Storage::exists('public/AdArt/' . $AdArt->gambar)) {
            Storage::delete('public/AdArt/' . $AdArt->gambar);
        }

        if ($AdArt->pdf && Storage::exists('public/AdArt/' . $AdArt->pdf)) {
            Storage::delete('public/AdArt/' . $AdArt->pdf);
        }

        $AdArt->delete();

        Activitie::create([
                'user_id' => Auth::id(),
                'method' => 'delete',
                'value' => Auth::user()->name . ' Menghapus AdArt',
        ]);

        return redirect()->back()->with('success', 'Data AdArt berhasil dihapus.');
    }
}