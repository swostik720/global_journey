<?php

namespace App\Http\Controllers\Admin;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Country;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CountryStoreRequest;
use App\Http\Requests\Admin\CountryUpdateRequest;
use App\Traits\StatusTrait;

class CountryController extends Controller
{
    use StatusTrait;
    public function index(): View
    {
        return view('admin.country.index', [
            'countries' => Country::query()->select(['id', 'name', 'status'])->latest()->get()
        ]);
    }

    public function create(): View
    {
        return view('admin.country.create');
    }

    public function store(CountryStoreRequest $request): RedirectResponse
    {
        $country = Country::create($request->validated());

        return redirect()->back()->with('success', 'Country Created Successfully!');
    }

    public function show(Country $country): View
    {
        return view('admin.country.show', compact('country'));
    }

    public function edit(Country $country): View
    {
        return view('admin.country.edit', compact('country'));
    }

    public function update(CountryUpdateRequest $request, Country $country): RedirectResponse
    {
        $country->update($request->validated());

        return redirect()->route('admin.countries.index')->with('success', 'Country Updated Successfully!');
    }

    public function destroy(Country $country): RedirectResponse
    {
        $country->delete();

        return redirect()->route('admin.countries.index')->with('error', 'Country Deleted Successfully!');
    }

    public function changeStatus(Request $request): void
    {
        $this->changeItemStatus('Country', $request->id, $request->status);
    }
    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');
        if (!empty($ids)) {
            Country::whereIn('id', $ids)->delete();
            return response()->json(['status' => 'success', 'message' => 'Selected country have been deleted successfully.']);
        } else {
            return response()->json(['error' => 'No country selected for deletion.'], 400);
        }
    }
}
