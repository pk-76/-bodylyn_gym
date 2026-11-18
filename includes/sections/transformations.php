<section class="sec transformations" id="transformations" aria-labelledby="tf-title">
  <div class="wrap">
    <header class="sec__head grid12">
      <div class="sec__head-l">
        <p class="eyebrow eyebrow--light">Member transformations</p>
        <h2 class="display h2" id="tf-title" data-reveal>
          <?= lines(['DISCIPLINE', 'LEAVES <em>PROOF.</em>']) ?>
        </h2>
      </div>
      <p class="sec__intro" data-fade>Drag the handle to see the difference consistent coaching makes.</p>
    </header>

    <div class="tf__grid" data-carousel-mobile>
      <?php foreach (site()['transformations'] as $i => $t): ?>
        <article class="tf" data-fade style="--d:<?= $i * .08 ?>s">
          <div class="ba<?= !empty($t['real']) ? ' ba--real' : '' ?>" style="--pos:50%" data-ba>
            <div class="ba__layer ba__after">
              <?= photo($t['after'] ?? $t['key'], 'After: ' . $t['alt'], ['ratio' => 4 / 5, 'widths' => [400, 640, 900], 'sizes' => '(min-width:1024px) 30vw, 86vw']) ?>
            </div>
            <div class="ba__layer ba__before">
              <?= photo($t['before'] ?? $t['key'], 'Before: ' . $t['alt'], ['ratio' => 4 / 5, 'widths' => [400, 640, 900], 'sizes' => '(min-width:1024px) 30vw, 86vw']) ?>
            </div>
            <span class="ba__tag ba__tag--l">Before</span>
            <span class="ba__tag ba__tag--r">After</span>
            <span class="ba__handle" aria-hidden="true"><?= icon('arrow-l') ?><?= icon('arrow-r') ?></span>
            <input class="ba__range" type="range" min="0" max="100" value="50" aria-label="Before and after comparison slider for <?= e($t['name']) ?>">
          </div>
          <div class="tf__meta">
            <div>
              <h3 class="display"><?= e($t['result']) ?></h3>
              <p><?= e($t['name']) ?> · <?= e($t['duration']) ?></p>
            </div>
            <?php if (empty($t['real'])): ?><span class="chip chip--dim">Placeholder</span><?php endif; ?>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
    <?= placeholder_note('Photos, names and results are placeholders. Use real member transformations (with written consent) before launch.') ?>
  </div>
</section>
