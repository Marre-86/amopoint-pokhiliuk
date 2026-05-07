<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Вход - {{ config('app.name', 'Laravel') }}</title>

        @fonts

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
        <header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6">
            <nav class="flex items-center justify-between">
                <a href="{{ url('/') }}" class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal">
                    ← На главную
                </a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                        Регистрация
                    </a>
                @endif
            </nav>
        </header>
        
        <div class="flex items-center justify-center w-full transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0">
            <main class="flex max-w-[335px] w-full flex-col lg:max-w-md">
                <div class="text-[13px] leading-[20px] p-6 pb-6 lg:p-10 lg:pb-10 bg-white dark:bg-[#161615] dark:text-[#EDEDEC] shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] rounded-lg">
                    <div class="text-center mb-8">
                        <h1 class="text-2xl font-bold text-[#1b1b18] dark:text-[#EDEDEC] mb-2">
                            Вход в панель управления
                        </h1>
                        <p class="text-[#6F6E69] dark:text-[#A1A09A]">
                            Введите свои учетные данные для доступа к панели
                        </p>
                    </div>

                    @if ($errors->any())
                        <div class="mb-6 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-sm">
                            <div class="text-red-700 dark:text-red-300 font-medium mb-1">Ошибка входа</div>
                            <ul class="text-red-600 dark:text-red-400 text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-6">
                            <label for="email" class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-2">
                                Email
                            </label>
                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autocomplete="email"
                                autofocus
                                class="w-full px-4 py-2.5 bg-white dark:bg-[#1C1C1A] border border-[#19140035] dark:border-[#3E3E3A] rounded-sm text-[#1b1b18] dark:text-[#EDEDEC] placeholder-[#6F6E69] dark:placeholder-[#A1A09A] focus:outline-none focus:ring-2 focus:ring-[#19140035] dark:focus:ring-[#3E3E3A] focus:border-transparent"
                                placeholder="test@test.ru"
                            >
                            @error('email')
                                {{-- <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> --}}
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="password" class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-2">
                                Пароль
                            </label>
                            <input
                                id="password"
                                type="password"
                                name="password"
                                required
                                autocomplete="current-password"
                                class="w-full px-4 py-2.5 bg-white dark:bg-[#1C1C1A] border border-[#19140035] dark:border-[#3E3E3A] rounded-sm text-[#1b1b18] dark:text-[#EDEDEC] placeholder-[#6F6E69] dark:placeholder-[#A1A09A] focus:outline-none focus:ring-2 focus:ring-[#19140035] dark:focus:ring-[#3E3E3A] focus:border-transparent"
                                placeholder="••••••••"
                            >
                            @error('password')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between mb-8">
                            <div class="flex items-center">
                                <input
                                    id="remember"
                                    name="remember"
                                    type="checkbox"
                                    class="h-4 w-4 text-[#1b1b18] dark:text-[#EDEDEC] border-[#19140035] dark:border-[#3E3E3A] rounded focus:ring-[#19140035] dark:focus:ring-[#3E3E3A]"
                                >
                                <label for="remember" class="ml-2 block text-sm text-[#1b1b18] dark:text-[#EDEDEC]">
                                    Запомнить меня
                                </label>
                            </div>
                        </div>

                        <button
                            type="submit"
                            class="w-full py-2.5 px-4 bg-[#1b1b18] dark:bg-[#EDEDEC] text-white dark:text-[#1b1b18] font-medium rounded-sm hover:bg-[#2a2a26] dark:hover:bg-[#F5F5F4] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1b1b18] dark:focus:ring-[#EDEDEC] transition-colors cursor-pointer"
                        >
                            Войти
                        </button>
                    </form>

                    <div class="mt-8 pt-6 border-t border-[#19140035] dark:border-[#3E3E3A] text-center">
                        <p class="text-sm text-[#6F6E69] dark:text-[#A1A09A]">
                            Нет учетной записи?
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="text-[#1b1b18] dark:text-[#EDEDEC] font-medium hover:underline">
                                    Зарегистрируйтесь здесь
                                </a>
                            @else
                                <span class="text-[#6F6E69] dark:text-[#A1A09A]">
                                    Обратитесь к администратору
                                </span>
                            @endif
                        </p>
                    </div>
                </div>
            </main>
        </div>
    </body>
</html>