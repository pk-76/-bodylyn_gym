<section class="sec sec--char trainers" id="trainers" aria-labelledby="tr-title">
  <span class="bgword" aria-hidden="true">COACHES</span>
  <div class="wrap">
    <header class="sec__head grid12">
      <div class="sec__head-l">
        <p class="eyebrow eyebrow--light">Meet our trainers</p>
        <h2 class="display h2" id="tr-title" data-reveal>
          <?= lines(['COACHES WHO', '<em>SHOW UP</em>', 'FOR YOU.']) ?>
        </h2>
      </div>
      <p class="sec__intro" data-fade>Experienced, approachable and obsessed with good form. Your trainer learns your goals — then holds you to them.</p>
    </header>

    <div class="trainers__grid">
      <?php foreach (site()['trainers'] as $i => $t): ?>
        <article class="tcard tile" data-fade style="--d:<?= $i * .08 ?>s" tabindex="0">
          <div class="tile__img">
            <?= photo($t['key'], $t['alt'], ['ratio' => 3 / 4, 'widths' => [360, 560, 800], 'sizes' => '(min-width:1024px) 22vw, 46vw']) ?>
          </div>
          <div class="tile__shade" aria-hidden="true"></div>
          <div class="tcard__body">
            <h3 class="display"><?= e($t['name']) ?></h3>
            <p class="tcard__spec"><?= e($t['specialty']) ?></p>
            <p class="tcard__yrs"><span><?= e($t['years']) ?>+</span> years experience</p>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
    <?= placeholder_note('Trainer names, specialties and experience are sample content — replace in includes/config.php.') ?>
  </div>
</section>
