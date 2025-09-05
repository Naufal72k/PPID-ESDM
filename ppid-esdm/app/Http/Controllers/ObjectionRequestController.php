<?php

namespace App\Http\Controllers;

use App\Models\ObjectionRequestV2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ObjectionRequestController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'identity_type' => 'required|string|in:KTP,SIM,Paspor,Lainnya',
            'identity_number' => 'required|string|max:255',
            'identity_scan' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'phone' => 'required|string|max:20|regex:/^[0-9]+$/',
            'reason' => 'required|string',
            'additional_info' => 'nullable|string',
        ]);

        try {
            $file = $request->file('identity_scan');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('uploads/objection_scans');

            if (!File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0777, true, true);
            }

            $file->move($destinationPath, $fileName);

            $filePath = 'uploads/objection_scans/' . $fileName;

            // Buat pengajuan keberatan terlebih dahulu
            $objectionRequest = ObjectionRequestV2::create([
                'full_name' => $validated['full_name'],
                'identity_type' => $validated['identity_type'],
                'identity_number' => $validated['identity_number'],
                'identity_scan_path' => $filePath,
                'phone' => $validated['phone'],
                'reason' => $validated['reason'],
                'additional_info' => $validated['additional_info'] ?? null,
                'ticket_number' => ObjectionRequestV2::generateTicketNumber(),
            ]);

            // Setelah model dibuat dan memiliki ID, generate unique_search_id dan simpan
            // Panggil metode baru untuk menghasilkan dan menyimpan unique_search_id
            $objectionRequest->generateAndSaveUniqueSearchId();

            $request->session()->put('objectionRequest', $objectionRequest);

            return redirect()->route('information-requests.objection.show')
                ->with('success', 'Pengajuan keberatan berhasil dikirim! Kode Unik Anda: ' . $objectionRequest->unique_search_id);

        } catch (\Exception $e) {
            \Log::error('Gagal menyimpan pengajuan keberatan: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Gagal menyimpan pengajuan keberatan. Silakan coba lagi. Error: ' . $e->getMessage());
        }
    }

    public function showFromSession(Request $request)
    {
        $objectionRequest = $request->session()->get('objectionRequest');

        if (!$objectionRequest) {
            return redirect()->route('information-requests.create')->with('error', 'Data pengajuan keberatan tidak ditemukan.');
        }

        return view('information-requests.objection-show', ['objectionRequest' => $objectionRequest]);
    }

    public function printProofFromSession(Request $request)
    {
        $objectionRequest = $request->session()->get('objectionRequest');

        if (!$objectionRequest) {
            return redirect()->route('information-requests.create')->with('error', 'Data pengajuan keberatan tidak ditemukan untuk dicetak.');
        }

        return view('information-requests.objection-print-proof', ['objectionRequest' => $objectionRequest]);
    }
}
