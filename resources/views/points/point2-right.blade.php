<div class="p-6 lg:p-10">
    <h2 class="text-xl font-bold text-[#1b1b18] dark:text-[#EDEDEC] mb-4">Решение</h2>
    <p class="mb-3">JS-код:</p>
    <div class="bg-[#f5f5f5] dark:bg-[#2a2a2a] p-4 rounded-md mb-3">
        <pre class="text-xs overflow-x-auto"><code class="language-javascript">$(document).ready(function() {
  function filterInputs() {
    var selectedVal = $('select[name="type_val"]').val();
    // Hide all p
    $('p').hide();

    // Show the parent p with the select
    $('p').filter(function() {
      return $(this).find('select[name="type_val"]').length > 0;
    }).show();

    // Show inputs matching the criteria
    $('input').each(function() {
      var inputName = $(this).attr('name');
      if (
        inputName && 
        (inputName === "input_" + selectedVal || inputName === "button_" + selectedVal)
      ) {
        $(this).parent().show();
      }
    });
  }

  // Run on page load
  filterInputs();

  // Run when select value changes
  $('select[name="type_val"]').change(function() {
    filterInputs();
  });
});</code></pre>
    </div>
    <p class="mb-3">Данный сниппет можно скопировать и запустить в консоли разработчика в браузере, и тогда он выполнит предписанное заданием поведение.</p>
    <p class="mb-3">В решении использована популярная JS-библиотека <a href="https://jquery.com/" target="_blank" class="text-[#f53003] dark:text-[#FF4433] hover:text-[#c02600] dark:hover:text-[#ff6b4a] underline underline-offset-2 cursor-pointer">jQuery</a>, по следующим причинам:</p>
    <ul class="list-disc pl-5 mb-3">
        <li>На тестовой странице она уже подключена к странице</li>
        <li>Опыт работы с данной библиотекой указан в требованиях в вакансии</li>
        <li>Кандидат постоянно применяет данную библиотеку в своей повседневной работе и хорошо с ней знаком</li>
        <li>Библиотека отлично подходит для решения данной задачи</li>
    </ul>
    <p class="mb-3">Алгоритм решения "скрыть все и потом показать те у которых в name есть выбранная цифра" является с точки зрения кандидата лучшим по сравнению с вариантом "показать все и потом скрыть те у которых выбранной цифры в атрибуте name нет" потому что является более интуитивно понятным и потому лучше поддерживаемым.</p>
    <p class="mb-3">Отмечу, что вероятно с целю запутать, на тестовой странице присутствуют элементы у которых отображаемые значения value ("Кнопка 1") не соответсвуют атрибуту name ("button_12") - в таких ситуациях скрипт кандидата отрабатывает строго по заданию (игнорируя отображаемые значения).</p>

</div>

