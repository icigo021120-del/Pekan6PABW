@extends('layouts.app')

@section('content')
    <div class="card" style="border: none; box-shadow: none; padding: 0;">
        {{-- enctype wajib ada agar file foto ikut terkirim --}}
        <form action="{{ route('lapor-banjir.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="nama_pelapor">Nama Pelapor</label>
                <input type="text" id="nama_pelapor" name="nama_pelapor" placeholder="Masukkan nama Anda"
                       value="{{ old('nama_pelapor') }}" required>
                @error('nama_pelapor')
                    <small class="error">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="no_hp">No HP</label>
                <input type="text" id="no_hp" name="no_hp" placeholder="Contoh: 081234567890"
                       value="{{ old('no_hp') }}" required>
                @error('no_hp')
                    <small class="error">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="lokasi">Lokasi Kejadian</label>
                <input type="text" id="lokasi" name="lokasi" placeholder="Contoh: Jl. Raya Baleendah, RT 02/RW 05"
                       value="{{ old('lokasi') }}" required>
                @error('lokasi')
                    <small class="error">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="kecamatan">Kecamatan</label>
                <input type="text" id="kecamatan" name="kecamatan" placeholder="Contoh: Baleendah"
                       value="{{ old('kecamatan') }}" required>
                @error('kecamatan')
                    <small class="error">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="tinggi_air">Tinggi Genangan Air (cm)</label>
                <input type="number" id="tinggi_air" name="tinggi_air" placeholder="Contoh: 50" min="1"
                       value="{{ old('tinggi_air') }}" required>
                @error('tinggi_air')
                    <small class="error">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="keterangan">Keterangan (opsional)</label>
                <textarea id="keterangan" name="keterangan" rows="3">{{ old('keterangan') }}</textarea>
                @error('keterangan')
                    <small class="error">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="foto">Foto Bukti (jpg, jpeg, png - maks. 2 MB)</label>
                <input type="file" id="foto" name="foto" accept="image/*" required>
                @error('foto')
                    <small class="error">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit">
                Kirim Laporan
            </button>
        </form>
    </div>
@endsection