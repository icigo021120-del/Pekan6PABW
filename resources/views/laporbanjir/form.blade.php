@extends('layouts.app')

@section('content')
    <div class="card" style="border: none; box-shadow: none; padding: 0;">
        <form action="{{ route('lapor-banjir.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="nama">Nama Pelapor</label>
                <input
                    type="text"
                    id="nama"
                    name="nama"
                    placeholder="Masukkan nama Anda"
                    value="{{ old('nama') }}"
                    required
                >
                @error('nama')
                    <small class="error">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="kecamatan">Kecamatan</label>
                <input
                    type="text"
                    id="kecamatan"
                    name="kecamatan"
                    placeholder="Contoh: Baleendah"
                    value="{{ old('kecamatan') }}"
                    required
                >
                @error('kecamatan')
                    <small class="error">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="desa">Desa</label>
                <input
                    type="text"
                    id="desa"
                    name="desa"
                    placeholder="Masukkan nama desa"
                    value="{{ old('desa') }}"
                    required
                >
                @error('desa')
                    <small class="error">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="tinggi_genangan">Tinggi Genangan Air (cm)</label>
                <input
                    type="number"
                    id="tinggi_genangan"
                    name="tinggi_genangan"
                    placeholder="Contoh: 50"
                    min="0"
                    value="{{ old('tinggi_genangan') }}"
                    required
                >
                @error('tinggi_genangan')
                    <small class="error">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit">
                Kirim Laporan
            </button>
        </form>
    </div>
@endsection