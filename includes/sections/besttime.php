<?php
$peak = site()['peak'];
$label = static function (int $h): string {
    $ap = $h >= 12 ? 'PM' : 'AM';
    $hh = $h % 12 ?: 12;
    return $hh . ' ' . $ap;
};
$short = static fn(int $h): string => ($h % 12 ?: 12) . ($h >= 12 ? 'p' : 'a');
?>
<section class="sec besttime" id="best-time" aria-labelledby="bt-title">
  <div class="wrap grid12 besttime__grid">

    <div class="besttime__copy">
      <p class="eyebrow eyebrow--light">Best time to train</p>
      <h2 class="display h2" id="bt-title" data-reveal>
        <?= lines(['TRAIN WHEN', 'IT\'S <em>QUIET.</em>']) ?>
      </h2>
      <p class="lead" data-fade>Prefer a quieter session? Train in our off-peak hours — more space, more trainer time, same BODYLYN standard.</p>

      <ul class="legend" data-fade>
        <li><i class="dot dot--quiet"></i> Quieter — best for focus</li>
        <li><i class="dot dot--mid"></i> Moderate</li>
        <li><i class="dot dot--peak"></i> Peak hours</li>
      </ul>
    </div>

    <figure class="chart" data-chart data-fade>
      <figcaption class="sr-only">Illustrative gym busyness by hour, 5 AM to 11 PM. Quietest between 11 AM and 3 PM; busiest 6 PM to 8 PM.</figcaption>
      <div class="chart__plot" role="list">
        <?php foreach ($peak as $h => $v):
            $cls = $v <= 35 ? 'quiet' : ($v >= 70 ? 'peak' : 'mid');
            $word = $v <= 35 ? 'Quieter' : ($v >= 70 ? 'Peak' : 'Moderate'); ?>
          <div class="bar bar--<?= $cls ?>" role="listitem" data-hour="<?= $h ?>" style="--h:<?= (int) $v ?>;--i:<?= $h - 5 ?>" tabindex="0"
               aria-label="<?= e($label($h)) ?>: <?= $word ?>" data-tip="<?= e($label($h)) ?> · <?= $word ?>">
            <span class="bar__fill"></span>
            <span class="bar__x" aria-hidden="true"><?= e($short($h)) ?></span>
          </div>
        <?php endforeach; ?>
      </div>
      <p class="chart__axis"><span>5 AM</span><span>Open → Close</span><span>11 PM</span></p>
    </figure>

  </div>
  <div class="wrap"><?= placeholder_note('Illustrative data — replace with real busy-hour data from the gym (includes/config.php → peak).') ?></div>
</section>
