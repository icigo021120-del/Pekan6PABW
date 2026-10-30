<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LaporBanjir - BPBD Kabupaten Bandung</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; background-color: #f4f7f6; color: #333; }
        header { background: #850000; color: white; padding: 15px 30px; text-align: center; }
        nav { background: #850000; padding: 10px 30px; }
        nav a { color: white; text-decoration: none; margin-right: 20px; font-weight: bold; }
        nav a:hover { text-decoration: underline; }
        nav button { background: transparent; color: white; padding: 0; font-size: inherit; font-weight: bold; }
        .container { max-width: 800px; margin: 30px auto; background: white; padding: 25px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .container-wide { max-width: 1100px; }
        footer { text-align: center; padding: 15px; background: #e9ecef; margin-top: 40px; font-size: 14px; color: #666; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: bold; }
        .form-group input, .form-group textarea, .form-group select { width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; font-family: inherit; font-size: 14px; }
        button { background: #850000; color: white; border: none; padding: 10px 15px; border-radius: 4px; cursor: pointer; }
        button:hover { background: #5a0000; }
        .card { background: #fff; border: 1px solid #ddd; padding: 15px; margin-bottom: 15px; border-radius: 6px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); }
        .badge { display: inline-block; padding: 4px 8px; font-size: 12px; font-weight: bold; color: white; border-radius: 4px; }
        .badge-waspada { background: #ffc107; color: #333; }
        .badge-siaga { background: #fd7e14; }
        .badge-awas { background: #dc3545; }
        .badge-menunggu { background: #6c757d; }
        .badge-diproses { background: #0d6efd; }
        .badge-selesai { background: #28a745; }
        .error { color: #dc3545; font-size: 12px; margin-top: 5px; display: block; }

        /* Tabel, tombol aksi, thumbnail */
        table { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; vertical-align: middle; font-size: 14px; }
        th { background: #f1f1f1; }
        .thumb { width: 70px; height: 70px; object-fit: cover; border-radius: 4px; }
        .foto-detail { max-width: 100%; width: 320px; border-radius: 6px; margin-bottom: 15px; }
        .btn { display: inline-block; padding: 6px 10px; border-radius: 4px; color: white; text-decoration: none; font-size: 13px; border: none; cursor: pointer; }
        .btn-info { background: #17a2b8; }
        .btn-warning { background: #ffc107; color: #333; }
        .btn-danger { background: #dc3545; }
        .btn-secondary { background: #6c757d; }
        .inline-form { display: inline; }

        /* Pagination */
        .pagination { display: flex; justify-content: center; gap: 5px; list-style: none; padding: 0; margin: 15px 0 0; }
        .page-link { display: block; padding: 6px 12px; border: 1px solid #ddd; border-radius: 4px; color: #850000; text-decoration: none; background: white; }
        .page-item.active .page-link { background: #850000; color: white; border-color: #850000; }
        .page-item.disabled .page-link { color: #aaa; }
    </style>
</head>
<body>

    <header>
        <h2>LaporBanjir</h2>
        <p>Pelaporan kejadian banjir Kabupaten Bandung</p>
    </header>

    <nav>
        <a href="{{ route('lapor-banjir.form') }}">Form Laporan</a>
        @guest
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Register</a>
        @endguest
        @auth
            <a href="{{ route('lapor-banjir.index') }}">Daftar Laporan</a>
            <a href="{{ route('profile') }}">Profil Petugas</a>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit">Logout</button>
            </form>
        @endauth
    </nav>

    <div class="container @yield('container-class')">
        {{-- Pesan berhasil dari controller (ubah dan hapus) --}}
        @if (session('success'))
            <x-alert>
                {{ session('success') }}
            </x-alert>
        @endif

        @yield('content')
    </div>

    <footer>
        &copy; 2026 BPBD Kabupaten Bandung. All rights reserved.
    </footer>

</body>
</html>