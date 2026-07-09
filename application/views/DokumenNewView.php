<!DOCTYPE html>
<html lang="en" data-bs-theme="auto">
  <head>
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Sistem Informasi Pengelolaan Kegiatan BEM INAR</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav me-auto mb-2 mb-md-0">
            <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>index.php/kegiatan">Kegiatan</a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>index.php/kepanitiaan">Kepanitiaan</a></li>
            <li class="nav-item"><a class="nav-link active" aria-current="page" href="<?php echo base_url(); ?>index.php/dokumen">Dokumen</a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>index.php/keuangan">Keuangan</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <main class="container">
      <h3 class="text-center mb-4">Tambah Dokumen</h3>
      <form method="post" action="<?php echo base_url(); ?>index.php/dokumen" enctype="multipart/form-data">
        <div class="mb-3">
          <label class="form-label">ID Kegiatan</label>
          <input type="text" name="id_kegiatan" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Jenis Dokumen</label>
          <input type="text" name="jenis_dokumen" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">File</label>
          <input type="file" name="nama_file" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="<?php echo base_url(); ?>index.php/dokumen" class="btn btn-secondary">Batal</a>
      </form>
    </main>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
  </body>
</html>
