<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Dashboard Admin</h3>
    <div>
      <span class="me-3 small text-muted">Halo, <?= esc($admin_name) ?></span>
      <a href="<?= base_url('logout') ?>" class="btn btn-outline-secondary btn-sm">Logout</a>
    </div>
  </div>

  <div class="row g-3">
    <div class="col-md-4">
      <div class="card p-3">
        <h6>Total Resep</h6>
        <p class="display-6 mb-0"><?= $total_resep ?></p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card p-3">
        <h6>Total Sejarah</h6>
        <p class="display-6 mb-0"><?= $total_sejarah ?></p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card p-3">
        <h6>Total Makanan</h6>
        <p class="display-6 mb-0"><?= $total_makanan ?></p>
      </div>
    </div>
  </div>

  <div class="mt-4">
    <p class="small text-muted">Tautan cepat: <a href="<?= base_url('admin/resep') ?>">Kelola Resep</a> | <a href="<?= base_url('admin/sejarah') ?>">Kelola Sejarah</a> | <a href="<?= base_url('admin/makanan') ?>">Kelola Makanan</a></p> 
  </div>
</div>
