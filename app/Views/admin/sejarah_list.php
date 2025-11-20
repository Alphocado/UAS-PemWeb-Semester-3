<div class="container py-3">
  <?php if(session()->getFlashdata('message')): ?>
    <div class="alert alert-success"><?= esc(session()->getFlashdata('message')) ?></div>
  <?php endif; ?>
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Kelola Sejarah</h4>
    <a href="<?= base_url('admin/sejarah/create') ?>" class="btn btn-primary btn-sm">Tambah</a>
  </div>

  <table class="table table-striped">
    <thead><tr><th>#</th><th>Makanan</th><th>Sumber</th><th>Aksi</th></tr></thead>
    <tbody>
      <?php foreach($items as $it): 
        $mid = $it['makanan_id'];
        $mname = $makananMap[$mid]['nama'] ?? $mid;
        $thumb = $makananMap[$mid]['thumb'] ?? base_url('assets/img/placeholder.png');
        ?>
        <tr>
          <td><?= $it['id'] ?></td>
          <td><?= esc($it['makanan_id']) ?></td>
          <td style="width:100px"><img src="<?= $thumb ?>" style="height:60px;width:80px;object-fit:cover;"></td>
          <td><?= esc($mname) ?></td>
          <td><?= esc($it['sumber']) ?></td>
          <td>
            <a href="<?= base_url('admin/sejarah/edit/'.$it['id']) ?>" class="btn btn-sm btn-warning">Edit</a>
            <form action="<?= base_url('admin/sejarah/delete/'.$it['id']) ?>" method="post" style="display:inline" onsubmit="return confirm('Hapus sejarah?')">
              <?= csrf_field() ?><button class="btn btn-sm btn-danger">Hapus</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
