<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\WhyCountryRequest;
use App\Models\WhyCountry;
use App\Models\Country;
use Illuminate\Http\Request;

class WhyCountryController extends Controller
{
    public function index()
    {
        $items = WhyCountry::with('country')->paginate(20);
        return view('admin.why_country.index', compact('items'));
    }

    public function create()
    {
        $countries = Country::all();
        return view('admin.why_country.create', compact('countries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'country_id' => 'required|exists:countries,id',
            'description' => 'required|string',
        ]);

        WhyCountry::create([
            'country_id' => $request->country_id,
            'description' => array_filter(array_map('trim', explode("\n", $request->description))),
        ]);

        return redirect()->route('admin.why_country.index')->with('success', 'Why Country created successfully.');
    }

    public function show($id)
    {
        $item = WhyCountry::with('country')->findOrFail($id);
        return view('admin.why_country.show', compact('item'));
    }

    public function edit($id)
    {
        $item = WhyCountry::findOrFail($id);
        $countries = Country::all();
        return view('admin.why_country.edit', compact('item', 'countries'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'country_id' => 'required|exists:countries,id',
            'description' => 'required|string',
        ]);

        $item = WhyCountry::findOrFail($id);

        $item->update([
            'country_id' => $request->country_id,
            'description' => array_filter(array_map('trim', explode("\n", $request->description))),
        ]);

        return redirect()->route('admin.why_country.index')
            ->with('success', 'Why Country updated successfully.');
    }

    public function destroy($id)
    {
        $item = WhyCountry::findOrFail($id);
        $item->delete();
        return redirect()->route('admin.why_country.index')->with('success', 'Why Country entry deleted.');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids', []);
        if (!empty($ids)) {
            WhyCountry::whereIn('id', $ids)->delete();
            return response()->json(['success' => true, 'message' => 'Selected entries deleted.']);
        }
        return response()->json(['success' => false, 'message' => 'No items selected.']);
    }
}
