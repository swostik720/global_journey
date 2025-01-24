<?php

namespace App\Http\Controllers\Admin;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Enquiry;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EnquiryStoreRequest;
use App\Http\Requests\Admin\EnquiryUpdateRequest;
use App\Traits\StatusTrait;

class EnquiryController extends Controller
{
    use StatusTrait;
    public function index(): View
    {
        return view('admin.enquiry.index', [
            'enquiries' => Enquiry::query()->select(['id', 'studyabroad_id', 'name', 'email', 'address', 'status'])->latest()->get()
        ]);
    }

    public function create(): View
    {
        return view('admin.enquiry.create');
    }

    public function store(EnquiryStoreRequest $request): RedirectResponse
    {
        $enquiry = Enquiry::create($request->validated());

        return redirect()->route('admin.enquiries.index')->with('success', 'Enquiry Created Successfully!');
    }

    public function show(Enquiry $enquiry): View
    {
        return view('admin.enquiry.show', compact('enquiry'));
    }

    public function edit(Enquiry $enquiry): View
    {
        return view('admin.enquiry.edit', compact('enquiry'));
    }

    public function update(EnquiryUpdateRequest $request, Enquiry $enquiry): RedirectResponse
    {
        $enquiry->update($request->validated());

        return redirect()->route('admin.enquiries.index')->with('success', 'Enquiry Updated Successfully!');
    }

    public function destroy(Enquiry $enquiry): RedirectResponse
    {
        $enquiry->delete();

        return redirect()->route('admin.enquiries.index')->with('error', 'Enquiry Deleted Successfully!');
    }

    public function enquiryInsideStatusChange(Request $request, $id)
    {
        $enquiry = Enquiry::find($id);
        $enquiry->status = $request->status;
        $enquiry->save();
        return redirect()->route('admin.enquiries.index')->with('success', 'Status changed successfully!');
    }
    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');
        if (!empty($ids)) {
            Enquiry::whereIn('id', $ids)->delete();
            return response()->json(['status' => 'success', 'message' => 'Selected enquiries have been deleted successfully.']);
        } else {
            return response()->json(['error' => 'No enquiries selected for deletion.'], 400);
        }
    }
}
