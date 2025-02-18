<?php

namespace App\Http\Controllers\Provider;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Provider\Lesson\StoreLessonRequest;
use App\Http\Requests\Provider\Lesson\UpdateLessonRequest;
use App\Models\Lesson;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lessons = Lesson::with(['unit.classRoom'])
            ->whereRelation('unit.classRoom', 'provider_id', auth('web')->user()->provider->id)
            ->paginate(10);

        return view('provider.lesson.index', compact('lessons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $units = Unit::with(['classRoom'])
            ->whereRelation('classRoom', 'provider_id', auth('web')->user()->provider->id)
            ->get();

        return view('provider.lesson.create', compact('units'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLessonRequest $request)
    {
        $image = Helpers::addImage($request->image, 'lesson');

        Lesson::create([
            'name' => $request->name,
            'description' => $request->description,
            'sort_order' => $request->sort_order,
            'unit_id' => $request->unit_id,
            'image' => $image,
        ]);

        return redirect()->route('provider.lessons.index')->with('success', __('message.Lesson Added Successfully'));
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
        $lesson = Lesson::findOrFail($id);
        $units = Unit::with(['classRoom'])
            ->whereRelation('classRoom', 'provider_id', auth('web')->user()->provider->id)
            ->get();

        return view('provider.lesson.edit', compact('lesson', 'units'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLessonRequest $request, string $id)
    {
        $lesson = Lesson::findOrFail($id);

        $image = $request->image ? $request->image : $lesson->image;

        if ($request->image) {
            if (File::exists($lesson->image)) {
                File::delete($lesson->image);
            }
            $image = Helpers::addImage($request->image, 'lesson');
        }

        $lesson->update([
            'name' => $request->name,
            'description' => $request->description,
            'image'       => $image,
            'sort_order'  => $request->sort_order,
            'unit_id'     => $request->unit_id,
        ]);

        return redirect()->route('provider.lessons.index')->with('success', __('message.Lesson Edit Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $lesson = Lesson::findOrFail($id);

        $lesson->delete();

        return redirect()->route('provider.lessons.index')->with('success', __('message.Lesson Deleted Successfully'));
    }
}
