<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FaqStoreRequest;
use App\Http\Requests\Admin\FaqUpdateRequest;
use App\Models\Faq;
use App\Traits\StatusTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FaqController extends Controller
{
    use StatusTrait;

    public function index(): View
    {
        return view('admin.faq.index', [
            'faqs' => Faq::query()
                ->select(['id', 'question', 'answer', 'sort_order', 'status'])
                ->orderBy('sort_order', 'asc')
                ->latest('id')
                ->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.faq.create');
    }

    public function store(FaqStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['status'] = $request->boolean('status', true);
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);

        Faq::create($data);

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ created successfully.');
    }

    public function show(Faq $faq): View
    {
        return view('admin.faq.show', compact('faq'));
    }

    public function edit(Faq $faq): View
    {
        return view('admin.faq.edit', compact('faq'));
    }

    public function update(FaqUpdateRequest $request, Faq $faq): RedirectResponse
    {
        $data = $request->validated();
        $data['status'] = $request->boolean('status', false);
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);

        $faq->update($data);

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ updated successfully.');
    }

    public function destroy(Faq $faq): RedirectResponse
    {
        $faq->delete();

        return redirect()->route('admin.faqs.index')->with('error', 'FAQ deleted successfully.');
    }

    public function changeStatus(Request $request): void
    {
        $this->changeItemStatus('Faq', $request->id, $request->status);
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');
        if (!empty($ids)) {
            Faq::whereIn('id', $ids)->delete();
            return response()->json(['status' => 'success', 'message' => 'Selected FAQs have been deleted successfully.']);
        }

        return response()->json(['error' => 'No FAQs selected for deletion.'], 400);
    }
}
