<?php
$imgSrc = !empty($recipe['gambar_makanan'])
    ? 'data:' . ($recipe['mime_makanan'] ?? 'image/jpeg') . ';base64,' . base64_encode($recipe['gambar_makanan'])
    : base_url('assets/img/hero/pembuka.jpeg');
?>
<div class="container py-4">
  <a href="<?= base_url('/resep') ?>" class="btn btn-sm btn-outline-secondary mb-3">← Kembali ke Resep</a>

  <div class="card shadow-sm border-0">
    <img src="<?= esc($imgSrc) ?>" alt="<?= esc($recipe['nama_makanan'] ?? '-') ?>" class="card-img-top" style="height:350px; object-fit:cover;">
    <div class="card-body">
      <h2 class="card-title mb-2"><?= esc($recipe['nama_makanan'] ?? '-') ?></h2>
      <p class="text-muted small mb-3">Kategori: <?= esc($recipe['kategori'] ?? '-') ?></p>
      <hr>
      <h5>Bahan:</h5>
      <p><?= nl2br(esc($recipe['bahan'])) ?></p>
      <h5>Langkah:</h5>
      <p><?= nl2br(esc($recipe['langkah'])) ?></p>
      <?php if(!empty($recipe['video_url'])): ?>
        <hr>
        <a href="<?= esc($recipe['video_url']) ?>" target="_blank" class="btn btn-outline-primary">Tonton Video</a>
      <?php endif ?>
    </div>
  </div>
</div>
