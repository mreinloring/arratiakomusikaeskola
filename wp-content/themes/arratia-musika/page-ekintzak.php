<?php
/**
 * Template Name: Ekintzak
 * Assign to the page with slug "ekintzak".
 * Muestra las actividades YA PASADAS (las próximas están en la portada),
 * todas desplegadas, agrupadas por ikasturtea > hilabetea, las más recientes primero.
 * El curso y el mes salen de arratia_ekintza_date() (fecha, o curso+mes manual, o publicación).
 */
get_header();

$months_es = ['', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
              'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

// ── Actividades pasadas (o sin fecha guardada: se usa curso+mes o publicación) ─
$query = new WP_Query([
    'post_type'      => 'ekintza',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'meta_query'     => [
        'relation' => 'OR',
        [
            'key'     => '_ekintza_data',
            'value'   => arratia_today(),
            'compare' => '<',
            'type'    => 'DATE',
        ],
        [
            'key'     => '_ekintza_data',
            'compare' => 'NOT EXISTS',
        ],
    ],
]);

// Agrupar: $years[ año inicio curso ][ 'Y-m' ] = [ ['post'=>, 'date'=>], ... ]
$years = [];
foreach ($query->posts as $p) {
    $date = arratia_ekintza_date($p->ID);
    if ($date >= arratia_today()) continue; // sin fecha pero curso+mes futuro
    $ts = strtotime($date);
    $m  = (int) date('n', $ts);
    $y  = (int) date('Y', $ts);
    $course_start = ($m >= 9) ? $y : $y - 1;
    $years[$course_start][date('Y-m', $ts)][] = ['post' => $p, 'date' => $date];
}

// Cursos y meses: más recientes primero; dentro del mes, por fecha descendente
krsort($years);
foreach ($years as &$months) {
    krsort($months);
    foreach ($months as &$items) {
        usort($items, function($a, $b) {
            return strcmp($b['date'], $a['date']) ?: ($a['post']->menu_order - $b['post']->menu_order);
        });
    }
    unset($items);
}
unset($months);
?>

<div class="ekintzak-page">
    <div class="container">

        <?php arratia_page_hero(arratia_t('Ekintzak', 'Actividades'), arratia_t('Egindako ekintzak', 'Actividades realizadas')); ?>

        <?php if (empty($years)): ?>
            <p style="text-align:center;color:#888;padding:3rem 0;">Oraindik ez dago ekintzarik. Laster!<br><em>(Aún no hay actividades registradas)</em></p>
        <?php else: ?>

        <?php foreach ($years as $course_start => $months): ?>
        <div class="ekintza-year-block">
            <h2 class="ekintza-year-title">
                <?php echo esc_html($course_start . '/' . ($course_start + 1)); ?> <?php echo arratia_t('Ikasturtea', 'Curso'); ?>
            </h2>

            <?php foreach ($months as $ym => $items):
                [$my, $mm] = array_map('intval', explode('-', $ym));
                $month_label = (arratia_lang() === 'es' ? $months_es[$mm] : arratia_month_eu($mm)) . ' ' . $my;
            ?>
            <div class="ekintza-month-block">
                <h3 class="ekintza-month-title"><?php echo esc_html($month_label); ?></h3>
                <div class="ekintza-cards">
                    <?php foreach ($items as $item):
                        $pid         = $item['post']->ID;
                        $permalink   = get_permalink($pid);
                        $argazkiak   = get_post_meta($pid, '_ekintza_argazkiak', true)
                                    ?: get_post_meta($pid, '_google_photos_url', true);
                        $bideoa      = get_post_meta($pid, '_ekintza_bideoa', true)
                                    ?: get_post_meta($pid, '_video_url', true);
                        $memoria_pdf = get_post_meta($pid, '_ekintza_memoria_pdf', true);
                        $thumb_url   = get_the_post_thumbnail_url($pid, 'large');
                        $has_content = trim(wp_strip_all_tags($item['post']->post_content)) !== '';
                    ?>
                    <?php if ($memoria_pdf && !$argazkiak && !$bideoa && !$has_content): ?>
                    <a href="<?php echo esc_url($memoria_pdf); ?>" target="_blank" rel="noopener" class="ekintza-card ekintza-card--memoria">
                        <i class="fas fa-file-pdf ekintza-card--memoria-icon"></i>
                        <div class="ekintza-card-body">
                            <h4 class="ekintza-card-title"><?php echo esc_html(get_the_title($pid)); ?></h4>
                            <span class="ekintza-link ekintza-link--pdf" style="pointer-events:none;">
                                <i class="fas fa-download"></i> <?php echo arratia_t('Deskargatu', 'Descargar'); ?>
                            </span>
                        </div>
                    </a>
                    <?php else: ?>
                    <div class="ekintza-card">
                        <a href="<?php echo esc_url($permalink); ?>" class="ekintza-card-img<?php echo $thumb_url ? '' : ' ekintza-card-img--placeholder'; ?>">
                            <?php if ($thumb_url): ?>
                            <img src="<?php echo esc_url($thumb_url); ?>" alt="<?php echo esc_attr(get_the_title($pid)); ?>" loading="lazy">
                            <?php else: ?>
                            <i class="fas fa-music"></i>
                            <?php endif; ?>
                        </a>
                        <div class="ekintza-card-body">
                            <h4 class="ekintza-card-title">
                                <a href="<?php echo esc_url($permalink); ?>" style="color:inherit;"><?php echo esc_html(get_the_title($pid)); ?></a>
                            </h4>
                            <div class="ekintza-card-links">
                                <?php if ($argazkiak): ?>
                                <a href="<?php echo esc_url($argazkiak); ?>" target="_blank" rel="noopener" class="ekintza-link ekintza-link--photos">
                                    <i class="fas fa-camera"></i> Argazkiak
                                </a>
                                <?php endif; ?>
                                <?php if ($bideoa): ?>
                                <a href="<?php echo esc_url($bideoa); ?>" target="_blank" rel="noopener" class="ekintza-link ekintza-link--video">
                                    <i class="fas fa-video"></i> Bideoa
                                </a>
                                <?php endif; ?>
                                <?php if ($memoria_pdf): ?>
                                <a href="<?php echo esc_url($memoria_pdf); ?>" target="_blank" rel="noopener" class="ekintza-link ekintza-link--pdf">
                                    <i class="fas fa-file-pdf"></i> Memoria
                                </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endforeach; ?>

        </div><!-- .ekintza-year-block -->
        <?php endforeach; ?>

        <?php endif; ?>

    </div>
</div>

<?php get_footer(); ?>
