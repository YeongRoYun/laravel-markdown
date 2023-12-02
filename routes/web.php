<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get("/docs/{file?}", function (string $file = null) {
    $doc = new App\Models\Documentation();
    if ($file == null) {
        $text = $doc->get();
    } else {
        $text = (new App\Models\Documentation())->get($file);
    }
    return app(ParsedownExtra::class)->text($text);
});
