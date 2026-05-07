<div class="p-6 lg:p-10">
    <h2 class="text-xl font-bold text-[#1b1b18] dark:text-[#EDEDEC] mb-4">Решение</h2>
    <p class="mb-3"><a href="{{ route('latest_news') }}" target="_blank" class="text-[#f53003] dark:text-[#FF4433] hover:text-[#c02600] dark:hover:text-[#ff6b4a] underline underline-offset-2 cursor-pointer">Результирующий Route здесь</a>.</p>
    <p class="mb-3">В качестве API, с которого происходит сбор информации с сохранением в БД проекта, выбран <a href="https://currentsapi.services/en" target="_blank" class="text-[#f53003] dark:text-[#FF4433] hover:text-[#c02600] dark:hover:text-[#ff6b4a] underline underline-offset-2 cursor-pointer">Currents News API</a>, возвращающий json-массив со свежими мировыми новостями. На бесплатном плане 1000 запросов в день, что достаточно для решения задачи (в сутки необходимо выполнить, с интервалом в 5 минут, 288 запросов)</p>
    <p class="mb-3">Приложение задеплоено на облачную PaaS-платформу <a href="https://railway.com/" target="_blank" class="text-[#f53003] dark:text-[#FF4433] hover:text-[#c02600] dark:hover:text-[#ff6b4a] underline underline-offset-2 cursor-pointer">Railway</a>, на которой также развернута MySQL БД и запущена cron-задача для ежепятиминутного обращения к внешнему API.</p>
    <p class="mb-3">Результирующий роут, отдающий сохранённые новости, возвращает 10 самых свежих сохраненных новостей (решение кандидата, чтоб не загромождать страницу сильно). Таким образом, при условии работоспособности внешнего API, записи должны сменяться каждые 5 минут.</p>
    <p class="mb-3">.</p>
</div>

