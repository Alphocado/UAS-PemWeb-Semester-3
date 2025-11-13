<?php
// app/Views/detail_resep.php
// Diharapkan $recipe = array dari ResepModel::getById($id)
$imgUrl = base_url('assets/img/hero/pembuka.jpeg'); // default
if (!empty($recipe['gambar'])) {
    // jika kolom gambar menyimpan filename (varchar)
    if (preg_match('/\.(jpg|jpeg|png|gif)$/i', $recipe['gambar'])) {
        $imgUrl = base_url('assets/img/resep/' . $recipe['gambar']);
    } else {
        // jika masih menyimpan blob (unlikely as string), fallback to serve endpoint
        $imgUrl = base_url('home/imgResep/' . intval($recipe['id']));
    }
} else {
    // cek kemungkinan BLOB: kalau ada kolom gambar_blob (atau gambar masih BLOB di DB), gunakan serve endpoint
    $imgUrl = base_url('home/imgResep/' . intval($recipe['id']));
}
?>
<div class="py-3">
  <a href="<?= base_url('/resep') ?>" class="btn btn-sm btn-outline-secondary mb-3">← Kembali ke daftar resep</a>

  <div class="row g-4">
    <div class="col-md-5">
      <div class="card shadow-sm">
        <img src="<?= esc($imgUrl) ?>" alt="Gambar <?= esc($recipe['nama_makanan'] ?? 'Resep') ?>" class="img-fluid" style="object-fit:cover; width:100%; height:320px;">
        <div class="card-body">
          <h4 class="card-title mb-1"><?= esc($recipe['nama_makanan'] ?? 'Resep') ?></h4>
          <p class="text-muted small mb-0">Kategori: <?= esc($recipe['kategori'] ?? '-') ?></p>
        </div>
      </div>
      <?php if (!empty($recipe['video_url'])): ?>
      <div class="mt-3">
        <h6>Video Tutorial</h6>
        <a href="<?= esc($recipe['video_url']) ?>" target="_blank" class="btn btn-sm btn-outline-primary">Tonton di sumber</a>
      </div>
      <?php endif; ?>
    </div>

    <div class="col-md-7">
      <h5>Bahan</h5>
      <div class="card mb-3">
        <div class="card-body">
          <p><?= nl2br(esc($recipe['bahan'] ?? '-')) ?></p>
        </div>
      </div>

      <h5>Langkah / Cara Memasak</h5>
      <div class="card">
        <div class="card-body">
          <p><?= nl2br(esc($recipe['langkah'] ?? '-')) ?></p>
        </div>
      </div>
    </div>
  </div>
</div>
