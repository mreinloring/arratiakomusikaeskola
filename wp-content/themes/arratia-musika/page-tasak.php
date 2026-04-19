<?php
/**
 * Template Name: Tasak
 */
get_header();

$pdf_url = get_option('arratia_front_pdf_tasak', '');
?>

<div class="hezantolaketa-page">
    <div class="container">

        <?php arratia_page_hero(arratia_t('Tasak', 'Tasas'), arratia_t('Ikasturte Tasak', 'Tasas del curso')); ?>

        <?php if ($pdf_url): ?>
        <div class="hezantolaketa-pdf-wrap">
            <iframe src="<?php echo esc_url($pdf_url); ?>" title="Tasak" loading="lazy" allowfullscreen></iframe>
        </div>
        <p class="hezantolaketa-pdf-link">
            <a href="<?php echo esc_url($pdf_url); ?>" target="_blank" rel="noopener" class="btn btn-accent">
                <i class="fas fa-download"></i> PDF deskargatu / Descargar PDF
            </a>
        </p>
        <?php else: ?>
        <p style="padding:2rem 0;color:#999;">
            <i class="fas fa-info-circle"></i>
            Ezartzeko: <strong>Matrikulak → Ezarpenak</strong> atalean igo Tasak PDFaren URLa.
        </p>
        <?php endif; ?>

    </div>
</div>

<?php get_footer(); ?>
