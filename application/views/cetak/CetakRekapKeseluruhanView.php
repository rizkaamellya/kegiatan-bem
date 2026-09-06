<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title><?php echo html_escape($title); ?></title>
  <style>
    @page { size: A4 landscape; margin: 1.2cm 1.5cm; }
    * { box-sizing: border-box; font-family: "Times New Roman", Times, serif; }
    body { margin: 0; padding: 0; color: #000; font-size: 11pt; line-height: 1.4; }
    .page-container { width: 100%; margin: 0; padding: 0; }
    
    /* Kop Surat */
    .kop-surat { width: 100%; border-bottom: 3px double #000; padding-bottom: 10px; margin-bottom: 16px; border-collapse: collapse; }
    .kop-surat td { vertical-align: middle; }
    .kop-logo { display: inline-block; }
    .kop-logo-bem { width: 80px; height: 80px; }
    .kop-logo-kampus { width: 136px; height: 80px; }
    .kop-text { text-align: center; padding: 0 15px; }
    .kop-text h3 { margin: 0; font-size: 12pt; text-transform: uppercase; font-weight: normal; letter-spacing: 0.5px; }
    .kop-text h2 { margin: 2px 0; font-size: 14pt; text-transform: uppercase; font-weight: bold; color: #064f3a; }
    .kop-text p { margin: 0; font-size: 9pt; font-family: Arial, sans-serif; color: #333; }
    
    .doc-title { text-align: center; margin-bottom: 18px; }
    .doc-title h4 { margin: 0; font-size: 13.5pt; text-transform: uppercase; text-decoration: underline; letter-spacing: 0.5px; }
    .doc-title p { margin: 3px 0 0; font-size: 9.5pt; font-family: Arial, sans-serif; color: #444; }
    
    .summary-bar { width: 100%; border-collapse: collapse; background-color: #f1f8f4; border: 1px solid #c2e0d1; margin-bottom: 15px; font-size: 10pt; font-family: Arial, sans-serif; }
    .summary-bar td { width: 33.33%; padding: 8px 12px; vertical-align: middle; }
    
    table.data-table { width: 100%; border-collapse: collapse; margin-top: 10px; font-size: 9.5pt; }
    table.data-table th, table.data-table td { border: 1px solid #000; padding: 6px 8px; vertical-align: middle; }
    table.data-table th { background-color: #f0f0f0; text-align: center; font-weight: bold; text-transform: uppercase; font-size: 9pt; }
    table.data-table tfoot td { font-weight: bold; background-color: #f7f7f7; }
    
    .text-center { text-align: center; }
    .text-right { text-align: right; }
    
    /* Signatures */
    .signature-block { margin-top: 22px; width: 100%; border-collapse: collapse; page-break-inside: avoid; }
    .sig-column { text-align: center; width: 33.33%; vertical-align: top; }
    .sig-title { height: 42px; margin: 0; line-height: 1.35; }
    .sig-space { height: 38px; }
    .sig-name { font-weight: bold; text-decoration: underline; margin-bottom: 2px; }
    
  </style>
</head>
<body>

  <div class="page-container">
    <!-- Kop Surat: Logo BEM di KIRI, Logo Kampus INAR di KANAN -->
    <table class="kop-surat"><tr>
      <td style="width: 14%; text-align: left;"><img src="<?php echo $logo_bem; ?>" alt="Logo BEM" class="kop-logo kop-logo-bem"></td>
      <td class="kop-text" style="width: 64%;">
        <h3>BADAN EKSEKUTIF MAHASISWA</h3>
        <h2>INSTITUT ILMU KESEHATAN DAN TEKNOLOGI NURDIN ABDURRAHMAN</h2>
        <p>Sekretariat: Gedung Student Center Lt. 2, Sigli, Kab. Pidie, Aceh</p>
        <p>Email: bem@inar.ac.id | Website: www.bem-inar.ac.id</p>
      </td>
      <td style="width: 22%; text-align: right;"><img src="<?php echo $logo_inar; ?>" alt="Logo Kampus INAR" class="kop-logo kop-logo-kampus"></td>
    </tr></table>

    <div class="doc-title">
      <h4>LAPORAN REKAPITULASI KESELURUHAN DATA KEGIATAN BEM</h4>
      <p>
        Periode: <?php echo !empty($periode_tahun) ? 'Tahun Akademik ' . html_escape($periode_tahun) : 'Seluruh Tahun'; ?> | 
        Semester: <?php echo !empty($semester) ? 'Semester ' . html_escape($semester) : 'Semua Semester'; ?> | 
        Dicetak: <?php echo date('d F Y, H:i'); ?> WIB
      </p>
    </div>

    <table class="summary-bar"><tr>
      <td><strong>Total Kegiatan:</strong> <?php echo count($rekap); ?> Program</td>
      <td class="text-center"><strong>Total Panitia:</strong> <?php echo $total_panitia; ?> Orang</td>
      <td class="text-right"><strong>Total Biaya:</strong> Rp <?php echo number_format($total_biaya, 0, ',', '.'); ?></td>
    </tr></table>

    <table class="data-table">
      <thead>
        <tr>
          <th style="width: 4%;">No</th>
          <th style="width: 25%;">Nama Kegiatan</th>
          <th style="width: 14%;">Periode / Semester</th>
          <th style="width: 12%;">Tanggal</th>
          <th style="width: 17%;">Lokasi</th>
          <th style="width: 12%;">Jml Panitia</th>
          <th style="width: 16%;">Total Pengeluaran (Rp)</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($rekap)): ?>
          <?php $no = 1; foreach ($rekap as $r): ?>
          <tr>
            <td class="text-center"><?php echo $no++; ?></td>
            <td><strong><?php echo html_escape($r->nama_kegiatan); ?></strong></td>
            <td class="text-center"><?php echo html_escape($r->periode_tahun ? $r->periode_tahun : '-'); ?> (<?php echo html_escape($r->semester ? $r->semester : '-'); ?>)</td>
            <td class="text-center"><?php echo date('d/m/Y', strtotime($r->tanggal)); ?></td>
            <td><?php echo html_escape($r->lokasi ? $r->lokasi : '-'); ?></td>
            <td class="text-center"><?php echo $r->total_panitia; ?> Panitia</td>
            <td class="text-right"><?php echo number_format($r->total_biaya, 0, ',', '.'); ?></td>
          </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="7" class="text-center">Belum ada data kegiatan pada periode yang dipilih.</td>
          </tr>
        <?php endif; ?>
      </tbody>
      <tfoot>
        <tr>
          <td colspan="5" class="text-right">TOTAL KESELURUHAN:</td>
          <td class="text-center"><?php echo $total_panitia; ?> Panitia</td>
          <td class="text-right">Rp <?php echo number_format($total_biaya, 0, ',', '.'); ?></td>
        </tr>
      </tfoot>
    </table>

    <table class="signature-block"><tr>
      <td class="sig-column">
        <p class="sig-title">Mengetahui,<br><strong>Presiden / Ketua BEM</strong></p>
        <div class="sig-space"></div>
        <p class="sig-name">( ........................................ )</p>
        <p style="font-size: 9pt; margin:0;">NIM. ........................................</p>
      </td>
      <td class="sig-column">
        <p class="sig-title">Sigli, <?php echo date('d F Y'); ?><br><strong>Sekretaris Jenderal</strong></p>
        <div class="sig-space"></div>
        <p class="sig-name">( ........................................ )</p>
        <p style="font-size: 9pt; margin:0;">NIM. ........................................</p>
      </td>
      <td class="sig-column">
        <p class="sig-title">Sigli, <?php echo date('d F Y'); ?><br><strong>Bendahara Umum</strong></p>
        <div class="sig-space"></div>
        <p class="sig-name">( ........................................ )</p>
        <p style="font-size: 9pt; margin:0;">NIM. ........................................</p>
      </td>
    </tr></table>
  </div>
</body>
</html>
