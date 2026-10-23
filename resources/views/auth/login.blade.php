@extends('layouts.app')

@section('content')
    <h2>Login Petugas</h2>

    <form action="{{ route('login') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="email">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="username" required autofocus>
            @error('email')
                <small class="error">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input id="password" name="password" type="password" autocomplete="current-password" required>
            @error('password')
                <small class="error">{{ $message }}</small>
            @enderror
        </div>

        <label><input type="checkbox" name="remember" value="1"> Ingat saya</label>
        <p><button type="submit">Login</button></p>
    </form>
@endsection
