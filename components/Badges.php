<?php
include('shared/Badges.variables.php');
include('shared/Translations.variables.php');

$class = $statusColors[$status] ?? false;
?>

<?php if ($class): ?>
  <span class="badge <?= $class ?> text-dark align-content-center text-center">
        <?= $statusTranslations[$status] ?? 'Desconocido' ?>
    </span>
<?php endif; ?>
