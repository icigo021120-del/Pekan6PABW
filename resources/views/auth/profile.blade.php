@extends('layouts.app')

@section('content')
    <h2>Profil Petugas</h2>

    <div class="card">
        <p><strong>Nama:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Akun dibuat:</strong> {{ $user->created_at->format('d-m-Y H:i') }}</p>
    </div>
@endsection
