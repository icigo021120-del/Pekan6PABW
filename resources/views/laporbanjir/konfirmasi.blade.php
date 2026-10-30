@extends('layouts.app')

@section('content')
    <!-- Menggunakan komponen Blade <x-alert> -->
    <x-alert>
        Laporan banjir berhasil dikirim dan ditambahkan ke sistem!
    </x-alert>

    <h2>Detail Laporan yang Dikirim</h2>

    <div class="card">
        @if (! empty($data['foto']))
            <img src="{{ asset('storage/' . $data['foto']) }}" alt="Foto banjir" class="foto-detail">
        @endif
        <p><strong>Nama Pelapor:</strong> {{ $data['nama_pelapor'] ?? '-' }}</p>
        <p><strong>Lokasi:</strong> {{ $data['lokasi'] ?? '-' }}, Kec. {{ $data['kecamatan'] ?? '-' }}</p>
        <p><strong>Tinggi Genangan:</strong> {{ $data['tinggi_air'] ?? 0 }} cm</p>

        <p>
            <strong>Tingkat:</strong>
            @if(isset($data['tinggi_air']))
                @if($data['tinggi_air'] < 30)
                    <span class="badge badge-waspada">Waspada</span>
                @elseif($data['tinggi_air'] <= 70)
                    <span class="badge badge-siaga">Siaga</span>
                @else
                    <span class="badge badge-awas">Awas</span>
                @endif
            @endif
        </p>
        <p><strong>Status Penanganan:</strong> <span class="badge badge-menunggu">Menunggu</span></p>
    </div>

    <div style="margin-top: 20px;">
        <a href="{{ route('lapor-banjir.form') }}"><button style="margin-right: 10px;">Kirim Laporan Lain</button></a>
        <a href="{{ route('lapor-banjir.index') }}"><button style="background: #28a745;">Lihat Daftar Laporan</button></a>
    </div>
@endsection