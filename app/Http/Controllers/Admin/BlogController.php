<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BlogStoreRequest;
use App\Http\Requests\Admin\BlogUpdateRequest;
use App\Models\Blog;
use App\Models\BlogAuthor;
use App\Models\Category;
use App\Traits\StatusTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BlogController extends Controller
{
    use StatusTrait;
    public function index(): View
    {
        return view('admin.blog.index', [
            'blogs' => Blog::query()
                ->with(['category:id,name', 'author:id,name'])
                ->select([
                    'id',
                    'image',
                    'category_id',
                    'blog_author_id',
                    'title',
                    'blog_date',
                    'status',
                    'quick_info_items',
                    'key_highlights',
                    'cta_title',
                ])->latest()->get()
        ]);
    }

    public function create(): View
    {
        $data['categories'] = Category::active()->pluck('name', 'id');
        $data['authors'] = BlogAuthor::active()->orderBy('name')->pluck('name', 'id');
        return view('admin.blog.create', $data);
    }

    public function store(BlogStoreRequest $request): RedirectResponse
    {
        $validatedData = $request->safe()->except('image');

        $validatedData['faqs'] = $this->normalizeFaqs($request->input('faqs', []));
        $validatedData['quick_info_items'] = $this->normalizeQuickInfoItems($request->input('quick_info_items', []));
        $validatedData['key_highlights'] = $this->normalizeSimpleList($request->input('key_highlights', []));

        $validatedData['user_id'] = Auth::id();
        $blog = Blog::create($validatedData);

        if ($request->hasFile('image')) {
            $blog->storeImage('image', 'blog-images', $request->file('image'));
        }

        return redirect()->route('admin.blogs.index')->with('success', 'Blog Created Successfully!');
    }

    public function show(Blog $blog): View
    {
        $blog->load(['author', 'category']);
        return view('admin.blog.show', compact('blog'));
    }

    public function edit(Blog $blog): View
    {
        $categories = Category::active()->pluck('name', 'id');
        $authors = BlogAuthor::active()->orderBy('name')->pluck('name', 'id');
        return view('admin.blog.edit', compact('blog', 'categories', 'authors'));
    }

    public function update(BlogUpdateRequest $request, Blog $blog): RedirectResponse
    {
        $data = $request->safe()->except('image');
        $data['faqs'] = $this->normalizeFaqs($request->input('faqs', []));
        $data['quick_info_items'] = $this->normalizeQuickInfoItems($request->input('quick_info_items', []));
        $data['key_highlights'] = $this->normalizeSimpleList($request->input('key_highlights', []));
        if ($request->input('image_removed') == 'true') {
            $blog->deleteImage('image', 'blog-images');
            $data['image'] = null;
        }

        $data['user_id'] = Auth::id();

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

    private function normalizeFaqs(array $faqs): array
    {
        return collect($faqs)
            ->map(function ($faq) {
                return [
                    'question' => trim((string) ($faq['question'] ?? '')),
                    'answer' => trim((string) ($faq['answer'] ?? '')),
                ];
            })
            ->filter(function ($faq) {
                return $faq['question'] !== '' || $faq['answer'] !== '';
            })
            ->values()
            ->all();
    }

    private function normalizeQuickInfoItems(array $items): array
    {
        return collect($items)
            ->map(function ($item) {
                return [
                    'icon' => trim((string) ($item['icon'] ?? 'bi bi-info-circle')),
                    'title' => trim((string) ($item['title'] ?? '')),
                    'value' => trim((string) ($item['value'] ?? '')),
                ];
            })
            ->filter(function ($item) {
                return $item['title'] !== '' || $item['value'] !== '';
            })
            ->values()
            ->all();
    }

    private function normalizeSimpleList(array $items): array
    {
        return collect($items)
            ->map(function ($item) {
                return [
                    'text' => trim((string) ($item['text'] ?? '')),
                ];
            })
            ->filter(function ($item) {
                return $item['text'] !== '';
            })
            ->values()
            ->all();
    }
}
