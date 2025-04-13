<?php

namespace App\Http\Controllers\Provider;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Provider\Attachment\StoreAttcahmentRequest;
use App\Http\Requests\Provider\Attachment\UpdateAttcahmentRequest;
use App\Models\Attachment;
use App\Models\Lesson;
use Illuminate\Http\Request;

class AttachmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attachments = Attachment::whereHas('lesson.unit.classRoom', function ($query) {
            $query->where('provider_id', auth('web')->user()->provider->id);
        })->with(['lesson.unit.classRoom'])->paginate(10);

        return view('provider.attachment.index', compact('attachments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lessons = Lesson::with(['unit.classRoom'])
            ->whereRelation('unit.classRoom', 'provider_id', auth('web')->user()->provider->id)
            ->get();

        return view('provider.attachment.create', compact('lessons'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAttcahmentRequest $request)
    {
        $listVideo = [
            'mp4',
            'mov',
            'avi',
            'mkv'
        ];
        $listAudio = [
            'mp3',
            'wav',
            'm4a',
        ];

        if (in_array($request->file->getClientOriginalExtension(), $listVideo)) {
            if ($request->type != 'video')
                return redirect()->route('provider.attachments.create')->with('error', __('message.The Type Not Match The File'));
        }
        if (in_array($request->file->getClientOriginalExtension(), $listAudio)) {
            if ($request->type != 'audio')
                return redirect()->route('provider.attachments.create')->with('error', __('message.The Type Not Match The File'));
        }
        if ($request->file->getClientOriginalExtension() == 'pdf' && $request->type != 'pdf')
            return redirect()->route('provider.attachments.create')->with('error', __('message.The Type Not Match The File'));


        $image = Helpers::addImage($request->file, "attachment/$request->type");
        Attachment::create([
            'name' => $request->name,
            'type' => $request->type,
            'url' => $image,
            'sort_order' => $request->sort_order,
            'lesson_id' => $request->lesson_id,
        ]);
        return redirect()->route('provider.attachments.index')->with('success', __('message.Attachment Added Successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $attachment = Attachment::findOrFail($id);
        return view('provider.attachment.show', compact('attachment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $attachment = Attachment::findOrFail($id);
        $lessons = Lesson::with(['unit.classRoom'])
            ->whereRelation('unit.classRoom', 'provider_id', auth('web')->user()->provider->id)
            ->get();
        return view('provider.attachment.edit', compact('attachment', 'lessons'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAttcahmentRequest $request, string $id)
    {
        $attachment = Attachment::findOrFail($id);
        $attachment->update([
            'name' => $request->name,
            'sort_order' => $request->sort_order,
            'lesson_id' => $request->lesson_id,
        ]);
        return redirect()->route('provider.attachments.index')->with('success', __('message.Attachment Edit Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $attachment = Attachment::findOrFail($id);

        $attachment->delete();

        return redirect()->route('provider.attachments.index')->with('success', __('message.Attachment Deleted Successfully'));
    }
}
