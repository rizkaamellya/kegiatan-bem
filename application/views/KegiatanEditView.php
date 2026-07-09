<!DOCTYPE html>
<html lang="en" data-bs-theme="auto">
  <head>
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js"></script>
  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Sistem Informasi Pengelolaan Kegiatan BEM INAR</a>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav me-auto mb-2 mb-md-0">
            <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>index.php/kegiatan">Kegiatan</a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>index.php/kepanitiaan">Kepanitiaan</a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>index.php/keuangan">Keuangan</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <main class="container">
      <?php $k = !empty($kegiatan) ? $kegiatan[0] : null; ?>
      <h3 class="text-center mb-4">Edit Kegiatan</h3>
      <?php if ($k) { ?>
      <form method="post" action="<?php echo base_url(); ?>index.php/kegiatan/update" enctype="multipart/form-data">
        <input type="hidden" name="id_kegiatan" value="<?php echo $k->id_kegiatan; ?>">
        <div class="mb-3">
          <label class="form-label">Nama Kegiatan</label>
          <input type="text" name="nama_kegiatan" class="form-control" value="<?php echo html_escape($k->nama_kegiatan); ?>">
        </div>
        <div class="mb-3">
          <label class="form-label">Tanggal</label>
          <input type="date" name="tanggal" class="form-control" value="<?php echo html_escape($k->tanggal); ?>" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Lokasi</label>
          <input type="text" name="lokasi" class="form-control" value="<?php echo html_escape($k->lokasi); ?>">
        </div>
        <div class="mb-3">
          <label class="form-label">Deskripsi</label>
          <textarea name="deskripsi" id="deskripsi" class="form-control"><?php echo html_escape($k->deskripsi); ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="<?php echo base_url(); ?>index.php/kegiatan" class="btn btn-secondary">Batal</a>
      </form>
      <?php } else { ?>
      <div class="alert alert-warning">Data kegiatan tidak ditemukan.</div>
      <?php } ?>
    </main>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script>
      var editorUploadUrl = '<?php echo base_url(); ?>index.php/kegiatan/upload-editor';

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
