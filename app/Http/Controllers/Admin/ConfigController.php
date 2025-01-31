<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Config\ConfigRequest;
use App\Models\Config;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    public function config()
    {
        $config = Config::first();
        return view('admin.config.edit', compact('config'));
    }

    public function configStore(ConfigRequest $request, string $id)
    {
        $config = Config::findOrFail($id);
        $config->update([
            'android_version'      => $request->android_version,
            'ios_version'          => $request->ios_version,
            'android_url'          => $request->android_url,
            'ios_url'              => $request->ios_url,
            'terms_and_conditions' => $request->terms_and_conditions,
            'about_us'             => $request->about_us,
            'privacy_policy'       => $request->privacy_policy,
        ]);
        return redirect()->route('admin.config')->with('success', __('message.Configurations Updated Successfully'));
    }
}
