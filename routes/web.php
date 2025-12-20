<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PokemonsController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('pokedex', PokemonsController::class);
Route::get('/pokedex/{id}/moves', [PokemonsController::class, 'get_moves']); 
Route::get('/pokedex/{id}/stats', [PokemonsController::class, 'get_stats']);
Route::get('/pokedex/{id}/compare', [PokemonsController::class, 'index_compare']);
Route::get('/pokedex/{id1}/compare/{id2}', [PokemonsController::class, 'compare']);
Route::get('/filter', [PokemonsController::class, 'index_filter']);
Route::get('/api/{id}/stats', [PokemonsController::class, 'api_stats']);
Route::get('/api/pokedex', [PokemonsController::class,'api_pokedex']);