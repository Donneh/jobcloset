<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CompanySettingsController extends Controller
{
    public function index()
    {
        $company = auth()->user()->tenant->company;
        if(!$company) {
            $company = new Company();
            $company->name = auth()->user()->tenant->name;
            $company->save();
        }
        return Inertia::render('CompanySettings/Index', [
            'company' => $company,
        ]);
    }

    public function adyen(Request $request)
    {
        $request->validate([
            'adyen_merchant_account' => ['required', 'string'],
            'adyen_api_key' => ['required', 'string'],
            'adyen_client_key' => ['required', 'string'],
        ]);


        $tenant = auth()->user()->tenant;

        $company = Company::updateOrCreate(
            ['tenant_id' => $tenant->id],
            [
                'name' => $tenant->name,
                'adyen_merchant_account' => $request->adyen_merchant_account,
                'adyen_api_key' => $request->adyen_api_key,
                'adyen_client_key' => $request->adyen_client_key,
            ]
        );

        return redirect()->back()->with('message', 'Adyen settings saved.');
    }
}
