<?php

namespace App\Http\Controllers\Admin;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\EnrollNow;
use App\Models\TestPreparation;
use App\Http\Controllers\Controller;
use App\Http\Requests\EnrollNowRequest;

class EnrollNowController extends Controller
{
    /**
     * Display a listing of enrollments.
     */
    public function index(): View
    {
        $enrollments = EnrollNow::with(['testPreparation', 'branch'])
            ->select(['id', 'name', 'email', 'phone', 'test_preparation_id', 'branch_id', 'created_at'])
            ->latest()
            ->get();

        return view('admin.enrollNow.index', compact('enrollments'));
    }

    /**
     * Show the form for creating a new enrollment.
     */
    public function create(): View
    {
        $testPreparations = TestPreparation::select('id', 'title')->get();
        return view('admin.enrollNow.create', compact('testPreparations'));
    }

    /**
     * Store a newly created enrollment in storage.
     */
    public function store(EnrollNowRequest $request): RedirectResponse
    {
        EnrollNow::create($request->validated());

        return redirect()->route('admin.enrollNow.index')->with('success', 'Enrollment Created Successfully!');
    }

    /**
     * Display the specified enrollment.
     */
    public function show(EnrollNow $enrollNow): View
    {
        return view('admin.enrollNow.show', compact('enrollNow'));
    }

    /**
     * Show the form for editing the specified enrollment.
     */
    public function edit(EnrollNow $enrollNow): View
    {
        $testPreparations = TestPreparation::select('id', 'title')->get();
        return view('admin.enrollNow.edit', compact('enrollNow', 'testPreparations'));
    }

    /**
     * Update the specified enrollment in storage.
     */
    public function update(EnrollNowRequest $request, EnrollNow $enrollNow): RedirectResponse
    {
        $enrollNow->update($request->validated());

        return redirect()->route('admin.enrollNow.index')->with('success', 'Enrollment Updated Successfully!');
    }

    /**
     * Remove the specified enrollment from storage.
     */
    public function destroy(EnrollNow $enrollNow): RedirectResponse
    {
        $enrollNow->delete();

        return redirect()->route('admin.enrollNow.index')->with('success', 'Enrollment Deleted Successfully!');
    }

    /**
     * Bulk delete enrollments.
     */
    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');
        if (!empty($ids)) {
            EnrollNow::whereIn('id', $ids)->delete();
            return response()->json(['status' => 'success', 'message' => 'Selected enrollments have been deleted successfully.']);
        } else {
            return response()->json(['error' => 'No enrollments selected for deletion.'], 400);
        }
    }
}
