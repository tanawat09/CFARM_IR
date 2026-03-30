<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BoardDirector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BoardController extends Controller
{
    public function index()
    {
        $directors = BoardDirector::orderBy('display_order')->get();
        return view('admin.board.index', compact('directors'));
    }

    public function create()
    {
        return view('admin.board.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_th' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'position_th' => 'required|string|max:255',
            'position_en' => 'nullable|string|max:255',
            'biography_th' => 'nullable|string',
            'biography_en' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'display_order' => 'integer',
        ]);

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('board', 'public');
        }
        unset($validated['image']);

        BoardDirector::create($validated);

        return redirect()->route('admin.board.index')->with('success', 'Director added successfully.');
    }

    public function edit(BoardDirector $director)
    {
        return view('admin.board.edit', compact('director'));
    }

    public function update(Request $request, BoardDirector $director)
    {
        $validated = $request->validate([
            'name_th' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'position_th' => 'required|string|max:255',
            'position_en' => 'nullable|string|max:255',
            'biography_th' => 'nullable|string',
            'biography_en' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'display_order' => 'integer',
        ]);

        if ($request->hasFile('image')) {
            if ($director->image_path) {
                Storage::disk('public')->delete($director->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('board', 'public');
        }
        unset($validated['image']);

        $director->update($validated);

        return redirect()->route('admin.board.index')->with('success', 'Director updated successfully.');
    }

    public function destroy(BoardDirector $director)
    {
        if ($director->image_path) {
            Storage::disk('public')->delete($director->image_path);
        }
        $director->delete();
        return redirect()->route('admin.board.index')->with('success', 'Director deleted successfully.');
    }
}
