<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\OrganizationalStructure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StrukturOrganisasiController extends Controller
{
    public function index(Request $request)
    {
        $periode = $request->periode;

        $periodes = OrganizationalStructure::select('start_year', 'end_year')
            ->distinct()
            ->orderByDesc('start_year')
            ->get();

        $data = collect();

        if ($periode) {
            [$start, $end] = explode('-', $periode);

            $data = OrganizationalStructure::with('category')
                ->where('start_year', $start)
                ->where('end_year', $end)
                ->get()
                ->map(function ($item) {
                    return [
                        'id'        => $item->id,
                        'full_name' => $item->full_name,
                        'position'  => $item->position,
                        'image'     => $item->image,
                        'kategori'  => strtoupper(optional($item->category)->name ?? '-'),
                    ];
                });
        }

        return view('User.Tupoksi.StrukturOrganisasi.Index', compact('data', 'periodes'));
    }
}
