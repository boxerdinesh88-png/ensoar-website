<?php
$page = 'about';
$title = 'About Us | Ensoar Pvt. Ltd. – Auto Finance DSA';
$desc = 'Learn about Ensoar Pvt. Ltd., an auto finance DSA in Indirapuram, Ghaziabad helping customers get vehicle loans from leading banks and NBFCs.';
require 'includes/header.php';
page_hero('About Ensoar', 'Simplifying vehicle finance for families, entrepreneurs and transporters across Delhi NCR &amp; Uttar Pradesh.', '1486406146926-c627a92ad1ab', 'About');
?>
<section>
  <div class="wrap split">
    <div class="img-stack reveal l">
      <img class="main" src="<?= img('1556761175-5973dc0f32e7', 1000) ?>" alt="Ensoar team discussing a loan file" loading="lazy">
      <img class="sub" src="<?= img('1450101499163-c8848c66ca85', 700) ?>" alt="Customer signing loan documents" loading="lazy">
      <div class="tag">One Window<small>for all vehicle loans</small></div>
    </div>
    <div class="reveal r">
      <span class="eyebrow">Who We Are</span>
      <h2>A DSA that works for the customer</h2>
      <p class="lead" style="margin-top:16px">Ensoar Pvt. Ltd. is a registered company working as a Direct Selling Agent (DSA) for vehicle finance. We are the bridge between borrowers and lenders — understanding your profile, matching it with the right bank or NBFC, and managing the file end-to-end until the loan is disbursed.</p>
      <p style="margin-top:14px;color:var(--muted)">Buying a vehicle is a big decision. Different lenders have different rates, eligibility rules and processing times. Our job is to remove the confusion, save your time and get you the best deal your profile qualifies for.</p>
      <ul class="check-list">
        <li><?= icon('check') ?> Salaried, self-employed, professionals &amp; farmers</li>
        <li><?= icon('check') ?> New, used &amp; commercial vehicles, two-wheelers &amp; EVs</li>
        <li><?= icon('check') ?> Support for first-time borrowers and low CIBIL cases*</li>
      </ul>
    </div>
  </div>
</section>

<section class="bg-soft">
  <div class="wrap">
    <div class="sec-head reveal"><span class="eyebrow">What Drives Us</span><h2>Mission, vision &amp; values</h2></div>
    <div class="values" data-stagger>
      <div class="mv"><?= icon('bolt') ?><h3>Our Mission</h3><p>To make vehicle ownership easy and affordable by delivering fast, transparent and customer-first loan solutions.</p></div>
      <div class="mv"><?= icon('users') ?><h3>Our Vision</h3><p>To be the most trusted auto finance partner in North India for customers, dealers and lenders alike.</p></div>
      <div class="mv"><?= icon('shield') ?><h3>Our Values</h3><p>Honesty in every conversation, respect for the customer's time, and complete confidentiality of their data.</p></div>
    </div>
  </div>
</section>

<section>
  <div class="wrap">
    <div class="sec-head reveal"><span class="eyebrow">What We Do</span><h2>End-to-end loan assistance</h2><p>We stay with you from the first call till the keys are in your hand.</p></div>
    <div class="features" data-stagger>
      <div class="feature"><div class="fi"><?= icon('users') ?></div><h3>Profile Assessment</h3><p>We review your income, CIBIL and vehicle choice to find realistic loan options.</p></div>
      <div class="feature"><div class="fi"><?= icon('bank') ?></div><h3>Lender Matching</h3><p>Your file goes to the lender most likely to approve it at the best rate.</p></div>
      <div class="feature"><div class="fi"><?= icon('doc') ?></div><h3>Documentation</h3><p>Doorstep pickup, verification support and coordination with the lender.</p></div>
      <div class="feature"><div class="fi"><?= icon('car') ?></div><h3>Dealer Coordination</h3><p>We coordinate with the dealer for DO, disbursal and on-time delivery.</p></div>
    </div>
  </div>
</section>

<section class="bg-soft">
  <div class="wrap split rev">
    <div class="reveal r">
      <span class="eyebrow">Our Offices</span>
      <h2>Visit us in Indirapuram</h2>
      <div class="info-cards" style="margin-top:26px">
        <div class="info"><div class="fi"><?= icon('pin') ?></div><div><h4>Corporate Office</h4><p><?= OFFICE_ADDR ?></p></div></div>
        <div class="info"><div class="fi"><?= icon('home') ?></div><div><h4>Registered Office</h4><p><?= REG_ADDR ?></p></div></div>
        <div class="info"><div class="fi"><?= icon('phone') ?></div><div><h4>Call / WhatsApp</h4><a href="tel:+<?= PHONE_RAW ?>"><?= PHONE ?></a></div></div>
      </div>
    </div>
    <div class="reveal l z">
      <img src="<?= img('1497366216548-37526070297c', 1100) ?>" alt="Ensoar office" loading="lazy" style="border-radius:24px;box-shadow:var(--shadow-lg);aspect-ratio:4/3;object-fit:cover;width:100%">
    </div>
  </div>
</section>
<?php require 'includes/footer.php'; ?>
