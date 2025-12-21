<nav class="navbar navbar-expand-lg custom-navbar mt-3">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav-about" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse  justify-content-center" id="navbarNav-about">
      <ul class="navbar-nav">
        <li class="nav-item general">
          <a class="nav-link active" aria-current="page" href="#">general</a>
        </li>
        <li class="nav-item moves">
          <a class="nav-link" href="/pokedex/<?php echo e($pokeId); ?>/moves">moves</a>
        </li>
        <li class="nav-item stats">
          <a class="nav-link" href="/pokedex/<?php echo e($pokeId); ?>/stats">stats</a>
        </li>
      </ul>
    </div>
  </div>
</nav><?php /**PATH /var/www/html/pokedex/resources/views/inc/about-navbar.blade.php ENDPATH**/ ?>