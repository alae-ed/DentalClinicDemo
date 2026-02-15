<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AIController;

Route::get('/', function () {
    return view('home');
});
Route::get('/ai-chat', function () {
    return view('ai-chat');
});
Route::post('/chatbot', [App\Http\Controllers\AIController::class, 'handle'])->name('chatbot.handle');


Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['ar', 'en', 'fr'])) {
        session()->put('locale', $locale);
        app()->setLocale($locale);
    }
    return redirect()->back();
})->name('language.switch');

Route::post('/ai-agent', [AIController::class, 'handle'])->name('ai.handle');

// Auth::routes(); // Disabled for no-database requirement

Route::get('/home', function () {
    return redirect('/');
})->name('home');
