<?php

namespace App\Http\Controllers;

use App\Models\InformationRequest;
use App\Models\ObjectionRequestV2;
use Illuminate\Http\Request;

class UserStatusController extends Controller
{
    // Halaman index: menampilkan daftar permohonan dan keberatan dengan status completed & rejected
    public function index()
    {
        $completedRejectedInformationRequests = InformationRequest::whereIn('status', ['completed', 'rejected'])
            ->orderBy('created_at', 'desc')
            ->paginate(8, ['*'], 'info_page');

        $completedRejectedObjectionRequests = ObjectionRequestV2::whereIn('status', ['completed', 'rejected'])
            ->orderBy('created_at', 'desc')
            ->paginate(8, ['*'], 'objection_page');

        return view('user.status.index', compact('completedRejectedInformationRequests', 'completedRejectedObjectionRequests'));
    }

    // Search POST: menampilkan semua data (semua status) yang nama pemohon mengandung kata kunci
    public function search(Request $request)
    {
        $request->validate([
            'search_name' => 'required|string|max:255',
        ]);

        $searchName = $request->input('search_name');

        $informationRequests = InformationRequest::where('full_name', 'like', '%' . $searchName . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(8, ['*'], 'info_page');

        $objectionRequests = ObjectionRequestV2::where('full_name', 'like', '%' . $searchName . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(8, ['*'], 'objection_page');

        return view('user.status.search-results', compact('informationRequests', 'objectionRequests', 'searchName'));
    }

    // Detail permohonan informasi
    public function showRequest(InformationRequest $informationRequest)
    {
        return view('user.status.show-request', compact('informationRequest'));
    }

    // Detail pengajuan keberatan
    public function showObjection(ObjectionRequestV2 $objectionRequest)
    {
        return view('user.status.show-objection', compact('objectionRequest'));
    }

    // Cetak bukti permohonan
    public function printRequestProof($unique_search_id)
    {
        $informationRequest = InformationRequest::where('unique_search_id', $unique_search_id)->firstOrFail();
        return view('information-requests.print-proof', compact('informationRequest'));
    }

    // Cetak bukti keberatan
    public function printObjectionProof($unique_search_id)
    {
        $objectionRequest = ObjectionRequestV2::where('unique_search_id', $unique_search_id)->firstOrFail();
        return view('information-requests.objection-print-proof', compact('objectionRequest'));
    }
}
