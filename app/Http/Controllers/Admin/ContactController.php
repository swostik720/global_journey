<?php

namespace App\Http\Controllers\Admin;


use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Contact;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ContactStoreRequest;
use App\Http\Requests\Admin\ContactUpdateRequest;
use App\Traits\StatusTrait;

class ContactController extends Controller
{
    use StatusTrait;
    public function index(): View
    {
        return view('admin.contact.index', [
            'contacts' => Contact::query()->select(['id', 'name', 'email', 'phone', 'status'])->latest()->get()
        ]);
    }

    public function create(): View
    {
        return view('admin.contact.create');
    }

    public function store(ContactStoreRequest $request): RedirectResponse
    {
        $contact = Contact::create($request->validated());

        return redirect()->route('admin.contacts.index')->with('success', 'Contact Created Successfully!');
    }

    public function show(Contact $contact): View
    {
        return view('admin.contact.show', compact('contact'));
    }

    public function edit(Contact $contact): View
    {
        return view('admin.contact.edit', compact('contact'));
    }

    public function update(ContactUpdateRequest $request, Contact $contact): RedirectResponse
    {
        $contact->update($request->validated());

        return redirect()->route('admin.contacts.index')->with('success', 'Contact Updated Successfully!');
    }

    public function destroy(Contact $contact): RedirectResponse
    {
        $contact->delete();

        return redirect()->route('admin.contacts.index')->with('success', 'Contact Deleted Successfully!');
    }
    public function contactInsideStatusChange(Request $request, $id)
    {
        $contact = Contact::find($id);
        $contact->status = $request->status;
        $contact->save();
        return redirect()->route('admin.contacts.index')->with('success', 'Status changed successfully!');
    }
    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');
        if (!empty($ids)) {
            Contact::whereIn('id', $ids)->delete();
            return response()->json(['status' => 'success', 'message' => 'Selected contacts have been deleted successfully.']);
        } else {
            return response()->json(['error' => 'No contacts selected for deletion.'], 400);
        }
    }
}
