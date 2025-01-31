<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Feed\StoreFeedRequest;
use App\Http\Requests\Admin\Feed\UpdateFeedRequest;
use Illuminate\Http\Request;
use App\Models\Feed;
use Illuminate\Support\Facades\File;

class FeedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $feeds = Feed::paginate(10);
        return view('admin.feed.index', compact('feeds'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.feed.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFeedRequest $request)
    {
        $image = Helpers::addImage($request->image, 'feed');

        Feed::create([
            'title'             => $request->title,
            'short_description' => $request->short_description,
            'description'       => $request->description,
            'image'             => $image,
            'url'               => $request->url ?? null,
        ]);

        return redirect()->route('admin.feeds.index')->with('success', __('message.Feed Added Successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $feed = Feed::findOrFail($id);
        return view('admin.feed.show', compact('feed'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $feed = Feed::findOrFail($id);
        return view('admin.feed.edit', compact('feed'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFeedRequest $request, string $id)
    {
        $feed = Feed::findOrFail($id);
        $image = $request->image ? $request->image : $feed->image;
        if ($request->image) {
            if (File::exists($feed->image)) {
                File::delete($feed->image);
            }
            $image = Helpers::addImage($request->image, 'feed');
        }

        $feed->update([
            'title'             => $request->title,
            'short_description' => $request->short_description,
            'description'       => $request->description,
            'image'             => $image,
            'url'               => $request->url,
        ]);

        return redirect()->route('admin.feeds.index')->with('success', __('message.Feed Edit Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $feed = Feed::findOrFail($id);

        if (File::exists($feed->image))
            File::delete($feed->image);

        $feed->delete();
        return redirect()->route('admin.feeds.index')->with('success', __('message.Feed Deleted Successfully'));
    }
}
