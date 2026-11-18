<?php
/**
 * BODYLYN GYM — single source of truth.
 * Every piece of business data / copy lives here. Edit this file only.
 * Items marked [ADD] / [CONFIRM] / PLACEHOLDER need real data before launch.
 */

$U = 'https://images.unsplash.com/photo-';   // Unsplash base (placeholder photography)
// Local optimised photo: assets/img/{slug}-{width}.webp for each width in $ws; aw/ah = original size
$L = static fn(string $slug, array $ws, int $aw, int $ah, ?string $pos = null): array =>
    ['local' => true, 'base' => 'assets/img/' . $slug, 'ws' => $ws, 'aw' => $aw, 'ah' => $ah] + ($pos ? ['pos' => $pos] : []);

return [

    /* ───────── Business ───────── */
    'name'          => 'BODYLYN GYM',
    'brand'         => 'BODYLYN',
    'tagline'       => 'Train with guidance. Build with discipline.',
    'url'           => 'https://www.bodylyngym.in',            // [CONFIRM DOMAIN] used for canonical, OG, sitemap
    'phone_display' => '+91 70048 67125',
    'phone_tel'     => '+917004867125',
    'wa_number'     => '917004867125',
    'address' => [
        'street'   => '4th Floor, Purno Deep Complex, Dimna Road, Adarsh Nagar, Ulidih, Mango',
        'locality' => 'Jamshedpur',
        'region'   => 'Jharkhand',
        'postal'   => '831012',
        'country'  => 'IN',
    ],
    'address_full'  => '4th Floor, Purno Deep Complex, Dimna Road, Adarsh Nagar, Ulidih, Mango, Jamshedpur, Jharkhand 831012',
    'map_query'     => 'Purno Deep Complex, Dimna Road, Mango, Jamshedpur 831012',
    'geo'           => ['lat' => null, 'lng' => null],          // [ADD] e.g. ['lat' => 22.8xxx, 'lng' => 86.2xxx]
    'instagram'     => ['handle' => '[ADD HANDLE]', 'url' => '#'], // [ADD]
    'google_reviews_url' => '#',                                // [ADD] link to Google reviews page
    'rating'        => 4.9,
    'reviews'       => 356,
    'sqft'          => '5,000',
    'timezone'      => 'Asia/Kolkata',

    // Hours: 24h "HH:MM" or null for closed
    'hours' => [
        'Monday'    => ['05:00', '23:00'],
        'Tuesday'   => ['05:00', '23:00'],
        'Wednesday' => ['05:00', '23:00'],
        'Thursday'  => ['05:00', '23:00'],
        'Friday'    => ['05:00', '23:00'],
        'Saturday'  => ['05:00', '23:00'],
        'Sunday'    => null,
    ],

    // Shows small "placeholder" notices on sample content (reviews, transformations, chart, trainers). Set false at launch.
    'show_placeholder_notes' => true,

    /* ───────── SEO ───────── */
    'seo' => [
        'title'       => 'BODYLYN GYM | Best Gym in Mango, Dimna Road, Jamshedpur',
        'description' => 'BODYLYN GYM is a trainer-led gym in Mango, Dimna Road, Ulidih, Jamshedpur. Personal training, weight loss and muscle building programs on a 5,000 sq.ft floor. Rated 4.9★ on Google. Book a free trial.',
        'keywords'    => 'gym in Mango Jamshedpur, best gym Dimna Road, personal training Jamshedpur, weight loss gym Ulidih, muscle building gym, Bodylyn Gym',
    ],

    /* ───────── Images ─────────
     * Unsplash entries are PLACEHOLDERS (photo() prints a REPLACE comment next to each).
     * 'local' entries are real BODYLYN photos already supplied. */
    'images' => [
        // ── REAL BODYLYN photos (optimised WebP sets in assets/img: {name}-{width}.webp) ──
        'hero'        => $L('gym-interior', [640, 1280, 1920], 6048, 4024),
        'cta'         => $L('holi',         [640, 1280, 1920], 4160, 2340),
        'about'       => $L('painting',     [640, 1280, 1920], 6048, 4024, '30% 50%'),
        'f_strength'  => $L('equipment',    [640, 1280, 1920], 6048, 4024),
        'f_machine'   => ['src' => 'assets/img/gym-floor.webp',  'local' => true, 'w' => 680, 'h' => 430],
        'f_cardio'    => ['src' => 'assets/img/gym-cardio.webp', 'local' => true, 'w' => 680, 'h' => 510],
        'f_floor'     => $L('gym-interior', [640, 1280, 1920], 6048, 4024),
        'f_clean'     => $L('independence-day', [640, 1280, 1920], 6048, 4024),
        'p_beginner'  => $L('zumba',        [640, 1280, 1920], 2880, 1472),
        'p_fat'       => $L('marathon',     [640, 1280, 1920], 1920, 1080),
        'p_personal'  => $L('girls-session',[640, 1080],       1080, 1920, '50% 35%'),
        't1'          => ['src' => 'assets/img/trainer-1.webp', 'local' => true, 'w' => 382, 'h' => 510],
        't2'          => ['src' => 'assets/img/trainer-2.webp', 'local' => true, 'w' => 287, 'h' => 510],
        't3'          => $L('flex',         [640, 720],        720, 1280, '50% 30%'),
        'x1_before'   => $L('transform-before', [640, 776], 776, 1600, '50% 35%'),
        'x1_after'    => $L('transform-after',  [640, 776], 776, 1600, '50% 35%'),
        // gallery (real)
        'g_dance'     => $L('dance',    [640, 720],  720, 1280),
        'g_power'     => $L('power',    [640, 1280, 1600], 1600, 1201),
        'g_tyre'      => $L('tyre',     [640, 1088], 1088, 1920),
        'g_protein'   => $L('protein',  [478],       478, 850),

        // ── PLACEHOLDER (Unsplash) — replace with real photos when available ──
        'f_changing'  => ['src' => $U.'1558611848-73f7eb4001a1'],      // [CONFIRM] changing area
        'p_weight'    => ['src' => $U.'1517963879433-6ad2b056d712'],
        'p_muscle'    => ['src' => $U.'1507398941214-572c25f4b1dc'],
        'p_transform' => ['src' => $U.'1583454155184-870a1f63aebc'],
        't4'          => ['src' => $U.'1594381898411-846e7d193883'],
        'x2'          => ['src' => $U.'1581009146145-b5ef050c2e1e'],
        'x3'          => ['src' => $U.'1546483875-ad9014c88eba'],
    ],

    /* ───────── Navigation ───────── */
    'nav' => [
        ['About',           '#about'],
        ['Facilities',      '#facilities'],
        ['Programs',        '#programs'],
        ['Trainers',        '#trainers'],
        ['Transformations', '#transformations'],
        ['Contact',         '#contact'],
    ],

    /* ───────── Marquee ───────── */
    'marquee' => ['Strength', 'Fat Loss', 'Muscle Building', 'Body Transformation', 'Personal Training'],

    /* ───────── Stats ───────── */
    'stats' => [
        ['value' => 4.9,  'decimals' => 1, 'suffix' => '★',     'label' => 'Google Rating'],
        ['value' => 356,  'decimals' => 0, 'suffix' => '+',     'label' => 'Member Reviews'],
        ['value' => 5000, 'decimals' => 0, 'suffix' => ' sq.ft','label' => 'Training Space', 'format' => true],
        ['value' => 18,   'decimals' => 0, 'suffix' => '',      'label' => 'Hours Open Daily'],
    ],

    /* ───────── About ───────── */
    'about' => [
        'paragraphs' => [
            'Equipment doesn\'t change bodies — guidance does. BODYLYN GYM was built around that single idea. On the 4th floor of Purno Deep Complex, our 5,000 sq.ft training floor is run by trainers who watch your form, plan your progress and hold you to your goals.',
            'Whether it\'s your first day or your thousandth session, you are coached — never left to figure it out. No intimidation. No guesswork. Just disciplined training in a clean, motivating space.',
        ],
        'pillars' => [
            ['Guidance',  'Trainers who correct, coach and explain — every single session.'],
            ['Discipline','Structure and accountability that outlast motivation.'],
            ['Results',   'Goal-based plans, tracked progress, visible change.'],
        ],
    ],

    /* ───────── Why BODYLYN ───────── */
    'why' => [
        ['icon' => 'posture',  'title' => 'Form correction on every exercise', 'text' => 'Good form is what builds results — and protects your joints. Our trainers step in before bad habits form.'],
        ['icon' => 'eye',      'title' => 'Personal attention from trainers',  'text' => 'You\'re a name here, not a number. Trainers know your goals, your history and your next target.'],
        ['icon' => 'plan',     'title' => 'Workout plans built around your goal', 'text' => 'Fat loss, muscle, strength or confidence — your plan is written for you, and updated as you progress.'],
        ['icon' => 'dumbbell', 'title' => 'Modern, well-maintained equipment', 'text' => 'Quality machines and free weights, serviced regularly, so every session runs smoothly.'],
        ['icon' => 'spark',    'title' => 'Clean, motivating, disciplined environment', 'text' => 'A spotless floor and a serious-but-welcoming culture that makes showing up the easy part.'],
    ],

    /* ───────── Facilities (bento) ───────── */
    'facilities' => [
        ['key' => 'f_strength', 'class' => 'bento--strength', 'title' => 'Strength / Free-Weights Zone', 'text' => 'Racks, benches and a full dumbbell range for serious, progressive lifting.', 'alt' => 'Rack of dumbbells in the BODYLYN strength zone', 'ratio' => 1.1],
        ['key' => 'f_machine',  'class' => 'bento--machine',  'title' => 'Machine Zone',   'text' => 'Guided, joint-friendly machines — ideal for learning and for isolation work.', 'alt' => 'Selectorised strength machines and benches at BODYLYN GYM', 'ratio' => 1.6],
        ['key' => 'f_cardio',   'class' => 'bento--cardio',   'title' => 'Cardio Zone',    'text' => 'Treadmills, cross-trainers and bikes for conditioning and fat loss.', 'alt' => 'Row of treadmills in the BODYLYN cardio zone', 'ratio' => 1.6],
        ['key' => 'f_floor',    'class' => 'bento--floor',    'title' => '5,000 sq.ft Training Floor', 'text' => 'Space to move, lift and breathe — never cramped, even at peak hours.', 'alt' => 'Wide view of the BODYLYN training floor', 'ratio' => 1.2, 'big' => '5,000', 'unit' => 'sq.ft'],
        ['key' => 'f_clean',    'class' => 'bento--clean',    'title' => 'Clean & Hygienic Space', 'text' => 'Floors and equipment cleaned throughout the day.', 'alt' => 'Open lifting platform with flag-wall feature at BODYLYN GYM', 'ratio' => 1.8],
        ['key' => 'f_changing', 'class' => 'bento--changing', 'title' => 'Changing Area',  'text' => 'Convenient space to freshen up before and after your session. [CONFIRM]', 'alt' => 'Bright changing and locker area', 'ratio' => 1.8],
    ],

    /* ───────── Programs ───────── */
    'programs' => [
        'featured' => [
            'key' => 'p_beginner', 'title' => 'Beginner Program', 'kicker' => 'Start here',
            'line' => 'Never been to a gym? Start here.',
            'text' => 'We teach you every machine, every movement and every habit — step by step, with a trainer beside you. No intimidation. No guesswork.',
            'alt'  => 'Beginner-friendly group session with a BODYLYN coach',
            'points' => ['Guided gym orientation', 'Form-first training', 'A plan you can actually follow'],
        ],
        'items' => [
            ['key' => 'p_weight',    'title' => 'Weight Training',     'line' => 'Build raw strength with structured, progressive lifting.',        'alt' => 'Loaded barbell on the gym floor'],
            ['key' => 'p_fat',       'title' => 'Fat Loss / Weight Loss', 'line' => 'Sustainable fat loss through smart training and accountability.', 'alt' => 'BODYLYN members on a group outdoor run'],
            ['key' => 'p_muscle',    'title' => 'Muscle Building',     'line' => 'Progressive overload, proper form, real size.',                  'alt' => 'Athlete training back with a cable machine'],
            ['key' => 'p_transform', 'title' => 'Body Transformation', 'line' => 'A complete, goal-led plan to change how you look and feel.',    'alt' => 'Athlete mid pull-up in a gym'],
            ['key' => 'p_personal',  'title' => 'Personal Training',   'line' => 'One-on-one coaching built entirely around you.',                 'alt' => 'Trainer coaching a member through a shoulder press'],
        ],
    ],

    /* ───────── Who we train ───────── */
    'audiences' => [
        ['tag' => 'Beginners',          'text' => 'Learn proper form and how to use every machine, with a trainer by your side.'],
        ['tag' => 'Weight-loss seekers','text' => 'Structured workouts and real accountability.'],
        ['tag' => 'Muscle builders',    'text' => 'Progressive strength training in a serious gym culture.'],
        ['tag' => 'Working professionals','text' => 'Train early morning or late evening, 5 AM to 11 PM.'],
    ],

    /* ───────── Trainers — PLACEHOLDER names / specialties / years ───────── */
    'trainers' => [
        ['key' => 't1', 'name' => '[TRAINER NAME]', 'specialty' => 'Strength & Muscle Building',   'years' => '[X]', 'alt' => 'BODYLYN trainer posing with dumbbell gloves in the gym'],
        ['key' => 't2', 'name' => '[TRAINER NAME]', 'specialty' => 'Body Transformation',          'years' => '[X]', 'alt' => 'BODYLYN trainer flexing in the gym'],
        ['key' => 't3', 'name' => '[TRAINER NAME]', 'specialty' => 'Fat Loss & Conditioning',      'years' => '[X]', 'alt' => 'BODYLYN trainer flexing in the gym'],
        ['key' => 't4', 'name' => '[TRAINER NAME]', 'specialty' => 'Beginner & Personal Training', 'years' => '[X]', 'alt' => 'Trainer demonstrating a core exercise'],
    ],

    /* ───────── Transformations — PLACEHOLDER content ───────── */
    'transformations' => [
        // x1 uses a REAL before/after photo (supplied). Add the member's real name, duration and result.
        ['key' => 'x1', 'before' => 'x1_before', 'after' => 'x1_after', 'real' => true, 'name' => '[MEMBER NAME]', 'duration' => '[X] months', 'result' => '[ADD RESULT]', 'alt' => 'BODYLYN member transformation'],
        ['key' => 'x2', 'name' => '[MEMBER NAME]', 'duration' => '6 months', 'result' => '+6 kg lean muscle in 6 months','alt' => 'Placeholder member transformation'],
        ['key' => 'x3', 'name' => '[MEMBER NAME]', 'duration' => '8 months', 'result' => '−18 kg in 8 months',          'alt' => 'Placeholder member transformation'],
    ],

    /* ───────── Reviews — PLACEHOLDER copy based on real review themes.
     * Replace with verbatim Google reviews (and real reviewer names) before launch. ───────── */
    'review_list' => [
        ['name' => 'Google Reviewer', 'theme' => 'Motivating atmosphere', 'stars' => 5, 'quote' => 'The atmosphere here pushes you to show up. Everyone is focused and nobody is intimidating — I train harder here than I ever did before.'],
        ['name' => 'Google Reviewer', 'theme' => 'Trainers who guide',     'stars' => 5, 'quote' => 'The trainers actually watch your form and correct you. I finally understand how to use every machine properly.'],
        ['name' => 'Google Reviewer', 'theme' => 'Quality equipment',      'stars' => 5, 'quote' => 'Modern, well-maintained equipment and enough of it. I never wait around for a machine.'],
        ['name' => 'Google Reviewer', 'theme' => 'Cleanliness',            'stars' => 5, 'quote' => 'Spotless floor and clean equipment, even at peak hours. You can tell the team genuinely cares.'],
        ['name' => 'Google Reviewer', 'theme' => 'Beginner-friendly',      'stars' => 5, 'quote' => 'I was nervous about joining a gym. The team made me comfortable from day one and built a plan just for me.'],
        ['name' => 'Google Reviewer', 'theme' => 'Disciplined culture',    'stars' => 5, 'quote' => 'A serious gym culture without the ego. Disciplined, respectful and consistent — exactly what I needed.'],
        ['name' => 'Google Reviewer', 'theme' => 'Value for money',        'stars' => 5, 'quote' => 'Honestly the best value in Mango for the quality of coaching and facilities you get.'],
    ],

    /* ───────── Best time to train — ILLUSTRATIVE data (0–100 busyness). Replace with real data. ───────── */
    'peak' => [
        5 => 55, 6 => 80, 7 => 90, 8 => 70, 9 => 48, 10 => 34, 11 => 26, 12 => 20, 13 => 18,
        14 => 22, 15 => 30, 16 => 46, 17 => 72, 18 => 94, 19 => 100, 20 => 86, 21 => 58, 22 => 34,
    ],

    /* ───────── Gallery — ratio = width / height ───────── */
    'gallery' => [
        ['key' => 'f_floor',     'alt' => 'The BODYLYN training floor with orange lighting and green turf', 'ratio' => 1.5],
        ['key' => 'g_dance',     'alt' => 'Members in a high-energy dance fitness class',                'ratio' => 0.5625],
        ['key' => 'f_strength',  'alt' => 'Full dumbbell rack on the free-weights zone',                  'ratio' => 1.5],
        ['key' => 'g_tyre',      'alt' => 'Trainer edition: tyre-flip functional training on the rooftop', 'ratio' => 0.567],
        ['key' => 'about',       'alt' => 'Bodybuilder mural wall beside the spin bikes',                 'ratio' => 1.5],
        ['key' => 'p_beginner',  'alt' => 'Zumba session with BODYLYN members',                           'ratio' => 1.96],
        ['key' => 'p_personal',  'alt' => 'Trainer coaching a member during a girls training session',      'ratio' => 0.5625],
        ['key' => 'f_clean',     'alt' => 'Lifting platform and flag wall at BODYLYN GYM',                 'ratio' => 1.5],
        ['key' => 'g_power',     'alt' => 'BODYLYN community Holi celebration',                          'ratio' => 1.33],
        ['key' => 't1',          'alt' => 'BODYLYN member training with weights',                         'ratio' => 0.75],
        ['key' => 'p_fat',       'alt' => 'BODYLYN group run through the forest road',                    'ratio' => 1.78],
        ['key' => 'g_protein',   'alt' => 'Protein bars available for members',                           'ratio' => 0.56],
        ['key' => 't3',          'alt' => 'BODYLYN trainer flexing in the gym',                            'ratio' => 0.5625],
        ['key' => 'cta',         'alt' => 'BODYLYN members celebrating together at a Holi event',          'ratio' => 1.78],
    ],
    /* ───────── Enquiry form options ───────── */
    'goals' => ['Weight Loss', 'Muscle Building', 'Strength', 'Body Transformation', 'General Fitness', 'Beginner'],
    'times' => ['Morning', 'Afternoon', 'Evening'],
];
