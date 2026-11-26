<?php
// Shared enquiry form. $kind = 'loan' | 'partner'; $compact = fewer fields (hero card).
function lead_form(string $kind = 'loan', bool $compact = false): void { ?>
<form class="form-grid<?= $compact ? '' : ' two' ?>" action="submit.php" method="post">
  <input type="hidden" name="kind" value="<?= $kind ?>">
  <input type="text" name="website" class="hp" tabindex="-1" autocomplete="off" aria-hidden="true">
  <div class="field"><label for="n-<?= $kind . $compact ?>">Full Name *</label><input id="n-<?= $kind . $compact ?>" name="name" required maxlength="80" autocomplete="name" placeholder="Your name"></div>
  <div class="field"><label for="p-<?= $kind . $compact ?>">Mobile Number *</label><input id="p-<?= $kind . $compact ?>" name="phone" type="tel" required pattern="[6-9][0-9]{9}" maxlength="10" inputmode="numeric" autocomplete="tel-national" placeholder="10-digit mobile"></div>
  <?php if ($kind === 'partner'): ?>
    <div class="field"><label for="t-partner">I am a *</label><select id="t-partner" name="loan" required><option value="">Select</option><option>Car / Two-wheeler Dealer</option><option>Sub-DSA / Connector</option><option>Insurance / Finance Advisor</option><option>Other</option></select></div>
  <?php else: ?>
    <div class="field"><label for="l-<?= $kind . $compact ?>">Loan Type *</label><select id="l-<?= $kind . $compact ?>" name="loan" required><option value="">Select loan</option><?php foreach (LOANS as $l): ?><option<?= ($_GET['loan'] ?? '') === $l[0] ? ' selected' : '' ?>><?= $l[0] ?></option><?php endforeach; ?></select></div>
  <?php endif; ?>
  <div class="field"><label for="c-<?= $kind . $compact ?>">City *</label><input id="c-<?= $kind . $compact ?>" name="city" required maxlength="60" placeholder="e.g. Ghaziabad"></div>
  <?php if (!$compact): ?>
    <?php if ($kind !== 'partner'): ?>
      <div class="field"><label for="a-<?= $kind ?>">Loan Amount (₹)</label><input id="a-<?= $kind ?>" name="amount" inputmode="numeric" maxlength="12" placeholder="e.g. 8,00,000"></div>
      <div class="field"><label for="i-<?= $kind ?>">Income Type</label><select id="i-<?= $kind ?>" name="income"><option>Salaried</option><option>Self-employed / Business</option><option>Professional</option><option>Farmer / Agriculture</option></select></div>
    <?php endif; ?>
    <div class="field full"><label for="m-<?= $kind ?>">Message</label><textarea id="m-<?= $kind ?>" name="message" rows="3" maxlength="600" placeholder="Tell us about your requirement"></textarea></div>
  <?php endif; ?>
  <div class="field full">
    <button class="btn btn-accent" type="submit"><?= $kind === 'partner' ? 'Become a Partner' : 'Get Free Loan Quote' ?> <?= icon('arrow') ?></button>
    <p class="form-note">By submitting, you agree to be contacted by Ensoar on call / WhatsApp. We never charge upfront fees.</p>
  </div>
</form>
<?php }
