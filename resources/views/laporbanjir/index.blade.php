@extends('layouts.app')

@section('container-class', 'container-wide')

@section('content')
    <h2>Daftar Laporan Banjir</h2>
    <p>Kelola laporan banjir yang masuk dari warga.</p>
    <hr style="margin-bottom: 20px; border: 0; border-top: 1px solid #ddd;">

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Foto</th>
                <th>Pelapor</th>
                <th>Lokasi</th>
                <th>Tinggi Air</th>
                <th>Tingkat</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($laporanBanjir as $laporan)
                <tr>
                    <td>{{ $laporanBanjir->firstItem() + $loop->index }}</td>
                    <td>
                        @if ($laporan->foto)
                            <img src="{{ asset('storage/' . $laporan->foto) }}" alt="Foto banjir" class="thumb">
                        @else
                            <span>Tidak ada</span>
                        @endif
                    </td>
                    <td>{{ $laporan->nama_pelapor }}<br><small>{{ $laporan->no_hp }}</small></td>
                    <td>{{ $laporan->lokasi }}<br><small>Kec. {{ $laporan->kecamatan }}</small></td>
                    <td>{{ $laporan->tinggi_air }} cm</td>
                    <td><span class="badge badge-{{ $laporan->tingkat }}">{{ ucfirst($laporan->tingkat) }}</span></td>
                    <td><span class="badge badge-{{ strtolower($laporan->status) }}">{{ $laporan->status }}</span></td>
                    <td>
                        <a href="{{ route('lapor-banjir.show', $laporan) }}" class="btn btn-info">Lihat</a>
                        <a href="{{ route('lapor-banjir.edit', $laporan) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('lapor-banjir.destroy', $laporan) }}" method="POST" class="inline-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Yakin ingin menghapus laporan ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align: center;">Belum ada laporan banjir yang masuk.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $laporanBanjir->links() }}
@endsection