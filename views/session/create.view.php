<?php require base_path('views/partials/head.php') ?>

  <main
    class="container p-4 p-md-0 m-0 d-flex flex-column flex-grow-1 min-vw-100 h-sm-min-dvh align-items-center justify-content-center">
    <div class="sm-flex-grow-1 h-100 shadow-sm bg-white rounded-4 overflow-hidden align-content-center">
      <form class="shadow-sm rounded-4 overflow-hidden"
            method="POST"
            action="<?= urlRedirect("/login") ?>">
        <div class="d-flex flex-column gap-4 p-5">
          <div class="text-center md-w-50 mx-auto">
            <img src="<?= urlRedirect('/public/assets/img/logoh_sos.png') ?>" alt="logoh_sos" style="max-width: 100%">
          </div>
          <div class="text-center h3">
              <?= $heading ?>
          </div>
          <hr class="my-1">
          <div>
            <label for="username" class="form-label">Ingresa tu correo electrónico o usuario de red</label>
            <input id="username"
                   name="username"
                   type="text"
                   autocomplete="username"
                   required
                   class="form-control"
                   placeholder="jdoe@miempresa.com o jdoe"
                   value="<?= old('username') ?>">
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
            
            <?php if (!empty($errors)) : ?>
              <div>
                  <?php if (isset($errors['username'])) : ?>
                    <div class="alert alert-warning alert-dismissible fade show m-0" role="alert">
                      <b><?= $errors['username'] ?></b>
                      <button type="button" class="btn-close" data-bs-dismiss="alert"
                              aria-label="Close">
                      </button>
                    </div>
                  <?php endif; ?>
                  
                  <?php if (isset($errors['password'])) : ?>
                    <div class="alert alert-warning alert-dismissible fade show m-0" role="alert">
                      <b><?= $errors['password'] ?></b>
                      <button type="button" class="btn-close" data-bs-dismiss="alert"
                              aria-label="Close">
                      </button>
                    </div>
                  <?php endif; ?>
              </div>
            <?php endif; ?>

          <div class="align-self-end md-w-full d-flex flex-column gap-2">
            <button type="submit"
                    class="btn btn-lavender w-100 justify-content-center d-inline-flex gap-1 justify-center align-items-center rounded-pill shadow-sm center">
              <span class="material-symbols-rounded fs-5 align-content-center">passkey</span>
              Iniciar sesión
            </button>
            <a class="text-center link-offset-1 link-offset-2-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="<?= urlRedirect('/register') ?>">
              ¿No tienes una cuenta? Regístrate aquí
            </a>
          </div>
        </div>
      </form>
    </div>
  </main>

<?php require base_path('views/partials/footer.php') ?>