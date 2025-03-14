<?php require base_path('views/partials/head.php') ?>

<main
  class="container p-4 m-0 d-flex flex-column flex-grow-1 min-vw-100 h-sm-min-dvh align-items-center justify-content-center bg-gradient-sos">
  <div class="sm-flex-grow-1 h-auto h-sm-min-dvh shadow-sm bg-white rounded-4 overflow-hidden align-content-center">
    <form class="shadow-sm rounded-4 overflow-auto h-100 align-content-center"
          method="POST"
          action="<?= urlRedirect("/register") ?>">
      <div class="d-flex flex-column gap-4 bg-white p-5">
        <div class="text-center md-w-50 mx-auto">
          <img src="<?= urlRedirect('/public/assets/img/logoh_sos.png') ?>" alt="logoh_sos" style="max-width: 100%">
        </div>
        <div class="text-center h3">
            <?= $heading ?>
        </div>
        <hr class="my-1">
        <div>
          <label for="name" class="form-label">Nombre completo</label>
          <input id="name"
                 name="name"
                 type="text"
                 autocomplete="name"
                 required
                 class="form-control"
                 placeholder="Jhon Doe"
                 value="<?= old('name') ?>">
        </div>
        <div>
          <label for="username" class="form-label">Usuario de red</label>
          <input id="username"
                 name="username"
                 type="text"
                 autocomplete="username"
                 required
                 class="form-control"
                 placeholder="jdoe"
                 value="<?= old('username') ?>">
        </div>

        <div>
          <label for="email" class="form-label">Correo electrónico</label>
          <input id="email"
                 name="email"
                 type="email"
                 autocomplete="email"
                 required
                 class="form-control"
                 placeholder="jhon.doe@mail.com"
                 value="<?= old('email') ?>">
        </div>

        <div>
          <label for="password" class="form-label">Contraseña</label>
          <input id="password"
                 name="password"
                 type="password"
                 autocomplete="current-password"
                 required
                 class="form-control"
          >
        </div>

        <div>
          <label for="confirmPassword" class="form-label">Confirmar contraseña</label>
          <input id="confirmPassword"
                 name="confirmPassword"
                 type="password"
                 required
                 class="form-control"
          >
        </div>
          
          <?php if (!empty($errors)) : ?>
            <div class="alert alert-warning alert-dismissible fade show m-0" role="alert">
              <ul class="m-0">
                  <?php foreach ($errors as $error) : ?>
                    <li><?= $error ?></li>
                  <?php endforeach; ?>
              </ul>
              <button type="button" class="btn-close" data-bs-dismiss="alert"
                      aria-label="Close">
              </button>
            </div>
          <?php endif; ?>

        <div class="align-self-end md-w-full d-flex flex-column gap-2">
          <button type="submit"
                  class="btn btn-green w-100 justify-content-center d-inline-flex gap-1 justify-center align-items-center rounded-pill shadow-sm center">
            <span class="material-symbols-rounded fs-5 align-content-center">person_add</span>
            Regístrate
          </button>
          <a
            class="text-center link-offset-1 link-offset-2-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover"
            href="<?= urlRedirect('/login') ?>">
            ¿Ya tienes una cuenta? Inicia sesión aquí
          </a>
        </div>
      </div>
    </form>
  </div>
</main>
