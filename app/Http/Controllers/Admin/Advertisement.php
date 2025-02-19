<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Ads\StoreAdsRequest;
use App\Http\Requests\Admin\Ads\UpdateAdsRequest;
use Illuminate\Http\Request;
use App\Models\Advertisement as Ads;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

class Advertisement extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ads = Ads::paginate(10);
        return view('admin.ads.index', compact('ads'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.ads.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdsRequest $request)
    {
        $ads = Ads::where(function ($query) use ($request) {
            $query->whereDate('start_date', '<=', $request->end_date)
                ->whereDate('end_date', '>=', $request->start_date);
        })->first();

        if ($ads)
            return redirect()->route('admin.ads.create')->with('error', __('message.Advertisement Already Exists For This Date'));

        $image = Helpers::addImage($request->image, 'ads');
        Ads::create([
            'name' => $request->name,
            'image' => $image,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'url' => $request->url ?? null,
        ]);
        return redirect()->route('admin.ads.index')->with('success', __('message.Advertisement Added Successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ads = Ads::findOrFail($id);
        return view('admin.ads.edit', compact('ads'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdsRequest $request, string $id)
    {
        $ad = Ads::where('id', '!=', $id)
            ->where(function ($query) use ($request) {
                $query->whereDate('start_date', '<=', $request->end_date)
                    ->whereDate('end_date', '>=', $request->start_date);
            })
            ->first();

        if ($ad) {
            return redirect()->route('admin.ads.edit', $id)
                ->with('error', __('message.Advertisement Already Exists For This Date'));
        }

        $ads = Ads::findOrFail($id);
        $image = $request->image ? $request->image : $ads->image;

        if ($request->image) {
            if (File::exists($ads->image)) {
                File::delete($ads->image);
            }
            $image = Helpers::addImage($request->image, 'banner');
        }

        $ads->update([
            'name' => $request->name,
            'image' => $image,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'url' => $request->url ?? null,
        ]);

        return redirect()->route('admin.ads.index')->with('success', __('message.Advertisement Edit Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ads = Ads::findOrFail($id);

        if ($ads->image) {
            if (File::exists($ads->image)) {
                File::delete($ads->image);
            }
        }
        $ads->delete();
        return redirect()->route('admin.ads.index')->with('success', __('message.Advertisement Deleted Successfully'));
    }
}
