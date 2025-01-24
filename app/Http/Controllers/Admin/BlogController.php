<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BlogStoreRequest;
use App\Http\Requests\Admin\BlogUpdateRequest;
use App\Models\Blog;
use App\Models\Category;
use App\Traits\StatusTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BlogController extends Controller
{
    use StatusTrait;
    public function index(): View
    {
        return view('admin.blog.index', [
            'blogs' => Blog::query()->select(['id', 'image', 'category_id', 'title', 'blog_date', 'status'])->latest()->get()
        ]);
    }

    public function create(): View
    {
        $data['categories'] = Category::active()->pluck('name', 'id');
        return view('admin.blog.create', $data);
    }

    public function store(BlogStoreRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        $validatedData['user_id'] = auth()->id();
        $blog = Blog::create($validatedData);

        if ($request->hasFile('image')) {
            $blog->storeImage('image', 'blog-images', $request->file('image'));
        }

        return redirect()->route('admin.blogs.index')->with('success', 'Blog Created Successfully!');
    }

    public function show(Blog $blog): View
    {
        return view('admin.blog.show', compact('blog'));
    }

    public function edit(Blog $blog): View
    {
        $categories = Category::active()->pluck('name', 'id');
        return view('admin.blog.edit', compact('blog', 'categories'));
    }

    public function update(BlogUpdateRequest $request, Blog $blog): RedirectResponse
    {
        $data = $request->safe()->except('image');
        if ($request->input('image_removed') == 'true') {
            $blog->deleteImage('image', 'blog-images');
            $data['image'] = null;
        }

        $data['user_id'] = auth()->id();

        $blog->update($data);

        if ($request->hasFile('image')) {
            $blog->updateImage('image', 'blog-images', $request->file('image'));
        }

        return redirect()->route('admin.blogs.index')->with('success', 'Blog Updated Successfully!');
    }

    public function destroy(Blog $blog): RedirectResponse
    {
        if ($blog->image) {
            $blog->deleteImage('image', 'blog-images');
        }
        $blog->delete();

        return redirect()->route('admin.blogs.index')->with('error', 'Blog Deleted Successfully!');
    }

    public function changeStatus(Request $request): void
    {
        $this->changeItemStatus('Blog', $request->id, $request->status);
    }
    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');
        if (!empty($ids)) {
            Blog::whereIn('id', $ids)->delete();
            return response()->json(['status' => 'success', 'message' => 'Selected blog have been deleted successfully.']);
        } else {
            return response()->json(['error' => 'No blog selected for deletion.'], 400);
        }
    }
}
