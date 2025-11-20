<!-- HERO -->
<div class="position-relative rounded overflow-hidden mt-4 shadow" style="height:360px;">
  <div style="
    background-image:url('<?= base_url('assets/img/hero/pembuka.jpeg')?>');
    background-size:cover;
    background-position:center;
    filter: brightness(0.7);
    width:100%; height:100%;
    position:absolute; top:0; left:0;
  "></div>

  <div class="position-absolute top-50 start-50 translate-middle text-center text-white">
    <h1 class="fw-bold display-5" style="text-shadow:0 0 12px rgba(0,0,0,0.6);">
      Kuliner Makassar
    </h1>
    <p class="mt-2 fs-5" style="text-shadow:0 0 8px rgba(0,0,0,0.5);">
      Rasa yang melekat dalam sejarah, budaya, dan keseharian orang Sulawesi Selatan
    </p>
    <a href="<?= base_url('resep') ?>" class="btn btn-warning mt-3 fw-semibold px-4">
      Jelajahi Resep
    </a>
  </div>
</div>

<!-- INTRO -->
<div class="mt-4">
  <p class="lead">
    Website ini menghadirkan sejarah, filosofi, dan resep kuliner tradisional Makassar yang dirangkum secara ringkas dan mudah dipahami. 
    Kamu bisa mengenal asal-usul makanan klasik, melihat galeri foto autentik, hingga mengikuti resep yang sudah disusun kembali agar mudah dipraktikkan di rumah.
  </p>
</div>

<!-- 3 FITUR UTAMA -->
<div class="row text-center mt-5">
  <div class="col-md-4 mb-4">
    <div class="p-4 rounded shadow-sm h-100 border">
      <img src="<?= base_url('assets/img/icon/sejarah.png') ?>" width="60" class="mb-3" alt="">
      <h5 class="fw-bold mb-2">Sejarah Kuliner</h5>
      <p class="text-muted mb-3">Pelajari cerita di balik hidangan Makassar, dari warisan kerajaan sampai tradisi harian masyarakat lokal.</p>
      <a href="<?= base_url('sejarah') ?>" class="btn btn-outline-dark btn-sm px-3">Lihat Sejarah</a>
    </div>
  </div>

  <div class="col-md-4 mb-4">
    <div class="p-4 rounded shadow-sm h-100 border">
      <img src="<?= base_url('assets/img/icon/resep.png') ?>" width="60" class="mb-3" alt="">
      <h5 class="fw-bold mb-2">Resep Masakan</h5>
      <p class="text-muted mb-3">Langkah memasak yang rapi, padat, dan mudah diikuti. Cocok bagi pemula maupun pecinta masak rumahan.</p>
      <a href="<?= base_url('resep') ?>" class="btn btn-outline-dark btn-sm px-3">Lihat Resep</a>
    </div>
  </div>

  <div class="col-md-4 mb-4">
    <div class="p-4 rounded shadow-sm h-100 border">
      <img src="<?= base_url('assets/img/icon/galeri.png') ?>" width="60" class="mb-3" alt="">
      <h5 class="fw-bold mb-2">Galeri Foto</h5>
      <p class="text-muted mb-3">Koleksi foto makanan autentik yang merekam aroma kuat Makassar dalam visual yang menggugah selera.</p>
      <a href="<?= base_url('galeri') ?>" class="btn btn-outline-dark btn-sm px-3">Lihat Galeri</a>
    </div>
  </div>
</div>

<!-- HIGHLIGHT MAKANAN -->
<h3 class="fw-bold mt-5 mb-3 text-center">Makanan Khas Makassar</h3>

<div class="row">
  <div class="col-md-4 mb-4">
    <div class="card shadow-sm h-100 border-0">
      <img src="<?= base_url('assets/img/makanan/coto.jpg') ?>" class="card-img-top" alt="">
      <div class="card-body">
        <h5 class="fw-bold">Coto Makassar</h5>
        <p class="text-muted small">Kuah rempah yang pekat, kacang tanah sangrai, dan aroma yang sulit dilupakan.</p>
        <a href="<?= base_url('resep?m=coto') ?>" class="btn btn-sm btn-dark">Detail</a>
      </div>
    </div>
  </div>

  <div class="col-md-4 mb-4">
    <div class="card shadow-sm h-100 border-0">
      <img src="<?= base_url('assets/img/makanan/pallubasa.jpg') ?>" class="card-img-top" alt="">
      <div class="card-body">
        <h5 class="fw-bold">Pallubasa</h5>
        <p class="text-muted small">Daging lembut dengan taburan kelapa sangrai yang khas, gurihnya nempel lama.</p>
        <a href="<?= base_url('resep?m=pallubasa') ?>" class="btn btn-sm btn-dark">Detail</a>
      </div>
    </div>
  </div>

  <div class="col-md-4 mb-4">
    <div class="card shadow-sm h-100 border-0">
      <img src="<?= base_url('assets/img/makanan/sopkonro.jpg') ?>" class="card-img-top" alt="">
      <div class="card-body">
        <h5 class="fw-bold">Sop Konro</h5>
        <p class="text-muted small">Sop iga hitam dengan racikan rempah yang intens dan cita rasa berkarakter.</p>
        <a href="<?= base_url('resep?m=konro') ?>" class="btn btn-sm btn-dark">Detail</a>
      </div>
    </div>
  </div>
</div>

<!-- EDUKASI -->
<div class="bg-light rounded p-4 mt-4 border">
  <h4 class="fw-bold">Kenapa Kuliner Makassar Begitu Khas?</h4>
  <p class="mt-2">
    Makassar punya sejarah panjang sebagai pelabuhan internasional, tempat para pedagang rempah dunia singgah selama ratusan tahun.
    Dari sinilah lahir racikan bumbu yang kaya, kuat, dan berkarakter. Kuliner Makassar bukan sekadar hidangan 
    tapi identitas budaya yang terjaga sampai hari ini.
  </p>
</div>

<!-- CTA -->
<div class="text-center mt-5 mb-4">
  <h4 class="fw-bold mb-3">Siap Menjelajah Rasa?</h4>
  <a href="<?= base_url('sejarah') ?>" class="btn btn-lg btn-warning px-5 fw-semibold">
    Mulai dari Sejarah
  </a>
</div>
