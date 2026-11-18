<?php $c = site(); $a = $c['about']; ?>
<section class="sec sec--light about" id="about" aria-labelledby="about-title">
  <span class="bgword bgword--light" aria-hidden="true">COACHING</span>
  <div class="wrap grid12 about__grid">

    <figure class="about__media" data-fade>
      <div class="about__frame">
        <div class="about__img" data-parallax="0.06">
          <?= photo('about', 'Bodybuilder mural on the brick wall beside spin bikes at BODYLYN GYM', ['ratio' => 4 / 5, 'widths' => [480, 720, 1000], 'sizes' => '(min-width:1024px) 46vw, 100vw']) ?>
        </div>
      </div>
      <figcaption class="about__badge">
        <strong class="display"><?= e((string) $c['rating']) ?> <?= icon('star') ?></strong>
        <span>Rated by <?= (int) $c['reviews'] ?>+ members on Google</span>
      </figcaption>
    </figure>

    <div class="about__copy">
      <p class="eyebrow">About BODYLYN</p>
      <h2 class="display h2" id="about-title" data-reveal>
        <?= lines(['MORE THAN A GYM.', 'A COACHING', '<em>CULTURE.</em>']) ?>
      </h2>
      <?php foreach ($a['paragraphs'] as $i => $p): ?>
        <p class="lead" data-fade style="--d:<?= .1 + $i * .1 ?>s"><?= e($p) ?></p>
      <?php endforeach; ?>

      <div class="pillars" data-fade>
        <p class="pillars__head">Our philosophy</p>
        <ol>
          <?php foreach ($a['pillars'] as $i => [$t, $d]): ?>
            <li>
              <span class="pillars__n">0<?= $i + 1 ?></span>
              <h3 class="display"><?= e($t) ?></h3>
              <p><?= e($d) ?></p>
            </li>
          <?php endforeach; ?>
        </ol>
      </div>
    </div>

  </div>
</section>
