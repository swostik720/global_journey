<?php

namespace App\Http\Controllers\Admin;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\StudyAbroad;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StudyAbroadStoreRequest;
use App\Http\Requests\Admin\StudyAbroadUpdateRequest;
use App\Models\Country;
use App\Traits\StatusTrait;

class StudyAbroadController extends Controller
{
    use StatusTrait;
    public function index(): View
    {
        return view('admin.study_abroad.index', [
            'study_abroads' => StudyAbroad::query()->select(['id', 'image', 'title', 'country_id', 'status'])->latest()->get()
        ]);
    }

    public function create(): View
    {
        $data['countries'] = Country::active()->pluck('name', 'id');
        return view('admin.study_abroad.create', $data);
    }

    public function store(StudyAbroadStoreRequest $request): RedirectResponse
    {
        $study_abroad = StudyAbroad::create($request->safe()->except('image'));
        if ($request->hasFile('image')) {
            $study_abroad->storeImage('image', 'study-abroad-images', $request->file('image'));
        }

        return redirect()->route('admin.study-abroads.index')->with('success', 'Study Abroad Created Successfully!');
    }

    public function show(StudyAbroad $study_abroad): View
    {
        return view('admin.study_abroad.show', compact('study_abroad'));
    }

    public function edit(StudyAbroad $study_abroad): View
    {
        $countries = Country::active()->pluck('name', 'id');
        return view('admin.study_abroad.edit', compact('study_abroad', 'countries'));
    }

    public function update(StudyAbroadUpdateRequest $request, StudyAbroad $study_abroad): RedirectResponse
    {
        $data = $request->safe()->except('image');
        if ($request->input('image_removed') == 'true') {
            $study_abroad->deleteImage('image', 'study-abroad-images');
            $data['image'] = null;
        }

        $study_abroad->update($data);

        if ($request->hasFile('image')) {
            $study_abroad->updateImage('image', 'study-abroad-images', $request->file('image'));
        }

        return redirect()->route('admin.study-abroads.index')->with('success', 'Study Abroad Updated Successfully!');
    }

    public function destroy(StudyAbroad $study_abroad): RedirectResponse
    {
        if ($study_abroad->image) {
            $study_abroad->deleteImage('image', 'study_abroad-images');
        }

        $study_abroad->delete();

        return redirect()->route('admin.study-abroads.index')->with('error', 'Study Abroad Deleted Successfully!');
    }

    public function changeStatus(Request $request): void
    {
        $this->changeItemStatus('StudyAbroad', $request->id, $request->status);
    }
    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');
        if (!empty($ids)) {
            StudyAbroad::whereIn('id', $ids)->delete();
            return response()->json(['status' => 'success', 'message' => 'Selected study abroad have been deleted successfully.']);
        } else {
            return response()->json(['error' => 'No study abroad selected for deletion.'], 400);
        }
    }
}
