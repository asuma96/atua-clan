@extends('layouts.app')
@section('content')
    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
        <div class="quiz-container mx-auto p-6 lg:p-8 quiz-content">
            <div class="flex justify-center">
                <img src="/img/atua-gates.svg" class="svg-icon home-atua-logo-home">
            </div>
            <div class="mt-16">
                <div class="grid grid-cols-1 md:grid-cols-1 gap-6 lg:gap-8">
                    <span
                        class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                        <div class="user-block-text">
                            <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white quiz-text">SACRAL GATES | КОНЦЕРТ ATUA CLAN</h2>
                            <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed user-description">
                                Одинокие ренегаты рискуют раствориться на выжженных полях Пустоши под гнётом песчаной стихии. Готов ли ты присоединиться к ATUA CLAN, чтобы пройти сквозь все препятствия и узнать секрет Сакральных ворот.
                            </p>
                            <form action="user" method="post" class="grid">
    {{ csrf_field() }}
                            <input type="text" id="name" name="name" alt="Введите своё имя" class="user-input" placeholder="Введи имя" required>
                            <button class="register-btn"> JOIN ATUA</button>
                            </form>
                        </div>
                    </span>
                </div>
            </div>
        </div>
    </div>
@endsection
