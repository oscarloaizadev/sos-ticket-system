<?php
require base_path('views/partials/head.php');
require base_path('views/partials/nav.php');
?>

<main class="container px-0 my-4">
  <p class="mb-6">
    <a href="<?= urlRedirect('/notes') ?>"
       class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">
      Volver a todas la notas
    </a>
  </p>

  <p><?= htmlspecialchars($note['body']) ?></p>

  <footer class="mt-6 d-flex flex-row gap-2">
    <a href="<?= urlRedirect('/note/edit?id=' . $note['id']) ?>"
       class="btn btn-yellow shadow-sm rounded-pill d-inline-flex align-items-center gap-1">
      <span
        class="material-symbols-rounded fs-5 align-content-center">edit_note</span>
      Editar nota
    </a>
    <form method="POST">
      <input type="hidden" name="_method" value="DELETE">
      <input type="hidden" name="id" value="<?= $note['id'] ?>">
      <button
        class="btn btn-danger shadow-sm rounded-pill d-inline-flex align-items-center gap-1">
              <span
                class="material-symbols-rounded fs-5 align-content-center">delete</span>
        Eliminar nota
      </button>
    </form>
  </footer>
</main>

<?php
require base_path('views/partials/footer.php');
?>
