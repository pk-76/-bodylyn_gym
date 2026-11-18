<?php
/**
 * No-JS fallback for the free-trial form.
 * Validates the POST, builds the WhatsApp message and redirects to wa.me. Nothing is stored.
 */
declare(strict_types=1);
require __DIR__ . '/includes/helpers.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php#trial');
    exit;
}

$c = site();
$clean = static fn(string $k, int $max = 60): string =>
    mb_substr(trim(preg_replace('/[\x00-\x1F\x7F]+/u', ' ', (string) ($_POST[$k] ?? ''))), 0, $max);

$name  = $clean('name');
$phone = preg_replace('/\D+/', '', $clean('phone', 18));
$phone = preg_match('/^(?:91)?([6-9]\d{9})$/', $phone, $m) ? $m[1] : '';
$goal  = in_array($_POST['goal'] ?? '', $c['goals'], true) ? $_POST['goal'] : 'General Fitness';
$time  = in_array($_POST['time'] ?? '', $c['times'], true) ? $_POST['time'] : 'Any time';
$pt    = ($_POST['pt'] ?? 'No') === 'Yes' ? 'Yes' : 'No';

if ($name === '' || $phone === '') {
    header('Location: index.php?error=1#trial');
    exit;
}

$msg = "Hi BODYLYN GYM! I'd like to book a FREE TRIAL.\nName: {$name} | Phone: {$phone} | Goal: {$goal} | Preferred time: {$time} | Personal training: {$pt}";
header('Location: ' . wa_link($msg));
exit;
