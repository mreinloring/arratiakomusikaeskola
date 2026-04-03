<?php get_header(); ?>

<!-- ═══ HERO ═══════════════════════════════════════════════════════════════ -->
<section class="site-hero">
    <div class="container hero-center">
        <span class="hero-tag">Arratia bailara · Musika eskola</span>

        <?php
        $logo_id  = get_theme_mod('custom_logo');
        $logo_url = $logo_id ? wp_get_attachment_image_url($logo_id, 'full') : content_url('uploads') . '/LogoArratia.png';
        ?>
        <img src="<?php echo esc_url($logo_url); ?>" alt="Arratiako Musika Eskola" class="hero-logo hero-logo--large">

        <p>Musikaren bidez hazi, sortu eta partekatu</p>

        <div class="hero-actions hero-actions--center">
            <a href="<?php echo esc_url(get_permalink(get_page_by_path('matrikula-eskaera'))); ?>" class="btn btn-accent btn-lg">
                Matrikula &rarr;
            </a>
            <a href="<?php echo esc_url(get_permalink(get_page_by_path('ikasgaiak'))); ?>" class="btn btn-outline-white btn-lg">
                Ikasgaiak
            </a>
        </div>
    </div>
</section>

<!-- ═══ AZKEN EKINTZAK ══════════════════════════════════════════════════════ -->
<section class="section">
    <div class="container">
        <div class="section-header text-center">
            <span class="section-label">Jarduerak</span>
            <h2 class="section-title">Azken jarduerak</h2>
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
                                <i class="fas fa-images"></i> Argazkiak »
                            </a>
                        <?php else: ?>
                            <a href="<?php echo esc_url($permalink); ?>" class="azken-ekintza-link">Irakurri &rarr;</a>
                        <?php endif; ?>
                    </div>
                </div>
            </article>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
        <div class="text-center mt-3">
            <a href="<?php echo esc_url(get_permalink(get_page_by_path('ekintzak'))); ?>" class="btn btn-outline">
                Ekintza guztiak &rarr;
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
            <span class="section-label">Bideoak</span>
            <h2 class="section-title">Ikasleen lanak</h2>
        </div>
        <div class="front-bideoak-grid front-bideoak-grid--<?php echo count($videos) === 1 ? 'one' : 'two'; ?>">
            <?php foreach ($videos as $vi => $v): $uid = 'bideo-desc-' . $vi; ?>
            <div class="front-bideo-card">
                <?php if (!empty($v['img'])): ?>
                <div class="front-bideo-cover">
                    <img src="<?php echo esc_url($v['img']); ?>" alt="<?php echo esc_attr($v['desc']); ?>">
                    <div class="front-bideo-cover-overlay">
                        <a href="<?php echo esc_url($v['url']); ?>" target="_blank" rel="noopener" class="front-bideo-play-btn" aria-label="Erreproduzitu">
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
                    <button class="front-bideo-more" data-target="<?php echo $uid; ?>" style="display:none;">Irakurri gehiago &darr;</button>
                </div>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- ═══ IKASGAIAK ══════════════════════════════════════════════════════════ -->
<section class="section">
    <div class="container">
        <div class="section-header text-center">
            <span class="section-label">Ikasgaiak</span>
            <h2 class="section-title">Zer ikasi daiteke?</h2>
        </div>

        <?php
        $ikasgai_url = esc_url(get_permalink(get_page_by_path('ikasgaiak')) ?: home_url('/ikasgaiak/'));

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
                'label'  => 'Tresnak',
                'img'    => arratia_front_ig_opt_img('arratia_front_ig_img_tresnak', ['Bakarka - Hari igurtzizko instrumentuak','Bakarka - Zurezko haize-instrumentuak','Bakarka - Metalezko haize-instrumentuak','Bakarka - Tekla-tresnak','Bakarka - Perkusio-tresnak','Bakarka - Hari pultsatuko instrumentuak','Bakarka - Euskal instrumentu tradizionalak']),
                'lines'  => ["Banakako eskolak, 30' astekoak"],
                'anchor' => 'tresnak',
            ],
            [
                'label'  => 'Teoriko-Praktikoa',
                'img'    => arratia_front_ig_opt_img('arratia_front_ig_img_teoriko', ['Taldean Teoriko-Praktikoa']),
                'lines'  => ['Musikarekin Kontaktua', 'Hizkuntza Musikala'],
                'anchor' => 'teoriko-praktikoa',
            ],
            [
                'label'  => 'Taldeak',
                'img'    => arratia_front_ig_opt_img('arratia_front_ig_img_taldeak', ['Taldean']),
                'lines'  => ['Konboak', 'Ensemble taldeak'],
                'anchor' => 'taldeak',
            ],
            [
                'label'  => 'Ahotsa',
                'img'    => arratia_front_ig_opt_img('arratia_front_ig_img_ahotsa', ['Bakarka - Kantuko espezialitatea']),
                'lines'  => ['Ahozko teknika', 'Kirikinusi korua', 'Helduen korua'],
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
                Ikasgai guztiak &rarr;
            </a>
        </div>
    </div>
</section>

<!-- ═══ SARE SOZIALAK ══════════════════════════════════════════════════════ -->
<section class="social-section">
    <div class="container">
        <div class="section-header text-center">
            <span class="section-label">Sare sozialak</span>
            <h2 class="section-title">Jarraitu gurekin</h2>
        </div>
        <div class="social-grid">

            <!-- Instagram -->
            <div class="social-card social-card--instagram">
                <div class="social-card-header">
                    <span class="label"><i class="fab fa-instagram"></i> Instagram</span>
                    <span style="font-size:0.78rem;color:#999;">@arratiakomusikaeskola</span>
                </div>
                <div class="social-card-body">
                    <?php if (is_active_sidebar('sidebar-instagram')): ?>
                        <?php dynamic_sidebar('sidebar-instagram'); ?>
                    <?php else: ?>
                        <div class="insta-placeholder">
                            <i class="fab fa-instagram"></i>
                            <p>Instala un plugin de feed de Instagram<br>y configúralo en <strong>Apariencia → Widgets</strong></p>
                            <a href="https://www.instagram.com/arratiakomusikaeskola/" target="_blank" rel="noopener">
                                @arratiakomusikaeskola
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="social-card-footer">
                    <a href="https://www.instagram.com/arratiakomusikaeskola/" target="_blank" rel="noopener">
                        <i class="fab fa-instagram"></i> Instagramen ikusi &rarr;
                    </a>
                </div>
            </div>

            <!-- Facebook -->
            <div class="social-card social-card--facebook">
                <div class="social-card-header">
                    <span class="label"><i class="fab fa-facebook"></i> Facebook</span>
                    <span style="font-size:0.78rem;color:#999;">Arratiako Musika Eskola</span>
                </div>
                <div class="social-card-body social-card-body--fb">
                    <div class="fb-static">
                        <i class="fab fa-facebook fb-static-icon"></i>
                        <p class="fb-static-name">Arratiako Musika Eskola</p>
                        <p class="fb-static-desc">Jarraitu gure Facebook orrian azken berriak eta argazkiak ikusteko.</p>
                        <a href="https://www.facebook.com/arratiakomusikaeskola" target="_blank" rel="noopener" class="btn btn-accent" style="margin-top:1rem;">
                            <i class="fab fa-facebook"></i> Orria ikusi
                        </a>
                    </div>
                </div>
                <div class="social-card-footer">
                    <a href="https://www.facebook.com/arratiakomusikaeskola" target="_blank" rel="noopener">
                        <i class="fab fa-facebook"></i> Facebooken ikusi &rarr;
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

<?php get_footer(); ?>
