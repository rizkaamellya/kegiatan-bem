<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Admin - BEM Kampus</title>
  <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
  <style>
    body{min-height:100vh;background:linear-gradient(135deg,#02382d,#08734d);display:flex;align-items:center;padding:24px}.login-card{width:100%;max-width:430px;margin:auto;border:0;border-radius:18px;box-shadow:0 24px 70px rgba(0,0,0,.28)}.brand-mark{width:58px;height:58px;margin:0 auto 14px;border-radius:50%;display:grid;place-items:center;background:#064f3a;color:#c8e879;font-weight:800;border:2px solid #a6ce39}.btn-login{background:#08734d;border-color:#08734d}.btn-login:hover{background:#064f3a;border-color:#064f3a}
  </style>
</head>
<body>
  <main class="card login-card">
    <div class="card-body p-4 p-md-5">
      <div class="brand-mark">BEM</div>
      <h1 class="h3 text-center mb-2">Login Admin</h1>
      <p class="text-secondary text-center mb-4">Masuk untuk mengelola kegiatan BEM.</p>

      <?php if ($this->session->flashdata('login_error')): ?>
        <div class="alert alert-danger" role="alert"><?php echo html_escape($this->session->flashdata('login_error')); ?></div>
      <?php endif; ?>

      <form method="post" action="<?php echo site_url('login'); ?>">
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input id="username" type="text" name="username" class="form-control form-control-lg" value="<?php echo html_escape((string) $this->session->flashdata('login_username')); ?>" autocomplete="username" required autofocus>
        </div>
        <div class="mb-4">
          <label for="password" class="form-label">Password</label>
          <input id="password" type="password" name="password" class="form-control form-control-lg" autocomplete="current-password" required>
        </div>
        <button type="submit" class="btn btn-primary btn-login btn-lg w-100">Masuk</button>
      </form>
      <a href="<?php echo site_url(); ?>" class="d-block text-center mt-4 text-decoration-none">← Kembali ke halaman depan</a>
    </div>
  </main>
</body>
</html>
