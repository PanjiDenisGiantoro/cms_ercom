<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        $contacts = Contact::orderBy('order')->paginate(15);

        return view('admin.contacts.index', compact('contacts'));
    }

    public function create(): View
    {
        return view('admin.contacts.create');
    }

    public function store(Request $request): RedirectResponse
    {
        Contact::create($this->validated($request));

        return redirect()->route('admin.contacts.index')->with('success', 'Contact created.');
    }

    public function edit(Contact $contact): View
    {
        return view('admin.contacts.edit', compact('contact'));
    }

    public function update(Request $request, Contact $contact): RedirectResponse
    {
        $contact->update($this->validated($request));

        return redirect()->route('admin.contacts.index')->with('success', 'Contact updated.');
    }

    public function destroy(Contact $contact): RedirectResponse
    {
        $contact->delete();

        return back()->with('success', 'Contact deleted.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'label' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'map_embed_url' => 'nullable|string',
            'order' => 'integer|min:0',
            'is_active' => 'boolean',
        ]);
    }
}
