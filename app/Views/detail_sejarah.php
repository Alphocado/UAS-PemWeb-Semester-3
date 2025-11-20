<div class="container py-4">
  <h2 class="mb-4">Sejarah & Filosofi Kuliner Makassar</h2>

  <?php if (empty($list)): ?>
    <div class="alert alert-info">Belum ada konten sejarah yang tersedia.</div>
  <?php else: ?>
    <div class="row g-4">
      <?php foreach($list as $s):
        $excerpt = substr(strip_tags($s['isi'] ?? ''), 0, 180);
        $imgSrc = !empty($s['gambar_makanan']) 
            ? 'data:' . ($s['mime_makanan'] ?? 'image/jpeg') . ';base64,' . base64_encode($s['gambar_makanan'])
            : base_url('assets/img/hero/pembuka.jpeg');
      ?>
      <div class="col-md-6 col-lg-4">
        <div class="card h-100 shadow-sm border-0">
          <img src="<?= esc($imgSrc) ?>" class="card-img-top" style="height:200px; object-fit:cover;" alt="<?= esc($s['nama_makanan'] ?? '-') ?>">
          <div class="card-body">
            <h5 class="card-title"><?= esc($s['nama_makanan'] ?? '-') ?></h5>
            <p class="card-text small text-muted"><?= esc($excerpt) ?>...</p>
          </div>
          <div class="card-footer bg-transparent border-0">
            <a href="<?= base_url('sejarah/'.$s['id']) ?>" class="btn btn-sm btn-primary w-100">Baca Selengkapnya</a>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>
