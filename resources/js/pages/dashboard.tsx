import React from 'react';
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/react';

interface DashboardProps {
    recent_tasks: Array<{
        id: number;
        title: string;
        status: string;
        priority: string;
        created_at: string;
    }>;
    backlog_count: number;
    scheduled_tasks: Array<{
        id: number;
        title: string;
        scheduled_at: string;
        priority: string;
    }>;
    content_in_progress: Array<{
        id: number;
        title: string;
        status: string;
        content_type: string;
        created_at: string;
    }>;
    recent_journal_entries: Array<{
        id: number;
        title: string;
        entry_date: string;
        tags: string[];
    }>;
    content_stats: {
        total_content: number;
        total_views: number;
        total_engagement: number;
        this_month: number;
    };
    [key: string]: unknown;
}

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

export default function Dashboard({
    recent_tasks,
    backlog_count,
    scheduled_tasks,
    content_in_progress,
    recent_journal_entries,
    content_stats,
}: DashboardProps) {
    const getPriorityColor = (priority: string) => {
        switch (priority) {
            case 'high':
                return 'bg-red-100 text-red-800 dark:bg-red-900/20 dark:text-red-400';
            case 'medium':
                return 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/20 dark:text-yellow-400';
            case 'low':
                return 'bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-400';
            default:
                return 'bg-gray-100 text-gray-800 dark:bg-gray-900/20 dark:text-gray-400';
        }
    };

    const getStatusColor = (status: string) => {
        switch (status) {
            case 'completed':
                return 'bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-400';
            case 'in_progress':
                return 'bg-blue-100 text-blue-800 dark:bg-blue-900/20 dark:text-blue-400';
            case 'draft':
                return 'bg-purple-100 text-purple-800 dark:bg-purple-900/20 dark:text-purple-400';
            case 'scheduled':
                return 'bg-indigo-100 text-indigo-800 dark:bg-indigo-900/20 dark:text-indigo-400';
            default:
                return 'bg-gray-100 text-gray-800 dark:bg-gray-900/20 dark:text-gray-400';
        }
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Dashboard" />
            <div className="flex h-full flex-1 flex-col gap-6 p-6">
                {/* Welcome Header */}
                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-2xl font-bold text-gray-900 dark:text-gray-100">
                            Welcome to PersonalOS 🧠
                        </h1>
                        <p className="text-gray-600 dark:text-gray-400 mt-1">
                            Your productivity command center
                        </p>
                    </div>
                    <div className="flex gap-3">
                        <Link
                            href="/tasks/create"
                            className="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors"
                        >
                            ➕ New Task
                        </Link>
                        <Link
                            href="/journal/create"
                            className="inline-flex items-center px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors"
                        >
                            ✍️ Journal Entry
                        </Link>
                    </div>
                </div>

                {/* Stats Cards */}
                <div className="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div className="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-sm border border-gray-200 dark:border-gray-700">
                        <div className="flex items-center justify-between">
                            <div>
                                <p className="text-sm font-medium text-gray-600 dark:text-gray-400">Active Tasks</p>
                                <p className="text-2xl font-bold text-gray-900 dark:text-gray-100">{recent_tasks.length}</p>
                            </div>
                            <div className="text-2xl">📋</div>
                        </div>
                    </div>

                    <div className="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-sm border border-gray-200 dark:border-gray-700">
                        <div className="flex items-center justify-between">
                            <div>
                                <p className="text-sm font-medium text-gray-600 dark:text-gray-400">Backlog Items</p>
                                <p className="text-2xl font-bold text-gray-900 dark:text-gray-100">{backlog_count}</p>
                            </div>
                            <div className="text-2xl">📚</div>
                        </div>
                    </div>

                    <div className="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-sm border border-gray-200 dark:border-gray-700">
                        <div className="flex items-center justify-between">
                            <div>
                                <p className="text-sm font-medium text-gray-600 dark:text-gray-400">Total Content</p>
                                <p className="text-2xl font-bold text-gray-900 dark:text-gray-100">{content_stats.total_content}</p>
                            </div>
                            <div className="text-2xl">🎨</div>
                        </div>
                    </div>

                    <div className="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-sm border border-gray-200 dark:border-gray-700">
                        <div className="flex items-center justify-between">
                            <div>
                                <p className="text-sm font-medium text-gray-600 dark:text-gray-400">Total Views</p>
                                <p className="text-2xl font-bold text-gray-900 dark:text-gray-100">
                                    {content_stats.total_views.toLocaleString()}
                                </p>
                            </div>
                            <div className="text-2xl">👀</div>
                        </div>
                    </div>
                </div>

                {/* Main Content Grid */}
                <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    {/* Recent Tasks */}
                    <div className="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-sm border border-gray-200 dark:border-gray-700">
                        <div className="flex items-center justify-between mb-4">
                            <h3 className="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                📋 Recent Tasks
                            </h3>
                            <Link
                                href="/tasks"
                                className="text-sm text-indigo-600 dark:text-indigo-400 hover:underline"
                            >
                                View all
                            </Link>
                        </div>
                        <div className="space-y-3">
                            {recent_tasks.length > 0 ? (
                                recent_tasks.map((task) => (
                                    <div key={task.id} className="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                        <div className="flex-1">
                                            <p className="text-sm font-medium text-gray-900 dark:text-gray-100">
                                                {task.title}
                                            </p>
                                            <div className="flex items-center gap-2 mt-1">
                                                <span className={`px-2 py-1 text-xs rounded-full ${getStatusColor(task.status)}`}>
                                                    {task.status.replace('_', ' ')}
                                                </span>
                                                <span className={`px-2 py-1 text-xs rounded-full ${getPriorityColor(task.priority)}`}>
                                                    {task.priority}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                ))
                            ) : (
                                <p className="text-gray-500 dark:text-gray-400 text-sm text-center py-4">
                                    No recent tasks. Create your first task to get started! 🚀
                                </p>
                            )}
                        </div>
                    </div>

                    {/* Content in Progress */}
                    <div className="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-sm border border-gray-200 dark:border-gray-700">
                        <div className="flex items-center justify-between mb-4">
                            <h3 className="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                🎨 Content in Progress
                            </h3>
                            <Link
                                href="/content-ideas"
                                className="text-sm text-indigo-600 dark:text-indigo-400 hover:underline"
                            >
                                View all
                            </Link>
                        </div>
                        <div className="space-y-3">
                            {content_in_progress.length > 0 ? (
                                content_in_progress.map((content) => (
                                    <div key={content.id} className="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                        <div className="flex-1">
                                            <p className="text-sm font-medium text-gray-900 dark:text-gray-100">
                                                {content.title}
                                            </p>
                                            <div className="flex items-center gap-2 mt-1">
                                                <span className={`px-2 py-1 text-xs rounded-full ${getStatusColor(content.status)}`}>
                                                    {content.status}
                                                </span>
                                                <span className="px-2 py-1 text-xs bg-gray-200 dark:bg-gray-600 text-gray-800 dark:text-gray-200 rounded-full">
                                                    {content.content_type.replace('_', ' ')}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                ))
                            ) : (
                                <p className="text-gray-500 dark:text-gray-400 text-sm text-center py-4">
                                    No content in progress. Start creating! ✨
                                </p>
                            )}
                        </div>
                    </div>

                    {/* Scheduled Tasks */}
                    <div className="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-sm border border-gray-200 dark:border-gray-700">
                        <div className="flex items-center justify-between mb-4">
                            <h3 className="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                📅 Upcoming Schedule
                            </h3>
                            <Link
                                href="/tasks?status=scheduled"
                                className="text-sm text-indigo-600 dark:text-indigo-400 hover:underline"
                            >
                                View schedule
                            </Link>
                        </div>
                        <div className="space-y-3">
                            {scheduled_tasks.length > 0 ? (
                                scheduled_tasks.map((task) => (
                                    <div key={task.id} className="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                        <div className="flex-1">
                                            <p className="text-sm font-medium text-gray-900 dark:text-gray-100">
                                                {task.title}
                                            </p>
                                            <div className="flex items-center gap-2 mt-1">
                                                <span className="text-xs text-gray-500 dark:text-gray-400">
                                                    {new Date(task.scheduled_at).toLocaleDateString()}
                                                </span>
                                                <span className={`px-2 py-1 text-xs rounded-full ${getPriorityColor(task.priority)}`}>
                                                    {task.priority}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                ))
                            ) : (
                                <p className="text-gray-500 dark:text-gray-400 text-sm text-center py-4">
                                    No scheduled tasks. Plan your week! 📋
                                </p>
                            )}
                        </div>
                    </div>

                    {/* Recent Journal Entries */}
                    <div className="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-sm border border-gray-200 dark:border-gray-700">
                        <div className="flex items-center justify-between mb-4">
                            <h3 className="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                📖 Recent Journal Entries
                            </h3>
                            <Link
                                href="/journal"
                                className="text-sm text-indigo-600 dark:text-indigo-400 hover:underline"
                            >
                                View all
                            </Link>
                        </div>
                        <div className="space-y-3">
                            {recent_journal_entries.length > 0 ? (
                                recent_journal_entries.map((entry) => (
                                    <div key={entry.id} className="p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                        <div className="flex items-start justify-between">
                                            <div className="flex-1">
                                                <p className="text-sm font-medium text-gray-900 dark:text-gray-100">
                                                    {entry.title}
                                                </p>
                                                <p className="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                                    {new Date(entry.entry_date).toLocaleDateString()}
                                                </p>
                                                {entry.tags && entry.tags.length > 0 && (
                                                    <div className="flex flex-wrap gap-1 mt-2">
                                                        {entry.tags.slice(0, 3).map((tag, index) => (
                                                            <span
                                                                key={index}
                                                                className="px-2 py-1 text-xs bg-blue-100 text-blue-800 dark:bg-blue-900/20 dark:text-blue-400 rounded-full"
                                                            >
                                                                #{tag}
                                                            </span>
                                                        ))}
                                                    </div>
                                                )}
                                            </div>
                                        </div>
                                    </div>
                                ))
                            ) : (
                                <p className="text-gray-500 dark:text-gray-400 text-sm text-center py-4">
                                    No journal entries yet. Start writing! ✍️
                                </p>
                            )}
                        </div>
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}