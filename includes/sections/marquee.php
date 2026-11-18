<?php $items = site()['marquee']; ?>
<div class="marquee" aria-label="Programs: <?= e(implode(', ', $items)) ?>">
  <div class="marquee__track" aria-hidden="true">
    <?php for ($g = 0; $g < 2; $g++): ?>
      <div class="marquee__group">
        <?php for ($r = 0; $r < 2; $r++): foreach ($items as $i => $t): ?>
          <span class="marquee__item<?= $i % 2 ? ' is-solid' : '' ?>"><?= e($t) ?></span>
        <?php endforeach; endfor; ?>
      </div>
    <?php endfor; ?>
  </div>
</div>
