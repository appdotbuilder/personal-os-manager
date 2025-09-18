<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContentLogRequest;
use App\Http\Requests\UpdateContentLogRequest;
use App\Models\ContentLog;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ContentLogController extends Controller
{
    /**
     * Display a listing of content logs.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $type = $request->get('type', 'all');
        
        $query = ContentLog::where('user_id', $user->id);
        
        if ($type !== 'all') {
            $query->where('content_type', $type);
        }
        
        $contentLogs = $query->orderBy('published_at', 'desc')->paginate(15);
        
        // Get performance stats
        $stats = [
            'total_views' => ContentLog::where('user_id', $user->id)->sum('views'),
            'total_engagement' => ContentLog::where('user_id', $user->id)->sum('engagement'),
            'total_content' => ContentLog::where('user_id', $user->id)->count(),
            'avg_views' => ContentLog::where('user_id', $user->id)->avg('views'),
        ];
        
        // Get counts by type
        $counts = [
            'article' => ContentLog::where('user_id', $user->id)->where('content_type', 'article')->count(),
            'video' => ContentLog::where('user_id', $user->id)->where('content_type', 'video')->count(),
            'live_stream' => ContentLog::where('user_id', $user->id)->where('content_type', 'live_stream')->count(),
        ];
        
        return Inertia::render('content-logs/index', [
            'content_logs' => $contentLogs,
            'stats' => $stats,
            'counts' => $counts,
            'current_type' => $type,
        ]);
    }

    /**
     * Show the form for creating a new content log.
     */
    public function create()
    {
        return Inertia::render('content-logs/create');
    }

    /**
     * Store a newly created content log.
     */
    public function store(StoreContentLogRequest $request)
    {
        $contentLog = ContentLog::create([
            ...$request->validated(),
            'user_id' => $request->user()->id,
        ]);

        return redirect()->route('content-logs.index')
            ->with('success', 'Content log created successfully.');
    }

    /**
     * Display the specified content log.
     */
    public function show(Request $request, ContentLog $contentLog)
    {
        // Ensure content log belongs to authenticated user
        if ($contentLog->user_id !== $request->user()->id) {
            abort(403);
        }
        
        return Inertia::render('content-logs/show', [
            'content_log' => $contentLog,
        ]);
    }

    /**
     * Show the form for editing the specified content log.
     */
    public function edit(Request $request, ContentLog $contentLog)
    {
        // Ensure content log belongs to authenticated user
        if ($contentLog->user_id !== $request->user()->id) {
            abort(403);
        }
        
        return Inertia::render('content-logs/edit', [
            'content_log' => $contentLog,
        ]);
    }

    /**
     * Update the specified content log.
     */
    public function update(UpdateContentLogRequest $request, ContentLog $contentLog)
    {
        // Ensure content log belongs to authenticated user
        if ($contentLog->user_id !== $request->user()->id) {
            abort(403);
        }
        
        $contentLog->update($request->validated());

        return redirect()->route('content-logs.show', $contentLog)
            ->with('success', 'Content log updated successfully.');
    }

    /**
     * Remove the specified content log.
     */
    public function destroy(Request $request, ContentLog $contentLog)
    {
        // Ensure content log belongs to authenticated user
        if ($contentLog->user_id !== $request->user()->id) {
            abort(403);
        }
        
        $contentLog->delete();

        return redirect()->route('content-logs.index')
            ->with('success', 'Content log deleted successfully.');
    }
}