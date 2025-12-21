@extends('layout.app')

@section('content')
@include('inc.about-navbar', ['pokeId' => $pokemon1->pokedex_number])

<div class='container d-flex flex-column align-items-center mt-3 p-3d-flex flex-column align-items-center mt-3 p-3'>
    <div class="d-flex flex-row align-items-center mt-3 p-3">
        <div class="d-flex flex-column align-items-center mt-3 p-3d-flex flex-column align-items-center mt-3 p-3">
            <h1 id='poke1-name'>{{$pokemon1->pokemon_name}}</h1>
            <img src="{{ asset('sprite/' . $pokemon1->pokemon_name . '.gif') }}" width="100" alt="">
            <div class='d-flex align-items-center'>
                <?php
                    $color1 = $colors[$pokemon1->type_1];
                    $color_text1 = $text_colors[$pokemon1->type_1];
                    $color2 = $colors[$pokemon1->type_2]?? 'None';
                    $color_text2 = $text_colors[$pokemon1->type_2] ?? 'None';
                    echo '<div class="typebox m-3" style="--color:'.$color1.';--text-color:'.$color_text1.'">'.$pokemon1->type_1.'</div>';
                    
                    if($color2 != 'None')
                        echo '<div class="typebox" style="--color:'.$color2.';--text-color:'.$color_text2.'">'.$pokemon1->type_2.'</div>';
                ?>
            </div>
        </div>
            <h3>VS</h3>
        <div class='d-flex flex-column align-items-center mt-3 p-3'>
            <h1 id='poke2-name'>{{$pokemon2->pokemon_name}}</h1>
            <img src="{{ asset('sprite/' . $pokemon2->pokemon_name . '.gif') }}" width="100" alt="">
            <div class='d-flex align-items-center'>
                <?php
                    $color1 = $colors[$pokemon2->type_1];
                    $color_text1 = $text_colors[$pokemon2->type_1];
                    $color2 = $colors[$pokemon2->type_2]?? 'None';
                    $color_text2 = $text_colors[$pokemon2->type_2] ?? 'None';
                    echo '<div class="typebox m-3" style="--color:'.$color1.';--text-color:'.$color_text1.'">'.$pokemon2->type_1.'</div>';
                    
                    if($color2 != 'None')
                        echo '<div class="typebox" style="--color:'.$color2.';--text-color:'.$color_text2.'">'.$pokemon2->type_2.'</div>';
                ?>
            </div>
        </div>
    </div>

    <canvas id='stats' class='mb-5'></canvas>
    
    <h3> stats of {{$pokemon1->pokemon_name}}</h3>
    <table class='table table-hover' id='poke1'>
    <tr>
        <td>
            attack
        </td>
        <td>
            {{$pokemon1->attack}}
        </td>
    </tr>

    <tr>
        <td>defense</td>
        <td>{{$pokemon1->defense}}</td>
    </tr>


    <tr>
        <td>hit points</td>
        <td>{{$pokemon1->hit_points}}</td>
    </tr>

    <tr>
        <td>special attack</td>
        <td>{{$pokemon1->special_attack}}</td>
    </tr>

    <tr>
        <td>special defense</td>
        <td>{{$pokemon1->special_defense}}</td>
    </tr>

    <tr>
        <td>special defense</td>
        <td>{{$pokemon1->special_defense}}</td>
    </tr>

    <tr>
        <td>speed</td>
        <td>{{$pokemon1->speed}}</td>
    </tr>

    </table>

    <h3> stats of {{$pokemon2->pokemon_name}}</h3>

    <table class='table table-hover' id='poke2'>
    <tr>
        <td>
            attack
        </td>
        <td>
            {{$pokemon2->attack}}
        </td>
    </tr>

    <tr>
        <td>defense</td>
        <td>{{$pokemon2->defense}}</td>
    </tr>


    <tr>
        <td>hit points</td>
        <td>{{$pokemon2->hit_points}}</td>
    </tr>

    <tr>
        <td>special attack</td>
        <td>{{$pokemon2->special_attack}}</td>
    </tr>

    <tr>
        <td>special defense</td>
        <td>{{$pokemon2->special_defense}}</td>
    </tr>

    <tr>
        <td>special defense</td>
        <td>{{$pokemon2->special_defense}}</td>
    </tr>

    <tr>
        <td>speed</td>
        <td>{{$pokemon2->speed}}</td>
    </tr>

    </table>

    @endsection

    @push('scripts')
        @vite(['resources/js/compare.js'])
    @endpush

</div>