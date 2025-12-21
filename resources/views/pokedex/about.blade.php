@extends('layout.app')

@section('content')
@include('inc.about-navbar', ['pokeId' => $pokemon->pokedex_number])

<div class="about-container">
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

    <?php
         if($pokemon->legendary)
            echo '<div class="legendary">legendary</div>'
    ?>
</div>
<div class="pokemon-description">
    <h3>description</h3>
    <p>{{$pokemon->description}}</p>
</div>
<div class='info'>
    <p>weight: {{$pokemon->weight}}</p>
    <p> height: {{$pokemon->height}}</p>
    <p>shape: {{$pokemon->shape}}</p>
    <p>egg cycle: {{$pokemon->egg_cycles}}</p>
    <p>egggroup: <?php echo $pokemon->egg_group_1;
        if ($pokemon->egg_group_2 != null)
            echo ', '.$pokemon->egg_group_2;
    ?></p>
    <div class='gender'><?php
            if ($pokemon->genderless )
                echo '<p>this pokemon is genderless</p>';
            else
            {
                echo '<div class="ratio-gender-male">male: '.(1 -$pokemon->female_rate)* 100 .'%</div>';
                echo '<div class="ratio-gender-female">female: '.$pokemon->female_rate * 100 .'%</div>';
            }
    ?></div>
</div>

<div class="evolution-family">
<h3>family</h3>
    <div>
        @if(count($family) == 0)
            <strong>aucune famille d'evolution!</strong>
        @else        
        @foreach($family as $pokemon)
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
        @endif
    </div>
</div>
@endsection
</div>