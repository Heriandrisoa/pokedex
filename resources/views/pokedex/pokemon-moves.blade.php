@extends('layout.app')

@section('content')
@include('inc.about-navbar', ['pokeId' => $pokemon->pokedex_number])

<div class="d-flex flex-column align-items-center mt-3 p-3">
    <h1>{{$pokemon->pokemon_name}}</h1>
    <img src="{{ asset('sprite/' . $pokemon->pokemon_name . '.gif') }}" width="100" alt="">
</div>

<?php
    foreach($moves as $move)
    {
        echo "<div class='capacity' style = '--color: ".$colors[$move->type]."'>";
        echo "<p class='name-move'>".$move->name."</p>";

        echo "<p class='type' style='--color:".$colors[$move->type]."; --text: ".$text_colors[$move->type]."'>".$move->type."</p>";
        echo "<p class='damage-type'>".$move->type_damage."</p>"; 

        echo "</div>";
    }


?>

@endsection
