<?php

namespace App\Http\Controllers;

use App\Models\InformationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class InformationRequestController extends Controller
{
    public function create()
    {
        return view('information-requests.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'address' => 'required|string',
            'occupation' => 'required|string|max:255',
            'identity_type' => 'required|string|in:KTP,SIM,Paspor,Lainnya',
            'identity_number' => 'required|string|max:255',
            'phone' => 'required|string|max:20|regex:/^[0-9]+$/',
            'identity_scan' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'information_details' => 'required|string',
            'purpose' => 'required|string',
            'copy_method' => 'nullable|string',
            'retrieval_method' => 'nullable|string',
        ]);

        try {
            $file = $request->file('identity_scan');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('uploads/identity_scans');

            if (!File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0777, true, true);
            }

            $file->move($destinationPath, $fileName);

            $filePath = 'uploads/identity_scans/' . $fileName;

            $infoRequest = InformationRequest::create([
                'full_name' => $validated['full_name'],
                'address' => $validated['address'],
                'occupation' => $validated['occupation'],
                'identity_type' => $validated['identity_type'],
                'identity_number' => $validated['identity_number'],
                'phone' => $validated['phone'],
                'identity_scan_path' => $filePath,
                'information_details' => $validated['information_details'],
                'purpose' => $validated['purpose'],
                'copy_method' => $validated['copy_method'] ?? null,
                'retrieval_method' => $validated['retrieval_method'] ?? null,
                'ticket_number' => InformationRequest::generateTicketNumber(),
            ]);

            return redirect()->route('information-requests.show', $infoRequest)
                ->with('success', 'Permohonan berhasil! Nomor Tiket: ' . $infoRequest->ticket_number);

        } catch (\Exception $e) {
            \Log::error('Gagal menyimpan permohonan informasi: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Gagal menyimpan permohonan. Silakan coba lagi. Error: ' . $e->getMessage());
        }
    }

    public function show(InformationRequest $informationRequest)
    {
        return view('information-requests.show', compact('informationRequest'));
    }

    public function printProof(InformationRequest $informationRequest)
    {
        return view('information-requests.print-proof', compact('informationRequest'));
    }
}
