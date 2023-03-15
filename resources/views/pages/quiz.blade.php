@extends('layouts.app')
@section('content')
    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
        <div class="quiz-container mx-auto p-6 lg:p-8 quiz-content">
            <div class="flex justify-center">
                <img src="/img/atua-logo-white.svg" class="svg-icon home-atua-logo">
            </div>
            <div class="mt-16">
                <div class="grid grid-cols-1 md:grid-cols-1 gap-6 lg:gap-8">
                    <span
                        class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                        <div>
                            <div>
                                <video width="360" height="240" controls controlsList="nodownload">
                                    <source src="/videos/AKIMATO80sn90ssnip.mp4" type="video/mp4">
                                        Your browser does not support the video tag.
                                </video>
                            </div>
                            <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white quiz-text">Documentation</h2>
                            <h1></h1>
                            <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                                Laravel has wonderful documentation covering every aspect of the framework. Whether you
                                are a newcomer or have prior experience with Laravel, we recommend reading our
                                documentation from beginning to end.
                            </p>
                        </div>
                    </span>
                </div>
            </div>
        </div>
    </div>
@endsection
