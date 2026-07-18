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
            <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>index.php/root/kegiatan">Kegiatan</a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>index.php/root/kepanitiaan">Kepanitiaan</a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>index.php/root/keuangan">Keuangan</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <main class="container">
      <?php $k = !empty($kepanitiaan) ? $kepanitiaan[0] : null; ?>
      <h3 class="text-center mb-4">Edit Kepanitiaan</h3>
      <?php if ($k) { ?>
      <form method="post" action="<?php echo base_url(); ?>index.php/root/kepanitiaan/update">
        <input type="hidden" name="id_kepanitiaan" value="<?php echo $k->id_kepanitiaan; ?>">
        <div class="mb-3">
          <label class="form-label">Kegiatan</label>
          <select name="id_kegiatan" class="form-control" required>
            <option value="">Pilih Kegiatan</option>
            <?php foreach ($kegiatan as $kg) { ?>
            <option value="<?php echo $kg->id_kegiatan; ?>" <?php echo $kg->id_kegiatan == $k->id_kegiatan ? 'selected' : ''; ?>>
              <?php echo html_escape($kg->nama_kegiatan); ?>
            </option>
            <?php } ?>
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label">Nama Panitia</label>
          <input type="text" name="nama_panitia" class="form-control" value="<?php echo html_escape($k->nama_panitia); ?>">
        </div>
        <div class="mb-3">
          <label class="form-label">Jabatan</label>
          <input type="text" name="jabatan" class="form-control" value="<?php echo html_escape($k->jabatan); ?>">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="<?php echo base_url(); ?>index.php/root/kepanitiaan" class="btn btn-secondary">Batal</a>
      </form>
      <?php } else { ?>
      <div class="alert alert-warning">Data kepanitiaan tidak ditemukan.</div>
      <?php } ?>
    </main>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
  </body>
</html>
