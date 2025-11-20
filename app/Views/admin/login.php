<?php if(session()->getFlashdata('error')): ?>
  <div class="alert alert-danger text-center"><?= esc(session()->getFlashdata('error')) ?></div>
<?php endif; ?>
<?php if(session()->getFlashdata('message')): ?>
  <div class="alert alert-success text-center"><?= esc(session()->getFlashdata('message')) ?></div>
<?php endif; ?>
<div class="container" style="max-width:420px; margin-top:6vh;">
  <div class="card shadow-sm">
    <div class="card-body p-4">
      <h4 class="mb-3 text-center">Admin Login</h4>

      <?php $errors = session()->getFlashdata('errors') ?? []; ?>
      <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
          <ul class="mb-0 small">
            <?php foreach ($errors as $err): ?>
              <li><?= esc($err) ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>

      <form action="<?= base_url('login') ?>" method="post" autocomplete="off">
        <?= csrf_field() ?>
        <div class="mb-3">
          <label class="form-label">Username</label>
          <input type="text" name="username" class="form-control" value="<?= esc(old('username')) ?>" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Password</label>
          <input type="password" name="password" class="form-control" required>
        </div>

        <div class="d-grid mt-3">
          <button class="btn btn-primary">Masuk</button>
        </div>
      </form>

      <div class="text-center mt-3 small text-muted">
        Login hanya untuk admin. Username dan password disimpan secara aman.
      </div>
    </div>
  </div>
</div>
