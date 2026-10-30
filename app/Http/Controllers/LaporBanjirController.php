<?php

namespace App\Http\Controllers;

use App\Models\LaporBanjir;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class LaporBanjirController extends Controller
{
    // ===== Halaman publik (warga) =====

    public function form(): View
    {
        return view('laporbanjir.form');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            ...$this->aturanDasar(),
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048', // wajib, maks. 2 MB
        ]);

        // Simpan ke storage/app/public/foto_banjir, lalu simpan path-nya ke database
        $validated['foto'] = $request->file('foto')->store('foto_banjir', 'public');
        $validated['status'] = 'Menunggu';

        LaporBanjir::create($validated);

        return redirect()->route('lapor-banjir.konfirmasi')
            ->with('data', $validated);
    }

    public function konfirmasi(): View
    {
        return view('laporbanjir.konfirmasi', ['data' => session('data', [])]);
    }

    // ===== Halaman petugas (wajib login) =====

    // READ: daftar laporan dengan thumbnail dan pagination
    public function index(): View
    {
        $laporanBanjir = LaporBanjir::latest()->paginate(5);

        return view('laporbanjir.index', compact('laporanBanjir'));
    }

    // READ: detail satu laporan
    public function show(LaporBanjir $laporBanjir): View
    {
        return view('laporbanjir.show', ['laporan' => $laporBanjir]);
    }

    // UPDATE: form edit
    public function edit(LaporBanjir $laporBanjir): View
    {
        return view('laporbanjir.edit', ['laporan' => $laporBanjir]);
    }

    // UPDATE: simpan perubahan (foto baru opsional)
    public function update(Request $request, LaporBanjir $laporBanjir): RedirectResponse
    {
        $validated = $request->validate([
            ...$this->aturanDasar(),
            'status' => 'required|in:Menunggu,Diproses,Selesai',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($laporBanjir->foto) {
                Storage::disk('public')->delete($laporBanjir->foto); // hapus foto lama
            }
            $validated['foto'] = $request->file('foto')->store('foto_banjir', 'public');
        }

        $laporBanjir->update($validated);

        return redirect()->route('lapor-banjir.index')
            ->with('success', 'Laporan berhasil diperbarui.');
    }

    // DELETE: hapus file foto dan data laporan
    public function destroy(LaporBanjir $laporBanjir): RedirectResponse
    {
        if ($laporBanjir->foto) {
            Storage::disk('public')->delete($laporBanjir->foto);
        }
        $laporBanjir->delete();

        return redirect()->route('lapor-banjir.index')
            ->with('success', 'Laporan berhasil dihapus.');
    }

    // Aturan validasi yang sama untuk tambah dan ubah
    private function aturanDasar(): array
    {
        return [
            'nama_pelapor' => 'required|string|max:255',
            'no_hp'        => 'required|string|max:15',
            'lokasi'       => 'required|string|max:255',
            'kecamatan'    => 'required|string|max:100',
            'tinggi_air'   => 'required|integer|min:1|max:1000',
            'keterangan'   => 'nullable|string',
        ];
    }
}