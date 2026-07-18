<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Kegiatan — BEM Kampus</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@600;700;800&display=swap" rel="stylesheet">
  <style>
    :root{--green:#064f3a;--green-2:#08734d;--lime:#a6ce39;--cream:#f5f7f3;--ink:#17372d;--muted:#65766f;--line:#dce6df;--shadow:0 18px 45px rgba(2,58,42,.13)}
    *{box-sizing:border-box}body{margin:0;background:var(--cream);color:var(--ink);font-family:'DM Sans',sans-serif}a{text-decoration:none;color:inherit}.wrap{width:min(1160px,calc(100% - 40px));margin:auto}
    header{background:#033d2f;color:#fff}.nav{height:78px;display:flex;align-items:center;justify-content:space-between}.brand{display:flex;align-items:center;gap:12px}.mark{width:45px;height:45px;border:2px solid var(--lime);border-radius:50%;display:grid;place-items:center;font:800 18px Manrope}.brand b{font:800 19px Manrope}.links{display:flex;align-items:center;gap:28px;font-size:12px;font-weight:700}.links a:hover,.links .active{color:#c8e879}.login{border:1px solid #fff;border-radius:25px;padding:10px 17px}
    .heading{padding:65px 0 52px;background:linear-gradient(120deg,#064f3a,#08734d);color:#fff}.heading small{color:#c8e879;font-weight:700;letter-spacing:1.5px}.heading h1{font:800 clamp(35px,5vw,54px) Manrope;margin:10px 0}.heading p{margin:0;color:rgba(255,255,255,.78);max-width:600px;line-height:1.7}
    main{padding:65px 0 85px}.grid{display:grid;grid-template-columns:repeat(3,1fr);gap:28px}.card{background:#fff;border:1px solid var(--line);border-radius:13px;overflow:hidden;box-shadow:0 10px 28px rgba(25,72,56,.07);transition:.25s}.card:hover{transform:translateY(-6px);box-shadow:var(--shadow)}.photo{height:220px;background:#dce6df url('<?php echo base_url('assets/images/hero-bem.png'); ?>') center/cover no-repeat}.photo img{width:100%;height:100%;object-fit:cover}.body{padding:24px 27px 27px}.body h2{font:700 20px/1.35 Manrope;margin:0 0 14px;color:#182c26}.meta{display:flex;gap:9px;flex-wrap:wrap;color:var(--muted);font-size:11px;text-transform:uppercase}.meta span+span:before{content:'•';margin-right:9px}.body p{color:var(--muted);font-size:13px;line-height:1.65;margin:15px 0 18px}.read{color:var(--green-2);font-size:12px;font-weight:800}.empty{grid-column:1/-1;text-align:center;background:#fff;padding:50px;border-radius:12px;color:var(--muted)}
    footer{padding:25px 0;background:#02382d;color:rgba(255,255,255,.7);font-size:12px;text-align:center}
    @media(max-width:850px){.grid{grid-template-columns:repeat(2,1fr)}.links a:not(.active):not(.login){display:none}}@media(max-width:570px){.wrap{width:calc(100% - 28px)}.grid{grid-template-columns:1fr}.heading{padding:45px 0}.photo{height:210px}.brand b{font-size:16px}.login{padding:8px 12px}}
  </style>
</head>
<body>
<header><div class="wrap nav"><a class="brand" href="<?php echo base_url(); ?>"><span class="mark">BEM</span><b>BEM KAMPUS</b></a><nav class="links"><a href="<?php echo base_url(); ?>">BERANDA</a><a class="active" href="<?php echo site_url('kegiatan'); ?>">KEGIATAN</a><a class="login" href="<?php echo site_url('login'); ?>">LOGIN ADMIN</a></nav></div></header>
<section class="heading"><div class="wrap"><small>KABAR &amp; AGENDA</small><h1>Kegiatan BEM</h1><p>Ikuti kabar terbaru, agenda, dan berbagai program BEM yang memberi dampak bagi mahasiswa dan masyarakat.</p></div></section>
<main><div class="wrap"><div class="grid">
  <?php foreach ($kegiatan as $k) { $ringkasan = trim(strip_tags($k->deskripsi)); ?>
  <article class="card"><a href="<?php echo site_url('kegiatan/' . $k->id_kegiatan); ?>">
    <div class="photo"><?php if (!empty($k->foto)) { ?><img src="<?php echo base_url('uploads/kegiatan/' . rawurlencode($k->foto)); ?>" alt="<?php echo html_escape($k->nama_kegiatan); ?>"><?php } ?></div>
    <div class="body"><h2><?php echo html_escape($k->nama_kegiatan); ?></h2><div class="meta"><span><?php echo date('d-m-Y', strtotime($k->tanggal)); ?></span><?php if (!empty($k->lokasi)) { ?><span><?php echo html_escape($k->lokasi); ?></span><?php } ?></div><p><?php echo html_escape($ringkasan ? substr($ringkasan, 0, 135) : 'Informasi selengkapnya mengenai kegiatan BEM.'); ?></p><span class="read">SELENGKAPNYA →</span></div>
  </a></article>
  <?php } ?>
  <?php if (empty($kegiatan)) { ?><div class="empty">Belum ada kegiatan yang dipublikasikan.</div><?php } ?>
</div></div></main>
<footer><div class="wrap">© <?php echo date('Y'); ?> BEM Kampus. All Rights Reserved.</div></footer>
</body>
</html>
