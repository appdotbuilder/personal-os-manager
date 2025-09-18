<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreJournalEntryRequest;
use App\Http\Requests\UpdateJournalEntryRequest;
use App\Models\JournalEntry;
use Illuminate\Http\Request;
use Inertia\Inertia;

class JournalEntryController extends Controller
{
    /**
     * Display a listing of journal entries.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $search = $request->get('search');
        $tag = $request->get('tag');
        
        $query = JournalEntry::where('user_id', $user->id);
        
        if ($search) {
            $query->search($search);
        }
        
        if ($tag) {
            $query->byTag($tag);
        }
        
        $journalEntries = $query->orderBy('entry_date', 'desc')->paginate(10);
        
        // Get popular tags
        $allTags = JournalEntry::where('user_id', $user->id)
            ->whereNotNull('tags')
            ->pluck('tags')
            ->flatten()
            ->countBy()
            ->sortDesc()
            ->take(10)
            ->keys();
        
        return Inertia::render('journal/index', [
            'journal_entries' => $journalEntries,
            'popular_tags' => $allTags,
            'search' => $search,
            'current_tag' => $tag,
        ]);
    }

    /**
     * Show the form for creating a new journal entry.
     */
    public function create()
    {
        return Inertia::render('journal/create');
    }

    /**
     * Store a newly created journal entry.
     */
    public function store(StoreJournalEntryRequest $request)
    {
        $journalEntry = JournalEntry::create([
            ...$request->validated(),
            'user_id' => $request->user()->id,
        ]);

        return redirect()->route('journal.index')
            ->with('success', 'Journal entry created successfully.');
    }

    /**
     * Display the specified journal entry.
     */
    public function show(Request $request, JournalEntry $journalEntry)
    {
        // Ensure journal entry belongs to authenticated user
        if ($journalEntry->user_id !== $request->user()->id) {
            abort(403);
        }
        
        return Inertia::render('journal/show', [
            'journal_entry' => $journalEntry,
        ]);
    }

    /**
     * Show the form for editing the specified journal entry.
     */
    public function edit(Request $request, JournalEntry $journalEntry)
    {
        // Ensure journal entry belongs to authenticated user
        if ($journalEntry->user_id !== $request->user()->id) {
            abort(403);
        }
        
        return Inertia::render('journal/edit', [
            'journal_entry' => $journalEntry,
        ]);
    }

    /**
     * Update the specified journal entry.
     */
    public function update(UpdateJournalEntryRequest $request, JournalEntry $journalEntry)
    {
        // Ensure journal entry belongs to authenticated user
        if ($journalEntry->user_id !== $request->user()->id) {
            abort(403);
        }
        
        $journalEntry->update($request->validated());

        return redirect()->route('journal.show', $journalEntry)
            ->with('success', 'Journal entry updated successfully.');
    }

    /**
     * Remove the specified journal entry.
     */
    public function destroy(Request $request, JournalEntry $journalEntry)
    {
        // Ensure journal entry belongs to authenticated user
        if ($journalEntry->user_id !== $request->user()->id) {
            abort(403);
        }
        
        $journalEntry->delete();

        return redirect()->route('journal.index')
            ->with('success', 'Journal entry deleted successfully.');
    }
}