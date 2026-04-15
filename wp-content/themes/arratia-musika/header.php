<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
    <div class="container">
        <div class="site-logo">
            <?php if (has_custom_logo()): ?>
                <?php the_custom_logo(); ?>
            <?php else: ?>
                <a href="<?php echo home_url('/'); ?>" class="site-name">
                    Arratiako<span>Musika Eskola</span>
                </a>
            <?php endif; ?>
        </div>

        <?php
        $arratia_cur_lang = arratia_lang();
        $arratia_url_eu   = esc_url(add_query_arg('lang', 'eu', home_url('/')));
        $arratia_url_es   = esc_url(add_query_arg('lang', 'es', home_url('/')));
        ?>
        <div class="lang-switcher" aria-label="Hizkuntza / Idioma">
            <a href="<?php echo $arratia_url_eu; ?>"
               class="lang-btn<?php echo $arratia_cur_lang === 'eu' ? ' lang-btn--active' : ''; ?>"
               <?php echo $arratia_cur_lang === 'eu' ? 'aria-current="true"' : ''; ?>>EU</a>
            <a href="<?php echo $arratia_url_es; ?>"
               class="lang-btn<?php echo $arratia_cur_lang === 'es' ? ' lang-btn--active' : ''; ?>"
               <?php echo $arratia_cur_lang === 'es' ? 'aria-current="true"' : ''; ?>>ES</a>
        </div>

        <button class="menu-toggle" id="menuToggle" aria-label="Menú" aria-expanded="false">
            <span></span><span></span><span></span>
        </button>

        <nav class="site-nav" id="siteNav" aria-label="Menu nagusia">
            <?php wp_nav_menu([
                'theme_location' => 'primary',
                'container'      => false,
                'fallback_cb'    => false,
            ]); ?>
        </nav>
    </div>
</header>
