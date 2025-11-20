<div class="container py-3">
  <?php if(session()->getFlashdata('message')): ?>
    <div class="alert alert-success"><?= esc(session()->getFlashdata('message')) ?></div>
  <?php endif; ?>
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Kelola Resep</h4>
    <a href="<?= base_url('admin/resep/create') ?>" class="btn btn-primary btn-sm">Tambah Resep</a>
  </div>

  <table class="table table-striped table-sm align-middle">
  <thead>
    <tr><th>#</th><th>Gambar</th><th>Nama Makanan</th><th>Kategori</th><th>Video</th><th>Aksi</th></tr>
  </thead>
  <tbody>
    <?php foreach($items as $i): 
      $mid = $i['makanan_id'];
      $mname = $makananMap[$mid]['nama'] ?? $mid;
      $thumb = $makananMap[$mid]['thumb'] ?? base_url('assets/img/placeholder.png');
    ?>
    <tr>
      <td><?= $i['id'] ?></td>
      <td style="width:100px"><img src="<?= $thumb ?>" style="height:60px;width:80px;object-fit:cover;"></td>
      <td><?= esc($mname) ?></td>
      <td><?= esc($i['kategori']) ?></td>
      <td><?= esc($i['video_url']) ?></td>
      <td>
          <a href="<?= base_url('admin/resep/edit/'.$i['id']) ?>" class="btn btn-sm btn-warning">Edit</a>
          <form action="<?= base_url('admin/resep/delete/'.$i['id']) ?>" method="post" style="display:inline" onsubmit="return confirm('Hapus resep ini?')">
            <?= csrf_field() ?>
            <button class="btn btn-sm btn-danger">Hapus</button>
          </form>
        </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
</div>
