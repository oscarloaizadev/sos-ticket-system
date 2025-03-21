<?php
require base_path('views/partials/head.php');
require base_path('views/partials/nav.php');
?>

<main class="container px-0 my-4">
    <?php if (is_array($notes) && !empty($notes)) : ?>
      <ul>
          <?php foreach ($notes as $note) : ?>
            <li>
              <a href="<?= urlRedirect('/note?id=' . $note['id']) ?>"
                 class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">
                  <?= $note['body'] ?>
              </a>
            </li>
          <?php endforeach; ?>
      </ul>
    <?php else : ?>
      <p>No tienes notas aún. Intenta crear una nueva aquí abajo.</p>
    <?php endif; ?>

  <p class="mt-6">
    <a href="<?= urlRedirect('/notes/create'); ?>"
       class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">Create
      Note</a>
  </p>
</main>

<?php
require base_path('views/partials/footer.php');
?>
