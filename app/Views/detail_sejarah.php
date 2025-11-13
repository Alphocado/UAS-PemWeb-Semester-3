<?php
// app/Views/detail_sejarah.php
// Diharapkan $item = array dari SejarahModel::getById($id)
$imgUrl = base_url('assets/img/hero/pembuka.jpeg');
if (!empty($item['gambar'])) {
    if (preg_match('/\.(jpg|jpeg|png|gif)$/i', $item['gambar'])) {
        $imgUrl = base_url('assets/img/sejarah/' . $item['gambar']);
    } else {
        $imgUrl = base_url('home/imgSejarah/' . intval($item['id']));
    }
} else {
    $imgUrl = base_url('home/imgSejarah/' . intval($item['id']));
}
?>
<div class="py-3">
  <a href="<?= base_url('/sejarah') ?>" class="btn btn-sm btn-outline-secondary mb-3">← Kembali ke Sejarah</a>

  <div class="card shadow-sm">
    <img src="<?= esc($imgUrl) ?>" alt="<?= esc($item['nama_makanan'] ?? 'Sejarah') ?>" class="img-fluid w-100" style="height:320px; object-fit:cover;">
    <div class="card-body">
      <h3 class="card-title"><?= esc($item['nama_makanan'] ?? '-') ?></h3>
      <p class="text-muted small">Sumber: <?= esc($item['sumber'] ?? '-') ?></p>
      <hr>
      <div class="card-text">
        <?= nl2br(esc($item['isi'])) ?>
      </div>
    </div>
  </div>
</div>
