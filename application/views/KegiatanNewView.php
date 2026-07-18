<!DOCTYPE html>
<html lang="en" data-bs-theme="auto">
  <head>
    <link href="
			
			<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js"></script>
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
              <a class="nav-link" href="<?php echo base_url(); ?>index.php/root/kegiatan">Kegiatan</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url(); ?>index.php/root/kepanitiaan">kepanitian</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url(); ?>index.php/root/keuangan">Keuangan</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <main class="container">
      <form method="post" action="<?php echo base_url(); ?>index.php/root/kegiatan" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Nama Kegiatan</label>
            <input type="text" name="nama_kegiatan" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Tanggal</label>
            <input type="date" name="tanggal" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Lokasi</label>
            <input type="text" name="lokasi" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label" for="foto">Foto Thumbnail</label>
            <input type="file" name="foto" id="foto" class="form-control" accept="image/jpeg,image/png">
            <div class="form-text">Format JPG atau PNG. Ukuran maksimal 2 MB.</div>
        </div>
        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    </main>
    <script src="
				<?php echo base_url(); ?>assets/js/bootstrap.min.js">
    </script>
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
