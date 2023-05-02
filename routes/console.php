<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');


Artisan::command('test',function () {
    print_r("este es un test");
    // App\Jobs\TestJob::dispatch("1");
    // return response("fin");
})->describe('Job test');

Artisan::command('test:test1',function () {
    print_r("este es un test");
})->describe('job sub comando');

