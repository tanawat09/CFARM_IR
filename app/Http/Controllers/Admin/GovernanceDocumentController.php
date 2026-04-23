<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\GovernanceController;
use App\Models\GovernanceDocument;
use App\Models\GovernanceSection;
use Illuminate\Http\Request;

class GovernanceDocumentController extends Controller
{
    public function index()
    {
        $documents = GovernanceDocument::orderBy('category')->orderBy('display_order')->get();
        $sections = GovernanceController::SECTIONS;
        $sectionContents = GovernanceSection::pluck('section_key')->toArray();
        return view('admin.governance.index', compact('documents', 'sections', 'sectionContents'));
    }

    public function create()
    {
        $sections = GovernanceController::SECTIONS;
        return view('admin.governance.create', compact('sections'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title_th'       => 'required|string|max:255',
            'title_en'       => 'nullable|string|max:255',
            'category'       => 'required|string',
            'file'           => 'required|file|mimes:pdf,doc,docx|max:20480',
            'version'        => 'nullable|string|max:50',
            'effective_date' => 'nullable|date',
            'display_order'  => 'nullable|integer',
        ]);

        $data['file_path'] = $request->file('file')->store('governance', 'public');
        $data['display_order'] = $data['display_order'] ?? 0;

        GovernanceDocument::create($data);

        return redirect()->route('admin.governance.index')
            ->with('success', 'เพิ่มเอกสารสำเร็จ');
    }

    public function edit(GovernanceDocument $governance)
    {
        $sections = GovernanceController::SECTIONS;
        return view('admin.governance.edit', compact('governance', 'sections'));
    }

    public function update(Request $request, GovernanceDocument $governance)
    {
        $data = $request->validate([
            'title_th'       => 'required|string|max:255',
            'title_en'       => 'nullable|string|max:255',
            'category'       => 'required|string',
            'file'           => 'nullable|file|mimes:pdf,doc,docx|max:20480',
            'version'        => 'nullable|string|max:50',
            'effective_date' => 'nullable|date',
            'display_order'  => 'nullable|integer',
        ]);

        if ($request->hasFile('file')) {
            $data['file_path'] = $request->file('file')->store('governance', 'public');
        }
        $data['display_order'] = $data['display_order'] ?? 0;

        $governance->update($data);

        return redirect()->route('admin.governance.index')
            ->with('success', 'อัปเดตเอกสารสำเร็จ');
    }

    public function destroy(GovernanceDocument $governance)
    {
        $governance->delete();
        return redirect()->route('admin.governance.index')
            ->with('success', 'ลบเอกสารสำเร็จ');
    }

    // ── Section Content Management ──
    public function editSection($key)
    {
        $sections = GovernanceController::SECTIONS;
        if (!array_key_exists($key, $sections)) abort(404);

        $sectionContent = GovernanceSection::firstOrCreate(
            ['section_key' => $key],
            ['content_th' => '', 'content_en' => '']
        );

        return view('admin.governance.edit_section', compact('sectionContent', 'sections', 'key'));
    }

    public function updateSection(Request $request, $key)
    {
        $sections = GovernanceController::SECTIONS;
        if (!array_key_exists($key, $sections)) abort(404);

        $data = $request->validate([
            'content_th' => 'nullable|string',
            'content_en' => 'nullable|string',
            'image'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);

        $sectionContent = GovernanceSection::firstOrCreate(
            ['section_key' => $key],
            ['content_th' => '', 'content_en' => '']
        );

        $sectionContent->content_th = $data['content_th'];
        $sectionContent->content_en = $data['content_en'];

        if ($request->hasFile('image')) {
            $sectionContent->image_path = $request->file('image')->store('governance/sections', 'public');
        }

        $sectionContent->save();

        return redirect()->route('admin.governance.index')
            ->with('success', 'อัปเดตเนื้อหาหมวด "' . $sections[$key]['th'] . '" สำเร็จ');
    }
}
