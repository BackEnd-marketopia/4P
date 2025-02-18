<?php

namespace App\Http\Controllers\Provider;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Provider\ClassRoom\StoreClassRoomRequest;
use App\Http\Requests\Provider\ClassRoom\UpdateClassRoomRequest;
use App\Models\ClassRoom;
use App\Models\EducationDepartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ClassRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classRooms = ClassRoom::where('provider_id', auth('web')->user()->provider->id)
            ->paginate(10);

        return view('provider.class_room.index', compact('classRooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $educationDepartments = EducationDepartment::whereRelation(
            'providers',
            'provider_id',
            auth('web')->user()->provider->id
        )->get();

        return view('provider.class_room.create', compact('educationDepartments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClassRoomRequest $request)
    {
        $image = Helpers::addImage($request->image, 'class-room');

        ClassRoom::create([
            'name_arabic' => $request->name_arabic,
            'name_english' => $request->name_english,
            'sort_order' => $request->sort_order,
            'image' => $image,
            'provider_id' => auth('web')->user()->provider->id,
            'education_department_id' => $request->education_department_id,
        ]);

        return redirect()->route('provider.class-rooms.index')->with('success', __('message.Class Room Added Successfully'));
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
        $classRoom = ClassRoom::findOrFail($id);

        $educationDepartments = EducationDepartment::whereRelation(
            'providers',
            'provider_id',
            auth('web')->user()->provider->id
        )->get();

        return view('provider.class_room.edit', compact('classRoom', 'educationDepartments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClassRoomRequest $request, string $id)
    {
        $classRoom = ClassRoom::findOrFail($id);

        $image = $request->image ? $request->image : $classRoom->image;

        if ($request->image) {
            if (File::exists($classRoom->image)) {
                File::delete($classRoom->image);
            }
            $image = Helpers::addImage($request->image, 'class-room');
        }

        $classRoom->update([
            'name_arabic' => $request->name_arabic,
            'name_english' => $request->name_english,
            'image' => $image,
            'sort_order' => $request->sort_order,
            'provider_id' => auth('web')->user()->provider->id,
            'education_department_id' => $request->education_department_id,
        ]);

        return redirect()->route('provider.class-rooms.index')->with('success', __('message.Class Room Edit Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $classRoom = ClassRoom::findOrFail($id);

        $classRoom->delete();

        return redirect()->route('provider.class-rooms.index')->with('success', __('message.Class Room Deleted Successfully'));
    }
}
