<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    private const ALLOWED_GROUPS = [
        'company_profile',
        'financial_highlights',
    ];

    /**
     * Show the business overview edit form.
     */
    public function businessOverview()
    {
        $settings = Setting::where('group', 'home_page')->get()->keyBy('key');
        return view('admin.settings.business_overview', compact('settings'));
    }

    /**
     * Show the financial highlights editor for homepage.
     */
    public function financialHighlights()
    {
        $settings = Setting::where('group', 'financial_highlights')->get()->keyBy('key');
        return view('admin.settings.financial_highlights', compact('settings'));
    }

    /**
     * Show the company profile edit form.
     */
    public function companyProfile()
    {
        $settings = Setting::where('group', 'company_profile')->get()->keyBy('key');
        return view('admin.settings.company_profile', compact('settings'));
    }

    /**
     * Update the settings in storage.
     */
    public function update(Request $request)
    {
        $group = $request->input('_group', 'home_page');
        abort_unless(in_array($group, self::ALLOWED_GROUPS, true), 422);

        $validated = Validator::make(
            $request->all(),
            $this->rulesForGroup($group)
        )->validate();

        $data = collect($validated)->except(['_token', '_method', '_group'])->all();

        foreach ($request->allFiles() as $key => $file) {
            if (!array_key_exists($key, $this->fileRulesForGroup($group))) {
                continue;
            }

            if ($file->isValid()) {
                $existing = Setting::where('key', $key)->first();

                if ($existing && $existing->value_th) {
                    Storage::disk('public')->delete($existing->value_th);
                }

                $path = $file->store('company_images', 'public');

                Setting::updateOrCreate(
                    ['key' => $key],
                    [
                        'value_th' => $path,
                        'value_en' => $path,
                        'type' => 'image',
                        'group' => $group,
                    ]
                );
            }

            unset($data[$key]);
        }

        foreach ($data as $key => $values) {
            if (!is_array($values)) {
                continue;
            }

            Setting::updateOrCreate(
                ['key' => $key],
                [
                    'value_th' => $this->sanitizeSettingValue($key, $values['th'] ?? ''),
                    'value_en' => $this->sanitizeSettingValue($key, $values['en'] ?? ''),
                    'type' => 'text',
                    'group' => $group,
                ]
            );
        }

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }

    private function rulesForGroup(string $group): array
    {
        $rules = [
            '_group' => 'required|string|in:'.implode(',', self::ALLOWED_GROUPS),
        ];

        foreach ($this->textRulesForGroup($group) as $key => $ruleSet) {
            $rules[$key] = 'nullable|array';
            $rules["{$key}.th"] = $ruleSet['th'];
            $rules["{$key}.en"] = $ruleSet['en'];
        }

        foreach ($this->fileRulesForGroup($group) as $key => $rule) {
            $rules[$key] = $rule;
        }

        return $rules;
    }

    private function textRulesForGroup(string $group): array
    {
        if ($group === 'company_profile') {
            $longText = 'nullable|string|max:5000';
            $shortText = 'nullable|string|max:255';

            return [
                'cp_homepage_video_url' => ['th' => 'nullable|url|max:2048', 'en' => 'nullable|url|max:2048'],
                'cp_about_desc_1' => ['th' => $longText, 'en' => $longText],
                'cp_about_desc_2' => ['th' => $longText, 'en' => $longText],
                'cp_vision' => ['th' => $longText, 'en' => $longText],
                'cp_company_name' => ['th' => $shortText, 'en' => $shortText],
                'cp_capital' => ['th' => $shortText, 'en' => $shortText],
                'cp_farms_count' => ['th' => $shortText, 'en' => $shortText],
                'cp_address' => ['th' => $longText, 'en' => $longText],
                'cp_mission_1' => ['th' => $shortText, 'en' => $shortText],
                'cp_mission_2' => ['th' => $shortText, 'en' => $shortText],
                'cp_mission_3' => ['th' => $shortText, 'en' => $shortText],
                'cp_mission_4' => ['th' => $shortText, 'en' => $shortText],
                'cp_mission_5' => ['th' => $shortText, 'en' => $shortText],
                'cp_mission_6' => ['th' => $shortText, 'en' => $shortText],
                'cp_mission_7' => ['th' => $shortText, 'en' => $shortText],
                'cp_mission_8' => ['th' => $shortText, 'en' => $shortText],
                'cp_mission_9' => ['th' => $shortText, 'en' => $shortText],
            ];
        }

        return [
            'fh_registered_capital' => ['th' => 'nullable|numeric|min:0|max:999999999', 'en' => 'nullable|numeric|min:0|max:999999999'],
            'fh_paid_up_capital' => ['th' => 'nullable|numeric|min:0|max:999999999', 'en' => 'nullable|numeric|min:0|max:999999999'],
            'fh_farms_count' => ['th' => 'nullable|integer|min:0|max:9999', 'en' => 'nullable|string|max:255'],
            'fh_year_1' => ['th' => 'nullable|string|max:20', 'en' => 'nullable|string|max:20'],
            'fh_year_2' => ['th' => 'nullable|string|max:20', 'en' => 'nullable|string|max:20'],
            'fh_year_3' => ['th' => 'nullable|string|max:20', 'en' => 'nullable|string|max:20'],
            'fh_revenue_1' => ['th' => 'nullable|numeric|min:0|max:999999999', 'en' => 'nullable|numeric|min:0|max:999999999'],
            'fh_revenue_2' => ['th' => 'nullable|numeric|min:0|max:999999999', 'en' => 'nullable|numeric|min:0|max:999999999'],
            'fh_revenue_3' => ['th' => 'nullable|numeric|min:0|max:999999999', 'en' => 'nullable|numeric|min:0|max:999999999'],
            'fh_profit_1' => ['th' => 'nullable|numeric|min:0|max:999999999', 'en' => 'nullable|numeric|min:0|max:999999999'],
            'fh_profit_2' => ['th' => 'nullable|numeric|min:0|max:999999999', 'en' => 'nullable|numeric|min:0|max:999999999'],
            'fh_profit_3' => ['th' => 'nullable|numeric|min:0|max:999999999', 'en' => 'nullable|numeric|min:0|max:999999999'],
            'fh_assets_1' => ['th' => 'nullable|numeric|min:0|max:999999999', 'en' => 'nullable|numeric|min:0|max:999999999'],
            'fh_assets_2' => ['th' => 'nullable|numeric|min:0|max:999999999', 'en' => 'nullable|numeric|min:0|max:999999999'],
            'fh_assets_3' => ['th' => 'nullable|numeric|min:0|max:999999999', 'en' => 'nullable|numeric|min:0|max:999999999'],
        ];
    }

    private function fileRulesForGroup(string $group): array
    {
        if ($group !== 'company_profile') {
            return [];
        }

        return [
            'cp_company_image' => 'nullable|file|image|mimes:jpeg,png,webp|max:5120',
            'cp_hero_media' => 'nullable|file|mimetypes:image/jpeg,image/png,image/webp,video/mp4,video/webm,video/quicktime|max:20480',
        ];
    }

    private function sanitizeSettingValue(string $key, mixed $value): string
    {
        $value = trim((string) $value);

        if ($key === 'cp_homepage_video_url') {
            return $value;
        }

        return strip_tags($value);
    }
}
