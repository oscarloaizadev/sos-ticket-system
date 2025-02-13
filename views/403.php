<?php $heading = 'Error 403 | Sin autorización'; ?>

<?php require('partials/head.php') ?>
<?php require('partials/nav.php') ?>

<main class="container px-0 my-4">
    <div class="alert alert-danger" role="alert">
        No estás autorizado para ver esta nota.
    </div>
    <a href="<?= urlRedirect('/notes') ?>"
       class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">
        Volver a todas la notas
    </a>
</main>

<?php require('partials/footer.php') ?>
