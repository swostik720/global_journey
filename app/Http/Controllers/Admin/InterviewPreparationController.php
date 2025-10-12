<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InterviewPreparation;
use App\Http\Requests\InterviewPreparationRequest;
use Illuminate\Http\Request;
use App\Traits\StatusTrait;

class InterviewPreparationController extends Controller
{
    use StatusTrait;
    public function index()
    {
        $items = InterviewPreparation::latest()->paginate(10);
        return view('admin.interview_preparation.index', compact('items'));
    }

    public function create()
    {
        $countries = \App\Models\Country::all();
        return view('admin.interview_preparation.create', compact('countries'));
    }

    public function store(InterviewPreparationRequest $request)
    {
        $data = $request->validated();
        $data['country_id'] = $request->input('country_id');
        if ($request->hasFile('image')) {
            $filename = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploaded-images/interwiew-preperations-images'), $filename);
            $data['image'] = $filename;
        }
        $data['visa_conditions'] = $request->input('visa_conditions', []);
        $data['interview_questions'] = $request->input('interview_questions', []);
        $data['faqs'] = $request->input('faqs', []);
        InterviewPreparation::create($data);
        return redirect()->route('admin.interview_preparation.index')->with('success', 'Interview Preparation created successfully.');
    }

    public function show($id)
    {
        $item = InterviewPreparation::findOrFail($id);
        return view('admin.interview_preparation.show', compact('item'));
    }

    public function edit($id)
    {
        $item = InterviewPreparation::findOrFail($id);
        $countries = \App\Models\Country::all();
        return view('admin.interview_preparation.edit', compact('item', 'countries'));
    }

    public function update(InterviewPreparationRequest $request, $id)
    {
        $item = InterviewPreparation::findOrFail($id);
        $data = $request->validated();
        $data['country_id'] = $request->input('country_id');
        if ($request->hasFile('image')) {
            $filename = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploaded-images/interwiew-preperations-images'), $filename);
            $data['image'] = $filename;
        }
        $data['visa_conditions'] = $request->input('visa_conditions', []);
        $data['interview_questions'] = $request->input('interview_questions', []);
        $data['faqs'] = $request->input('faqs', []);
        $item->update($data);
        return redirect()->route('admin.interview_preparation.index')->with('success', 'Interview Preparation updated successfully.');
    }

    public function destroy($id)
    {
        $item = InterviewPreparation::findOrFail($id);
        $item->delete();
        return redirect()->route('admin.interview_preparation.index')->with('success', 'Interview Preparation deleted successfully.');
    }

    public function changeStatus(Request $request): void
    {
        $this->changeItemStatus('InterviewPreparation', $request->id, $request->status);
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');
        if (!empty($ids)) {
            InterviewPreparation::whereIn('id', $ids)->delete();
            return response()->json(['status' => 'success', 'message' => 'Selected interview preparations have been deleted successfully.']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'No IDs provided.']);
        }
    }
}
