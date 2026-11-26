<?php
$page = 'eligibility';
$title = 'Vehicle Loan Eligibility & Documents | Ensoar Pvt. Ltd.';
$desc = 'Check vehicle loan eligibility criteria and the documents required for salaried and self-employed applicants.';
require 'includes/header.php';
page_hero('Eligibility &amp; Documents', 'Check if you qualify and keep these documents ready for a faster approval.', '1450101499163-c8848c66ca85', 'Eligibility');

$profiles = [
    'Salaried' => [
        ['Age 21 – 60 years (at loan maturity)', 'Minimum net salary ₹15,000/month*', 'At least 1 year total work experience', '6 months in current job', 'CIBIL score 650+ preferred'],
        ['PAN card &amp; Aadhaar card', 'Passport size photographs', 'Last 3 months salary slips', 'Last 6 months bank statement', 'Form 16 / ITR (for higher amounts)', 'Address proof (if different from Aadhaar)'],
    ],
    'Self-Employed' => [
        ['Age 21 – 65 years (at loan maturity)', 'Business stable for 2+ years', 'Annual income ₹2 lakh+*', 'Own house or office preferred', 'CIBIL score 650+ preferred'],
        ['PAN card &amp; Aadhaar card', 'Passport size photographs', 'Last 2 years ITR with computation', 'Last 12 months bank statement', 'Business proof (GST / Udyam / Shop Act)', 'Office &amp; residence address proof'],
    ],
    'Commercial Vehicle' => [
        ['Age 21 – 65 years', 'Transport experience or first-time buyer scheme*', 'Guarantor may be required', 'Valid driving licence (for owner-drivers)', 'Route / contract details helpful'],
        ['KYC: PAN, Aadhaar, photographs', 'Last 6–12 months bank statement', 'Existing vehicle RCs (fleet owners)', 'ITR / income proof (if available)', 'Quotation / proforma invoice', 'Residence ownership proof'],
    ],
];
?>
<section class="bg-soft">
  <div class="wrap" data-tabs>
    <div class="sec-head reveal"><span class="eyebrow">Check Eligibility</span><h2>Select your profile</h2></div>
    <div class="tabs reveal" role="tablist">
      <?php $i = 0; foreach ($profiles as $name => $_): ?><button class="tab<?= $i++ ? '' : ' on' ?>" type="button" role="tab"><?= $name ?></button><?php endforeach; ?>
    </div>
    <?php $i = 0; foreach ($profiles as $name => [$elig, $docs]): ?>
    <div class="panel doc-grid<?= $i++ ? '' : ' on' ?>" role="tabpanel">
      <div class="box"><h3><?= icon('users') ?> Eligibility – <?= $name ?></h3><ul><?php foreach ($elig as $x): ?><li><?= icon('check') ?> <?= $x ?></li><?php endforeach; ?></ul></div>
      <div class="box"><h3><?= icon('doc') ?> Documents Required</h3><ul><?php foreach ($docs as $x): ?><li><?= icon('check') ?> <?= $x ?></li><?php endforeach; ?></ul></div>
    </div>
    <?php endforeach; ?>
    <p class="form-note" style="text-align:center;margin-top:24px">*Criteria vary by lender and product. Our advisor will confirm the exact list for your case.</p>
  </div>
</section>

<section>
  <div class="wrap split">
    <div class="reveal l z"><img src="<?= img('1573496359142-b8d87734a5a2', 1100) ?>" alt="Ensoar advisor helping with documents" loading="lazy" style="border-radius:24px;box-shadow:var(--shadow-lg);aspect-ratio:4/3;object-fit:cover;width:100%"></div>
    <div class="reveal r">
      <span class="eyebrow">Low CIBIL? New to credit?</span>
      <h2>We still try to find you a way</h2>
      <p class="lead" style="margin:16px 0 22px">Many lenders have special programs for first-time borrowers, low-score applicants and cash-income customers. Share your details and our team will check which options fit your profile.</p>
      <ul class="check-list">
        <li><?= icon('check') ?> Free credit profile review</li>
        <li><?= icon('check') ?> Co-applicant / guarantor guidance</li>
        <li><?= icon('check') ?> Doorstep document collection</li>
      </ul>
      <a href="contact.php#apply" class="btn btn-accent">Check My Eligibility <?= icon('arrow') ?></a>
    </div>
  </div>
</section>
<?php require 'includes/footer.php'; ?>
