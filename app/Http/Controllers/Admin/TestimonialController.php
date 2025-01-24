<?php

namespace App\Http\Controllers\Admin;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Testimonial;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TestimonialStoreRequest;
use App\Http\Requests\Admin\TestimonialUpdateRequest;
use App\Traits\StatusTrait;

class TestimonialController extends Controller
{
    use StatusTrait;
    public function index(): View
    {
        return view('admin.testimonial.index', [
            'testimonials' => Testimonial::query()->select(['id', 'image', 'name', 'address', 'status'])->latest()->get()
        ]);
    }

    public function create(): View
    {
        return view('admin.testimonial.create');
    }

    public function store(TestimonialStoreRequest $request): RedirectResponse
    {
        $testimonial = Testimonial::create($request->safe()->except('image'));
        if ($request->hasFile('image')) {
            $testimonial->storeImage('image', 'testimonial-images', $request->file('image'));
        }

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial Created Successfully!');
    }

    public function show(Testimonial $testimonial): View
    {
        return view('admin.testimonial.show', compact('testimonial'));
    }

    public function edit(Testimonial $testimonial): View
    {
        return view('admin.testimonial.edit', compact('testimonial'));
    }

    public function update(TestimonialUpdateRequest $request, Testimonial $testimonial): RedirectResponse
    {
        $data = $request->safe()->except('image');
        if ($request->input('image_removed') == 'true') {
            $testimonial->deleteImage('image', 'testimonial-images');
            $data['image'] = null;
        }

        $testimonial->update($data);

        if ($request->hasFile('image')) {
            $testimonial->updateImage('image', 'testimonial-images', $request->file('image'));
        }

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial Updated Successfully!');
    }

    public function destroy(Testimonial $testimonial): RedirectResponse
    {
        if ($testimonial->image) {
            $testimonial->deleteImage('image', 'testimonial-images');
        }

        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')->with('error', 'Testimonial Deleted Successfully!');
    }

    public function changeStatus(Request $request): void
    {
        $this->changeItemStatus('Testimonial', $request->id, $request->status);
    }
    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');
        if (!empty($ids)) {
            Testimonial::whereIn('id', $ids)->delete();
            return response()->json(['status' => 'success', 'message' => 'Selected testimonial have been deleted successfully.']);
        } else {
            return response()->json(['error' => 'No testimonial selected for deletion.'], 400);
        }
    }
}
