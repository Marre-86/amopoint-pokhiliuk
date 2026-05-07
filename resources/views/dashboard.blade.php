<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Панель управления - {{ config('app.name', 'Laravel') }}</title>

        @fonts

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/dashboard-charts.js'])
        <!-- ApexCharts Library -->
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        
        <!-- Pass chart data from backend to JavaScript -->
        <script>
            window.chartData = {
                lineChart: {
                    labels: @json($line_chart_labels),
                    data: @json($line_chart_data)
                },
                pieChart: {
                    labels: @json($pie_chart_labels),
                    data: @json($pie_chart_data)
                },
                totalVisits: {{ $total_visits }},
                lastUpdated: '{{ $last_updated }}'
            };
        </script>
    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] min-h-screen">
        <header class="w-full p-6 lg:p-8">
            <nav class="flex items-center justify-between max-w-7xl mx-auto">
                <div class="flex items-center gap-4">
                    <a href="{{ url('/') }}" class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal">
                        ← На главную
                    </a>
                    <h1 class="text-lg font-semibold text-[#1b1b18] dark:text-[#EDEDEC]">
                        Дашборд посещений
                    </h1>
                </div>
                
                <div class="flex items-center gap-4">
                    <span class="text-sm text-[#6F6E69] dark:text-[#A1A09A]">
                        Добро пожаловать, {{ Auth::user()->name ?? 'Пользователь' }}
                    </span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button
                            type="submit"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal cursor-pointer"
                        >
                            Выйти
                        </button>
                    </form>
                </div>
            </nav>
        </header>

        <main class="p-6 lg:p-8 max-w-7xl mx-auto">
            <div class="mb-8">
                {{-- <h2 class="text-2xl font-bold text-[#1b1b18] dark:text-[#EDEDEC] mb-2">
                    Добро пожаловать в панель управления
                </h2> --}}
                <p class="text-[#6F6E69] dark:text-[#A1A09A]">
                    Здесь отображается статистика посещений страницы, к которой был подключён предоставленный кандидатом JS-скрипт
                </p>
            </div>

            
            <!-- Chart Section -->
            <div class="p-6 bg-white dark:bg-[#161615] dark:text-[#EDEDEC] shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] rounded-lg mb-8">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h3 class="text-xl font-bold">Статистика посещений</h3>
                        <p class="text-sm text-[#6F6E69] dark:text-[#A1A09A] mt-1">
                            Данные за последние 24 часа
                        </p>
                    </div>
                    <div class="text-right">
                        <div class="text-2xl font-bold text-[#1b1b18] dark:text-[#EDEDEC]">{{ $total_visits }}</div>
                        <div class="text-sm text-[#6F6E69] dark:text-[#A1A09A]">Всего посещений</div>
                    </div>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div>
                        <h4 class="text-lg font-semibold mb-4">Посещения по часам</h4>
                        <div id="chart-line"></div>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold mb-4">Распределение по городам</h4>
                        <div id="chart-pie"></div>
                    </div>
                </div>
                <div class="mt-6 pt-6 border-t border-[#19140035] dark:border-[#3E3E3A] text-sm text-[#6F6E69] dark:text-[#A1A09A] text-right">
                    Данные обновлены: {{ $last_updated }}
                </div>
            </div>

        </main>
        <footer class="p-6 lg:p-8 max-w-7xl mx-auto mt-8 border-t border-[#19140035] dark:border-[#3E3E3A]">
            <div class="text-center text-sm text-[#6F6E69] dark:text-[#A1A09A]">
                <p>{{ config('app.name', 'Laravel') }} • {{ date('Y') }}</p>
            </div>
        </footer>
    </body>
</html>