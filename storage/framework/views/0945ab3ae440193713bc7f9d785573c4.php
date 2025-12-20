<?php $__env->startSection('content'); ?>
<?php echo $__env->make('inc.about-navbar', ['pokeId' => $pokemon->pokedex_number], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="d-flex flex-column align-items-center mt-3 p-3">
    <h1><?php echo e($pokemon->pokemon_name); ?></h1>
    <img src="<?php echo e(asset('sprite/' . $pokemon->pokemon_name . '.gif')); ?>" width="100" alt="">
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
<div>
    <p><?php echo e($pokemon->description); ?></p>
</div>
<div class='info'>
    <p>weight: <?php echo e($pokemon->weight); ?></p>
    <p> height: <?php echo e($pokemon->height); ?></p>
    <p>shape: <?php echo e($pokemon->shape); ?></p>
    <p>egg cycle: <?php echo e($pokemon->egg_cycles); ?></p>
    <p>egggroup: <?php echo $pokemon->egg_group_1;
        if ($pokemon->egg_group_2 != null)
            echo ', '.$pokemon->egg_group_2;
    ?></p>
    <div class='gender'><?php
            if ($pokemon->genderless )
                echo '<p>this pokemon is genderless</p>';
            else
            {
                echo '<div class="ratio-gender-male">male: '.(1 -$pokemon->female_rate)* 100 .'</div>';
                echo '<div class="ratio-gender-female">female: '.$pokemon->female_rate * 100 .'%</div>';
        
            }
    ?></div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/pokedex/resources/views/pokedex/about.blade.php ENDPATH**/ ?>