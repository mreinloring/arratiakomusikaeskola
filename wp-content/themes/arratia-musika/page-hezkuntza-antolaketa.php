<?php
/**
 * Template Name: Hezkuntza Antolaketa
 */
get_header();

$img_url = get_option('arratia_antolaketa_img', '');
?>

<div class="hezantolaketa-page">
    <div class="container">

        <?php arratia_page_hero('Hezkuntza Antolaketa', 'Hezkuntza Antolaketa'); ?>

        <?php if ($img_url): ?>
        <div class="hezantolaketa-img-wrap">
            <img src="<?php echo esc_url($img_url); ?>" alt="Hezkuntza Antolaketa" loading="lazy">
        </div>
        <?php else: ?>
        <p style="padding:2rem 0;color:#999;">
            <i class="fas fa-info-circle"></i>
            Irudia ezartzeko: <strong>Matrikulak → Ezarpenak</strong> atalean igo Hezkuntza Antolaketa irudiaren URLa.
        </p>
        <?php endif; ?>

    </div>
</div>

<?php get_footer(); ?>
