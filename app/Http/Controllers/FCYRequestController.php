<?php

namespace App\Http\Controllers;

use App\Models\FCY_Request;
use App\Http\Controllers\Controller;
use App\Models\currencies;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class FCYRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        // Fetch all FCY_Request records from the database which are autorized
        $fcyRequests = FCY_Request::where('recordStatusRegistration', 'AUTH')
            ->where('recordStatusAllocation', 'APPROVED')->get();
        // $fcyRequests = FCY_Request::all();
        // Pass the records to the view
        $currencyList = currencies::select('description as label', 'shortCode as value')->get();
        //- where('status', 'ACTIVE')
        return view('fcy-request.index', compact('fcyRequests', 'currencyList'));
        // return view('fcy-request.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $currencyList = currencies::select('description as label', 'shortCode as value')
        ->where('status', 'ACTIVE')
        ->get();
        //- where('status', 'ACTIVE')
        return view('fcy-request.create', compact('currencyList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'dateOfApplication' => 'required|date',
            'applicantName' => 'nullable|string|max:255',
            'branchName' => 'nullable|string|max:255',
            'applicantAddress' => 'nullable|string|max:255',
            'telNumber' => 'nullable|string|max:20',
            'phoneNumber' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'NBEAccountNumber' => 'nullable|string|max:50',
            'descriptionOfGoodService' => 'nullable|string|max:255',
            'currencyType' => 'nullable|string|max:10',
            'performaAmount' => 'nullable|numeric|min:0',
            'modeOfPayment' => 'nullable|string|max:50',
            'shipmentPlace' => 'nullable|string|max:255',
            'destinationPlace' => 'nullable|string|max:255',
            'incoterms' => 'nullable|string|max:50',
            'requestRemarks' => 'nullable|string|max:255',
            // 'requestFiles' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            // 'createdBy' => 'required|string|max:255',
        ]);

        // Create a new FCY_Request instance
        $data = $request->all();
        if ($request->hasFile('requestFiles')) {
            $file = $request->file('requestFiles');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/uploads/fcyRequestFiles/'), $filename);
            $data['requestFiles'] = 'uploads/fcyRequestFiles/' . $filename;
        } else {
            $data['requestFiles'] = null; // Set to null if no file is uploaded
        }
        $data['recordStatusRegistration'] = 'INAU'; // Set default record status

        $data['createdBy'] = Auth::id();
        // file upload handling

        // Save the FCY_Request instance to the database
        FCY_Request::create($data);
        // Redirect to the index page with a success message
        // show sucess notifiation
        // check if the request was successful
        if ($data) {
            return redirect()->route('fcy-request.index')
                ->with('success', "<script>showNotification('FCY Request', 'Request Registered Successfully')</script>");
        } else {
            return redirect()->route('fcy-request.index')
                ->with('error', "<script>showNotification('FCY Request', 'Request Registration Failed')</script>");
        }
    }

    /**
     * Display the specified resource.
     */
    public function showAuthAlloc(FCY_Request $fCY_Request)
    {
        return view('fcy-request.showAuthAlloc', compact('fCY_Request'));
    }

    public function showAuthReg(FCY_Request $fCY_Request)
    {
        return view('fcy-request.showAuthReg', compact('fCY_Request'));
    }

    public function showRejectedAlloc(FCY_Request $fCY_Request)
    {
        return view('fcy-request.showRejectedAlloc', compact('fCY_Request'));
    }

    public function showRejectReg(FCY_Request $fCY_Request)
    {
        return view('fcy-request.showRejectReg', compact('fCY_Request'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FCY_Request $fCY_Request)
    {
        // redirect to edit.blade.php file to update existing requests
        return view('fcy-request.edit', compact('fCY_Request'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FCY_Request $fCY_Request)
    {
        // Validate the request data
        $request->validate([
            'dateOfApplication' => 'required|date',
            'applicantName' => 'nullable|string|max:255',
            'branchName' => 'nullable|string|max:255',
            'applicantAddress' => 'nullable|string|max:255',
            'telNumber' => 'nullable|string|max:20',
            'phoneNumber' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'NBEAccountNumber' => 'nullable|string|max:50',
            'descriptionOfGoodService' => 'nullable|string|max:255',
            'currencyType' => 'nullable|string|max:10',
            'performaAmount' => 'nullable|numeric|min:0',
            'modeOfPayment' => 'nullable|string|max:50',
            'shipmentPlace' => 'nullable|string|max:255',
            'destinationPlace' => 'nullable|string|max:255',
            'incoterms' => 'nullable|string|max:50',
            'requestRemarks' => 'nullable|string|max:255',
            // 'requestFiles' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            // 'createdBy' => 'required|string|max:255',
        ]);
        $data = $request->all();
        if ($request->hasFile('requestFiles')) {
            $file = $request->file('requestFiles');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/uploads/fcyRequestFiles/'), $filename);
            $data['requestFiles'] = 'uploads/fcyRequestFiles/' . $filename;
        } else {
            $data['requestFiles'] = $fCY_Request->requestFiles; // Set to null if no file is uploaded
        }
        $data['recordStatusRegistration'] = 'INAU';

        $data['updatedBy'] = Auth::id();
        // file upload handling

        // Save the FCY_Request instance to the database
        $fCY_Request->update($data);
        if ($data) {
            return redirect()->route('fcy-request.index')
                ->with('success', "<script>showNotification('FCY Request', 'Request Updated Successfully')</script>");
        } else {
            return redirect()->route('fcy-request.index')
                ->with('error', "<script>showNotification('FCY Request', 'Request Update Failed')</script>");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FCY_Request $fCY_Request)
    {
        //
    }

    //// create a new function that will be used to authorize or reject the request from the list
    public function listUnauthorizedRequests()
    {
        // Fetch all unauthorized FCY_Request records from the database
        $fcyRequests = FCY_Request::where('recordStatusRegistration', 'INAU')->get();
        // Pass the records to the view
        return view('fcy-request.listUnauthorizedRequests', compact('fcyRequests'));
    }
    public function authorizeRequest($id)
    {
        // Find the request by ID
        $fcyRequest = FCY_Request::findOrFail($id);
        // Update the record status to 'AUTH'
        $fcyRequest->recordStatusRegistration = 'AUTH';
        $fcyRequest->recordStatusAllocation = 'UNAPPROVED'; /// update the status as un approved
        $fcyRequest->updatedBy = Auth::id(); // Set the updatedBy field to the current user's ID
        $fcyRequest->save();
        // Redirect back with a success message
        return redirect()->route('fcy-request.listUnauthorizedRequests')
            ->with('success', "<script>showNotification('FCY Request', 'Request Authorized Successfully')</script>");
    }
    public function rejectRequest($id)
    {
        // Find the request by ID
        $fcyRequest = FCY_Request::findOrFail($id);
        // Update the record status to 'REJCT'
        $fcyRequest->recordStatusRegistration = 'REJCT';
        $fcyRequest->updatedBy = Auth::id(); // Set the updatedBy field to the current user's ID
        $fcyRequest->save();
        // Redirect back with a success message
        return redirect()->route('fcy-request.listUnauthorizedRequests')
            ->with('success', "<script>showNotification('FCY Request', 'Request Rejected Successfully')</script>");
    }
    //////////////////// //////////////////////////////////
    //// create a new function that will be used to authorize or reject the request from the list
    public function listAuthorizedRequests()
    {
        // Fetch all unauthorized FCY_Request records from the database
        $fcyRequests = FCY_Request::where('recordStatusAllocation', 'UNAPPROVED')
            ->where('recordStatusRegistration', 'AUTH')
            ->get();
        // Pass the records to the view
        return view('fcy-request.listAuthorizedRequests', compact('fcyRequests'));
    }

    public function authorizeRequestAllocation($id)
    {
        // Find the request by ID
        $fcyRequest = FCY_Request::findOrFail($id);
        // Update the record status to 'APPROVED'
        $fcyRequest->recordStatusAllocation = 'APPROVED';
        $fcyRequest->updatedBy = Auth::id(); // Set the updatedBy field to the current user's ID
        $fcyRequest->save();
        // Redirect back with a success message
        return redirect()->route('fcy-request.listAuthorizedRequests')
            ->with('success', "<script>showNotification('FCY Request', 'Allocation Request Approved Successfully')</script>");
    }

    public function rejectRequestAllocation($id)
    {
        // Find the request by ID
        $fcyRequest = FCY_Request::findOrFail($id);
        // Update the record status to 'REJCT'
        $fcyRequest->recordStatusAllocation = 'REJCT';
        $fcyRequest->updatedBy = Auth::id(); // Set the updatedBy field to the current user's ID
        $fcyRequest->save();
        // Redirect back with a success message
        return redirect()->route('fcy-request.listAuthorizedRequests')
            ->with('success', "<script>showNotification('FCY Request', 'Allocation Request Rejected Successfully')</script>");
    }
    //////////////// reports ///////////////////////
    public function allFcyRequests()
    {
        $allFcyRequest = FCY_Request::all();
        return view('fcy-request.allFcyRequests', compact('allFcyRequest'));
    }

    public function unAuthFcyRequests()
    {
        $unAuthFcyRequests = FCY_Request::where('recordStatusRegistration', 'INAU')->get();
        return view('fcy-request.unAuthFcyRequests', compact('unAuthFcyRequests'));
    }

    public function authFcyRequests()
    {
        $authFcyRequests = FCY_Request::where('recordStatusRegistration', 'AUTH')->get();
        return view('fcy-request.authFcyRequests', compact('authFcyRequests'));
    }

    public function approvedFcyRequests()
    {
        $approvedFcyRequests = FCY_Request::where('applicationStatus', 'APPROVED')->get();
        return view('fcy-request.approvedFcyRequests', compact('approvedFcyRequests'));
    }

    public function rejectedFcyRequests()
    {
        $rejectedFcyRequestsRegistration = FCY_Request::where('recordStatusRegistration', 'REJCT')->get();
        $rejectedFcyRequestsApplication = FCY_Request::where('applicationStatus', 'REJECTED')->get();
        return view('fcy-request.rejectedFcyRequests', compact('rejectedFcyRequestsRegistration', 'rejectedFcyRequestsApplication'));
    }
}
