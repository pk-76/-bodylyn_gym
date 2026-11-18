<?php
/**
 * Builds a static snapshot of the site into /docs for GitHub Pages (client review preview).
 * Usage:  php tools/build-static.php
 * The live PHP site is unaffected. The preview is marked noindex.
 */
declare(strict_types=1);

$root = dirname(__DIR__);
$out  = $root . '/docs';
chdir($root);

function rrmdir(string $d): void {
    if (!is_dir($d)) return;
    foreach (scandir($d) as $f) {
        if ($f === '.' || $f === '..') continue;
        is_dir("$d/$f") ? rrmdir("$d/$f") : unlink("$d/$f");
    }
    rmdir($d);
}
function rcopy(string $src, string $dst): void {
    @mkdir($dst, 0777, true);
    foreach (scandir($src) as $f) {
        if ($f === '.' || $f === '..') continue;
        is_dir("$src/$f") ? rcopy("$src/$f", "$dst/$f") : copy("$src/$f", "$dst/$f");
    }
}

rrmdir($out);
mkdir($out, 0777, true);

$_SERVER['REQUEST_METHOD'] = 'GET';
ob_start();
include $root . '/index.php';
$html = ob_get_clean();

// Preview only: keep search engines away from the client-review copy.
$html = str_replace('<meta name="theme-color"', '<meta name="robots" content="noindex, nofollow">' . "\n" . '<meta name="theme-color"', $html);

file_put_contents($out . '/index.html', $html);
rcopy($root . '/assets', $out . '/assets');
file_put_contents($out . '/robots.txt', "User-agent: *\nDisallow: /\n");
file_put_contents($out . '/.nojekyll', '');

echo "Static preview built in docs/ (" . strlen($html) . " bytes HTML)\n";
