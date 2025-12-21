@extends('layout.app')

@section('content')
@include('inc.about-navbar', ['pokeId' => $pokemon->pokedex_number])

<div class="d-flex flex-column align-items-center mt-3 p-3">
    <h1>{{$pokemon->pokemon_name}}</h1>
    <img src="{{ asset('sprite/' . $pokemon->pokemon_name . '.gif') }}" width="100" alt="">
    <div class='d-flex align-items-center'>
        <?php
            $color1 = $colors[$pokemon->type_1];
            $color_text1 = $text_colors[$pokemon->type_1];
            $color2 = $colors[$pokemon->type_2]?? 'None';
            $color_text2 = $text_colors[$pokemon->type_2] ?? 'None';
            echo '<div class="typebox m-3" style="--color:'.$color1.';--text-color:'.$color_text1.'">'.$pokemon->type_1.'</div>';
            
            if($color2 != 'None')
                echo '<div class="typebox" style="--color:'.$color2.';--text-color:'.$color_text2.'">'.$pokemon->type_2.'</div>';
        ?>
    </div>

<canvas id='stats'></canvas>
<table class='table table-hover'>
<tr>
    <td>
        attack
    </td>
    <td>
        {{$pokemon->attack}}
    </td>
</tr>

<tr>
    <td>defense</td>
    <td>{{$pokemon->defense}}</td>
</tr>


<tr>
    <td>hit points</td>
    <td>{{$pokemon->hit_points}}</td>
</tr>

<tr>
    <td>special attack</td>
    <td>{{$pokemon->special_attack}}</td>
</tr>

<tr>
    <td>special defense</td>
    <td>{{$pokemon->special_defense}}</td>
</tr>

<tr>
    <td>special defense</td>
    <td>{{$pokemon->special_defense}}</td>
</tr>

<tr>
    <td>speed</td>
    <td>{{$pokemon->speed}}</td>
</tr>

</table>

<a href="/pokedex/{{$pokemon->pokedex_number}}/compare" class='btn btn-outline-success'>compare</a>
@endsection

@push('scripts')
    @vite(['resources/js/stats.js'])
@endpush
