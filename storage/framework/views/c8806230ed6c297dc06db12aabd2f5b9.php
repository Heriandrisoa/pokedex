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

<canvas id='stats' width='800' height='800'></canvas>
<table class='table table-hover'>
<tr>
    <td>
        attack
    </td>
    <td>
        <?php echo e($pokemon->attack); ?>

    </td>
</tr>

<tr>
    <td>defense</td>
    <td><?php echo e($pokemon->defense); ?></td>
</tr>


<tr>
    <td>hit points</td>
    <td><?php echo e($pokemon->hit_points); ?></td>
</tr>

<tr>
    <td>special attack</td>
    <td><?php echo e($pokemon->special_attack); ?></td>
</tr>

<tr>
    <td>special defense</td>
    <td><?php echo e($pokemon->special_defense); ?></td>
</tr>

<tr>
    <td>special defense</td>
    <td><?php echo e($pokemon->special_defense); ?></td>
</tr>

<tr>
    <td>speed</td>
    <td><?php echo e($pokemon->speed); ?></td>
</tr>

</table>

<a href="/pokedex/<?php echo e($pokemon->pokedex_number); ?>/compare" class='btn btn-outline-success'>compare</a>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/js/stats.js']); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layout.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/pokedex/resources/views/pokedex/show-stats.blade.php ENDPATH**/ ?>