<div class="container py-5">
  <div class="text-center mb-5">
    <h1 class="fw-bold"><?= esc($title) ?></h1>
    <p class="text-muted lead"><?= esc($sub) ?></p>
  </div>

  <!-- Ringkasan Proyek -->
  <div class="row mb-5">
    <div class="col-md-8">
      <h4>Ringkasan Proyek</h4>
      <p><?= esc($summary) ?></p>

      <h5 class="mt-4">Visi</h5>
      <p><strong><?= esc($vision) ?></strong></p>

      <h5 class="mt-4">Misi</h5>
      <ul>
        <?php foreach($missions as $m): ?>
          <li><?= esc($m) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>

    <div class="col-md-4">
      <div class="card shadow-sm h-100 border-0">
        <div class="card-body text-center">
          <h6 class="mb-2">Kontak Proyek</h6>
          <p class="small mb-1">Email: <a href="mailto:admin@example.com">admin@example.com</a></p>
          <p class="small mb-1">Alamat: Program PTIK, Universitas Negeri Makassar</p>
          <a href="<?= base_url('kontak') ?>" class="btn btn-outline-primary btn-sm mt-2">Hubungi Kami</a>
        </div>
      </div>
    </div>
  </div>

  <hr>

  <!-- Tim Pengembang -->
  <div class="mb-5">
    <h4 class="mb-4 text-center">Tim Pengembang</h4>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
      <?php foreach ($team as $member): ?>
      <div class="col">
        <div class="card h-100 text-center shadow-sm border-0">
          <img src="<?= esc($member['img']) ?>" class="card-img-top mx-auto mt-3 rounded-circle" style="width:120px; height:120px; object-fit:cover;" alt="<?= esc($member['name']) ?>">
          <div class="card-body">
            <h6 class="card-title mb-0"><?= esc($member['name']) ?></h6>
            <small class="text-muted d-block mb-2"><?= esc($member['role']) ?></small>
            <a href="mailto:<?= esc($member['contact']) ?>" class="small text-primary"><?= esc($member['contact']) ?></a>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>

  <hr>

  <!-- Referensi -->
  <div class="mb-5">
    <h5>Referensi & Sumber</h5>
    <ul>
      <?php foreach ($references as $r): ?>
        <li><a href="<?= esc($r['url']) ?>" target="_blank" rel="noopener"><?= esc($r['title']) ?></a></li>
      <?php endforeach; ?>
    </ul>
  </div>

  <!-- Tombol Aksi -->
  <div class="text-center mt-4">
    <a href="<?= base_url('galeri') ?>" class="btn btn-primary me-2">Lihat Galeri</a>
    <a href="<?= base_url('resep') ?>" class="btn btn-outline-secondary">Jelajahi Resep</a>
  </div>
</div>
