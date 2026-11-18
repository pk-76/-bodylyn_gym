<section class="sec why" id="why" aria-labelledby="why-title">
  <div class="wrap">
    <header class="sec__head grid12">
      <div class="sec__head-l">
        <p class="eyebrow eyebrow--light">Why BODYLYN</p>
        <h2 class="display h2" id="why-title" data-reveal>
          <?= lines(['FIVE REASONS', 'MEMBERS <em>STAY.</em>']) ?>
        </h2>
      </div>
      <p class="sec__intro" data-fade>We don't sell memberships to machines. We build strength, confidence and habits — and these are the standards behind every session.</p>
    </header>

    <ol class="why__list">
      <?php foreach (site()['why'] as $i => $w): ?>
        <li class="why__row" data-fade style="--d:<?= $i * .05 ?>s">
          <span class="why__n display" aria-hidden="true">0<?= $i + 1 ?></span>
          <h3 class="why__t display"><?= e($w['title']) ?></h3>
          <p class="why__p"><?= e($w['text']) ?></p>
          <span class="why__i"><?= icon($w['icon']) ?></span>
        </li>
      <?php endforeach; ?>
    </ol>
  </div>
</section>
