<?php
declare(strict_types=1);
require __DIR__ . '/includes/helpers.php';
require __DIR__ . '/includes/head.php';
?>
<body>
<?php
include __DIR__ . '/includes/sections/nav.php';
?>
<main id="main">
<?php
foreach (['hero', 'marquee', 'stats', 'about', 'why', 'facilities', 'programs', 'audience', 'trainers',
          'transformations', 'reviews', 'besttime', 'gallery', 'enquiry', 'location', 'cta'] as $section) {
    include __DIR__ . '/includes/sections/' . $section . '.php';
}
?>
</main>
<?php include __DIR__ . '/includes/sections/footer.php'; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/lenis@1.1.13/dist/lenis.min.js" defer></script>
<script src="<?= e(asset('assets/js/main.js')) ?>" defer></script>
</body>
</html>
