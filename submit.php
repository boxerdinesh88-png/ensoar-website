<?php
// Saves a lead (MySQL, or data/enquiries.csv as fallback), emails a confirmation to the sender and a copy to the office,
// then opens WhatsApp with the details so the lead also reaches the owner's phone.
require __DIR__ . '/includes/db.php';
require __DIR__ . '/includes/mailer.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: contact.php'); exit; }
if (!empty($_POST['website'])) { header('Location: contact.php?sent=1#apply'); exit; } // honeypot: bots

$f = fn(string $k, int $max) => trim(mb_substr(preg_replace('/\s+/u', ' ', strip_tags((string)($_POST[$k] ?? ''))), 0, $max));
$d = [
    'kind'    => $f('kind', 10) === 'partner' ? 'Partner' : 'Loan',
    'name'    => $f('name', 80),
    'email'   => strtolower($f('email', 120)),
    'phone'   => preg_replace('/\D/', '', $f('phone', 15)),
    'loan'    => $f('loan', 60),
    'city'    => $f('city', 60),
    'amount'  => $f('amount', 20),
    'income'  => $f('income', 40),
    'message' => $f('message', 600),
];

if ($d['name'] === '' || !filter_var($d['email'], FILTER_VALIDATE_EMAIL) || !preg_match('/^[6-9]\d{9}$/', $d['phone']) || $d['loan'] === '' || $d['city'] === '') {
    header('Location: contact.php?err=1#apply'); exit;
}
if (!save_lead($d + ['ip' => $_SERVER['REMOTE_ADDR'] ?? ''])) {
    error_log('Ensoar: lead could not be saved');
}
$mailed = notify_lead($d);

$lines = ["*New {$d['kind']} Enquiry – Ensoar Website*", "Name: {$d['name']}", "Mobile: {$d['phone']}", "Email: {$d['email']}", ($d['kind'] === 'Partner' ? 'Type' : 'Loan') . ": {$d['loan']}", "City: {$d['city']}"];
if ($d['amount'] !== '')  $lines[] = "Amount: ₹{$d['amount']}";
if ($d['income'] !== '' && $d['kind'] === 'Loan') $lines[] = "Income: {$d['income']}";
if ($d['message'] !== '') $lines[] = "Message: {$d['message']}";
$wa = 'https://wa.me/' . PHONE_RAW . '?text=' . rawurlencode(implode("\n", $lines));
?><!DOCTYPE html>
<html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>Thank you – <?= SITE_NAME ?></title>
<meta http-equiv="refresh" content="2;url=<?= e($wa) ?>">
<link rel="icon" href="img/favicon.png"><link rel="stylesheet" href="css/style.css?v=2">
</head><body>
<section class="page-hero" style="min-height:100vh;display:grid;place-items:center">
  <div class="wrap">
    <img src="img/logo-white.png" alt="<?= SITE_NAME ?>" style="height:56px;margin:0 auto 30px">
    <h1>Thank you, <?= e($d['name']) ?>!</h1>
    <p>Your enquiry is received<?= $mailed ? ' and a confirmation has been emailed to ' . e($d['email']) : '' ?>. Opening WhatsApp so you can also send it to our advisor instantly…</p>
    <p style="margin-top:30px;display:flex;gap:14px;justify-content:center;flex-wrap:wrap">
      <a class="btn btn-accent" href="<?= e($wa) ?>">Send on WhatsApp</a>
      <a class="btn btn-ghost-light" href="index.php">Back to Home</a>
    </p>
  </div>
</section>
</body></html>
