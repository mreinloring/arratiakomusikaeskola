<?php
/**
 * Template Name: Matrikula Eskaera (Formularioa)
 *
 * Age groups (age as of 31/12/$ref_year):
 *  4–6  → Musika & Mugimendua only
 *  7    → MM + optional instrument (if places available)
 *  8–12 → HM + instrument
 *  13+  → instrument ± HM
 */

$now      = new DateTime();
$cur_yr   = (int) $now->format('Y');
$cur_mo   = (int) $now->format('n');
$ref_year = ($cur_mo >= 3) ? $cur_yr : $cur_yr - 1;
$ikasturtea_label = $ref_year . '/' . ($ref_year + 1);

$min_birth_year = $ref_year - 4;
$max_birth_year = $ref_year - 80;
$date_max = $min_birth_year . '-12-31';
$date_min = $max_birth_year . '-01-01';

// ─────────────────────────────────────────────────────────────────────────────
$sent         = false;
$error        = '';
$error_fields = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['arratia_matrikula_nonce'])) {
    if (!wp_verify_nonce($_POST['arratia_matrikula_nonce'], 'arratia_matrikula_submit')) {
        $error = 'Segurtasun errorea. Mesedez, saiatu berriro.';
    } else {
        if (empty($_POST['asignatura']) && !empty($_POST['asignatura_auto'])) {
            $_POST['asignatura'] = $_POST['asignatura_auto'];
        }

        $required = [
            'nombre'        => 'Izena',
            'apellido1'     => '1. Abizena',
            'apellido2'     => '2. Abizena',
            'direccion'     => 'Helbidea',
            'poblacion'     => 'Udalerria',
            'fecha_nto'     => 'Jaiotze data',
            'telefono1'     => '1. Telefonoa',
            'email'         => 'E-posta',
            'iban'          => 'IBAN',
            'titularCuenta' => 'Kontuaren titularra',
            'nino'          => 'Adina / Maila',
            'alumno'        => 'Ikasle berria / ohia',
            'autorizo'      => 'Argazkien baimena',
            'pribatutasuna' => 'Pribatutasun Politika onartu',
        ];
        $missing = [];
        foreach ($required as $field => $label) {
            if (empty($_POST[$field])) {
                $missing[]            = $label;
                $error_fields[$field] = true;
            }
        }
        if ($missing) {
            $error = count($missing) === 1
                ? $missing[0] . ' eremua bete gabe dago.'
                : count($missing) . ' eremu bete gabe daude: ' . implode(', ', $missing) . '.';
        }

        if (!$error) {
            function fmt_asig_arratia($v) {
                $map = array_merge(['mm'=>'Musika & Mugimendua'], arratia_get_asignaturak());
                return $map[$v] ?? $v;
            }
            $p      = array_map('sanitize_text_field', $_POST);
            $emisor = ARRATIA_EMAIL_ADMIN;
            $titulo = 'Prematrikula Arratia ' . $ikasturtea_label . ' — ' . $p['nombre'] . ' ' . $p['apellido1'];

            $html = '<html><head><meta charset="utf-8"><style>
                body{font-family:Arial,sans-serif;line-height:1.6;max-width:600px;margin:0 auto;padding:20px;color:#333}
                .hdr{background:#1E1916;color:#fff;padding:20px;text-align:center;border-radius:6px 6px 0 0}
                .hdr h2{color:#007B81;margin:8px 0 4px}
                h3{color:#1E1916;border-bottom:2px solid #eee;padding-bottom:4px;margin:20px 0 10px}
                table{width:100%;border-collapse:collapse;margin:10px 0}
                td{padding:7px 8px;border-bottom:1px solid #eee;font-size:14px}
                td:first-child{font-weight:600;width:42%;color:#444}
                .nota{background:#e6f4f5;padding:10px 14px;border-left:4px solid #007B81;margin:16px 0;font-size:13px}
            </style></head><body>
            <div class="hdr"><h2>Arratiako Musika Eskola</h2><p>Prematrikula berria ' . esc_html($ikasturtea_label) . '</p></div>
            <h3>Ikaslearen datuak</h3>
            <table>
              <tr><td>Izen-abizenak</td><td>' . $p['nombre'] . ' ' . $p['apellido1'] . ' ' . $p['apellido2'] . '</td></tr>
              <tr><td>Helbidea</td><td>' . $p['direccion'] . ', ' . $p['poblacion'] . '</td></tr>
              <tr><td>Jaiotze data</td><td>' . $p['fecha_nto'] . '</td></tr>
              <tr><td>Adina</td><td>' . $p['nino'] . '</td></tr>
              <tr><td>Telefonoa 1</td><td>' . $p['telefono1'] . '</td></tr>
              <tr><td>Telefonoa 2</td><td>' . ($p['telefono2'] ?? '—') . '</td></tr>
              <tr><td>Email</td><td>' . $p['email'] . '</td></tr>
              <tr><td>Email 2</td><td>' . ($p['email2'] ?? '—') . '</td></tr>
              <tr><td>Gurasoak</td><td>' . ($p['nombre_padres'] ?? '—') . '</td></tr>
            </table>
            <h3>Banku datuak</h3>
            <table>
              <tr><td>IBAN</td><td>' . $p['iban'] . '</td></tr>
              <tr><td>Titularra</td><td>' . $p['titularCuenta'] . '</td></tr>
            </table>
            <h3>Matrikula datuak</h3>
            <table>
              <tr><td>Ikasgaia</td><td>' . fmt_asig_arratia($p['asignatura'] ?? '') . '</td></tr>
              <tr><td>Instrumentua</td><td>' . ($p['instrumento'] ?? '—') . '</td></tr>
              <tr><td>Instrumentua (6-7 urte)</td><td>' . ($p['instrumento7'] ?? '—') . '</td></tr>
              <tr><td>Ikastegi</td><td>' . ($p['centro_estudio'] ?? '—') . '</td></tr>
              <tr><td>Ikasle ohia</td><td>' . $p['alumno'] . '</td></tr>
            </table>
            <h3>Baimenak</h3>
            <table>
              <tr><td>Argazkiak</td><td>' . $p['autorizo'] . '</td></tr>
              <tr><td>Baldintzak</td><td>Onartu</td></tr>
            </table>
            <div class="nota"><strong>EKINTZA BEHARREZKOA:</strong> Prematrikula hau prozesatu ekainaren 30 baino lehen.</div>
            </body></html>';

            $headers_admin = [
                'Content-Type: text/html; charset=UTF-8',
                'From: Arratiako Musika Eskola <' . $emisor . '>',
                'Reply-To: ' . $p['nombre'] . ' ' . $p['apellido1'] . ' <' . $p['email'] . '>',
            ];
            wp_mail($emisor, $titulo, $html, $headers_admin);

            // Save to DB
            global $wpdb;
            $jaiotze = !empty($p['fecha_nto']) ? $p['fecha_nto'] : null;
            $wpdb->insert(
                $wpdb->prefix . 'arratia_matriculas',
                [
                    'ikasturtea'   => $ikasturtea_label,
                    'izena'        => $p['nombre'],
                    'abizena1'     => $p['apellido1'],
                    'abizena2'     => $p['apellido2'] ?? '',
                    'helbidea'     => $p['direccion'] ?? '',
                    'udalerria'    => $p['poblacion'] ?? '',
                    'jaiotze_data' => $jaiotze,
                    'telefono1'    => $p['telefono1'],
                    'telefono2'    => $p['telefono2'] ?? '',
                    'email'        => $p['email'],
                    'email2'       => $p['email2'] ?? '',
                    'gurasoak'     => $p['nombre_padres'] ?? '',
                    'iban'         => $p['iban'],
                    'titular'      => $p['titularCuenta'],
                    'maila'        => $p['nino'] ?? '',
                    'ikasgaia'     => $p['asignatura'] ?? '',
                    'instrumentua' => $p['instrumento'] ?? '',
                    'instrumento7' => $p['instrumento7'] ?? '',
                    'ikasle_mota'  => $p['alumno'],
                    'argazkiak'    => $p['autorizo'],
                    'baldintzak'   => 'bai',
                    'egoera'       => 'jasota',
                ],
                ['%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s']
            );

            // Confirmation to applicant
            $conf = '<html><head><meta charset="utf-8"><style>
                body{font-family:Arial,sans-serif;line-height:1.6;max-width:600px;margin:0 auto;padding:20px;color:#333}
                .hdr{background:#1E1916;color:#fff;padding:20px;text-align:center;border-radius:6px 6px 0 0}
                .hdr h2{color:#007B81;margin:8px 0 4px}
                h3{color:#1E1916;border-bottom:2px solid #eee;padding-bottom:4px;margin:20px 0 10px}
                table{width:100%;border-collapse:collapse;margin:10px 0}
                td{padding:7px 8px;border-bottom:1px solid #eee;font-size:14px}
                td:first-child{font-weight:600;width:42%;color:#444}
                .nota{background:#f0fdf4;padding:10px 14px;border-left:4px solid #16a34a;margin:16px 0;font-size:13px}
            </style></head><body>
            <div class="hdr"><h2>Arratiako Musika Eskola</h2><p>Prematrikula berrespena ' . esc_html($ikasturtea_label) . '</p></div>
            <p style="margin-top:20px">Kaixo <strong>' . $p['nombre'] . '</strong>!</p>
            <p>Eskerrik asko gure musika eskolan izena emateagatik. Zure matrikulazio eskaera jaso dugu eta ekain bukaeran jakinaraziko dizugu erantzuna.</p>
            <div class="nota">✅ Hau zure eskaeraren laburpena da. Gorde ezazu.</div>
            <h3>Ikaslearen datuak</h3>
            <table>
              <tr><td>Izen-abizenak</td><td>' . $p['nombre'] . ' ' . $p['apellido1'] . ' ' . $p['apellido2'] . '</td></tr>
              <tr><td>Jaiotze data</td><td>' . $p['fecha_nto'] . '</td></tr>
              <tr><td>Adina</td><td>' . $p['nino'] . '</td></tr>
              <tr><td>Telefonoa 1</td><td>' . $p['telefono1'] . '</td></tr>
              <tr><td>Email</td><td>' . $p['email'] . '</td></tr>
              <tr><td>Gurasoak</td><td>' . ($p['nombre_padres'] ?? '—') . '</td></tr>
            </table>
            <h3>Matrikula datuak</h3>
            <table>
              <tr><td>Ikasgaia</td><td>' . fmt_asig_arratia($p['asignatura'] ?? '') . '</td></tr>
              <tr><td>Instrumentua</td><td>' . ($p['instrumento'] ?? '—') . '</td></tr>
              <tr><td>Ikasle ohia</td><td>' . $p['alumno'] . '</td></tr>
            </table>
            <p style="color:#888;font-size:13px;margin-top:24px">' . esc_html( ARRATIA_EMAIL ) . '</p>
            </body></html>';
            $headers_conf = [
                'Content-Type: text/html; charset=UTF-8',
                'From: Arratiako Musika Eskola <' . $emisor . '>',
            ];
            wp_mail($p['email'], 'Arratiako Musika Eskola — Matrikula berrespena ' . $ikasturtea_label, $conf, $headers_conf);
            if (!empty($p['email2'])) {
                wp_mail($p['email2'], 'Arratiako Musika Eskola — Matrikula berrespena ' . $ikasturtea_label, $conf, $headers_conf);
            }

            $sent = true;
        }
    }
}

get_header();
?>

<div class="matrikula-eskaera-page">
<div class="container">

    <div class="mf-page-header">
        <?php
        $logo_id  = get_theme_mod('custom_logo');
        $logo_url = $logo_id ? wp_get_attachment_image_url($logo_id, 'full') : content_url('uploads') . '/LogoArratia.png';
        ?>
        <img src="<?php echo esc_url($logo_url); ?>" alt="Arratiako Musika Eskola" class="mf-page-logo">
        <div>
            <h1>Matrikula Eskaera<br><span class="mf-ikasturtea"><?php echo esc_html($ikasturtea_label); ?></span></h1>
        </div>
    </div>

    <?php if (!get_option('arratia_matrikula_open', '1') && !$sent): ?>
    <div class="mf-closed-notice">
        <i class="fas fa-lock"></i>
        <div>
            <strong>Matrikula aldia itxita dago</strong><br>
            Matrikulazio epea amaituta dago. Hurrengo ikasturtean aukera izango duzu berriz ere.<br>
            <em>El período de matriculación está cerrado. Podrás matricularte de nuevo el próximo curso.</em>
        </div>
    </div>
    <?php elseif ($sent): ?>
    <div class="mf-success">
        <i class="fas fa-check-circle"></i>
        <div>
            <strong>Eskaera behar bezala bidali da!</strong><br>
            Berrespena zure emailera bidali dugu. Ekain bukaeran jakinaraziko dizugu erantzuna.<br>
            <em style="opacity:0.75">¡Solicitud enviada correctamente! Hemos enviado la confirmación a tu email. Te informaremos a finales de junio.</em><br>
            <small style="opacity:0.65">Spam karpeta begiratu berrespena aurkitzen ez baduzu / Revisa la carpeta de spam si no recibes la confirmación.</small>
        </div>
    </div>
    <?php else: ?>

    <?php if ($error): ?>
    <div class="mf-error"><i class="fas fa-exclamation-triangle"></i> <?php echo esc_html($error); ?></div>
    <?php endif; ?>

    <form id="mf-form" method="post" class="mf-form" novalidate>
        <?php wp_nonce_field('arratia_matrikula_submit', 'arratia_matrikula_nonce'); ?>

        <!-- IKASLEAREN DATUAK -->
        <fieldset class="mf-fieldset">
            <legend><i class="fas fa-user"></i> Ikaslearen Datuak <span>/ Datos del Alumno</span></legend>
            <div class="mf-grid-2">
                <div class="mf-field">
                    <label>Izena <span class="req">*</span> <em>/ Nombre</em></label>
                    <input type="text" name="nombre" required value="<?php echo esc_attr($_POST['nombre'] ?? ''); ?>">
                </div>
                <div class="mf-field">
                    <label>1. Abizena <span class="req">*</span> <em>/ Apellido 1</em></label>
                    <input type="text" name="apellido1" required value="<?php echo esc_attr($_POST['apellido1'] ?? ''); ?>">
                </div>
                <div class="mf-field">
                    <label>2. Abizena <span class="req">*</span> <em>/ Apellido 2</em></label>
                    <input type="text" name="apellido2" required value="<?php echo esc_attr($_POST['apellido2'] ?? ''); ?>">
                </div>
                <div class="mf-field">
                    <label>Helbidea <span class="req">*</span> <em>/ Dirección</em></label>
                    <input type="text" name="direccion" required value="<?php echo esc_attr($_POST['direccion'] ?? ''); ?>">
                </div>
                <div class="mf-field">
                    <label>Udalerria <span class="req">*</span> <em>/ Municipio</em></label>
                    <select name="poblacion" required>
                        <option value="">Aukeratu / Selecciona</option>
                        <?php foreach (['Arantzazu','Areatza','Artea','Bedia','Dimako','Dima','Igorre','Lemoa','Murga','Orozko','Urduliz','Ugao-Miraballes','Zeberio','Zeanuri','Beste bat'] as $m): ?>
                        <option value="<?php echo esc_attr($m); ?>"<?php selected($_POST['poblacion'] ?? '', $m); ?>><?php echo esc_html($m); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mf-field">
                    <label>Jaiotze Data <span class="req">*</span> <em>/ Fecha Nacimiento</em></label>
                    <input type="date" name="fecha_nto" id="fecha_nto" required
                        min="<?php echo esc_attr($date_min); ?>"
                        max="<?php echo esc_attr($date_max); ?>"
                        value="<?php echo esc_attr($_POST['fecha_nto'] ?? ''); ?>">
                    <small>Gutxienez 4 urte (<?php echo esc_html($ref_year); ?>ko abenduaren 31n) · Mínimo 4 años a 31/12/<?php echo esc_html($ref_year); ?></small>
                    <div id="mf-age-warning" style="display:none;" class="mf-age-warning">
                        <i class="fas fa-baby"></i>
                        <div>
                            <strong>Adina ez da nahikoa / Edad insuficiente</strong><br>
                            <span>Ikasleak gutxienez <strong>4 urte</strong> izan behar ditu <?php echo esc_html($ref_year); ?>ko <strong>abenduaren 31rako</strong>.</span>
                        </div>
                    </div>
                </div>
                <div class="mf-field">
                    <label>1. Telefonoa <span class="req">*</span> <em>/ Teléfono 1</em></label>
                    <input type="tel" name="telefono1" maxlength="9" required value="<?php echo esc_attr($_POST['telefono1'] ?? ''); ?>">
                </div>
                <div class="mf-field">
                    <label>2. Telefonoa <em>/ Teléfono 2</em></label>
                    <input type="tel" name="telefono2" maxlength="9" value="<?php echo esc_attr($_POST['telefono2'] ?? ''); ?>">
                </div>
                <div class="mf-field">
                    <label>E-Posta <span class="req">*</span> <em>/ Email</em></label>
                    <input type="email" name="email" required value="<?php echo esc_attr($_POST['email'] ?? ''); ?>">
                </div>
                <div class="mf-field">
                    <label>2. E-Posta <em>/ Email 2</em></label>
                    <input type="email" name="email2" value="<?php echo esc_attr($_POST['email2'] ?? ''); ?>">
                </div>
                <div class="mf-field mf-field--full">
                    <label>Gurasoen Izenak <em>/ Nombre padres/tutores</em></label>
                    <input type="text" name="nombre_padres" value="<?php echo esc_attr($_POST['nombre_padres'] ?? ''); ?>">
                </div>
            </div>
        </fieldset>

        <!-- BANKUA -->
        <fieldset class="mf-fieldset">
            <legend><i class="fas fa-university"></i> Bankuko Datuak <span>/ Datos Bancarios</span></legend>
            <div class="mf-grid-2">
                <div class="mf-field mf-field--full">
                    <label>IBAN <span class="req">*</span></label>
                    <input type="text" name="iban" id="iban" required autocomplete="off"
                        placeholder="ES00 0000 0000 0000 0000 0000"
                        maxlength="29"
                        value="<?php echo esc_attr($_POST['iban'] ?? ''); ?>">
                    <small id="iban-msg" style="display:none;margin-top:4px;font-weight:600;"></small>
                </div>
                <div class="mf-field mf-field--full">
                    <label>Kontuaren Titularra <span class="req">*</span> <em>/ Titular de la cuenta</em></label>
                    <input type="text" name="titularCuenta" required value="<?php echo esc_attr($_POST['titularCuenta'] ?? ''); ?>">
                </div>
            </div>
        </fieldset>

        <!-- MATRIKULA DATUAK -->
        <fieldset class="mf-fieldset">
            <legend><i class="fas fa-music"></i> Matrikularako Datuak <span>/ Datos de Matrícula</span></legend>

            <div class="mf-maila-group" id="mf-maila-group" style="display:none;">
                <p class="mf-maila-label">Adina:</p>
                <label class="mf-radio"><input type="radio" name="nino" value="4-6 urte" id="nino1" onclick="return false;"> <strong>4–6 urte</strong> — Musika &amp; Mugimendua</label>
                <label class="mf-radio"><input type="radio" name="nino" value="7 urte" id="nino2" onclick="return false;"> <strong>7 urte</strong> — Musika &amp; Mugimendua + Tresna aukera (plazak badaude / si hay plazas)</label>
                <label class="mf-radio"><input type="radio" name="nino" value="8-12 urte" id="nino3" onclick="return false;"> <strong>8–12 urte</strong> — Abesbatza + Hizkuntza Musikala + Tresna</label>
                <label class="mf-radio"><input type="radio" name="nino" value="13+ urte" id="nino4" onclick="return false;"> <strong>13+ urte</strong></label>
            </div>
            <p id="mf-maila-hint" class="mf-hint" style="display:none;"></p>

            <div class="mf-grid-2" style="margin-top:1.25rem;">

                <!-- Auto-assigned subject badge (groups 1-3) -->
                <div class="mf-field" id="field-asignatura-badge" style="display:none;">
                    <label>Ikasgaia <em>/ Asignatura</em></label>
                    <div class="mf-asig-badge" id="asig-badge"></div>
                    <input type="hidden" name="asignatura_auto" id="asignatura-hidden">
                </div>

                <!-- Dropdown only for 13+ (group 4) -->
                <div class="mf-field" id="field-asignatura-select" style="display:none;">
                    <label>Ikasgaia <span class="req">*</span> <em>/ Asignatura</em></label>
                    <select name="asignatura" id="asignatura">
                        <option value="">Aukeratu gaia / Elige asignatura</option>
                        <?php foreach (arratia_get_asignaturak() as $val => $lbl): ?>
                        <option value="<?php echo esc_attr($val); ?>"><?php echo esc_html($lbl); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mf-field" id="field-instrumento">
                    <label id="label-instrumento">Instrumentua <em>/ Instrumento</em></label>
                    <select name="instrumento" id="instrumento">
                        <option value="">Aukeratu instrumentua</option>
                        <?php foreach (arratia_get_instrumentuak() as $ins): ?>
                        <option value="<?php echo esc_attr($ins); ?>"><?php echo esc_html($ins); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Optional instrument for 6-7 year olds -->
                <div class="mf-field" id="field-instrumento7" style="display:none;">
                    <label>Instrumentua <em>(aukerakoa, plazak badaude / opcional si hay plazas)</em></label>
                    <select name="instrumento7" id="instrumento7">
                        <option value="">Sin instrumento</option>
                        <?php foreach (arratia_get_instrumentuak7() as $ins): ?>
                        <option value="<?php echo esc_attr($ins); ?>"><?php echo esc_html($ins); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mf-field">
                    <label>Ikastetxearen Izena <em>/ Centro escolar</em></label>
                    <input type="text" name="centro_estudio" value="<?php echo esc_attr($_POST['centro_estudio'] ?? ''); ?>">
                </div>
            </div>

            <div class="mf-radio-group" style="margin-top:1rem;">
                <p class="mf-maila-label">Ikasle berria / ohia: <span class="req">*</span></p>
                <label class="mf-radio"><input type="radio" name="alumno" value="Ikasle berria" required> Ikasle berria / Alumno nuevo</label>
                <label class="mf-radio"><input type="radio" name="alumno" value="Ikasle ohia"> Ikasle ohia / Ex alumno</label>
            </div>
        </fieldset>

        <!-- BAIMENA -->
        <fieldset class="mf-fieldset">
            <legend><i class="fas fa-camera"></i> Argazki Baimena <span>/ Autorización Fotografías</span></legend>
            <p class="mf-legal">Maiatzaren 6ko 1/1982 Legearen arabera, Arratiako musika eskolak ateratako argazki eta bideoak erabili ahal izateko baimena eskatzen da, beti ere hezkuntza helburuarekin erabiliko direlarik.</p>
            <label class="mf-radio"><input type="radio" name="autorizo" value="Baimena ematen da" required> <strong>Baimena ematen da</strong> / Sí autorizo</label>
            <label class="mf-radio"><input type="radio" name="autorizo" value="Ez da baimenik ematen"> <strong>Ez da baimenik ematen</strong> / No autorizo</label>
        </fieldset>

        <!-- BALDINTZAK -->
        <fieldset class="mf-fieldset">
            <legend><i class="fas fa-file-contract"></i> Baldintzak <span>/ Condiciones</span></legend>
            <label class="mf-checkbox">
                <input type="checkbox" name="pribatutasuna" value="Onartu" required>
                <span><a href="<?php echo esc_url(home_url('/pribatutasun-politika/')); ?>" target="_blank">Pribatutasun Politika</a>
                    irakurri eta onartzen dudala ziurtatzen dut. /
                    He leído y acepto la <a href="<?php echo esc_url(home_url('/pribatutasun-politika/')); ?>" target="_blank">Política de Privacidad</a>.</span>
            </label>
        </fieldset>

        <div class="mf-submit">
            <button type="submit" class="btn btn-accent btn-lg">
                <i class="fas fa-paper-plane"></i> Izena Eman / Enviar Matrícula
            </button>
        </div>
    </form>

    <?php endif; ?>

</div>
</div>

<script>
// ── Error highlighting ────────────────────────────────────────────────────────
(function(){
    var MF_ERROR_FIELDS = <?php echo json_encode(array_keys($error_fields)); ?>;
    var IS_POST = <?php echo ($_SERVER['REQUEST_METHOD'] === 'POST') ? 'true' : 'false'; ?>;

    if (MF_ERROR_FIELDS.length) {
        MF_ERROR_FIELDS.forEach(function(name) {
            var els = document.querySelectorAll('[name="' + name + '"]');
            if (!els.length) return;
            var container = els[0].closest('.mf-field')
                || els[0].closest('.mf-maila-group')
                || els[0].closest('.mf-radio-group')
                || els[0].closest('.mf-checkbox')
                || els[0].closest('fieldset');
            if (container) container.classList.add('mf-field--error');
        });
        setTimeout(function() {
            var first = document.querySelector('.mf-field--error');
            if (first) first.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }, 80);
    }

    // ── localStorage: pre-fill parent/contact data for subsequent children ────
    var PARENT_FIELDS = ['telefono1','telefono2','email','email2','nombre_padres','direccion','poblacion','iban','titularCuenta'];
    var form = document.getElementById('mf-form');
    if (!form) return;

    // Save on submit
    form.addEventListener('submit', function() {
        var data = {};
        PARENT_FIELDS.forEach(function(f) {
            var el = form.elements[f];
            if (el) data[f] = el.tagName === 'SELECT' ? el.value : el.value;
        });
        try { localStorage.setItem('mf_parent_data', JSON.stringify(data)); } catch(e) {}
    });

    // Restore on fresh load (no POST errors)
    if (!IS_POST || !MF_ERROR_FIELDS.length) {
        try {
            var saved = JSON.parse(localStorage.getItem('mf_parent_data') || 'null');
            if (saved && Object.values(saved).some(function(v) { return v; })) {
                var banner = document.createElement('div');
                banner.className = 'mf-restore-banner';
                banner.innerHTML =
                    '<i class="fas fa-history"></i>'
                    + '<span>Zure aurreko datuak gordeta daude. Erabili berriz? / ¿Usar tus datos anteriores?</span>'
                    + '<button type="button" id="mf-restore-yes" class="btn btn-sm">Bai / Sí</button>'
                    + '<button type="button" id="mf-restore-no" class="btn-link">Ez / No</button>';
                form.insertBefore(banner, form.firstChild);

                document.getElementById('mf-restore-yes').addEventListener('click', function() {
                    PARENT_FIELDS.forEach(function(f) {
                        var el = form.elements[f];
                        if (el && saved[f]) {
                            el.value = saved[f];
                            el.dispatchEvent(new Event('change', { bubbles: true }));
                        }
                    });
                    banner.remove();
                });
                document.getElementById('mf-restore-no').addEventListener('click', function() {
                    try { localStorage.removeItem('mf_parent_data'); } catch(e) {}
                    banner.remove();
                });
            }
        } catch(e) {}
    }
})();
</script>

<script>
(function(){
    var REF_YEAR = <?php echo (int) $ref_year; ?>;
    var refDate  = new Date(REF_YEAR, 11, 31); // Dec 31

    var fecha     = document.getElementById('fecha_nto');
    var fieldInst  = document.getElementById('field-instrumento');
    var fieldInst7 = document.getElementById('field-instrumento7');
    var hintEl     = document.getElementById('mf-maila-hint');
    var ageWarn    = document.getElementById('mf-age-warning');
    var submitBtn  = document.querySelector('#mf-form button[type="submit"]');

    var fieldAsigBadge  = document.getElementById('field-asignatura-badge');
    var fieldAsigSelect = document.getElementById('field-asignatura-select');
    var asigBadge       = document.getElementById('asig-badge');
    var asigHidden      = document.getElementById('asignatura-hidden');
    var labelInst       = document.getElementById('label-instrumento');

    // Age groups: 4-5, 6-7, 8-12, 13+
    var groupConfig = {
        nino1: { asig: 'mm',  label: 'Musika &amp; Mugimendua',         inst: false, inst7: false, instLabel: '' },
        nino2: { asig: 'mm',  label: 'Musika &amp; Mugimendua',         inst: false, inst7: true,  instLabel: 'Instrumentua <em>(aukerakoa, plazak badaude / opcional si hay plazas)</em>' },
        nino3: { asig: 'hm',  label: 'Hizkuntza Musikala + Abesbatza', inst: true,  inst7: false, instLabel: 'Instrumentua <span class="req">*</span> <em>(derrigorrezkoa)</em>' },
        nino4: { asig: null,  label: '',                                 inst: true,  inst7: false, instLabel: 'Instrumentua <em>(aukerakoa)</em>' },
    };

    function ageAt31Dec(birthDateStr) {
        var parts = birthDateStr.split('-');
        var birth = new Date(parseInt(parts[0]), parseInt(parts[1])-1, parseInt(parts[2]));
        return Math.floor((refDate - birth) / (365.25 * 24 * 3600 * 1000));
    }

    function setGroup(id) {
        ['nino1','nino2','nino3','nino4'].forEach(function(n){
            var el = document.getElementById(n);
            if (el) el.checked = (n === id);
        });
        var cfg = groupConfig[id];
        fieldInst.style.display  = cfg.inst  ? 'block' : 'none';
        fieldInst7.style.display = cfg.inst7 ? 'block' : 'none';
        if (labelInst && cfg.instLabel) labelInst.innerHTML = cfg.instLabel;
        if (cfg.asig) {
            if (fieldAsigBadge)  fieldAsigBadge.style.display  = 'block';
            if (fieldAsigSelect) fieldAsigSelect.style.display  = 'none';
            if (asigBadge)  asigBadge.innerHTML = cfg.label;
            if (asigHidden) asigHidden.value = cfg.asig;
        } else {
            if (fieldAsigBadge)  fieldAsigBadge.style.display  = 'none';
            if (fieldAsigSelect) fieldAsigSelect.style.display  = 'block';
        }
        if (hintEl) hintEl.style.display = 'none';
    }

    function showAgeWarn(show) {
        if (!ageWarn) return;
        ageWarn.style.display = show ? 'flex' : 'none';
        if (fecha) fecha.style.borderColor = show ? '#e53e3e' : '';
        if (submitBtn) submitBtn.disabled = show;
    }

    function ajustar(birthDateStr) {
        var age = ageAt31Dec(birthDateStr);
        var mailaGroup = document.getElementById('mf-maila-group');
        if (age < 4) { showAgeWarn(true); if (mailaGroup) mailaGroup.style.display = 'none'; return; }
        showAgeWarn(false);
        if (mailaGroup) mailaGroup.style.display = 'block';
        if (age <= 6)       setGroup('nino1');  // 4-6
        else if (age === 7) setGroup('nino2');  // 7
        else if (age <= 12) setGroup('nino3');  // 8-12
        else                setGroup('nino4');  // 13+
    }

    if (fecha) {
        fecha.addEventListener('change', function() {
            if (this.value) {
                sessionStorage.setItem('mf_fecha_nto', this.value);
                ajustar(this.value);
            }
        });
    }

    window.addEventListener('pageshow', function(e) {
        var savedDate = sessionStorage.getItem('mf_fecha_nto');
        if (fecha && !fecha.value && savedDate) fecha.value = savedDate;
        if (fecha && fecha.value) ajustar(fecha.value);
    });

    // Age group radios are read-only — set by birth date only

    // ── IBAN formatting & validation ──────────────────────────────────────────
    var ibanInput = document.getElementById('iban');
    var ibanMsg   = document.getElementById('iban-msg');

    function ibanMod97(iban) {
        var rearranged = iban.slice(4) + iban.slice(0, 4);
        var numeric = '';
        for (var i = 0; i < rearranged.length; i++) {
            var c = rearranged.charCodeAt(i);
            numeric += (c >= 65 && c <= 90) ? (c - 55).toString() : rearranged[i];
        }
        var remainder = 0;
        for (var j = 0; j < numeric.length; j++) {
            remainder = (remainder * 10 + parseInt(numeric[j])) % 97;
        }
        return remainder === 1;
    }

    function formatIban(raw) {
        var clean = raw.toUpperCase().replace(/[^A-Z0-9]/g, '');
        return clean.replace(/(.{4})(?=.)/g, '$1 ').trim();
    }

    function validateIban(formatted) {
        var clean = formatted.replace(/\s/g, '');
        if (!/^ES\d{22}$/.test(clean)) return false;
        return ibanMod97(clean);
    }

    if (ibanInput) {
        ibanInput.addEventListener('input', function() {
            var pos = this.selectionStart;
            var old = this.value;
            this.value = formatIban(this.value);
            if (this.value.length > old.length) pos++;
            this.setSelectionRange(pos, pos);
            ibanMsg.style.display = 'none';
        });
        ibanInput.addEventListener('blur', function() {
            var val = this.value.trim();
            if (!val) { ibanMsg.style.display = 'none'; return; }
            var clean = val.replace(/\s/g, '');
            if (!/^ES/i.test(clean)) {
                ibanMsg.textContent = '⚠ IBAN espainiarrak ES-rekin hasi behar du';
                ibanMsg.style.color = '#c0392b'; ibanMsg.style.display = 'block';
            } else if (!/^ES\d{22}$/.test(clean)) {
                ibanMsg.textContent = '⚠ Formatua: ES00 0000 0000 0000 0000 0000 (24 digitu)';
                ibanMsg.style.color = '#c0392b'; ibanMsg.style.display = 'block';
            } else if (!validateIban(val)) {
                ibanMsg.textContent = '⚠ IBAN ez da baliozkoa (kontrol digitua)';
                ibanMsg.style.color = '#c0392b'; ibanMsg.style.display = 'block';
            } else {
                ibanMsg.textContent = '✓ IBAN zuzena';
                ibanMsg.style.color = '#166534'; ibanMsg.style.display = 'block';
            }
        });
    }

    var form = document.getElementById('mf-form');
    if (form) {
        form.addEventListener('submit', function(e) {
            if (!fecha || !fecha.value) {
                e.preventDefault();
                fecha.style.border = '2px solid #e53e3e';
                fecha.focus();
                alert('Jaiotze data beharrezkoa da.\nLa fecha de nacimiento es obligatoria.');
                return;
            }
            var age = ageAt31Dec(fecha.value);
            if (age < 4) { e.preventDefault(); showAgeWarn(true); fecha.focus(); return; }
            if (ibanInput && ibanInput.value.trim()) {
                if (!validateIban(ibanInput.value.trim())) {
                    e.preventDefault();
                    ibanMsg.textContent = '⚠ IBAN ez da baliozkoa';
                    ibanMsg.style.color = '#c0392b'; ibanMsg.style.display = 'block';
                    ibanInput.focus();
                }
            }
        });
    }
})();
</script>

<?php get_footer(); ?>
