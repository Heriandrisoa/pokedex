@extends('layout.app')

@section('content')
@include('inc.about-navbar', ['pokeId' => $pokemon->pokedex_number])

<div class="d-flex flex-column align-items-center mt-3 p-3">
    <h1>{{$pokemon->pokemon_name}}</h1>
    <img src="{{ asset('sprite/' . $pokemon->pokemon_name . '.gif') }}" width="100" alt="">
</div>
@include('inc.search-bar')

<?php
foreach ($moves as $move) {
    echo "<div class='capacity-container'>";

    echo "<button type='button' class='capacity-link' style='text-decoration:none;color:black;'>";

    echo "<div class='capacity' style='--color: ".$colors[$move->type]."'>";
    echo "<p class='name-move'>".$move->name."</p>";

    echo "<p class='type' style='--color: ".$colors[$move->type]."; --text: ".$text_colors[$move->type]."'>"
         .$move->type.
         "</p>";

    echo "<p class='damage-type'>".$move->type_damage."</p>";
    echo "</div>"; // .capacity

    echo "<div class='description-container'>";
    echo "<p class='description-moves'><strong>description</strong>: A physical attack in which the user charges and slams into the target with its whole body.</p>";
    echo "<p class='pp'><strong>pp</strong>:12</p>";
    echo "<a href='/who-got/capacity/' class='btn btn-primary mb-10'>who else?</a>";
    echo "</div>"; // .description-container

    echo "</button>";
    echo "</div>"; // .capacity-container
}
?>

@push('scripts')
    @vite(['resources/js/show-moves.js'])
@endpush

@endsection
