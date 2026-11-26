<?php
// Saves an enquiry to data/leads.csv, then opens WhatsApp with the details so the lead reaches the owner's phone.
// (InfinityFree blocks PHP mail(), so WhatsApp + CSV is used instead of email.)
require __DIR__ . '/includes/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: contact.php'); exit; }
if (!empty($_POST['website'])) { header('Location: contact.php?sent=1#apply'); exit; } // honeypot: bots

$f = fn(string $k, int $max) => trim(mb_substr(preg_replace('/\s+/u', ' ', strip_tags((string)($_POST[$k] ?? ''))), 0, $max));
$d = [
    'kind'    => $f('kind', 10) === 'partner' ? 'Partner' : 'Loan',
    'name'    => $f('name', 80),
    'phone'   => preg_replace('/\D/', '', $f('phone', 15)),
    'loan'    => $f('loan', 60),
    'city'    => $f('city', 60),
    'amount'  => $f('amount', 20),
    'income'  => $f('income', 40),
    'message' => $f('message', 600),
];

if ($d['name'] === '' || !preg_match('/^[6-9]\d{9}$/', $d['phone']) || $d['loan'] === '' || $d['city'] === '') {
    header('Location: contact.php?err=1#apply'); exit;
}

$file = __DIR__ . '/data/leads.csv';
$new = !is_file($file);
if ($fh = @fopen($file, 'a')) {
    flock($fh, LOCK_EX);
    if ($new) fputcsv($fh, ['date', ...array_keys($d)]);
    // prefix formula characters so the CSV is safe to open in Excel
    fputcsv($fh, array_map(fn($v) => preg_match('/^[=+\-@]/', $v) ? "'$v" : $v, [date('Y-m-d H:i'), ...array_values($d)]));
    flock($fh, LOCK_UN); fclose($fh);
}

$lines = ["*New {$d['kind']} Enquiry – Ensoar Website*", "Name: {$d['name']}", "Mobile: {$d['phone']}", ($d['kind'] === 'Partner' ? 'Type' : 'Loan') . ": {$d['loan']}", "City: {$d['city']}"];
if ($d['amount'] !== '')  $lines[] = "Amount: ₹{$d['amount']}";
if ($d['income'] !== '' && $d['kind'] === 'Loan') $lines[] = "Income: {$d['income']}";
if ($d['message'] !== '') $lines[] = "Message: {$d['message']}";
$wa = 'https://wa.me/' . PHONE_RAW . '?text=' . rawurlencode(implode("\n", $lines));
?><!DOCTYPE html>
<html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>Thank you – <?= SITE_NAME ?></title>
<meta http-equiv="refresh" content="2;url=<?= e($wa) ?>">
<link rel="icon" href="img/favicon.png"><link rel="stylesheet" href="css/style.css?v=1">
</head><body>
<section class="page-hero" style="min-height:100vh;display:grid;place-items:center">
  <div class="wrap">
    <img src="img/logo-white.png" alt="<?= SITE_NAME ?>" style="height:56px;margin:0 auto 30px">
    <h1>Thank you, <?= e($d['name']) ?>!</h1>
    <p>Your enquiry is received. Opening WhatsApp so you can send it to our advisor instantly…</p>
    <p style="margin-top:30px;display:flex;gap:14px;justify-content:center;flex-wrap:wrap">
      <a class="btn btn-accent" href="<?= e($wa) ?>">Send on WhatsApp</a>
      <a class="btn btn-ghost-light" href="index.php">Back to Home</a>
    </p>
  </div>
</section>
</body></html>
