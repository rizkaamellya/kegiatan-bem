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
        <a class="navbar-brand d-flex align-items-center gap-2" href="#"><img src="<?php echo base_url('assets/images/logo-bem.png'); ?>" alt="Logo BEM" style="height:32px; width:32px; object-fit:contain; border-radius:50%; background:#fff; padding:1px;"> Sistem Informasi Pengelolaan Kegiatan BEM INAR</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav me-auto mb-2 mb-md-0">
            <li class="nav-item">
              <a class="nav-link active" href="<?php echo base_url(); ?>index.php/root/kegiatan">Kegiatan</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url(); ?>index.php/root/kepanitiaan">Kepanitiaan</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url(); ?>index.php/root/keuangan">Keuangan</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url(); ?>index.php/root/rekap">📊 Rekap Data</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-warning fw-bold" href="<?php echo base_url(); ?>index.php/root/cetak">🖨️ Cetak Laporan</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url(); ?>index.php/root/admin">Admin</a>
            </li>
          </ul>
          <span class="navbar-text me-3"><?php echo html_escape($this->session->userdata('admin_username')); ?></span>
          <a class="btn btn-outline-light btn-sm" href="<?php echo site_url('logout'); ?>">Keluar</a>
        </div>
      </div>
    </nav>
    <main class="container mb-5">
      <!-- Filter Bar -->
      <div class="card mb-4 border-0 shadow-sm">
        <div class="card-body p-3">
          <form method="get" action="<?php echo base_url('index.php/root/kegiatan'); ?>" class="row g-2 align-items-center">
            <div class="col-auto">
              <span class="fw-bold text-muted small">FILTER:</span>
            </div>
            <div class="col-md-3">
              <select name="periode_tahun" class="form-select form-select-sm">
                <option value="">-- Semua Tahun Akademik --</option>
                <?php if (!empty($daftar_periode)): ?>
                  <?php foreach ($daftar_periode as $p): ?>
                    <option value="<?php echo html_escape($p); ?>" <?php echo ($selected_periode == $p) ? 'selected' : ''; ?>>Tahun <?php echo html_escape($p); ?></option>
                  <?php endforeach; ?>
                <?php endif; ?>
              </select>
            </div>
            <div class="col-md-3">
              <select name="semester" class="form-select form-select-sm">
                <option value="">-- Semua Semester --</option>
                <option value="Ganjil" <?php echo ($selected_semester == 'Ganjil') ? 'selected' : ''; ?>>Semester Ganjil</option>
                <option value="Genap" <?php echo ($selected_semester == 'Genap') ? 'selected' : ''; ?>>Semester Genap</option>
              </select>
            </div>
            <div class="col-auto d-flex gap-1">
              <button type="submit" class="btn btn-primary btn-sm">Filter</button>
              <?php if (!empty($selected_periode) || !empty($selected_semester)): ?>
                <a href="<?php echo base_url('index.php/root/kegiatan'); ?>" class="btn btn-outline-secondary btn-sm">Reset</a>
              <?php endif; ?>
            </div>
            <div class="col-md text-md-end">
              <a href="<?php echo site_url('root/rekap'); ?>" class="btn btn-success btn-sm">
                📊 Buka Rekapan Lengkap
              </a>
            </div>
          </form>
        </div>
      </div>

      <div class="card shadow-sm border-0">
        <h5 class="card-header bg-white py-3 fw-bold">Data Kegiatan BEM</h5>
        <div class="card-body">
           <div class="d-flex justify-content-between align-items-center mb-3">
             <a href="<?php echo base_url(); ?>index.php/root/kegiatan/new" class="btn btn-primary">
               ➕ Tambah Kegiatan
             </a>
             <a href="<?php echo site_url('root/cetak/kegiatan') . (!empty($selected_periode) ? '?periode_tahun=' . urlencode($selected_periode) : '') . (!empty($selected_semester) ? (empty($selected_periode) ? '?' : '&') . 'semester=' . urlencode($selected_semester) : ''); ?>" target="_blank" class="btn btn-outline-secondary">
               🖨️ Cetak Laporan Kegiatan
             </a>
           </div>
          <div class="table-responsive">
            <table class="table table-hover align-middle">
              <thead class="table-light">
                <tr>
                  <th scope="col">Thumbnail</th>
                  <th scope="col">Nama Kegiatan</th>
                  <th scope="col">Periode &amp; Semester</th>
                  <th scope="col">Tanggal &amp; Lokasi</th>
                  <th scope="col">Deskripsi</th>
                  <th scope="col" class="text-end">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($kegiatan)): ?>
                  <?php foreach ($kegiatan as $k) { ?>
                  <tr>
                    <td>
                      <?php if (!empty($k->foto)) { ?>
                        <img src="<?php echo base_url('uploads/kegiatan/' . rawurlencode($k->foto)); ?>" alt="Thumbnail <?php echo html_escape($k->nama_kegiatan); ?>" class="rounded" style="width: 100px; height: 60px; object-fit: cover;">
                      <?php } else { ?>
                        <span class="badge bg-light text-muted border">No photo</span>
                      <?php } ?>
                    </td>
                    <td><strong class="text-dark"><?php echo html_escape($k->nama_kegiatan); ?></strong></td>
                    <td>
                      <span class="badge bg-success mb-1"><?php echo html_escape($k->periode_tahun ? $k->periode_tahun : '-'); ?></span><br>
                      <span class="badge bg-info text-dark"><?php echo html_escape($k->semester ? $k->semester : '-'); ?></span>
                    </td>
                    <td>
                      <div><?php echo date('d-m-Y', strtotime($k->tanggal)); ?></div>
                      <small class="text-muted"><?php echo html_escape($k->lokasi ? $k->lokasi : '-'); ?></small>
                    </td>
                    <td>
                      <?php echo !empty($k->deskripsi) ? html_escape(substr(strip_tags($k->deskripsi), 0, 70)) . '...' : '-'; ?>
                    </td>
                    <td class="text-end">
                      <a href="<?php echo site_url('root/cetak/kegiatan-detail/' . $k->id_kegiatan); ?>" target="_blank" class="btn btn-info btn-sm text-white mb-1" title="Cetak LPJ Kegiatan">🖨️ LPJ</a>
                      <a href="<?php echo base_url(); ?>index.php/root/kegiatan/edit/<?php echo $k->id_kegiatan; ?>" class="btn btn-success btn-sm mb-1">Ubah</a>
                      <a href="<?php echo base_url(); ?>index.php/root/kegiatan/delete/<?php echo $k->id_kegiatan; ?>" class="btn btn-danger btn-sm mb-1" onclick="return confirm('Yakin ingin hapus kegiatan ini?');">Hapus</a>
                    </td>
                  </tr>
                  <?php } ?>
                <?php else: ?>
                  <tr>
                    <td colspan="6" class="text-center py-4 text-muted">Tidak ada data kegiatan.</td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </main>
    <script src="
				<?php echo base_url(); ?>assets/js/bootstrap.min.js">
    </script>
  </body>
</html>
