<?php $c = site(); ?>
<section class="sec trial grain" id="trial" aria-labelledby="trial-title">
  <span class="bgword" aria-hidden="true">FREE TRIAL</span>
  <div class="wrap grid12 trial__grid">

    <div class="trial__copy">
      <p class="eyebrow eyebrow--light">Free trial · Membership enquiry</p>
      <h2 class="display h2 h2--xl" id="trial-title" data-reveal>
        <?= lines(['YOUR FIRST', 'WORKOUT', 'IS <em>ON US.</em>']) ?>
      </h2>
      <p class="lead" data-fade>Walk in, meet the trainers, and experience a real BODYLYN session — no pressure, no pitch. Tell us a little about your goal and we'll confirm your slot on WhatsApp.</p>

      <ol class="steps" data-fade>
        <li><span>01</span><div><strong>Tell us your goal</strong><p>Takes under a minute.</p></div></li>
        <li><span>02</span><div><strong>We confirm on WhatsApp</strong><p>Pick a time that suits you.</p></div></li>
        <li><span>03</span><div><strong>Train with a coach</strong><p>Your free session, guided start to finish.</p></div></li>
      </ol>
      <p class="trial__note" data-fade>Membership plans are shared personally — <a href="<?= e(wa_link("Hi BODYLYN GYM! Please share membership plan details.")) ?>" target="_blank" rel="noopener">enquire on WhatsApp</a>.</p>
    </div>

    <div class="trial__card" data-fade style="--d:.15s">
      <form class="form" id="trial-form" action="enquire.php" method="post" novalidate data-wa="<?= e($c['wa_number']) ?>">
        <?php if (isset($_GET['error'])): ?>
          <p class="form__alert" role="alert">Please enter your name and a valid 10-digit mobile number.</p>
        <?php endif; ?>

        <div class="field">
          <label for="f-name">Your name</label>
          <input id="f-name" name="name" type="text" autocomplete="name" placeholder="e.g. Rahul Kumar" required maxlength="60">
          <p class="field__err" data-err="name" aria-live="polite"></p>
        </div>

        <div class="field">
          <label for="f-phone">Phone / WhatsApp number</label>
          <input id="f-phone" name="phone" type="tel" inputmode="tel" autocomplete="tel" placeholder="98765 43210" required maxlength="18">
          <p class="field__err" data-err="phone" aria-live="polite"></p>
        </div>

        <fieldset class="field">
          <legend>Fitness goal</legend>
          <div class="chips">
            <?php foreach ($c['goals'] as $i => $g): ?>
              <span class="chipr">
                <input type="radio" name="goal" id="goal-<?= $i ?>" value="<?= e($g) ?>"<?= $i === 0 ? ' checked' : '' ?>>
                <label for="goal-<?= $i ?>"><?= e($g) ?></label>
              </span>
            <?php endforeach; ?>
          </div>
        </fieldset>

        <fieldset class="field">
          <legend>Preferred time</legend>
          <div class="chips">
            <?php foreach ($c['times'] as $i => $t): ?>
              <span class="chipr">
                <input type="radio" name="time" id="time-<?= $i ?>" value="<?= e($t) ?>"<?= $i === 0 ? ' checked' : '' ?>>
                <label for="time-<?= $i ?>"><?= e($t) ?></label>
              </span>
            <?php endforeach; ?>
          </div>
        </fieldset>

        <fieldset class="field">
          <legend>Interested in personal training?</legend>
          <div class="chips">
            <span class="chipr"><input type="radio" name="pt" id="pt-yes" value="Yes"><label for="pt-yes">Yes</label></span>
            <span class="chipr"><input type="radio" name="pt" id="pt-no" value="No" checked><label for="pt-no">No</label></span>
          </div>
        </fieldset>

        <button class="btn btn--lime btn--lg btn--block" type="submit">
          <?= icon('whatsapp') ?> Book my free trial on WhatsApp
        </button>
        <p class="form__fine">Opens WhatsApp with your details pre-filled. We never share your number.</p>
      </form>

      <div class="success" id="trial-success" hidden role="status" tabindex="-1">
        <svg class="success__tick" viewBox="0 0 80 80" aria-hidden="true"><circle cx="40" cy="40" r="36" /><path d="M24 41l11 11 21-24" /></svg>
        <h3 class="display">YOU'RE IN, <span data-name>CHAMP</span>.</h3>
        <p>We're opening WhatsApp with your details. Just press <strong>Send</strong> and we'll confirm your free session.</p>
        <a class="btn btn--lime" data-wa-fallback href="<?= e(wa_link()) ?>" target="_blank" rel="noopener">Open WhatsApp again <?= icon('arrow-ur') ?></a>
        <button class="linkbtn" type="button" data-form-reset>Edit my details</button>
      </div>
    </div>

  </div>
</section>
