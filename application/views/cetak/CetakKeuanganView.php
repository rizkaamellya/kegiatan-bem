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
    
    table.data-table { width: 100%; border-collapse: collapse; margin-top: 15px; font-size: 10pt; }
    table.data-table th, table.data-table td { border: 1px solid #000; padding: 7px 9px; vertical-align: top; }
    table.data-table th { background-color: #f0f0f0; text-align: center; font-weight: bold; text-transform: uppercase; font-size: 9pt; }
    table.data-table tfoot td { font-weight: bold; background-color: #f9f9f9; }
    
    .text-center { text-align: center; }
    .text-right { text-align: right; }
    
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
  </style>
</head>
<body>

  <div class="print-actions">
    <button onclick="window.print();" class="btn-print">🖨️ Cetak / Simpan PDF</button>
    <button type="button" onclick="tambahBaris()" class="btn-add-row">➕ Tambah Baris Tabel</button>
    <button type="button" onclick="hapusBaris()" class="btn-del-row">🗑️ Hapus Baris</button>
    <button type="button" onclick="tambahTeks()" class="btn-add-text">📝 Tambah Paragraf</button>
    <button type="button" onclick="toggleEditMode()" id="btnToggleEdit" class="btn-edit">✏️ Mode Edit: AKTIF</button>
    <button type="button" onclick="location.reload()" class="btn-reset">↺ Reset Teks</button>
    <a href="<?php echo site_url('root/cetak'); ?>" class="btn-back">← Kembali</a>
    <div class="edit-hint">💡 <strong>Mode Edit Aktif:</strong> Anda dapat mengeklik &amp; mengedit SEMUA teks (Kop, Judul, Sel Tabel, Tanda Tangan, Nama, NIM) serta menambah/menghapus baris secara bebas!</div>
  </div>

  <div class="page-container" id="printableArea" contenteditable="true">
    <!-- Kop Surat: Logo BEM di KIRI, Logo Kampus INAR di KANAN -->
    <div class="kop-surat">
      <img src="<?php echo base_url('assets/images/logo-bem.png'); ?>" alt="Logo BEM" class="kop-logo kop-logo-bem">
      <div class="kop-text">
        <h3>BADAN EKSEKUTIF MAHASISWA</h3>
        <h2>INSTITUT ILMU KESEHATAN DAN TEKNOLOGI NURDIN ABDURRAHMAN</h2>
        <p>Sekretariat: Gedung Student Center Lt. 2, Sigli, Kab. Pidie, Aceh</p>
        <p>Email: bem@inar.ac.id | Website: www.bem-inar.ac.id</p>
      </div>
      <img src="<?php echo base_url('assets/images/logo-inar.png'); ?>" alt="Logo Kampus INAR" class="kop-logo kop-logo-kampus">
    </div>

    <div class="doc-title">
      <h4>REKAPITULASI LAPORAN KEUANGAN BEM</h4>
      <p>Filter: <?php echo html_escape($nama_filter_kegiatan); ?> | Dicetak: <?php echo date('d F Y, H:i'); ?> WIB</p>
    </div>

    <table class="data-table">
      <thead>
        <tr>
          <th style="width: 5%;">No</th>
          <th style="width: 15%;">Tanggal</th>
          <th style="width: 25%;">Kegiatan</th>
          <th style="width: 25%;">Keterangan</th>
          <th style="width: 8%;">Jumlah</th>
          <th style="width: 11%;">Harga (Rp)</th>
          <th style="width: 11%;">Subtotal (Rp)</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($keuangan)): $totalSeluruh = 0; ?>
          <?php $no = 1; foreach ($keuangan as $k): 
            $subtotal = (int)$k->jumlah * (float)$k->harga;
            $totalSeluruh += $subtotal;
          ?>
          <tr>
            <td class="text-center"><?php echo $no++; ?></td>
            <td class="text-center"><?php echo date('d/m/Y', strtotime($k->tanggal)); ?></td>
            <td><?php echo html_escape(!empty($k->nama_kegiatan) ? $k->nama_kegiatan : (isset($k->id_kegiatan) ? 'ID #'.$k->id_kegiatan : '-')); ?></td>
            <td><?php echo html_escape($k->keterangan); ?></td>
            <td class="text-center"><?php echo number_format($k->jumlah, 0, ',', '.'); ?></td>
            <td class="text-right"><?php echo number_format($k->harga, 0, ',', '.'); ?></td>
            <td class="text-right"><?php echo number_format($subtotal, 0, ',', '.'); ?></td>
          </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="7" class="text-center">Belum ada data keuangan.</td>
          </tr>
        <?php endif; ?>
      </tbody>
      <?php if (!empty($keuangan)): ?>
      <tfoot>
        <tr>
          <td colspan="6" class="text-right">GRAND TOTAL KEUANGAN:</td>
          <td class="text-right"><strong>Rp <?php echo number_format($totalSeluruh, 0, ',', '.'); ?></strong></td>
        </tr>
      </tfoot>
      <?php endif; ?>
    </table>

    <div class="signature-block">
      <div class="sig-column">
        <p>Mengetahui,<br><strong>Ketua BEM</strong></p>
        <div class="sig-space"></div>
        <p class="sig-name">( ........................................ )</p>
        <p style="font-size: 9pt; margin:0;">NIM. ........................................</p>
      </div>
      <div class="sig-column">
        <p>Sigli, <?php echo date('d F Y'); ?><br><strong>Bendahara Umum</strong></p>
        <div class="sig-space"></div>
        <p class="sig-name">( ........................................ )</p>
        <p style="font-size: 9pt; margin:0;">NIM. ........................................</p>
      </div>
    </div>
  </div>

  <script>
    function makeEverythingEditable() {
      const area = document.getElementById('printableArea');
      if (!area) return;
      area.setAttribute('contenteditable', 'true');
      const nodes = area.querySelectorAll('p, h1, h2, h3, h4, h5, td, th, span, div, strong');
      nodes.forEach(el => el.setAttribute('contenteditable', 'true'));
    }

    let isEditMode = true;
    function toggleEditMode() {
      const area = document.getElementById('printableArea');
      const btn = document.getElementById('btnToggleEdit');
      isEditMode = !isEditMode;
      const nodes = area.querySelectorAll('[contenteditable]');
      nodes.forEach(el => el.setAttribute('contenteditable', isEditMode ? 'true' : 'false'));
      area.setAttribute('contenteditable', isEditMode ? 'true' : 'false');
      
      if (isEditMode) {
        btn.innerHTML = '✏️ Mode Edit: AKTIF';
        btn.style.background = '#f39c12';
      } else {
        btn.innerHTML = '🔒 Mode Edit: NONAKTIF';
        btn.style.background = '#95a5a6';
      }
    }

    function tambahBaris() {
      const tbody = document.querySelector('#printableArea table.data-table tbody');
      if (!tbody) return;
      const colCount = document.querySelectorAll('#printableArea table.data-table th').length || 7;
      const rowCount = tbody.querySelectorAll('tr').length + 1;
      const tr = document.createElement('tr');
      
      let cellsHTML = `<td class="text-center" contenteditable="true">${rowCount}</td>`;
      for (let i = 1; i < colCount; i++) {
        cellsHTML += `<td contenteditable="true">Data Baru ${i}</td>`;
      }
      tr.innerHTML = cellsHTML;
      tbody.appendChild(tr);
      makeEverythingEditable();
    }

    function hapusBaris() {
      const tbody = document.querySelector('#printableArea table.data-table tbody');
      if (!tbody) return;
      const rows = tbody.querySelectorAll('tr');
      if (rows.length > 0) {
        rows[rows.length - 1].remove();
      }
    }

    function tambahTeks() {
      const area = document.getElementById('printableArea');
      if (!area) return;
      const p = document.createElement('p');
      p.setAttribute('contenteditable', 'true');
      p.style.marginTop = '15px';
      p.style.fontSize = '11pt';
      p.innerText = 'Tulis catatan atau informasi tambahan di sini...';
      const sigBlock = area.querySelector('.signature-block');
      if (sigBlock) {
        area.insertBefore(p, sigBlock);
      } else {
        area.appendChild(p);
      }
    }

    document.addEventListener('DOMContentLoaded', makeEverythingEditable);
    makeEverythingEditable();
  </script>
</body>
</html>
