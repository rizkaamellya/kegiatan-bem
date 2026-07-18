<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo html_escape($kegiatan->nama_kegiatan); ?> — BEM Kampus</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@600;700;800&display=swap" rel="stylesheet">
  <style>
    :root{--green:#064f3a;--lime:#a6ce39;--cream:#f5f7f3;--ink:#17372d;--muted:#65766f;--line:#dce6df}*{box-sizing:border-box}body{margin:0;background:var(--cream);color:var(--ink);font-family:'DM Sans',sans-serif}a{text-decoration:none;color:inherit}.wrap{width:min(1020px,calc(100% - 40px));margin:auto}
    header{background:#033d2f;color:#fff}.nav{height:78px;display:flex;align-items:center;justify-content:space-between}.brand{display:flex;align-items:center;gap:12px}.mark{width:45px;height:45px;border:2px solid var(--lime);border-radius:50%;display:grid;place-items:center;font:800 18px Manrope}.brand b{font:800 19px Manrope}.back{font-size:12px;font-weight:700;border:1px solid rgba(255,255,255,.7);border-radius:25px;padding:10px 16px}
    main{padding:55px 0 85px}.article{background:#fff;border:1px solid var(--line);border-radius:16px;overflow:hidden;box-shadow:0 18px 50px rgba(2,58,42,.1)}.hero{width:100%;height:min(480px,48vw);min-height:250px;object-fit:cover;background:#dce6df}.content{padding:45px 60px 55px}.eyebrow{color:#08734d;font-size:12px;font-weight:800;letter-spacing:1.2px}.content h1{font:800 clamp(30px,5vw,48px)/1.18 Manrope;margin:12px 0 18px;color:#142c24}.meta{display:flex;gap:12px;flex-wrap:wrap;color:var(--muted);font-size:13px;padding-bottom:25px;border-bottom:1px solid var(--line)}.meta span+span:before{content:'•';margin-right:12px}.description{font-size:16px;line-height:1.85;margin-top:30px;overflow-wrap:anywhere}.description img{max-width:100%;height:auto}.description a{color:#08734d;text-decoration:underline}.description table{max-width:100%}
    footer{padding:25px 0;background:#02382d;color:rgba(255,255,255,.7);font-size:12px;text-align:center}@media(max-width:620px){.wrap{width:calc(100% - 28px)}.content{padding:30px 23px 38px}.hero{height:260px}.brand b{font-size:16px}}
  </style>
</head>
<body>
<header><div class="wrap nav"><a class="brand" href="<?php echo base_url(); ?>"><span class="mark">BEM</span><b>BEM KAMPUS</b></a><a class="back" href="<?php echo site_url('kegiatan'); ?>">← KEMBALI</a></div></header>
<main><div class="wrap"><article class="article">
  <?php if (!empty($kegiatan->foto)) { ?><img class="hero" src="<?php echo base_url('uploads/kegiatan/' . rawurlencode($kegiatan->foto)); ?>" alt="<?php echo html_escape($kegiatan->nama_kegiatan); ?>"><?php } else { ?><img class="hero" src="<?php echo base_url('assets/images/hero-bem.png'); ?>" alt="<?php echo html_escape($kegiatan->nama_kegiatan); ?>"><?php } ?>
  <div class="content"><span class="eyebrow">KEGIATAN BEM</span><h1><?php echo html_escape($kegiatan->nama_kegiatan); ?></h1><div class="meta"><span><?php echo date('d-m-Y', strtotime($kegiatan->tanggal)); ?></span><?php if (!empty($kegiatan->lokasi)) { ?><span><?php echo html_escape($kegiatan->lokasi); ?></span><?php } ?></div><div class="description"><?php echo !empty($kegiatan->deskripsi) ? $kegiatan->deskripsi : '<p>Belum ada deskripsi untuk kegiatan ini.</p>'; ?></div></div>
</article></div></main>
<footer><div class="wrap">© <?php echo date('Y'); ?> BEM Kampus. All Rights Reserved.</div></footer>
</body>
</html>
