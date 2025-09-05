<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class InformationRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'address',
        'occupation',
        'identity_type',
        'identity_number',
        'phone',
        'identity_scan_path',
        'information_details',
        'purpose',
        'copy_method',
        'retrieval_method',
        'status',
        'ticket_number',
        'admin_notes',
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
        $prefix = 'PPID-' . date('Y') . '-';
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
