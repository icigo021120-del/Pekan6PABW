@extends('layouts.app')

@section('content')
    <h2>Daftar Laporan Banjir Terkini</h2>
    <p>Berikut adalah beberapa laporan kejadian banjir yang tercatat:</p>
    <hr style="margin-bottom: 20px; border: 0; border-top: 1px solid #ddd;">

    @if(session('success'))
        <x-alert>
            {{ session('success') }}
        </x-alert>
    @endif

    @forelse($laporanBanjir as $laporan)
        @include('partials.laporan-card', ['laporan' => $laporan])
    @empty
        <p>Belum ada laporan banjir yang masuk.</p>
    @endforelse
@endsection