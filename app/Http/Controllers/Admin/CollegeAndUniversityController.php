<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CollegeAndUniversity;
use App\Models\Country;
use App\Http\Requests\CollegeAndUniversityRequest;
use Illuminate\Http\Request;

class CollegeAndUniversityController extends Controller
{
    public function index()
    {
        $items = CollegeAndUniversity::with('country')->paginate(20);
        return view('admin.college_and_university.index', compact('items'));
    }

    public function create()
    {
        $countries = Country::all();
        return view('admin.college_and_university.create', compact('countries'));
    }

    public function store(CollegeAndUniversityRequest $request)
    {
        $data = $request->validated();

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploaded-images/college_and_university'), $imageName);
            $data['image'] = $imageName;
        }

        CollegeAndUniversity::create($data);

        return redirect()->route('admin.college_and_university.index')
            ->with('success', 'College or University created.');
    }

    public function edit($id)
    {
        $item = CollegeAndUniversity::findOrFail($id);
        $countries = Country::all();
        return view('admin.college_and_university.edit', compact('item', 'countries'));
    }

    public function update(CollegeAndUniversityRequest $request, $id)
    {
        $item = CollegeAndUniversity::findOrFail($id);
        $data = $request->validated();

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploaded-images/college_and_university'), $imageName);
            $data['image'] = $imageName;
        }

        $item->update($data);

        return redirect()->route('admin.college_and_university.index')
            ->with('success', 'College or University updated.');
    }


    public function show($id)
    {
        $item = CollegeAndUniversity::with('country')->findOrFail($id);
        return view('admin.college_and_university.show', compact('item'));
    }

    public function destroy($id)
    {
        $item = CollegeAndUniversity::findOrFail($id);
        $item->delete();
        return redirect()->route('admin.college_and_university.index')->with('success', 'College or University deleted.');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids', []);
        if (!empty($ids)) {
            CollegeAndUniversity::whereIn('id', $ids)->delete();
            return response()->json(['success' => true, 'message' => 'Selected colleges/universities deleted.']);
        }
        return response()->json(['success' => false, 'message' => 'No items selected.']);
    }
}
