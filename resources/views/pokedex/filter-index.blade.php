@extends('layout.app')

@section('content')

@include ('inc.map-colors')
    <h1 class='mt-4 text-center  p-4 shadow-sm'>what are we looking for?</h1>

    <label for='type1'>primary type:</label>
    <select id = 'type1'>
        <option value='none' selected>none</option>
        <?php 
            foreach($colors as $type=>$color)
            {
                echo '<option value = '.$type.'>'.$type.'</option>';
            }
        ?>
    </select>

    <label for='type2'>second type:</label>
    <select id = 'type2'>
        <option value='none' selected>none</option>
        <?php 
            foreach($colors as $type=>$color)
            {
                echo '<option value = '.$type.'>'.$type.'</option>';
            }
        ?>
    </select>

    <label for='operator'>operator:</label>
    <select id='operator'>
        <option value='or' selected>or</option>
        <option value='and'>and</option>
    </select>
    <div class='order-by'>
        <h5 class='mt-4'> order by: </h5>
    <?php
        $stats = ['attack', 'defense', 'special_defense', 'special_attack', 'speed', 'hit_points'];
        foreach($stats as $stat)
        {
            echo "<label for=".$stat.">".$stat."</label>";
            echo "<input type='checkbox' name='stat' class='m-4' value= ".$stat.">";
        }
    ?>
    </div>
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
                <p class='type1' style='display: none;'> {{$pokemon->type_1}}</p>
                <p class='type2' style='display: none;'> {{$pokemon->type_2}}</p>

            </div>
        @endforeach
        </div>
    @else
        <p>aucun pokemon a afficher ! </h1>
    @endif
@endsection

@push('scripts')
    @vite(['resources/js/filter.js'])
@endpush