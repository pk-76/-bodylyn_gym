<?php
$c = site();
$seo = $c['seo'];
$canonical = $c['url'] . '/';
$og = photo_url('hero', 1200, 1200 / 630);
?>
<!doctype html>
<html lang="en-IN">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title><?= e($seo['title']) ?></title>
<meta name="description" content="<?= e($seo['description']) ?>">
<meta name="keywords" content="<?= e($seo['keywords']) ?>">
<meta name="theme-color" content="#0A0A0A">
<meta name="color-scheme" content="dark light">
<link rel="canonical" href="<?= e($canonical) ?>">
<link rel="icon" href="assets/img/logo-64.png" type="image/png" sizes="64x64">
<link rel="apple-touch-icon" href="assets/img/logo-256.png">

<!-- Open Graph / Twitter -->
<meta property="og:type" content="website">
<meta property="og:site_name" content="<?= e($c['name']) ?>">
<meta property="og:title" content="<?= e($seo['title']) ?>">
<meta property="og:description" content="<?= e($seo['description']) ?>">
<meta property="og:url" content="<?= e($canonical) ?>">
<meta property="og:image" content="<?= e($og) ?>">
<meta property="og:locale" content="en_IN">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?= e($seo['title']) ?>">
<meta name="twitter:description" content="<?= e($seo['description']) ?>">
<meta name="twitter:image" content="<?= e($og) ?>">

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preconnect" href="https://images.unsplash.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Anton&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<script>document.documentElement.classList.add('js');</script>
<link rel="stylesheet" href="<?= e(asset('assets/css/style.css')) ?>">

<script type="application/ld+json">
<?= schema_json() ?>
</script>
</head>
