<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Branch;
use App\Models\District;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;
use App\Mail\UserAuthorizedMail;
use Illuminate\Support\Facades\Mail;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('recordStatus', 'ACTIVE')->get();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $districts = District::select('districtName as label', 'districtCode as value')->get();
        $branchs = Branch::select('branchName as label', 'branchCode as value')->get();
        // $roles = Role::select('name as label', 'name as value')->get(); 

        return view('users.create', compact('districts', 'branchs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|unique:users',
                'email' => 'required|email|unique:users',
                'userName' => 'required|unique:users',
                'userBranch' => 'required',
                'userDistrict' => 'required',
                'userGender' => 'required',
                'userPhone' => 'required',
                'userStatus' => 'required',
                'remark' => 'required',
                'password' => 'required|min:6',
                'userRole' => 'required',
            ]);

            $data = $request->all();
            $data['createdBy'] = auth('web')->id();
            $data['password'] = Hash::make($request->password);
            $data['userStatus'] = 'NEW'; // Force NEW status for all new users
            $data['recordStatus'] = 'INAU'; // Force ACTIVE status for all new users

            $user = User::create($data);
            $user->assignRole($request->userRole);

            return redirect()->route('users.index')->with('success', "<script>showNotification('User', 'User registered successfully','success')</script>");
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation error: ' . json_encode($e->errors()));
            $errors = $e->errors();
            return redirect()->route('users.create')->with('error', "<script>showNotification('User', 'User Registration Failed. " . $e->getMessage() . "','error')</script>");
        } catch (\Exception $e) {
            Log::error('Error creating user: ' . $e->getMessage());

            session()->flash('notification', [
                'title' => 'Registration Failed',
                'message' => 'Failed to register user: ' . $e->getMessage(),
                'type' => 'error'
            ]);


            return redirect()->route('users.create')->with('error', "<script>showNotification('User', 'User Registration Failed. " . $e->getMessage() . "','error')</script>");
        }
    }

    /**
     * Display the contact details of users.
     */
    public function contactDetails()
    {
        $users = User::all();
        $districts = District::all();
        $branchs = Branch::all();

        return view('ContactDetails.index', compact('users'));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $districts = District::select('districtName as label', 'districtCode as value')->get();
        $branchs = Branch::select('branchName as label', 'branchCode as value')->get();
        $roles = Role::select('name as label', 'name as value')->get();


        return view('users.edit', compact('user', 'districts', 'branchs', 'roles'));
    }
    // show the lists of users which are not autorized (their status is not active)
    public function notAuthorizedUsersList()
    {
        $users = User::where('recordStatus', 'INAU')
            ->get();

        return view('users.authOrReject', compact('users'));
    }

    /**
     * Authorize a user by updating their record status to ACTIVE.
     */
    public function authorizeUser(Request $request, User $user)
    {
        try {
            if ($user->createdBy !== Auth::id()) {
                if (Auth::user()->userRole === 'ADMIN' || Auth::user()->userRole === 'MANAGER') {
                    $updated = $user->update([
                        'recordStatus' => 'ACTIVE',
                        'modifiedBy' => Auth::id(),
                    ]);

                    if (!$updated) {
                        throw new \Exception('Update query returned false');
                    }

                    // Assume you have stored a temporary plain password (from registration)
                    $plainPassword = $user->temp_password ?? 'N/A'; // Replace with actual logic

                    // Send email
                    Mail::to($user->email)->send(new UserAuthorizedMail($user, $plainPassword));

                    return redirect()->route('users.index')
                        ->with('success', "<script>showNotification('User', 'User Authorized Successfully','success')</script>");
                } else {
                    return redirect()->back()
                        ->with('error', "<script>showNotification('Request Authorization', 'Insufficient Privileges !!!', 'error')</script>");
                }
            } else {
                return redirect()->back()
                    ->with('error', "<script>showNotification('Request Authorization', 'Maker and Checker couldn’t be Same !!!', 'error')</script>");
            }
        } catch (\Exception $e) {
            Log::error('Error authorizing user: ' . $e->getMessage(), [
                'exception' => $e
            ]);
            return redirect()->back()
                ->with('error', "<script>showNotification('User', 'User Authorization Failed ','error')</script>");
        }
    }

    /**
     * Reject a user by deleting their record.
     */
    public function rejectUser(Request $request, User $user)
    {
        try {
            if (
                $user->createdBy !== Auth::id() &&
                (Auth::id() === 'ADMIN' || Auth::id() === 'MANAGER')
            ) {

                $user->delete();

                return redirect()->route('users.index')->with('success', 'User rejected successfully.');
            } else {

                return redirect()->back()->with('error', "<script>showNotification('Request Rejection', 'Insufficient Privilages', 'error')</script>");
            }
        } catch (\Exception $e) {
            Log::error('Error rejecting user: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to reject user. Please try again.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }


    //// function to reset user password

    public function resetUserPasswordView(User $user)
    {
        return view('users.resetUserPasswordView', compact('user'));
    }
    public function resetUserPasswordStore(Request $request, User $user)
    {
        try {
            $request->validate([
                'remark' => 'required',
                'password' => 'required|min:6',
            ]);

            $data = $request->all();
            $data['remark'] = $request->remark;
            $data['password'] = Hash::make($request->password);


            $user->update($data);

            return redirect()->route('users.index')->with('success', "<script>showNotification('User', 'Password reset successfully to default password','success')</script>");
        } catch (\Exception $e) {
            Log::error('Error resetting password: ' . $e->getMessage());
            return redirect()->back()->with('error', "<script>showNotification('User', 'Password reset failed','error')</script>");
        }
    }
}
