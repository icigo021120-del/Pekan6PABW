@extends('layouts.app')

@section('content')
    <h2>Edit Laporan Banjir</h2>

    <form action="{{ route('lapor-banjir.update', $laporan) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nama_pelapor">Nama Pelapor</label>
            <input type="text" id="nama_pelapor" name="nama_pelapor"
                   value="{{ old('nama_pelapor', $laporan->nama_pelapor) }}" required>
            @error('nama_pelapor')
                <small class="error">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="no_hp">No HP</label>
            <input type="text" id="no_hp" name="no_hp" value="{{ old('no_hp', $laporan->no_hp) }}" required>
            @error('no_hp')
                <small class="error">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="lokasi">Lokasi Kejadian</label>
            <input type="text" id="lokasi" name="lokasi" value="{{ old('lokasi', $laporan->lokasi) }}" required>
            @error('lokasi')
                <small class="error">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="kecamatan">Kecamatan</label>
            <input type="text" id="kecamatan" name="kecamatan" value="{{ old('kecamatan', $laporan->kecamatan) }}" required>
            @error('kecamatan')
                <small class="error">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="tinggi_air">Tinggi Genangan Air (cm)</label>
            <input type="number" id="tinggi_air" name="tinggi_air" min="1"
                   value="{{ old('tinggi_air', $laporan->tinggi_air) }}" required>
            @error('tinggi_air')
                <small class="error">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <textarea id="keterangan" name="keterangan" rows="3">{{ old('keterangan', $laporan->keterangan) }}</textarea>
            @error('keterangan')
                <small class="error">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="status">Status Penanganan</label>
            <select id="status" name="status" required>
                @foreach (['Menunggu', 'Diproses', 'Selesai'] as $status)
                    <option value="{{ $status }}" @selected(old('status', $laporan->status) === $status)>{{ $status }}</option>
                @endforeach
            </select>
            @error('status')
                <small class="error">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label>Foto Saat Ini</label>
            @if ($laporan->foto)
                <img src="{{ asset('storage/' . $laporan->foto) }}" alt="Foto banjir" class="foto-detail">
            @else
                <p>Belum ada foto.</p>
            @endif
            <label for="foto">Ganti Foto (kosongkan jika tidak ingin mengganti)</label>
            <input type="file" id="foto" name="foto" accept="image/*">
            @error('foto')
                <small class="error">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit">Update</button>
        <a href="{{ route('lapor-banjir.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection