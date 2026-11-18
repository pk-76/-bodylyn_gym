<?php $c = site(); ?>
<section class="sec sec--light reviews" id="reviews" aria-labelledby="rv-title">
  <div class="wrap">
    <header class="sec__head grid12 reviews__head">
      <div class="sec__head-l">
        <p class="eyebrow">Google reviews</p>
        <h2 class="display h2" id="rv-title" data-reveal>
          <?= lines(['WHAT MEMBERS', 'SAY <em>ABOUT US.</em>']) ?>
        </h2>
      </div>

      <div class="rating" data-fade>
        <p class="rating__score display"><?= e((string) $c['rating']) ?><span><?= icon('star') ?></span></p>
        <div>
          <p class="rating__stars" role="img" aria-label="<?= e((string) $c['rating']) ?> out of 5 stars"><?php for ($s = 0; $s < 5; $s++) echo icon('star'); ?></p>
          <p class="rating__meta"><strong><?= (int) $c['reviews'] ?>+ reviews</strong> on Google</p>
        </div>
      </div>
    </header>
  </div>

  <div class="rv" data-fade>
    <div class="rv__track" data-track tabindex="0" role="region" aria-label="Member reviews, scroll horizontally">
      <?php foreach ($c['review_list'] as $r): ?>
        <figure class="rcard">
          <div class="rcard__top">
            <p class="rcard__stars" role="img" aria-label="<?= (int) $r['stars'] ?> out of 5 stars"><?php for ($s = 0; $s < (int) $r['stars']; $s++) echo icon('star'); ?></p>
            <span class="chip"><?= e($r['theme']) ?></span>
          </div>
          <blockquote><p>“<?= e($r['quote']) ?>”</p></blockquote>
          <figcaption>
            <span class="rcard__avatar" aria-hidden="true"><?= e(mb_substr($r['name'], 0, 1)) ?></span>
            <span><?= e($r['name']) ?><small>via Google</small></span>
          </figcaption>
        </figure>
      <?php endforeach; ?>
    </div>
  </div>

  <div class="wrap reviews__foot">
    <div class="rv__ctrl">
      <button class="round" type="button" data-prev aria-label="Previous reviews"><?= icon('arrow-l') ?></button>
      <button class="round" type="button" data-next aria-label="Next reviews"><?= icon('arrow-r') ?></button>
    </div>
    <a class="btn btn--dark" href="<?= e($c['google_reviews_url']) ?>" target="_blank" rel="noopener">Read all reviews on Google <?= icon('arrow-ur') ?></a>
  </div>
  <div class="wrap"><?= placeholder_note('Review excerpts are sample copy based on common themes. Paste real Google reviews (and reviewer names) before launch.') ?></div>
</section>
