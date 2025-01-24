<?php

namespace App\Http\Controllers\Admin;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Branch;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BranchStoreRequest;
use App\Http\Requests\Admin\BranchUpdateRequest;
use App\Traits\StatusTrait;

class BranchController extends Controller
{
    use StatusTrait;
    public function index(): View
    {
        return view('admin.branch.index', [
            'branches' => Branch::query()->select(['id', 'name', 'email', 'phone', 'contact_address', 'working_hours', 'status'])->latest()->get()
        ]);
    }

    public function create(): View
    {
        return view('admin.branch.create');
    }

    public function store(BranchStoreRequest $request): RedirectResponse
    {
        $branch = Branch::create($request->validated());

        return redirect()->route('admin.branches.index')->with('success', 'Branch Created Successfully!');
    }

    public function show(Branch $branch): View
    {
        return view('admin.branch.show', compact('branch'));
    }

    public function edit(Branch $branch): View
    {
        return view('admin.branch.edit', compact('branch'));
    }

    public function update(BranchUpdateRequest $request, Branch $branch): RedirectResponse
    {
        $branch->update($request->validated());

        return redirect()->route('admin.branches.index')->with('success', 'Branch Updated Successfully!');
    }

    public function destroy(Branch $branch): RedirectResponse
    {
        $branch->delete();

        return redirect()->route('admin.branches.index')->with('error', 'Branch Deleted Successfully!');
    }

    public function changeStatus(Request $request): void
    {
        $this->changeItemStatus('Branch', $request->id, $request->status);
    }
    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');
        if (!empty($ids)) {
            Branch::whereIn('id', $ids)->delete();
            return response()->json(['status' => 'success', 'message' => 'Selected branches have been deleted successfully.']);
        } else {
            return response()->json(['error' => 'No branches selected for deletion.'], 400);
        }
    }
}
