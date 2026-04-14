<footer class="site-footer">
    <div class="container">
        <div class="footer-top">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="footer-title">Arratiako Musika Eskola</a>

            <div class="footer-pentagrama">
                <div class="pentagrama-lines">
                    <span></span><span></span><span></span><span></span><span></span>
                </div>
                <div class="pentagrama-content">
                    <a href="<?php echo esc_url( ARRATIA_TELEFONO_HREF ); ?>" class="pentagrama-item">
                        <i class="fas fa-phone-alt"></i> <?php echo esc_html( ARRATIA_TELEFONO ); ?>
                    </a>
                    <a href="mailto:<?php echo esc_attr( ARRATIA_EMAIL ); ?>" class="pentagrama-item">
                        <i class="fas fa-envelope"></i> <?php echo esc_html( ARRATIA_EMAIL ); ?>
                    </a>
                    <span class="pentagrama-item">
                        <i class="fas fa-map-marker-alt"></i> <?php echo esc_html( ARRATIA_HELBIDEA ); ?>
                    </span>
                    <span class="pentagrama-item pentagrama-social">
                        <a href="<?php echo esc_url( ARRATIA_INSTAGRAM_URL ); ?>" target="_blank" rel="noopener" aria-label="Instagram" class="footer-social-icon"><i class="fab fa-instagram"></i></a>
                        <a href="<?php echo esc_url( ARRATIA_FACEBOOK_URL ); ?>" target="_blank" rel="noopener" aria-label="Facebook" class="footer-social-icon"><i class="fab fa-facebook-f"></i></a>
                    </span>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <span>&copy; <?php echo date('Y'); ?> Arratiako Musika Eskola</span>
            <span><?php echo esc_html( ARRATIA_HERRIA ); ?></span>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
