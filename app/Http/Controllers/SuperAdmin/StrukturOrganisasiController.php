<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\OrganizationalStructure;
use App\Models\CategoryOs;
use App\Models\Activitie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class StrukturOrganisasiController extends Controller
{
    // INDEX
    public function index(Request $request)
    {
        $positionOrder = [
            1 => ['Ketua', 'Wakil Ketua', 'Sekretaris', 'Wakil Sekretaris', 'Bendahara', 'Wakil Bendahara'],  // Tanfiziyah
            2 => ['Rois Syuriah', 'Wakil Rois', 'Katib Syuriah', 'Wakil Katib'], // Syuriah
            3 => ['Mustasyar Utama', 'Anggota Mustasyar'],                      // Mustasyar
            4 => ['Anggota'],                                                  // Awan
        ];

        // Ambil semua data struktur organisasi dengan relasi kategori
        $so = OrganizationalStructure::with('category')->get();

        // Urutkan berdasarkan kategori lalu jabatan
        $so = $so->sortBy(function ($item) use ($positionOrder) {
            $categoryId = $item->category_id;
            $position = $item->position;

            $categorySort = ($categoryId == 1) ? 0 : $categoryId;
            $positionSort = array_search($position, $positionOrder[$categoryId] ?? []) ?? 999;

            return $categorySort . '.' . $positionSort;
        })->values();

        // Filter berdasarkan periode jika ada
        if ($request->has('periode') && $request->periode) {
            [$start, $end] = explode(' - ', $request->periode);
            $so = $so->filter(function ($item) use ($start, $end) {
                return $item->start_year == $start && $item->end_year == $end;
            })->values();
        }

        // Kelompokkan berdasarkan periode
        $groupedByPeriode = $so->groupBy(function ($item) {
            return "{$item->start_year} - {$item->end_year}";
        });

        // Sortir periode agar yang terbaru muncul di atas
        $groupedByPeriode = $groupedByPeriode->sortByDesc(function ($items, $periode) {
            // Ambil tahun awal dari format "2020 - 2025"
            $startYear = intval(explode(' - ', $periode)[0]);
            return $startYear;
        });

        // Buat daftar periode unik untuk filter dropdown
        $availablePeriods = $so->map(function ($item) {
            return "{$item->start_year} - {$item->end_year}";
        })->unique()->sortDesc()->values();

        // Ambil semua kategori
        $categories = CategoryOs::all();

        // Ambil posisi yang sudah dipakai per kategori
        $usedPositions = OrganizationalStructure::select('position', 'category_id', 'start_year', 'end_year')
            ->get()
            ->groupBy(function ($item) {
                return optional($item->category)->name;
            })
            ->map(function ($group) {
                return $group->pluck('position')->unique()->values()->all();
            });

        return view('SuperAdmin.ManajemenTupoksi.StrukturOrganisasi.Index', compact(
            'groupedByPeriode',
            'categories',
            'usedPositions',
            'availablePeriods'
        ));
    }


    // STORE
    public function store(Request $request)
    {
        $request->validate([
            'full_name'      => 'required|string|max:255',
            'category_os_id' => 'required|exists:category_os,id',
            'start_year'     => 'required|integer',
            'end_year'       => 'required|integer|gte:start_year',
            'jabatan'        => 'nullable|string|max:100',
            'foto'           => 'nullable|image|max:2048',
        ]);

        try {
            $jabatan   = strtolower($request->jabatan);
            $kategori  = $request->category_os_id;
            $startYear = $request->start_year;
            $endYear   = $request->end_year;

            // Cek duplikasi jabatan penting
            if (in_array($jabatan, ['ketua', 'rois syuriah'])) {
                $cekDuplikat = OrganizationalStructure::where('position', $request->jabatan)
                    ->where('category_id', $kategori)
                    ->where('start_year', $startYear)
                    ->where('end_year', $endYear)
                    ->exists();

                if ($cekDuplikat) {
                    return redirect()->back()->with('error', 'Jabatan ' . $request->jabatan . ' sudah terdaftar untuk periode ini.');
                }
            }

            $data = [
                'full_name'   => $request->full_name,
                'position'    => $request->jabatan,
                'category_id' => $kategori,
                'start_year'  => $startYear,
                'end_year'    => $endYear,
            ];

            // Upload foto jika ada
            if ($request->hasFile('foto')) {
                $data['image'] = $request->file('foto')->store('struktur-foto', 'public');
            }

            $struktur = OrganizationalStructure::create($data);

            Activitie::create([
                'user_id' => Auth::id(),
                'method'  => 'store',
                'value'   => Auth::user()->name . ' menambahkan anggota struktur: ' . $request->full_name,
            ]);

            return redirect()->back()->with('success', 'Struktur Organisasi berhasil ditambahkan.');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan struktur organisasi.');
        }
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $request->validate([
            'full_name'   => 'required|string|max:255',
            'category_id' => 'required|exists:category_os,id',
            'position'    => 'nullable|string|max:100',
            'start_year'  => 'required|integer',
            'end_year'    => 'required|integer|gte:start_year',
            'foto'        => 'nullable|image|max:2048',
        ]);

        try {
            $struktur = OrganizationalStructure::findOrFail($id);

            $data = [
                'full_name'   => $request->full_name,
                'category_id' => $request->category_id,
                'position'    => $request->position ?? '-',
                'start_year'  => $request->start_year,
                'end_year'    => $request->end_year,
            ];

            // Handle update foto
            if ($request->hasFile('foto')) {
                // Hapus file lama
                if ($struktur->image && Storage::disk('public')->exists($struktur->image)) {
                    Storage::disk('public')->delete($struktur->image);
                }

                // Simpan file baru
                $data['image'] = $request->file('foto')->store('struktur-foto', 'public');
            }

            $struktur->update($data);

            Activitie::create([
                'user_id' => Auth::id(),
                'method'  => 'update',
                'value'   => Auth::user()->name . ' mengupdate struktur organisasi: ' . $request->full_name,
            ]);

            return redirect()->back()->with('success', 'Struktur Organisasi berhasil diperbarui.');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui data.');
        }
    }



    // DESTROY
    public function destroy($id)
    {
        try {
            $struktur = OrganizationalStructure::findOrFail($id);
            $nama     = $struktur->full_name;

            // Hapus file foto jika ada
            if ($struktur->image && Storage::disk('public')->exists($struktur->image)) {
                Storage::disk('public')->delete($struktur->image);
            }

            $struktur->delete();

            Activitie::create([
                'user_id' => Auth::id(),
                'method'  => 'delete',
                'value'   => Auth::user()->name . ' menghapus struktur organisasi: ' . $nama,
            ]);

            return redirect()->back()->with('success', 'Struktur organisasi berhasil dihapus.');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data.');
        }
    }
}
