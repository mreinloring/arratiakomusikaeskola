<?php
/**
 * Template Name: Egutegia
 */
get_header();

$img_url = get_option('arratia_egutegia_img', '');
$pdf_url = get_option('arratia_egutegia_pdf', '');
?>

<div class="hezantolaketa-page">
    <div class="container">

        <?php arratia_page_hero(arratia_t('Egutegia', 'Calendario'), arratia_t('Ikasturte Egutegia', 'Calendario del curso')); ?>

        <?php if ($img_url): ?>
        <div class="hezantolaketa-img-wrap">
            <img src="<?php echo esc_url($img_url); ?>" alt="Ikasturte Egutegia" loading="lazy">
        </div>
        <?php elseif ($pdf_url): ?>
        <div class="hezantolaketa-pdf-wrap">
            <iframe src="<?php echo esc_url($pdf_url); ?>" title="Ikasturte Egutegia" loading="lazy" allowfullscreen></iframe>
        </div>
        <?php else: ?>
        <p style="padding:2rem 0;color:#999;">
            <i class="fas fa-info-circle"></i>
            Ezartzeko: <strong>Matrikulak → Ezarpenak</strong> atalean igo Egutegia irudia edo PDFaren URLa.
        </p>
        <?php endif; ?>

        <?php if ($pdf_url): ?>
        <p class="hezantolaketa-pdf-link">
            <a href="<?php echo esc_url($pdf_url); ?>" target="_blank" rel="noopener" class="btn btn-accent">
                <i class="fas fa-download"></i> PDF deskargatu / Descargar PDF
            </a>
        </p>
        <?php endif; ?>

    </div>
</div>

<?php get_footer(); ?>
