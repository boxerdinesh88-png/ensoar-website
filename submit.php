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
<meta name="robots" content="noindex">
<title>Thank you – <?= SITE_NAME ?></title>
<link rel="icon" href="img/favicon.png">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/style.css?v=4">
</head><body>
<section class="page-hero thanks">
  <div class="wrap">
    <img src="img/logo-white.png" alt="<?= SITE_NAME ?>" class="thanks-logo">
    <div class="thanks-card">
      <svg class="tick" viewBox="0 0 52 52" aria-hidden="true"><circle cx="26" cy="26" r="24"/><path d="M15 27l7 7 15-15"/></svg>
      <h1>Thank you, <?= e($d['name']) ?>!</h1>
      <p class="lead">Your <?= $d['kind'] === 'Partner' ? 'partner registration' : 'loan enquiry' ?> has been submitted successfully.</p>
      <ul class="thanks-sum">
        <li><span><?= $d['kind'] === 'Partner' ? 'Partner type' : 'Loan type' ?></span><b><?= e($d['loan']) ?></b></li>
        <li><span>Mobile</span><b><?= e($d['phone']) ?></b></li>
        <li><span>City</span><b><?= e($d['city']) ?></b></li>
        <?php if ($d['amount'] !== ''): ?><li><span>Amount</span><b>₹<?= e($d['amount']) ?></b></li><?php endif; ?>
      </ul>
      <p class="thanks-next"><?= $mailed ? 'A confirmation has been sent to <b>' . e($d['email']) . '</b>. ' : '' ?>Our loan advisor will call you within one working day.</p>
      <div class="thanks-actions">
        <a class="btn btn-navy" href="index.php">Back to Home</a>
        <a class="btn btn-outline" href="<?= e($wa) ?>" target="_blank" rel="noopener">Chat on WhatsApp</a>
      </div>
    </div>
  </div>
</section>
</body></html>
