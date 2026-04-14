<?php
/**
 * Template Name: Ikasgaiak
 */
get_header();

$u = content_url('uploads');

// Hardcoded fallback data — update with your own images and teachers
$kategoriak = [
    [
        'izena'     => 'Taldean Teoriko-Praktikoa',
        'ikasgaiak' => [
            ['izena' => 'Hizkuntza Musikala',                 'irakaslea' => [],  'img' => ''],
            ['izena' => 'Abesbatza',                          'irakaslea' => [],  'img' => ''],
            ['izena' => 'Musika &amp; Mugimendua (4-7 urte)', 'irakaslea' => [],  'img' => ''],
        ],
    ],
    [
        'izena'     => 'Taldean',
        'ikasgaiak' => [
            ['izena' => 'Konboa',        'irakaslea' => [], 'img' => ''],
            ['izena' => 'Pandero Taldea','irakaslea' => [], 'img' => ''],
            ['izena' => 'Txikipand',     'irakaslea' => [], 'img' => ''],
        ],
    ],
    [
        'izena'        => 'Bakarka',
        'mota'         => 'parent',
        'azpikategoriak' => [
            [
                'izena'     => 'Sokazko instrumentuak',
                'ikasgaiak' => [
                    ['izena' => 'Biolina',  'irakaslea' => [], 'img' => ''],
                ],
            ],
            [
                'izena'     => 'Haizezko instrumentuak',
                'ikasgaiak' => [
                    ['izena' => 'Tronpeta',   'irakaslea' => [], 'img' => ''],
                    ['izena' => 'Tronboia',   'irakaslea' => [], 'img' => ''],
                    ['izena' => 'Flauta',     'irakaslea' => [], 'img' => ''],
                    ['izena' => 'Saxofoia',   'irakaslea' => [], 'img' => ''],
                    ['izena' => 'Klarinetea', 'irakaslea' => [], 'img' => ''],
                ],
            ],
            [
                'izena'     => 'Teklatu eta Korda',
                'ikasgaiak' => [
                    ['izena' => 'Pianoa',          'irakaslea' => [], 'img' => ''],
                    ['izena' => 'Gitarra',         'irakaslea' => [], 'img' => ''],
                    ['izena' => 'Bajo Elektrikoa', 'irakaslea' => [], 'img' => ''],
                ],
            ],
            [
                'izena'     => 'Ahotsa',
                'ikasgaiak' => [
                    ['izena' => 'Kantua', 'irakaslea' => [], 'img' => ''],
                ],
            ],
            [
                'izena'     => 'Perkusio Modernoa',
                'ikasgaiak' => [
                    ['izena' => 'Bateria',            'irakaslea' => [], 'img' => ''],
                    ['izena' => 'Gitarra Elektrikoa', 'irakaslea' => [], 'img' => ''],
                ],
            ],
            [
                'izena'     => 'Euskal Tresnak',
                'ikasgaiak' => [
                    ['izena' => 'Trikitixa', 'irakaslea' => [], 'img' => ''],
                    ['izena' => 'Txistua',   'irakaslea' => [], 'img' => ''],
                    ['izena' => 'Txalaparta','irakaslea' => [], 'img' => ''],
                ],
            ],
        ],
    ],
];

function arratia_render_ikasgai_cards( $ikasgaiak ) {
    foreach ( $ikasgaiak as $ig ): ?>
    <div class="ikasgai-subject-card">
        <div class="ikasgai-subject-img">
            <?php if (!empty($ig['img'])): ?>
                <img src="<?php echo esc_url($ig['img']); ?>" alt="<?php echo esc_attr($ig['izena']); ?>">
            <?php else: ?>
                <div style="width:100%;height:100%;background:#ede3d0;display:flex;align-items:center;justify-content:center;font-size:2.5rem;opacity:.5;">🎵</div>
            <?php endif; ?>
        </div>
        <div class="ikasgai-subject-name"><?php echo $ig['izena']; ?></div>
        <?php if (!empty($ig['azalpena'])):
            // Split age (before first period) from description
            $parts = explode('. ', $ig['azalpena'], 2);
        ?>
        <div class="ikasgai-subject-azalpena">
            <?php if (count($parts) === 2): ?>
                <span class="ikasgai-subject-age"><?php echo esc_html($parts[0]); ?></span>
                <span class="ikasgai-subject-desc"><?php echo esc_html($parts[1]); ?></span>
            <?php else: ?>
                <span class="ikasgai-subject-desc"><?php echo esc_html($ig['azalpena']); ?></span>
            <?php endif; ?>
        </div>
        <?php endif; ?>
        <?php if (!empty($ig['irakaslea'])): ?>
        <div class="ikasgai-subject-teacher">
            <?php foreach ($ig['irakaslea'] as $ir): ?>
                <span><?php echo esc_html($ir); ?></span>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
    <?php endforeach;
}

function arratia_render_ikasgai_slider( $card ) {
    $galeria_ids = array_filter(array_map('trim', explode(',', $card['galeria'] ?? '')));
    $imgs = [];
    foreach ($galeria_ids as $gid) {
        $url = wp_get_attachment_image_url((int)$gid, 'large');
        if ($url) $imgs[] = $url;
    }
    // Fallback to featured image
    if (empty($imgs) && !empty($card['img'])) $imgs[] = $card['img'];

    $uid = 'slider-' . sanitize_html_class($card['slug'] ?? uniqid());
    ?>
    <div class="ig-slider-wrap">
        <div class="ig-slider-banner"><?php echo esc_html($card['izena']); ?></div>
        <div class="ig-slider" id="<?php echo $uid; ?>">
            <div class="ig-slider-track">
            <?php foreach ($imgs as $src): ?>
                <div class="ig-slide">
                    <img src="<?php echo esc_url($src); ?>" alt="<?php echo esc_attr($card['izena']); ?>">
                </div>
            <?php endforeach; ?>
            </div>
            <?php if (count($imgs) > 1): ?>
            <button class="ig-slider-btn ig-slider-prev" aria-label="Aurrekoa">&#8249;</button>
            <button class="ig-slider-btn ig-slider-next" aria-label="Hurrengoa">&#8250;</button>
            <div class="ig-slider-dots">
                <?php for ($i = 0; $i < count($imgs); $i++): ?>
                <span class="ig-dot<?php echo $i === 0 ? ' active' : ''; ?>" data-idx="<?php echo $i; ?>"></span>
                <?php endfor; ?>
            </div>
            <?php endif; ?>
        </div>
        <?php if (!empty($card['azalpena'])): ?>
        <p class="ig-slider-desc"><?php echo esc_html($card['azalpena']); ?></p>
        <?php endif; ?>
        <?php if (!empty($card['irakaslea'])): ?>
        <div class="ig-slider-irakasleak">
            <?php foreach ($card['irakaslea'] as $ir): ?>
                <span><?php echo esc_html($ir); ?></span>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
    <?php
}

// ── Try CPT data first ─────────────────────────────────────────────────────
$cpt_query = new WP_Query([
    'post_type'      => 'ikasgai',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'meta_key'       => '_ikasgai_ordena',
    'orderby'        => 'meta_value_num',
    'order'          => 'ASC',
]);

$use_cpt   = $cpt_query->have_posts();
$cpt_groups = [];

if ($use_cpt) {
    while ($cpt_query->have_posts()) {
        $cpt_query->the_post();
        $pid        = get_the_ID();
        $kat_key    = get_post_meta($pid, '_ikasgai_kategoria', true) ?: 'Beste';
        $raw_ir     = get_post_meta($pid, '_ikasgai_irakaslea', true);
        $irakasleak = $raw_ir ? array_filter(array_map('trim', explode("\n", str_replace('\n', "\n", $raw_ir)))) : [];
        $thumb_url  = get_the_post_thumbnail_url($pid, 'medium') ?: '';
        $azalpena   = get_post_meta($pid, '_ikasgai_azalpena', true);
        $galeria_raw = get_post_meta($pid, '_ikasgai_galeria', true);
        $cpt_groups[$kat_key][] = [
            'izena'     => get_the_title(),
            'slug'      => get_post_field('post_name', $pid),
            'azalpena'  => $azalpena,
            'irakaslea' => array_values($irakasleak),
            'img'       => $thumb_url,
            'galeria'   => $galeria_raw,
        ];
    }
    wp_reset_postdata();

    // Normalize old category names (DB may still have legacy "tresnak" labels)
    $label_map = [
        'Bakarka - Tekla-tresnak'    => 'Bakarka - Tekla-instrumentuak',
        'Bakarka - Perkusio-tresnak' => 'Bakarka - Perkusio-instrumentuak',
        'Bakarka - Sokazko Tresnak'  => 'Bakarka - Hari igurtzizko instrumentuak',
        'Bakarka - Haizezko Tresnak' => 'Bakarka - Zurezko haize-instrumentuak',
        'Bakarka - Euskal Tresnak'   => 'Bakarka - Euskal instrumentu tradizionalak',
        'Bakarka - Teklatu eta Korda'=> 'Bakarka - Tekla-instrumentuak',
        'Bakarka - Perkusio Modernoa'=> 'Bakarka - Perkusio-instrumentuak',
        'Bakarka - Ahotsa'           => 'Bakarka - Kantuko espezialitatea',
    ];
    $normalized = [];
    foreach ($cpt_groups as $cat => $cards) {
        $new_cat = $label_map[$cat] ?? $cat;
        if (isset($normalized[$new_cat])) {
            $normalized[$new_cat] = array_merge($normalized[$new_cat], $cards);
        } else {
            $normalized[$new_cat] = $cards;
        }
    }
    $cpt_groups = $normalized;

    // Reorder categories to match production site order
    $cat_order = [
        'Bakarka - Hari igurtzizko instrumentuak',
        'Bakarka - Zurezko haize-instrumentuak',
        'Bakarka - Metalezko haize-instrumentuak',
        'Bakarka - Tekla-instrumentuak',
        'Bakarka - Perkusio-instrumentuak',
        'Bakarka - Hari pultsatuko instrumentuak',
        'Bakarka - Euskal instrumentu tradizionalak',
        'Bakarka - Kantuko espezialitatea',
        'Taldean Teoriko-Praktikoa',
        'Taldean',
    ];
    $ordered = [];
    foreach ($cat_order as $cat) {
        if (isset($cpt_groups[$cat])) $ordered[$cat] = $cpt_groups[$cat];
    }
    foreach ($cpt_groups as $cat => $cards) {
        if (!isset($ordered[$cat])) $ordered[$cat] = $cards;
    }
    $cpt_groups = $ordered;
}
?>

<div class="ikasgaiak-page">
    <div class="container">
    <?php arratia_page_hero('Ikasgaiak', 'Ikasgaiak'); ?>

    <?php if ($use_cpt): ?>

        <?php
        $bakarka_printed = false;
        foreach ($cpt_groups as $kat_label => $cards):
            $is_bakarka = (strpos($kat_label, 'Bakarka') === 0);
            if ($is_bakarka && !$bakarka_printed): $bakarka_printed = true; ?>
            <div class="ikasgai-bakarka" id="tresnak">
            <div class="ikasgai-bakarka-banner">Bakarka</div>
        <?php endif; ?>

        <?php if ($is_bakarka): ?>
            <?php $subcat_anchor = ($kat_label === 'Bakarka - Kantuko espezialitatea') ? ' id="ahotsa"' : ''; ?>
            <div class="ikasgai-kategoria"<?php echo $subcat_anchor; ?>>
                <div class="ikasgai-kategoria-banner"><?php echo esc_html(preg_replace('/^Bakarka - /', '', $kat_label)); ?></div>
                <div class="ikasgai-cards-grid"><?php arratia_render_ikasgai_cards($cards); ?></div>
            </div>
        <?php else:
            if ($bakarka_printed): echo '</div>'; $bakarka_printed = false; endif;
            $section_anchor = ($kat_label === 'Taldean Teoriko-Praktikoa') ? ' id="teoriko-praktikoa"' : (($kat_label === 'Taldean') ? ' id="taldeak"' : '');
            // Check if any card in this group has a gallery → slider layout
            $has_slider = array_filter($cards, fn($c) => !empty($c['galeria']));
            if ($has_slider): ?>
            <div class="ikasgai-kategoria ikasgai-kategoria--sliders"<?php echo $section_anchor; ?>>
                <?php
            // Collect non-slider cards to render in a grid together
            $plain_cards = [];
            foreach ($cards as $card):
                if (!empty($card['galeria'])):
                    // Flush any pending plain cards first
                    if ($plain_cards): ?>
                        <div class="ikasgai-cards-grid" style="margin-bottom:1.5rem;">
                            <?php arratia_render_ikasgai_cards($plain_cards); ?>
                        </div>
                    <?php $plain_cards = []; endif;
                    arratia_render_ikasgai_slider($card);
                else:
                    $plain_cards[] = $card;
                endif;
            endforeach;
            if ($plain_cards): ?>
                <div class="ikasgai-cards-grid" style="margin-bottom:1.5rem;">
                    <?php arratia_render_ikasgai_cards($plain_cards); ?>
                </div>
            <?php endif; ?>
            </div>
            <?php else: ?>
            <div class="ikasgai-kategoria"<?php echo $section_anchor; ?>>
                <div class="ikasgai-kategoria-banner"><?php echo esc_html($kat_label); ?></div>
                <div class="ikasgai-cards-grid"><?php arratia_render_ikasgai_cards($cards); ?></div>
            </div>
            <?php endif; ?>
        <?php endif; ?>

        <?php endforeach;
        if ($bakarka_printed) echo '</div>';
        ?>

    <?php else: // Fallback: hardcoded data ?>

        <?php foreach ($kategoriak as $kat): ?>
        <?php if (!empty($kat['mota']) && $kat['mota'] === 'parent'): ?>
        <div class="ikasgai-bakarka">
            <div class="ikasgai-bakarka-banner"><?php echo esc_html($kat['izena']); ?></div>
            <?php foreach ($kat['azpikategoriak'] as $azpi): ?>
            <div class="ikasgai-kategoria">
                <div class="ikasgai-kategoria-banner"><?php echo esc_html($azpi['izena']); ?></div>
                <div class="ikasgai-cards-grid">
                    <?php arratia_render_ikasgai_cards($azpi['ikasgaiak']); ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div class="ikasgai-kategoria">
            <div class="ikasgai-kategoria-banner"><?php echo esc_html($kat['izena']); ?></div>
            <div class="ikasgai-cards-grid">
                <?php arratia_render_ikasgai_cards($kat['ikasgaiak']); ?>
            </div>
        </div>
        <?php endif; ?>
        <?php endforeach; ?>

    <?php endif; ?>

    </div>
</div>

<?php get_footer(); ?>
