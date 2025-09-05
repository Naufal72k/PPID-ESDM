<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class ObjectionRequestV2 extends Model
{
    use HasFactory;

    protected $table = 'objection_requests_v2';

    protected $fillable = [
        'full_name',
        'identity_type',
        'identity_number',
        'identity_scan_path',
        'phone',
        'reason',
        'additional_info',
        'status',
        'admin_notes',
        'ticket_number',
        // Hapus 'unique_search_id' dari fillable
    ];

    // Hapus accessor getUniqueSearchIdAttribute
    // public function getUniqueSearchIdAttribute()
    // {
    //     $encrypted = Crypt::encryptString($this->id . '-' . $this->ticket_number);
    //     return substr(str_replace(['/', '+', '='], '', base64_encode($encrypted)), 0, 20);
    // }

    // Generate nomor tiket otomatis
    public static function generateTicketNumber()
    {
        $prefix = 'OBJECTION-' . date('Y') . '-';
        $latest = self::where('ticket_number', 'like', $prefix . '%')
            ->orderBy('ticket_number', 'desc')
            ->first();

        $number = $latest ? (int) str_replace($prefix, '', $latest->ticket_number) + 1 : 1;
        return $prefix . str_pad($number, 4, '0', STR_PAD_LEFT);
    }

    // Tambahkan metode untuk menghasilkan unique_search_id setelah model disimpan
    public function generateAndSaveUniqueSearchId()
    {
        // Pastikan model sudah memiliki ID
        if (!$this->id) {
            throw new \Exception("Model must have an ID to generate unique_search_id.");
        }
        $encrypted = Crypt::encryptString($this->id . '-' . $this->ticket_number);
        $this->unique_search_id = substr(str_replace(['/', '+', '='], '', base64_encode($encrypted)), 0, 20);
        $this->save();
    }
}
