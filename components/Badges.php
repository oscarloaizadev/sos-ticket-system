<?php
$class = HELPER_getClass('badge', $status);
$text = isset($text) ? $text : (HELPER_getText('status', $status) ? : $status);
?>

<?php if ($class): ?>
  <span class="badge <?= $class ?>"><?= $text ?></span>
<?php endif; ?>
