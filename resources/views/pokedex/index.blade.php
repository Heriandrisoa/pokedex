@extends('layout.app')

@section('content')

@include ('inc.map-colors')
    <h1 class='mt-4 text-center  p-4 shadow-sm'> Welcome to the world of pokemon!</h1>
@include('inc.search-bar')
    @if(count($pokemons) > 0)
        <div class='global-box'>
        @foreach($pokemons as $pokemon)
            @php
                $color1 = $colors[$pokemon->type_1];
                $color2 = $colors[$pokemon->type_2] ?? $color1;
            @endphp

            <a href='/pokedex/{{$pokemon->pokedex_number}}' class='btn'>
            <div class='pokebox' style='--type-1: {{$color1}}; --type-2: {{$color2}}; --color: {{$text_colors[$pokemon->type_1]}}'>
                <p>{{$pokemon->pokemon_name}}</p>

                <img src="{{ asset('sprite/' . $pokemon->pokemon_name . '.gif') }}">
            </div>
        @endforeach
        </div>
    @else
        <p>aucun pokemon a afficher ! </h1>
    @endif
@endsection


@push('scripts')
    @vite(['resources/js/home.js'])
@endpush
