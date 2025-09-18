<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ContentIdea;
use App\Models\ContentLog;
use App\Models\JournalEntry;
use App\Models\Task;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        
        // Get recent tasks
        $recentTasks = Task::where('user_id', $user->id)
            ->whereIn('status', ['todo', 'in_progress'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
            
        // Get backlog count
        $backlogCount = Task::where('user_id', $user->id)
            ->where('status', 'backlog')
            ->count();
            
        // Get scheduled tasks for this week
        $scheduledTasks = Task::where('user_id', $user->id)
            ->whereNotNull('scheduled_at')
            ->whereBetween('scheduled_at', [now(), now()->addWeek()])
            ->orderBy('scheduled_at')
            ->limit(5)
            ->get();
            
        // Get content ideas in progress
        $contentInProgress = ContentIdea::where('user_id', $user->id)
            ->whereIn('status', ['draft', 'scheduled'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
            
        // Get recent journal entries
        $recentJournalEntries = JournalEntry::where('user_id', $user->id)
            ->orderBy('entry_date', 'desc')
            ->limit(3)
            ->get();
            
        // Get content performance stats
        $contentStats = [
            'total_content' => ContentLog::where('user_id', $user->id)->count(),
            'total_views' => ContentLog::where('user_id', $user->id)->sum('views'),
            'total_engagement' => ContentLog::where('user_id', $user->id)->sum('engagement'),
            'this_month' => ContentLog::where('user_id', $user->id)
                ->whereBetween('published_at', [now()->startOfMonth(), now()])
                ->count(),
        ];
        
        return Inertia::render('dashboard', [
            'recent_tasks' => $recentTasks,
            'backlog_count' => $backlogCount,
            'scheduled_tasks' => $scheduledTasks,
            'content_in_progress' => $contentInProgress,
            'recent_journal_entries' => $recentJournalEntries,
            'content_stats' => $contentStats,
        ]);
    }
}