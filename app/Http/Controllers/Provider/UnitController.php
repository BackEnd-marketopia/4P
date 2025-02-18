<?php

namespace App\Http\Controllers\Provider;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Provider\Unit\StoreUnitRequest;
use App\Http\Requests\Provider\Unit\UpdateUnitRequest;
use App\Models\ClassRoom;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $units = Unit::with(['classRoom'])
            ->whereRelation(
                'classRoom',
                'provider_id',
                auth('web')->user()->provider->id
            )
            ->paginate(10);

        return view('provider.unit.index', compact('units'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classRooms = ClassRoom::with(['educationDepartment'])->where('provider_id', auth('web')->user()->provider->id)->get();

        return view('provider.unit.create', compact('classRooms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUnitRequest $request)
    {
        $image = Helpers::addImage($request->image, 'unit');

        Unit::create([
            'name_arabic' => $request->name_arabic,
            'name_english' => $request->name_english,
            'description' => $request->description,
            'sort_order' => $request->sort_order,
            'class_room_id' => $request->class_room_id,
            'image' => $image,
        ]);

        return redirect()->route('provider.units.index')->with('success', __('message.Unit Added Successfully'));
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
        $unit = Unit::findOrFail($id);

        $classRooms = ClassRoom::with(['educationDepartment'])
            ->where('provider_id', auth('web')->user()->provider->id)
            ->get();

        return view('provider.unit.edit', compact('unit', 'classRooms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUnitRequest $request, string $id)
    {
        $unit = Unit::findOrFail($id);

        $image = $request->image ? $request->image : $unit->image;

        if ($request->image) {
            if (File::exists($unit->image)) {
                File::delete($unit->image);
            }
            $image = Helpers::addImage($request->image, 'unit');
        }

        $unit->update([
            'name_arabic' => $request->name_arabic,
            'name_english' => $request->name_english,
            'description' => $request->description,
            'image' => $image,
            'sort_order' => $request->sort_order,
            'class_room_id' => $request->class_room_id,
        ]);

        return redirect()->route('provider.units.index')->with('success', __('message.Unit Edit Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $unit = Unit::findOrFail($id);

        $unit->delete();

        return redirect()->route('provider.units.index')->with('success', __('message.Unit Deleted Successfully'));
    }
}
