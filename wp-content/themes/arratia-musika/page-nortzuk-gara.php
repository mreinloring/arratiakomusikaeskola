<?php
/**
 * Template Name: Nortzuk gara
 */
get_header();

function arratia_render_irakasle_karta($post, $mode = 'irakaslea') {
    $ikasgaiak_raw = str_replace('\n', "\n", get_post_meta($post->ID, '_irakaslea_ikasgaiak', true));
    $ikasgaiak     = array_filter(array_map('trim', explode("\n", $ikasgaiak_raw)));
    $kargua        = get_post_meta($post->ID, '_irakaslea_kargua', true);
    $argazkia_path = get_post_meta($post->ID, '_irakaslea_argazkia_url', true);
    if ($argazkia_path) {
        $argazkia = content_url('uploads') . '/' . $argazkia_path;
    } else {
        $argazkia = get_the_post_thumbnail_url($post->ID, 'medium') ?: '';
    }
    $izena         = get_the_title($post->ID);
    ?>
    <div class="flip-card">
        <div class="flip-card-inner">
            <div class="flip-card-front">
                <?php if ($argazkia): ?>
                    <img src="<?php echo esc_url($argazkia); ?>" alt="<?php echo esc_attr($izena); ?>">
                <?php else: ?>
                    <div class="flip-no-photo"><span><?php echo esc_html(mb_substr($izena, 0, 1)); ?></span></div>
                <?php endif; ?>
                <div class="flip-name-bar"><?php echo esc_html($izena); ?></div>
            </div>
            <div class="flip-card-back">
                <div class="flip-back-content">
                    <h3><?php echo esc_html($izena); ?></h3>
                    <ul>
                        <?php if ($mode === 'zuzendaritza' && $kargua): ?>
                            <li><?php echo esc_html($kargua); ?></li>
                        <?php else: ?>
                            <?php foreach ($ikasgaiak as $ig): ?>
                                <li><?php echo esc_html($ig); ?></li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <?php
}

$irakasleak = new WP_Query([
    'post_type'      => 'irakaslea',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
    'meta_query'     => [[
        'key'     => '_irakaslea_rola',
        'value'   => ['irakaslea', 'biak'],
        'compare' => 'IN',
    ]],
]);

$zuzendaritza = new WP_Query([
    'post_type'      => 'irakaslea',
    'posts_per_page' => -1,
    'orderby'        => 'meta_value_num',
    'meta_key'       => '_irakaslea_zuz_order',
    'order'          => 'ASC',
    'meta_query'     => [[
        'key'     => '_irakaslea_rola',
        'value'   => ['zuzendaritza', 'biak'],
        'compare' => 'IN',
    ]],
]);
?>

<div class="nortzuk-page">
    <div class="container">

        <?php arratia_page_hero('Nortzuk gara', 'Gure taldea'); ?>

        <!-- Irakasleak -->
        <?php if ($irakasleak->have_posts()): ?>
        <div class="irakasleak-section">
            <h2 class="irakasleak-section-title">Irakasleak</h2>
            <div class="irakasleak-grid">
                <?php while ($irakasleak->have_posts()): $irakasleak->the_post(); ?>
                <?php arratia_render_irakasle_karta(get_post()); ?>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>
        <?php endif; ?>

        <!-- Zuzendaritza -->
        <?php if ($zuzendaritza->have_posts()): ?>
        <div class="irakasleak-section">
            <h2 class="irakasleak-section-title">Zuzendaritza eta Administrazioa</h2>
            <div class="irakasleak-grid irakasleak-grid--small">
                <?php while ($zuzendaritza->have_posts()): $zuzendaritza->the_post(); ?>
                <?php arratia_render_irakasle_karta(get_post(), 'zuzendaritza'); ?>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>
        <?php endif; ?>

        <?php if (!$irakasleak->have_posts() && !$zuzendaritza->have_posts()): ?>
        <p style="text-align:center;color:#888;padding:3rem 0;">
            Oraindik ez dago irakasleririk gehitu.<br>
            <em>Administrazioan, "Irakasleak" atalean gehitu irakasleak.</em>
        </p>
        <?php endif; ?>

    </div>
</div>

<?php get_footer(); ?>
