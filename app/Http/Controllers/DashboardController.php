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
        $approvedAmount = FCY_Request::where('recordStatusAllocation', 'APPROVED')
            ->selectRaw('"currencyType", SUM("performaAmount") as total_amount')
            ->groupBy('currencyType')
            ->get();
        $totalRejected = FCY_Request::where('recordStatusAllocation', 'REJCT')->count();
        $rejectedAmount = FCY_Request::where('recordStatusAllocation', 'REJCT')
            ->selectRaw('"currencyType", SUM("performaAmount") as total_amount')
            ->groupBy('currencyType')
            ->get();
        $totalRejectedReg = FCY_Request::where('recordStatusRegistration', 'REJCT')->count();
        $rejectedAmountReg = FCY_Request::where('recordStatusRegistration', 'REJCT')
            ->selectRaw('"currencyType", SUM("performaAmount") as total_amount')
            ->groupBy('currencyType')
            ->get();


        if ($totalFcyRequests == 0) {
            $totalPercentApproved = 0;
            $totalpercentRejected = 0;
            $totalpercentRejectedReg = 0;
        } else {
            $totalPercentApproved = ($totalApproved / $totalFcyRequests) * 100;
            $totalpercentRejected = ($totalRejected / $totalFcyRequests) * 100;
            $totalpercentRejectedReg = ($totalRejectedReg / $totalFcyRequests) * 100;
        }


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
            'totalRejectedReg',
            'totalpercentRejectedReg',
            'rejectedAmountReg',
            'labels',
            'data'
        ));
    }
}
