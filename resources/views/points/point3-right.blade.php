<div class="p-6 lg:p-10">
    <h2 class="text-xl font-bold text-[#1b1b18] dark:text-[#EDEDEC] mb-4">Решение</h2>
    <p class="mb-3"><a href="{{ route('dashboard') }}" target="_blank" class="text-[#f53003] dark:text-[#FF4433] hover:text-[#c02600] dark:hover:text-[#ff6b4a] underline underline-offset-2 cursor-pointer">"Дашборд посещений" здесь</a> (email: test@test.ru, пароль: password123).</p>
    <p class="mb-3">JS-код:</p>
    <div class="bg-[#f5f5f5] dark:bg-[#2a2a2a] p-4 rounded-md mb-3">
        <pre class="text-xs overflow-x-auto"><code class="language-javascript">(async function() {
  try {
    // Получаем IP
    const ipResponse = await fetch('https://api.ipify.org?format=json');
    const ipData = await ipResponse.json();
    const ip = ipData.ip;

    // Получаем город по IP
    const cityResponse = await fetch(`https://ipapi.co/${ip}/json/`);
    const cityData = await cityResponse.json();
    const city = cityData.city;

    // Собираем данные об устройстве
    const deviceType = /mobile/i.test(navigator.userAgent) ? 'mobile' :
                   /tablet/i.test(navigator.userAgent) ? 'tablet' : 'desktop';

    // Формируем пакет данных
    const visitData = {
      ip_address: ip,
      city: city,
      device: deviceType,
      userAgent: navigator.userAgent,
      timestamp: new Date().toISOString(),
      screenResolution: `${screen.width}x${screen.height}`,
      language: navigator.language,
      referrer: document.referrer
    };

    // Отправляем на бэкенд
    await fetch('https://amopoint-pokhiliuk-production.up.railway.app/api/visits', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(visitData)
    });
  } catch (error) {
    console.error('Ошибка сбора данных:', error);
  }
})();</code></pre>
    </div>
    <p class="mb-3">Бэкенд-часть написана и задеплоена здесь же (ссылка выше), тоже на Laravel, база данных MySQL. Раздел доступен только авторизованным пользователям (тестовые креденшлы предоставлены для проверки).</p>
    <p class="mb-3">По умолчанию графики не содержат данных и начнут отображать информацию только после того как проверяющий встроит JS-скрипт себе на страницу и с неё начнут поступать вызовы. Графики отображают данные о посещениях только за последние 24 часа.</p>
    <p class="mb-3">Для прорисовки графиков была использована JS-библиотека <a href="https://apexcharts.com/" target="_blank" class="text-[#f53003] dark:text-[#FF4433] hover:text-[#c02600] dark:hover:text-[#ff6b4a] underline underline-offset-2 cursor-pointer">ApexCharts</a>.</p>

</div>

