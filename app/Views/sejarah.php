<?php
// app/Views/sejarah.php
?>

<div class="py-3">
  <h2 class="mb-3">Sejarah & Filosofi Kuliner</h2>

  <?php if (empty($list)): ?>
    <div class="alert alert-info">Belum ada konten sejarah yang tersedia.</div>
  <?php else: ?>
    <div class="list-group">
      <?php foreach($list as $s):
        // fields: id, makanan_id, isi, gambar, sumber, nama_makanan
        $excerpt = substr(strip_tags($s['isi'] ?? ''), 0, 220);
        $img = !empty($s['gambar']) ? base_url('assets/img/sejarah/'.$s['gambar']) : base_url('assets/img/hero/pembuka.jpeg');
      ?>
      <a href="<?= base_url('sejarah/detail/'.intval($s['id'])) ?>" class="list-group-item list-group-item-action mb-3 shadow-sm">
        <div class="row g-3">
          <div class="col-md-3">
            <img src="<?= esc($img) ?>" alt="<?= esc($s['nama_makanan'] ?? 'Gambar') ?>" class="img-fluid rounded" style="height:130px; object-fit:cover;">
          </div>
          <div class="col-md-9">
            <h5 class="mb-1"><?= esc($s['nama_makanan'] ?? '—') ?></h5>
            <p class="mb-1 text-muted small"><?= esc($excerpt) ?>...</p>
            <small class="text-secondary">Sumber: <?= esc($s['sumber'] ?? '—') ?></small>
          </div>
        </div>
      </a>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>
