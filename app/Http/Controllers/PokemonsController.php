<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PokemonsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pokemons = DB::select('SELECT * FROM pokedex order by pokedex_number');
        return view('pokedex.index')->with('pokemons', $pokemons);
    }

    /**
     * Show the form for creating a new resource.
     */
    
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pokemon = DB::select('SELECT * FROM pokedex
        JOIN poke_profile ON pokedex.pokedex_number = poke_profile.pokedex_number
        WHERE pokedex.pokedex_number=\''.$id.'\'');
        // return $pokemon;
        return view('pokedex.about')->with('pokemon', $pokemon[0]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function get_moves(string $id)
    {
        $moves = DB::select('SELECT name,type,type_damage,PP,power   FROM move_final m
        join move_description d 
        ON m.move = d.name
        where m.pokeid = \''.$id.'\'');

    $pokemon = DB::select('SELECT * FROM pokedex
    WHERE pokedex.pokedex_number=\''.$id.'\'');
        // return $moves;
        return view('pokedex.pokemon-moves')->with('moves', $moves)
                                            ->with('pokemon', $pokemon[0]);
    }

    public function get_stats(string $id)
    {
        $stats = DB::select('SELECT s.*,p.pokemon_name,p.type_1, p.type_2 FROM poke_stats s JOIN pokedex p ON s.pokedex_number = p.pokedex_number WHERE p.pokedex_number = \''.$id.'\'');
        return view('pokedex.show-stats')->with('pokemon', $stats[0]);    
    }

    public function index_compare(string $id)
    {
        $pokemons = DB::select('SELECT * FROM pokedex order by pokedex_number');
        return view('pokedex.compare-index')->with('pokemons', $pokemons)
                                            ->with('to_compare', $id);
    }

    public function compare(string $id1, string $id2)
    {
        $pokemon1 = DB::select('SELECT s.*,p.pokemon_name,p.type_1, p.type_2 FROM poke_stats s JOIN pokedex p ON s.pokedex_number = p.pokedex_number WHERE p.pokedex_number = \''.$id1.'\'');
        $pokemon2 = DB::select('SELECT s.*,p.pokemon_name,p.type_1, p.type_2 FROM poke_stats s JOIN pokedex p ON s.pokedex_number = p.pokedex_number WHERE p.pokedex_number = \''.$id2.'\'');

        return view('pokedex.compare')->with('pokemon1', $pokemon1[0])
                              ->with('pokemon2', $pokemon2[0]);
    }

    public function index_filter()
    {
        $pokemons = DB::select('SELECT * from pokedex JOIN poke_stats ON pokedex.pokedex_number = poke_stats.pokedex_number ');
        return view('pokedex.filter-index')->with('pokemons', $pokemons);
    }

    public function api_stats(string $id)
    {
        $stats = DB::select('SELECT * FROM poke_stats WHERE pokedex_number=\''.$id.'\'');
        return $stats;
    }

    public function api_pokedex()
    {
        $pokemons = DB::select('SELECT * FROM pokedex order by pokedex_number');
        return $pokemons;
    }
}
