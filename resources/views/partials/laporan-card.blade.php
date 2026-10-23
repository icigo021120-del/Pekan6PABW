<div class="card">
    <h3>Pelapor: {{ $laporan['nama'] }}</h3>
    <p><strong>Lokasi:</strong> Kec. {{ $laporan['kecamatan'] }}, Desa {{ $laporan['desa'] }}</p>
    <p><strong>Tinggi Genangan:</strong> {{ $laporan['tinggi_genangan'] }} cm</p>
    
    <p>
        <strong>Status:</strong> 
        @if($laporan['tinggi_genangan'] < 30)
            <span class="badge badge-waspada">Waspada</span>
        @elseif($laporan['tinggi_genangan'] <= 70)
            <span class="badge badge-siaga">Siaga</span>
        @else
            <span class="badge badge-awas">Awas</span>
        @endif
    </p>
</div>