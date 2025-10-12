<?php

namespace App\Http\Controllers\Admin;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\GalleryCategoryRequest;
use App\Models\GalleryCategory;

class GalleryCategoryController extends Controller
{
    public function index(): View
    {
        return view('admin.galleryCategory.index', [
            'galleryCategories' => GalleryCategory::query()->select(['id', 'title', 'description'])
                ->latest()->get()
        ]);
    }

    public function create(): View
    {
        return view('admin.galleryCategory.create');
    }

    public function store(GalleryCategoryRequest $request): RedirectResponse
    {
        $galleryCategory = GalleryCategory::create($request->validated());

        return redirect()->route('admin.galleryCategory.index')->with('success', 'Gallery Category Created Successfully!');
    }

    public function show(GalleryCategory $galleryCategory): View
    {
        return view('admin.galleryCategory.show', compact('galleryCategory'));
    }

    public function edit(GalleryCategory $galleryCategory): View
    {
        return view('admin.galleryCategory.edit', compact('galleryCategory'));
    }

    public function update(GalleryCategoryRequest $request, GalleryCategory $galleryCategory): RedirectResponse
    {
        $galleryCategory->update($request->validated());

        return redirect()->route('admin.galleryCategory.index')->with('success', 'Gallery Category Updated Successfully!');
    }

    public function destroy(GalleryCategory $galleryCategory): RedirectResponse
    {
        $galleryCategory->delete();

        return redirect()->route('admin.galleryCategory.index')->with('error', 'Gallery Category Deleted Successfully!');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');
        if (!empty($ids)) {
            GalleryCategory::whereIn('id', $ids)->delete();
            return response()->json(['status' => 'success', 'message' => 'Selected galery category have been deleted successfully.']);
        } else {
            return response()->json(['error' => 'No gallery category selected for deletion.'], 400);
        }
    }
}
