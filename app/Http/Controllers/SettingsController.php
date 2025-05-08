<?php

namespace App\Http\Controllers;

use App\Models\Currencies;
use App\Models\Incoterms;
use App\Models\ModeOfPayments;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Support\Facades\Log;

class SettingsController extends Controller
{
    // mode of payment settings
    public function modeOfPaymentSettingsIndex()
    {
        $modeOfPayments = ModeOfPayments::paginate(5);
        return view('settings.modeOfPayments.index', compact('modeOfPayments'));
    }

    public function modeOfPaymentSettingsAdd()
    {
        return view('settings.modeOfPayments.create');
    }

    public function modeOfPaymentSettingsEdit(ModeOfPayments $modeOfPayments) {
        return view('settings.modeOfPayments.edit', compact('modeOfPayments'));
    }

    public function modeOfPaymentSettingStore(Request $request)
    {
        $request->validate([
            'shortCode' => 'required|max:3',
            'description' => 'required',
            'status' => 'nullable',
        ]);
        $data = $request->all();
        ModeOfPayments::create($data);
        if ($data) {
            return redirect()->route('settings.modeOfPayments.index')
                ->with('success', "<script>showNotification('Mode of Payment', 'New Mode of Payment Added Successfully')</script>");
        } else {
            return redirect()->route('settings.modeOfPayments.index')
                ->with('error', "<script>showNotification('Mode of Payment', 'Error While Adding New Mode of Payment')</script>");
        }
    }

    public function modeOfPaymentSettingsUpdate(Request $request, ModeOfPayments $modeOfPayments) {

        try {


            $request->validate([
                'shortCode' => 'required|max:3',
                'description' => 'required',
                'status' => 'nullable',
            ]);

            $data = $request->all();
            $modeOfPayments->update($data);

            return redirect()->route('settings.modeOfPayments.index')
                ->with('success', "<script>showNotification('Mode of Payments Update', 'Mode of payments Updated Successfully !!')</script>");
        } catch (\Exception $e) {
            Log::error('Error While Updating Mode of Payments Detailes : ' . $e->getMessage(), [
                'exception' => $e
            ]);
            return redirect()->back()->with('error', "<script>showNotification('Mode Of Payments Update', 'Mode Of Payments Update Failed: {$e->getMessage()}', 'error')</script>");
        }
    }

    ////// settings for currency 
    public function currencySettingsIndex()
    {
        $currencyList = Currencies::paginate(5);
        return view('settings.currency.index', compact('currencyList'));
    }

    public function currencySettingsAdd()
    {
        return view('settings.currency.create');
    }

    public function currencySettingsEdit(Currencies $currency)
    {
        return view('settings.currency.edit', compact('currency'));
    }

    public function currencySettingStore(Request $request)
    {
        $request->validate([
            'shortCode' => 'required|max:3',
            'description' => 'required',
            'status' => 'nullable',
        ]);
        $data = $request->all();
        Currencies::create($data);
        if ($data) {
            return redirect()->route('settings.currency.index')
                ->with('success', "<script>showNotification('Currency', 'New Currency Added Successfully')</script>");
        } else {
            return redirect()->route('settings.currency.index')
                ->with('error', "<script>showNotification('Currency', 'Error While Adding New Currency')</script>");
        }
    }
    public function currencySettingsUpdate(Request $request, Currencies $currency)
    {
        try {


            $request->validate([
                'shortCode' => 'required|max:3',
                'description' => 'required',
                'status' => 'nullable',
            ]);

            $data = $request->all();
            $currency->update($data);

            return redirect()->route('settings.currency.index')
                ->with('success', "<script>showNotification('Currency Update', 'Currency Updated Successfully !!')</script>");
        } catch (\Exception $e) {
            Log::error('Error While Updating Currency Detailes : ' . $e->getMessage(), [
                'exception' => $e
            ]);
            return redirect()->back()->with('error', "<script>showNotification('Currency Update', 'Currency Update Failed: {$e->getMessage()}', 'error')</script>");
        }
    }
    // settings for incoterms

    public function incotermsSettingsIndex()
    {
        $incoterms = Incoterms::paginate(5);
        return view('settings.incoterms.index', compact('incoterms'));
    }

    public function incotermsSettingsAdd()
    {
        return view('settings.incoterms.create');
    }

    public function incotermsSettingsEdit(Incoterms $incoterms)
    {
        return view('settings.incoterms.edit', compact('incoterms'));
    }

    public function incotermsSettingStore(Request $request)
    {
        $request->validate([
            'shortCode' => 'required|max:3',
            'description' => 'required',
            'status' => 'nullable',
        ]);
        $data = $request->all();
        Incoterms::create($data);
        if ($data) {
            return redirect()->route('settings.incoterms.index')
                ->with('success', "<script>showNotification('Incoterms', 'New Incoterm Added Successfully')</script>");
        } else {
            return redirect()->route('settings.incoterms.index')
                ->with('error', "<script>showNotification('Incoterms', 'Error While Adding New Incoterms')</script>");
        }
    }

    public function incotermsSettingsUpdate(Request $request, Incoterms $incoterms) {
        try {


            $request->validate([
                'shortCode' => 'required|max:3',
                'description' => 'required',
                'status' => 'nullable',
            ]);

            $data = $request->all();
            $incoterms->update($data);

            return redirect()->route('settings.incoterms.index')
                ->with('success', "<script>showNotification('Incoterms Update', 'Incoterms Updated Successfully !!')</script>");
        } catch (\Exception $e) {
            Log::error('Error While Updating Incoterms Detailes : ' . $e->getMessage(), [
                'exception' => $e
            ]);
            return redirect()->back()->with('error', "<script>showNotification('Incoterms Update', 'Incoterms Update Failed: {$e->getMessage()}', 'error')</script>");
        }
    }

    public function idSequenceIndex()
    {
        $otherSettings = settings::paginate(5);
        return view('settings.otherSettings.otherSettingsIndex', compact('otherSettings'));
    }
    public function idSequenceCreate() {}
    public function idSequenceEdit(Request $request) {}

    public function idSequenceUpdate(Request $request, Settings $setting) {}
}
