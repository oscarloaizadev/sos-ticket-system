<?php

\Core\Session::getUser() === null ? $bodyClass = 'bg-gradient-sos' : $bodyClass = 'bg-dark-subtle';

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SOS Tickets | v.<?= APPLICATION_VERSION ?></title>
  <link rel="icon" href="<?= urlRedirect('/public/assets/img/favicon.png') ?>" type="image/x-icon">

  <!-- Fuentes e iconos -->
  <link rel="preload"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
        as="style" onload="this.onload=null;this.rel='stylesheet'">
  <noscript>
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
  </noscript>
    <?php require('fonts.php') ?>
  <link rel="stylesheet" href="<?= urlRedirect('/public/assets/fonts/VAGRoundedNext/VAGRoundedNext.css') ?>">

  <!-- Librerías de terceros -->
  <link rel="stylesheet" href="<?= urlRedirect('/public/lib/bootstrap/css/bootstrap.css?v=2') ?>">
  <link rel="stylesheet" href="<?= urlRedirect('/public/lib/datatables/css/datatables.min.css') ?>">
  <script src="<?= urlRedirect('/public/lib/jquery/js/jquery-3.7.1.min.js') ?>"></script>
  <script src="<?= urlRedirect('/public/lib/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
  <script src="<?= urlRedirect('/public/lib/datatables/js/datatables.min.js') ?>"></script>

  <script src="<?= urlRedirect('/public/lib/sweetalert2/js/sweetalert2.all.min.js') ?>"></script>
  <link rel="stylesheet" href="<?= urlRedirect('/public/lib/sweetalert2/css/sweetalert2.min.css') ?>">

  <!-- Estilos personalizados -->
  <link rel="stylesheet" href="<?= urlRedirect('/public/assets/css/styles.css?v=8') ?>">

  <!-- Scripts personalizados -->
  <!-- <script src="<?= urlRedirect('/public/assets/js/main.js') ?>"></script> -->

  <!-- include summernote css/js -->
  <link href="<?= urlRedirect('/public/lib/summernote/summernote-bs5.css') ?>" rel="stylesheet">
  <script src="<?= urlRedirect('/public/lib/summernote/summernote-bs5.js') ?>"></script>
</head>

<body class="min-vw-100 min-vh-100 max-vh-100 d-flex flex-column <?= $bodyClass ?>">