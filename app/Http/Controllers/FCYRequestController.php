<?php

namespace App\Http\Controllers;

use App\Models\FCY_Request;
use App\Http\Controllers\Controller;
use App\Models\Currencies;
use App\Models\Incoterms;
use App\Models\ModeOfPayments;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Settings;
use App\Models\Branch;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\FCYRequestRegistration;
use App\Mail\FCYRequestApproval;
use App\Mail\FCYRequestAllocation;

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
        $currencyList = Currencies::select('description as label', 'shortCode as value')->get();
        //- where('status', 'ACTIVE')
        return view('fcy-request.index', compact('fcyRequests', 'currencyList'));
        // return view('fcy-request.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(FCY_Request $fCY_Request)
    {
        $branchs = Branch::select('branchName as label', 'branchCode as value')->get();
        $currencyList = Currencies::select('description as label', 'shortCode as value')
            ->where('status', 'ACTIVE')
            ->get();
        $modeOfPaymentsList = ModeOfPayments::select('description as label', 'shortCode as value')
            ->where('status', 'ACTIVE')
            ->get();
        $incotermsList = incoterms::select('description as label', 'shortCode as value')
            ->where('status', 'ACTIVE')
            ->get();
        $currentDate = now()->format('Y'); // Get the current date in YYYY format
        $idSequence = Settings::where('shortCode', 'IDG')->value('value'); // Fetch the current sequence value from settings
        $idReference = 'SKB' . $idSequence . $currentDate; // Concatenate to form the ID reference
        //- where('status', 'ACTIVE')
        return view('fcy-request.create', compact('currencyList', 'modeOfPaymentsList', 'incotermsList', 'idReference', 'branchs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        try {
            $request->validate([
                'idReference' => [
                    'required',
                    'unique:fcy_requests'
                ],
                'performaInvoiceNumber' => [
                    'required',
                    'unique:fcy_requests',

                ],
                'dateOfApplication' => 'required|date',
                'applicantName' => 'nullable|string|max:255',
                'branchName' => 'nullable|string|max:255',
                'applicantAddress' => 'nullable|string|max:255',
                'telNumber' => 'nullable|string|max:20',
                'phoneNumber' => 'nullable|string|max:20',
                'address' => 'nullable|string|max:255',
                'NBEAccountNumber' => 'nullable|string|max:50',
                'tinNumber' => 'nullable',
                'descriptionOfGoodService' => 'nullable|string|max:255',
                'currencyType' => 'nullable|string|max:10',
                'performaAmount' => 'nullable|numeric|min:0',
                'modeOfPayment' => 'nullable|string|max:50',
                'shipmentPlace' => 'nullable|string|max:255',
                'destinationPlace' => 'nullable|string|max:255',
                'incoterms' => 'nullable|string|max:50',
                'requestRemarks' => 'nullable|string|max:255',
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

            $data['createdBy'] = Auth::user()->userName;
            // file upload handling

            // Save the FCY_Request instance to the database
            FCY_Request::create($data);


            // Redirect to the index page with a success message
            // show sucess notifiation
            // check if the request was successful

            Settings::where('shortCode', 'IDG')
                ->update([
                    'value' => DB::raw("LPAD(CAST(CAST(value AS INTEGER) + 1 AS TEXT), 5, '0')"),
                ]);

            // Send email
            try {
                $recipients = DB::table('users')
                    ->whereIn('userRole', ['ADMIN', 'MANAGER'])
                    ->pluck('email')
                    ->toArray();

                Mail::to($recipients)->send(new FCYRequestRegistration($request));
            } catch (\Exception $e) {
                Log::error('Error While FCY Request registration : ' . $e->getMessage(), [
                    'exception' => $e
                ]);
            }

            return redirect()->route('fcy-request.listUnauthorizedRequests')
                ->with('success', "<script>showNotification('FCY Request', 'Request Registered Successfully')</script>");
        } catch (\Exception $e) {
            Log::error('Error While Registring Request: ' . $e->getMessage(), [
                'exception' => $e
            ]);
            return redirect()->back()->with('error', "<script>showNotification('FCY - Request', 'Request Registration Failed: {$e->getMessage()}', 'error')</script>");
        }
    }

    /**
     * Display the specified resource.
     */
    public function showAuthAlloc(FCY_Request $fCY_Request)
    {
        $branchs = Branch::select('branchName as label', 'branchCode as value')->get();
        $currencyList = Currencies::select('description as label', 'shortCode as value')
            ->where('status', 'ACTIVE')
            ->get();
        $modeOfPaymentsList = ModeOfPayments::select('description as label', 'shortCode as value')
            ->where('status', 'ACTIVE')
            ->get();
        $incotermsList = incoterms::select('description as label', 'shortCode as value')
            ->where('status', 'ACTIVE')
            ->get();
        $branchs = Branch::select('branchName as label', 'branchCode as value')->get();
        return view('fcy-request.showAuthAlloc', compact('fCY_Request', 'branchs', 'currencyList', 'modeOfPaymentsList', 'incotermsList'));
    }

    public function showAuthReg(FCY_Request $fCY_Request)
    {
        $branchs = Branch::select('branchName as label', 'branchCode as value')->get();
        $currencyList = Currencies::select('description as label', 'shortCode as value')
            ->where('status', 'ACTIVE')
            ->get();
        $modeOfPaymentsList = ModeOfPayments::select('description as label', 'shortCode as value')
            ->where('status', 'ACTIVE')
            ->get();
        $incotermsList = incoterms::select('description as label', 'shortCode as value')
            ->where('status', 'ACTIVE')
            ->get();
        return view('fcy-request.showAuthReg', compact('fCY_Request', 'branchs', 'currencyList', 'modeOfPaymentsList', 'incotermsList'));
    }

    public function showRejectedAlloc(FCY_Request $fCY_Request)
    {
        $branchs = Branch::select('branchName as label', 'branchCode as value')->get();
        $currencyList = Currencies::select('description as label', 'shortCode as value')
            ->where('status', 'ACTIVE')
            ->get();
        $modeOfPaymentsList = ModeOfPayments::select('description as label', 'shortCode as value')
            ->where('status', 'ACTIVE')
            ->get();
        $incotermsList = incoterms::select('description as label', 'shortCode as value')
            ->where('status', 'ACTIVE')
            ->get();

        return view('fcy-request.showRejectedAlloc', compact('fCY_Request', 'branchs', 'currencyList', 'modeOfPaymentsList', 'incotermsList'));
    }

    public function showRejectReg(FCY_Request $fCY_Request)
    {
        $branchs = Branch::select('branchName as label', 'branchCode as value')->get();
        $currencyList = Currencies::select('description as label', 'shortCode as value')
            ->where('status', 'ACTIVE')
            ->get();
        $modeOfPaymentsList = ModeOfPayments::select('description as label', 'shortCode as value')
            ->where('status', 'ACTIVE')
            ->get();
        $incotermsList = incoterms::select('description as label', 'shortCode as value')
            ->where('status', 'ACTIVE')
            ->get();

        return view('fcy-request.showRejectReg', compact('fCY_Request', 'branchs', 'currencyList', 'modeOfPaymentsList', 'incotermsList'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FCY_Request $fCY_Request)
    {
        $branchs = Branch::select('branchName as label', 'branchCode as value')->get();
        $currencyList = Currencies::select('description as label', 'shortCode as value')
            ->where('status', 'ACTIVE')
            ->get();
        $modeOfPaymentsList = ModeOfPayments::select('description as label', 'shortCode as value')
            ->where('status', 'ACTIVE')
            ->get();
        $incotermsList = incoterms::select('description as label', 'shortCode as value')
            ->where('status', 'ACTIVE')
            ->get();
        // redirect to edit.blade.php file to update existing requests
        return view('fcy-request.edit', compact('fCY_Request', 'branchs', 'currencyList', 'modeOfPaymentsList', 'incotermsList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FCY_Request $fCY_Request)
    {
        // Validate the request data
        try {
            $request->validate([
                'performaInvoiceNumber' => [
                    'required',
                    'unique:fcy_requests,performaInvoiceNumber,' . $fCY_Request->id,
                ],
                'idReference' => 'required',
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
            $data['recordStatusAllocation'] = '';

            $data['updatedBy'] = Auth::user()->userName;
            // file upload handling

            // Save the FCY_Request instance to the database
            $fCY_Request->update($data);
            return redirect()->route('fcy-request.listUnauthorizedRequests')
                ->with('success', "<script>showNotification('FCY Request', 'Request Updated Successfully')</script>");
        } catch (\Exception $e) {
            Log::error('Error While Registring Request: ' . $e->getMessage(), [
                'exception' => $e
            ]);
            return redirect()->back()->with('error', "<script>showNotification('FCY - Request', 'Request Registration Failed: {$e->getMessage()}', 'error')</script>");
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
        $branchs = Branch::select('branchName as label', 'branchCode as value')->get();
        // Fetch all unauthorized FCY_Request records from the database
        $fcyRequests = FCY_Request::where('recordStatusRegistration', 'INAU')->get();
        // Pass the records to the view
        return view('fcy-request.listUnauthorizedRequests', compact('fcyRequests'));
    }
    public function authorizeRequest($id)
    {

        $fcyRequest = FCY_Request::findOrFail($id);
        if ($fcyRequest->createdBy !== Auth::id()) {
            if (Auth::user()->userRole !== 'OFFICER' && Auth::user()->userRole !== 'ADMIN') {
                return redirect()->back()->with('error', "<script>showNotification('Request Authorization', 'Only OFFICER role can authorize requests', 'error')</script>");
            }
            $fcyRequest->recordStatusRegistration = 'AUTH';
            $fcyRequest->recordStatusAllocation = 'UNAPPROVED'; /// update the status as un approved
            $fcyRequest->updatedBy = Auth::user()->userName; // Set the updatedBy field to the current user's ID
            $fcyRequest->save();
            // Send email
            try {
                $recipients = DB::table('users')
                    ->whereIn('userRole', ['ADMIN', 'MANAGER'])
                    ->pluck('email')
                    ->toArray();

                Mail::to($recipients)->send(new FCYRequestApproval($fcyRequest));
            } catch (\Exception $e) {
                Log::error('Error While FCY Request registration approval : ' . $e->getMessage(), [
                    'exception' => $e
                ]);
            }
            // Redirect back with a success message
            return redirect()->route('fcy-request.listUnauthorizedRequests')
                ->with('success', "<script>showNotification('FCY Request', 'Request Authorized Successfully')</script>");
        } else {
            return redirect()->back()->with('error', "<script>showNotification('Request Authorization', 'Maker and Checker User is the Same', 'error')</script>");
        }
    }
    public function rejectRequest($id)
    {
        // Find the request by ID
        if (Auth::user()->userRole === 'MAKER') {
            return redirect()->back()->with('error', "<script>showNotification('Request Authorization', 'Only OFFICER role can authorize requests', 'error')</script>");
        }
        $fcyRequest = FCY_Request::findOrFail($id);
        // Update the record status to 'REJCT'
        $fcyRequest->recordStatusRegistration = 'REJCT';
        $fcyRequest->updatedBy = Auth::user()->userName; // Set the updatedBy field to the current user's ID
        $fcyRequest->save();
        // Redirect back with a success message
        return redirect()->route('fcy-request.listUnauthorizedRequests')
            ->with('success', "<script>showNotification('FCY Request', 'Request Rejected Successfully')</script>");
    }
    //////////////////// //////////////////////////////////
    //// create a new function that will be used to authorize or reject the request from the list
    public function listAuthorizedRequests()
    {
        $branchs = Branch::select('branchName as label', 'branchCode as value')->get();
        // Fetch all unauthorized FCY_Request records from the database
        $fcyRequests = FCY_Request::where('recordStatusAllocation', 'UNAPPROVED')
            ->where('recordStatusRegistration', 'AUTH')
            ->get();
        // Pass the records to the view
        return view('fcy-request.listAuthorizedRequests', compact('fcyRequests', 'branchs'));
    }

    public function authorizeRequestAllocation($id)
    {
        // Find the request by ID
        $fcyRequest = FCY_Request::findOrFail($id);
        // Update the record status to 'APPROVED'
        $fcyRequest->recordStatusAllocation = 'APPROVED';
        $fcyRequest->updatedBy = Auth::user()->userName; // Set the updatedBy field to the current user's ID
        $fcyRequest->save();

        // Send email
        try {

            $recipients = DB::table('users')
                ->whereIn('userRole', ['ADMIN', 'MANAGER'])
                ->pluck('email')
                ->toArray();

            Mail::to($recipients)->send(new FCYRequestAllocation($fcyRequest));
        } catch (\Exception $e) {
            Log::error('Error While FCY Request Allocation - Approval : ' . $e->getMessage(), [
                'exception' => $e
            ]);
        }
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
        $fcyRequest->updatedBy = Auth::user()->userName; // Set the updatedBy field to the current user's ID
        $fcyRequest->save();
        // Redirect back with a success message
        return redirect()->route('fcy-request.listAuthorizedRequests')
            ->with('success', "<script>showNotification('FCY Request', 'Allocation Request Rejected Successfully')</script>");
    }
    //////////////// reports ///////////////////////
    public function allFcyRequests(Request $request)
    {
        $idReference = $request->query('idReference');
        $applicantName = $request->query('applicantName');
        $performaInvoiceNumber = $request->query('performaInvoiceNumber');
        $currencyType = $request->query('currencyType');

        $dateOfApplication = $request->query('dateOfApplication');
        $startDate = $request->query('startDate');
        $endDate = $request->query('endDate');

        $branchs = Branch::select('branchName as label', 'branchCode as value')->get();

        $allFcyRequest = FCY_Request::query()
            ->when($idReference, function ($query, $idReference) {
                return $query->where('idReference', 'like', "%{$idReference}%");
            })
            ->when($applicantName, function ($query, $applicantName) {
                return $query->where('applicantName', 'like', "%{$applicantName}%");
            })
            ->when($performaInvoiceNumber, function ($query, $performaInvoiceNumber) {
                return $query->where('performaInvoiceNumber', 'like', "%{$performaInvoiceNumber}%");
            })
            ->when($currencyType, function ($query, $currencyType) {
                return $query->where('currencyType', $currencyType);
            })->when($dateOfApplication, function ($query, $dateOfApplication) {
                return $query->whereDate('dateOfApplication', $dateOfApplication);
            })->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                return $query->whereBetween('dateOfApplication', [$startDate, $endDate]);
            })
            ->get();

        return view('fcy-request.allFcyRequests', compact('allFcyRequest', 'branchs'));
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

    public function show(FCY_Request $fCY_Request)
    {
        $currencyList = Currencies::select('description as label', 'shortCode as value')->get();
        $modeOfPaymentsList = ModeOfPayments::select('description as label', 'shortCode as value')->get();
        $incotermsList = incoterms::select('description as label', 'shortCode as value')->get();
        return view('fcy-request.show', compact('fCY_Request', 'currencyList', 'modeOfPaymentsList', 'incotermsList'));
    }
}
