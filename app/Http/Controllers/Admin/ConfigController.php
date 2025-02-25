<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Config\ConfigRequest;
use App\Models\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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
        $image_of_card = $request->image_of_card ? $request->image_of_card : $config->image_of_card;
        if ($request->image_of_card) {
            if (File::exists($config->image)) {
                File::delete($config->image);
            }
            $image_of_card = Helpers::addImage($request->image_of_card, 'config');
        }

        $config->update([
            'android_version'               => $request->android_version,
            'ios_version'                   => $request->ios_version,
            'android_url'                   => $request->android_url,
            'ios_url'                       => $request->ios_url,
            'terms_and_conditions'          => $request->terms_and_conditions,
            'about_us'                      => $request->about_us,
            'privacy_policy'                => $request->privacy_policy,
            'image_of_card'                 => $image_of_card,
            'price_of_card'                 => $request->price_of_card,
            'description_of_card_arabic'    => $request->description_of_card_arabic,
            'description_of_card_english'   => $request->description_of_card_english,
        ]);
        return redirect()->route('admin.config')->with('success', __('message.Configurations Updated Successfully'));
    }
}
