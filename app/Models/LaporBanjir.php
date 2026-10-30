<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporBanjir extends Model
{
    use HasFactory;

    protected $table = 'lapor_banjirs';

    protected $fillable = [
        'nama_pelapor',
        'no_hp',
        'lokasi',
        'kecamatan',
        'tinggi_air',
        'keterangan',
        'foto',
        'status',
    ];

    // Tingkat bahaya berdasarkan tinggi genangan (sama dengan logika di halaman konfirmasi)
    protected function tingkat(): Attribute
    {
        return Attribute::get(fn (): string => match (true) {
            $this->tinggi_air < 30 => 'waspada',
            $this->tinggi_air <= 70 => 'siaga',
            default => 'awas',
        });
    }
}