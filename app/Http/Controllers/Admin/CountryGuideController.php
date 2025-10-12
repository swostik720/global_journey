<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CountryGuide;
use App\Models\Country;
use App\Http\Requests\CountryGuideRequest;
use Illuminate\Http\Request;

class CountryGuideController extends Controller
{
    public function index()
    {
        $items = CountryGuide::with('country')->paginate(20);
        return view('admin.country_guide.index', compact('items'));
    }

    public function create()
    {
        $countries = Country::all();
        return view('admin.country_guide.create', compact('countries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'country_id' => 'required|exists:countries,id',
            'guides' => 'required|string', // textarea string
        ]);

        $guidesArray = array_filter(array_map('trim', explode("\n", $request->guides)));

        CountryGuide::create([
            'country_id' => $request->country_id,
            'guides' => $guidesArray,
        ]);

        return redirect()->route('admin.country_guide.index')
            ->with('success', 'Country guide created successfully.');
    }


    public function show($id)
    {
        $item = CountryGuide::with('country')->findOrFail($id);
        return view('admin.country_guide.show', compact('item'));
    }

    public function edit($id)
    {
        $item = CountryGuide::findOrFail($id);
        $countries = Country::all();
        return view('admin.country_guide.edit', compact('item', 'countries'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'country_id' => 'required|exists:countries,id',
            'guides' => 'required|string',
        ]);

        $item = \App\Models\CountryGuide::findOrFail($id);

        $guidesArray = array_filter(array_map('trim', explode("\n", $request->guides)));

        $item->update([
            'country_id' => $request->country_id,
            'guides' => $guidesArray,
        ]);

        return redirect()->route('admin.country_guide.index')
            ->with('success', 'Country guide updated successfully.');
    }

    public function destroy($id)
    {
        $item = CountryGuide::findOrFail($id);
        $item->delete();
        return redirect()->route('admin.country_guide.index')->with('success', 'Country Guide deleted.');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids', []);
        if (!empty($ids)) {
            CountryGuide::whereIn('id', $ids)->delete();
            return response()->json(['success' => true, 'message' => 'Selected guides deleted.']);
        }
        return response()->json(['success' => false, 'message' => 'No items selected.']);
    }
}
