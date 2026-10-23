<?php

namespace App\Http\Controllers;

use App\Models\LaporBanjir;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LaporBanjirController extends Controller
{
    public function index(): View
    {
        $laporanBanjir = LaporBanjir::latest()->get();

        return view('laporbanjir.index', compact('laporanBanjir'));
    }

    public function form(): View
    {
        return view('laporbanjir.form');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'nama' => 'required|string|max:100',
            'kecamatan' => 'required|string|max:100',
            'desa' => 'required|string|max:100',
            'tinggi_genangan' => 'required|numeric|min:0',
        ]);

        LaporBanjir::create($data);

        return redirect()->route('lapor-banjir.konfirmasi')
            ->with('data', $data);
    }

    public function konfirmasi(): View
    {
        return view('laporbanjir.konfirmasi', ['data' => session('data', [])]);
    }
}
