<div class="container py-3">
  <h4><?= isset($item) ? 'Edit Makanan' : 'Tambah Makanan' ?></h4>

  <?php $errors = session()->getFlashdata('errors') ?? []; if(!empty($errors)): ?>
    <div class="alert alert-danger"><ul class="mb-0">
      <?php foreach($errors as $e): ?><li><?= esc($e) ?></li><?php endforeach; ?>
    </ul></div>
  <?php endif; ?>

  <?php if(session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= esc(session()->getFlashdata('error')) ?></div>
  <?php endif; ?>

  <form action="<?= isset($item) ? base_url('admin/makanan/update/'.$item['id']) : base_url('admin/makanan/store') ?>" method="post" enctype="multipart/form-data">
    <?= csrf_field() ?>
    <div class="mb-3">
      <label class="form-label">Nama Makanan</label>
      <input type="text" name="nama" class="form-control" value="<?= old('nama', $item['nama'] ?? '') ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Gambar (opsional) — JPG/PNG/GIF, maks 3MB</label>
      <input type="file" name="gambar" class="form-control" accept="image/*">
      <?php if(isset($item) && !empty($item['gambar'])): 
          $imgData = 'data:'.esc($item['mime_type']).';base64,'.base64_encode($item['gambar']);
      ?>
        <div class="mt-2">
          <img src="<?= $imgData ?>" style="max-height:160px; object-fit:cover;" class="img-thumbnail">
        </div>
      <?php endif; ?>
    </div>

    <div class="d-flex gap-2">
      <button class="btn btn-primary"><?= isset($item) ? 'Update' : 'Simpan' ?></button>
      <a href="<?= base_url('admin/makanan') ?>" class="btn btn-secondary">Batal</a>
    </div>
  </form>
</div>
