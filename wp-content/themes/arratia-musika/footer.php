<footer class="site-footer">
    <div class="container">
        <div class="footer-top">
            <div class="footer-brand">
                <?php
                $logo_id = get_theme_mod('custom_logo');
                $logo_url = $logo_id ? wp_get_attachment_image_url($logo_id, 'medium') : '';
                if ($logo_url): ?>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="footer-logo-link">
                    <img src="<?php echo esc_url($logo_url); ?>" alt="<?php bloginfo('name'); ?>" class="footer-logo">
                </a>
                <?php else: ?>
                <div class="brand-name">Arratiako Musika Eskola</div>
                <?php endif; ?>
            </div>

            <div class="footer-col">
                <h4>Kontaktua</h4>
                <ul>
                    <li><a href="tel:+34946317352"><i class="fas fa-phone-alt footer-icon"></i> 946 317 352</a></li>
                    <li><a href="mailto:info@arratiakomusikaeskola.eu"><i class="fas fa-envelope footer-icon"></i> info@arratiakomusikaeskola.eu</a></li>
                    <li><i class="fas fa-map-marker-alt footer-icon"></i> Herriko Plaza 1. 48142 Artea. Bizkaia.</li>
                    <li style="margin-top:0.75rem;">
                        <a href="https://www.instagram.com/arratiakomusikaeskola/" target="_blank" rel="noopener" aria-label="Instagram" class="footer-social-icon">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://www.facebook.com/arratiakomusikaeskola" target="_blank" rel="noopener" aria-label="Facebook" class="footer-social-icon">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Orrialdeak</h4>
                <ul>
                    <li><a href="<?php echo esc_url(get_permalink(get_page_by_path('ikasgaiak'))); ?>">Ikasgaiak</a></li>
                    <li><a href="<?php echo esc_url(get_permalink(get_page_by_path('ekintzak'))); ?>">Ekintzak</a></li>
                    <li><a href="<?php echo esc_url(get_permalink(get_page_by_path('nortzuk-gara'))); ?>">Nortzuk gara</a></li>
                    <li><a href="<?php echo esc_url(get_permalink(get_page_by_path('matrikulazioa'))); ?>">Matrikulazioa</a></li>
                    <li><a href="<?php echo esc_url(get_permalink(get_page_by_path('kontaktua'))); ?>">Kontaktua</a></li>
                    <li><a href="<?php echo esc_url(home_url('/pribatutasun-politika/')); ?>">Pribatutasun-politika</a></li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <span>&copy; <?php echo date('Y'); ?> Arratiako Musika Eskola</span>
            <span>Artea · Bizkaia</span>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
