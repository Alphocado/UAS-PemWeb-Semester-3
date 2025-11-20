<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Escape title to avoid XSS (CodeIgniter esc() helper) -->
  <title><?= esc($title ?? 'Aplikasi UAS PTIK') ?></title>

  <!-- Favicon (opsional) -->
  <link rel="icon" href="<?= base_url('favicon.ico') ?>">

  <!-- Styles -->
  <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">

  <!-- Optional: basic meta for SEO -->
  <meta name="description" content="<?= esc($meta_description ?? 'Website Edukasi Budaya Kuliner - Universitas Negeri Makassar') ?>">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4" aria-label="Main navigation">
  <div class="container">
    <a class="navbar-brand" href="<?= base_url('/') ?>">UAS PTIK</a>

    <!-- Navbar toggler for mobile -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
            aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="mainNavbar">
      <?php
        // Determine current URI for active link (CodeIgniter helper uri_string())
        $uri = uri_string();
        // helper function to check active
        function is_active($segment) {
            $u = uri_string();
            if ($segment === '') return $u === '' || $u === '/';
            return strpos($u, trim($segment, '/')) === 0;
        }
      ?>
      <ul class="navbar-nav ms-auto text-capitalize">
        <li class="nav-item"><a class="nav-link <?= is_active('sejarah') ? 'active' : '' ?>" href="<?= base_url('sejarah') ?>">sejarah</a></li>
        <li class="nav-item"><a class="nav-link <?= is_active('resep') ? 'active' : '' ?>" href="<?= base_url('resep') ?>">resep</a></li>
        <li class="nav-item"><a class="nav-link <?= is_active('galeri') ? 'active' : '' ?>" href="<?= base_url('galeri') ?>">galeri</a></li>
        <li class="nav-item"><a class="nav-link <?= is_active('about') ? 'active' : '' ?>" href="<?= base_url('about') ?>">about us</a></li>

        <?php if (session()->get('is_admin')) : ?>
            <li class="nav-item"><a class="nav-link <?= is_active('admin') ? 'active' : '' ?>" href="<?= base_url('admin') ?>">dashboard</a></li>
            <li class="nav-item"><a class="nav-link text-danger" href="<?= base_url('logout') ?>">logout</a></li>
        <?php else : ?>
            <li class="nav-item"><a class="nav-link <?= is_active('login') ? 'active' : '' ?>" href="<?= base_url('login') ?>">login</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<div class="container">
