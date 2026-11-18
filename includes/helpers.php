<?php
declare(strict_types=1);

/** Site config (loaded once). */
function site(): array
{
    static $c = null;
    return $c ??= require __DIR__ . '/config.php';
}

/** HTML-escape. */
function e(?string $s): string
{
    return htmlspecialchars((string) $s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function wa_link(string $msg = ''): string
{
    return 'https://wa.me/' . site()['wa_number'] . ($msg !== '' ? '?text=' . rawurlencode($msg) : '');
}

function tel_link(): string
{
    return 'tel:' . site()['phone_tel'];
}

function directions_link(): string
{
    return 'https://www.google.com/maps/dir/?api=1&destination=' . rawurlencode(site()['map_query']);
}

/** Cache-busted asset URL. */
function asset(string $path): string
{
    $file = dirname(__DIR__) . '/' . $path;
    return $path . (is_file($file) ? '?v=' . filemtime($file) : '');
}

/**
 * Headline helper: each array item is one line (trusted HTML, may contain <em> for the accent word).
 * Lines slide up in sequence once the heading enters the viewport.
 */
function lines(array $lines): string
{
    $out = '';
    foreach (array_values($lines) as $i => $l) {
        $out .= '<span class="line"><span class="line__in" style="--i:' . $i . '">' . $l . '</span></span>';
    }
    return $out;
}

/** Visible note on sample/placeholder content (toggle in config). */
function placeholder_note(string $text): string
{
    return site()['show_placeholder_notes']
        ? '<p class="placeholder-note"><span>Placeholder</span> ' . e($text) . '</p>'
        : '';
}

/**
 * Responsive <img>. Unsplash entries get a REPLACE comment; local (real) photos do not.
 * Options: class, ratio (w/h used for cropping), widths[], sizes, eager, attrs
 */
function photo(string $key, string $alt, array $o = []): string
{
    $img = site()['images'][$key] ?? null;
    if (!$img) {
        return '';
    }
    $o += ['class' => '', 'ratio' => 1.5, 'widths' => [480, 800, 1200], 'sizes' => '100vw', 'eager' => false, 'attrs' => ''];
    $local = !empty($img['local']);
    $comment = '';

    if ($local && !empty($img['ws'])) {
        // Optimised responsive WebP set: {base}-{width}.webp
        $set = [];
        foreach ($img['ws'] as $width) {
            $set[$width] = asset($img['base'] . '-' . $width . '.webp');
        }
        $mid = $img['ws'][(int) floor((count($img['ws']) - 1) / 2)];
        $src = $set[$mid];
        $srcset = implode(', ', array_map(fn($w, $u) => e($u) . ' ' . $w . 'w', array_keys($set), $set));
        $w = (int) max($img['ws']);
        $h = (int) round($w * $img['ah'] / $img['aw']);
    } elseif ($local) {
        $src = asset($img['src']);
        $srcset = '';
        $w = (int) $img['w'];
        $h = (int) $img['h'];
    } else {
        $comment = "<!-- REPLACE WITH REAL BODYLYN PHOTO -->\n";
        $ratio = max(0.3, (float) $o['ratio']);
        $set = [];
        foreach ($o['widths'] as $width) {
            $set[$width] = $img['src'] . '?auto=format&fit=crop&crop=entropy&q=70&w=' . $width . '&h=' . (int) round($width / $ratio);
        }
        $mid = $o['widths'][(int) floor((count($o['widths']) - 1) / 2)];
        $src = $set[$mid];
        $srcset = implode(', ', array_map(fn($w, $u) => e($u) . ' ' . $w . 'w', array_keys($set), $set));
        $w = max($o['widths']);
        $h = (int) round($w / $ratio);
    }

    $attrs = 'src="' . e($src) . '"'
        . ($srcset ? ' srcset="' . $srcset . '" sizes="' . e($o['sizes']) . '"' : '')
        . ' width="' . $w . '" height="' . $h . '"'
        . ' alt="' . e($alt) . '"'
        . ($o['eager'] ? ' fetchpriority="high" decoding="async"' : ' loading="lazy" decoding="async"')
        . ($o['class'] ? ' class="' . e($o['class']) . '"' : '')
        . (!empty($img['pos']) ? ' style="object-position:' . e($img['pos']) . '"' : '')
        . ($o['attrs'] ? ' ' . $o['attrs'] : '');

    return $comment . '<img ' . $attrs . '>';
}

/** Full-size URL for the lightbox. */
function photo_url(string $key, int $w = 1600, float $ratio = 1.5): string
{
    $img = site()['images'][$key] ?? null;
    if (!$img) {
        return '';
    }
    if (!empty($img['ws'])) {
        $large = (int) max($img['ws']);
        return site()['url'] . '/' . $img['base'] . '-' . $large . '.webp';
    }
    return !empty($img['local'])
        ? asset($img['src'])
        :$img['src'] . '?auto=format&fit=crop&crop=entropy&q=78&w=' . $w . '&h=' . (int) round($w / max(0.3, $ratio));
}

/** BODYLYN badge logo (circular, transparent edge). */
function logo_img(int $size = 44): string
{
    return '<img class="logo__mark" src="' . e(asset('assets/img/logo-128.webp')) . '" srcset="' . e(asset('assets/img/logo-64.webp')) . ' 64w, ' . e(asset('assets/img/logo-128.webp')) . ' 128w, ' . e(asset('assets/img/logo-256.webp')) . ' 256w" sizes="' . $size . 'px" width="' . $size . '" height="' . $size . '" alt="" decoding="async">';
}

/** Inline SVG icons. */
function icon(string $name, string $class = ''): string
{
    static $stroke = [
        'arrow-ur'  => '<path d="M7 17 17 7M8 7h9v9"/>',
        'arrow-r'   => '<path d="M4 12h16M14 6l6 6-6 6"/>',
        'arrow-l'   => '<path d="M20 12H4M10 6l-6 6 6 6"/>',
        'phone'     => '<path d="M5 4h4l2 5-2.5 1.5a11 11 0 0 0 5 5L15 13l5 2v4a2 2 0 0 1-2 2A16 16 0 0 1 3 6a2 2 0 0 1 2-2z"/>',
        'pin'       => '<path d="M12 21s7-6.2 7-11.5A7 7 0 0 0 5 9.5C5 14.8 12 21 12 21z"/><circle cx="12" cy="9.5" r="2.5"/>',
        'clock'     => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>',
        'check'     => '<path d="m5 12.5 4.5 4.5L19 7.5"/>',
        'close'     => '<path d="M6 6l12 12M18 6 6 18"/>',
        'instagram' => '<rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r=".6" fill="currentColor"/>',
        // thin line-art for "Why BODYLYN"
        'posture'   => '<circle cx="12" cy="4.5" r="2.2"/><path d="M12 7v7M6 9.5h12M12 14l-3.5 6M12 14l3.5 6"/><path d="m17 16.5 1.8 1.8 3.2-3.6" />',
        'eye'       => '<path d="M2 12s3.8-7 10-7 10 7 10 7-3.8 7-10 7S2 12 2 12z"/><circle cx="12" cy="12" r="3"/>',
        'plan'      => '<rect x="5" y="4" width="14" height="17" rx="1.5"/><path d="M9 4V3h6v1M8.5 10h7M8.5 14h4"/><path d="m8.5 18 1.4 1.4 2.6-2.8"/>',
        'dumbbell'  => '<path d="M3 9.5v5M6 7v10M18 7v10M21 9.5v5M6 12h12"/>',
        'spark'     => '<path d="M12 3c.6 4.6 2.4 6.4 7 7-4.6.6-6.4 2.4-7 7-.6-4.6-2.4-6.4-7-7 4.6-.6 6.4-2.4 7-7z"/><path d="M19 17v4M17 19h4"/>',
    ];
    static $fill = [
        'star'     => '<path d="M12 2.2l3.1 6.3 6.9 1-5 4.9 1.2 6.9L12 17.9l-6.2 3.4L7 14.4 2 9.5l6.9-1L12 2.2z"/>',
        'whatsapp' => '<path d="M17.47 14.38c-.3-.15-1.76-.87-2.03-.97-.27-.1-.47-.15-.67.15-.2.3-.77.97-.94 1.16-.17.2-.35.22-.65.07-.3-.15-1.26-.46-2.39-1.48a8.9 8.9 0 0 1-1.65-2.06c-.17-.3-.02-.46.13-.6.13-.14.3-.35.45-.52.15-.18.2-.3.3-.5.1-.2.05-.37-.02-.52-.08-.15-.67-1.61-.92-2.2-.24-.58-.49-.5-.67-.51h-.57c-.2 0-.52.08-.79.37-.28.3-1.04 1.02-1.04 2.48s1.07 2.88 1.21 3.08c.15.2 2.1 3.2 5.08 4.49.71.3 1.26.49 1.69.63.71.22 1.36.19 1.87.12.57-.09 1.76-.72 2.01-1.41.25-.7.25-1.29.17-1.41-.08-.13-.27-.2-.57-.35m-5.42 7.4h-.01a9.87 9.87 0 0 1-5.03-1.38l-.36-.21-3.74.98 1-3.65-.24-.37a9.86 9.86 0 0 1-1.51-5.26c0-5.45 4.44-9.89 9.89-9.89 2.64 0 5.12 1.03 6.99 2.9a9.83 9.83 0 0 1 2.89 7c0 5.45-4.44 9.88-9.88 9.88m8.41-18.3A11.8 11.8 0 0 0 12.05 0C5.5 0 .16 5.34.16 11.89c0 2.1.55 4.14 1.59 5.95L.06 24l6.3-1.65a11.9 11.9 0 0 0 5.68 1.45h.01c6.55 0 11.89-5.34 11.89-11.89 0-3.18-1.24-6.16-3.48-8.41z"/>',
    ];

    $cls = trim('icon icon--' . $name . ' ' . $class);
    if (isset($fill[$name])) {
        return '<svg class="' . $cls . '" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" focusable="false">' . $fill[$name] . '</svg>';
    }
    $body = $stroke[$name] ?? '';
    return '<svg class="' . $cls . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">' . $body . '</svg>';
}

/** "05:00" → minutes after midnight. */
function hm_to_min(string $hm): int
{
    [$h, $m] = array_map('intval', explode(':', $hm));
    return $h * 60 + $m;
}

/** "23:00" → "11:00 PM". */
function fmt_time(string $hm): string
{
    return date('g:i A', strtotime($hm));
}

/** Hours as JSON for the live badge (0 = Sunday … 6 = Saturday, minutes after midnight). */
function hours_json(): string
{
    $map = ['Sunday' => 0, 'Monday' => 1, 'Tuesday' => 2, 'Wednesday' => 3, 'Thursday' => 4, 'Friday' => 5, 'Saturday' => 6];
    $days = [];
    foreach (site()['hours'] as $day => $range) {
        $days[$map[$day]] = $range ? [hm_to_min($range[0]), hm_to_min($range[1])] : null;
    }
    ksort($days);
    return json_encode(['tz' => site()['timezone'], 'days' => $days], JSON_UNESCAPED_SLASHES);
}

/** Server-side Open/Closed status in IST (JS keeps it live afterwards). */
function open_status(): array
{
    $c = site();
    $now = new DateTimeImmutable('now', new DateTimeZone($c['timezone']));
    $today = $now->format('l');
    $min = (int) $now->format('G') * 60 + (int) $now->format('i');
    $range = $c['hours'][$today] ?? null;

    if ($range && $min >= hm_to_min($range[0]) && $min < hm_to_min($range[1])) {
        return ['open' => true, 'text' => 'Open now · Closes ' . fmt_time($range[1])];
    }
    // find next opening
    $names = array_keys($c['hours']);
    $idx = array_search($today, $names, true);
    for ($i = 0; $i < 8; $i++) {
        $d = $names[($idx + $i) % 7];
        $r = $c['hours'][$d];
        if (!$r) {
            continue;
        }
        if ($i === 0 && $min >= hm_to_min($r[0])) {
            continue;
        }
        $when = $i === 0 ? 'today' : ($i === 1 ? 'tomorrow' : substr($d, 0, 3));
        return ['open' => false, 'text' => 'Closed now · Opens ' . $when . ' ' . fmt_time($r[0])];
    }
    return ['open' => false, 'text' => 'Closed now'];
}

/** JSON-LD for HealthClub / LocalBusiness. */
function schema_json(): string
{
    $c = site();
    $a = $c['address'];
    $ld = [
        '@context' => 'https://schema.org',
        '@type' => ['HealthClub', 'LocalBusiness'],
        'name' => $c['name'],
        'description' => $c['seo']['description'],
        'url' => $c['url'] . '/',
        'logo' => $c['url'] . '/assets/img/logo-256.png',
        'image' => photo_url('hero', 1200, 1200 / 630),   // [REPLACE] with a real BODYLYN photo URL
        'telephone' => $c['phone_tel'],
        'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => $a['street'],
            'addressLocality' => $a['locality'],
            'addressRegion' => $a['region'],
            'postalCode' => $a['postal'],
            'addressCountry' => $a['country'],
        ],
        'openingHoursSpecification' => [[
            '@type' => 'OpeningHoursSpecification',
            'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
            'opens' => '05:00',
            'closes' => '23:00',
        ]],
        'aggregateRating' => [
            '@type' => 'AggregateRating',
            'ratingValue' => (string) $c['rating'],
            'reviewCount' => (string) $c['reviews'],
            'bestRating' => '5',
        ],
        'hasMap' => directions_link(),
        'amenityFeature' => [
            ['@type' => 'LocationFeatureSpecification', 'name' => 'Personal training', 'value' => true],
            ['@type' => 'LocationFeatureSpecification', 'name' => 'Free-weights zone', 'value' => true],
            ['@type' => 'LocationFeatureSpecification', 'name' => 'Cardio zone', 'value' => true],
        ],
    ];
    if ($c['geo']['lat'] !== null && $c['geo']['lng'] !== null) {
        $ld['geo'] = ['@type' => 'GeoCoordinates', 'latitude' => $c['geo']['lat'], 'longitude' => $c['geo']['lng']];
    }
    if ($c['instagram']['url'] !== '#') {
        $ld['sameAs'] = [$c['instagram']['url']];
    }
    return json_encode($ld, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
}
