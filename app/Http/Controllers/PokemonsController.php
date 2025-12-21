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


        $under_id = (int) $id - 1;
        $upper_id = (int) $id + 1;
        $under2_id = $under_id - 1;
        $upper2_id = (int) $upper_id + 1;
        
        if( $under_id == 0) $under_id = 1;
        
        if ( $under2_id == 0) $under2_id = 1;
        if ( $upper_id > 482) $upper_id = 482;
        if ( $upper2_id > 482) $upper2_id = 482; 


        $under =  DB::select('SELECT * FROM pokedex
        JOIN poke_profile ON pokedex.pokedex_number = poke_profile.pokedex_number
        WHERE pokedex.pokedex_number=\''.$under_id.'\'');
        
        $under2 =  DB::select('SELECT * FROM pokedex
        JOIN poke_profile ON pokedex.pokedex_number = poke_profile.pokedex_number
        WHERE pokedex.pokedex_number=\''.$under2_id.'\'');
        
        $upper =  DB::select('SELECT * FROM pokedex
        JOIN poke_profile ON pokedex.pokedex_number = poke_profile.pokedex_number
        WHERE pokedex.pokedex_number=\''.$upper_id.'\'');
    

        $upper2 =  DB::select('SELECT * FROM pokedex
        JOIN poke_profile ON pokedex.pokedex_number = poke_profile.pokedex_number
        WHERE pokedex.pokedex_number=\''.$upper2_id.'\'');

        $frontier = DB::select('SELECT * FROM pokedex
        JOIN poke_profile ON pokedex.pokedex_number = poke_profile.pokedex_number
        WHERE pokedex.evolves_from=\''.$pokemon[0]->pokemon_name.'\'');
        $family = [];
        $visited = [];


        if( $pokemon[0]->can_evolve || $pokemon[0]->evolves_from !=null) {
            $family[] = $pokemon[0];
        }    
    while (!empty($frontier)) {

        $element = array_pop($frontier);

        $id = $element->pokedex_number;

        if (isset($visited[$id])) {
            continue;
        }

        $visited[$id] = true;
        $family[] = $element;
        $extends = DB::select('SELECT * FROM pokedex JOIN poke_profile ON pokedex.pokedex_number = poke_profile.pokedex_number WHERE pokedex.evolves_from=\''.$element->pokemon_name.'\''); $extends2 = DB::select('SELECT * FROM pokedex JOIN poke_profile ON pokedex.pokedex_number = poke_profile.pokedex_number WHERE pokedex.evolves_from=\''.$element->evolves_from.'\'');$extends = DB::select('SELECT * FROM pokedex JOIN poke_profile ON pokedex.pokedex_number = poke_profile.pokedex_number WHERE pokedex.evolves_from=\''.$element->pokemon_name.'\''); $extends2 = DB::select('SELECT * FROM pokedex JOIN poke_profile ON pokedex.pokedex_number = poke_profile.pokedex_number WHERE pokedex.evolves_from=\''.$element->evolves_from.'\'');
        foreach (array_merge($extends, $extends2) as $el) {
            $eid = $el->pokedex_number;

            if (!isset($visited[$eid])) {
                $frontier[] = $el;
            }
        }
    }

        $frontier = DB::select('SELECT * FROM pokedex
        JOIN poke_profile ON pokedex.pokedex_number = poke_profile.pokedex_number
        WHERE pokedex.pokemon_name=\''.$pokemon[0]->evolves_from.'\'');
        $visited = [];
        
        while(!empty($frontier))
        {
            $element = array_pop($frontier);

            $id = $element->pokedex_number;

            if (isset($visited[$id])) {
            continue;
            }

            $visited[$id] = true;
            $family[] = $element;
            $extends = DB::select('SELECT * FROM pokedex JOIN poke_profile ON pokedex.pokedex_number = poke_profile.pokedex_number WHERE pokedex.pokemon_name=\''.$element->evolves_from.'\'');            
            foreach ($extends as $el) {
                $eid = $el->pokedex_number;

                if (!isset($visited[$eid])) {
                    $frontier[] = $el;
                }
            }

        }


    foreach ($family as $key => $value) {
        if ( $value->pokemon_name == $pokemon[0]->pokemon_name ) {
            unset($family[$key]);
        }
    }

        //return $family;
        return view('pokedex.about')->with('pokemon', $pokemon[0])
                                          ->with('family', $family);

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

    public function show_capacity(string $name)
    {
        $capacity = DB::select("SELECT * FROM move_description where name='".$name."'");
        return $capacity[0];
        //return view("pokedex.show_capacity")->with("capacity", $capacity[0]);
    }

    public function who_got_capacity(string $name) {

        $pokemons = DB::select("SELECT p.*,m.move FROM pokedex p JOIN move_final m ON p.pokedex_number = m.pokeId WHERE move = '".$name."'");
        return view('pokedex.index')->with('pokemons', $pokemons);
    }
}
