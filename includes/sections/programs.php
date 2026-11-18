<?php
$p = site()['programs'];
$f = $p['featured'];
function program_wa(string $title): string {
    return wa_link("Hi BODYLYN GYM! I'm interested in the {$title}. Please share details.");
}
?>
<section class="sec sec--light programs" id="programs" aria-labelledby="prog-title">
  <span class="bgword bgword--light" aria-hidden="true">PROGRAMS</span>
  <div class="wrap">
    <header class="sec__head grid12">
      <div class="sec__head-l">
        <p class="eyebrow">Training programs</p>
        <h2 class="display h2" id="prog-title" data-reveal>
          <?= lines(['PICK YOUR GOAL.', 'WE BUILD THE <em>PLAN.</em>']) ?>
        </h2>
      </div>
      <p class="sec__intro" data-fade>Every program is coach-led, form-first and tailored to where you are today.</p>
    </header>

    <div class="programs__grid">

      <!-- Featured: Beginner Program (key conversion target) -->
      <a class="pcard pcard--feature tile" href="<?= e(program_wa($f['title'])) ?>" target="_blank" rel="noopener" data-fade aria-label="<?= e($f['title']) ?> — enquire on WhatsApp">
        <div class="tile__img">
          <?= photo($f['key'], $f['alt'], ['ratio' => 1.3, 'widths' => [480, 800, 1200], 'sizes' => '(min-width:1024px) 55vw, 100vw']) ?>
        </div>
        <div class="tile__shade" aria-hidden="true"></div>
        <span class="pcard__badge"><?= e($f['kicker']) ?></span>
        <div class="pcard__body">
          <h3 class="display pcard__title"><?= e($f['title']) ?></h3>
          <p class="pcard__line"><?= e($f['line']) ?></p>
          <p class="pcard__text"><?= e($f['text']) ?></p>
          <ul class="pcard__points">
            <?php foreach ($f['points'] as $pt): ?><li><?= icon('check') ?> <?= e($pt) ?></li><?php endforeach; ?>
          </ul>
          <span class="pcard__go btn btn--lime">Enquire now <?= icon('arrow-ur') ?></span>
        </div>
      </a>

      <?php foreach ($p['items'] as $i => $it): ?>
        <a class="pcard tile" href="<?= e(program_wa($it['title'])) ?>" target="_blank" rel="noopener" data-fade style="--d:<?= ($i % 3) * .08 ?>s" aria-label="<?= e($it['title']) ?> — enquire on WhatsApp">
          <div class="tile__img">
            <?= photo($it['key'], $it['alt'], ['ratio' => 4 / 5, 'widths' => [400, 640, 900], 'sizes' => '(min-width:1024px) 30vw, (min-width:640px) 50vw, 100vw']) ?>
          </div>
          <div class="tile__shade" aria-hidden="true"></div>
          <span class="pcard__idx" aria-hidden="true">0<?= $i + 1 ?></span>
          <div class="pcard__body">
            <h3 class="display pcard__title"><?= e($it['title']) ?></h3>
            <p class="pcard__line"><?= e($it['line']) ?></p>
            <span class="pcard__enq">Enquire <i><?= icon('arrow-ur') ?></i></span>
          </div>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
