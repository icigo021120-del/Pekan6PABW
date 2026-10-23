<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class LaporBanjir extends Model
{
    use HasFactory;

    protected $table = 'lapor_banjirs';

    protected $fillable = [
        'nama',
        'kecamatan',
        'desa',
        'tinggi_genangan',
    ];
}
