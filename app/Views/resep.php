<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">Daftar Resep</h2>
    <form class="d-flex" method="get" action="<?= base_url('/resep') ?>">
      <input class="form-control me-2" type="search" name="q" placeholder="Cari resep (bahan / kategori)..." value="<?= esc($q ?? '') ?>" aria-label="Cari">
      <button class="btn btn-outline-primary" type="submit">Cari</button>
    </form>
  </div>
<?php if (!empty($recipes)): ?>
<div class="row row-cols-1 row-cols-md-3 g-4">
  <?php foreach ($recipes as $r): 
    $title = $r['nama_makanan'] ?? ($r['kategori'] ?? 'Resep');
    $excerpt = substr(strip_tags($r['bahan'] ?? $r['langkah'] ?? ''), 0, 120);

    // ambil gambar dari makanan
    $imgSrc = !empty($r['gambar_makanan'])
        ? 'data:' . ($r['mime_makanan'] ?? 'image/jpeg') . ';base64,' . base64_encode($r['gambar_makanan'])
        : base_url('assets/img/hero/pembuka.jpeg');
  ?>
  <div class="col">
    <div class="card h-100 shadow-sm">
      <img src="<?= esc($imgSrc) ?>" class="card-img-top" alt="<?= esc($title) ?>" style="object-fit:cover; height:180px;">
      <div class="card-body d-flex flex-column">
        <h5 class="card-title"><?= esc($title) ?></h5>
        <p class="card-text text-muted small mb-3"><?= esc($excerpt) ?>...</p>
        <div class="mt-auto">
          <a href="<?= base_url('resep/detail/'.intval($r['id'])) ?>" class="btn btn-sm btn-primary">Lihat Resep</a>
          <?php if(!empty($r['video_url'])): ?>
            <a href="<?= esc($r['video_url']) ?>" target="_blank" class="btn btn-sm btn-outline-secondary ms-2">Video</a>
          <?php endif ?>
        </div>
      </div>
      <div class="card-footer text-muted small">
        Kategori: <?= esc($r['kategori'] ?? '-') ?>
      </div>
    </div>
  </div>
  <?php endforeach; ?>
</div>
<?php else: ?>
<div class="alert alert-info">Belum ada resep sesuai pencarian.</div>
<?php endif; ?>
