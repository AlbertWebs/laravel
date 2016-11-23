<?php

use Illuminate\Database\Eloquent\Factory as EloquentFactory;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    app()->make(EloquentFactory::class)->load(__DIR__.'/../../../../src/database/factories/');

    Artisan::call('migrate:refresh');

    Artisan::call('db:seed', [
        '--class' => 'Larafolio\database\seeds\DatabaseSeeder'
    ]);

    $user = App\User::first();

    Auth::login($user);

    return redirect('/manager');
});
