<?php
require_once __DIR__ . '/config.php';
$page  = $page  ?? 'home';
$title = $title ?? SITE_NAME;
$desc  = $desc  ?? 'Ensoar Pvt. Ltd. — trusted auto finance DSA in Delhi NCR for new car, used car, commercial vehicle and two-wheeler loans from leading banks & NBFCs.';
$nav = [
    'home' => ['index.php', 'Home'],
    'about' => ['about.php', 'About'],
    'services' => ['services.php', 'Loans'],
    'emi' => ['emi-calculator.php', 'EMI Calculator'],
    'eligibility' => ['eligibility.php', 'Eligibility'],
    'partner' => ['partner.php', 'Partner With Us'],
    'faq' => ['faq.php', 'FAQ'],
    'contact' => ['contact.php', 'Contact'],
];
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($title) ?></title>
<meta name="description" content="<?= e($desc) ?>">
<meta property="og:title" content="<?= e($title) ?>">
<meta property="og:description" content="<?= e($desc) ?>">
<meta property="og:image" content="img/logo.png">
<meta name="theme-color" content="#0b2e66">
<link rel="icon" type="image/png" href="img/favicon.png">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preconnect" href="https://images.unsplash.com">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/style.css?v=5">
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
    <a href="index.php" class="brand" aria-label="<?= SITE_NAME ?> home"><img src="img/logo.png" alt="<?= SITE_NAME ?>" width="180" height="43"></a>
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
