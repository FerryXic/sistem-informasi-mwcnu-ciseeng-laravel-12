<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activitie;
use App\Models\SK;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SkController extends Controller
{
    //index
    public function index()
    {
        $skItems = SK::orderByDesc('start_year')->get();

        return view('Admin.ManajemenTupoksi.SK.Index', compact('skItems'));
    }

    //store
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'start_year' => 'required|integer|min:2000|max:2100',
            'end_year'   => 'required|integer|min:2000|max:2100|gte:start_year',
            'gambar'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'pdf'        => 'required|mimes:pdf|max:5120',
        ]);

        // Konversi tahun ke timestamp (sesuai skema DB)
        $startTimestamp = Carbon::createFromDate($request->start_year, 1, 1)->startOfDay();
        $endTimestamp   = Carbon::createFromDate($request->end_year, 12, 31)->endOfDay();

        // Cek apakah sudah ada data dengan periode yang sama
        $alreadyExists = SK::whereDate('start_year', $startTimestamp->toDateString())
            ->whereDate('end_year', $endTimestamp->toDateString())
            ->exists();

        if ($alreadyExists) {
            return redirect()->back()->with('error', 'Data SK untuk periode tersebut sudah tersedia.');
        }

        // Upload file
        $gambarPath = $request->file('gambar')->store('sk', 'public');
        $pdfPath    = $request->file('pdf')->store('sk', 'public');

        // Simpan ke DB
        SK::create([
            'gambar'     => basename($gambarPath),
            'pdf'        => basename($pdfPath),
            'start_year' => $startTimestamp,
            'end_year'   => $endTimestamp,
        ]);

        // Log aktivitas
        Activitie::create([
            'user_id' => Auth::id(),
            'method'  => 'store',
            'value'   => Auth::user()->name . ' Menambahkan SK (' . $request->start_year . ' - ' . $request->end_year . ')',
        ]);

        return redirect()->back()->with('success', 'File SK berhasil diunggah.');
    }

    public function destroy(Request $request, $id)
    {
        $sk = SK::findOrFail($id);

        if ($sk->gambar && Storage::exists('public/sk/' . $sk->gambar)) {
            Storage::delete('public/sk/' . $sk->gambar);
        }

        if ($sk->pdf && Storage::exists('public/sk/' . $sk->pdf)) {
            Storage::delete('public/sk/' . $sk->pdf);
        }

        $sk->delete();

        Activitie::create([
                'user_id' => Auth::id(),
                'method' => 'delete',
                'value' => Auth::user()->name . ' Menghapus SK',
        ]);

        return redirect()->back()->with('success', 'Data SK berhasil dihapus.');
    }
}