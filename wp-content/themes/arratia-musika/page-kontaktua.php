<?php
/**
 * Template Name: Kontaktua
 */
get_header();

$kf_sent  = false;
$kf_error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['kf_nonce'])) {
    if (!wp_verify_nonce($_POST['kf_nonce'], 'kontaktu_form')) {
        $kf_error = 'Segurtasun errorea. Saiatu berriro.';
    } else {
        $kf_izena     = sanitize_text_field($_POST['kf_izena'] ?? '');
        $kf_email     = sanitize_email($_POST['kf_email'] ?? '');
        $kf_telefonoa = sanitize_text_field($_POST['kf_telefonoa'] ?? '');
        $kf_mezua     = sanitize_textarea_field($_POST['kf_mezua'] ?? '');

        if (!$kf_izena || !$kf_email || !$kf_mezua) {
            $kf_error = 'Bete ezazu eremu guztiak.';
        } elseif (!is_email($kf_email)) {
            $kf_error = 'Email helbidea ez da zuzena.';
        } else {
            $headers = [
                'Content-Type: text/plain; charset=UTF-8',
                'Reply-To: ' . $kf_izena . ' <' . $kf_email . '>',
            ];
            $subject  = 'Kontaktu mezua — ' . $kf_izena;
            $tel_line = $kf_telefonoa ? "\nTelefonoa: {$kf_telefonoa}" : '';
            $body     = "Igorlea: {$kf_izena}\nEmail: {$kf_email}{$tel_line}\n\nMezua:\n{$kf_mezua}";
            $ok = wp_mail('info@arratiakomusikaeskola.eu', $subject, $body, $headers);
            if ($ok) {
                $kf_sent = true;
            } else {
                $kf_error = 'Errorea mezua bidaltzean. Saiatu berriro edo deitu guri.';
            }
        }
    }
}

$u = content_url('uploads');

// Update these locations with the actual Arratia school addresses
$locations = [
    [
        'herria'   => 'Igorre',
        'helbidea' => 'Helbidea, X',
        'cp'       => '48140 Igorre',
        'escudoa'  => $u . '/2024/06/escudo-igorre.png',
        'argazkia' => $u . '/2024/06/eskola-igorre.jpg',
        'gmaps'    => 'https://maps.google.com/?q=Igorre+Bizkaia',
    ],
    [
        'herria'   => 'Zeanuri',
        'helbidea' => 'Helbidea, X',
        'cp'       => '48144 Zeanuri',
        'escudoa'  => $u . '/2024/06/escudo-zeanuri.png',
        'argazkia' => $u . '/2024/06/eskola-zeanuri.jpg',
        'gmaps'    => 'https://maps.google.com/?q=Zeanuri+Bizkaia',
    ],
];
?>

<div class="kontaktua-page">
    <div class="container">

        <?php arratia_page_hero('Non gaude', 'Kontaktua'); ?>

        <!-- Contact info bar -->
        <div class="kontaktua-info-bar">
            <a href="tel:946000000" class="kontaktua-info-item">
                <i class="fas fa-phone-alt"></i> 946 000 000
            </a>
            <a href="mailto:info@arratiakomusikaeskola.eu" class="kontaktua-info-item">
                <i class="fas fa-envelope"></i> info@arratiakomusikaeskola.eu
            </a>
        </div>

        <!-- Locations -->
        <?php foreach ($locations as $loc): ?>
        <div class="kontaktua-location">
            <h2 class="kontaktua-herria-title"><?php echo esc_html($loc['herria']); ?></h2>
            <div class="kontaktua-location-grid">

                <!-- Flip card -->
                <div class="kontaktua-flip-wrap">
                    <div class="flip-card kontaktua-flip">
                        <div class="flip-card-inner">
                            <div class="flip-card-front kontaktua-flip-front">
                                <?php if (file_exists(ABSPATH . 'wp-content/uploads/' . basename($loc['escudoa']))): ?>
                                <img src="<?php echo esc_url($loc['escudoa']); ?>" alt="<?php echo esc_attr($loc['herria']); ?>">
                                <?php else: ?>
                                <div style="font-size:3rem;opacity:.4;">🏔</div>
                                <strong><?php echo esc_html($loc['herria']); ?></strong>
                                <?php endif; ?>
                                <span class="kontaktua-flip-hint"><i class="fas fa-sync-alt"></i> Pasatu gainetik</span>
                            </div>
                            <div class="flip-card-back kontaktua-flip-back">
                                <?php if ($loc['argazkia']): ?>
                                <img src="<?php echo esc_url($loc['argazkia']); ?>" alt="Eskola <?php echo esc_attr($loc['herria']); ?>">
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="kontaktua-address">
                        <i class="fas fa-map-marker-alt"></i>
                        <div>
                            <strong><?php echo esc_html($loc['helbidea']); ?></strong><br>
                            <span><?php echo esc_html($loc['cp']); ?></span>
                        </div>
                        <a href="<?php echo esc_url($loc['gmaps']); ?>" target="_blank" rel="noopener" class="btn btn-accent" style="margin-left:auto;font-size:0.8rem;padding:0.4rem 0.9rem;">
                            <i class="fas fa-directions"></i> Ibilbidea
                        </a>
                    </div>
                </div>

                <!-- Mapa placeholder -->
                <a href="<?php echo esc_url($loc['gmaps']); ?>" target="_blank" rel="noopener" class="kontaktua-mapa-link">
                    <div class="kontaktua-mapa-placeholder">
                        <i class="fas fa-map-marker-alt"></i>
                        <span><?php echo esc_html($loc['helbidea']); ?><br><?php echo esc_html($loc['cp']); ?></span>
                        <span class="kontaktua-mapa-cta"><i class="fas fa-external-link-alt"></i> Google Maps-en ikusi</span>
                    </div>
                </a>

            </div>
        </div>
        <?php endforeach; ?>

        <!-- Formulario de contacto -->
        <div class="kontaktua-form-section">
            <h2 class="kontaktua-form-title"><i class="fas fa-paper-plane"></i> Idatzi iezaguzu</h2>

            <?php if ($kf_sent): ?>
                <div class="kf-success">
                    <i class="fas fa-check-circle"></i> Mezua bidali da. Laster jarriko gara zurekin harremanetan.
                </div>
            <?php else: ?>
                <?php if ($kf_error): ?>
                    <div class="kf-error"><i class="fas fa-exclamation-circle"></i> <?php echo esc_html($kf_error); ?></div>
                <?php endif; ?>
                <form class="kontaktua-form" method="post">
                    <?php wp_nonce_field('kontaktu_form', 'kf_nonce'); ?>
                    <div class="kf-row">
                        <div class="kf-group">
                            <label for="kf_izena">Izena / Nombre</label>
                            <input type="text" id="kf_izena" name="kf_izena" required
                                value="<?php echo esc_attr($_POST['kf_izena'] ?? ''); ?>">
                        </div>
                        <div class="kf-group">
                            <label for="kf_email">Email</label>
                            <input type="email" id="kf_email" name="kf_email" required
                                value="<?php echo esc_attr($_POST['kf_email'] ?? ''); ?>">
                        </div>
                    </div>
                    <div class="kf-row">
                        <div class="kf-group">
                            <label for="kf_telefonoa">Telefonoa / Teléfono <span class="kf-optional">(aukerakoa)</span></label>
                            <input type="tel" id="kf_telefonoa" name="kf_telefonoa"
                                value="<?php echo esc_attr($_POST['kf_telefonoa'] ?? ''); ?>">
                        </div>
                    </div>
                    <div class="kf-group">
                        <label for="kf_mezua">Mezua / Mensaje</label>
                        <textarea id="kf_mezua" name="kf_mezua" rows="5" required><?php echo esc_textarea($_POST['kf_mezua'] ?? ''); ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-accent">
                        <i class="fas fa-paper-plane"></i> Bidali
                    </button>
                </form>
            <?php endif; ?>
        </div>

    </div>
</div>

<?php get_footer(); ?>
