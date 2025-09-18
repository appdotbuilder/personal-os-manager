<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContentIdeaRequest;
use App\Http\Requests\UpdateContentIdeaRequest;
use App\Models\ContentIdea;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ContentIdeaController extends Controller
{
    /**
     * Display a listing of content ideas.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $status = $request->get('status', 'all');
        
        $query = ContentIdea::where('user_id', $user->id);
        
        if ($status !== 'all') {
            $query->where('status', $status);
        }
        
        $contentIdeas = $query->orderBy('created_at', 'desc')->paginate(15);
        
        // Get counts for different statuses
        $counts = [
            'idea' => ContentIdea::where('user_id', $user->id)->where('status', 'idea')->count(),
            'draft' => ContentIdea::where('user_id', $user->id)->where('status', 'draft')->count(),
            'scheduled' => ContentIdea::where('user_id', $user->id)->where('status', 'scheduled')->count(),
            'completed' => ContentIdea::where('user_id', $user->id)->where('status', 'completed')->count(),
        ];
        
        return Inertia::render('content-ideas/index', [
            'content_ideas' => $contentIdeas,
            'counts' => $counts,
            'current_status' => $status,
        ]);
    }

    /**
     * Show the form for creating a new content idea.
     */
    public function create()
    {
        return Inertia::render('content-ideas/create');
    }

    /**
     * Store a newly created content idea.
     */
    public function store(StoreContentIdeaRequest $request)
    {
        $contentIdea = ContentIdea::create([
            ...$request->validated(),
            'user_id' => $request->user()->id,
        ]);

        return redirect()->route('content-ideas.index')
            ->with('success', 'Content idea created successfully.');
    }

    /**
     * Display the specified content idea.
     */
    public function show(Request $request, ContentIdea $contentIdea)
    {
        // Ensure content idea belongs to authenticated user
        if ($contentIdea->user_id !== $request->user()->id) {
            abort(403);
        }
        
        return Inertia::render('content-ideas/show', [
            'content_idea' => $contentIdea,
        ]);
    }

    /**
     * Show the form for editing the specified content idea.
     */
    public function edit(Request $request, ContentIdea $contentIdea)
    {
        // Ensure content idea belongs to authenticated user
        if ($contentIdea->user_id !== $request->user()->id) {
            abort(403);
        }
        
        return Inertia::render('content-ideas/edit', [
            'content_idea' => $contentIdea,
        ]);
    }

    /**
     * Update the specified content idea.
     */
    public function update(UpdateContentIdeaRequest $request, ContentIdea $contentIdea)
    {
        // Ensure content idea belongs to authenticated user
        if ($contentIdea->user_id !== $request->user()->id) {
            abort(403);
        }
        
        $contentIdea->update($request->validated());

        return redirect()->route('content-ideas.show', $contentIdea)
            ->with('success', 'Content idea updated successfully.');
    }

    /**
     * Remove the specified content idea.
     */
    public function destroy(Request $request, ContentIdea $contentIdea)
    {
        // Ensure content idea belongs to authenticated user
        if ($contentIdea->user_id !== $request->user()->id) {
            abort(403);
        }
        
        $contentIdea->delete();

        return redirect()->route('content-ideas.index')
            ->with('success', 'Content idea deleted successfully.');
    }
}