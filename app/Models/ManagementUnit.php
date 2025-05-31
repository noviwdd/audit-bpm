<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManagementUnit extends Model
{
    use HasFactory;

    protected $fillable = [
        'target',
        'realisasi',
        'target_waktu_pelaksanaan',
        'realisasi_waktu_pelaksanaan',
        'dokumen',
        'evaluasi_tidak_terpenuhi',
        'evaluasi_terpenuhi',
        'evaluasi_terlampaui',
        'catatan'
    ];
}
