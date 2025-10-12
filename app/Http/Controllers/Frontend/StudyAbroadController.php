<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\DocumentChecklist;
use Illuminate\Http\Request;
use App\Enums\DocumentChecklistType;

class StudyAbroadController extends Controller
{
    public function documentChecklist($countryId)
    {
        $country = Country::findOrFail($countryId);
        $checklist = DocumentChecklist::where('country_id', $countryId)
            ->first();
    return view('frontend.study_abroad.document_checklist', compact('country', 'checklist'));
    }
}
