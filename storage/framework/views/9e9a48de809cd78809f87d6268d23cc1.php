<?php $__env->startSection('content'); ?>
<?php echo $__env->make('inc.about-navbar', ['pokeId' => $pokemon->pokedex_number], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="d-flex flex-column align-items-center mt-3 p-3">
    <h1><?php echo e($pokemon->pokemon_name); ?></h1>
    <img src="<?php echo e(asset('sprite/' . $pokemon->pokemon_name . '.gif')); ?>" width="100" alt="">
</div>
<?php echo $__env->make('inc.search-bar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php
foreach ($moves as $move) {
    echo "<div class='capacity-container'>";

    echo "<button type='button' class='capacity-link' style='text-decoration:none;color:black;'>";

    echo "<div class='capacity' style='--color: ".$colors[$move->type]."'>";
    echo "<p class='name-move'>".$move->name."</p>";

    echo "<p class='type' style='--color: ".$colors[$move->type]."; --text: ".$text_colors[$move->type]."'>"
         .$move->type.
         "</p>";

    echo "<p class='damage-type'>".$move->type_damage."</p>";
    echo "</div>"; // .capacity

    echo "<div class='description-container'>";
    echo "<p class='description-moves'><strong>description</strong>: A physical attack in which the user charges and slams into the target with its whole body.</p>";
    echo "<p class='pp'><strong>pp</strong>:12</p>";
    echo "<a href='/who-got/capacity/' class='btn btn-primary mb-10'>who else?</a>";
    echo "</div>"; // .description-container

    echo "</button>";
    echo "</div>"; // .capacity-container
}
?>

<?php $__env->startPush('scripts'); ?>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/js/show-moves.js']); ?>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/pokedex/resources/views/pokedex/pokemon-moves.blade.php ENDPATH**/ ?>