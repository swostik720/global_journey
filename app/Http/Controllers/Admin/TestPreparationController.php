<?php

namespace App\Http\Controllers\Admin;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\TestPreparation;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TestPreparationStoreRequest;
use App\Http\Requests\Admin\TestPreparationUpdateRequest;
use App\Traits\StatusTrait;

class TestPreparationController extends Controller
{
    use StatusTrait;

    protected function normalizeFaqs(?array $faqs): array
    {
        if (empty($faqs)) {
            return [];
        }

        return collect($faqs)
            ->map(function ($faq) {
                $question = trim((string) ($faq['question'] ?? ''));
                $answer = trim((string) ($faq['answer'] ?? ''));

                if ($question === '' || $answer === '') {
                    return null;
                }

                return [
                    'question' => $question,
                    'answer' => $answer,
                ];
            })
            ->filter()
            ->values()
            ->all();
    }

    public function index(): View
    {
        return view('admin.test_preparation.index', [
            'test_preparations' => TestPreparation::query()->select(['id', 'image', 'title', 'status'])->latest()->get()
        ]);
    }

    public function create(): View
    {
        return view('admin.test_preparation.create');
    }

    public function store(TestPreparationStoreRequest $request): RedirectResponse
    {
        $data = $request->safe()->except('image');
        $data['faqs'] = $this->normalizeFaqs($request->input('faqs', []));

        $test_preparation = TestPreparation::create($data);
        if ($request->hasFile('image')) {
            $test_preparation->storeImage('image', 'test-preparation-images', $request->file('image'));
        }

        return redirect()->route('admin.test-preparations.index')->with('success', 'TestPreparation Created Successfully!');
    }

    public function show(TestPreparation $test_preparation): View
    {
        return view('admin.test_preparation.show', compact('test_preparation'));
    }

    public function edit(TestPreparation $test_preparation): View
    {
        return view('admin.test_preparation.edit', compact('test_preparation'));
    }

    public function update(TestPreparationUpdateRequest $request, TestPreparation $test_preparation): RedirectResponse
    {
        $data = $request->safe()->except('image');
        $data['faqs'] = $this->normalizeFaqs($request->input('faqs', []));
        if ($request->input('image_removed') == 'true') {
            $test_preparation->deleteImage('image', 'test-preparation-images');
            $data['image'] = null;
        }

        $test_preparation->update($data);

        if ($request->hasFile('image')) {
            $test_preparation->updateImage('image', 'test-preparation-images', $request->file('image'));
        }

        return redirect()->route('admin.test-preparations.index')->with('success', 'TestPreparation Updated Successfully!');
    }

    public function destroy(TestPreparation $test_preparation): RedirectResponse
    {
        if ($test_preparation->image) {
            $test_preparation->deleteImage('image', 'test_preparation-images');
        }

        $test_preparation->delete();

        return redirect()->route('admin.test-preparations.index')->with('error', 'TestPreparation Deleted Successfully!');
    }

    public function changeStatus(Request $request): void
    {
        $this->changeItemStatus('TestPreparation', $request->id, $request->status);
    }
    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');
        if (!empty($ids)) {
            TestPreparation::whereIn('id', $ids)->delete();
            return response()->json(['status' => 'success', 'message' => 'Selected test preparation have been deleted successfully.']);
        } else {
            return response()->json(['error' => 'No test preparation selected for deletion.'], 400);
        }
    }
}
