<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Rekapan Data Kegiatan — BEM INAR Sigli</title>
  <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@600;700;800&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'DM Sans', sans-serif; background-color: #f4f7f5; color: #1e293b; }
    .navbar { background-color: #033d2f !important; }
    .header-box { background: linear-gradient(135deg, #064f3a, #08734d); color: white; border-radius: 16px; padding: 28px 32px; margin-bottom: 24px; box-shadow: 0 10px 25px rgba(6,79,58,0.15); }
    .stat-card { border: none; border-radius: 14px; box-shadow: 0 4px 20px rgba(0,0,0,0.05); transition: transform 0.2s ease, box-shadow 0.2s ease; background: #fff; }
    .stat-card:hover { transform: translateY(-3px); box-shadow: 0 8px 25px rgba(0,0,0,0.09); }
    .stat-icon { width: 52px; height: 52px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 24px; }
    .bg-soft-success { background-color: #e8f5e9; color: #2e7d32; }
    .bg-soft-primary { background-color: #e3f2fd; color: #1565c0; }
    .bg-soft-warning { background-color: #fff8e1; color: #f57f17; }
    .badge-periode { background-color: #08734d; color: #fff; font-weight: 600; font-size: 0.82rem; padding: 5px 10px; border-radius: 6px; }
    .badge-semester { background-color: #e0f2fe; color: #0369a1; font-weight: 600; font-size: 0.82rem; padding: 5px 10px; border-radius: 6px; }
    .btn-bem { background-color: #08734d; color: #fff; font-weight: 600; border-radius: 8px; }
    .btn-bem:hover { background-color: #064f3a; color: #fff; }
    .table-rekap th { background-color: #f8fafc; color: #475569; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 2px solid #e2e8f0; }
    .table-rekap td { vertical-align: middle; }
    .filter-card { border: none; border-radius: 14px; box-shadow: 0 4px 18px rgba(0,0,0,0.04); background: #fff; margin-bottom: 24px; }
  </style>
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-md navbar-dark mb-4">
    <div class="container-fluid container">
      <a class="navbar-brand font-monospace fw-bold d-flex align-items-center gap-2" href="<?php echo base_url(); ?>"><img src="<?php echo base_url('assets/images/logo-bem.png'); ?>" alt="Logo BEM" style="height:32px; width:32px; object-fit:contain; border-radius:50%; background:#fff; padding:1px;"> Sistem Pengelolaan BEM INAR</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>index.php/root/kegiatan">Kegiatan</a></li>
          <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>index.php/root/kepanitiaan">Kepanitiaan</a></li>
          <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>index.php/root/keuangan">Keuangan</a></li>
          <li class="nav-item"><a class="nav-link active fw-bold text-light" aria-current="page" href="<?php echo base_url(); ?>index.php/root/rekap">📊 Rekap Data</a></li>
          <li class="nav-item"><a class="nav-link text-warning fw-bold" href="<?php echo base_url(); ?>index.php/root/cetak">🖨️ Cetak Laporan</a></li>
          <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>index.php/root/admin">Admin</a></li>
        </ul>
        <span class="navbar-text me-3"><?php echo html_escape($this->session->userdata('admin_username')); ?></span>
        <a class="btn btn-outline-light btn-sm" href="<?php echo site_url('logout'); ?>">Keluar</a>
      </div>
    </div>
  </nav>

  <main class="container mb-5">
    <!-- Header Box -->
    <div class="header-box d-flex align-items-center justify-content-between flex-wrap gap-3">
      <div>
        <h2 class="fw-bold mb-1">📊 Rekapan Data Keseluruhan Kegiatan</h2>
        <p class="mb-0 text-white-50">Laporan rangkuman kegiatan, periode akademik, susunan kepanitiaan, dan akumulasi anggaran BEM.</p>
      </div>
      <div class="d-flex gap-2 flex-wrap">
        <a href="<?php echo site_url('root/cetak/rekap') . (!empty($selected_periode) ? '?periode_tahun=' . urlencode($selected_periode) : '') . (!empty($selected_semester) ? (empty($selected_periode) ? '?' : '&') . 'semester=' . urlencode($selected_semester) : ''); ?>" target="_blank" class="btn btn-warning fw-bold text-dark rounded-pill px-4 shadow-sm">
          🖨️ Cetak Rekap PDF
        </a>
        <a href="<?php echo site_url('root/cetak'); ?>" class="btn btn-outline-light rounded-pill px-3">
          Pusat Cetak
        </a>
      </div>
    </div>

    <!-- Filter Card -->
    <div class="card filter-card p-3 p-md-4">
      <form method="get" action="<?php echo site_url('root/rekap'); ?>" class="row g-3 align-items-end">
        <div class="col-md-4">
          <label class="form-label fw-bold small text-muted">PERIODE TAHUN AKADEMIK</label>
          <select name="periode_tahun" class="form-select">
            <option value="">-- Semua Periode Tahun --</option>
            <?php 
              $years = $daftar_periode;
              $currentYear = (int)date('Y');
              $defaultYears = array(($currentYear-1).'/'.$currentYear, $currentYear.'/'.($currentYear+1), ($currentYear+1).'/'.($currentYear+2));
              $allYears = array_unique(array_merge($years, $defaultYears));
              rsort($allYears);
              foreach ($allYears as $y): 
            ?>
              <option value="<?php echo html_escape($y); ?>" <?php echo ($selected_periode == $y) ? 'selected' : ''; ?>>
                Tahun Akademik <?php echo html_escape($y); ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="col-md-4">
          <label class="form-label fw-bold small text-muted">SEMESTER</label>
          <select name="semester" class="form-select">
            <option value="">-- Semua Semester --</option>
            <option value="Ganjil" <?php echo ($selected_semester == 'Ganjil') ? 'selected' : ''; ?>>Semester Ganjil</option>
            <option value="Genap" <?php echo ($selected_semester == 'Genap') ? 'selected' : ''; ?>>Semester Genap</option>
          </select>
        </div>
        <div class="col-md-4 d-flex gap-2">
          <button type="submit" class="btn btn-bem w-100">🔍 Terapkan Filter</button>
          <?php if (!empty($selected_periode) || !empty($selected_semester)): ?>
            <a href="<?php echo site_url('root/rekap'); ?>" class="btn btn-outline-secondary">Reset</a>
          <?php endif; ?>
        </div>
      </form>
    </div>

    <!-- Summary Widgets -->
    <div class="row g-3 mb-4">
      <div class="col-md-4">
        <div class="card stat-card p-3">
          <div class="d-flex align-items-center gap-3">
            <div class="stat-icon bg-soft-success">📅</div>
            <div>
              <span class="text-muted small fw-bold">TOTAL KEGIATAN</span>
              <h3 class="fw-bold mb-0 text-dark"><?php echo number_format($total_kegiatan, 0, ',', '.'); ?> <span class="fs-6 text-muted fw-normal">Kegiatan</span></h3>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card stat-card p-3">
          <div class="d-flex align-items-center gap-3">
            <div class="stat-icon bg-soft-primary">👥</div>
            <div>
              <span class="text-muted small fw-bold">TOTAL PANITIA TERLIBAT</span>
              <h3 class="fw-bold mb-0 text-dark"><?php echo number_format($total_panitia, 0, ',', '.'); ?> <span class="fs-6 text-muted fw-normal">Orang</span></h3>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card stat-card p-3">
          <div class="d-flex align-items-center gap-3">
            <div class="stat-icon bg-soft-warning">💰</div>
            <div>
              <span class="text-muted small fw-bold">TOTAL PENGELUARAN DANA</span>
              <h3 class="fw-bold mb-0 text-dark">Rp <?php echo number_format($total_biaya, 0, ',', '.'); ?></h3>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Rekap Data Table -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
      <div class="card-header bg-white py-3 px-4 d-flex justify-content-between align-items-center flex-wrap gap-2 border-0">
        <div>
          <h5 class="fw-bold mb-0">Daftar Rekapitulasi Kegiatan</h5>
          <small class="text-muted">
            Filter Aktif: 
            <strong><?php echo !empty($selected_periode) ? 'Tahun ' . html_escape($selected_periode) : 'Semua Tahun'; ?></strong> | 
            <strong><?php echo !empty($selected_semester) ? 'Semester ' . html_escape($selected_semester) : 'Semua Semester'; ?></strong>
          </small>
        </div>
        <span class="badge bg-secondary"><?php echo count($rekap); ?> Data Ditemukan</span>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-hover table-rekap mb-0">
            <thead>
              <tr>
                <th class="ps-4" style="width: 5%;">No</th>
                <th style="width: 25%;">Nama Kegiatan</th>
                <th style="width: 15%;">Periode / Semester</th>
                <th style="width: 14%;">Tanggal &amp; Lokasi</th>
                <th class="text-center" style="width: 12%;">Jml Panitia</th>
                <th class="text-end" style="width: 14%;">Total Biaya</th>
                <th class="text-end pe-4" style="width: 15%;">Aksi Rekap</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($rekap)): ?>
                <?php $no = 1; foreach ($rekap as $r): ?>
                <tr>
                  <td class="ps-4 text-muted fw-bold"><?php echo $no++; ?></td>
                  <td>
                    <div class="fw-bold text-dark"><?php echo html_escape($r->nama_kegiatan); ?></div>
                    <small class="text-muted"><?php echo !empty($r->deskripsi) ? html_escape(substr(strip_tags($r->deskripsi), 0, 60)) . '...' : '-'; ?></small>
                  </td>
                  <td>
                    <span class="badge-periode d-inline-block mb-1"><?php echo html_escape($r->periode_tahun ? $r->periode_tahun : '-'); ?></span><br>
                    <span class="badge-semester d-inline-block"><?php echo html_escape($r->semester ? $r->semester : '-'); ?></span>
                  </td>
                  <td>
                    <div class="fw-semibold"><?php echo date('d-m-Y', strtotime($r->tanggal)); ?></div>
                    <small class="text-muted">📍 <?php echo html_escape($r->lokasi ? $r->lokasi : 'Belum diisi'); ?></small>
                  </td>
                  <td class="text-center">
                    <span class="badge bg-light text-dark border px-3 py-2 fs-6 fw-bold">
                      <?php echo $r->total_panitia; ?> Panitia
                    </span>
                  </td>
                  <td class="text-end fw-bold text-success">
                    Rp <?php echo number_format($r->total_biaya, 0, ',', '.'); ?>
                  </td>
                  <td class="text-end pe-4">
                    <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-outline-info rounded-start" onclick="lihatRekapDetail(<?php echo $r->id_kegiatan; ?>)" title="Lihat Ringkasan Rekap">
                        👁️ Ringkasan
                      </button>
                      <a href="<?php echo site_url('root/cetak/kegiatan-detail/' . $r->id_kegiatan); ?>" target="_blank" class="btn btn-sm btn-outline-primary rounded-end" title="Cetak Dokumen LPJ Lengkap">
                        🖨️ Cetak LPJ
                      </a>
                    </div>
                  </td>
                </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="7" class="text-center py-5 text-muted">
                    <div class="fs-4 mb-2">📋</div>
                    Tidak ada data kegiatan pada periode yang dipilih.
                  </td>
                </tr>
              <?php endif; ?>
            </tbody>
            <?php if (!empty($rekap)): ?>
            <tfoot class="table-light">
              <tr class="fw-bold">
                <td colspan="4" class="ps-4 text-end">TOTAL AKUMULASI KESELURUHAN:</td>
                <td class="text-center"><?php echo $total_panitia; ?> Panitia</td>
                <td class="text-end text-success">Rp <?php echo number_format($total_biaya, 0, ',', '.'); ?></td>
                <td></td>
              </tr>
            </tfoot>
            <?php endif; ?>
          </table>
        </div>
      </div>
    </div>
  </main>

  <!-- Modal Detail Rekap Per Kegiatan -->
  <div class="modal fade" id="modalDetailRekap" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content border-0 shadow">
        <div class="modal-header bg-dark text-white">
          <h5 class="modal-title fw-bold" id="modalRekapTitle">Detail Rekap Kegiatan</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body p-4" id="modalRekapBody">
          <div class="text-center py-4">
            <div class="spinner-border text-success" role="status"></div>
            <p class="mt-2 text-muted">Memuat data...</p>
          </div>
        </div>
        <div class="modal-footer bg-light">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <a href="#" id="modalBtnCetakLPJ" target="_blank" class="btn btn-primary">🖨️ Cetak LPJ Lengkap</a>
        </div>
      </div>
    </div>
  </div>

  <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
  <script>
    function lihatRekapDetail(idKegiatan) {
      const modal = new bootstrap.Modal(document.getElementById('modalDetailRekap'));
      const body = document.getElementById('modalRekapBody');
      const title = document.getElementById('modalRekapTitle');
      const btnCetak = document.getElementById('modalBtnCetakLPJ');

      btnCetak.href = '<?php echo site_url("root/cetak/kegiatan-detail/"); ?>' + idKegiatan;
      body.innerHTML = '<div class="text-center py-4"><div class="spinner-border text-success" role="status"></div><p class="mt-2 text-muted">Memuat data rekap...</p></div>';
      modal.show();

      fetch('<?php echo site_url("root/rekap/detail/"); ?>' + idKegiatan, {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      })
      .then(res => res.json())
      .then(data => {
        title.innerText = '📋 Rekap: ' + data.kegiatan.nama_kegiatan;
        
        let panitiaHTML = '';
        if (data.kepanitiaan && data.kepanitiaan.length > 0) {
          data.kepanitiaan.forEach((p, idx) => {
            panitiaHTML += `<tr><td class="text-center">${idx + 1}</td><td><strong>${p.nama_panitia}</strong></td><td>${p.jabatan}</td></tr>`;
          });
        } else {
          panitiaHTML = '<tr><td colspan="3" class="text-center text-muted">Belum ada panitia terdaftar</td></tr>';
        }

        let keuanganHTML = '';
        if (data.keuangan && data.keuangan.length > 0) {
          data.keuangan.forEach((k, idx) => {
            let subtotal = Number(k.jumlah) * Number(k.harga);
            keuanganHTML += `<tr><td class="text-center">${idx + 1}</td><td>${k.keterangan}</td><td class="text-center">${k.jumlah}</td><td class="text-end">Rp ${Number(k.harga).toLocaleString('id-ID')}</td><td class="text-end fw-bold">Rp ${subtotal.toLocaleString('id-ID')}</td></tr>`;
          });
        } else {
          keuanganHTML = '<tr><td colspan="5" class="text-center text-muted">Belum ada rincian keuangan</td></tr>';
        }

        body.innerHTML = `
          <div class="row mb-3 g-3">
            <div class="col-md-6">
              <table class="table table-sm table-borderless">
                <tr><th width="35%">Tanggal</th><td>: ${data.kegiatan.tanggal}</td></tr>
                <tr><th>Periode</th><td>: <span class="badge bg-success">${data.kegiatan.periode_tahun || '-'}</span></td></tr>
                <tr><th>Semester</th><td>: <span class="badge bg-info text-dark">${data.kegiatan.semester || '-'}</span></td></tr>
              </table>
            </div>
            <div class="col-md-6">
              <table class="table table-sm table-borderless">
                <tr><th width="35%">Lokasi</th><td>: ${data.kegiatan.lokasi || '-'}</td></tr>
                <tr><th>Total Panitia</th><td>: <strong>${data.kepanitiaan.length} Orang</strong></td></tr>
                <tr><th>Total Anggaran</th><td>: <strong class="text-success">Rp ${Number(data.total_biaya).toLocaleString('id-ID')}</strong></td></tr>
              </table>
            </div>
          </div>
          
          <h6 class="fw-bold border-bottom pb-2 mt-3 text-dark">👥 Susunan Kepanitiaan (${data.kepanitiaan.length})</h6>
          <div class="table-responsive mb-3" style="max-height: 180px;">
            <table class="table table-sm table-bordered">
              <thead class="table-light"><tr><th width="8%" class="text-center">No</th><th>Nama Panitia</th><th>Jabatan</th></tr></thead>
              <tbody>${panitiaHTML}</tbody>
            </table>
          </div>

          <h6 class="fw-bold border-bottom pb-2 mt-3 text-dark">💰 Rincian Anggaran &amp; Keuangan</h6>
          <div class="table-responsive" style="max-height: 180px;">
            <table class="table table-sm table-bordered">
              <thead class="table-light"><tr><th width="8%" class="text-center">No</th><th>Keterangan</th><th class="text-center">Jml</th><th class="text-end">Harga Satuan</th><th class="text-end">Subtotal</th></tr></thead>
              <tbody>${keuanganHTML}</tbody>
              <tfoot class="table-light"><tr><td colspan="4" class="text-end fw-bold">TOTAL:</td><td class="text-end fw-bold text-success">Rp ${Number(data.total_biaya).toLocaleString('id-ID')}</td></tr></tfoot>
            </table>
          </div>
        `;
      })
      .catch(err => {
        body.innerHTML = '<div class="alert alert-danger">Gagal mengambil data detail rekap kegiatan.</div>';
      });
    }
  </script>
</body>
</html>
