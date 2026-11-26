<?php
$page = 'contact';
$title = 'Contact Us | Apply for Vehicle Loan – Ensoar Pvt. Ltd.';
$desc = 'Contact Ensoar Pvt. Ltd., Aditya City Center, Indirapuram, Ghaziabad. Call or WhatsApp +91 96544 02358 to apply for a vehicle loan.';
require 'includes/header.php';
require 'includes/form.php';
page_hero('Contact &amp; Apply', 'Call, WhatsApp or drop in — or fill the form and our advisor will reach you.', '1497366216548-37526070297c', 'Contact');
?>
<section class="bg-soft">
  <div class="wrap">
    <div class="contact-grid">
      <div class="info-cards" data-stagger>
        <div class="info"><div class="fi"><?= icon('phone') ?></div><div><h4>Call / WhatsApp</h4><a href="tel:+<?= PHONE_RAW ?>"><?= PHONE ?></a><br><a href="https://wa.me/<?= PHONE_RAW ?>" target="_blank" rel="noopener">Chat on WhatsApp →</a></div></div>
        <div class="info"><div class="fi"><?= icon('mail') ?></div><div><h4>Email</h4><a href="mailto:<?= EMAIL ?>"><?= EMAIL ?></a></div></div>
        <div class="info"><div class="fi"><?= icon('pin') ?></div><div><h4>Corporate Office</h4><p><?= OFFICE_ADDR ?></p></div></div>
        <div class="info"><div class="fi"><?= icon('home') ?></div><div><h4>Registered Office</h4><p><?= REG_ADDR ?></p></div></div>
        <div class="info"><div class="fi"><?= icon('clock') ?></div><div><h4>Working Hours</h4><p><?= HOURS ?></p></div></div>
      </div>
      <div class="form-card reveal r" id="apply">
        <span class="eyebrow">Apply Online</span>
        <h2 style="font-size:1.8rem;margin-bottom:20px">Get your free loan quote</h2>
        <?php if (isset($_GET['err'])): ?><div class="alert err">Please enter your name, a valid email, a valid 10-digit mobile number, loan type and city.</div><?php endif; ?>
        <?php if (isset($_GET['sent'])): ?><div class="alert ok">Thank you! Your enquiry has been received.</div><?php endif; ?>
        <?php lead_form('loan'); ?>
      </div>
    </div>
    <div class="map reveal">
      <iframe src="https://maps.google.com/maps?q=<?= rawurlencode('Aditya City Center, Vaibhav Khand, Indirapuram, Ghaziabad') ?>&z=16&output=embed" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Ensoar office location map"></iframe>
    </div>
  </div>
</section>
<script type="application/ld+json"><?= json_encode(['@context' => 'https://schema.org', '@type' => 'FinancialService', 'name' => SITE_NAME, 'telephone' => PHONE, 'email' => EMAIL, 'address' => ['@type' => 'PostalAddress', 'streetAddress' => '2nd Floor, S-4, Aditya City Center, Vaibhav Khand, Indirapuram', 'addressLocality' => 'Ghaziabad', 'addressRegion' => 'Uttar Pradesh', 'postalCode' => '201014', 'addressCountry' => 'IN']], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?></script>
<?php require 'includes/footer.php'; ?>
