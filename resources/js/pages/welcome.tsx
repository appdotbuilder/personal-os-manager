import React from 'react';
import { type SharedData } from '@/types';
import { Head, Link, usePage } from '@inertiajs/react';

export default function Welcome() {
    const { auth } = usePage<SharedData>().props;

    return (
        <>
            <Head title="Welcome">
                <link rel="preconnect" href="https://fonts.bunny.net" />
                <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
            </Head>
            <div className="flex min-h-screen flex-col items-center bg-gradient-to-br from-blue-50 to-indigo-100 p-6 text-slate-800 lg:justify-center lg:p-8 dark:from-slate-900 dark:to-slate-800 dark:text-slate-100">
                <header className="mb-6 w-full max-w-6xl">
                    <nav className="flex items-center justify-between">
                        <div className="flex items-center gap-2">
                            <div className="text-2xl">🧠</div>
                            <span className="text-xl font-semibold">PersonalOS</span>
                        </div>
                        <div className="flex items-center gap-4">
                            {auth.user ? (
                                <Link
                                    href={route('dashboard')}
                                    className="inline-block rounded-lg border border-transparent bg-indigo-600 px-6 py-2 text-sm font-medium text-white hover:bg-indigo-700 transition-colors"
                                >
                                    Go to Dashboard
                                </Link>
                            ) : (
                                <>
                                    <Link
                                        href={route('login')}
                                        className="inline-block rounded-lg border border-slate-300 px-6 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50 transition-colors dark:border-slate-600 dark:text-slate-300 dark:hover:bg-slate-800"
                                    >
                                        Log in
                                    </Link>
                                    <Link
                                        href={route('register')}
                                        className="inline-block rounded-lg border border-transparent bg-indigo-600 px-6 py-2 text-sm font-medium text-white hover:bg-indigo-700 transition-colors"
                                    >
                                        Get Started
                                    </Link>
                                </>
                            )}
                        </div>
                    </nav>
                </header>

                <main className="flex w-full max-w-6xl flex-col items-center text-center">
                    {/* Hero Section */}
                    <div className="mb-16">
                        <div className="text-6xl mb-6">🧠✨</div>
                        <h1 className="mb-6 text-4xl md:text-6xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                            Your Personal Operating System
                        </h1>
                        <p className="mb-8 text-xl md:text-2xl text-slate-600 dark:text-slate-300 max-w-3xl mx-auto">
                            Manage your time, create amazing content, capture thoughts, and analyze your productivity—all in one powerful platform.
                        </p>
                        {!auth.user && (
                            <Link
                                href={route('register')}
                                className="inline-block rounded-lg bg-gradient-to-r from-indigo-600 to-purple-600 px-8 py-4 text-lg font-medium text-white hover:from-indigo-700 hover:to-purple-700 transition-all transform hover:scale-105"
                            >
                                Start Your Journey 🚀
                            </Link>
                        )}
                    </div>

                    {/* Features Grid */}
                    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-16 w-full">
                        {/* Time Management */}
                        <div className="bg-white dark:bg-slate-800 rounded-xl p-6 shadow-lg hover:shadow-xl transition-shadow">
                            <div className="text-4xl mb-4">⏰</div>
                            <h3 className="text-xl font-semibold mb-3 text-slate-800 dark:text-slate-100">Time Management</h3>
                            <ul className="text-sm text-slate-600 dark:text-slate-300 space-y-2">
                                <li>📝 Smart To-Do Lists</li>
                                <li>📋 Backlog Management</li>
                                <li>📅 Calendar Scheduling</li>
                                <li>⚡ Priority System</li>
                            </ul>
                        </div>

                        {/* Content Creation */}
                        <div className="bg-white dark:bg-slate-800 rounded-xl p-6 shadow-lg hover:shadow-xl transition-shadow">
                            <div className="text-4xl mb-4">🎨</div>
                            <h3 className="text-xl font-semibold mb-3 text-slate-800 dark:text-slate-100">Content Creation</h3>
                            <ul className="text-sm text-slate-600 dark:text-slate-300 space-y-2">
                                <li>💡 Ideas Management</li>
                                <li>✍️ Draft Tracking</li>
                                <li>📊 Content Pipeline</li>
                                <li>🗓️ Publishing Calendar</li>
                            </ul>
                        </div>

                        {/* Notes & Journals */}
                        <div className="bg-white dark:bg-slate-800 rounded-xl p-6 shadow-lg hover:shadow-xl transition-shadow">
                            <div className="text-4xl mb-4">📖</div>
                            <h3 className="text-xl font-semibold mb-3 text-slate-800 dark:text-slate-100">Notes & Journals</h3>
                            <ul className="text-sm text-slate-600 dark:text-slate-300 space-y-2">
                                <li>📓 Digital Journaling</li>
                                <li>🏷️ Smart Tagging</li>
                                <li>🔍 Powerful Search</li>
                                <li>💭 Thought Organization</li>
                            </ul>
                        </div>

                        {/* Analytics */}
                        <div className="bg-white dark:bg-slate-800 rounded-xl p-6 shadow-lg hover:shadow-xl transition-shadow">
                            <div className="text-4xl mb-4">📈</div>
                            <h3 className="text-xl font-semibold mb-3 text-slate-800 dark:text-slate-100">Content Analytics</h3>
                            <ul className="text-sm text-slate-600 dark:text-slate-300 space-y-2">
                                <li>📊 Performance Tracking</li>
                                <li>🎯 Keyword Analysis</li>
                                <li>📋 Content Categorization</li>
                                <li>🧠 AI Insights</li>
                            </ul>
                        </div>
                    </div>

                    {/* Demo Screenshots */}
                    <div className="mb-16 w-full">
                        <h2 className="text-3xl font-bold mb-8 text-slate-800 dark:text-slate-100">See It In Action</h2>
                        <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
                            {/* Dashboard Preview */}
                            <div className="bg-white dark:bg-slate-800 rounded-xl p-4 shadow-lg">
                                <div className="bg-gradient-to-br from-blue-50 to-indigo-100 dark:from-slate-700 dark:to-slate-600 rounded-lg h-40 flex items-center justify-center mb-4">
                                    <div className="text-4xl">📊</div>
                                </div>
                                <h4 className="font-semibold text-slate-800 dark:text-slate-100">Unified Dashboard</h4>
                                <p className="text-sm text-slate-600 dark:text-slate-300 mt-2">
                                    Everything you need at a glance
                                </p>
                            </div>

                            {/* Task Management Preview */}
                            <div className="bg-white dark:bg-slate-800 rounded-xl p-4 shadow-lg">
                                <div className="bg-gradient-to-br from-green-50 to-emerald-100 dark:from-slate-700 dark:to-slate-600 rounded-lg h-40 flex items-center justify-center mb-4">
                                    <div className="text-4xl">✅</div>
                                </div>
                                <h4 className="font-semibold text-slate-800 dark:text-slate-100">Smart Task Management</h4>
                                <p className="text-sm text-slate-600 dark:text-slate-300 mt-2">
                                    Organize and prioritize your work
                                </p>
                            </div>

                            {/* Content Calendar Preview */}
                            <div className="bg-white dark:bg-slate-800 rounded-xl p-4 shadow-lg">
                                <div className="bg-gradient-to-br from-purple-50 to-pink-100 dark:from-slate-700 dark:to-slate-600 rounded-lg h-40 flex items-center justify-center mb-4">
                                    <div className="text-4xl">📅</div>
                                </div>
                                <h4 className="font-semibold text-slate-800 dark:text-slate-100">Content Calendar</h4>
                                <p className="text-sm text-slate-600 dark:text-slate-300 mt-2">
                                    Plan and schedule your content
                                </p>
                            </div>
                        </div>
                    </div>

                    {/* CTA Section */}
                    {!auth.user && (
                        <div className="bg-white dark:bg-slate-800 rounded-2xl p-8 shadow-xl w-full max-w-2xl">
                            <h2 className="text-3xl font-bold mb-4 text-slate-800 dark:text-slate-100">Ready to Get Organized? 🎯</h2>
                            <p className="text-lg text-slate-600 dark:text-slate-300 mb-6">
                                Join thousands of creators and professionals who have transformed their productivity with PersonalOS.
                            </p>
                            <div className="flex flex-col sm:flex-row gap-4 justify-center">
                                <Link
                                    href={route('register')}
                                    className="inline-block rounded-lg bg-gradient-to-r from-indigo-600 to-purple-600 px-8 py-4 text-lg font-medium text-white hover:from-indigo-700 hover:to-purple-700 transition-all transform hover:scale-105"
                                >
                                    Start Free Today 🚀
                                </Link>
                                <Link
                                    href={route('login')}
                                    className="inline-block rounded-lg border border-slate-300 dark:border-slate-600 px-8 py-4 text-lg font-medium text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors"
                                >
                                    Already have an account?
                                </Link>
                            </div>
                        </div>
                    )}
                </main>

                <footer className="mt-16 text-sm text-slate-500 dark:text-slate-400">
                    Built with ❤️ for creators and productivity enthusiasts
                </footer>
            </div>
        </>
    );
}