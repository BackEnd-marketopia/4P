<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Banner\StoreBannerRequest;
use App\Http\Requests\Admin\Banner\UpdateBannerRequest;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::paginate(10);
        return view('admin.banner.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBannerRequest $request)
    {
        $image = Helpers::addImage($request->image, 'banner');
        Banner::create([
            'name_arabic'  => $request->name_arabic,
            'name_english' => $request->name_english,
            'image'        => $image,
        ]);
        return redirect()->route('admin.banners.index')->with('success', __('message.Banner Added Successfully'));;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $banner = Banner::findOrFail($id);
        return view('admin.banner.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBannerRequest $request, string $id)
    {
        $banner = Banner::findOrFail($id);
        $image = $request->image ? $request->image : $banner->image;

        if ($request->image) {
            if (File::exists($banner->image)) {
                File::delete($banner->image);
            }
            $image = Helpers::addImage($request->image, 'banner');
        }

        $banner->update([
            'name_arabic'  => $request->name_arabic,
            'name_english' => $request->name_english,
            'image'        => $image,
        ]);
        return redirect()->route('admin.banners.index')->with('success', __('message.Banner Edit Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $banner = Banner::findOrFail($id);
        if (File::exists($banner->image)) {
            File::delete($banner->image);
        }
        $banner->destroy($id);

        return redirect()->route('admin.banners.index')->with('success', __('message.Banner Deleted Successfully'));
    }
}
