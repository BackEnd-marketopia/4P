<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PlayerForm;
use Illuminate\Http\Request;

class PlayerFormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $player_forms = PlayerForm::where('is_deleted', false)->paginate(10);
        return view('admin.player_form.index', compact('player_forms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $player = PlayerForm::findOrFail($id);
        return view('admin.player_form.show', compact('player'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $player = PlayerForm::findOrFail($id);

        $player->update(['is_deleted' => true]);

        return redirect()->back()->with('success', __('message.Player Form Deleted Successfully'));
    }
}
