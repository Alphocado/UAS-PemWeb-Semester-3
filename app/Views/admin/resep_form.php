<div class="container py-3">
  <h4><?= isset($item) ? 'Edit Resep' : 'Tambah Resep' ?></h4>

  <?php $errors = session()->getFlashdata('errors') ?? []; ?>
  <?php if(!empty($errors)): ?>
    <div class="alert alert-danger"><ul class="mb-0">
      <?php foreach($errors as $e): ?><li><?= esc($e) ?></li><?php endforeach; ?>
    </ul></div>
  <?php endif; ?>

  <form action="<?= isset($item) ? base_url('admin/resep/update/'.$item['id']) : base_url('admin/resep/store') ?>" method="post">
    <?= csrf_field() ?>
    <div class="mb-3">
      <label class="form-label">Pilih Makanan (relasi)</label>
      <select name="makanan_id" class="form-select" required>
        <option value="">-- Pilih --</option>
        <?php foreach($makanan as $m): ?>
          <option value="<?= $m['id'] ?>" <?= isset($item) && $item['makanan_id']==$m['id'] ? 'selected' : '' ?>><?= esc($m['nama']) ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Bahan</label>
      <textarea name="bahan" class="form-control" rows="3"><?= old('bahan', $item['bahan'] ?? '') ?></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">Langkah</label>
      <textarea name="langkah" class="form-control" rows="5"><?= old('langkah', $item['langkah'] ?? '') ?></textarea>
    </div>

    <div class="mb-3 row">
      <div class="col-md-6">
        <label class="form-label">Kategori</label>
        <input type="text" name="kategori" class="form-control" value="<?= old('kategori', $item['kategori'] ?? '') ?>">
      </div>
      <div class="col-md-6">
        <label class="form-label">Video URL (opsional)</label>
        <input type="text" name="video_url" class="form-control" value="<?= old('video_url', $item['video_url'] ?? '') ?>">
      </div>
    </div>

    <button class="btn btn-primary"><?= isset($item) ? 'Update' : 'Simpan' ?></button>
  </form>
</div>
