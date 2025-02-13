<?php use Core\Session; ?>

<nav class="navbar bg-light shadow-sm p-0 text-white">
  <div class="container my-2 my-xl-3 navbar-nav d-flex gap-2 flex-row align-items-center justify-content-between">
    <div class="d-inline-flex gap-1">
      <a class="btn <?= urlIs(urlRedirect("/")) ? 'btn-primary shadow-sm' : 'btn-light' ?> d-inline-flex gap-1"
         href="<?= urlRedirect("/") ?>">
        <span class="material-symbols-rounded fs-5 align-content-center">home</span>
        Inicio
      </a>
      <a class="btn <?= urlIs(urlRedirect("/ticket/new")) ? 'btn-primary shadow-sm' : 'btn-light' ?> d-inline-flex gap-1"
         href="<?= urlRedirect("/ticket/new") ?>">
        <span class="material-symbols-rounded fs-5 align-content-center">add_circle</span>
        Nuevo ticket
      </a>
        <?php if (Session::isUserAdmin()) : ?>
          <a class="btn <?= urlIs(urlRedirect("/admin")) ? 'btn-orange shadow-sm rounded-pill'
              : 'btn-light' ?> d-inline-flex gap-1"
             href="<?= urlRedirect("/admin") ?>">
            <span class="material-symbols-rounded fs-5 align-content-center">admin_panel_settings</span>
            Admin
          </a>
        <?php endif; ?>
    </div>
    <div class="d-inline-flex gap-1">
        <?php if ($_SESSION['user'] ?? false) : ?>
          <form action="<?= urlRedirect("/logout") ?>" method="POST">
            <input type="hidden" name="_method" value="DELETE">
            <button class="btn btn-light d-inline-flex gap-1 align-items-center">
              <span class="material-symbols-rounded fs-5 align-content-center">logout</span>
              Cerrar sesión
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