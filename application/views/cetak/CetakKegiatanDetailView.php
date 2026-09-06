<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title><?php echo html_escape($title); ?></title>
  <style>
    @page { size: A4 portrait; margin: 1.5cm 1.8cm; }
    * { box-sizing: border-box; font-family: "Times New Roman", Times, serif; }
    body { margin: 0; padding: 0; color: #000; font-size: 11pt; line-height: 1.5; }
    .page-container { width: 100%; margin: 0; padding: 0; }
    
    /* Kop Surat */
    .kop-surat { width: 100%; border-bottom: 3px double #000; padding-bottom: 12px; margin-bottom: 20px; border-collapse: collapse; }
    .kop-surat td { vertical-align: middle; }
    .kop-logo { object-fit: contain; }
    .kop-logo-bem { width: 85px; height: 85px; }
    .kop-logo-kampus { width: 85px; height: 85px; }
    .kop-text { text-align: center; padding: 0 15px; }
    .kop-text h3 { margin: 0; font-size: 11pt; text-transform: uppercase; font-weight: normal; }
    .kop-text h2 { margin: 2px 0; font-size: 13pt; text-transform: uppercase; font-weight: bold; color: #064f3a; }
    .kop-text p { margin: 0; font-size: 9pt; font-family: Arial, sans-serif; color: #333; }
    
    .doc-title { text-align: center; margin-bottom: 20px; }
    .doc-title h4 { margin: 0; font-size: 13pt; text-transform: uppercase; text-decoration: underline; }
    .doc-title p { margin: 2px 0 0; font-size: 9.5pt; font-family: Arial, sans-serif; color: #555; }
    
    .section-header { font-size: 11pt; font-weight: bold; text-transform: uppercase; border-bottom: 1px solid #000; padding-bottom: 3px; margin: 20px 0 10px; color: #064f3a; }
    
    .info-table { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
    .info-table td { padding: 4px 6px; vertical-align: top; }
    .info-table td.label { width: 25%; font-weight: bold; }
    .info-table td.colon { width: 2%; text-align: center; }
    
    table.data-table { width: 100%; border-collapse: collapse; margin-top: 8px; font-size: 10pt; }
    table.data-table th, table.data-table td { border: 1px solid #000; padding: 6px 8px; vertical-align: top; }
    table.data-table th { background-color: #f0f0f0; text-align: center; font-weight: bold; text-transform: uppercase; font-size: 9pt; }
    table.data-table tfoot td { font-weight: bold; background-color: #f9f9f9; }
    
    .text-center { text-align: center; }
    .text-right { text-align: right; }
    .description-box { border: 1px solid #ccc; padding: 10px 14px; background: #fafafa; border-radius: 4px; font-size: 10pt; line-height: 1.6; }
    
    /* Signatures */
    .signature-block { margin-top: 40px; width: 100%; border-collapse: collapse; page-break-inside: avoid; }
    .sig-column { text-align: center; width: 33.33%; vertical-align: top; }
    .sig-space { height: 65px; }
    .sig-name { font-weight: bold; text-decoration: underline; margin-bottom: 2px; }
    
  </style>
</head>
<body>

  <div class="page-container">
    <!-- Kop Surat: Logo BEM di KIRI, Logo Kampus INAR di KANAN -->
    <table class="kop-surat"><tr>
      <td style="width: 16%; text-align: left;"><img src="<?php echo $logo_bem; ?>" alt="Logo BEM" class="kop-logo kop-logo-bem"></td>
      <td class="kop-text" style="width: 68%;">
        <h3>BADAN EKSEKUTIF MAHASISWA</h3>
        <h2>INSTITUT ILMU KESEHATAN DAN TEKNOLOGI NURDIN ABDURRAHMAN</h2>
        <p>Sekretariat: Gedung Student Center Lt. 2, Sigli, Kab. Pidie, Aceh</p>
        <p>Email: bem@inar.ac.id | Website: www.bem-inar.ac.id</p>
      </td>
      <td style="width: 16%; text-align: right;"><img src="<?php echo $logo_inar; ?>" alt="Logo Kampus INAR" class="kop-logo kop-logo-kampus"></td>
    </tr></table>

    <div class="doc-title">
      <h4>LAPORAN PERTANGGUNGJAWABAN (LPJ) KEGIATAN</h4>
      <p>ID Kegiatan: #BEM-<?php echo str_pad($kegiatan->id_kegiatan, 4, '0', STR_PAD_LEFT); ?></p>
    </div>

    <!-- Section 1: Info Kegiatan -->
    <div class="section-header">I. DESKRIPSI &amp; INFORMASI KEGIATAN</div>
    <table class="info-table">
      <tr>
        <td class="label">Nama Kegiatan</td>
        <td class="colon">:</td>
        <td><strong><?php echo html_escape($kegiatan->nama_kegiatan); ?></strong></td>
      </tr>
      <tr>
        <td class="label">Periode &amp; Semester</td>
        <td class="colon">:</td>
        <td>Tahun Akademik <?php echo html_escape($kegiatan->periode_tahun ? $kegiatan->periode_tahun : '-'); ?> (Semester <?php echo html_escape($kegiatan->semester ? $kegiatan->semester : '-'); ?>)</td>
      </tr>
      <tr>
        <td class="label">Tanggal Pelaksanaan</td>
        <td class="colon">:</td>
        <td><?php echo date('d F Y', strtotime($kegiatan->tanggal)); ?></td>
      </tr>
      <tr>
        <td class="label">Lokasi Kegiatan</td>
        <td class="colon">:</td>
        <td><?php echo html_escape($kegiatan->lokasi ? $kegiatan->lokasi : '-'); ?></td>
      </tr>
    </table>

    <div style="margin-top: 8px;">
      <strong>Detail / Ringkasan Acara:</strong>
      <div class="description-box" style="margin-top: 5px;">
        <?php echo !empty($kegiatan->deskripsi) ? $kegiatan->deskripsi : '<i>Tidak ada deskripsi rinci.</i>'; ?>
      </div>
    </div>

    <!-- Section 2: Kepanitiaan -->
    <div class="section-header">II. SUSUNAN PANITIA PELAKSANA</div>
    <?php if (!empty($kepanitiaan)): ?>
      <table class="data-table">
        <thead>
          <tr>
            <th style="width: 8%;">No</th>
            <th style="width: 50%;">Nama Panitia</th>
            <th style="width: 42%;">Jabatan</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; foreach ($kepanitiaan as $panitia): ?>
          <tr>
            <td class="text-center"><?php echo $no++; ?></td>
            <td><?php echo html_escape($panitia->nama_panitia); ?></td>
            <td><?php echo html_escape($panitia->jabatan); ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php else: ?>
      <p style="font-style: italic; color: #666;">Belum ada susunan panitia terdaftar.</p>
    <?php endif; ?>

    <!-- Section 3: Keuangan -->
    <div class="section-header">III. RINCIAN ANGGARAN &amp; REALISASI KEUANGAN</div>
    <?php if (!empty($keuangan)): $totalKeuangan = 0; ?>
      <table class="data-table">
        <thead>
          <tr>
            <th style="width: 5%;">No</th>
            <th style="width: 15%;">Tanggal</th>
            <th style="width: 38%;">Keterangan</th>
            <th style="width: 10%;">Jumlah</th>
            <th style="width: 16%;">Harga (Rp)</th>
            <th style="width: 16%;">Subtotal (Rp)</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; foreach ($keuangan as $item): 
            $subtotal = (int)$item->jumlah * (float)$item->harga;
            $totalKeuangan += $subtotal;
          ?>
          <tr>
            <td class="text-center"><?php echo $no++; ?></td>
            <td class="text-center"><?php echo date('d/m/Y', strtotime($item->tanggal)); ?></td>
            <td><?php echo html_escape($item->keterangan); ?></td>
            <td class="text-center"><?php echo number_format($item->jumlah, 0, ',', '.'); ?></td>
            <td class="text-right"><?php echo number_format($item->harga, 0, ',', '.'); ?></td>
            <td class="text-right"><?php echo number_format($subtotal, 0, ',', '.'); ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="5" class="text-right">TOTAL PENGELUARAN KEUANGAN:</td>
            <td class="text-right"><strong>Rp <?php echo number_format($totalKeuangan, 0, ',', '.'); ?></strong></td>
          </tr>
        </tfoot>
      </table>
    <?php else: ?>
      <p style="font-style: italic; color: #666;">Belum ada rincian keuangan terdaftar.</p>
    <?php endif; ?>

    <!-- Signature Block -->
    <table class="signature-block"><tr>
      <td class="sig-column">
        <p>Ketua Pelaksana</p>
        <div class="sig-space"></div>
        <p class="sig-name">( ........................................ )</p>
        <p style="font-size: 8.5pt; margin:0;">NIM. ........................................</p>
      </td>
      <td class="sig-column">
        <p>Bendahara BEM</p>
        <div class="sig-space"></div>
        <p class="sig-name">( ........................................ )</p>
        <p style="font-size: 8.5pt; margin:0;">NIM. ........................................</p>
      </td>
      <td class="sig-column">
        <p>Sigli, <?php echo date('d F Y'); ?><br>Mengetahui,<br>Ketua BEM</p>
        <div class="sig-space"></div>
        <p class="sig-name">( ........................................ )</p>
        <p style="font-size: 8.5pt; margin:0;">NIM. ........................................</p>
      </td>
    </tr></table>
  </div>
</body>
</html>
