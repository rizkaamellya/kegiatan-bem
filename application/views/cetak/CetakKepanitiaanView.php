<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title><?php echo html_escape($title); ?></title>
  <style>
    @page { size: A4 portrait; margin: 1.5cm 1.8cm; }
    * { box-sizing: border-box; font-family: "Times New Roman", Times, serif; }
    body { margin: 0; padding: 0; background: #f8f9fa; color: #000; font-size: 11pt; line-height: 1.5; }
    .print-actions { background: #1a252f; padding: 12px; text-align: center; margin-bottom: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.15); }
    .btn-print { background: #27ae60; color: #fff; border: none; padding: 8px 18px; font-size: 14px; font-weight: bold; border-radius: 4px; cursor: pointer; text-decoration: none; display: inline-block; margin-right: 10px; }
    .btn-print:hover { background: #219150; }
    .btn-back { background: #7f8c8d; color: #fff; border: none; padding: 8px 18px; font-size: 14px; font-weight: bold; border-radius: 4px; cursor: pointer; text-decoration: none; display: inline-block; }
    .page-container { background: #fff; width: 210mm; min-height: 297mm; margin: 0 auto; padding: 25mm 20mm; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
    
    /* Kop Surat */
    .kop-surat { display: flex; align-items: center; justify-content: space-between; border-bottom: 3px double #000; padding-bottom: 12px; margin-bottom: 20px; }
    .kop-logo { object-fit: contain; }
    .kop-logo-bem { width: 85px; height: 85px; }
    .kop-logo-kampus { width: 85px; height: 85px; }
    .kop-text { text-align: center; flex-grow: 1; padding: 0 15px; }
    .kop-text h3 { margin: 0; font-size: 11pt; text-transform: uppercase; font-weight: normal; }
    .kop-text h2 { margin: 2px 0; font-size: 13pt; text-transform: uppercase; font-weight: bold; color: #064f3a; }
    .kop-text p { margin: 0; font-size: 9pt; font-family: Arial, sans-serif; color: #333; }
    
    .doc-title { text-align: center; margin-bottom: 20px; }
    .doc-title h4 { margin: 0; font-size: 13pt; text-transform: uppercase; text-decoration: underline; }
    .doc-title p { margin: 2px 0 0; font-size: 9.5pt; font-family: Arial, sans-serif; color: #555; }
    
    table.data-table { width: 100%; border-collapse: collapse; margin-top: 15px; font-size: 10.5pt; }
    table.data-table th, table.data-table td { border: 1px solid #000; padding: 7px 10px; vertical-align: top; }
    table.data-table th { background-color: #f0f0f0; text-align: center; font-weight: bold; text-transform: uppercase; font-size: 9.5pt; }
    
    .text-center { text-align: center; }
    
    /* Signatures */
    .signature-block { margin-top: 50px; display: flex; justify-content: space-between; page-break-inside: avoid; }
    .sig-column { text-align: center; width: 40%; }
    .sig-space { height: 70px; }
    .sig-name { font-weight: bold; text-decoration: underline; margin-bottom: 2px; }
    
    .btn-add-row { background: #2980b9; color: #fff; border: none; padding: 8px 14px; font-size: 13px; font-weight: bold; border-radius: 4px; cursor: pointer; margin-right: 6px; }
    .btn-add-row:hover { background: #1c5980; }
    .btn-del-row { background: #c0392b; color: #fff; border: none; padding: 8px 14px; font-size: 13px; font-weight: bold; border-radius: 4px; cursor: pointer; margin-right: 6px; }
    .btn-del-row:hover { background: #962d22; }
    .btn-add-text { background: #8e44ad; color: #fff; border: none; padding: 8px 14px; font-size: 13px; font-weight: bold; border-radius: 4px; cursor: pointer; margin-right: 6px; }
    .btn-add-text:hover { background: #6c3483; }
    .btn-edit { background: #f39c12; color: #fff; border: none; padding: 8px 14px; font-size: 13px; font-weight: bold; border-radius: 4px; cursor: pointer; margin-right: 6px; }
    .btn-edit:hover { background: #d68910; }
    .btn-reset { background: #7f8c8d; color: #fff; border: none; padding: 8px 14px; font-size: 13px; font-weight: bold; border-radius: 4px; cursor: pointer; margin-right: 6px; }
    .btn-reset:hover { background: #616a6b; }
    .edit-hint { color: #f1c40f; font-size: 12px; margin-top: 8px; font-family: Arial, sans-serif; }
    
    [contenteditable="true"]:hover {
      outline: 1px dashed #f39c12 !important;
      background-color: rgba(254, 249, 231, 0.6) !important;
      cursor: text;
    }
    [contenteditable="true"]:focus {
      outline: 2px solid #27ae60 !important;
      background-color: #fffde7 !important;
    }
    
    @media print {
      .print-actions, .edit-hint { display: none !important; }
      body { background: none; }
      .page-container { box-shadow: none; width: 100%; padding: 0; margin: 0; min-height: auto; outline: none !important; background: none !important; }
      [contenteditable="true"] { outline: none !important; background: none !important; }
    }
    /* Layout PDF */
    body { background: #fff; font-size: 10.5pt; }
    .page-container { width: 100%; min-height: 0; margin: 0; padding: 0; box-shadow: none; }
    .kop-surat { display: table; width: 100%; border-collapse: collapse; padding-bottom: 10px; margin-bottom: 16px; }
    .kop-surat td { vertical-align: middle; }
    .kop-logo { display: inline-block; }
    .kop-logo-bem { width: 80px; height: 80px; }
    .kop-logo-kampus { width: 136px; height: 80px; }
    .kop-text { text-align: center; padding: 0 15px; }
    .doc-title { margin-bottom: 16px; }
    table.data-table { margin-top: 10px; font-size: 10pt; }
    .signature-block { display: table; width: 100%; margin-top: 22px; border-collapse: collapse; page-break-inside: avoid; }
    .sig-column { width: 50%; text-align: center; vertical-align: top; }
    .sig-title { height: 42px; margin: 0; line-height: 1.35; }
    .sig-space { height: 38px; }
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
      <h4>LAPORAN DAFTAR STRUKTUR KEPANITIAAN BEM</h4>
      <p>Filter: <?php echo html_escape($nama_filter_kegiatan); ?> | Dicetak: <?php echo date('d F Y, H:i'); ?> WIB</p>
    </div>

    <table class="data-table">
      <thead>
        <tr>
          <th style="width: 7%;">No</th>
          <th style="width: 35%;">Nama Panitia</th>
          <th style="width: 28%;">Jabatan Panitia</th>
          <th style="width: 30%;">Kegiatan</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($kepanitiaan)): ?>
          <?php $no = 1; foreach ($kepanitiaan as $k): ?>
          <tr>
            <td class="text-center"><?php echo $no++; ?></td>
            <td><strong><?php echo html_escape($k->nama_panitia); ?></strong></td>
            <td><?php echo html_escape($k->jabatan); ?></td>
            <td><?php echo html_escape(!empty($k->nama_kegiatan) ? $k->nama_kegiatan : (isset($k->id_kegiatan) ? 'ID #'.$k->id_kegiatan : '-')); ?></td>
          </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="4" class="text-center">Belum ada data kepanitiaan.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>

    <table class="signature-block"><tr>
      <td class="sig-column">
        <p class="sig-title">Mengetahui,<br><strong>Ketua BEM</strong></p>
        <div class="sig-space"></div>
        <p class="sig-name">( ........................................ )</p>
        <p style="font-size: 9pt; margin:0;">NIM. ........................................</p>
      </td>
      <td class="sig-column">
        <p class="sig-title">Sigli, <?php echo date('d F Y'); ?><br><strong>Sekretaris Umum</strong></p>
        <div class="sig-space"></div>
        <p class="sig-name">( ........................................ )</p>
        <p style="font-size: 9pt; margin:0;">NIM. ........................................</p>
      </td>
    </tr></table>
  </div>
</body>
</html>
