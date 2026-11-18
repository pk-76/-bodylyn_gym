<section class="stats" aria-label="BODYLYN at a glance">
  <div class="wrap stats__grid">
    <?php foreach (site()['stats'] as $i => $s):
        $final = number_format($s['value'], $s['decimals'], '.', !empty($s['format']) ? ',' : ''); ?>
      <div class="stat" data-fade style="--d:<?= $i * .08 ?>s">
        <p class="stat__num display">
          <span data-count="<?= $s['value'] ?>" data-decimals="<?= $s['decimals'] ?>"<?= !empty($s['format']) ? ' data-format="1"' : '' ?>><?= e($final) ?></span><small><?= e($s['suffix']) ?></small>
        </p>
        <p class="stat__label"><?= e($s['label']) ?></p>
      </div>
    <?php endforeach; ?>
  </div>
</section>
