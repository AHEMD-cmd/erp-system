<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SettingUpdateRequest;

class SettingContoller extends Controller
{
    public function index()
    {
        $data = Setting::with('updater')->where('company_code', auth()->user()->company_code)->first();

        return view('admin.settings.index', compact('data'));
    }

    public function edit()
    {
        $setting = Setting::where('company_code', auth()->user()->company_code)->first();
        return view('admin.settings.edit', compact('setting'));
    }

    public function update(SettingUpdateRequest $request, $id)
    {
        $setting = Setting::where('company_code', auth()->user()->company_code)->first();

        $data = $request->except('photo');

        if ($request->photo) {

            $path = upload_image($request->file('photo'), 'uploads/images');
            $data['photo'] = $path;
        }


        $setting->update($data);

        return redirect()->route('admin.settings.index')->with('messgae', 'تم الحفظ بنجاح');
    }
}
