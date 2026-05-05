<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BlogAuthorStoreRequest;
use App\Http\Requests\Admin\BlogAuthorUpdateRequest;
use App\Models\BlogAuthor;
use App\Traits\StatusTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BlogAuthorController extends Controller
{
    use StatusTrait;

    public function index(): View
    {
        return view('admin.blog_author.index', [
            'authors' => BlogAuthor::query()
                ->withCount('blogs')
                ->select(['id', 'profile_picture', 'name', 'title', 'email', 'company', 'expertise', 'status'])
                ->latest()
                ->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.blog_author.create');
    }

    public function store(BlogAuthorStoreRequest $request): RedirectResponse
    {
        $data = $request->safe()->except('profile_picture');
        $data['status'] = $request->boolean('status');

        $author = BlogAuthor::create($data);

        if ($request->hasFile('profile_picture')) {
            $author->storeImage('profile_picture', 'blog-author-images', $request->file('profile_picture'));
        }

        return redirect()->route('admin.blog-authors.index')->with('success', 'Author created successfully!');
    }

    public function show(BlogAuthor $blogAuthor): View
    {
        $blogAuthor->loadCount('blogs');

        return view('admin.blog_author.show', [
            'author' => $blogAuthor,
        ]);
    }

    public function edit(BlogAuthor $blogAuthor): View
    {
        $blogAuthor->loadCount('blogs');

        return view('admin.blog_author.edit', [
            'author' => $blogAuthor,
        ]);
    }

    public function update(BlogAuthorUpdateRequest $request, BlogAuthor $blogAuthor): RedirectResponse
    {
        $data = $request->safe()->except('profile_picture');
        $data['status'] = $request->boolean('status');

        if ($request->input('image_removed') === 'true') {
            $blogAuthor->deleteImage('profile_picture', 'blog-author-images');
            $data['profile_picture'] = null;
        }

        $blogAuthor->update($data);

        if ($request->hasFile('profile_picture')) {
            $blogAuthor->updateImage('profile_picture', 'blog-author-images', $request->file('profile_picture'));
        }

        return redirect()->route('admin.blog-authors.index')->with('success', 'Author updated successfully!');
    }

    public function destroy(BlogAuthor $blogAuthor): RedirectResponse
    {
        if ($blogAuthor->profile_picture) {
            $blogAuthor->deleteImage('profile_picture', 'blog-author-images');
        }

        $blogAuthor->delete();

        return redirect()->route('admin.blog-authors.index')->with('error', 'Author deleted successfully!');
    }

    public function changeStatus(Request $request): void
    {
        $this->changeItemStatus('BlogAuthor', $request->id, $request->status);
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');

        if (empty($ids)) {
            return response()->json(['error' => 'No author selected for deletion.'], 400);
        }

        $authors = BlogAuthor::whereIn('id', $ids)->get();
        foreach ($authors as $author) {
            if ($author->profile_picture) {
                $author->deleteImage('profile_picture', 'blog-author-images');
            }
        }

        BlogAuthor::whereIn('id', $ids)->delete();

        return response()->json(['status' => 'success', 'message' => 'Selected authors have been deleted successfully.']);
    }
}
