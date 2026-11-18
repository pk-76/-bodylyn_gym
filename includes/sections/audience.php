<section class="sec audience" id="who" aria-labelledby="who-title">
  <div class="wrap">
    <header class="sec__head grid12">
      <div class="sec__head-l">
        <p class="eyebrow eyebrow--light">Who we train</p>
        <h2 class="display h2" id="who-title" data-reveal>
          <?= lines(['BUILT FOR', 'EVERY <em>STARTING</em>', 'POINT.']) ?>
        </h2>
      </div>
    </header>

    <div class="audience__grid">
      <?php foreach (site()['audiences'] as $i => $a): ?>
        <article class="acard" data-fade style="--d:<?= $i * .08 ?>s">
          <span class="acard__n display" aria-hidden="true">0<?= $i + 1 ?></span>
          <h3 class="display"><?= e($a['tag']) ?></h3>
          <p><?= e($a['text']) ?></p>
          <a class="acard__link" href="#trial">Start free <?= icon('arrow-ur') ?></a>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
