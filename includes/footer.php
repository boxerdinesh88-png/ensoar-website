</main>
<?php if (($page ?? '') !== 'contact'): ?>
<section class="cta-band">
  <div class="wrap cta-inner reveal">
    <div>
      <h2>Ready to drive home your next vehicle?</h2>
      <p>Talk to an Ensoar loan advisor today — free consultation, no hidden charges.</p>
    </div>
    <div class="cta-actions">
      <a href="contact.php#apply" class="btn btn-accent">Apply for a Loan <?= icon('arrow') ?></a>
      <a href="tel:+<?= PHONE_RAW ?>" class="btn btn-ghost-light"><?= icon('phone') ?> <?= PHONE ?></a>
    </div>
  </div>
</section>
<?php endif; ?>
<footer class="site-footer">
  <div class="wrap footer-grid">
    <div>
      <img src="img/logo-white.png" alt="<?= SITE_NAME ?>" class="footer-logo" width="200" height="48" loading="lazy">
      <p>Ensoar Pvt. Ltd. is an auto finance Direct Selling Agent (DSA) helping individuals and businesses get the right vehicle loan from leading banks and NBFCs — quickly and transparently.</p>
      <a href="https://wa.me/<?= PHONE_RAW ?>" class="btn btn-accent btn-sm" target="_blank" rel="noopener"><?= icon('chat') ?> Chat on WhatsApp</a>
    </div>
    <div>
      <h4>Company</h4>
      <ul>
        <li><a href="about.php">About Us</a></li>
        <li><a href="partner.php">Partner With Us</a></li>
        <li><a href="eligibility.php">Eligibility &amp; Documents</a></li>
        <li><a href="emi-calculator.php">EMI Calculator</a></li>
        <li><a href="faq.php">FAQ</a></li>
        <li><a href="contact.php">Contact</a></li>
      </ul>
    </div>
    <div>
      <h4>Loans</h4>
      <ul>
        <?php foreach (LOANS as $slug => $l): ?>
          <li><a href="services.php#<?= $slug ?>"><?= $l[0] ?></a></li>
        <?php endforeach; ?>
      </ul>
    </div>
    <div>
      <h4>Reach Us</h4>
      <ul class="f-contact">
        <li><?= icon('pin') ?><span><strong>Office:</strong> <?= OFFICE_ADDR ?></span></li>
        <li><?= icon('home') ?><span><strong>Registered:</strong> <?= REG_ADDR ?></span></li>
        <li><?= icon('phone') ?><a href="tel:+<?= PHONE_RAW ?>"><?= PHONE ?></a></li>
        <li><?= icon('mail') ?><a href="mailto:<?= EMAIL ?>"><?= EMAIL ?></a></li>
      </ul>
    </div>
  </div>
  <div class="wrap disclaimer">
    <p><strong>Disclaimer:</strong> Ensoar Pvt. Ltd. acts as a Direct Selling Agent (DSA) and is not a lender. Loan approval, interest rate, tenure and charges are at the sole discretion of the respective bank / NBFC and subject to their credit policy. Ensoar never asks for any upfront fee to sanction a loan.</p>
    <p>&copy; <?= date('Y') ?> <?= SITE_NAME ?> All rights reserved.</p>
  </div>
</footer>
<a href="https://wa.me/<?= PHONE_RAW ?>?text=<?= rawurlencode('Hi Ensoar, I want to know about vehicle loans.') ?>" class="wa-float" target="_blank" rel="noopener" aria-label="Chat on WhatsApp">
  <svg viewBox="0 0 32 32" aria-hidden="true"><path fill="currentColor" d="M16 3a13 13 0 0 0-11.2 19.6L3 29l6.6-1.7A13 13 0 1 0 16 3zm0 23.7a10.7 10.7 0 0 1-5.5-1.5l-.4-.2-3.9 1 1-3.8-.2-.4A10.7 10.7 0 1 1 16 26.7zm5.9-8c-.3-.2-1.9-1-2.2-1s-.5-.2-.7.2-.8 1-1 1.2-.4.2-.7 0a8.8 8.8 0 0 1-4.4-3.8c-.3-.6.3-.5.9-1.7.1-.2 0-.4 0-.5l-1-2.4c-.3-.6-.5-.5-.7-.5h-.6a1.2 1.2 0 0 0-.9.4 3.6 3.6 0 0 0-1.1 2.7 6.3 6.3 0 0 0 1.3 3.3 14.4 14.4 0 0 0 5.5 4.9c2 .9 2.8 1 3.9.8a3.3 3.3 0 0 0 2.1-1.5 2.7 2.7 0 0 0 .2-1.5c-.1-.1-.3-.2-.6-.4z"/></svg>
</a>
<a href="#top" class="to-top" aria-label="Back to top"><?= icon('arrow') ?></a>
<script src="js/main.js?v=2" defer></script>
</body>
</html>
