<p align="center">
  <h1 align="center">Тестовое задание для AmoPoint</h1>
  <div align="center" style="margin-top: -10px;">
    <h3 align="center" style="margin-bottom: 5px;">Кандидат: Похилюк Артем</h3>
    <h3 align="center" style="margin-top: 5px;">Вакансия: PHP-программист</h3>
  </div>
</p>

<p align="center">
  <img src="./public/images/amopoint-logo.png" alt="AmoPoint Logo" width="150">
  <br>
  <a href="https://amopoint.ru/" target="_blank">Сайт компании</a>
</p>


<p align="center">
  <a href="https://hh.ru/vacancy/132699498" target="_blank" style="display: inline-flex; align-items: center; background-color: #007bff; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; font-size: 14px; font-weight: 600; line-height: 1.5; border: 1px solid rgba(0,0,0,0.1);">
    <img src="./public/images/HeadHunter-logo.png" width="20" height="20" style="margin-right: 8px;" alt="HH">
    вакансия
  </a>
  &nbsp;&nbsp;
  <a href="https://hh.ru/resume/9207f557ff0bf4ecfc0039ed1f71464d546442" target="_blank" style="display: inline-flex; align-items: center; background-color: #28a745; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; font-size: 14px; font-weight: 600; line-height: 1.5; border: 1px solid rgba(0,0,0,0.1);">
    <img src="./public/images/HeadHunter-logo.png" width="20" height="20" style="margin-right: 8px;" alt="Resume">
    резюме кандидата
  </a>
</p>

## Описание задания

1. Напишите Laravel проект, в состав которого обязательно входит
   1. Консольная команда, которая каждые 5 минут получает информацию от любого API на ваш выбор и сохраняет её в таблицу БД
   2. Route, отдающий массив записей таблицы в формате json. Например:   https://official-joke-api.appspot.com/random_joke


2. Необходимо написать js код, который в зависимости от выбранного значения поля Тип отражает разный набор полей на странице   http://test.amopoint-dev.ru/testzz/testlist.html
Должны отображаться только те поля в атрибуте name которых есть значение выбранного элемента списка.
Решение должно представлять из себя файл для подключения к странице, либо сниппет для запуска в браузере в консоли.
Допускается использование сторонних библиотек при условии обоснования их использования. При разборе выполненных заданий при прочих равных будет важнее алгоритм решения. Будет плюсом перечисление алгоритмов решений-аналогов и почему не были выбраны эти варианты.
3. Дополнительное задание.
Написать счетчик посещений страницы. Решение должно состоять из двух компонентов: 
-кода на js, который подключается к любому сайту. Скрипт должен собрать необходимые данные(ip, город, устройство) и отправлять на сервер.
 -бэк часть, который хранит данные в БД(sqllite или другой на выбор) и показывает график посещений по часам(по оси х - количество уникальных посещений за час, по оси y- время), круговую диаграмму с разбиением по городам.
Оформить в виде страницы просмотра статистики с авторизацией. Решение выложить на любой хостинг для возможности проверки