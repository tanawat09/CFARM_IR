<?php

namespace App\Http\Controllers;

use App\Models\GovernanceDocument;
use App\Models\GovernanceSection;

class GovernanceController extends Controller
{
    // Section definitions with icons
    public const SECTIONS = [
        'good-governance'       => ['icon' => 'bi-shield-check',    'th' => 'การกำกับดูแลกิจการที่ดี',                          'en' => 'Good Corporate Governance'],
        'structure-charter'     => ['icon' => 'bi-diagram-3',       'th' => 'โครงสร้างและกฎบัตร',                                'en' => 'Structure & Charter'],
        'principles-policies'   => ['icon' => 'bi-journal-check',   'th' => 'หลักการและนโยบายการกำกับดูแลกิจการที่ดี',           'en' => 'Governance Principles & Policies'],
        'business-ethics'       => ['icon' => 'bi-hand-thumbs-up',  'th' => 'จรรยาบรรณธุรกิจและนโยบาย',                         'en' => 'Business Ethics & Policies'],
        'risk-management'       => ['icon' => 'bi-exclamation-triangle', 'th' => 'การบริหารความเสี่ยง',                          'en' => 'Risk Management'],
        'regulatory-compliance' => ['icon' => 'bi-clipboard-check', 'th' => 'การกำกับปฏิบัติตามกฎเกณฑ์',                        'en' => 'Regulatory Compliance'],
        'security-governance'   => ['icon' => 'bi-lock',            'th' => 'การกำกับดูแลและรักษาความปลอดภัย',                   'en' => 'Security Governance'],
        'whistleblowing'        => ['icon' => 'bi-megaphone',       'th' => 'การร้องเรียนและแจ้งเบาะแส',                        'en' => 'Whistleblowing'],
        'awareness-culture'     => ['icon' => 'bi-people-fill',     'th' => 'การสร้างความตระหนักรู้และวัฒนธรรมองค์กร',           'en' => 'Awareness & Corporate Culture'],
    ];

    public function index()
    {
        $section = request('section', 'good-governance');
        $sections = self::SECTIONS;

        // Validate section
        if (!array_key_exists($section, $sections)) {
            $section = 'good-governance';
        }

        $documents = GovernanceDocument::where('category', $section)
            ->orderBy('display_order')
            ->orderBy('effective_date', 'desc')
            ->get();

        // Count documents per section
        $sectionCounts = GovernanceDocument::selectRaw('category, COUNT(*) as count')
            ->groupBy('category')
            ->pluck('count', 'category')
            ->toArray();

        // Get rich content for the current section
        $sectionContent = GovernanceSection::where('section_key', $section)->first();

        return view('public.governance.index', compact('documents', 'sections', 'section', 'sectionCounts', 'sectionContent'));
    }
}
