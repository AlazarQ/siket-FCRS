<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FCY_Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function showMetrics()
    {
        $labels = [];
        $data = [];

        $requests = FCY_Request::select('status', DB::raw('COUNT(*) as count'))
            ->groupBy('status')
            ->get();

        foreach ($requests as $request) {
            $labels[] = $request->status;
            $data[] = $request->count;
        }

        $totalFcyRequests = FCY_Request::count();

        return view('dashboard', compact('labels', 'data'));
    }

    public function adminDash()
    {
        $labels = [];
        $data = [];

        $requests = FCY_Request::select('recordStatusAllocation', DB::raw('COUNT(*) as count'))
            ->groupBy('recordStatusAllocation')
            ->get();

        foreach ($requests as $request) {
            $labels[] = $request->recordStatusAllocation; // Fixed key
            $data[] = $request->count;
        } 

        $totalFcyRequests = FCY_Request::count();
        $totalFcyAmount = number_format(FCY_Request::sum('performaAmount'), 2);
        $totalApproved = FCY_Request::where('recordStatusAllocation', 'APPROVED')->count();
        $approvedAmount = number_format(FCY_Request::where('recordStatusAllocation', 'APPROVED')->sum('performaAmount'), 2);
        $totalRejected = FCY_Request::where('recordStatusAllocation', 'REJCT')->count();
        $rejectedAmount = number_format(FCY_Request::where('recordStatusAllocation', 'REJCT')->sum('performaAmount'), 2);

        $totalPercentApproved = ($totalApproved / $totalFcyRequests) * 100;
        $totalpercentRejected= ($totalRejected / $totalFcyRequests) * 100;

        // Load the new admin dashboard view
        return view('dashboard', compact(
            'totalFcyRequests',
            'totalFcyAmount',
            'totalApproved',
            'approvedAmount',
            'totalRejected',
            'rejectedAmount',
            'totalPercentApproved',
            'totalpercentRejected',
            'labels',
            'data'
        ));
    }
}
