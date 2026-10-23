@extends('layouts.app')

@section('content')
    <h2>Register Petugas</h2>

    <form action="{{ route('register') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Nama</label>
            <input id="name" name="name" type="text" value="{{ old('name') }}" autocomplete="name" required>
            @error('name')
                <small class="error">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required>
            @error('email')
                <small class="error">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input id="password" name="password" type="password" autocomplete="new-password" required>
            @error('password')
                <small class="error">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation">Konfirmasi Password</label>
            <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required>
        </div>

        <button type="submit">Register</button>
    </form>
@endsection
