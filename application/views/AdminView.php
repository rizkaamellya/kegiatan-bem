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
            <li class="nav-item"><a class="nav-link active" aria-current="page" href="<?php echo base_url(); ?>index.php/admin">Admin</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <main class="container">
      <div class="card">
        <h5 class="card-header text-center">Data Admin</h5>
        <div class="card-body">
          <a href="<?php echo base_url(); ?>index.php/admin/new" class="btn btn-primary">Tambah</a>
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Username</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($admin as $a) { ?>
              <tr>
                <td><?php echo html_escape($a->username); ?></td>
                <td>
                  <a href="<?php echo base_url(); ?>index.php/admin/edit/<?php echo $a->id_admin; ?>" class="btn btn-success">Ubah</a>
                  <a href="<?php echo base_url(); ?>index.php/admin/delete/<?php echo $a->id_admin; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin hapus?');">Hapus</a>
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </main>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
  </body>
</html>
