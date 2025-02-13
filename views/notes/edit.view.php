<?php
require base_path('views/partials/head.php');
require base_path('views/partials/nav.php');
?>

<main class="container px-0">
  <div class="mt-5 md:col-span-2 md:mt-0">
    <form class="shadow-sm rounded-4 overflow-hidden" method="POST" action="<?= urlRedirect('/note') ?>">
      <input type="hidden" name="_method" value="PATCH">
      <input type="hidden" name="id" value="<?= $note['id'] ?? '' ?>">
      <div class="d-flex flex-column gap-4 bg-white p-5">
        <div>
          <label for="body" class="form-label fw-bold">Descripción</label>
          <textarea
            class="form-control p-2" rows="3"
            id="body"
            name="body"
            placeholder="Here's an idea for a note..."><?= $note['body'] ?? '' ?></textarea>
        </div>
          <?php
          if (isset($errors['body'])) : ?>
            <div class="alert alert-warning alert-dismissible fade show m-0" role="alert">
              <b><?= $errors['body'] ?></b>
              <button
                class="btn-close"
                type="button"
                data-bs-dismiss="alert"
                aria-label="Close">
              </button>
            </div>
          <?php
          endif; ?>
        <div class="align-self-end">
          <a
            class="btn btn-lavender d-inline-flex gap-1 justify-center align-items-center rounded-pill shadow-sm center"
            href="<?= urlRedirect('/notes') ?>">
                <span
                  class="material-symbols-rounded fs-5 align-content-center">
                   cancel
                </span>
            Cancelar
          </a>
          <button
            class="btn btn-yellow d-inline-flex gap-1 justify-center align-items-center rounded-pill shadow-sm center"
            type="submit">
                <span
                  class="material-symbols-rounded fs-5 align-content-center">
                   save
                </span>
            Actualizar
          </button>
        </div>
      </div>
    </form>
  </div>
</main>

<?php
require base_path('views/partials/footer.php');
?>
