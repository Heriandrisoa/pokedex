<?php $__env->startSection('content'); ?>
<?php echo $__env->make('inc.about-navbar', ['pokeId' => $pokemon1->pokedex_number], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class='container d-flex flex-column align-items-center mt-3 p-3d-flex flex-column align-items-center mt-3 p-3'>
    <div class="d-flex flex-row align-items-center mt-3 p-3">
        <div class="d-flex flex-column align-items-center mt-3 p-3d-flex flex-column align-items-center mt-3 p-3">
            <h1 id='poke1-name'><?php echo e($pokemon1->pokemon_name); ?></h1>
            <img src="<?php echo e(asset('sprite/' . $pokemon1->pokemon_name . '.gif')); ?>" width="100" alt="">
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
            <h1 id='poke2-name'><?php echo e($pokemon2->pokemon_name); ?></h1>
            <img src="<?php echo e(asset('sprite/' . $pokemon2->pokemon_name . '.gif')); ?>" width="100" alt="">
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

    <canvas id='stats' width='800' height='800' class='mb-5'></canvas>
    
    <h3> stats of <?php echo e($pokemon1->pokemon_name); ?></h3>
    <table class='table table-hover' id='poke1'>
    <tr>
        <td>
            attack
        </td>
        <td>
            <?php echo e($pokemon1->attack); ?>

        </td>
    </tr>

    <tr>
        <td>defense</td>
        <td><?php echo e($pokemon1->defense); ?></td>
    </tr>


    <tr>
        <td>hit points</td>
        <td><?php echo e($pokemon1->hit_points); ?></td>
    </tr>

    <tr>
        <td>special attack</td>
        <td><?php echo e($pokemon1->special_attack); ?></td>
    </tr>

    <tr>
        <td>special defense</td>
        <td><?php echo e($pokemon1->special_defense); ?></td>
    </tr>

    <tr>
        <td>special defense</td>
        <td><?php echo e($pokemon1->special_defense); ?></td>
    </tr>

    <tr>
        <td>speed</td>
        <td><?php echo e($pokemon1->speed); ?></td>
    </tr>

    </table>

    <h3> stats of <?php echo e($pokemon2->pokemon_name); ?></h3>

    <table class='table table-hover' id='poke2'>
    <tr>
        <td>
            attack
        </td>
        <td>
            <?php echo e($pokemon2->attack); ?>

        </td>
    </tr>

    <tr>
        <td>defense</td>
        <td><?php echo e($pokemon2->defense); ?></td>
    </tr>


    <tr>
        <td>hit points</td>
        <td><?php echo e($pokemon2->hit_points); ?></td>
    </tr>

    <tr>
        <td>special attack</td>
        <td><?php echo e($pokemon2->special_attack); ?></td>
    </tr>

    <tr>
        <td>special defense</td>
        <td><?php echo e($pokemon2->special_defense); ?></td>
    </tr>

    <tr>
        <td>special defense</td>
        <td><?php echo e($pokemon2->special_defense); ?></td>
    </tr>

    <tr>
        <td>speed</td>
        <td><?php echo e($pokemon2->speed); ?></td>
    </tr>

    </table>

    <?php $__env->stopSection(); ?>

    <?php $__env->startPush('scripts'); ?>
        <?php echo app('Illuminate\Foundation\Vite')(['resources/js/compare.js']); ?>
    <?php $__env->stopPush(); ?>

</div>
<?php echo $__env->make('layout.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/pokedex/resources/views/pokedex/compare.blade.php ENDPATH**/ ?>