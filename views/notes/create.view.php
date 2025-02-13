<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>

<main class="container px-0">
  <div class="py-6 mt-5">
    <form class="shadow-sm rounded-4 overflow-hidden"
          method="POST"
          action="<?= urlRedirect('/notes') ?>">
      <div class="d-flex flex-column gap-4 bg-white p-5">
        <div>
          <label for="body" class="form-label fw-bold">Descripción</label>
          <textarea class="form-control p-2" id="body" name="body"
                    rows="3"
                    placeholder="Here's an idea for a note..."><?= $_POST['body'] ?? '' ?></textarea>
        </div>
          <?php if (isset($errors['body'])) : ?>
            <div class="alert alert-warning alert-dismissible fade show m-0" role="alert">
              <b><?= $errors['body'] ?></b>
              <button type="button" class="btn-close" data-bs-dismiss="alert"
                      aria-label="Close">
              </button>
            </div>
          <?php endif; ?>
        <div class="align-self-end">
          <button type="submit"
                  class="btn btn-yellow d-inline-flex gap-1 justify-center align-items-center rounded-pill shadow-sm center">
            <span class="material-symbols-rounded fs-5 align-content-center">save</span>
            Guardar nota
          </button>
        </div>
      </div>
    </form>
  </div>
</main>

<?php require base_path('views/partials/footer.php') ?>
