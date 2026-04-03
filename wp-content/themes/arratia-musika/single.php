<?php get_header(); ?>

<div class="container">
    <?php while (have_posts()): the_post();
        $argazkiak = get_post_meta(get_the_ID(), '_ekintza_argazkiak', true)
                  ?: get_post_meta(get_the_ID(), '_google_photos_url', true);
        $bideoa    = get_post_meta(get_the_ID(), '_ekintza_bideoa', true)
                  ?: get_post_meta(get_the_ID(), '_video_url', true);
        $m = (int) get_the_date('n');
        $y = get_the_date('Y');
    ?>
    <div class="single-post">
        <a href="<?php echo esc_url(get_permalink(get_page_by_path('ekintzak')) ?: home_url('/')); ?>" class="back-link">
            <i class="fas fa-arrow-left"></i> Ekintzak
        </a>

        <h1 class="post-title"><?php the_title(); ?></h1>
        <p class="post-meta">
            <i class="far fa-calendar-alt"></i>
            <?php echo esc_html(arratia_month_eu($m) . ' ' . $y); ?>
        </p>

        <?php if (has_post_thumbnail()): ?>
        <div class="post-thumbnail">
            <?php the_post_thumbnail('large'); ?>
        </div>
        <?php endif; ?>

        <div class="post-content">
            <?php the_content(); ?>
        </div>

        <?php if ($bideoa): ?>
        <div style="margin-top:1.5rem;">
            <?php echo arratia_render_video($bideoa); ?>
        </div>
        <?php endif; ?>

        <?php if ($argazkiak): ?>
        <a href="<?php echo esc_url($argazkiak); ?>" class="google-photos-link" target="_blank" rel="noopener">
            <i class="fas fa-images"></i> Argazkiak ikusi / Ver fotos
        </a>
        <?php endif; ?>
    </div>
    <?php endwhile; ?>
</div>

<?php get_footer(); ?>
