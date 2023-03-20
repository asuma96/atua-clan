@extends('layouts.app')
@section('content')
    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
        <div class="quiz-container mx-auto p-6 lg:p-8 quiz-content">
            <div class="flex justify-center">
                <img src="/img/atua-logo-white.svg" class="svg-icon home-atua-logo">
            </div>
            <div class="mt-16 quiz-container-bottom">
                <div class="grid grid-cols-1 md:grid-cols-1 gap-6 lg:gap-8">
                    <span
                        class="quiz-list scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                    </span>
                </div>
            </div>
        </div>
    </div>
@endsection
