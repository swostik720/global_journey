<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DocumentChecklist;
use App\Models\Country;
use App\Http\Requests\DocumentChecklistRequest;
use Illuminate\Http\Request;
use App\Enums\DocumentChecklistType;

class DocumentChecklistController extends Controller
{
    public function index()
    {
        $items = DocumentChecklist::with('country')->paginate(20);
        return view('admin.document_checklist.index', compact('items'));
    }

    public function create()
    {
        $countries = Country::all();
        $types = DocumentChecklistType::cases();
        return view('admin.document_checklist.create', compact('countries', 'types'));
    }

    // public function store(DocumentChecklistRequest $request)
    // {
    //     $data = $request->validated();
    //     if (isset($data['documents']) && is_string($data['documents'])) {
    //         $docs = preg_split('/\r\n|\r|\n/', $data['documents']);
    //         $data['documents'] = array_filter(array_map('trim', $docs));
    //     }
    //     DocumentChecklist::create($data);
    //     return redirect()->route('admin.document_checklist.index')->with('success', 'Document checklist created.');
    // }

    public function store(DocumentChecklistRequest $request)
    {
        $data = $request->validated();
        $data['documents'] = json_decode($data['documents'], true); // ✅ convert JSON string into array

        DocumentChecklist::create($data);

        return redirect()->route('admin.document_checklist.index')
            ->with('success', 'Document checklist created.');
    }


    public function edit($id)
    {
        $item = DocumentChecklist::findOrFail($id);
        $countries = Country::all();
        $types = DocumentChecklistType::cases();

        return view('admin.document_checklist.edit', compact('item', 'countries', 'types'));
    }

    // public function update(DocumentChecklistRequest $request, $id)
    // {
    //     $item = DocumentChecklist::findOrFail($id);
    //     $data = $request->validated();

    //     // Convert textarea string into array
    //     if (!empty($data['documents']) && is_string($data['documents'])) {
    //         $data['documents'] = array_values(array_filter(
    //             array_map('trim', preg_split("/\r\n|\r|\n/", $data['documents']))
    //         ));
    //     }

    //     $item->update($data);

    //     return redirect()
    //         ->route('admin.document_checklist.index')
    //         ->with('success', 'Document checklist updated successfully.');
    // }

    public function update(DocumentChecklistRequest $request, $id)
    {
        $item = DocumentChecklist::findOrFail($id);
        $data = $request->validated();
        $data['documents'] = json_decode($data['documents'], true);

        $item->update($data);

        return redirect()->route('admin.document_checklist.index')
            ->with('success', 'Document checklist updated successfully.');
    }

    public function show($id)
    {
        $item = DocumentChecklist::with('country')->findOrFail($id);
        return view('admin.document_checklist.show', compact('item'));
    }
    public function destroy($id)
    {
        $item = DocumentChecklist::findOrFail($id);
        $item->delete();
        return redirect()->route('admin.document_checklist.index')->with('success', 'Document checklist deleted.');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids', []);
        if (!empty($ids)) {
            DocumentChecklist::whereIn('id', $ids)->delete();
            return response()->json(['success' => true, 'message' => 'Selected document checklists deleted.']);
        }
        return response()->json(['success' => false, 'message' => 'No items selected.']);
    }
}
