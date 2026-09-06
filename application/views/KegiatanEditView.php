<!DOCTYPE html>
<html lang="en" data-bs-theme="auto">
  <head>
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js"></script>
  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
      <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center gap-2" href="#"><img src="<?php echo base_url('assets/images/logo-bem.png'); ?>" alt="Logo BEM" style="height:32px; width:32px; object-fit:contain; border-radius:50%; background:#fff; padding:1px;"> Sistem Informasi Pengelolaan Kegiatan BEM INAR</a>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav me-auto mb-2 mb-md-0">
            <li class="nav-item"><a class="nav-link active" href="<?php echo base_url(); ?>index.php/root/kegiatan">Kegiatan</a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>index.php/root/kepanitiaan">Kepanitiaan</a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>index.php/root/keuangan">Keuangan</a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>index.php/root/rekap">📊 Rekap Data</a></li>
            <li class="nav-item"><a class="nav-link text-warning fw-bold" href="<?php echo base_url(); ?>index.php/root/cetak">🖨️ Cetak Laporan</a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>index.php/root/admin">Admin</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <main class="container">
      <?php $k = !empty($kegiatan) ? $kegiatan[0] : null; ?>
      <h3 class="text-center mb-4">Edit Kegiatan</h3>
      <?php if ($k) { ?>
      <form method="post" action="<?php echo base_url(); ?>index.php/root/kegiatan/update" enctype="multipart/form-data">
        <input type="hidden" name="id_kegiatan" value="<?php echo $k->id_kegiatan; ?>">
        <div class="mb-3">
          <label class="form-label fw-semibold">Nama Kegiatan</label>
          <input type="text" name="nama_kegiatan" class="form-control" value="<?php echo html_escape($k->nama_kegiatan); ?>" required>
        </div>
        <div class="row">
          <div class="col-md-4 mb-3">
            <label class="form-label fw-semibold">Tanggal Kegiatan</label>
            <input type="date" name="tanggal" class="form-control" value="<?php echo html_escape($k->tanggal); ?>" required>
          </div>
          <div class="col-md-4 mb-3">
            <label class="form-label fw-semibold">Periode Tahun / Tahun Akademik</label>
            <input type="text" name="periode_tahun" class="form-control" list="listPeriode" value="<?php echo html_escape($k->periode_tahun); ?>" placeholder="Contoh: 2025/2026 atau 2026">
            <datalist id="listPeriode">
              <?php 
                $currY = (int)date('Y');
                $opts = array(($currY-1).'/'.$currY, $currY.'/'.($currY+1), ($currY+1).'/'.($currY+2), (string)$currY, (string)($currY+1));
                if (!empty($daftar_periode)) { $opts = array_unique(array_merge($opts, $daftar_periode)); }
                foreach ($opts as $opt): 
              ?>
                <option value="<?php echo html_escape($opt); ?>">
              <?php endforeach; ?>
            </datalist>
          </div>
          <div class="col-md-4 mb-3">
            <label class="form-label fw-semibold">Semester</label>
            <select name="semester" class="form-select">
              <option value="Ganjil" <?php echo ($k->semester == 'Ganjil') ? 'selected' : ''; ?>>Semester Ganjil</option>
              <option value="Genap" <?php echo ($k->semester == 'Genap') ? 'selected' : ''; ?>>Semester Genap</option>
            </select>
          </div>
        </div>
        <div class="mb-3">
          <label class="form-label fw-semibold">Lokasi</label>
          <input type="text" name="lokasi" class="form-control" value="<?php echo html_escape($k->lokasi); ?>">
        </div>
        <div class="mb-3">
          <label class="form-label" for="foto">Foto Thumbnail</label>
          <?php if (!empty($k->foto)) { ?>
          <div class="mb-2">
            <img src="<?php echo base_url('uploads/kegiatan/' . rawurlencode($k->foto)); ?>" alt="Thumbnail <?php echo html_escape($k->nama_kegiatan); ?>" class="img-thumbnail" style="width: 180px; height: 110px; object-fit: cover;">
          </div>
          <?php } ?>
          <input type="file" name="foto" id="foto" class="form-control" accept="image/jpeg,image/png">
          <div class="form-text">Kosongkan jika tidak ingin mengganti foto. Maksimal 2 MB.</div>
        </div>
        <div class="mb-3">
          <label class="form-label">Deskripsi</label>
          <textarea name="deskripsi" id="deskripsi" class="form-control"><?php echo html_escape($k->deskripsi); ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="<?php echo base_url(); ?>index.php/root/kegiatan" class="btn btn-secondary">Batal</a>
      </form>
      <?php } else { ?>
      <div class="alert alert-warning">Data kegiatan tidak ditemukan.</div>
      <?php } ?>
    </main>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script>
      var editorUploadUrl = '<?php echo base_url(); ?>index.php/root/kegiatan/upload-editor';

      function uploadEditorFile(file) {
        var formData = new FormData();
        formData.append('file', file);

        return fetch(editorUploadUrl, {
          method: 'POST',
          body: formData
        }).then(function (response) {
          if (!response.ok) {
            throw new Error('Upload gagal');
          }
          return response.json();
        }).then(function (data) {
          return data.location;
        });
      }

      tinymce.init({
        selector: '#deskripsi',
        height: 360,
        menubar: false,
        plugins: 'link image lists table code',
        toolbar: 'undo redo | blocks | bold italic underline | bullist numlist | link image pdfupload | table | code',
        skin_url: 'https://cdn.jsdelivr.net/npm/tinymce@6/skins/ui/oxide',
        content_css: 'https://cdn.jsdelivr.net/npm/tinymce@6/skins/content/default/content.min.css',
        automatic_uploads: true,
        file_picker_types: 'image file',
        images_upload_handler: function (blobInfo) {
          return uploadEditorFile(blobInfo.blob());
        },
        file_picker_callback: function (callback, value, meta) {
          var input = document.createElement('input');
          input.type = 'file';
          input.accept = meta.filetype === 'image' ? 'image/png,image/jpeg' : 'application/pdf';
          input.onchange = function () {
            var file = this.files[0];
            uploadEditorFile(file).then(function (url) {
              callback(url, { text: file.name, title: file.name });
            }).catch(function () {
              alert('Upload file gagal');
            });
          };
          input.click();
        },
        setup: function (editor) {
          editor.ui.registry.addButton('pdfupload', {
            text: 'PDF',
            tooltip: 'Upload PDF',
            onAction: function () {
              var input = document.createElement('input');
              input.type = 'file';
              input.accept = 'application/pdf';
              input.onchange = function () {
                var file = this.files[0];
                uploadEditorFile(file).then(function (url) {
                  editor.insertContent('<p><a href="' + url + '" target="_blank">' + file.name + '</a></p>');
                }).catch(function () {
                  alert('Upload PDF gagal');
                });
              };
              input.click();
            }
          });
        }
      });
    </script>
  </body>
</html>
