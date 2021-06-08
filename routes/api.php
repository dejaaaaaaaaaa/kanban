<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['auth:api']], function () {
    Route::apiResource('users', 'App\Http\Controllers\Api\UsersController')->except(['create', 'edit']);
    Route::apiResource('tickets', 'App\Http\Controllers\Api\TicketsController')->except(['create', 'edit']);

    Route::get('tickets/status/{status}', 'App\Http\Controllers\Api\TicketsController@ticketsPerStatus');
    Route::get('tickets/per-status/{status}', 'App\Http\Controllers\Api\TicketsController@ticketsCountPerStatus');

    Route::post('users/search', 'App\Http\Controllers\Api\SearchUsersController@search');
    Route::post('tickets/search', 'App\Http\Controllers\Api\SearchTicketsController@search');

    Route::get('tickets/{ticket}/ticket-history', 'App\Http\Controllers\Api\TicketHistoryController@history');

});
