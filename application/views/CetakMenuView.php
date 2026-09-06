<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pusat Cetak Laporan — BEM INAR Sigli</title>
  <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@600;700;800&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'DM Sans', sans-serif; background-color: #f4f7f5; }
    .navbar { background-color: #033d2f !important; }
    .card-print { border: none; border-radius: 14px; box-shadow: 0 8px 24px rgba(0,0,0,0.06); transition: all 0.25s ease; height: 100%; }
    .card-print:hover { transform: translateY(-4px); box-shadow: 0 12px 30px rgba(0,0,0,0.12); }
    .icon-box { width: 56px; height: 56px; border-radius: 12px; background: rgba(8, 115, 77, 0.1); color: #08734d; display: flex; align-items: center; justify-content: center; font-size: 26px; font-weight: bold; margin-bottom: 16px; }
    .btn-bem { background-color: #08734d; color: #fff; border-radius: 8px; font-weight: 600; }
    .btn-bem:hover { background-color: #064f3a; color: #fff; }
    .header-box { background: linear-gradient(135deg, #064f3a, #08734d); color: white; border-radius: 14px; padding: 28px; margin-bottom: 30px; }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-md navbar-dark mb-4">
    <div class="container-fluid container">
      <a class="navbar-brand font-monospace fw-bold d-flex align-items-center gap-2" href="#"><img src="<?php echo base_url('assets/images/logo-bem.png'); ?>" alt="Logo BEM" style="height:32px; width:32px; object-fit:contain; border-radius:50%; background:#fff; padding:1px;"> Sistem Pengelolaan BEM INAR</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>index.php/root/kegiatan">Kegiatan</a></li>
          <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>index.php/root/kepanitiaan">Kepanitiaan</a></li>
          <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>index.php/root/keuangan">Keuangan</a></li>
          <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>index.php/root/rekap">📊 Rekap Data</a></li>
          <li class="nav-item"><a class="nav-link active fw-bold text-warning" aria-current="page" href="<?php echo base_url(); ?>index.php/root/cetak">🖨️ Cetak Laporan</a></li>
          <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>index.php/root/admin">Admin</a></li>
        </ul>
        <span class="navbar-text me-3"><?php echo html_escape($this->session->userdata('admin_username')); ?></span>
        <a class="btn btn-outline-light btn-sm" href="<?php echo site_url('logout'); ?>">Keluar</a>
      </div>
    </div>
  </nav>

  <main class="container mb-5">
    <div class="header-box d-flex align-items-center justify-content-between flex-wrap gap-3">
      <div>
        <h2 class="fw-bold mb-1">🖨️ Pusat Cetak Dokumen Laporan BEM</h2>
        <p class="mb-0 text-white-50">Pilih jenis laporan yang ingin dicetak atau diekspor ke PDF dalam format resmi kop BEM &amp; INAR.</p>
      </div>
      <div class="d-flex gap-2">
        <a href="<?php echo site_url('root/rekap'); ?>" class="btn btn-warning btn-sm rounded-pill px-3 fw-bold text-dark">📊 Menu Rekap Data</a>
        <a href="<?php echo site_url(); ?>" target="_blank" class="btn btn-outline-light btn-sm rounded-pill px-3">🌐 Lihat Situs Publik</a>
      </div>
    </div>

    <div class="row g-4">
      <!-- Cetak Rekap Keseluruhan Kegiatan -->
      <div class="col-md-6 col-lg-4">
        <div class="card card-print p-4 border-2 border-success">
          <div class="icon-box" style="background: rgba(46, 125, 50, 0.15); color: #2e7d32;">📊</div>
          <span class="badge bg-success w-auto mb-2 align-self-start">UTAMA</span>
          <h5 class="fw-bold text-dark mb-2">Rekapitulasi Keseluruhan</h5>
          <p class="text-secondary small mb-4">Cetak rekap gabungan data seluruh kegiatan, periode, jumlah panitia, dan total biaya.</p>
          <button type="button" class="btn btn-success fw-bold w-100 mt-auto" data-bs-toggle="modal" data-bs-target="#modalCetakRekap">🖨️ Cetak Rekap Keseluruhan</button>
        </div>
      </div>

      <!-- Cetak LPJ Per Kegiatan -->
      <div class="col-md-6 col-lg-4">
        <div class="card card-print p-4">
          <div class="icon-box">📄</div>
          <h5 class="fw-bold text-dark mb-2">Cetak LPJ Per Kegiatan</h5>
          <p class="text-secondary small mb-4">Cetak dokumen Laporan Pertanggungjawaban (LPJ) lengkap untuk 1 kegiatan tertentu.</p>
          <button type="button" class="btn btn-bem w-100 mt-auto" data-bs-toggle="modal" data-bs-target="#modalCetakLPJ">Pilih Kegiatan</button>
        </div>
      </div>

      <!-- Cetak Data Kegiatan -->
      <div class="col-md-6 col-lg-4">
        <div class="card card-print p-4">
          <div class="icon-box">📅</div>
          <h5 class="fw-bold text-dark mb-2">Laporan Data Kegiatan</h5>
          <p class="text-secondary small mb-4">Cetak daftar tabel agenda dan program kerja BEM per periode/semester.</p>
          <button type="button" class="btn btn-bem w-100 mt-auto" data-bs-toggle="modal" data-bs-target="#modalCetakKegiatan">Cetak Laporan</button>
        </div>
      </div>

      <!-- Cetak Data Keuangan -->
      <div class="col-md-6 col-lg-6">
        <div class="card card-print p-4">
          <div class="icon-box">💰</div>
          <h5 class="fw-bold text-dark mb-2">Laporan Keuangan</h5>
          <p class="text-secondary small mb-4">Cetak rekap keuangan kas, pengeluaran &amp; anggaran kegiatan lengkap dengan total.</p>
          <button type="button" class="btn btn-bem w-100 mt-auto" data-bs-toggle="modal" data-bs-target="#modalCetakKeuangan">Cetak Laporan</button>
        </div>
      </div>

      <!-- Cetak Data Panitia -->
      <div class="col-md-6 col-lg-6">
        <div class="card card-print p-4">
          <div class="icon-box">👥</div>
          <h5 class="fw-bold text-dark mb-2">Laporan Kepanitiaan</h5>
          <p class="text-secondary small mb-4">Cetak daftar anggota panitia beserta jabatan struktur pelaksana kegiatan BEM.</p>
          <button type="button" class="btn btn-bem w-100 mt-auto" data-bs-toggle="modal" data-bs-target="#modalCetakPanitia">Cetak Laporan</button>
        </div>
      </div>
    </div>

    <!-- Quick Table List of Activities for LPJ Print -->
    <div class="card border-0 shadow-sm rounded-4 mt-5">
      <div class="card-header bg-white py-3 border-0 d-flex justify-content-between align-items-center">
        <h5 class="fw-bold mb-0">Cetak LPJ / Rekap Kegiatan Spesifik</h5>
        <a href="<?php echo site_url('root/rekap'); ?>" class="btn btn-sm btn-outline-success">Lihat Halaman Rekap Lengkap →</a>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
              <tr>
                <th class="ps-4">Nama Kegiatan</th>
                <th>Periode &amp; Semester</th>
                <th>Tanggal</th>
                <th>Lokasi</th>
                <th class="text-end pe-4">Aksi Cetak</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($kegiatan)): ?>
                <?php foreach ($kegiatan as $k): ?>
                <tr>
                  <td class="ps-4 fw-semibold"><?php echo html_escape($k->nama_kegiatan); ?></td>
                  <td>
                    <span class="badge bg-success"><?php echo html_escape($k->periode_tahun ? $k->periode_tahun : '-'); ?></span>
                    <span class="badge bg-info text-dark"><?php echo html_escape($k->semester ? $k->semester : '-'); ?></span>
                  </td>
                  <td><?php echo date('d-m-Y', strtotime($k->tanggal)); ?></td>
                  <td><?php echo html_escape($k->lokasi ? $k->lokasi : '-'); ?></td>
                  <td class="text-end pe-4">
                    <a href="<?php echo site_url('root/cetak/kegiatan-detail/' . $k->id_kegiatan); ?>" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                      🖨️ Cetak LPJ Lengkap
                    </a>
                  </td>
                </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="5" class="text-center py-4 text-muted">Belum ada data kegiatan.</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </main>

  <!-- Modal Cetak Rekap Keseluruhan -->
  <div class="modal fade" id="modalCetakRekap" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="get" action="<?php echo site_url('root/cetak/rekap'); ?>" target="_blank">
          <div class="modal-header bg-success text-white">
            <h5 class="modal-title fw-bold">🖨️ Cetak Rekapitulasi Keseluruhan Kegiatan</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label fw-semibold">Filter Periode Tahun</label>
              <select name="periode_tahun" class="form-select">
                <option value="">-- Semua Periode Tahun --</option>
                <?php if (!empty($daftar_periode)): ?>
                  <?php foreach ($daftar_periode as $p): ?>
                    <option value="<?php echo html_escape($p); ?>">Tahun Akademik <?php echo html_escape($p); ?></option>
                  <?php endforeach; ?>
                <?php endif; ?>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label fw-semibold">Filter Semester</label>
              <select name="semester" class="form-select">
                <option value="">-- Semua Semester --</option>
                <option value="Ganjil">Semester Ganjil</option>
                <option value="Genap">Semester Genap</option>
              </select>
            </div>
            <p class="small text-muted mb-0">Format cetak kop resmi dengan Logo BEM di kiri dan Logo Kampus di kanan, dilengkapi ringkasan statistik panitia &amp; total biaya.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-success fw-bold">🖨️ Cetak Dokumen</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal Cetak Kegiatan -->
  <div class="modal fade" id="modalCetakKegiatan" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="get" action="<?php echo site_url('root/cetak/kegiatan'); ?>" target="_blank">
          <div class="modal-header">
            <h5 class="modal-title fw-bold">Cetak Laporan Data Kegiatan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label fw-semibold">Filter Periode Tahun</label>
              <select name="periode_tahun" class="form-select">
                <option value="">-- Semua Periode Tahun --</option>
                <?php if (!empty($daftar_periode)): ?>
                  <?php foreach ($daftar_periode as $p): ?>
                    <option value="<?php echo html_escape($p); ?>">Tahun Akademik <?php echo html_escape($p); ?></option>
                  <?php endforeach; ?>
                <?php endif; ?>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label fw-semibold">Filter Semester</label>
              <select name="semester" class="form-select">
                <option value="">-- Semua Semester --</option>
                <option value="Ganjil">Semester Ganjil</option>
                <option value="Genap">Semester Genap</option>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-bem">🖨️ Cetak Dokumen</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal Cetak Keuangan -->
  <div class="modal fade" id="modalCetakKeuangan" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="get" action="<?php echo site_url('root/cetak/keuangan'); ?>" target="_blank">
          <div class="modal-header">
            <h5 class="modal-header-title fw-bold">Cetak Laporan Keuangan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label fw-semibold">Pilih Filter Kegiatan</label>
              <select name="id_kegiatan" class="form-select">
                <option value="">-- Semua Kegiatan --</option>
                <?php foreach ($kegiatan as $k): ?>
                  <option value="<?php echo $k->id_kegiatan; ?>"><?php echo html_escape($k->nama_kegiatan); ?></option>
                <?php endforeach; ?>
              </select>
              <small class="text-muted">Biarkan semua kegiatan jika ingin mencetak rekapitulasi seluruh keuangan.</small>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-bem">🖨️ Cetak Dokumen</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal Cetak Panitia -->
  <div class="modal fade" id="modalCetakPanitia" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="get" action="<?php echo site_url('root/cetak/kepanitiaan'); ?>" target="_blank">
          <div class="modal-header">
            <h5 class="modal-header-title fw-bold">Cetak Laporan Kepanitiaan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label fw-semibold">Pilih Filter Kegiatan</label>
              <select name="id_kegiatan" class="form-select">
                <option value="">-- Semua Kegiatan --</option>
                <?php foreach ($kegiatan as $k): ?>
                  <option value="<?php echo $k->id_kegiatan; ?>"><?php echo html_escape($k->nama_kegiatan); ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-bem">🖨️ Cetak Dokumen</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal Cetak LPJ -->
  <div class="modal fade" id="modalCetakLPJ" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-header-title fw-bold">Pilih Kegiatan untuk Cetak LPJ</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="list-group">
            <?php foreach ($kegiatan as $k): ?>
              <a href="<?php echo site_url('root/cetak/kegiatan-detail/' . $k->id_kegiatan); ?>" target="_blank" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                <div>
                  <div class="fw-bold"><?php echo html_escape($k->nama_kegiatan); ?></div>
                  <small class="text-muted"><?php echo date('d-m-Y', strtotime($k->tanggal)); ?> | Periode: <?php echo html_escape($k->periode_tahun ? $k->periode_tahun : '-'); ?> (<?php echo html_escape($k->semester ? $k->semester : '-'); ?>)</small>
                </div>
                <span class="badge bg-primary rounded-pill">Cetak 🖨️</span>
              </a>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
</body>
</html>
