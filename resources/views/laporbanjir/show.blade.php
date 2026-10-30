@extends('layouts.app')

@section('content')
    <h2>Detail Laporan Banjir</h2>

    <div class="card">
        @if ($laporan->foto)
            <img src="{{ asset('storage/' . $laporan->foto) }}" alt="Foto banjir" class="foto-detail">
        @endif
        <p><strong>Pelapor:</strong> {{ $laporan->nama_pelapor }}</p>
        <p><strong>No HP:</strong> {{ $laporan->no_hp }}</p>
        <p><strong>Lokasi:</strong> {{ $laporan->lokasi }}</p>
        <p><strong>Kecamatan:</strong> {{ $laporan->kecamatan }}</p>
        <p><strong>Tinggi Genangan:</strong> {{ $laporan->tinggi_air }} cm</p>
        <p><strong>Keterangan:</strong> {{ $laporan->keterangan ?? '-' }}</p>
        <p><strong>Tingkat:</strong> <span class="badge badge-{{ $laporan->tingkat }}">{{ ucfirst($laporan->tingkat) }}</span></p>
        <p><strong>Status Penanganan:</strong> <span class="badge badge-{{ strtolower($laporan->status) }}">{{ $laporan->status }}</span></p>
        <p><small>Dilaporkan {{ $laporan->created_at->format('d-m-Y H:i') }} ({{ $laporan->created_at->diffForHumans() }})</small></p>
    </div>

    <a href="{{ route('lapor-banjir.edit', $laporan) }}" class="btn btn-warning">Edit</a>
    <form action="{{ route('lapor-banjir.destroy', $laporan) }}" method="POST" class="inline-form">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger"
                onclick="return confirm('Yakin ingin menghapus laporan ini?')">Hapus</button>
    </form>
    <a href="{{ route('lapor-banjir.index') }}" class="btn btn-secondary">Kembali</a>
@endsection