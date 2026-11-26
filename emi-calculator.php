<?php
$page = 'emi';
$title = 'Car Loan EMI Calculator | Ensoar Pvt. Ltd.';
$desc = 'Calculate your car, bike or commercial vehicle loan EMI instantly with Ensoar\'s free EMI calculator.';
require 'includes/header.php';
page_hero('Vehicle Loan EMI Calculator', 'Move the sliders to see your monthly EMI, total interest and total payment — instantly.', '1580273916550-e323be2ae537', 'EMI Calculator');
?>
<section class="bg-soft">
  <div class="wrap">
    <div class="calc reveal z" id="emi">
      <div class="calc-in">
        <div class="range">
          <div class="range-top"><label for="amt">Loan Amount (₹)</label><input id="amt-n" type="number" value="800000" aria-label="Loan amount"></div>
          <input type="range" id="amt" min="50000" max="5000000" step="10000" value="800000">
          <div class="range-scale"><span>₹50K</span><span>₹50L</span></div>
        </div>
        <div class="range">
          <div class="range-top"><label for="rate">Interest Rate (% p.a.)</label><input id="rate-n" type="number" step="0.1" value="9.5" aria-label="Interest rate"></div>
          <input type="range" id="rate" min="6" max="24" step="0.1" value="9.5">
          <div class="range-scale"><span>6%</span><span>24%</span></div>
        </div>
        <div class="range">
          <div class="range-top"><label for="yrs">Tenure (Years)</label><input id="yrs-n" type="number" value="5" aria-label="Tenure in years"></div>
          <input type="range" id="yrs" min="1" max="7" step="1" value="5">
          <div class="range-scale"><span>1 Yr</span><span>7 Yrs</span></div>
        </div>
        <p class="form-note">The calculator gives an indicative EMI. Actual rate depends on lender, vehicle and your credit profile.</p>
      </div>
      <div class="calc-out">
        <h3>Your Monthly EMI</h3>
        <div class="emi-big" id="emi-out" aria-live="polite">₹0</div>
        <div class="donut" role="img" aria-label="Principal vs interest"></div>
        <div class="breakup">
          <div><span><i class="dot" style="background:#3d6fc4"></i>Principal</span><b id="p-out">₹0</b></div>
          <div><span><i class="dot" style="background:var(--accent)"></i>Total Interest</span><b id="i-out">₹0</b></div>
          <div><span>Total Payment</span><b id="t-out">₹0</b></div>
        </div>
        <a href="contact.php#apply" class="btn btn-accent" style="margin-top:28px;justify-content:center">Get This Loan <?= icon('arrow') ?></a>
      </div>
    </div>
  </div>
</section>

<section>
  <div class="wrap">
    <div class="sec-head reveal"><span class="eyebrow">Tips</span><h2>How to lower your EMI</h2></div>
    <div class="features" data-stagger>
      <div class="feature"><div class="fi"><?= icon('cash') ?></div><h3>Higher Down Payment</h3><p>Paying 15–20% upfront reduces the loan amount and total interest.</p></div>
      <div class="feature"><div class="fi"><?= icon('shield') ?></div><h3>Good CIBIL Score</h3><p>A score of 750+ helps you get the best rates from banks.</p></div>
      <div class="feature"><div class="fi"><?= icon('clock') ?></div><h3>Right Tenure</h3><p>Longer tenure lowers EMI; shorter tenure saves interest. Balance both.</p></div>
      <div class="feature"><div class="fi"><?= icon('bank') ?></div><h3>Compare Lenders</h3><p>Even 0.5% lower rate saves thousands — that's exactly what we do for you.</p></div>
    </div>
  </div>
</section>
<?php require 'includes/footer.php'; ?>
