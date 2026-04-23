<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Popup;
use Illuminate\Http\Request;

class PopupController extends Controller
{
    public function index()
    {
        $popups = Popup::orderBy('display_order')->orderBy('created_at', 'desc')->get();
        return view('admin.popups.index', compact('popups'));
    }

    public function create()
    {
        return view('admin.popups.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title_th'     => 'required|string|max:255',
            'title_en'     => 'nullable|string|max:255',
            'content_th'   => 'nullable|string',
            'content_en'   => 'nullable|string',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:10240',
            'link_url'     => 'nullable|url|max:500',
            'link_text_th' => 'nullable|string|max:100',
            'link_text_en' => 'nullable|string|max:100',
            'is_active'    => 'nullable|boolean',
            'start_date'   => 'nullable|date',
            'end_date'     => 'nullable|date|after_or_equal:start_date',
            'display_pages'=> 'required|in:home,all',
            'display_order'=> 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('popups', 'public');
        }

        $data['is_active'] = $request->has('is_active');
        $data['display_order'] = $data['display_order'] ?? 0;

        Popup::create($data);

        return redirect()->route('admin.popups.index')
            ->with('success', 'สร้าง Popup สำเร็จ');
    }

    public function edit(Popup $popup)
    {
        return view('admin.popups.edit', compact('popup'));
    }

    public function update(Request $request, Popup $popup)
    {
        $data = $request->validate([
            'title_th'     => 'required|string|max:255',
            'title_en'     => 'nullable|string|max:255',
            'content_th'   => 'nullable|string',
            'content_en'   => 'nullable|string',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:10240',
            'link_url'     => 'nullable|url|max:500',
            'link_text_th' => 'nullable|string|max:100',
            'link_text_en' => 'nullable|string|max:100',
            'is_active'    => 'nullable|boolean',
            'start_date'   => 'nullable|date',
            'end_date'     => 'nullable|date|after_or_equal:start_date',
            'display_pages'=> 'required|in:home,all',
            'display_order'=> 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('popups', 'public');
        }

        $data['is_active'] = $request->has('is_active');
        $data['display_order'] = $data['display_order'] ?? 0;

        $popup->update($data);

        return redirect()->route('admin.popups.index')
            ->with('success', 'อัปเดต Popup สำเร็จ');
    }

    public function destroy(Popup $popup)
    {
        $popup->delete();
        return redirect()->route('admin.popups.index')
            ->with('success', 'ลบ Popup สำเร็จ');
    }
}
