<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateCompanySettingRequest;
use App\Models\CompanySetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CompanySettingController extends Controller
{
    public function edit(): View
    {
        return view('admin.company-settings.edit', [
            'companySetting' => CompanySetting::current(),
        ]);
    }

    public function update(UpdateCompanySettingRequest $request): RedirectResponse
    {
        $companySetting = CompanySetting::current();
        $companySetting->update($request->validated());

        return redirect()
            ->route('admin.company-setting.edit')
            ->with('success', 'Profil perusahaan berhasil diperbarui.');
    }
}
