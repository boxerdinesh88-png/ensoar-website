<?php
$page = 'faq';
$title = 'FAQ | Vehicle Loan Questions – Ensoar Pvt. Ltd.';
$desc = 'Answers to common questions about car loans, used car loans, EMI, documents and Ensoar\'s DSA services.';
require 'includes/header.php';
page_hero('Frequently Asked Questions', 'Everything you want to know about vehicle loans and how Ensoar helps.', '1549317661-bd32c8ce0db2', 'FAQ');

$faqs = [
    'What is a DSA and how does Ensoar help me?' => 'A Direct Selling Agent (DSA) is authorised to source loan applications for banks and NBFCs. Ensoar understands your requirement, compares lenders, prepares your file and coordinates until the loan is disbursed — saving you time and helping you get a better deal.',
    'Do I have to pay Ensoar any fee?' => 'No. Our consultation is free and we never ask for any upfront fee to sanction a loan. Only the lender\'s official processing fee, stamp duty and other charges (as per their policy) apply, and these are explained to you in advance.',
    'How much loan can I get for a new car?' => 'Depending on your income and credit profile, lenders may fund up to 100% of the on-road price for selected models. Typically, 80–90% funding is common for most profiles.',
    'How long does approval take?' => 'With complete documents, many cases get sanctioned within 24–48 hours. Commercial vehicle and self-employed cases may take a little longer due to verification.',
    'Can I get a loan with a low CIBIL score?' => 'It may be possible. Some lenders offer programs for low-score or new-to-credit customers, sometimes with a co-applicant or higher down payment. Share your details and we will check the options.',
    'Can I get a loan for a car bought from an individual seller?' => 'Yes. Used car loans are available for both dealer and private purchases. We guide you through valuation and RC transfer.',
    'Can I prepay or foreclose my vehicle loan?' => 'Yes, most lenders allow part-prepayment and foreclosure after a minimum number of EMIs. Charges vary by lender and are shared before you sign.',
    'Is my personal information safe with Ensoar?' => 'Yes. Your documents are used only for processing your loan application with the chosen lender and are never sold or shared with unrelated parties.',
    'Which areas do you serve?' => 'We are based in Indirapuram, Ghaziabad and serve customers across Delhi NCR — Ghaziabad, Noida, Greater Noida, Delhi, and nearby areas of Uttar Pradesh. Contact us to check service in your city.',
];
?>
<section class="bg-soft">
  <div class="wrap">
    <div class="faq" data-stagger>
      <?php foreach ($faqs as $q => $a): ?>
      <details><summary><?= e($q) ?></summary><p><?= e($a) ?></p></details>
      <?php endforeach; ?>
    </div>
    <p style="text-align:center;margin-top:40px" class="reveal">Still have a question? <a href="contact.php" style="color:var(--navy);font-weight:700">Contact our team →</a></p>
  </div>
</section>
<script type="application/ld+json"><?= json_encode(['@context' => 'https://schema.org', '@type' => 'FAQPage', 'mainEntity' => array_map(fn($q, $a) => ['@type' => 'Question', 'name' => $q, 'acceptedAnswer' => ['@type' => 'Answer', 'text' => $a]], array_keys($faqs), $faqs)], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?></script>
<?php require 'includes/footer.php'; ?>
