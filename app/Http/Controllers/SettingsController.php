<?php

namespace App\Http\Controllers;

use App\Models\currencies;
use App\Models\Incoterms;
use App\Models\modeOfPayments;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    // mode of payment settings
    public function modeOfPaymentSettingsIndex()
    {
        return view('settings.modeOfPayments.index');
    }

    public function modeOfPaymentSettingsAdd()
    {
        return view('settings.modeOfPayments.create');
    }

    public function modeOfPaymentSettingsEdit(Request $request) {}

    public function modeOfPaymentSettingStore(Request $request)
    {
        $request->validate([
            'shortCode' => 'required|max:3',
            'description' => 'required',
            'status' => 'nullable',
        ]);
        $data = $request->all();
        modeOfPayments::create($data);
        if ($data) {
            return redirect()->route('settings.modeOfPayments.index')
                ->with('success', "<script>showNotification('Mode of Payment', 'New Mode of Payment Added Successfully')</script>");
        } else {
            return redirect()->route('settings.modeOfPayments.index')
                ->with('error', "<script>showNotification('Mode of Payment', 'Error While Adding New Mode of Payment')</script>");
        }
    }

    public function modeOfPaymentSettingsUpdate() {}

    ////// settings for currency 
    public function currencySettingsIndex()
    {
        $currencyList = currencies::all();
        return view('settings.currency.index', compact('currencyList'));
    }

    public function currencySettingsAdd()
    {
        return view('settings.currency.create');
    }

    public function currencySettingsEdit(Request $request) {}

    public function currencySettingStore(Request $request)
    {
        $request->validate([
            'shortCode' => 'required|max:3',
            'description' => 'required',
            'status' => 'nullable',
        ]);
        $data = $request->all();
        currencies::create($data);
        if ($data) {
            return redirect()->route('settings.currency.index')
                ->with('success', "<script>showNotification('Currency', 'New Currency Added Successfully')</script>");
        } else {
            return redirect()->route('settings.currency.index')
                ->with('error', "<script>showNotification('Currency', 'Error While Adding New Currency')</script>");
        }
    }
    public function mcurrencySettingsUpdate() {}
    // settings for incoterms

    public function incotermsSettingsIndex()
    {
        return view('settings.incoterms.index');
    }

    public function incotermsSettingsAdd()
    {
        return view('settings.incoterms.create');
    }

    public function incotermsSettingsEdit(Request $request) {}

    public function incotermsSettingStore(Request $request) {
        $request->validate([
            'shortCode' => 'required|max:3',
            'description' => 'required',
            'status' => 'nullable',
        ]);
        $data = $request->all();
        incoterms::create($data);
        if ($data) {
            return redirect()->route('settings.incoterms.index')
                ->with('success', "<script>showNotification('Incoterms', 'New Incoterm Added Successfully')</script>");
        } else {
            return redirect()->route('settings.incoterms.index')
                ->with('error', "<script>showNotification('Incoterms', 'Error While Adding New Incoterms')</script>");
        }
    }

    public function incotermsSettingsUpdate() {}
}
