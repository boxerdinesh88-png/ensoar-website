<?php
// Private admin: log in, then view every form entry (loan + partner leads) and download them as CSV.
require_once __DIR__ . '/includes/db.php';

session_set_cookie_params(['httponly' => true, 'samesite' => 'Strict', 'secure' => !empty($_SERVER['HTTPS'])]);
session_start();
header('X-Robots-Tag: noindex, nofollow');
header('Cache-Control: no-store');
header('X-Frame-Options: DENY');

$configured = defined('ADMIN_PASS') && strlen(ADMIN_PASS) >= 10;
$_SESSION['csrf'] ??= bin2hex(random_bytes(16));
$csrfOk = fn() => hash_equals($_SESSION['csrf'], (string)($_POST['csrf'] ?? ''));
$error = '';

// Brute-force guard: 5 wrong logins per IP locks the form for 15 minutes.
$lockFile = __DIR__ . '/data/admin_logins.json';
$ip = $_SERVER['REMOTE_ADDR'] ?? '?';
$fails = is_file($lockFile) ? (json_decode((string)file_get_contents($lockFile), true) ?: []) : [];
$fails = array_filter($fails, fn($f) => $f['t'] > time() - 900);
$locked = ($fails[$ip]['n'] ?? 0) >= 5;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login']) && $configured) {
    $u = (string)($_POST['user'] ?? '');
    $p = (string)($_POST['pass'] ?? '');
    $passOk = str_starts_with(ADMIN_PASS, '$2y$') ? password_verify($p, ADMIN_PASS) : hash_equals(ADMIN_PASS, $p);
    if ($locked) {
        $error = 'Too many wrong attempts. Try again in 15 minutes.';
    } elseif ($csrfOk() && hash_equals(ADMIN_USER, $u) && $passOk) {
        session_regenerate_id(true);
        $_SESSION['admin'] = true;
        unset($fails[$ip]);
        @file_put_contents($lockFile, json_encode($fails), LOCK_EX);
        header('Location: admin.php', true, 303);
        exit;
    } else {
        $fails[$ip] = ['n' => ($fails[$ip]['n'] ?? 0) + 1, 't' => time()];
        @file_put_contents($lockFile, json_encode($fails), LOCK_EX);
        sleep(1);
        $error = 'Wrong username or password.';
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout']) && $csrfOk()) {
    $_SESSION = [];
    session_destroy();
    header('Location: admin.php', true, 303);
    exit;
}
$isAdmin = !empty($_SESSION['admin']);

$cols = ['created_at' => 'Date', 'kind' => 'Type', 'name' => 'Name', 'phone' => 'Mobile', 'email' => 'Email', 'loan' => 'Loan / Partner type', 'city' => 'City', 'amount' => 'Amount', 'income' => 'Income', 'message' => 'Message'];
$kind = in_array($_GET['kind'] ?? '', ['Loan', 'Partner'], true) ? $_GET['kind'] : '';
$rows = $isAdmin ? load_leads() : [];
if ($kind) $rows = array_values(array_filter($rows, fn($r) => ($r['kind'] ?? '') === $kind));

// CSV download of what is on screen (opens in Excel).
if ($isAdmin && isset($_GET['export'])) {
    header('Content-Type: text/csv; charset=UTF-8');
    header('Content-Disposition: attachment; filename="ensoar-leads-' . date('Y-m-d') . '.csv"');
    $out = fopen('php://output', 'w');
    fwrite($out, "\xEF\xBB\xBF"); // BOM so Excel shows ₹ and Hindi correctly
    fputcsv($out, array_values($cols));
    foreach ($rows as $r) fputcsv($out, array_map(fn($k) => (string)($r[$k] ?? ''), array_keys($cols)));
    exit;
}
$today = count(array_filter($rows, fn($r) => str_starts_with($r['created_at'] ?? '', date('Y-m-d'))));
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex, nofollow">
<title>Admin | <?= SITE_NAME ?></title>
<link rel="icon" type="image/png" href="img/favicon.png">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/style.css?v=3">
<style>
  body{background:var(--bg)}
  .adm-top{background:var(--navy-dk);color:#fff;padding:14px 0}
  .adm-top .wrap{display:flex;justify-content:space-between;align-items:center;gap:16px}
  .adm-top img{height:34px}
  .adm-top button{background:none;border:1px solid rgba(255,255,255,.35);color:#fff;border-radius:999px;padding:8px 18px;cursor:pointer;font:600 .9rem var(--ff)}
  .login{max-width:420px;margin:80px auto}
  .login img{height:44px;margin:0 auto 20px}
  .kpis{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin:28px 0}
  .kpis div{background:#fff;border-radius:16px;padding:20px;box-shadow:var(--shadow);border-bottom:3px solid var(--accent)}
  .kpis b{display:block;font:800 1.8rem var(--ff-h);color:var(--navy)}
  .kpis small{color:var(--muted)}
  .bar{display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap;margin-bottom:16px}
  .bar .tabs{margin:0;justify-content:flex-start}
  .bar .tab[aria-current]{background:var(--navy);border-color:var(--navy);color:#fff}
  .bar input{padding:11px 16px;border:1.5px solid var(--line);border-radius:999px;font:inherit;min-width:240px}
  .tbl{overflow:auto;background:#fff;border-radius:16px;box-shadow:var(--shadow);margin-bottom:40px;max-height:70vh}
  table{border-collapse:collapse;width:100%;font-size:.9rem}
  th,td{padding:12px 14px;text-align:left;border-bottom:1px solid var(--line);vertical-align:top}
  th{background:#f8fafd;font:700 .8rem var(--ff-h);color:var(--navy-dk);white-space:nowrap;position:sticky;top:0}
  td{white-space:nowrap}
  td.msg{min-width:260px;white-space:pre-wrap}
  td a{color:var(--navy);font-weight:600}
  .pill{display:inline-block;padding:3px 10px;border-radius:999px;font-size:.78rem;font-weight:700;background:rgba(245,165,36,.18);color:#9a5b00}
  .pill.p{background:rgba(11,46,102,.1);color:var(--navy)}
  .empty{padding:50px;text-align:center;color:var(--muted)}
  .note{color:var(--muted);font-size:.88rem}
  @media (max-width:640px){.kpis{grid-template-columns:1fr}.bar input{min-width:0;width:100%}}
</style>
</head>
<body>
<?php if (!$isAdmin): ?>
  <div class="login wrap">
    <form class="form-card" method="post" action="admin.php">
      <img src="img/logo.png" alt="<?= SITE_NAME ?>">
      <h1 style="font-size:1.5rem;margin-bottom:18px">Admin login</h1>
      <?php if (!$configured): ?>
        <?php if ($SECRETS_ERROR): ?>
          <div class="alert err">includes/secrets.php has a typo on <?= e($SECRETS_ERROR) ?> (check the quotes ' ' and the ; at the end of each line). The website keeps working meanwhile.</div>
        <?php else: ?>
          <div class="alert err">Admin is not set up yet. Add ADMIN_PASS (10+ characters) in includes/secrets.php on the server.</div>
        <?php endif; ?>
      <?php else: ?>
        <?php if ($error): ?><div class="alert err" role="alert"><?= e($error) ?></div><?php endif; ?>
        <input type="hidden" name="csrf" value="<?= e($_SESSION['csrf']) ?>">
        <div class="form-grid">
          <div class="field"><label for="user">Username</label><input id="user" name="user" autocomplete="username" required></div>
          <div class="field"><label for="pass">Password</label><input id="pass" name="pass" type="password" autocomplete="current-password" required></div>
          <button class="btn btn-navy" name="login" value="1" type="submit" style="justify-content:center">Log in</button>
        </div>
      <?php endif; ?>
    </form>
  </div>
<?php else: ?>
  <div class="adm-top"><div class="wrap">
    <img src="img/logo-white.png" alt="<?= SITE_NAME ?>">
    <form method="post" action="admin.php"><input type="hidden" name="csrf" value="<?= e($_SESSION['csrf']) ?>"><button name="logout" value="1">Log out</button></form>
  </div></div>
  <div class="wrap">
    <div class="kpis">
      <div><b><?= count($rows) ?></b><small><?= $kind ?: 'All' ?> leads</small></div>
      <div><b><?= $today ?></b><small>Today</small></div>
      <div><b><?= db() ? 'MySQL' : 'File' ?></b><small><?= db() ? 'Database connected' : 'Database not connected — saving to data/enquiries.csv' ?></small></div>
    </div>
    <div class="bar">
      <nav class="tabs" aria-label="Filter">
        <a class="tab" href="admin.php"<?= $kind === '' ? ' aria-current="page"' : '' ?>>All</a>
        <a class="tab" href="admin.php?kind=Loan"<?= $kind === 'Loan' ? ' aria-current="page"' : '' ?>>Loan leads</a>
        <a class="tab" href="admin.php?kind=Partner"<?= $kind === 'Partner' ? ' aria-current="page"' : '' ?>>Partners</a>
      </nav>
      <div style="display:flex;gap:10px;flex-wrap:wrap">
        <input type="search" id="q" placeholder="Search name, mobile, city…" aria-label="Search leads">
        <a class="btn btn-accent btn-sm" href="admin.php?export=1<?= $kind ? '&kind=' . $kind : '' ?>">Download Excel (CSV)</a>
      </div>
    </div>
    <div class="tbl">
      <?php if (!$rows): ?><div class="empty">No entries yet.</div><?php else: ?>
      <table>
        <thead><tr><?php foreach ($cols as $label): ?><th><?= $label ?></th><?php endforeach; ?></tr></thead>
        <tbody>
        <?php foreach ($rows as $r): ?><tr>
          <?php foreach ($cols as $k => $_): $v = ltrim((string)($r[$k] ?? ''), "'"); ?>
            <?php if ($k === 'email'): ?><td><a href="mailto:<?= e($v) ?>"><?= e($v) ?></a></td>
            <?php elseif ($k === 'phone'): ?><td><a href="tel:+91<?= e($v) ?>"><?= e($v) ?></a> · <a href="https://wa.me/91<?= e($v) ?>" target="_blank" rel="noopener">WA</a></td>
            <?php elseif ($k === 'kind'): ?><td><span class="pill<?= $v === 'Partner' ? ' p' : '' ?>"><?= e($v) ?></span></td>
            <?php else: ?><td<?= $k === 'message' ? ' class="msg"' : '' ?>><?= e($v) ?></td><?php endif; ?>
          <?php endforeach; ?>
        </tr><?php endforeach; ?>
        </tbody>
      </table>
      <?php endif; ?>
    </div>
  </div>
  <script>
    // quick client-side search across the visible table
    document.getElementById('q').addEventListener('input', e => {
      const q = e.target.value.toLowerCase();
      document.querySelectorAll('tbody tr').forEach(tr => tr.hidden = !tr.textContent.toLowerCase().includes(q));
    });
  </script>
<?php endif; ?>
</body>
</html>
