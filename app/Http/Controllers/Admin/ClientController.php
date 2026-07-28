<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\ClientCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ClientController extends Controller
{
    public function index(): View
    {
        $clients = Client::with('category')->orderBy('order')->paginate(15);

        return view('admin.clients.index', compact('clients'));
    }

    public function create(): View
    {
        $categories = ClientCategory::orderBy('order')->get();

        return view('admin.clients.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['logo_image'] = $this->resolveUpload($request, 'logo_image', 'clients');

        Client::create($data);

        return redirect()->route('admin.clients.index')->with('success', 'Client created.');
    }

    public function edit(Client $client): View
    {
        $categories = ClientCategory::orderBy('order')->get();

        return view('admin.clients.edit', compact('client', 'categories'));
    }

    public function update(Request $request, Client $client): RedirectResponse
    {
        $data = $this->validated($request, required: false);
        $this->applyUpload($data, $request, 'logo_image', 'clients');

        $client->update($data);

        return redirect()->route('admin.clients.index')->with('success', 'Client updated.');
    }

    public function destroy(Client $client): RedirectResponse
    {
        $client->delete();

        return back()->with('success', 'Client deleted.');
    }

    private function validated(Request $request, bool $required = true): array
    {
        return $request->validate([
            'category_id' => 'nullable|exists:client_categories,id',
            'name' => 'required|string|max:255',
            'logo_image' => $required ? 'required' : 'nullable',
            'website_url' => 'nullable|url',
            'order' => 'integer|min:0',
            'is_active' => 'boolean',
        ]);
    }
}
