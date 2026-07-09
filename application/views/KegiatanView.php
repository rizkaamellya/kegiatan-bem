<!DOCTYPE html>
<html lang="en" data-bs-theme="auto">
  <head>
    <link href="
			
			<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem
        }
      }

      .b-example-divider {
        width: 100%;
        height: 3rem;
        background-color: #0000001a;
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em #0000001a, inset 0 .125em .5em #00000026
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch
      }

      .btn-bd-primary {
        --bd-violet-bg: #712cf9;
        --bd-violet-rgb: 112.520718, 44.062154, 249.437846;
        --bs-btn-font-weight: 600;
        --bs-btn-color: var(--bs-white);
        --bs-btn-bg: var(--bd-violet-bg);
        --bs-btn-border-color: var(--bd-violet-bg);
        --bs-btn-hover-color: var(--bs-white);
        --bs-btn-hover-bg: #6528e0;
        --bs-btn-hover-border-color: #6528e0;
        --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
        --bs-btn-active-color: var(--bs-btn-hover-color);
        --bs-btn-active-bg: #5a23c8;
        --bs-btn-active-border-color: #5a23c8
      }

      .bd-mode-toggle {
        z-index: 1500
      }

      .bd-mode-toggle .bi {
        width: 1em;
        height: 1em
      }

      .bd-mode-toggle .dropdown-menu .active .bi {
        display: block !important
      }
    </style>
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
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url(); ?>index.php/kegiatan">Kegiatan</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url(); ?>index.php/kepanitiaan">kepanitian</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url(); ?>index.php/keuangan">Keuangan</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <main class="container">
      <div class="card">
        <h5 class="card-header text-center">Data Kegiatan</h5>
        <div class="card-body">
           <a href="<?php echo base_url(); ?>index.php/kegiatan/new">
           <button type="button" class="btn btn-primary">Tambah</button>
          </a>
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Nama</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Lokasi</th>
                <th scope="col">Deskripsi</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($kegiatan as $k) { ?>
              <tr>
                <td><?php echo $k->nama_kegiatan; ?></td>
                <td><?php echo $k->tanggal; ?></td>
                <td><?php echo $k->lokasi; ?></td>
                <td>
                  <?php echo !empty($k->deskripsi) ? html_escape(substr(strip_tags($k->deskripsi), 0, 80)) : '-'; ?>
                </td>
                <td>
                  <a href="<?php echo base_url(); ?>index.php/kegiatan/edit/<?php echo $k->id_kegiatan; ?>" class="btn btn-success">Ubah</a>
                  <a href="<?php echo base_url(); ?>index.php/kegiatan/delete/<?php echo $k->id_kegiatan; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin hapus?');">Hapus</a>
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </main>
    <script src="
				<?php echo base_url(); ?>assets/js/bootstrap.min.js">
    </script>
  </body>
</html>
