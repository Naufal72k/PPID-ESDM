<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjectionRequestV2 extends Model // <-- Nama model baru
{
    use HasFactory;

    // Tambahkan baris ini untuk menentukan nama tabel (jika berbeda dari konvensi Laravel)
    protected $table = 'objection_requests_v2'; // <-- Nama tabel baru

    protected $fillable = [
        'full_name',
        'identity_type',
        'identity_number',
        'identity_scan_path',
        'phone',
        'reason',
        'additional_info',
        'status',
    ];
}
