<!DOCTYPE html>
<html lang="en" data-bs-theme="auto">
  <head>
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Sistem Informasi Pengelolaan Kegiatan BEM INAR</a>
      </div>
    </nav>
    <main class="container">
      <?php $a = !empty($admin) ? $admin[0] : null; ?>
      <h3 class="text-center mb-4">Edit Admin</h3>
      <?php if ($a) { ?>
      <form method="post" action="<?php echo base_url(); ?>index.php/admin/update">
        <input type="hidden" name="id_admin" value="<?php echo $a->id_admin; ?>">
        <div class="mb-3">
          <label class="form-label">Username</label>
          <input type="text" name="username" class="form-control" value="<?php echo html_escape($a->username); ?>" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Password</label>
          <input type="password" name="password" class="form-control" value="<?php echo html_escape($a->password); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="<?php echo base_url(); ?>index.php/admin" class="btn btn-secondary">Batal</a>
      </form>
      <?php } else { ?>
      <div class="alert alert-warning">Data admin tidak ditemukan.</div>
      <?php } ?>
    </main>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
  </body>
</html>
