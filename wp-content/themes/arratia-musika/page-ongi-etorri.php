<?php
/**
 * Template Name: Ongi Etorri
 */
get_header();
?>

<div class="ongi-etorri-page">
    <div class="container">

        <?php arratia_page_hero('Ongi Etorri', 'Arratiako Musika Eskola'); ?>

        <!-- Texto -->
        <div class="ongi-etorri-text">
            <p>Gure historia, musika irakasteko zentro ofizial bezala, 1986an hasi zen, Oinarrizko Musika Kontserbatorio gisa.</p>
            <p>Lehenago eta 70eko hamarkadaz geroztik, tokiko akademiak sortzen ari ziren, Sorkunde, Inmakulada eta Edurne Gumuzio ahizpek Artean bultzatutakoa, edo Areatza eta Igorren, Ruper Lekueren eskutik sortutakoak, Kaixo fanfarrearen eta Luis Iruarrizaga Abesbatzaren laguntzarekin –tokiko korporazioen laguntza ekonomikoaz gain– ikasle ugari zein sortzen ari den irakasle klaustro bat ere lortuko dutenak.</p>
            <p>Aipatutako akademien bilerak, beharrezko ofizialtze-eskaerarekin batera, "Arratiako Oinarrizko Musika Kontserbatorioa" sortzea ekarriko du, 1992tik aurrera eta LOGSE indarrean sartzearekin batera "Arratiako Musika Eskola" izena hartuko duena.</p>
        </div>

        <!-- Slider -->
        <?php
        $slider_ids_raw = get_post_meta(get_the_ID(), '_ongi_slider_ids', true);
        $slider_ids = array_filter(array_map('intval', explode(',', $slider_ids_raw)));
        if ($slider_ids):
        ?>
        <div class="ongi-slider" id="ongiSlider">
            <div class="ongi-slider-track" id="ongiSliderTrack">
                <?php foreach ($slider_ids as $img_id):
                    $full = wp_get_attachment_image_url($img_id, 'large');
                    if (!$full) continue;
                    $alt  = get_post_meta($img_id, '_wp_attachment_image_alt', true) ?: '';
                ?>
                <div class="ongi-slide">
                    <img src="<?php echo esc_url($full); ?>" alt="<?php echo esc_attr($alt); ?>" loading="lazy">
                </div>
                <?php endforeach; ?>
            </div>
            <button class="ongi-slider-btn ongi-slider-prev" id="ongiPrev" aria-label="Aurrekoa">&#8249;</button>
            <button class="ongi-slider-btn ongi-slider-next" id="ongiNext" aria-label="Hurrengoa">&#8250;</button>
            <div class="ongi-slider-dots" id="ongiDots"></div>
        </div>
        <?php endif; ?>

    </div>
</div>

<script>
(function(){
    var track  = document.getElementById('ongiSliderTrack');
    var prev   = document.getElementById('ongiPrev');
    var next   = document.getElementById('ongiNext');
    var dotsEl = document.getElementById('ongiDots');
    if (!track) return;

    var slides  = track.querySelectorAll('.ongi-slide');
    var total   = slides.length;
    var current = 0;
    var timer;

    // Build dots
    slides.forEach(function(_, i) {
        var d = document.createElement('button');
        d.className = 'ongi-dot' + (i === 0 ? ' active' : '');
        d.setAttribute('aria-label', 'Slide ' + (i+1));
        d.addEventListener('click', function(){ go(i); });
        dotsEl.appendChild(d);
    });

    function go(idx) {
        slides[current].classList.remove('active');
        dotsEl.children[current].classList.remove('active');
        current = (idx + total) % total;
        slides[current].classList.add('active');
        dotsEl.children[current].classList.add('active');
        track.style.transform = 'translateX(-' + (current * 100) + '%)';
        resetTimer();
    }

    function resetTimer() {
        clearInterval(timer);
        timer = setInterval(function(){ go(current + 1); }, 4000);
    }

    slides[0].classList.add('active');
    prev.addEventListener('click', function(){ go(current - 1); });
    next.addEventListener('click', function(){ go(current + 1); });
    document.addEventListener('keydown', function(e){
        if (e.key === 'ArrowLeft')  go(current - 1);
        if (e.key === 'ArrowRight') go(current + 1);
    });
    resetTimer();
})();
</script>

<?php get_footer(); ?>
