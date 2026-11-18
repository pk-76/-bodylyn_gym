<?php $c = site(); $st = open_status(); $today = (new DateTimeImmutable('now', new DateTimeZone($c['timezone'])))->format('l'); ?>
<section class="sec location" id="contact" aria-labelledby="loc-title">
  <div class="wrap">
    <header class="sec__head grid12">
      <div class="sec__head-l">
        <p class="eyebrow eyebrow--light">Visit · Contact</p>
        <h2 class="display h2" id="loc-title" data-reveal>
          <?= lines(['FIND US IN', '<em>MANGO.</em>']) ?>
        </h2>
      </div>
      <div class="sec__intro">
        <span class="status <?= $st['open'] ? 'is-open' : 'is-closed' ?>" data-open-badge data-fade>
          <i aria-hidden="true"></i><span data-open-text><?= e($st['text']) ?></span>
        </span>
      </div>
    </header>

    <div class="grid12 location__grid">
      <div class="map" data-fade>
        <iframe title="Map showing <?= e($c['name']) ?> at Purno Deep Complex, Dimna Road, Mango, Jamshedpur" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                src="https://maps.google.com/maps?q=<?= rawurlencode($c['map_query']) ?>&amp;output=embed&amp;z=16"></iframe>
      </div>

      <div class="location__info" data-fade style="--d:.1s">
        <div class="info">
          <h3><?= icon('pin') ?> Address</h3>
          <address><?= e($c['address_full']) ?></address>
        </div>

        <div class="info">
          <h3><?= icon('clock') ?> Hours</h3>
          <table class="hours">
            <tbody>
              <?php foreach ($c['hours'] as $day => $r): ?>
                <tr data-day="<?= e($day) ?>"<?= $day === $today ? ' class="is-today"' : '' ?><?= $r ? '' : ' data-closed' ?>>
                  <th scope="row"><?= e($day) ?></th>
                  <td><?= $r ? e(fmt_time($r[0]) . ' – ' . fmt_time($r[1])) : '<span class="closed">Closed</span>' ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>

        <div class="location__cta">
          <a class="btn btn--lime" href="<?= e(directions_link()) ?>" target="_blank" rel="noopener"><?= icon('pin') ?> Get Directions</a>
          <a class="btn btn--ghost" href="<?= e(tel_link()) ?>"><?= icon('phone') ?> Call Now</a>
          <a class="btn btn--ghost" href="<?= e(wa_link("Hi BODYLYN GYM! I have a question.")) ?>" target="_blank" rel="noopener"><?= icon('whatsapp') ?> WhatsApp Us</a>
        </div>
      </div>
    </div>
  </div>
  <script type="application/json" id="hours-data"><?= hours_json() ?></script>
</section>
