<?php
$page = 'home';
$title = 'Car Loans in Ghaziabad & Delhi NCR | Ensoar Pvt. Ltd.';
$desc = 'Ensoar – car loan DSA in Indirapuram, Ghaziabad. New car, used car, commercial vehicle & two-wheeler loans from top banks & NBFCs across Delhi NCR. Free consultation.';
require 'includes/header.php';
require 'includes/form.php';
?>
<section class="hero">
  <div class="hero-bg" style="background-image:url('<?= img('1492144534655-ae79c964c9d7', 2400) ?>')"></div>
  <div class="wrap">
    <div>
      <span class="eyebrow reveal" style="color:var(--accent)">Auto Finance Experts · Ghaziabad &amp; Delhi NCR</span>
      <h1 class="reveal">Fast &amp; hassle-free<br><span class="rotator" data-words='["Car Loans","Used Car Loans","Truck Loans","Bike Loans","Loan Against Car"]'>Car Loans</span><br>in Ghaziabad &amp; Delhi NCR</h1>
      <p class="lead reveal">Ensoar compares offers from leading banks &amp; NBFCs and gets your vehicle loan sanctioned at the best possible rate — with doorstep documentation and zero consultation fee.</p>
      <div class="hero-actions reveal">
        <a href="contact.php#apply" class="btn btn-accent">Apply Now <?= icon('arrow') ?></a>
        <a href="emi-calculator.php" class="btn btn-ghost-light"><?= icon('calc') ?> Calculate EMI</a>
      </div>
      <div class="hero-badges reveal">
        <span><?= icon('check') ?> Up to 100% on-road funding*</span>
        <span><?= icon('check') ?> Doorstep service</span>
        <span><?= icon('check') ?> No upfront fee</span>
      </div>
    </div>
    <div class="quote-card reveal r">
      <h3>Get a free loan quote</h3>
      <p>Our advisor will call you back within working hours.</p>
      <?php lead_form('loan', true); ?>
    </div>
  </div>
</section>

<div class="marquee" aria-hidden="true">
  <div class="marquee-track">
    <?php for ($i = 0; $i < 2; $i++): ?><span>New Car Loan</span><span>Used Car Loan</span><span>Commercial Vehicle Loan</span><span>Two-Wheeler Loan</span><span>Loan Against Car</span><span>Balance Transfer</span><span>EV Finance</span><?php endfor; ?>
  </div>
</div>

<section class="bg-soft">
  <div class="wrap split">
    <div class="img-stack reveal l">
      <img class="main" src="<?= img('1600880292203-757bb62b4baf', 1000) ?>" alt="Ensoar loan advisor with customer" loading="lazy">
      <img class="sub" src="<?= img('1560958089-b8a1929cea89', 700) ?>" alt="New car ready for delivery" loading="lazy">
      <div class="tag">Bank &amp; NBFC<small>multiple lenders, one window</small></div>
    </div>
    <div class="reveal r">
      <span class="eyebrow">About Ensoar</span>
      <h2>Your trusted partner for every vehicle loan</h2>
      <p class="lead" style="margin-top:16px">Ensoar Pvt. Ltd. is an auto finance Direct Selling Agent (DSA) based in Indirapuram, Ghaziabad. We work with leading banks and NBFCs to help salaried individuals, business owners, transporters and first-time buyers finance their vehicles — without running from branch to branch.</p>
      <ul class="check-list">
        <li><?= icon('check') ?> Compare offers from multiple lenders in one place</li>
        <li><?= icon('check') ?> Expert help with documentation &amp; credit profile</li>
        <li><?= icon('check') ?> Dealer tie-ups for faster delivery of your vehicle</li>
        <li><?= icon('check') ?> Transparent process — no hidden or upfront charges</li>
      </ul>
      <a href="about.php" class="btn btn-navy">Know More <?= icon('arrow') ?></a>
    </div>
  </div>
</section>

<section class="stats-section bg-soft" style="padding-top:20px">
  <div class="wrap stats" data-stagger>
    <div class="stat"><b data-count="100" data-suffix="%">0</b><small>On-road funding*</small></div>
    <div class="stat"><b data-count="7" data-suffix=" Yrs">0</b><small>Maximum tenure*</small></div>
    <div class="stat"><b data-count="48" data-suffix=" Hrs">0</b><small>Quick sanction*</small></div>
    <div class="stat"><b data-count="6">0</b><small>Vehicle loan products</small></div>
  </div>
</section>

<section>
  <div class="wrap">
    <div class="sec-head reveal">
      <span class="eyebrow">Our Loans</span>
      <h2>Finance for every set of wheels</h2>
      <p>From your first scooter to a fleet of trucks — choose the loan that fits your need and we handle the rest.</p>
    </div>
    <div class="cards" data-stagger>
      <?php foreach (LOANS as $slug => [$name, $ic, $photo, $text]): ?>
      <a class="loan-card" href="services.php#<?= $slug ?>">
        <div class="thumb"><img src="<?= img($photo, 800) ?>" alt="<?= $name ?>" loading="lazy"></div>
        <div class="body">
          <span class="ic-badge"><?= icon($ic) ?></span>
          <h3><?= $name ?></h3>
          <p><?= $text ?></p>
          <span class="more">Explore <?= icon('arrow') ?></span>
        </div>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="bg-soft">
  <div class="wrap">
    <div class="sec-head reveal">
      <span class="eyebrow">Why Ensoar</span>
      <h2>Built around speed, trust &amp; the best rate</h2>
    </div>
    <div class="features" data-stagger>
      <div class="feature"><div class="fi"><?= icon('bank') ?></div><h3>Multiple Lenders</h3><p>One application, offers from several banks &amp; NBFCs — you pick the best.</p></div>
      <div class="feature"><div class="fi"><?= icon('bolt') ?></div><h3>Quick Approval</h3><p>Pre-checked files mean faster login, sanction and disbursal.</p></div>
      <div class="feature"><div class="fi"><?= icon('home') ?></div><h3>Doorstep Service</h3><p>Our executive collects documents from your home or office.</p></div>
      <div class="feature"><div class="fi"><?= icon('shield') ?></div><h3>100% Transparent</h3><p>Clear rates, charges and terms explained before you sign.</p></div>
    </div>
  </div>
</section>

<section>
  <div class="wrap">
    <div class="sec-head reveal">
      <span class="eyebrow">How It Works</span>
      <h2>Your loan in 4 simple steps</h2>
    </div>
    <div class="steps" data-stagger>
      <div class="step"><h3>Share Details</h3><p>Fill the form or call us with your vehicle and income details.</p></div>
      <div class="step"><h3>Compare Offers</h3><p>We match you with lenders and share the best rate &amp; EMI options.</p></div>
      <div class="step"><h3>Documentation</h3><p>Doorstep KYC &amp; document pickup, file login with the chosen lender.</p></div>
      <div class="step"><h3>Drive Home</h3><p>Loan sanctioned, amount disbursed to the dealer — enjoy your ride!</p></div>
    </div>
  </div>
</section>

<section class="bg-soft">
  <div class="wrap split rev">
    <div class="reveal r">
      <span class="eyebrow">Plan Smart</span>
      <h2>Know your EMI before you buy</h2>
      <p class="lead" style="margin:16px 0 28px">Use our interactive EMI calculator to plan the loan amount, tenure and interest that fits your monthly budget.</p>
      <a href="emi-calculator.php" class="btn btn-navy"><?= icon('calc') ?> Open EMI Calculator</a>
    </div>
    <div class="reveal l z">
      <img src="<?= img('1554224155-6726b3ff858f', 1100) ?>" alt="Calculating vehicle loan EMI" loading="lazy" style="border-radius:24px;box-shadow:var(--shadow-lg);aspect-ratio:4/3;object-fit:cover;width:100%">
    </div>
  </div>
</section>
<?php require 'includes/footer.php'; ?>
