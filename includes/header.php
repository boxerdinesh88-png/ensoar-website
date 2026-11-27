<?php
require_once __DIR__ . '/config.php';
$page  = $page  ?? 'home';
$title = $title ?? SITE_NAME;
$desc  = $desc  ?? 'Ensoar Pvt. Ltd. — trusted auto finance DSA in Delhi NCR for new car, used car, commercial vehicle and two-wheeler loans from leading banks & NBFCs.';
$nav = [
    'home' => ['./', 'Home'],
    'about' => ['about.php', 'About'],
    'services' => ['services.php', 'Loans'],
    'emi' => ['emi-calculator.php', 'EMI Calculator'],
    'eligibility' => ['eligibility.php', 'Eligibility'],
    'partner' => ['partner.php', 'Partner With Us'],
    'faq' => ['faq.php', 'FAQ'],
    'contact' => ['contact.php', 'Contact'],
];
// One canonical address per page on https://ensoar.in (also stops ensoar.gt.tc / www / index.php being indexed as duplicates).
$canonical = SITE_URL . '/' . ($page === 'home' ? '' : ($nav[$page][0] ?? basename($_SERVER['SCRIPT_NAME'] ?? '')));
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($title) ?></title>
<meta name="description" content="<?= e($desc) ?>">
<link rel="canonical" href="<?= e($canonical) ?>">
<meta property="og:type" content="website">
<meta property="og:site_name" content="<?= SITE_NAME ?>">
<meta property="og:url" content="<?= e($canonical) ?>">
<meta property="og:title" content="<?= e($title) ?>">
<meta property="og:description" content="<?= e($desc) ?>">
<meta property="og:image" content="<?= SITE_URL ?>/img/logo.png">
<meta name="twitter:card" content="summary">
<?php if ($page === 'home'): ?>
<script type="application/ld+json"><?= json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'FinancialService',
    'name' => SITE_NAME,
    'url' => SITE_URL . '/',
    'logo' => SITE_URL . '/img/logo.png',
    'image' => SITE_URL . '/img/logo.png',
    'telephone' => '+91-9654402358',
    'email' => EMAIL,
    'description' => 'Auto finance DSA for new car, used car, commercial vehicle and two-wheeler loans in Ghaziabad and Delhi NCR.',
    'address' => ['@type' => 'PostalAddress', 'streetAddress' => '2nd Floor, S-4, Aditya City Center, Vaibhav Khand, Indirapuram', 'addressLocality' => 'Ghaziabad', 'addressRegion' => 'Uttar Pradesh', 'postalCode' => '201014', 'addressCountry' => 'IN'],
    'areaServed' => ['Ghaziabad', 'Noida', 'Greater Noida', 'Delhi', 'Delhi NCR'],
    'openingHoursSpecification' => ['@type' => 'OpeningHoursSpecification', 'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'], 'opens' => '09:30', 'closes' => '19:00'],
    'hasOfferCatalog' => ['@type' => 'OfferCatalog', 'name' => 'Vehicle loans', 'itemListElement' => array_map(fn($l) => ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => $l[0]]], array_values(LOANS))],
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?></script>
<?php endif; ?>
<meta name="theme-color" content="#0b2e66">
<link rel="icon" type="image/png" href="img/favicon.png">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preconnect" href="https://images.unsplash.com">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/style.css?v=6">
</head>
<body class="page-<?= e($page) ?>">
<div class="topbar">
  <div class="wrap">
    <span><?= icon('clock') ?> <?= HOURS ?></span>
    <span class="tb-right">
      <a href="tel:+<?= PHONE_RAW ?>"><?= icon('phone') ?> <?= PHONE ?></a>
      <a href="mailto:<?= EMAIL ?>"><?= icon('mail') ?> <?= EMAIL ?></a>
    </span>
  </div>
</div>
<header class="site-header" id="top">
  <div class="wrap nav-wrap">
    <a href="./" class="brand" aria-label="<?= SITE_NAME ?> home"><img src="img/logo.png" alt="<?= SITE_NAME ?>" width="180" height="43"></a>
    <nav class="nav" id="nav" aria-label="Main">
      <?php foreach ($nav as $k => [$href, $label]): ?>
        <a href="<?= $href ?>"<?= $k === $page ? ' class="active" aria-current="page"' : '' ?>><?= $label ?></a>
      <?php endforeach; ?>
      <a href="contact.php#apply" class="btn btn-accent nav-cta">Apply Now</a>
    </nav>
    <button class="burger" id="burger" aria-label="Open menu" aria-expanded="false" aria-controls="nav"><span></span><span></span><span></span></button>
  </div>
</header>
<main>
