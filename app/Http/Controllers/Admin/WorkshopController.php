<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Workshop;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WorkshopController extends Controller
{
    public function index()
    {
        $workshops = Workshop::latest()->paginate(10);

        return view('admin.workshops.index', compact('workshops'));
    }

    public function create()
    {
        return view('admin.workshops.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'speaker' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'quota' => 'required|integer|min:1',
            'location' => 'nullable|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|in:draft,published,closed',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        Workshop::create($validated);

        return redirect()
            ->route('admin.workshops.index')
            ->with('success', 'Workshop berhasil ditambahkan.');
    }

    public function show(Workshop $workshop)
    {
        return view('admin.workshops.show', compact('workshop'));
    }

    public function edit(Workshop $workshop)
    {
        return view('admin.workshops.edit', compact('workshop'));
    }

    public function update(Request $request, Workshop $workshop)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'speaker' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'quota' => 'required|integer|min:1',
            'location' => 'nullable|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|in:draft,published,closed',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $workshop->update($validated);

        return redirect()
            ->route('admin.workshops.index')
            ->with('success', 'Workshop berhasil diperbarui.');
    }

    public function destroy(Workshop $workshop)
    {
        $workshop->delete();

        return redirect()
            ->route('admin.workshops.index')
            ->with('success', 'Workshop berhasil dihapus.');
    }
}
