<div class="container py-3">
  <?php if(session()->getFlashdata('message')): ?>
    <div class="alert alert-success"><?= esc(session()->getFlashdata('message')) ?></div>
  <?php endif; ?>
  <?php if(session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= esc(session()->getFlashdata('error')) ?></div>
  <?php endif; ?>

  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Kelola Makanan (Parent)</h4>
    <a href="<?= base_url('admin/makanan/create') ?>" class="btn btn-primary btn-sm">Tambah Makanan</a>
  </div>

  <table class="table table-striped table-sm align-middle">
    <thead>
      <tr><th>#</th><th>Gambar</th><th>Nama Makanan</th><th>Aksi</th></tr>
    </thead>
    <tbody>
      <?php if (!empty($items)): foreach($items as $it): ?>
        <?php
           $thumb = base_url('assets/img/placeholder.png');
           if (!empty($it['gambar'])) {
               $thumb = 'data:'.$it['mime_type'].';base64,'.base64_encode($it['gambar']);
           }
        ?>
        <tr>
          <td style="width:60px"><?= $it['id'] ?></td>
          <td style="width:100px"><img src="<?= $thumb ?>" style="height:60px; width:80px; object-fit:cover;" class="rounded"></td>
          <td><?= esc($it['nama']) ?></td>
          <td>
            <a href="<?= base_url('admin/makanan/edit/'.$it['id']) ?>" class="btn btn-sm btn-warning">Edit</a>
            <form action="<?= base_url('admin/makanan/delete/'.$it['id']) ?>" method="post" style="display:inline" onsubmit="return confirm('Hapus makanan ini? Semua resep & sejarah terkait akan terhapus (cascade).')">
              <?= csrf_field() ?>
              <button class="btn btn-sm btn-danger">Hapus</button>
            </form>
          </td>
        </tr>
      <?php endforeach; else: ?>
        <tr><td colspan="4" class="text-muted">Belum ada data makanan.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>
