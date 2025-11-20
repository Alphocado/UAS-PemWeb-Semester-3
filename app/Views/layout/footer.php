</div> <!-- /.container -->

<footer class="py-4 bg-dark text-light">
  <div class="container">
    <p class="text-center small text-secondary mb-0">
      &copy; <?= date('Y') ?> <strong>Website Edukasi Budaya Kuliner</strong> — Universitas Negeri Makassar
    </p>
  </div>
</footer>

<!-- jQuery dan Bootstrap (lokal/offline) -->
<script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>

<!-- Optional: tempat untuk script per-page -->
<?php if (isset($scripts) && is_array($scripts)) : ?>
  <?php foreach ($scripts as $s) : ?>
    <script src="<?= base_url($s) ?>"></script>
  <?php endforeach; ?>
<?php endif; ?>

</body>
</html>
