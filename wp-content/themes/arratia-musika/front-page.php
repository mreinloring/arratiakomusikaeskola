<?php get_header(); ?>

<!-- ═══ HERO ═══════════════════════════════════════════════════════════════ -->
<section class="site-hero">
    <div class="container hero-center">
        <!-- <span class="hero-tag">Arratia bailara · Musika eskola</span> -->

        <?php
        $logo_id  = get_theme_mod('custom_logo');
        $logo_url = $logo_id ? wp_get_attachment_image_url($logo_id, 'full') : content_url('uploads') . '/LogoArratia.png';
        ?>
        <img src="<?php echo esc_url($logo_url); ?>" alt="Arratiako Musika Eskola" class="hero-logo hero-logo--large">

        <p><?php echo arratia_t('Musikaren bidez hazi, sortu eta partekatu', 'Crece, crea y comparte a través de la música'); ?></p>

        <div class="hero-actions hero-actions--center">
            <?php if (get_option('arratia_matrikula_open', '1')): ?>
            <a href="<?php echo esc_url(get_permalink(get_page_by_path('matrikula-eskaera'))); ?>" class="btn btn-accent btn-lg">
                <?php echo arratia_t('Matrikula', 'Matrícula'); ?> &rarr;
            </a>
            <?php endif; ?>
            <a href="<?php echo esc_url(get_permalink(get_page_by_path('ikasgaiak'))); ?>" class="btn btn-outline-white btn-lg">
                <?php echo arratia_t('Ikasgaiak', 'Asignaturas'); ?>
            </a>
        </div>
    </div>
</section>

<!-- ═══ DATORREN IKASTURTEA — DOKUMENTUAK ══════════════════════════════════ -->
<?php
$_pdf_mm       = get_option('arratia_front_pdf_mm',          '');
$_pdf_hm       = get_option('arratia_front_pdf_hm',          '');
$_pdf_egutegia = get_option('arratia_front_pdf_egutegia',     '');
$_pdf_beste    = get_option('arratia_front_pdf_beste',        '');
$_pdf_beste_lbl = get_option('arratia_front_pdf_beste_label', '');
$_pdfs = array_filter([
    $_pdf_mm       ? ['url' => $_pdf_mm,       'label' => arratia_t('Ordutegi MM', 'Horario MM'),           'icon' => 'fa-file-pdf']     : null,
    $_pdf_hm       ? ['url' => $_pdf_hm,       'label' => arratia_t('Ordutegi HM', 'Horario HM'),           'icon' => 'fa-file-pdf']     : null,
    $_pdf_egutegia ? ['url' => $_pdf_egutegia, 'label' => arratia_t('Egutegia', 'Calendario'),              'icon' => 'fa-calendar-alt'] : null,
    $_pdf_beste    ? ['url' => $_pdf_beste,    'label' => $_pdf_beste_lbl ?: arratia_t('Dokumentua', 'Documento'), 'icon' => 'fa-file-alt'] : null,
]);
if (!empty($_pdfs)):
?>
<section class="section section-alt front-docs-section">
    <div class="container">
        <div class="section-header text-center">
            <h2 class="section-title"><?php echo arratia_t('Datorren ikasturtea', 'Próximo curso'); ?></h2>
            <p class="section-sub"><?php echo arratia_t('Informazioa eta dokumentuak', 'Información y documentos'); ?></p>
        </div>
        <div class="front-docs-grid">
            <?php foreach ($_pdfs as $_doc): ?>
            <a href="<?php echo esc_url($_doc['url']); ?>" target="_blank" rel="noopener" class="front-doc-card">
                <i class="fas <?php echo esc_attr($_doc['icon']); ?> front-doc-icon"></i>
                <span class="front-doc-label"><?php echo esc_html($_doc['label']); ?></span>
                <i class="fas fa-download front-doc-dl"></i>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- ═══ AZKEN EKINTZAK ══════════════════════════════════════════════════════ -->
<section class="section section--white">
    <div class="container">
        <div class="section-header text-center">
            <h2 class="section-title"><?php echo arratia_t('Azken jarduerak', 'Últimas actividades'); ?></h2>
        </div>

        <?php
        $recent = new WP_Query([
            'post_type'      => 'post',
            'posts_per_page' => 4,
            'post_status'    => 'publish',
            'orderby'        => 'date',
            'order'          => 'DESC',
        ]);
        ?>
        <?php if ($recent->have_posts()): ?>
        <div class="azken-ekintzak-grid">
            <?php while ($recent->have_posts()): $recent->the_post();
                $argazkiak = get_post_meta(get_the_ID(), '_ekintza_argazkiak', true)
                          ?: get_post_meta(get_the_ID(), '_google_photos_url', true);
                $permalink = get_permalink();
                $thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
            ?>
            <article class="azken-ekintza-card">
                <a href="<?php echo esc_url($permalink); ?>" class="azken-ekintza-img">
                    <?php if ($thumb_url): ?>
                        <img src="<?php echo esc_url($thumb_url); ?>" alt="<?php the_title_attribute(); ?>">
                    <?php else: ?>
                        <div class="azken-ekintza-placeholder">🎵</div>
                    <?php endif; ?>
                </a>
                <div class="azken-ekintza-body">
                    <h3 class="azken-ekintza-title">
                        <a href="<?php echo esc_url($permalink); ?>"><?php the_title(); ?></a>
                    </h3>
                    <div class="azken-ekintza-excerpt"><?php the_excerpt(); ?></div>
                    <div class="azken-ekintza-footer">
                        <?php if ($argazkiak): ?>
                            <a href="<?php echo esc_url($argazkiak); ?>" target="_blank" rel="noopener" class="azken-ekintza-link">
                                <i class="fas fa-images"></i> <?php echo arratia_t('Argazkiak', 'Fotos'); ?> »
                            </a>
                        <?php else: ?>
                            <a href="<?php echo esc_url($permalink); ?>" class="azken-ekintza-link"><?php echo arratia_t('Irakurri', 'Leer'); ?> &rarr;</a>
                        <?php endif; ?>
                    </div>
                </div>
            </article>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
        <div class="text-center mt-3">
            <a href="<?php echo esc_url(get_permalink(get_page_by_path('ekintzak'))); ?>" class="btn btn-outline">
                <?php echo arratia_t('Ekintza guztiak', 'Todas las actividades'); ?> &rarr;
            </a>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- ═══ BIDEOAK ════════════════════════════════════════════════════════════ -->
<?php
$video_1      = get_option('arratia_front_video_1', '');
$video_2      = get_option('arratia_front_video_2', '');
$video_1_desc = get_option('arratia_front_video_1_desc', '');
$video_2_desc = get_option('arratia_front_video_2_desc', '');
$video_1_img  = get_option('arratia_front_video_1_img', '');
$video_2_img  = get_option('arratia_front_video_2_img', '');

$videos = [];
if ($video_1) $videos[] = ['url' => $video_1, 'desc' => $video_1_desc, 'img' => $video_1_img];
if ($video_2) $videos[] = ['url' => $video_2, 'desc' => $video_2_desc, 'img' => $video_2_img];

if ($videos):
?>
<section class="section section-alt front-bideoak-section">
    <div class="container">
        <div class="section-header text-center">
            <h2 class="section-title"><?php echo arratia_t('Ikasleen lanak', 'Trabajos de los alumnos'); ?></h2>
        </div>
        <div class="front-bideoak-grid front-bideoak-grid--<?php echo count($videos) === 1 ? 'one' : 'two'; ?>">
            <?php foreach ($videos as $vi => $v): $uid = 'bideo-desc-' . $vi; ?>
            <div class="front-bideo-card">
                <?php if (!empty($v['img'])): ?>
                <div class="front-bideo-cover">
                    <img src="<?php echo esc_url($v['img']); ?>" alt="<?php echo esc_attr($v['desc']); ?>">
                    <div class="front-bideo-cover-overlay">
                        <a href="<?php echo esc_url($v['url']); ?>" target="_blank" rel="noopener" class="front-bideo-play-btn" aria-label="<?php echo arratia_t('Erreproduzitu', 'Reproducir'); ?>">
                            <i class="fas fa-play"></i>
                        </a>
                    </div>
                </div>
                <?php else: ?>
                <div class="front-bideo-embed">
                    <?php echo arratia_render_video($v['url']); ?>
                </div>
                <?php endif; ?>
                <?php if (!empty($v['desc'])): ?>
                <div class="front-bideo-body">
                    <p class="front-bideo-desc" id="<?php echo $uid; ?>"><?php echo esc_html($v['desc']); ?></p>
                    <button class="front-bideo-more" data-target="<?php echo $uid; ?>" style="display:none;"><?php echo arratia_t('Irakurri gehiago', 'Leer más'); ?> &darr;</button>
                </div>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- ═══ SARE SOZIALAK ═══════════════════════════════════════════════════════ -->
<section class="section section--white front-social-section">
    <div class="container">
        <div class="front-social-grid">

            <!-- Instagram -->
            <div class="front-social-insta">
                <div class="text-center" style="margin-bottom:1rem;">
                    <h2 class="section-title" style="font-size:1.3rem;"><i class="fab fa-instagram" style="color:#C13584;"></i> Instagram</h2>
                    <p style="font-size:0.85rem;color:var(--gray-600);"><?php echo esc_html( ARRATIA_INSTAGRAM_HANDLE ); ?></p>
                </div>
                <?php echo do_shortcode('[instagram-feed num=6 cols=3]'); ?>
                <div class="text-center mt-2">
                    <a href="<?php echo esc_url( ARRATIA_INSTAGRAM_URL ); ?>" target="_blank" rel="noopener" class="btn btn-outline" style="font-size:0.85rem;">
                        <i class="fab fa-instagram"></i> <?php echo arratia_t('Instagramen ikusi', 'Ver en Instagram'); ?> &rarr;
                    </a>
                </div>
            </div>

            <!-- Facebook -->
            <div class="front-social-fb">
                <div class="text-center" style="margin-bottom:1rem;">
                    <h2 class="section-title" style="font-size:1.3rem;"><i class="fab fa-facebook" style="color:#1877F2;"></i> Facebook</h2>
                    <p style="font-size:0.85rem;color:var(--gray-600);"><?php echo esc_html( ARRATIA_FACEBOOK_NAME ); ?></p>
                </div>
                <div class="fb-static">
                    <i class="fab fa-facebook fb-static-icon"></i>
                    <p class="fb-static-name"><?php echo esc_html( ARRATIA_FACEBOOK_NAME ); ?></p>
                    <p class="fb-static-desc"><?php echo arratia_t('Jarraitu gure Facebook orrian azken berriak eta argazkiak ikusteko.', 'Síguenos en nuestra página de Facebook para ver las últimas noticias y fotos.'); ?></p>
                    <a href="<?php echo esc_url( ARRATIA_FACEBOOK_URL ); ?>" target="_blank" rel="noopener" class="btn btn-accent" style="margin-top:1rem;">
                        <i class="fab fa-facebook"></i> <?php echo arratia_t('Orria ikusi', 'Ver página'); ?>
                    </a>
                </div>

                <!-- YouTube -->
                <div class="fb-static" style="margin-top:1.5rem;border-top:1px solid var(--gray-200);padding-top:1.5rem;">
                    <i class="fab fa-youtube" style="font-size:2.5rem;color:var(--accent);margin-bottom:0.75rem;display:block;"></i>
                    <p class="fb-static-name"><?php echo esc_html( ARRATIA_YOUTUBE_NAME ); ?></p>
                    <p class="fb-static-desc"><?php echo arratia_t('Ikasleen bideoak eta kontzertuak gure YouTube kanalean.', 'Vídeos de alumnos y conciertos en nuestro canal de YouTube.'); ?></p>
                    <a href="<?php echo esc_url( ARRATIA_YOUTUBE_URL ); ?>" target="_blank" rel="noopener" class="btn btn-accent" style="margin-top:1rem;">
                        <i class="fab fa-youtube"></i> <?php echo arratia_t('Kanala ikusi', 'Ver canal'); ?>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ═══ IKASGAIAK ══════════════════════════════════════════════════════════ -->
<section class="section">
    <div class="container">
        <div class="section-header text-center">
            <h2 class="section-title"><?php echo arratia_t('Zer ikasi daiteke?', '¿Qué se puede estudiar?'); ?></h2>
        </div>

        <?php
        $ikasgai_page = get_page_by_path('ikasgaiak');
        $ikasgai_url  = esc_url($ikasgai_page ? get_permalink($ikasgai_page->ID) : home_url('/arratiakomusikaeskola/ikasgaiak/'));

        // Get one thumbnail from a category
        function arratia_front_cat_img($kategoria) {
            $q = new WP_Query(['post_type'=>'ikasgai','post_status'=>'publish','posts_per_page'=>1,'meta_query'=>[['key'=>'_ikasgai_kategoria','value'=>$kategoria]]]);
            if ($q->have_posts()) { $q->the_post(); $u = get_the_post_thumbnail_url(get_the_ID(),'medium'); wp_reset_postdata(); return $u ?: ''; }
            return '';
        }

        // Images: from Ezarpenak settings, fallback to first ikasgai thumbnail
        function arratia_front_ig_opt_img($opt_key, $fallback_cats) {
            $url = get_option($opt_key, '');
            if ($url) return $url;
            foreach ((array)$fallback_cats as $cat) {
                $u = arratia_front_cat_img($cat);
                if ($u) return $u;
            }
            return '';
        }

        $cards = [
            [
                'label'  => arratia_t('Tresnak', 'Instrumentos'),
                'img'    => arratia_front_ig_opt_img('arratia_front_ig_img_tresnak', ['Bakarka - Hari igurtzizko instrumentuak','Bakarka - Zurezko haize-instrumentuak','Bakarka - Metalezko haize-instrumentuak','Bakarka - Tekla-tresnak','Bakarka - Perkusio-tresnak','Bakarka - Hari pultsatuko instrumentuak','Bakarka - Euskal instrumentu tradizionalak']),
                'lines'  => [arratia_t("Banakako eskolak, 30' astekoak", "Clases individuales, 30' semanales")],
                'anchor' => 'tresnak',
            ],
            [
                'label'  => arratia_t('Teoriko-Praktikoa', 'Teórico-Práctico'),
                'img'    => arratia_front_ig_opt_img('arratia_front_ig_img_teoriko', ['Taldean Teoriko-Praktikoa']),
                'lines'  => [arratia_t('Musikarekin Kontaktua', 'Contacto con la Música'), arratia_t('Hizkuntza Musikala', 'Lenguaje Musical')],
                'anchor' => 'teoriko-praktikoa',
            ],
            [
                'label'  => arratia_t('Taldeak', 'Grupos'),
                'img'    => arratia_front_ig_opt_img('arratia_front_ig_img_taldeak', ['Taldean']),
                'lines'  => [arratia_t('Konboak', 'Combos'), arratia_t('Ensemble taldeak', 'Grupos de ensemble')],
                'anchor' => 'taldeak',
            ],
            [
                'label'  => arratia_t('Ahotsa', 'Voz'),
                'img'    => arratia_front_ig_opt_img('arratia_front_ig_img_ahotsa', ['Bakarka - Kantuko espezialitatea']),
                'lines'  => [arratia_t('Ahozko teknika', 'Técnica vocal'), arratia_t('Kirikinusi korua', 'Coro Kirikinusi'), arratia_t('Helduen korua', 'Coro adultos')],
                'anchor' => 'ahotsa',
            ],
        ];
        ?>

        <div class="front-ig-grid">
        <?php foreach ($cards as $card): ?>
            <a href="<?php echo $ikasgai_url . '#' . esc_attr($card['anchor']); ?>" class="front-ig-card">
                <h3 class="front-ig-card-title"><?php echo esc_html($card['label']); ?></h3>
                <hr class="front-ig-divider">
                <div class="front-ig-card-img">
                    <?php if (!empty($card['img'])): ?>
                        <img src="<?php echo esc_url($card['img']); ?>" alt="<?php echo esc_attr($card['label']); ?>">
                    <?php else: ?>
                        <div class="front-ig-card-noimg">🎵</div>
                    <?php endif; ?>
                </div>
                <hr class="front-ig-divider">
                <?php if (!empty($card['lines'])): ?>
                <ul class="front-ig-card-subjects">
                    <?php foreach ($card['lines'] as $line): ?>
                        <li><?php echo esc_html($line); ?></li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
            </a>
        <?php endforeach; ?>
        </div>

        <div class="text-center mt-3">
            <a href="<?php echo $ikasgai_url; ?>" class="btn btn-accent">
                <?php echo arratia_t('Ikasgai guztiak', 'Todas las asignaturas'); ?> &rarr;
            </a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
