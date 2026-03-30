<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RevenueStructure;
use Illuminate\Http\Request;

class RevenueStructureController extends Controller
{
    private const ALLOWED_CUSTOM_ICONS = [
        'cfarm-chicken',
    ];

    public function index()
    {
        $structures = RevenueStructure::ordered()->get();

        return view('admin.revenue_structures.index', compact('structures'));
    }

    public function create()
    {
        return view('admin.revenue_structures.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validatePayload($request);

        RevenueStructure::create($validated);

        return redirect()
            ->route('admin.revenue-structures.index')
            ->with('success', 'Revenue structure created successfully.');
    }

    public function edit(RevenueStructure $revenueStructure)
    {
        return view('admin.revenue_structures.edit', compact('revenueStructure'));
    }

    public function update(Request $request, RevenueStructure $revenueStructure)
    {
        $validated = $this->validatePayload($request);

        $revenueStructure->update($validated);

        return redirect()
            ->route('admin.revenue-structures.index')
            ->with('success', 'Revenue structure updated successfully.');
    }

    public function destroy(RevenueStructure $revenueStructure)
    {
        $revenueStructure->delete();

        return redirect()
            ->route('admin.revenue-structures.index')
            ->with('success', 'Revenue structure deleted successfully.');
    }

    private function validatePayload(Request $request): array
    {
        $validated = $request->validate([
            'title_th' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'description_th' => 'nullable|string|max:2000',
            'description_en' => 'nullable|string|max:2000',
            'percentage' => 'required|integer|min:0|max:100',
            'order' => 'required|integer|min:0',
            'icon_class' => [
                'nullable',
                'string',
                'max:100',
                function ($attribute, $value, $fail) {
                    if (! $this->isAllowedIcon((string) $value)) {
                        $fail('The '.$attribute.' field must be a Bootstrap icon class or an approved custom icon.');
                    }
                },
            ],
            'color' => 'nullable|string|in:primary,success,warning,danger,info,dark',
        ]);

        $validated['icon_class'] = $validated['icon_class'] ?? 'bi bi-pie-chart';
        $validated['color'] = $validated['color'] ?? 'primary';

        return $validated;
    }

    private function isAllowedIcon(string $value): bool
    {
        return preg_match('/^bi(?:\s+bi-[a-z0-9-]+)+$/i', $value) === 1
            || in_array($value, self::ALLOWED_CUSTOM_ICONS, true);
    }
}
