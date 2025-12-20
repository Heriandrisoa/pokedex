<?php $__env->startSection('content'); ?>

<?php echo $__env->make('inc.map-colors', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <h1 class='mt-4 text-center  p-4 shadow-sm'> Welcome to the world of pokemon!</h1>
<?php echo $__env->make('inc.search-bar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
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
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php else: ?>
        <p>aucun pokemon a afficher ! </h1>
    <?php endif; ?>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('scripts'); ?>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/js/home.js']); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layout.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/pokedex/resources/views/pokedex/index.blade.php ENDPATH**/ ?>