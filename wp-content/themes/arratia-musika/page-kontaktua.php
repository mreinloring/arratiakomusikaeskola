<?php
/**
 * Template Name: Kontaktua
 */
get_header();

$kf_sent  = false;
$kf_error = '';

// --- ANTI-SPAM: rate limiting por IP (máx 5 intentos/hora) ---
$kf_ip       = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
$kf_rate_key = 'kf_rate_' . md5($kf_ip);
$kf_attempts = (int) get_transient($kf_rate_key);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['kf_nonce'])) {
    if ($kf_attempts >= 5) {
        $kf_error = 'Saiakera gehiegi. Itxaron ordu bat eta saiatu berriro.';
    } elseif (!wp_verify_nonce($_POST['kf_nonce'], 'kontaktu_form')) {
        $kf_error = 'Segurtasun errorea. Saiatu berriro.';
    } else {
        // Registrar intento antes de validar
        set_transient($kf_rate_key, $kf_attempts + 1, HOUR_IN_SECONDS);

        // --- ANTI-SPAM: honeypot (debe estar vacío) ---
        if (!empty($_POST['kf_honeypot'])) {
            $kf_error = 'Error de validación anti-spam.';
        }
        // --- ANTI-SPAM: captcha dinámico (respuesta guardada en transient) ---
        else {
            $kf_captcha_token    = sanitize_text_field($_POST['kf_captcha_token'] ?? '');
            $kf_captcha_expected = $kf_captcha_token ? (int) get_transient('kf_cap_' . $kf_captcha_token) : false;
            if ($kf_captcha_token) {
                delete_transient('kf_cap_' . $kf_captcha_token);
            }
            if (!$kf_captcha_expected || intval($_POST['kf_captcha'] ?? '') !== $kf_captcha_expected) {
                $kf_error = 'Babeserako galdera ez da zuzena. Saiatu berriro.';
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
    }
}

// --- Generar captcha dinámico para el formulario ---
$kf_n1            = rand(1, 9);
$kf_n2            = rand(1, 9);
$kf_captcha_token = bin2hex(random_bytes(16));
set_transient('kf_cap_' . $kf_captcha_token, $kf_n1 + $kf_n2, 30 * MINUTE_IN_SECONDS);

?>

<div class="kontaktua-page">
    <div class="container">

        <?php arratia_page_hero('Kontaktua', 'Jarri gurekin harremanetan'); ?>

        <!-- Contact info bar -->
        <div class="kontaktua-info-bar">
            <a href="tel:946317352" class="kontaktua-info-item">
                <i class="fas fa-phone-alt"></i> 946 317 352
            </a>
            <a href="mailto:info@arratiakomusikaeskola.eu" class="kontaktua-info-item">
                <i class="fas fa-envelope"></i> info@arratiakomusikaeskola.eu
            </a>
        </div>

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

                    <!-- HONEYPOT: campo oculto para bots -->
                    <div style="display: none;">
                        <label for="kf_honeypot">Ez bete eremu hau</label>
                        <input type="text" id="kf_honeypot" name="kf_honeypot">
                    </div>

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
                    <!-- CAPTCHA DINÁMICO (token de un solo uso) -->
                    <input type="hidden" name="kf_captcha_token" value="<?php echo esc_attr($kf_captcha_token); ?>">
                    <div class="kf-group" style="background: #f9f9f9; padding: 12px; border-radius: 6px; margin-top: 15px;">
                        <label for="kf_captcha"><strong>Babeserako galdera: zenbat da <?php echo (int)$kf_n1; ?> + <?php echo (int)$kf_n2; ?>? *</strong></label>
                        <input type="text" id="kf_captcha" name="kf_captcha" required size="4" autocomplete="off"
                            style="width: 80px; text-align: center; display: inline-block; margin-left: 10px;"
                            value="">
                        <small>(idatzi zenbakia)</small>
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
