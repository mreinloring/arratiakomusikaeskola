<?php
/**
 * Template Name: Ongi Etorri
 */
get_header();

// Gallery images: all images attached to this page
$images = get_posts([
    'post_type'      => 'attachment',
    'post_mime_type' => 'image',
    'post_parent'    => get_the_ID(),
    'posts_per_page' => -1,
    'orderby'        => 'menu_order date',
    'order'          => 'ASC',
]);
?>

<div class="ongi-etorri-page">
    <div class="container">

        <?php arratia_page_hero('Ongi Etorri', 'Arratiako Musika Eskola'); ?>

        <!-- Page content -->
        <div class="ongi-etorri-content">
            <?php
            while (have_posts()): the_post();
                the_content();
            endwhile;
            ?>
        </div>

        <?php if ($images): ?>
        <!-- Gallery -->
        <div class="ongi-galeria">
            <h2 class="section-title" style="margin-bottom:1.5rem;">
                <i class="fas fa-images"></i> Argazkiak
            </h2>
            <div class="ongi-galeria-grid">
                <?php foreach ($images as $img):
                    $full  = wp_get_attachment_image_url($img->ID, 'full');
                    $thumb = wp_get_attachment_image_url($img->ID, 'large');
                    $alt   = get_post_meta($img->ID, '_wp_attachment_image_alt', true) ?: get_the_title($img->ID);
                ?>
                <a href="<?php echo esc_url($full); ?>"
                   class="ongi-galeria-item"
                   data-lightbox="<?php echo esc_attr($alt); ?>">
                    <img src="<?php echo esc_url($thumb); ?>"
                         alt="<?php echo esc_attr($alt); ?>"
                         loading="lazy">
                    <div class="ongi-galeria-overlay"><i class="fas fa-expand"></i></div>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

    </div>
</div>

<!-- Lightbox -->
<div class="ongi-lightbox" id="ongiLightbox" aria-hidden="true">
    <button class="ongi-lightbox-close" id="ongiLightboxClose" aria-label="Itxi">&times;</button>
    <button class="ongi-lightbox-prev" id="ongiLightboxPrev" aria-label="Aurrekoa">&#8249;</button>
    <button class="ongi-lightbox-next" id="ongiLightboxNext" aria-label="Hurrengoa">&#8250;</button>
    <div class="ongi-lightbox-wrap">
        <img src="" alt="" id="ongiLightboxImg">
    </div>
</div>

<script>
(function(){
    var items = Array.from(document.querySelectorAll('.ongi-galeria-item'));
    if (!items.length) return;
    var lb     = document.getElementById('ongiLightbox');
    var lbImg  = document.getElementById('ongiLightboxImg');
    var lbClose= document.getElementById('ongiLightboxClose');
    var lbPrev = document.getElementById('ongiLightboxPrev');
    var lbNext = document.getElementById('ongiLightboxNext');
    var current= 0;

    function open(idx) {
        current = idx;
        lbImg.src = items[idx].href;
        lbImg.alt = items[idx].dataset.lightbox;
        lb.classList.add('active');
        lb.setAttribute('aria-hidden','false');
        document.body.style.overflow = 'hidden';
    }
    function close() {
        lb.classList.remove('active');
        lb.setAttribute('aria-hidden','true');
        document.body.style.overflow = '';
        lbImg.src = '';
    }
    function go(dir) {
        current = (current + dir + items.length) % items.length;
        lbImg.src = '';
        lbImg.src = items[current].href;
        lbImg.alt = items[current].dataset.lightbox;
    }

    items.forEach(function(el, i){
        el.addEventListener('click', function(e){
            e.preventDefault();
            open(i);
        });
    });
    lbClose.addEventListener('click', close);
    lb.addEventListener('click', function(e){ if (e.target === lb) close(); });
    lbPrev.addEventListener('click', function(){ go(-1); });
    lbNext.addEventListener('click', function(){ go(1); });
    document.addEventListener('keydown', function(e){
        if (!lb.classList.contains('active')) return;
        if (e.key === 'Escape')      close();
        if (e.key === 'ArrowLeft')   go(-1);
        if (e.key === 'ArrowRight')  go(1);
    });
})();
</script>

<?php get_footer(); ?>
