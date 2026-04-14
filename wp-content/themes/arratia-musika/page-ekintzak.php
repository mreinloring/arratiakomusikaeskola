<?php
/**
 * Template Name: Ekintzak
 * Assign to the page with slug "ekintzak".
 * Shows ALL academic years in one page, grouped by year > month (most recent first).
 */
get_header();

// ── Current academic year ──────────────────────────────────────────────────────
$now = new DateTime();
$mo  = (int)$now->format('n');
$yr  = (int)$now->format('Y');
$current_start = ($mo >= 9) ? $yr : $yr - 1;
$current_slug  = $current_start . '-' . ($current_start + 1);
$current_label = $current_start . '/' . ($current_start + 1);

// ── Month order: most recent first ────────────────────────────────────────────
$hilabete_order = [
    'uztaila'   => 1,
    'ekaina'    => 2,
    'maiatza'   => 3,
    'apirila'   => 4,
    'martxoa'   => 5,
    'otsaila'   => 6,
    'urtarrila' => 7,
    'abendua'   => 8,
    'azaroa'    => 9,
    'urria'     => 10,
    'iraila'    => 11,
    'abuztua'   => 12,
];

$hilabete_start = ['iraila', 'urria', 'azaroa', 'abendua']; // Sep-Dec = start year

// ── Query ALL ekintzak ─────────────────────────────────────────────────────────
$query = new WP_Query([
    'post_type'      => 'ekintza',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'orderby'        => ['menu_order' => 'ASC', 'date' => 'DESC'],
]);

// Group: $years[ year_slug ][ 'label', 'months'[ month_slug ][ 'label', 'posts' ] ]
$years = [];
if ($query->have_posts()) {
    while ($query->have_posts()) {
        $query->the_post();
        $pid = get_the_ID();

        $year_terms  = get_the_terms($pid, 'ikasurtea');
        $year_slug   = ($year_terms && !is_wp_error($year_terms)) ? $year_terms[0]->slug : 'beste';
        $year_name   = ($year_terms && !is_wp_error($year_terms)) ? $year_terms[0]->name : 'Beste';

        $month_terms = get_the_terms($pid, 'hilabetea');
        $month_slug  = ($month_terms && !is_wp_error($month_terms)) ? $month_terms[0]->slug : 'beste';
        $month_name  = ($month_terms && !is_wp_error($month_terms)) ? $month_terms[0]->name : 'Beste';

        $yparts   = explode('-', $year_slug);
        $start_yr = intval($yparts[0] ?? 0);
        $end_yr   = intval($yparts[1] ?? 0);
        $month_yr = in_array($month_slug, $hilabete_start) ? $start_yr : $end_yr;

        $eu_month      = explode(' / ', $month_name)[0];
        $display_month = $eu_month . ($month_yr ? ' ' . $month_yr : '');

        $years[$year_slug]['label'] = $year_name;
        $years[$year_slug]['months'][$month_slug]['label']   = $display_month;
        $years[$year_slug]['months'][$month_slug]['posts'][] = get_post();
    }
    wp_reset_postdata();
}

// Sort years: current first, then descending
uksort($years, function($a, $b) use ($current_slug) {
    if ($a === $current_slug) return -1;
    if ($b === $current_slug) return 1;
    return strcmp($b, $a);
});

// Sort months within each year (most recent first)
foreach ($years as &$year_data) {
    uksort($year_data['months'], function($a, $b) use ($hilabete_order) {
        return ($hilabete_order[$a] ?? 99) - ($hilabete_order[$b] ?? 99);
    });
    // Sort posts within each month by menu_order (0 = no order set → keep original)
    foreach ($year_data['months'] as &$month_data) {
        usort($month_data['posts'], function($a, $b) {
            return $a->menu_order - $b->menu_order;
        });
    }
    unset($month_data);
}
unset($year_data);
?>

<div class="ekintzak-page">
    <div class="container">

        <?php arratia_page_hero('Ekintzak', $current_label . ' Ikasturtea'); ?>

        <?php if (empty($years)): ?>
            <p style="text-align:center;color:#888;padding:3rem 0;">Oraindik ez dago ekintzarik. Laster!<br><em>(Aún no hay actividades registradas)</em></p>
        <?php else: ?>

        <?php $prev_started = false; foreach ($years as $year_slug => $year_data):
            $is_current = ($year_slug === $current_slug);
            if (!$is_current && !$prev_started):
                $prev_started = true; ?>
                <div class="ekintza-prev-separator">
                    <span>Aurreko Ikasturteak / Cursos anteriores</span>
                </div>
            <?php endif; ?>

        <div class="ekintza-year-block<?php echo $is_current ? '' : ' ekintza-year-block--prev'; ?>">
            <h2 class="ekintza-year-title">
                <?php echo esc_html(str_replace('-', '/', $year_slug)); ?> Ikasturtea
            </h2>

            <?php foreach ($year_data['months'] as $month_slug => $month_data): ?>
            <div class="ekintza-month-block">
                <h3 class="ekintza-month-title"><?php echo esc_html($month_data['label']); ?></h3>
                <div class="ekintza-cards">
                    <?php foreach ($month_data['posts'] as $post): setup_postdata($post);
                        $pid       = $post->ID;
                        $argazkiak = get_post_meta($pid, '_ekintza_argazkiak', true)
                                  ?: get_post_meta($pid, '_google_photos_url', true);
                        $bideoa    = get_post_meta($pid, '_ekintza_bideoa', true)
                                  ?: get_post_meta($pid, '_video_url', true);
                        $thumb_url = get_the_post_thumbnail_url($pid, 'large');
                    ?>
                    <div class="ekintza-card">
                        <?php if ($thumb_url): ?>
                        <div class="ekintza-card-img">
                            <img src="<?php echo esc_url($thumb_url); ?>" alt="<?php echo esc_attr(get_the_title($pid)); ?>">
                        </div>
                        <?php else: ?>
                        <div class="ekintza-card-img ekintza-card-img--placeholder">
                            <i class="fas fa-music"></i>
                        </div>
                        <?php endif; ?>
                        <div class="ekintza-card-body">
                            <h4 class="ekintza-card-title"><?php echo esc_html(get_the_title($pid)); ?></h4>
                            <div class="ekintza-card-links">
                                <?php if ($argazkiak): ?>
                                <a href="<?php echo esc_url($argazkiak); ?>" target="_blank" rel="noopener" class="ekintza-link ekintza-link--photos">
                                    <i class="fas fa-camera"></i> Argazkiak
                                </a>
                                <?php endif; ?>
                                <?php if ($bideoa): ?>
                                    <?php
                                    // Check if embeddable or just a link
                                    $is_direct_video = preg_match('/\.(mp4|webm|ogv)(\?.*)?$/i', $bideoa)
                                        || preg_match('/(?:youtube\.com|youtu\.be|vimeo\.com|drive\.google\.com)/', $bideoa);
                                    if ($is_direct_video):
                                    ?>
                                    <a href="<?php echo esc_url($bideoa); ?>" target="_blank" rel="noopener" class="ekintza-link ekintza-link--video">
                                        <i class="fas fa-video"></i> Bideoa
                                    </a>
                                    <?php else: ?>
                                    <a href="<?php echo esc_url($bideoa); ?>" target="_blank" rel="noopener" class="ekintza-link ekintza-link--video">
                                        <i class="fas fa-video"></i> Bideoa
                                    </a>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; wp_reset_postdata(); ?>
                </div>
            </div>
            <?php endforeach; ?>

        </div><!-- .ekintza-year-block -->
        <?php endforeach; ?>

        <?php endif; ?>

    </div>
</div>

<?php get_footer(); ?>
