<?php

namespace App\Http\Controllers\Admin;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryStoreRequest;
use App\Http\Requests\Admin\CategoryUpdateRequest;
use App\Traits\StatusTrait;

class CategoryController extends Controller
{
    use StatusTrait;
    public function index(): View
    {
        return view('admin.category.index', [
            'categories' => Category::query()->select(['id', 'name', 'status'])->latest()->get()
        ]);
    }

    public function create(): View
    {
        return view('admin.category.create');
    }

    public function store(CategoryStoreRequest $request): RedirectResponse
    {
        $category = Category::create($request->validated());

        return redirect()->back()->with('success', 'Blog Category Created Successfully!');
    }

    public function show(Category $category): View
    {
        return view('admin.category.show', compact('category'));
    }

    public function edit(Category $category): View
    {
        return view('admin.category.edit', compact('category'));
    }

    public function update(CategoryUpdateRequest $request, Category $category): RedirectResponse
    {
        $category->update($request->validated());

        return redirect()->route('admin.categories.index')->with('success', 'Blog Category Updated Successfully!');
    }

    public function destroy(Category $category): RedirectResponse
    {


        $category->delete();

        return redirect()->route('admin.categories.index')->with('error', 'Blog Category Deleted Successfully!');
    }

    public function changeStatus(Request $request): void
    {
        $this->changeItemStatus('Category', $request->id, $request->status);
    }
    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');
        if (!empty($ids)) {
            Category::whereIn('id', $ids)->delete();
            return response()->json(['status' => 'success', 'message' => 'Selected blog category have been deleted successfully.']);
        } else {
            return response()->json(['error' => 'No blog category selected for deletion.'], 400);
        }
    }
}
