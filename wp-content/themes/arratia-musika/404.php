<?php get_header(); ?>

<div class="container">
    <div class="error-404">
        <div class="icon">🎵</div>
        <h1>404</h1>
        <p>Orria ez da aurkitu / La página no existe</p>
        <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-accent">
            ← Hasierara itzuli / Volver al inicio
        </a>
    </div>
</div>

<?php get_footer(); ?>
