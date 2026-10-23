@extends('layouts.app')

@section('content')
    <!-- Menggunakan komponen Blade <x-alert> -->
    <x-alert>
        Laporan banjir berhasil dikirim dan ditambahkan ke sistem!
    </x-alert>

    <h2>Detail Laporan yang Dikirim</h2>
    
    <div class="card">
        <p><strong>Nama Pelapor:</strong> {{ $data['nama'] ?? '-' }}</p>
        <p><strong>Lokasi:</strong> Kec. {{ $data['kecamatan'] ?? '-' }}, Desa {{ $data['desa'] ?? '-' }}</p>
        <p><strong>Tinggi Genangan:</strong> {{ $data['tinggi_genangan'] ?? 0 }} cm</p>
        
        <p>
            <strong>Status:</strong> 
            @if(isset($data['tinggi_genangan']))
                @if($data['tinggi_genangan'] < 30)
                    <span class="badge badge-waspada">Waspada</span>
                @elseif($data['tinggi_genangan'] <= 70)
                    <span class="badge badge-siaga">Siaga</span>
                @else
                    <span class="badge badge-awas">Awas</span>
                @endif
            @endif
        </p>
    </div>

    <div style="margin-top: 20px;">
        <a href="{{ route('lapor-banjir.form') }}"><button style="margin-right: 10px;">Kirim Laporan Lain</button></a>
        <a href="{{ route('lapor-banjir.index') }}"><button style="background: #28a745;">Lihat Daftar Laporan</button></a>
    </div>
@endsection