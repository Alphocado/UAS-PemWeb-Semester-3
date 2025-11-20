<div class="container py-3">
  <h4><?= isset($item) ? 'Edit Sejarah' : 'Tambah Sejarah' ?></h4>

  <?php $errors = session()->getFlashdata('errors') ?? []; if(!empty($errors)): ?>
    <div class="alert alert-danger"><ul><?php foreach($errors as $e): ?><li><?= esc($e) ?></li><?php endforeach; ?></ul></div>
  <?php endif; ?>

  <form action="<?= isset($item) ? base_url('admin/sejarah/update/'.$item['id']) : base_url('admin/sejarah/store') ?>" method="post">
    <?= csrf_field() ?>
    <div class="mb-3">
      <label class="form-label">Pilih Makanan</label>
      <select name="makanan_id" class="form-select" required>
        <option value="">-- Pilih --</option>
        <?php foreach($makanan as $m): ?>
          <option value="<?= $m['id'] ?>" <?= isset($item) && $item['makanan_id']==$m['id'] ? 'selected' : '' ?>><?= esc($m['nama']) ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="mb-3">
      <label class="form-label">Isi Sejarah</label>
      <textarea name="isi" class="form-control" rows="6" required><?= old('isi', $item['isi'] ?? '') ?></textarea>
    </div>
    <div class="mb-3">
      <label class="form-label">Sumber (link)</label>
      <input type="text" name="sumber" class="form-control" value="<?= old('sumber', $item['sumber'] ?? '') ?>">
    </div>
    <button class="btn btn-primary"><?= isset($item) ? 'Update' : 'Simpan' ?></button>
  </form>
</div>
