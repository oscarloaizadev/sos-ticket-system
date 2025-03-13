<?php if ($history['user_id'] == $user['id']): ?>
  <!-- Mensaje propio -->
  <div class="text-end" style="justify-items: right">
    <div class="d-flex flex-column justify-content-start lh-sm w-auto" style="max-width: 75%">
      <div class="bg-primary-subtle rounded px-3 pt-1 pb-2 position-relative">
        <small class="text-muted"><?= $history['created_by'] ?>
          <span class="badge bg-white text-muted" style="padding: 2px 4px">yo</span>
        </small>
        <div><?= $history['message'] ?></div>
      </div>
      <small class="text-muted ps-3 mt-1"><?= formatDate($history['created_at']) ?></small>
    </div>
  </div>

<?php else: ?>
  <!-- Mensaje de otro usuario -->
  <div>
    <div class="d-flex flex-column justify-content-start lh-sm w-auto" style="max-width: 75%">
      <div class="bg-dark-subtle text-dark rounded px-3 pt-1 pb-2 position-relative">
        <small class="text-muted"><?= $history['created_by'] ?></small>
        <div><?= $history['message'] ?></div>
      </div>
      <small class="text-muted ps-3 mt-1"><?= formatDate($history['created_at']) ?></small>
    </div>
  </div>
<?php endif; ?>