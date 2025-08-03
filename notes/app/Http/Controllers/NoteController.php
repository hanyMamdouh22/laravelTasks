<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Http\Requests\NoteStoreRequest;
use App\Http\Requests\NoteUpdateRequest;

class NoteController extends Controller
{
    public function index(): View
    {
      $notes = auth()->user()->notes()->latest()->paginate(5);

    return view('notes.index', compact('notes'))
           ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create(): View
    {
        return view('notes.create');
    }

    public function store(NoteStoreRequest $request): RedirectResponse
    {
        $request->user()->notes()->create($request->validated());

    return redirect()->route('notes.index')
                     ->with('success', 'Note created successfully.');
    }

    public function show(Note $note): View
    {
        return view('notes.show', compact('note'));
    }

    public function edit(Note $note): View
    {
        return view('notes.edit', compact('note'));
    }

    public function update(NoteUpdateRequest $request, Note $note): RedirectResponse
    {
        $request->user()->notes()->create($request->validated());

    return redirect()->route('notes.index')
                     ->with('success', 'Note created successfully.');

            
    }

    public function destroy(Note $note): RedirectResponse
    {
        $note->delete();
        return redirect()->route('notes.index')
            ->with('success', 'Note deleted successfully');
    }
}
