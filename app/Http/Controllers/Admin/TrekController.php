<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Trek;
use Illuminate\Http\Request;

class TrekController extends Controller
{
    public function index()
    {
        $treks = Trek::orderBy('id', 'desc')->get();
        return view('admin.treks.index', compact('treks'));
    }

    public function create()
    {
        return view('admin.treks.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|regex:/^[a-z0-9\-]+$/|unique:treks',
            'summary' => 'nullable|string',
            'difficulty' => 'required_if:published_status,published|nullable|in:Easy,Moderate,Hard,Expert',
            'duration' => 'nullable|integer|min:1',
            'price' => 'required|integer|min:0',
            'published_status' => 'required|in:draft,published',
        ]);

        Trek::create($validated);
        return redirect()->route('admin.treks.index')->with('success', 'Trek created successfully.');
    }

    public function show(Trek $trek)
    {
        return view('admin.treks.show', compact('trek'));
    }

    public function edit(Trek $trek)
    {
        return view('admin.treks.edit', compact('trek'));
    }

    public function update(Request $request, Trek $trek)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|regex:/^[a-z0-9\-]+$/|unique:treks,slug,' . $trek->id,
            'summary' => 'nullable|string',
            'difficulty' => 'required_if:published_status,published|nullable|in:Easy,Moderate,Hard,Expert',
            'duration' => 'nullable|integer|min:1',
            'price' => 'required|integer|min:0',
            'published_status' => 'required|in:draft,published',
        ]);

        $trek->update($validated);
        return redirect()->route('admin.treks.index')->with('success', 'Trek updated successfully.');
    }

    public function destroy(Trek $trek)
    {
        // "Do not delete records that may be referenced by reservations."
        // We will just return an error that deletion is forbidden.
        return back()->with('error', 'Deleting treks is forbidden to preserve audit history. Please unpublish instead.');
    }
}
