<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('app:get-news')->everyFiveMinutes();
Schedule::command('db:seed')->everyFiveMinutes();
