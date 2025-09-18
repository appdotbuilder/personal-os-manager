import React from 'react';
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/react';

interface Task {
    id: number;
    title: string;
    description: string | null;
    status: string;
    priority: string;
    scheduled_at: string | null;
    created_at: string;
}

interface TasksIndexProps {
    tasks: {
        data: Task[];
        links: Array<{
            url: string | null;
            label: string;
            active: boolean;
        }>;
    };
    counts: {
        todo: number;
        backlog: number;
        in_progress: number;
        completed: number;
    };
    current_status: string;
    [key: string]: unknown;
}

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
    {
        title: 'Tasks',
        href: '/tasks',
    },
];

export default function TasksIndex({ tasks, counts, current_status }: TasksIndexProps) {
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
            case 'backlog':
                return 'bg-gray-100 text-gray-800 dark:bg-gray-900/20 dark:text-gray-400';
            default:
                return 'bg-purple-100 text-purple-800 dark:bg-purple-900/20 dark:text-purple-400';
        }
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Tasks" />
            <div className="flex h-full flex-1 flex-col gap-6 p-6">
                {/* Header */}
                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-2xl font-bold text-gray-900 dark:text-gray-100">
                            📋 Task Management
                        </h1>
                        <p className="text-gray-600 dark:text-gray-400 mt-1">
                            Organize and track your tasks efficiently
                        </p>
                    </div>
                    <Link
                        href="/tasks/create"
                        className="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors"
                    >
                        ➕ New Task
                    </Link>
                </div>

                {/* Status Filter Tabs */}
                <div className="flex space-x-1 bg-gray-100 dark:bg-gray-800 rounded-lg p-1">
                    <Link
                        href="/tasks"
                        className={`px-4 py-2 rounded-md text-sm font-medium transition-colors ${
                            current_status === 'all'
                                ? 'bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-sm'
                                : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100'
                        }`}
                    >
                        All ({counts.todo + counts.backlog + counts.in_progress + counts.completed})
                    </Link>
                    <Link
                        href="/tasks?status=todo"
                        className={`px-4 py-2 rounded-md text-sm font-medium transition-colors ${
                            current_status === 'todo'
                                ? 'bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-sm'
                                : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100'
                        }`}
                    >
                        To Do ({counts.todo})
                    </Link>
                    <Link
                        href="/tasks?status=backlog"
                        className={`px-4 py-2 rounded-md text-sm font-medium transition-colors ${
                            current_status === 'backlog'
                                ? 'bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-sm'
                                : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100'
                        }`}
                    >
                        Backlog ({counts.backlog})
                    </Link>
                    <Link
                        href="/tasks?status=in_progress"
                        className={`px-4 py-2 rounded-md text-sm font-medium transition-colors ${
                            current_status === 'in_progress'
                                ? 'bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-sm'
                                : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100'
                        }`}
                    >
                        In Progress ({counts.in_progress})
                    </Link>
                    <Link
                        href="/tasks?status=completed"
                        className={`px-4 py-2 rounded-md text-sm font-medium transition-colors ${
                            current_status === 'completed'
                                ? 'bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-sm'
                                : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100'
                        }`}
                    >
                        Completed ({counts.completed})
                    </Link>
                </div>

                {/* Tasks List */}
                <div className="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                    {tasks.data.length > 0 ? (
                        <div className="divide-y divide-gray-200 dark:divide-gray-700">
                            {tasks.data.map((task) => (
                                <div key={task.id} className="p-6 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                    <div className="flex items-start justify-between">
                                        <div className="flex-1">
                                            <div className="flex items-center gap-3 mb-2">
                                                <Link
                                                    href={`/tasks/${task.id}`}
                                                    className="text-lg font-semibold text-gray-900 dark:text-gray-100 hover:text-indigo-600 dark:hover:text-indigo-400"
                                                >
                                                    {task.title}
                                                </Link>
                                                <span className={`px-2 py-1 text-xs rounded-full ${getStatusColor(task.status)}`}>
                                                    {task.status.replace('_', ' ')}
                                                </span>
                                                <span className={`px-2 py-1 text-xs rounded-full ${getPriorityColor(task.priority)}`}>
                                                    {task.priority}
                                                </span>
                                            </div>
                                            {task.description && (
                                                <p className="text-gray-600 dark:text-gray-400 mb-2 line-clamp-2">
                                                    {task.description}
                                                </p>
                                            )}
                                            <div className="flex items-center gap-4 text-sm text-gray-500 dark:text-gray-400">
                                                <span>Created: {new Date(task.created_at).toLocaleDateString()}</span>
                                                {task.scheduled_at && (
                                                    <span>Scheduled: {new Date(task.scheduled_at).toLocaleDateString()}</span>
                                                )}
                                            </div>
                                        </div>
                                        <div className="flex items-center gap-2 ml-4">
                                            <Link
                                                href={`/tasks/${task.id}/edit`}
                                                className="px-3 py-1 text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 border border-gray-300 dark:border-gray-600 rounded-md hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors"
                                            >
                                                Edit
                                            </Link>
                                            <Link
                                                href={`/tasks/${task.id}`}
                                                className="px-3 py-1 text-sm text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300 border border-indigo-300 dark:border-indigo-600 rounded-md hover:bg-indigo-50 dark:hover:bg-indigo-900/20 transition-colors"
                                            >
                                                View
                                            </Link>
                                        </div>
                                    </div>
                                </div>
                            ))}
                        </div>
                    ) : (
                        <div className="p-12 text-center">
                            <div className="text-6xl mb-4">📋</div>
                            <h3 className="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">
                                No tasks found
                            </h3>
                            <p className="text-gray-600 dark:text-gray-400 mb-6">
                                Create your first task to get started with managing your productivity.
                            </p>
                            <Link
                                href="/tasks/create"
                                className="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors"
                            >
                                ➕ Create Your First Task
                            </Link>
                        </div>
                    )}
                </div>

                {/* Pagination */}
                {tasks.data.length > 0 && tasks.links.length > 3 && (
                    <div className="flex items-center justify-center gap-2">
                        {tasks.links.map((link, index) => (
                            <div key={index}>
                                {link.url ? (
                                    <Link
                                        href={link.url}
                                        className={`px-3 py-2 text-sm rounded-md transition-colors ${
                                            link.active
                                                ? 'bg-indigo-600 text-white'
                                                : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700'
                                        }`}
                                        dangerouslySetInnerHTML={{ __html: link.label }}
                                    />
                                ) : (
                                    <span
                                        className="px-3 py-2 text-sm text-gray-400 dark:text-gray-600"
                                        dangerouslySetInnerHTML={{ __html: link.label }}
                                    />
                                )}
                            </div>
                        ))}
                    </div>
                )}
            </div>
        </AppLayout>
    );
}