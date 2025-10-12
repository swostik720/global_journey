<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GalleryRequest;
use App\Models\Gallery;
use App\Models\GalleryCategory;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class GalleryController extends Controller
{
    /**
     * Display a listing of galleries.
     */
    public function index(): View
    {
        $galleries = Gallery::with('galleryCategory')
            ->latest()
            ->get();

        return view('admin.gallery.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new gallery.
     */
    public function create(): View
    {
        $categories = GalleryCategory::pluck('title', 'id');
        return view('admin.gallery.create', compact('categories'));
    }

    /**
     * Store a newly created gallery in storage.
     */
    public function store(GalleryRequest $request): RedirectResponse
    {
        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $imageName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploaded-images/gallery'), $imageName);
                $images[] = $imageName;
            }
        }

        Gallery::create([
            'title' => $request->title,
            'gallery_category_id' => $request->gallery_category_id,
            'images' => $images,
        ]);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Gallery created successfully!');
    }

    /**
     * Display the specified gallery.
     */
    public function show(Gallery $gallery): View
    {
        return view('admin.gallery.show', compact('gallery'));
    }

    /**
     * Show the form for editing the specified gallery.
     */
    public function edit(Gallery $gallery): View
    {
        $categories = GalleryCategory::all();
        return view('admin.gallery.edit', compact('gallery', 'categories'));
    }

    /**
     * Update the specified gallery in storage.
     */
    public function update(GalleryRequest $request, Gallery $gallery): RedirectResponse
    {
        // Remove selected images
        if ($request->filled('remove_images')) {
            foreach ($request->remove_images as $img) {
                $gallery->removeImage($img);
                if (file_exists(public_path('uploaded-images/gallery/' . $img))) {
                    unlink(public_path('uploaded-images/gallery/' . $img));
                }
            }
        }

        // Add new images
        if ($request->hasFile('images')) {
            $newImages = [];
            foreach ($request->file('images') as $file) {
                $imageName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploaded-images/gallery'), $imageName);
                $newImages[] = $imageName;
            }
            $gallery->addImages($newImages);
        }

        // Update title and category
        $gallery->update([
            'title' => $request->title,
            'gallery_category_id' => $request->gallery_category_id,
        ]);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Gallery updated successfully!');
    }

    /**
     * Remove the specified gallery from storage.
     */
    public function destroy(Gallery $gallery): RedirectResponse
    {
        // Delete images from public folder
        if ($gallery->images) {
            foreach ($gallery->images as $image) {
                if (file_exists(public_path('uploaded-images/gallery/' . $image))) {
                    unlink(public_path('uploaded-images/gallery/' . $image));
                }
            }
        }

        $gallery->delete();

        return redirect()->route('admin.gallery.index')
            ->with('error', 'Gallery deleted successfully!');
    }

    /**
     * Bulk delete galleries.
     */
    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids', []);

        if (!empty($ids)) {
            $galleries = Gallery::whereIn('id', $ids)->get();

            foreach ($galleries as $gallery) {
                // Delete images
                if ($gallery->images) {
                    foreach ($gallery->images as $image) {
                        if (file_exists(public_path('uploaded-images/gallery/' . $image))) {
                            unlink(public_path('uploaded-images/gallery/' . $image));
                        }
                    }
                }
                $gallery->delete();
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Selected galleries have been deleted successfully.'
            ]);
        }

        return response()->json(['error' => 'No galleries selected for deletion.'], 400);
    }

    public function deleteImage(Request $request, Gallery $gallery)
    {
        $image = $request->input('image');

        if (!$image || !in_array($image, $gallery->images ?? [])) {
            return response()->json(['error' => 'Image not found in gallery.'], 404);
        }

        // Remove image from gallery
        $gallery->removeImage($image);

        // Delete from storage
        if (file_exists(storage_path('app/public/galleries/' . $image))) {
            unlink(storage_path('app/public/galleries/' . $image));
        }

        return response()->json(['success' => true, 'message' => 'Image deleted successfully.']);
    }
}
