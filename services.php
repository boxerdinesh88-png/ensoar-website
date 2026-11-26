<?php
$page = 'services';
$title = 'Vehicle Loans | New Car, Used Car, Commercial & Two-Wheeler – Ensoar';
$desc = 'New car loans, used car loans, commercial vehicle loans, two-wheeler loans, loan against car and balance transfer through leading banks and NBFCs.';
require 'includes/header.php';
page_hero('Our Loan Products', 'Six vehicle finance solutions, one trusted advisor. Pick what you need — we find the right lender.', '1503376780353-7e6692767b70', 'Loans');

// Per-product details: features, who it's for, typical terms (indicative only).
$detail = [
    'new-car' => ['Finance any new car from any brand — hatchback, sedan, SUV or EV. Get pre-approved offers before you visit the showroom and negotiate like a cash buyer.',
        ['Up to 100% on-road funding*', 'Tenure 1 – 7 years', 'Attractive rates from multiple lenders', 'Special offers on EVs'], ['Salaried', 'Self-employed', 'Professionals']],
    'used-car' => ['Buying a pre-owned car from a dealer or an individual? We arrange valuation, RC transfer guidance and a loan on up to 85–90% of the car value*.',
        ['Cars up to 10–12 years old at maturity*', 'Tenure up to 5 years', 'Dealer &amp; private-seller purchases', 'Quick valuation support'], ['Salaried', 'Self-employed', 'First-time buyers']],
    'commercial' => ['Grow your transport business with finance for trucks, tippers, pickups, buses, school vans and LCVs — new or used.',
        ['First-time buyer &amp; first-time user schemes*', 'Fleet owner programs', 'Flexible EMI options', 'Refinance on existing CVs'], ['Transporters', 'Fleet owners', 'Contractors']],
    'two-wheeler' => ['Bikes, scooters and electric two-wheelers with minimal documentation and low down payment.',
        ['Funding up to 95% of on-road price*', 'Tenure up to 4 years', 'Minimal documents', 'EV two-wheelers covered'], ['Students (with co-applicant)', 'Salaried', 'Gig workers']],
    'loan-against-car' => ['Need funds for business, education, medical or a wedding? Use your car as security and get a loan while you keep using the car.',
        ['Up to 150% of car value on top-up programs*', 'Car stays with you', 'Funds in as fast as 48 hrs*', 'Use money for any purpose'], ['Car owners', 'Business owners', 'Salaried']],
    'balance-transfer' => ['Paying a high rate on your current car loan? Shift it to a lender with a lower rate and take an extra top-up on the same car.',
        ['Lower EMI or shorter tenure', 'Additional top-up amount', 'Minimal paperwork', 'Free foreclosure-cost analysis'], ['Existing car-loan customers', '6+ EMIs paid']],
];
?>
<section>
  <div class="wrap">
    <?php foreach (LOANS as $slug => [$name, $ic, $photo, $text]): [$long, $feat, $for] = $detail[$slug]; ?>
    <article class="svc" id="<?= $slug ?>">
      <div class="svc-img reveal z"><img src="<?= img($photo, 1200) ?>" alt="<?= $name ?>" loading="lazy"></div>
      <div class="reveal">
        <h2><?= icon($ic) ?> <?= $name ?></h2>
        <p class="lead"><?= $long ?></p>
        <ul class="check-list" style="grid-template-columns:1fr 1fr;margin-bottom:10px">
          <?php foreach ($feat as $x): ?><li><?= icon('check') ?> <?= $x ?></li><?php endforeach; ?>
        </ul>
        <div class="chips"><?php foreach ($for as $x): ?><span class="chip"><?= $x ?></span><?php endforeach; ?></div>
        <a href="contact.php?loan=<?= urlencode($name) ?>#apply" class="btn btn-accent">Apply for <?= $name ?> <?= icon('arrow') ?></a>
      </div>
    </article>
    <?php endforeach; ?>
    <p class="form-note" style="text-align:center;margin-top:20px">*Indicative terms. Final loan amount, rate and tenure depend on the lender's policy and your credit profile.</p>
  </div>
</section>
<?php require 'includes/footer.php'; ?>
