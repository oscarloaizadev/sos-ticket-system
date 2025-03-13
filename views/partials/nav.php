<?php
$ticketTypes = HELPER_getArray('translations', 'type');
$ticketCategories = HELPER_getArray('translations', 'category');
$ticketPriorities = HELPER_getArray('translations', 'priority');
?>

<nav class="navbar p-0 bg-light shadow-sm z-3">
  <div
    class="container px-3 my-2 my-xl-3 navbar-nav d-flex gap-2 flex-row align-items-center justify-content-between">
    <a class="navbar-brand" href="<?= urlRedirect("/") ?>">
      <img src="<?= urlRedirect("/public/assets/img/logoh_sos.png") ?>" alt="Logo" width="120"
           class="d-inline-block align-text-top">
    </a>
    <div class="d-inline-flex gap-1">
        <?php if ($_SESSION['user'] ?? false) : ?>
          <form action="<?= urlRedirect("/logout") ?>" method="POST">
            <input type="hidden" name="_method" value="DELETE">
            <button class="btn btn-light d-inline-flex gap-1 align-items-center">
              <span class="material-symbols-rounded fs-5 align-content-center">logout</span>
            </button>
          </form>
        
        <?php else : ?>
          <a class="btn <?= urlIs(urlRedirect("/login")) ? 'btn-primary shadow-sm'
              : 'btn-light' ?> d-inline-flex gap-1"
             href="<?= urlRedirect("/login") ?>">
            <span class="material-symbols-rounded fs-5 align-content-center">login</span>
            Iniciar sesión
          </a>

          <a class="btn <?= urlIs(urlRedirect("/register")) ? 'btn-primary shadow-sm'
              : 'btn-light' ?> d-inline-flex gap-1"
             href="<?= urlRedirect("/register") ?>">
            <span class="material-symbols-rounded fs-5 align-content-center">person</span>
            Crear una cuenta
          </a>
        <?php endif; ?>
    </div>
  </div>
</nav>
