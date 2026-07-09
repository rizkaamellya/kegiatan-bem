<!DOCTYPE html>
<html lang="en" data-bs-theme="auto">
  <head>
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Sistem Informasi Pengelolaan Kegiatan BEM INAR</a>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav me-auto mb-2 mb-md-0">
            <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>index.php/kegiatan">Kegiatan</a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>index.php/kepanitiaan">Kepanitiaan</a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>index.php/dokumen">Dokumen</a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>index.php/keuangan">Keuangan</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <main class="container">
      <?php $k = !empty($kegiatan) ? $kegiatan[0] : null; ?>
      <h3 class="text-center mb-4">Edit Kegiatan</h3>
      <?php if ($k) { ?>
      <form method="post" action="<?php echo base_url(); ?>index.php/kegiatan/update">
        <input type="hidden" name="id_kegiatan" value="<?php echo $k->id_kegiatan; ?>">
        <div class="mb-3">
          <label class="form-label">Nama Kegiatan</label>
          <input type="text" name="nama_kegiatan" class="form-control" value="<?php echo html_escape($k->nama_kegiatan); ?>">
        </div>
        <div class="mb-3">
          <label class="form-label">Tanggal</label>
          <input type="date" name="tanggal" class="form-control" value="<?php echo html_escape($k->tanggal); ?>" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Lokasi</label>
          <input type="text" name="lokasi" class="form-control" value="<?php echo html_escape($k->lokasi); ?>">
        </div>
        <div class="mb-3">
          <label class="form-label">Deskripsi</label>
          <input type="text" name="deskripsi" class="form-control" value="<?php echo html_escape($k->deskripsi); ?>">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="<?php echo base_url(); ?>index.php/kegiatan" class="btn btn-secondary">Batal</a>
      </form>
      <?php } else { ?>
      <div class="alert alert-warning">Data kegiatan tidak ditemukan.</div>
      <?php } ?>
    </main>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
  </body>
</html>
