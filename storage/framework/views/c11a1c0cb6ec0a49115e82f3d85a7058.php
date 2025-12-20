<?php $__env->startSection('content'); ?>

<?php echo $__env->make('inc.map-colors', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
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
    <?php if(count($pokemons) > 0): ?>
        <div class='global-box'>
        <?php $__currentLoopData = $pokemons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pokemon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $color1 = $colors[$pokemon->type_1];
                $color2 = $colors[$pokemon->type_2] ?? $color1;
            ?>

            <a href='/pokedex/<?php echo e($pokemon->pokedex_number); ?>' class='btn'>
            <div class='pokebox' style='--type-1: <?php echo e($color1); ?>; --type-2: <?php echo e($color2); ?>; --color: <?php echo e($text_colors[$pokemon->type_1]); ?>'>
                <p><?php echo e($pokemon->pokemon_name); ?></p>
                <img src="<?php echo e(asset('sprite/' . $pokemon->pokemon_name . '.gif')); ?>">
                <p class='type1' style='display: none;'> <?php echo e($pokemon->type_1); ?></p>
                <p class='type2' style='display: none;'> <?php echo e($pokemon->type_2); ?></p>

            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php else: ?>
        <p>aucun pokemon a afficher ! </h1>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/js/filter.js']); ?>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layout.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/pokedex/resources/views/pokedex/filter-index.blade.php ENDPATH**/ ?>