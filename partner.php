<?php
$page = 'partner';
$title = 'Partner With Us | Dealers, Sub-DSA & Connectors – Ensoar';
$desc = 'Join Ensoar as a dealer partner, sub-DSA or connector and earn attractive payouts on every vehicle loan disbursed.';
require 'includes/header.php';
require 'includes/form.php';
page_hero('Partner With Ensoar', 'Dealers, connectors and advisors — grow your income with a reliable auto finance partner.', '1521791136064-7986c2920216', 'Partner With Us');
?>
<section>
  <div class="wrap">
    <div class="sec-head reveal"><span class="eyebrow">Who Can Join</span><h2>Partnership programs</h2><p>Refer customers, we handle lender coordination, documentation and disbursal. You earn on every successful case.</p></div>
    <div class="partner-types" data-stagger>
      <div class="ptype"><img src="<?= img('1568605117036-5fe5e7bab0b7', 900) ?>" alt="Car dealer showroom" loading="lazy"><div><h3>Vehicle Dealers</h3><p>Car, two-wheeler and CV dealers — offer instant finance options and close more sales.</p></div></div>
      <div class="ptype"><img src="<?= img('1551836022-d5d88e9218df', 900) ?>" alt="Sub-DSA connector" loading="lazy"><div><h3>Sub-DSA / Connectors</h3><p>Work independently, refer leads from your network and earn attractive payouts.</p></div></div>
      <div class="ptype"><img src="<?= img('1556742049-0cfed4f6a45d', 900) ?>" alt="Finance and insurance advisor" loading="lazy"><div><h3>Finance &amp; Insurance Advisors</h3><p>Add vehicle loans to your services and serve your clients end-to-end.</p></div></div>
    </div>
  </div>
</section>

<section class="bg-soft">
  <div class="wrap">
    <div class="sec-head reveal"><span class="eyebrow">Benefits</span><h2>Why partner with Ensoar</h2></div>
    <div class="features" data-stagger>
      <div class="feature"><div class="fi"><?= icon('cash') ?></div><h3>Attractive Payouts</h3><p>Competitive commission on every disbursed case, paid on time.</p></div>
      <div class="feature"><div class="fi"><?= icon('bank') ?></div><h3>Multiple Lenders</h3><p>Higher approval rate because every file goes to the best-fit lender.</p></div>
      <div class="feature"><div class="fi"><?= icon('chat') ?></div><h3>Live Case Updates</h3><p>Status updates on WhatsApp from login to disbursal.</p></div>
      <div class="feature"><div class="fi"><?= icon('users') ?></div><h3>Dedicated Manager</h3><p>A single point of contact for all your cases and queries.</p></div>
    </div>
  </div>
</section>

<section>
  <div class="wrap split">
    <div class="reveal l">
      <span class="eyebrow">Join in 3 steps</span>
      <h2>Start earning this week</h2>
      <ul class="check-list" style="margin-top:22px">
        <li><?= icon('check') ?> <span><strong>Register</strong> — fill the form, our team calls you within one working day.</span></li>
        <li><?= icon('check') ?> <span><strong>Onboard</strong> — simple KYC and partner agreement.</span></li>
        <li><?= icon('check') ?> <span><strong>Refer &amp; Earn</strong> — share leads, track status, get paid on disbursal.</span></li>
      </ul>
    </div>
    <div class="form-card reveal r" id="apply">
      <h3 style="margin-bottom:18px">Partner Registration</h3>
      <?php lead_form('partner'); ?>
    </div>
  </div>
</section>
<?php require 'includes/footer.php'; ?>
