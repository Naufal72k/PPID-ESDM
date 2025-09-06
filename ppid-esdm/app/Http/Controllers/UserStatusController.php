<?php

namespace App\Http\Controllers;

use App\Models\InformationRequest;
use App\Models\ObjectionRequestV2;
use Illuminate\Http\Request;

class UserStatusController extends Controller
{
    public function index()
    {
        // Ambil permohonan informasi dengan status 'completed' atau 'rejected' dengan pagination 8 per halaman
        $completedRejectedInformationRequests = InformationRequest::whereIn('status', ['completed', 'rejected'])
            ->orderBy('created_at', 'desc')
            ->paginate(8, ['*'], 'info_page');

        // Ambil pengajuan keberatan dengan status 'completed' atau 'rejected' dengan pagination 8 per halaman
        $completedRejectedObjectionRequests = ObjectionRequestV2::whereIn('status', ['completed', 'rejected'])
            ->orderBy('created_at', 'desc')
            ->paginate(8, ['*'], 'objection_page');

        return view('user.status.index', compact('completedRejectedInformationRequests', 'completedRejectedObjectionRequests'));
    }

    public function search(Request $request)
    {
        $request->validate([
            'unique_search_id' => 'required|string|max:20',
        ]);

        $uniqueSearchId = $request->input('unique_search_id');

        // Cari permohonan informasi berdasarkan unique_search_id
        $informationRequest = InformationRequest::where('unique_search_id', $uniqueSearchId)->first();

        if ($informationRequest) {
            return view('user.status.show-request', compact('informationRequest'));
        }

        // Jika tidak ditemukan, cari pengajuan keberatan
        $objectionRequest = ObjectionRequestV2::where('unique_search_id', $uniqueSearchId)->first();

        if ($objectionRequest) {
            return view('user.status.show-objection', compact('objectionRequest'));
        }

        return redirect()->route('user.status.index')->with('error', 'Kode unik tidak ditemukan.');
    }

    public function printRequestProof($unique_search_id)
    {
        $informationRequest = InformationRequest::where('unique_search_id', $unique_search_id)->first();

        if (!$informationRequest) {
            return redirect()->route('user.status.index')->with('error', 'Data permohonan tidak ditemukan untuk dicetak.');
        }

        return view('information-requests.print-proof', compact('informationRequest'));
    }

    public function printObjectionProof($unique_search_id)
    {
        $objectionRequest = ObjectionRequestV2::where('unique_search_id', $unique_search_id)->first();

        if (!$objectionRequest) {
            return redirect()->route('user.status.index')->with('error', 'Data pengajuan keberatan tidak ditemukan untuk dicetak.');
        }

        return view('information-requests.objection-print-proof', compact('objectionRequest'));
    }
}
