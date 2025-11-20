
<div class="container py-4">
  <h2 class="h4 mb-3">Galeri Kuliner Makassar</h2>

  <div class="row">
    <?php if (!empty($items)): ?>
      <?php foreach ($items as $it): ?>
        <?php
          $imgSrc = $it['gambar'] 
            ? 'data:' . $it['mime_type'] . ';base64,' . base64_encode($it['gambar']) 
            : base_url('public/img/placeholder.png');
        ?>
        <div class="col-6 col-md-4 col-lg-3 mb-4">
          <div class="card shadow-sm h-100">
            <img src="<?= $imgSrc ?>" class="card-img-top" alt="<?= esc($it['nama']) ?>" style="object-fit:cover; height:180px;" loading="lazy">
            <div class="card-body py-2 px-2">
              <p class="card-title mb-1 small fw-bold"><?= esc($it['nama']) ?></p>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <div class="col-12">
        <div class="alert alert-secondary">Belum ada foto di galeri.</div>
      </div>
    <?php endif; ?>
  </div>
</div>