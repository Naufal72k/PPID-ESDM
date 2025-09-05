<?php

namespace App\Http\Controllers;

use App\Models\InformationRequest;
use App\Models\ObjectionRequestV2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class AdminDashboardController extends Controller
{

    public function dashboard()
    {
        $totalRequests = InformationRequest::count();
        $pendingRequests = InformationRequest::where('status', 'pending')->count();
        $processedRequests = InformationRequest::where('status', 'processed')->count();
        $completedRequests = InformationRequest::where('status', 'completed')->count();
        $rejectedRequests = InformationRequest::where('status', 'rejected')->count();

        $totalObjections = ObjectionRequestV2::count();
        $pendingObjections = ObjectionRequestV2::where('status', 'pending')->count();
        $processedObjections = ObjectionRequestV2::where('status', 'processed')->count();
        $completedObjections = ObjectionRequestV2::where('status', 'completed')->count();
        $rejectedObjections = ObjectionRequestV2::where('status', 'rejected')->count();

        $purposeCounts = InformationRequest::select('purpose', DB::raw('count(*) as total'))
            ->groupBy('purpose')
            ->pluck('total', 'purpose')
            ->toArray();

        $reasonCounts = ObjectionRequestV2::select('reason', DB::raw('count(*) as total'))
            ->groupBy('reason')
            ->pluck('total', 'reason')
            ->toArray();

        $latestRequests = InformationRequest::latest()->take(5)->get();
        $latestObjections = ObjectionRequestV2::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalRequests',
            'pendingRequests',
            'processedRequests',
            'completedRequests',
            'rejectedRequests',
            'totalObjections',
            'pendingObjections',
            'processedObjections',
            'completedObjections',
            'rejectedObjections',
            'purposeCounts',
            'reasonCounts',
            'latestRequests',
            'latestObjections'
        ));
    }

    public function indexRequests(Request $request)
    {
        $query = InformationRequest::latest();

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('search') && $request->search != '') {
            $query->where('full_name', 'like', '%' . $request->search . '%');
        }

        $informationRequests = $query->paginate(10);
        return view('admin.requests.index', compact('informationRequests'));
    }

    public function indexObjections(Request $request)
    {
        $query = ObjectionRequestV2::latest();

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('search') && $request->search != '') {
            $query->where('full_name', 'like', '%' . $request->search . '%');
        }

        $objectionRequests = $query->paginate(10);
        return view('admin.objections.index', compact('objectionRequests'));
    }

    public function showRequest(InformationRequest $informationRequest)
    {
        return view('admin.requests.show', compact('informationRequest'));
    }

    public function showObjection(ObjectionRequestV2 $objectionRequest)
    {
        return view('admin.objections.show', compact('objectionRequest'));
    }

    public function updateStatus(Request $request, InformationRequest $informationRequest)
    {
        $request->validate([
            'status' => 'required|in:pending,processed,completed,rejected',
            'admin_notes' => 'nullable|string', // Tambahkan validasi ini
        ]);

        $informationRequest->status = $request->status;
        $informationRequest->admin_notes = $request->admin_notes; // Simpan catatan admin
        $informationRequest->save();

        return redirect()->route('admin.requests.index')->with('success', 'Status permohonan berhasil diperbarui!');
    }

    public function updateObjectionStatus(Request $request, ObjectionRequestV2 $objectionRequest)
    {
        $request->validate([
            'status' => 'required|in:pending,processed,completed,rejected',
            'admin_notes' => 'nullable|string', // Tambahkan validasi ini
        ]);

        $objectionRequest->status = $request->status;
        $objectionRequest->admin_notes = $request->admin_notes; // Simpan catatan admin
        $objectionRequest->save();

        return redirect()->route('admin.objections.index')->with('success', 'Status pengajuan keberatan berhasil diperbarui!');
    }

    public function destroy(InformationRequest $informationRequest)
    {
        if ($informationRequest->identity_scan_path) {
            $filePath = public_path($informationRequest->identity_scan_path);
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
        }

        $informationRequest->delete();

        return redirect()->route('admin.requests.index')->with('success', 'Permohonan berhasil dihapus!');
    }

    public function destroyObjection(ObjectionRequestV2 $objectionRequest)
    {
        if ($objectionRequest->identity_scan_path) {
            $filePath = public_path($objectionRequest->identity_scan_path);
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
        }

        $objectionRequest->delete();

        return redirect()->route('admin.objections.index')->with('success', 'Pengajuan keberatan berhasil dihapus!');
    }
}
