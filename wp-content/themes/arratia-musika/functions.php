<?php
/**
 * Arratiako Musika Eskola — Theme Functions
 */


// ─── Theme setup ──────────────────────────────────────────────────────────────
function arratia_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption']);
    add_theme_support('custom-logo', [
        'height'      => 120,
        'width'       => 300,
        'flex-height' => true,
        'flex-width'  => true,
    ]);
    add_theme_support('align-wide');
    add_theme_support('wp-block-styles');
    add_theme_support('responsive-embeds');

    register_nav_menus([
        'primary' => 'Menú principal',
        'footer'  => 'Menú pie de página',
    ]);
}
add_action('after_setup_theme', 'arratia_setup');

// ─── Enqueue assets ───────────────────────────────────────────────────────────
function arratia_scripts() {
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', [], '6.4.0');
    wp_enqueue_style('arratia-style', get_stylesheet_uri(), ['font-awesome'], filemtime(get_stylesheet_directory() . '/style.css'));
    wp_enqueue_script('arratia-main', get_template_directory_uri() . '/assets/js/main.js', [], filemtime(get_stylesheet_directory() . '/assets/js/main.js'), true);
}
add_action('wp_enqueue_scripts', 'arratia_scripts');

// ─── Widget areas ─────────────────────────────────────────────────────────────
function arratia_widgets_init() {
    register_sidebar([
        'name'          => 'Feed de Instagram',
        'id'            => 'sidebar-instagram',
        'description'   => 'Feed de Instagram en la portada',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ]);
}
add_action('widgets_init', 'arratia_widgets_init');

// ─── Meta box: enlace a Google Fotos / vídeo ──────────────────────────────────
function arratia_add_meta_boxes() {
    add_meta_box(
        'arratia_google_photos',
        '📸 Argazkiak eta Bideoa (Google Fotos, YouTube, Drive...)',
        'arratia_google_photos_cb',
        'post', 'normal', 'high'
    );
}
add_action('add_meta_boxes', 'arratia_add_meta_boxes');

function arratia_google_photos_cb($post) {
    wp_nonce_field('arratia_gp_nonce', 'arratia_nonce');
    $photos = get_post_meta($post->ID, '_google_photos_url', true);
    $video  = get_post_meta($post->ID, '_video_url', true);
    $s = 'width:100%;padding:8px 12px;border:1px solid #ddd;border-radius:6px;font-size:14px;margin-bottom:6px;';
    echo '<table style="width:100%;border-collapse:collapse;">';
    echo '<tr><td style="padding:6px 12px 6px 0;width:90px;font-weight:600;">📷 Argazkiak</td>';
    echo '<td><input type="url" name="google_photos_url" value="' . esc_attr($photos) . '" style="' . $s . '" placeholder="https://photos.google.com/..." /></td></tr>';
    echo '<tr><td style="padding:6px 12px 6px 0;font-weight:600;">🎬 Bideoa</td>';
    echo '<td><input type="url" name="video_url" value="' . esc_attr($video) . '" style="' . $s . '" placeholder="YouTube, Vimeo, Google Drive, Google Photos bideo..." /></td></tr>';
    echo '</table>';
    echo '<p style="color:#888;font-size:11px;margin:4px 0 0;">YouTube, Vimeo, Google Drive, Google Photos eta beste bideo formatu gehienak onartzen dira.</p>';
}

function arratia_save_meta($post_id) {
    if (!isset($_POST['arratia_nonce']) || !wp_verify_nonce($_POST['arratia_nonce'], 'arratia_gp_nonce')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;
    if (isset($_POST['google_photos_url'])) {
        update_post_meta($post_id, '_google_photos_url', esc_url_raw($_POST['google_photos_url']));
    }
    if (isset($_POST['video_url'])) {
        update_post_meta($post_id, '_video_url', esc_url_raw($_POST['video_url']));
    }
}
add_action('save_post', 'arratia_save_meta');

// ─── Custom Post Type: Irakaslea ──────────────────────────────────────────────
function arratia_register_irakaslea() {
    register_post_type('irakaslea', [
        'labels' => [
            'name'          => 'Irakasleak',
            'singular_name' => 'Irakaslea',
            'add_new_item'  => 'Irakasle berria',
            'edit_item'     => 'Irakaslea editatu',
            'all_items'     => 'Irakasle guztiak',
            'menu_name'     => 'Irakasleak',
        ],
        'public'        => true,
        'show_in_menu'  => true,
        'menu_icon'     => 'dashicons-groups',
        'menu_position' => 3,
        'supports'      => ['title', 'thumbnail', 'page-attributes'],
        'has_archive'   => false,
        'rewrite'       => ['slug' => 'irakaslea'],
    ]);
}
add_action('init', 'arratia_register_irakaslea');

function arratia_irakaslea_meta_box() {
    add_meta_box('irakaslea_info', 'Informazioa', 'arratia_irakaslea_meta_cb', 'irakaslea', 'normal', 'high');
}
add_action('add_meta_boxes', 'arratia_irakaslea_meta_box');

function arratia_irakaslea_meta_cb($post) {
    wp_nonce_field('arratia_irakaslea_nonce', 'irakaslea_nonce');
    $raw_ikasgaiak = get_post_meta($post->ID, '_irakaslea_ikasgaiak', true);
    $ikasgaiak     = str_replace('\n', "\n", $raw_ikasgaiak);
    $rola          = get_post_meta($post->ID, '_irakaslea_rola', true) ?: 'irakaslea';
    $kargua        = get_post_meta($post->ID, '_irakaslea_kargua', true);
    $argazkia      = get_post_meta($post->ID, '_irakaslea_argazkia_url', true);
    $zuz_order     = get_post_meta($post->ID, '_irakaslea_zuz_order', true);
    $td1 = 'padding:8px 12px 8px 0;width:150px;font-weight:600;vertical-align:top;padding-top:10px;';
    $td2 = 'padding:6px 0;';
    $inp = 'width:100%;padding:7px 10px;border:1px solid #ddd;border-radius:4px;font-size:13px;';
    echo '<table style="width:100%;border-collapse:collapse;margin-top:4px;">';
    echo '<tr><td style="' . $td1 . '">Ikasgaiak</td>';
    echo '<td style="' . $td2 . '"><textarea name="irakaslea_ikasgaiak" rows="4" style="' . $inp . '"
        placeholder="Bat per lerro&#10;Pianoa&#10;Kamara">' . esc_textarea($ikasgaiak) . '</textarea>';
    echo '<p style="color:#888;font-size:11px;margin:3px 0 0;">Una asignatura por línea.</p></td></tr>';
    echo '<tr><td style="' . $td1 . '">Kargua <small style="font-weight:400;">(Zuzendaritza)</small></td>';
    echo '<td style="' . $td2 . '"><input type="text" name="irakaslea_kargua" value="' . esc_attr($kargua) . '" style="' . $inp . '" placeholder="Zuzendaria / Idazkaria..." /></td></tr>';
    echo '<tr><td style="' . $td1 . '">Argazkia <small style="font-weight:400;">(ruta relativa)</small></td>';
    echo '<td style="' . $td2 . '"><input type="text" name="irakaslea_argazkia_url" value="' . esc_attr($argazkia) . '" style="' . $inp . '" placeholder="2024/06/nombre-foto.jpg" /></td></tr>';
    echo '<tr><td style="' . $td1 . '">Ordena <small style="font-weight:400;">(zuzendaritza)</small></td>';
    echo '<td style="' . $td2 . '"><input type="number" name="irakaslea_zuz_order" value="' . esc_attr($zuz_order) . '" style="width:80px;padding:7px 10px;border:1px solid #ddd;border-radius:4px;font-size:13px;" placeholder="1" /></td></tr>';
    echo '<tr><td style="' . $td1 . '">Rola</td>';
    echo '<td style="' . $td2 . '"><select name="irakaslea_rola" style="padding:7px 10px;border:1px solid #ddd;border-radius:4px;">';
    foreach (['irakaslea' => 'Irakaslea', 'zuzendaritza' => 'Zuzendaritza / Administrazioa', 'biak' => 'Biak (Irakaslea + Zuzendaritza)'] as $val => $label) {
        echo '<option value="' . $val . '"' . selected($rola, $val, false) . '>' . $label . '</option>';
    }
    echo '</select></td></tr>';
    echo '</table>';
}

function arratia_save_irakaslea_meta($post_id) {
    if (!isset($_POST['irakaslea_nonce']) || !wp_verify_nonce($_POST['irakaslea_nonce'], 'arratia_irakaslea_nonce')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;
    if (isset($_POST['irakaslea_ikasgaiak'])) update_post_meta($post_id, '_irakaslea_ikasgaiak', wp_unslash($_POST['irakaslea_ikasgaiak']));
    if (isset($_POST['irakaslea_rola']))     update_post_meta($post_id, '_irakaslea_rola',        sanitize_text_field($_POST['irakaslea_rola']));
    if (isset($_POST['irakaslea_kargua']))   update_post_meta($post_id, '_irakaslea_kargua',      sanitize_text_field($_POST['irakaslea_kargua']));
    if (isset($_POST['irakaslea_argazkia_url'])) update_post_meta($post_id, '_irakaslea_argazkia_url', sanitize_text_field($_POST['irakaslea_argazkia_url']));
    if (isset($_POST['irakaslea_zuz_order'])) update_post_meta($post_id, '_irakaslea_zuz_order', intval($_POST['irakaslea_zuz_order']));
}
add_action('save_post_irakaslea', 'arratia_save_irakaslea_meta');

// ─── Custom Post Type: Ikasgaiak ──────────────────────────────────────────────
function arratia_register_cpt() {
    register_post_type('ikasgai', [
        'labels' => [
            'name'          => 'Ikasgaiak',
            'singular_name' => 'Ikasgaia',
            'add_new_item'  => 'Ikasgai berria / Nueva asignatura',
            'edit_item'     => 'Ikasgaia editatu / Editar asignatura',
            'all_items'     => 'Ikasgai guztiak / Todas las asignaturas',
        ],
        'public'        => true,
        'show_in_menu'  => true,
        'menu_icon'     => 'dashicons-music',
        'menu_position' => 5,
        'supports'      => ['title', 'thumbnail'],
        'has_archive'   => false,
        'rewrite'       => ['slug' => 'ikasgaiak'],
        'show_in_rest'  => false,
    ]);
}
add_action('init', 'arratia_register_cpt');

function arratia_ikasgai_meta_box() {
    add_meta_box('ikasgai_info', '🎵 Ikasgaiaren Informazioa / Datos de la asignatura',
        'arratia_ikasgai_meta_cb', 'ikasgai', 'normal', 'high');
}
add_action('add_meta_boxes', 'arratia_ikasgai_meta_box');

function arratia_ikasgai_meta_cb($post) {
    wp_nonce_field('arratia_ikasgai_nonce', 'ikasgai_nonce');
    $irakaslea    = get_post_meta($post->ID, '_ikasgai_irakaslea', true);
    $kategoria    = get_post_meta($post->ID, '_ikasgai_kategoria', true);
    $ordena       = get_post_meta($post->ID, '_ikasgai_ordena', true);
    $azalpena     = get_post_meta($post->ID, '_ikasgai_azalpena', true);
    $td1 = 'padding:8px 12px 8px 0;width:160px;font-weight:600;vertical-align:top;padding-top:10px;';
    $td2 = 'padding:6px 0;';
    $inp = 'width:100%;padding:7px 10px;border:1px solid #ddd;border-radius:4px;font-size:13px;';
    $sel = 'padding:7px 10px;border:1px solid #ddd;border-radius:4px;font-size:13px;width:100%;';
    $kategoriak = [
        'Taldean Teoriko-Praktikoa'                      => 'Taldean Teoriko-Praktikoa',
        'Taldean'                                        => 'Taldean',
        'Bakarka - Hari igurtzizko instrumentuak'        => 'Bakarka – Hari igurtzizko instrumentuak',
        'Bakarka - Zurezko haize-instrumentuak'          => 'Bakarka – Zurezko haize-instrumentuak',
        'Bakarka - Metalezko haize-instrumentuak'        => 'Bakarka – Metalezko haize-instrumentuak',
        'Bakarka - Tekla-tresnak'                        => 'Bakarka – Tekla-tresnak',
        'Bakarka - Perkusio-tresnak'                     => 'Bakarka – Perkusio-tresnak',
        'Bakarka - Hari pultsatuko instrumentuak'        => 'Bakarka – Hari pultsatuko instrumentuak',
        'Bakarka - Euskal instrumentu tradizionalak'     => 'Bakarka – Euskal instrumentu tradizionalak',
        'Bakarka - Kantuko espezialitatea'               => 'Bakarka – Kantuko espezialitatea',
    ];
    echo '<table style="width:100%;border-collapse:collapse;margin-top:4px;">';
    echo '<tr><td style="' . $td1 . '">Azalpena<br><small style="font-weight:400;color:#888;">Adib: (4-7 urte)</small></td>';
    echo '<td style="' . $td2 . '"><input type="text" name="ikasgai_azalpena" value="' . esc_attr($azalpena) . '" style="' . $inp . '" placeholder="(4-7 urte)"></td></tr>';
    echo '<tr><td style="' . $td1 . '">Irakasleak<br><small style="font-weight:400;color:#888;">Bat per lerro</small></td>';
    echo '<td style="' . $td2 . '"><textarea name="ikasgai_irakaslea" rows="3" style="' . $inp . '"
        placeholder="Irakaslea&#10;Bigarren irakaslea">' . esc_textarea($irakaslea) . '</textarea></td></tr>';
    echo '<tr><td style="' . $td1 . '">Kategoria <span style="color:red">*</span></td>';
    echo '<td style="' . $td2 . '"><select name="ikasgai_kategoria" style="' . $sel . '">';
    echo '<option value="">— Aukeratu —</option>';
    foreach ($kategoriak as $val => $lbl) {
        echo '<option value="' . esc_attr($val) . '"' . selected($kategoria, $val, false) . '>' . esc_html($lbl) . '</option>';
    }
    echo '</select></td></tr>';
    echo '<tr><td style="' . $td1 . '">Ordena<br><small style="font-weight:400;color:#888;">Txikiagoa = lehenago</small></td>';
    echo '<td style="' . $td2 . '"><input type="number" name="ikasgai_ordena" value="' . esc_attr($ordena ?: 10) . '"
        style="width:80px;padding:7px 10px;border:1px solid #ddd;border-radius:4px;" min="1" /></td></tr>';
    $galeria = get_post_meta($post->ID, '_ikasgai_galeria', true);
    echo '<tr><td style="' . $td1 . '">Galeria IDs<br><small style="font-weight:400;color:#888;">Slider-erako argazkiak</small></td>';
    echo '<td style="' . $td2 . '">';
    echo '<input type="text" id="ikasgai_galeria" name="ikasgai_galeria" value="' . esc_attr($galeria) . '" style="' . $inp . '" placeholder="123,456,789">';
    echo '<p style="color:#888;font-size:11px;margin:3px 0 4px;">Argazkien IDak koma bidez bereizita. Media → Biblioteca-n ID ikus dezakezu URLan.</p>';
    echo '<button type="button" class="button" onclick="arratiaOpenGaleria()">+ Argazkiak aukeratu / Seleccionar fotos</button>';
    echo '</td></tr>';
    echo '</table>';
    echo '<p style="color:#888;font-size:12px;margin-top:8px;">⚠️ Argazki bakarra: "Irudia nabarmendua". Galeria: goiko eremua erabili.</p>';
    ?>
    <script>
    function arratiaOpenGaleria() {
        var frame = wp.media({title: 'Galeria aukeratu', button: {text: 'Gehitu galeriara'}, multiple: true});
        frame.on('select', function() {
            var ids = frame.state().get('selection').map(function(a){ return a.id; }).join(',');
            document.getElementById('ikasgai_galeria').value = ids;
        });
        frame.open();
    }
    </script>
    <?php
}

function arratia_save_ikasgai_meta($post_id) {
    if (!isset($_POST['ikasgai_nonce']) || !wp_verify_nonce($_POST['ikasgai_nonce'], 'arratia_ikasgai_nonce')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;
    if (isset($_POST['ikasgai_azalpena']))  update_post_meta($post_id, '_ikasgai_azalpena',  sanitize_text_field($_POST['ikasgai_azalpena']));
    if (isset($_POST['ikasgai_irakaslea'])) update_post_meta($post_id, '_ikasgai_irakaslea', wp_unslash($_POST['ikasgai_irakaslea']));
    if (isset($_POST['ikasgai_kategoria'])) update_post_meta($post_id, '_ikasgai_kategoria', sanitize_text_field($_POST['ikasgai_kategoria']));
    if (isset($_POST['ikasgai_ordena']))    update_post_meta($post_id, '_ikasgai_ordena',    intval($_POST['ikasgai_ordena']));
    if (isset($_POST['ikasgai_galeria']))   update_post_meta($post_id, '_ikasgai_galeria',   sanitize_text_field($_POST['ikasgai_galeria']));
}
add_action('save_post_ikasgai', 'arratia_save_ikasgai_meta');

// ─── Custom Post Type: Ekintza ────────────────────────────────────────────────
function arratia_register_ekintza() {
    register_post_type('ekintza', [
        'labels' => [
            'name'          => 'Ekintzak',
            'singular_name' => 'Ekintza',
            'add_new_item'  => 'Ekintza berria',
            'edit_item'     => 'Ekintza editatu',
            'all_items'     => 'Ekintza guztiak',
            'menu_name'     => 'Ekintzak',
        ],
        'public'        => true,
        'show_in_menu'  => true,
        'menu_icon'     => 'dashicons-calendar-alt',
        'menu_position' => 4,
        'supports'      => ['title', 'thumbnail', 'editor'],
        'has_archive'   => false,
        'rewrite'       => ['slug' => 'ekintza'],
    ]);

    register_taxonomy('ikasurtea', 'ekintza', [
        'labels' => [
            'name'          => 'Ikasturtea',
            'singular_name' => 'Ikasturtea',
            'add_new_item'  => 'Ikasturtea berria',
        ],
        'hierarchical'      => true,
        'public'            => true,
        'show_admin_column' => true,
        'rewrite'           => ['slug' => 'ikasturtea'],
    ]);

    register_taxonomy('hilabetea', 'ekintza', [
        'labels' => [
            'name'          => 'Hilabetea',
            'singular_name' => 'Hilabetea',
            'add_new_item'  => 'Hilabetea berria',
            'all_items'     => 'Hilabete guztiak',
        ],
        'hierarchical'      => true,
        'public'            => true,
        'show_admin_column' => true,
        'rewrite'           => ['slug' => 'hilabetea'],
    ]);
}
add_action('init', 'arratia_register_ekintza');

function arratia_ekintza_meta_boxes() {
    add_meta_box('ekintza_links', '📸 Argazkiak eta Bideoa', 'arratia_ekintza_links_cb', 'ekintza', 'normal', 'high');
}
add_action('add_meta_boxes', 'arratia_ekintza_meta_boxes');

function arratia_ekintza_links_cb($post) {
    wp_nonce_field('arratia_ekintza_nonce', 'ekintza_nonce');
    $argazkiak = get_post_meta($post->ID, '_ekintza_argazkiak', true);
    $bideoa    = get_post_meta($post->ID, '_ekintza_bideoa', true);
    echo '<table style="width:100%;border-collapse:collapse;">';
    echo '<tr><td style="padding:8px 12px 8px 0;width:120px;font-weight:600;">📷 Argazkiak</td>';
    echo '<td><input type="url" name="ekintza_argazkiak" value="' . esc_attr($argazkiak) . '"
        style="width:100%;padding:7px 10px;border:1px solid #ddd;border-radius:4px;"
        placeholder="https://photos.google.com/..." /></td></tr>';
    echo '<tr><td style="padding:8px 12px 8px 0;font-weight:600;">🎬 Bideoa</td>';
    echo '<td><input type="url" name="ekintza_bideoa" value="' . esc_attr($bideoa) . '"
        style="width:100%;padding:7px 10px;border:1px solid #ddd;border-radius:4px;"
        placeholder="YouTube, Vimeo, Google Drive, Google Photos..." /></td></tr>';
    echo '</table>';
    echo '<p style="color:#888;font-size:12px;margin-top:8px;">Irudia: "Irudia nabarmendua" atalean igo. Bideo formatuak: YouTube, Vimeo, Google Drive, .mp4...</p>';
}

function arratia_save_ekintza_meta($post_id) {
    if (!isset($_POST['ekintza_nonce']) || !wp_verify_nonce($_POST['ekintza_nonce'], 'arratia_ekintza_nonce')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;
    if (isset($_POST['ekintza_argazkiak'])) update_post_meta($post_id, '_ekintza_argazkiak', esc_url_raw($_POST['ekintza_argazkiak']));
    if (isset($_POST['ekintza_bideoa']))    update_post_meta($post_id, '_ekintza_bideoa',    esc_url_raw($_POST['ekintza_bideoa']));
}
add_action('save_post_ekintza', 'arratia_save_ekintza_meta');

// ─── Create matriculas table ─────────────────────────────────────────────────
function arratia_create_matriculas_table() {
    global $wpdb;
    $table   = $wpdb->prefix . 'arratia_matriculas';
    $charset = $wpdb->get_charset_collate();
    if ($wpdb->get_var("SHOW TABLES LIKE '$table'") !== $table) {
        $wpdb->query("CREATE TABLE $table (
            id            INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            ikasturtea    VARCHAR(20)  NOT NULL DEFAULT '',
            izena         VARCHAR(100) NOT NULL DEFAULT '',
            abizena1      VARCHAR(100) NOT NULL DEFAULT '',
            abizena2      VARCHAR(100) NOT NULL DEFAULT '',
            helbidea      VARCHAR(200) NOT NULL DEFAULT '',
            udalerria     VARCHAR(100) NOT NULL DEFAULT '',
            jaiotze_data  DATE         DEFAULT NULL,
            telefono1     VARCHAR(20)  NOT NULL DEFAULT '',
            telefono2     VARCHAR(20)  NOT NULL DEFAULT '',
            email         VARCHAR(150) NOT NULL DEFAULT '',
            email2        VARCHAR(150) NOT NULL DEFAULT '',
            gurasoak      VARCHAR(200) NOT NULL DEFAULT '',
            iban          VARCHAR(40)  NOT NULL DEFAULT '',
            titular       VARCHAR(150) NOT NULL DEFAULT '',
            maila         VARCHAR(50)  NOT NULL DEFAULT '',
            ikasgaia      VARCHAR(100) NOT NULL DEFAULT '',
            instrumentua  VARCHAR(100) NOT NULL DEFAULT '',
            instrumento7  VARCHAR(100) NOT NULL DEFAULT '',
            ikasle_mota   VARCHAR(50)  NOT NULL DEFAULT '',
            argazkiak     VARCHAR(50)  NOT NULL DEFAULT '',
            baldintzak    VARCHAR(10)  NOT NULL DEFAULT '',
            egoera        VARCHAR(50)  NOT NULL DEFAULT 'jasota',
            fecha         TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP
        ) $charset");
    }
}
add_action('init', 'arratia_create_matriculas_table');

// ─── Admin: Matrikulak ────────────────────────────────────────────────────────
function arratia_matriculas_menu() {
    add_menu_page('Matrikulak', 'Matrikulak', 'manage_options',
        'arratia-matrikulak', 'arratia_matriculas_page', 'dashicons-clipboard', 6);
}
add_action('admin_menu', 'arratia_matriculas_menu');

function arratia_matriculas_page() {
    global $wpdb;
    $table = $wpdb->prefix . 'arratia_matriculas';

    if (isset($_GET['egoera'], $_GET['id']) && check_admin_referer('arratia_mat_action')) {
        $wpdb->update($table, ['egoera' => sanitize_text_field($_GET['egoera'])], ['id' => intval($_GET['id'])]);
        echo '<div class="notice notice-success"><p>Egoera eguneratu da.</p></div>';
    }
    if (isset($_GET['ezabatu'], $_GET['id']) && check_admin_referer('arratia_mat_action')) {
        $wpdb->delete($table, ['id' => intval($_GET['id'])]);
        echo '<div class="notice notice-success"><p>Ezabatu da.</p></div>';
    }

    $now_mo = (int)(new DateTime())->format('n');
    $now_yr = (int)(new DateTime())->format('Y');
    $ref_yr = ($now_mo >= 3) ? $now_yr : $now_yr - 1;
    $def_ikasturtea = $ref_yr . '/' . ($ref_yr + 1);
    $ikasturtea = sanitize_text_field($_GET['ikasturtea'] ?? $def_ikasturtea);
    $rows = $wpdb->get_results($wpdb->prepare(
        "SELECT * FROM $table WHERE ikasturtea = %s ORDER BY fecha DESC", $ikasturtea
    ));

    $total = count($rows);
    echo '<div class="wrap">';
    echo '<h1 style="display:flex;align-items:center;gap:12px;">🎵 Matrikulak <span style="font-size:14px;font-weight:400;color:#666;">' . esc_html($ikasturtea) . '</span></h1>';
    echo '<div style="display:flex;gap:16px;margin:16px 0;">';
    foreach ([['Guztira','#007B81',$total]] as [$lbl,$col,$n]):
        echo '<div style="background:'.$col.';color:#fff;padding:12px 20px;border-radius:8px;min-width:100px;text-align:center;">
            <div style="font-size:28px;font-weight:800;">'.$n.'</div>
            <div style="font-size:12px;opacity:.85;">'.$lbl.'</div></div>';
    endforeach;
    echo '</div>';

    $export_url = add_query_arg(['arratia_export_csv' => 1, 'ikasturtea' => $ikasturtea, '_wpnonce' => wp_create_nonce('arratia_csv')], admin_url('admin.php?page=arratia-matrikulak'));
    echo '<p><a href="' . esc_url($export_url) . '" class="button">⬇ CSV deskargatu</a></p>';

    if (!$rows) { echo '<p>Ez dago matrikulazioa oraindik.</p></div>'; return; }

    $nonce_url = wp_nonce_url('', 'arratia_mat_action');
    parse_str(parse_url($nonce_url, PHP_URL_QUERY), $nonce_parts);
    $n = $nonce_parts['_wpnonce'];

    echo '<style>
        .mat-table{width:100%;border-collapse:collapse;background:#fff;border-radius:8px;overflow:hidden;box-shadow:0 1px 4px rgba(0,0,0,.08);}
        .mat-table th{background:#111;color:#007B81;font-size:11px;text-transform:uppercase;letter-spacing:.05em;padding:10px 12px;text-align:left;}
        .mat-table td{padding:9px 12px;border-bottom:1px solid #f0f0f0;font-size:13px;vertical-align:top;}
        .mat-table tr:hover td{background:#fafafa;}
        .mat-badge{display:inline-block;padding:2px 8px;border-radius:50px;font-size:11px;font-weight:700;}
        .mat-jasota{background:#dbeafe;color:#1d4ed8;}
        .mat-onartua{background:#dcfce7;color:#166534;}
        .mat-ukatua{background:#fee2e2;color:#b91c1c;}
    </style>';

    echo '<table class="mat-table"><thead><tr>
        <th>#</th><th>Data</th><th>Izena</th><th>Maila</th><th>Ikasgaia</th><th>Emaila</th><th>Telefonoa</th><th>IBAN</th><th>Egoera</th><th>Ekintzak</th>
    </tr></thead><tbody>';

    foreach ($rows as $r) {
        $badge_class = 'mat-' . esc_attr($r->egoera);
        $base = admin_url('admin.php?page=arratia-matrikulak&ikasturtea=' . urlencode($ikasturtea) . '&id=' . $r->id . '&_wpnonce=' . $n);
        echo '<tr>';
        echo '<td>' . $r->id . '</td>';
        echo '<td style="white-space:nowrap;">' . esc_html(date('d/m/y', strtotime($r->fecha))) . '</td>';
        echo '<td><strong>' . esc_html($r->izena . ' ' . $r->abizena1) . '</strong><br><small style="color:#888;">' . esc_html($r->jaiotze_data ?? '') . '</small></td>';
        echo '<td>' . esc_html($r->maila) . '</td>';
        echo '<td>' . esc_html($r->ikasgaia) . ($r->instrumentua ? '<br><small>' . esc_html($r->instrumentua) . '</small>' : '') . '</td>';
        echo '<td><a href="mailto:' . esc_attr($r->email) . '">' . esc_html($r->email) . '</a></td>';
        echo '<td>' . esc_html($r->telefono1) . '</td>';
        echo '<td style="font-size:11px;">' . esc_html($r->iban) . '<br><small>' . esc_html($r->titular) . '</small></td>';
        echo '<td><span class="mat-badge ' . $badge_class . '">' . esc_html($r->egoera) . '</span></td>';
        echo '<td style="white-space:nowrap;">
            <a href="' . esc_url(add_query_arg('egoera','onartua',$base)) . '" style="color:green;text-decoration:none;" title="Onartu">✓</a>
            <a href="' . esc_url(add_query_arg('egoera','ukatua',$base)) . '" style="color:#c00;text-decoration:none;margin:0 6px;" title="Ukatu">✗</a>
            <a href="' . esc_url(add_query_arg('ezabatu',1,$base)) . '" style="color:#888;text-decoration:none;" title="Ezabatu" onclick="return confirm(\'Ezabatu?\')">🗑</a>
        </td>';
        echo '</tr>';
    }
    echo '</tbody></table></div>';
}

// CSV export
function arratia_matriculas_csv() {
    if (!isset($_GET['arratia_export_csv']) || !current_user_can('manage_options')) return;
    if (!wp_verify_nonce($_GET['_wpnonce'] ?? '', 'arratia_csv')) return;
    global $wpdb;
    $table = $wpdb->prefix . 'arratia_matriculas';
    $now_mo = (int)(new DateTime())->format('n');
    $now_yr = (int)(new DateTime())->format('Y');
    $ref_yr = ($now_mo >= 3) ? $now_yr : $now_yr - 1;
    $ikasturtea = sanitize_text_field($_GET['ikasturtea'] ?? ($ref_yr . '/' . ($ref_yr + 1)));
    $rows = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table WHERE ikasturtea=%s ORDER BY fecha DESC", $ikasturtea), ARRAY_A);
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="matrikulak-' . $ikasturtea . '.csv"');
    $out = fopen('php://output', 'w');
    fprintf($out, chr(0xEF).chr(0xBB).chr(0xBF));
    if ($rows) fputcsv($out, array_keys($rows[0]), ';');
    foreach ($rows as $r) fputcsv($out, $r, ';');
    fclose($out);
    exit;
}
add_action('admin_init', 'arratia_matriculas_csv');

// ─── Admin: Ezarpenak ─────────────────────────────────────────────────────────
function arratia_settings_menu() {
    add_submenu_page('arratia-matrikulak', 'Arratia Ezarpenak', 'Ezarpenak / Ajustes',
        'manage_options', 'arratia-ezarpenak', 'arratia_settings_page_cb');
}
add_action('admin_menu', 'arratia_settings_menu');

// ── Matrikula: helper functions for editable lists ───────────────────────────
function arratia_get_instrumentuak() {
    $default = "Akordeoia\nArmonia Modernoa\nBaju elektrikoa\nBateria\nBiolina\nGitarra\nGitarra elektrikoa\nKlarinetea\nPanderoa\nPianoa\nSaxofoia\nTalde Instrumentala\nKantu Bakarlaria / Ahotsa (11+)\nTrikirtixa\nTronboia\nTronpeta\nTxalaparta\nTxistu\nZeharkako Txirula";
    $raw = get_option('arratia_instrumentuak', $default);
    return array_values(array_filter(array_map('trim', explode("\n", $raw))));
}
function arratia_get_instrumentuak7() {
    $default = "Akordeoia\nBaju elektrikoa\nBateria\nBiolina\nGitarra\nGitarra elektrikoa\nKlarinetea\nPianoa\nSaxofoia\nTrikirtixa\nTronboia\nTronpeta\nTxalaparta\nTxistu\nZeharkako Txirula";
    $raw = get_option('arratia_instrumentuak7', $default);
    return array_values(array_filter(array_map('trim', explode("\n", $raw))));
}
function arratia_get_asignaturak() {
    $default = "inst|Tresna bakarrik / Solo instrumento\nhm|Hizkuntza Musikala + Abesbatza\nhm16|Hizkuntza Musikala (16 urtetik gora)\nam|Armonia Modernoa (16 urtetik gora)";
    $raw = get_option('arratia_asignaturak', $default);
    $result = [];
    foreach (array_filter(array_map('trim', explode("\n", $raw))) as $line) {
        $parts = explode('|', $line, 2);
        if (count($parts) === 2) $result[trim($parts[0])] = trim($parts[1]);
    }
    return $result;
}
// ─────────────────────────────────────────────────────────────────────────────

function arratia_settings_page_cb() {
    if (!current_user_can('manage_options')) return;
    if (isset($_POST['arratia_save_settings']) && check_admin_referer('arratia_ezarpenak')) {
        update_option('arratia_matrikula_open', isset($_POST['matrikula_open']) ? '1' : '');
        update_option('arratia_instrumentuak',  sanitize_textarea_field($_POST['instrumentuak']  ?? ''));
        update_option('arratia_instrumentuak7', sanitize_textarea_field($_POST['instrumentuak7'] ?? ''));
        update_option('arratia_asignaturak',    sanitize_textarea_field($_POST['asignaturak']    ?? ''));
        update_option('arratia_front_video_1',      esc_url_raw($_POST['front_video_1']       ?? ''));
        update_option('arratia_front_video_2',      esc_url_raw($_POST['front_video_2']       ?? ''));
        update_option('arratia_front_video_1_desc', sanitize_text_field($_POST['front_video_1_desc'] ?? ''));
        update_option('arratia_front_video_2_desc', sanitize_text_field($_POST['front_video_2_desc'] ?? ''));
        update_option('arratia_front_video_1_img',  esc_url_raw($_POST['front_video_1_img']   ?? ''));
        update_option('arratia_front_video_2_img',  esc_url_raw($_POST['front_video_2_img']   ?? ''));
        update_option('arratia_antolaketa_img',          esc_url_raw($_POST['antolaketa_img']          ?? ''));
        update_option('arratia_antolaketa_pdf',          esc_url_raw($_POST['antolaketa_pdf']          ?? ''));
        update_option('arratia_egutegia_img',            esc_url_raw($_POST['egutegia_img']            ?? ''));
        update_option('arratia_egutegia_pdf',            esc_url_raw($_POST['egutegia_pdf']            ?? ''));
        update_option('arratia_front_ig_img_tresnak',   esc_url_raw($_POST['front_ig_img_tresnak']   ?? ''));
        update_option('arratia_front_ig_img_teoriko',   esc_url_raw($_POST['front_ig_img_teoriko']   ?? ''));
        update_option('arratia_front_ig_img_taldeak',   esc_url_raw($_POST['front_ig_img_taldeak']   ?? ''));
        update_option('arratia_front_ig_img_ahotsa',    esc_url_raw($_POST['front_ig_img_ahotsa']    ?? ''));
        echo '<div class="notice notice-success is-dismissible"><p>&#10003; Gorde da / Guardado.</p></div>';
    }
    $open    = get_option('arratia_matrikula_open', '1');

    $ins_default  = "Akordeoia\nArmonia Modernoa\nBaju elektrikoa\nBateria\nBiolina\nGitarra\nGitarra elektrikoa\nKlarinetea\nPanderoa\nPianoa\nSaxofoia\nTalde Instrumentala\nKantu Bakarlaria / Ahotsa (11+)\nTrikirtixa\nTronboia\nTronpeta\nTxalaparta\nTxistu\nZeharkako Txirula";
    $ins7_default = "Akordeoia\nBaju elektrikoa\nBateria\nBiolina\nGitarra\nGitarra elektrikoa\nKlarinetea\nPianoa\nSaxofoia\nTrikirtixa\nTronboia\nTronpeta\nTxalaparta\nTxistu\nZeharkako Txirula";
    $asig_default = "inst|Tresna bakarrik / Solo instrumento\nhm|Hizkuntza Musikala + Abesbatza\nhm16|Hizkuntza Musikala (16 urtetik gora)\nam|Armonia Modernoa (16 urtetik gora)";
    $ins_val  = get_option('arratia_instrumentuak',  $ins_default);
    $ins7_val = get_option('arratia_instrumentuak7', $ins7_default);
    $asig_val = get_option('arratia_asignaturak',    $asig_default);

    $video_1      = get_option('arratia_front_video_1', '');
    $video_2      = get_option('arratia_front_video_2', '');
    $video_1_desc = get_option('arratia_front_video_1_desc', '');
    $video_2_desc = get_option('arratia_front_video_2_desc', '');
    $video_1_img  = get_option('arratia_front_video_1_img', '');
    $video_2_img  = get_option('arratia_front_video_2_img', '');
    $antolaketa_img = get_option('arratia_antolaketa_img', '');
    $antolaketa_pdf = get_option('arratia_antolaketa_pdf', '');
    $egutegia_img   = get_option('arratia_egutegia_img',   '');
    $egutegia_pdf   = get_option('arratia_egutegia_pdf',   '');
    $ig_img_tresnak = get_option('arratia_front_ig_img_tresnak', '');
    $ig_img_teoriko = get_option('arratia_front_ig_img_teoriko', '');
    $ig_img_taldeak = get_option('arratia_front_ig_img_taldeak', '');
    $ig_img_ahotsa  = get_option('arratia_front_ig_img_ahotsa',  '');
    ?>
    <div class="wrap">
        <h1>🎵 Arratiako Musika Eskola — Ezarpenak</h1>
        <form method="post">
            <?php wp_nonce_field('arratia_ezarpenak'); ?>
            <table class="form-table">
                <tr>
                    <th scope="row">Matrikula formularioa<br><small style="font-weight:400">Formulario de matrícula</small></th>
                    <td>
                        <label>
                            <input type="checkbox" name="matrikula_open" value="1" <?php checked($open, '1'); ?>>
                            <strong>Matrikula aldia IREKITA dago</strong> / El período de matriculación está ABIERTO
                        </label>
                        <p class="description">
                            Markatuta → formularioa ikusgai dago.<br>
                            Desmarkatuta → "itxita" mezua agertuko da eta inork ezin du matrikulatu.
                        </p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">🎸 Instrumentuak (zerrenda nagusia)<br><small style="font-weight:400">Instruments list (main, 8+ urte)</small></th>
                    <td>
                        <textarea name="instrumentuak" rows="10" style="width:100%;max-width:500px;font-family:monospace;font-size:13px;"><?php echo esc_textarea($ins_val); ?></textarea>
                        <p class="description">Instrumentu bat lerro bakoitzean / Un instrumento por línea. Ordenatu nahi duzun bezala / Ordena como prefieras.</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">🎵 Instrumentuak (7 urte, aukerakoa)<br><small style="font-weight:400">Instruments (age 7, optional if places)</small></th>
                    <td>
                        <textarea name="instrumentuak7" rows="8" style="width:100%;max-width:500px;font-family:monospace;font-size:13px;"><?php echo esc_textarea($ins7_val); ?></textarea>
                        <p class="description">Instrumentu bat lerro bakoitzean / Un instrumento por línea.</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">📚 Asignaturak (13+ urte, hautaketa)<br><small style="font-weight:400">Subjects dropdown (age 13+)</small></th>
                    <td>
                        <textarea name="asignaturak" rows="6" style="width:100%;max-width:500px;font-family:monospace;font-size:13px;"><?php echo esc_textarea($asig_val); ?></textarea>
                        <p class="description">
                            Formatua / Formato: <code>kodea|Etiketa</code> lerro bakoitzean / por línea.<br>
                            Adib. / Ej.: <code>hm|Hizkuntza Musikala + Abesbatza</code><br>
                            <em>Kodea aldatu gabe utzi / No cambies el código (primera parte antes del |).</em>
                        </p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">📋 Hezkuntza Antolaketa irudia<br><small style="font-weight:400">Imagen del organigrama en Matrikulazioa</small></th>
                    <td>
                        <div style="display:flex;gap:8px;align-items:center;">
                            <input type="url" name="antolaketa_img" value="<?php echo esc_attr($antolaketa_img); ?>"
                                   style="flex:1;max-width:580px;padding:6px 10px;font-size:13px;"
                                   placeholder="https://...URL de la imagen del organigrama...">
                            <?php if ($antolaketa_img): ?>
                                <img src="<?php echo esc_url($antolaketa_img); ?>" style="height:48px;width:auto;border-radius:4px;object-fit:cover;">
                            <?php endif; ?>
                        </div>
                        <p class="description">Pega la URL de la imagen (Media → Biblioteca → copia URL del archivo).</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">📄 Hezkuntza Antolaketa PDF<br><small style="font-weight:400">PDF del organigrama (página Hezkuntza Antolaketa)</small></th>
                    <td>
                        <input type="url" name="antolaketa_pdf" value="<?php echo esc_attr($antolaketa_pdf); ?>"
                               style="width:100%;max-width:580px;padding:6px 10px;font-size:13px;"
                               placeholder="https://...URL del PDF...">
                        <p class="description">Media → Biblioteca → selecciona el PDF → copia la URL del archivo.</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">📅 Egutegia<br><small style="font-weight:400">Calendario — imagen o PDF (página Egutegia)</small></th>
                    <td>
                        <p style="margin-bottom:4px;font-weight:600;">Irudia / Imagen</p>
                        <div style="display:flex;gap:8px;align-items:center;margin-bottom:12px;">
                            <input type="url" name="egutegia_img" value="<?php echo esc_attr($egutegia_img); ?>"
                                   style="flex:1;max-width:580px;padding:6px 10px;font-size:13px;"
                                   placeholder="https://...URL de la imagen...">
                            <?php if ($egutegia_img): ?>
                                <img src="<?php echo esc_url($egutegia_img); ?>" style="height:48px;width:auto;border-radius:4px;object-fit:cover;">
                            <?php endif; ?>
                        </div>
                        <p style="margin-bottom:4px;font-weight:600;">PDF</p>
                        <input type="url" name="egutegia_pdf" value="<?php echo esc_attr($egutegia_pdf); ?>"
                               style="width:100%;max-width:580px;padding:6px 10px;font-size:13px;"
                               placeholder="https://...URL del PDF...">
                        <p class="description">Si hay imagen, se muestra la imagen. Si solo hay PDF, se muestra el PDF. Media → Biblioteca → copia la URL del archivo.</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">🖼️ Portadako ikasgai irudiak<br><small style="font-weight:400">Imágenes de las secciones en portada</small></th>
                    <td>
                        <?php
                        $ig_fields = [
                            'front_ig_img_tresnak' => ['Tresnak', $ig_img_tresnak],
                            'front_ig_img_teoriko' => ['Teoriko-Praktikoa', $ig_img_teoriko],
                            'front_ig_img_taldeak' => ['Taldeak', $ig_img_taldeak],
                            'front_ig_img_ahotsa'  => ['Ahotsa', $ig_img_ahotsa],
                        ];
                        foreach ($ig_fields as $fname => [$flabel, $fval]): ?>
                        <p style="margin-bottom:4px;font-weight:600;"><?php echo esc_html($flabel); ?></p>
                        <div style="display:flex;gap:8px;align-items:center;margin-bottom:12px;">
                            <input type="url" name="<?php echo esc_attr($fname); ?>" value="<?php echo esc_attr($fval); ?>"
                                   style="flex:1;max-width:500px;padding:6px 10px;font-size:13px;"
                                   placeholder="https://...irudi-url...">
                            <?php if ($fval): ?>
                                <img src="<?php echo esc_url($fval); ?>" style="height:48px;width:auto;border-radius:4px;object-fit:cover;">
                            <?php endif; ?>
                        </div>
                        <?php endforeach; ?>
                        <p class="description">Pega la URL de la imagen (Media → Biblioteca → copia la URL del archivo). Deja vacío para usar la imagen del ikasgai automáticamente.</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">🎬 Portadako bideoak<br><small style="font-weight:400">Vídeos en la portada</small></th>
                    <td>
                        <?php foreach ([
                            ['1', $video_1, $video_1_desc, $video_1_img],
                            ['2', $video_2, $video_2_desc, $video_2_img],
                        ] as [$n, $vurl, $vdesc, $vimg]): ?>
                        <p style="margin-bottom:4px;font-weight:600;"><?php echo $n; ?>. Bideoa</p>
                        <input type="url" name="front_video_<?php echo $n; ?>" value="<?php echo esc_attr($vurl); ?>"
                               style="width:100%;max-width:580px;padding:6px 10px;font-size:13px;margin-bottom:4px;"
                               placeholder="https://www.youtube.com/watch?v=...">
                        <input type="text" name="front_video_<?php echo $n; ?>_desc" value="<?php echo esc_attr($vdesc); ?>"
                               style="width:100%;max-width:580px;padding:6px 10px;font-size:13px;margin-bottom:4px;"
                               placeholder="Azalpena / Descripción (aukerakoa)">
                        <div style="display:flex;gap:8px;align-items:center;margin-bottom:16px;">
                            <input type="url" name="front_video_<?php echo $n; ?>_img" value="<?php echo esc_attr($vimg); ?>"
                                   style="flex:1;max-width:500px;padding:6px 10px;font-size:13px;"
                                   placeholder="Irudiaren URL / URL de la imagen de portada (aukerakoa)">
                            <?php if ($vimg): ?>
                                <img src="<?php echo esc_url($vimg); ?>" style="height:48px;width:auto;border-radius:4px;object-fit:cover;">
                            <?php endif; ?>
                        </div>
                        <?php endforeach; ?>
                        <p class="description">YouTube, Vimeo, Google Drive edo MP4. Hutsik → ez da agertuko.</p>
                    </td>
                </tr>
            </table>
            <p class="submit">
                <input type="submit" name="arratia_save_settings" class="button-primary" value="Gorde / Guardar">
            </p>
        </form>
    </div>
    <?php
}

// ─── Auto-create Hilabetea terms ──────────────────────────────────────────────
function arratia_create_hilabetea_terms() {
    $hilabeteak = [
        ['eu' => 'Iraila',    'es' => 'Septiembre'],
        ['eu' => 'Urria',     'es' => 'Octubre'],
        ['eu' => 'Azaroa',    'es' => 'Noviembre'],
        ['eu' => 'Abendua',   'es' => 'Diciembre'],
        ['eu' => 'Urtarrila', 'es' => 'Enero'],
        ['eu' => 'Otsaila',   'es' => 'Febrero'],
        ['eu' => 'Martxoa',   'es' => 'Marzo'],
        ['eu' => 'Apirila',   'es' => 'Abril'],
        ['eu' => 'Maiatza',   'es' => 'Mayo'],
        ['eu' => 'Ekaina',    'es' => 'Junio'],
        ['eu' => 'Uztaila',   'es' => 'Julio'],
        ['eu' => 'Abuztua',   'es' => 'Agosto'],
    ];
    foreach ($hilabeteak as $h) {
        $name = $h['eu'] . ' / ' . $h['es'];
        if (!term_exists($name, 'hilabetea')) {
            wp_insert_term($name, 'hilabetea', ['slug' => sanitize_title($h['eu']), 'description' => $h['es']]);
        }
    }
}
add_action('init', 'arratia_create_hilabetea_terms', 20);

// ─── Page hero band ───────────────────────────────────────────────────────────
function arratia_page_hero($label, $title, $style = 'b') {
    $logo_id = get_theme_mod('custom_logo');
    $logo_url = $logo_id ? wp_get_attachment_image_url($logo_id, 'full') : content_url('uploads/LogoArratia.png');
    $class = 'page-hero-band page-hero-band--' . esc_attr($style);
    echo '<div class="' . $class . '">';
    echo '<div class="container page-hero-band__inner">';
    if ($style === 'b') {
        echo '<img src="' . esc_url($logo_url) . '" alt="Arratiako Musika Eskola" class="page-hero-band__logo">';
    }
    echo '<h1 class="page-hero-band__title">' . esc_html($title) . '</h1>';
    echo '</div>';
    echo '</div>';
}

// ─── Basque month names ────────────────────────────────────────────────────────
function arratia_month_eu(int $m): string {
    return [
        1 => 'Urtarrila', 2 => 'Otsaila',  3 => 'Martxoa',
        4 => 'Apirila',   5 => 'Maiatza',   6 => 'Ekaina',
        7 => 'Uztaila',   8 => 'Abuztua',   9 => 'Iraila',
        10 => 'Urria',   11 => 'Azaroa',   12 => 'Abendua',
    ][$m] ?? '';
}

// ─── Meta box: Ongi Etorri slider galeria ────────────────────────────────────
add_action('add_meta_boxes', function() {
    add_meta_box(
        'arratia_ongi_galeria',
        'Slider-eko argazkiak / Fotos del slider',
        'arratia_ongi_galeria_box',
        'page',
        'normal',
        'default',
        null
    );
});

function arratia_ongi_galeria_box($post) {
    // Solo mostrar en la página con template Ongi Etorri
    if (get_post_meta($post->ID, '_wp_page_template', true) !== 'page-ongi-etorri.php') {
        echo '<p style="color:#888;">Esta meta box solo es relevante en la página con template <em>Ongi Etorri</em>.</p>';
        return;
    }
    wp_nonce_field('arratia_ongi_galeria_nonce', 'ongi_galeria_nonce');
    $ids = get_post_meta($post->ID, '_ongi_slider_ids', true);
    $inp = 'width:100%;padding:7px 10px;border:1px solid #ddd;border-radius:4px;font-size:13px;';
    echo '<p style="color:#555;font-size:13px;margin-bottom:8px;">Aukeratu argazkiak slider-erako. / Selecciona las fotos del slider.</p>';
    echo '<input type="text" id="ongi_slider_ids" name="ongi_slider_ids" value="' . esc_attr($ids) . '" style="' . $inp . '" placeholder="123,456,789">';
    echo '<p style="color:#888;font-size:11px;margin:4px 0 8px;">IDak koma bidez bereizita / IDs separados por coma.</p>';
    echo '<button type="button" class="button" onclick="arratiaOpenOngiGaleria()">+ Argazkiak aukeratu / Seleccionar fotos</button>';

    // Vista previa de imágenes seleccionadas
    if ($ids) {
        echo '<div style="margin-top:12px;display:flex;flex-wrap:wrap;gap:8px;">';
        foreach (explode(',', $ids) as $id) {
            $id = intval(trim($id));
            if (!$id) continue;
            $url = wp_get_attachment_image_url($id, 'thumbnail');
            if ($url) {
                echo '<img src="' . esc_url($url) . '" style="width:80px;height:60px;object-fit:cover;border-radius:4px;border:1px solid #ddd;">';
            }
        }
        echo '</div>';
    }
    ?>
    <script>
    function arratiaOpenOngiGaleria() {
        var frame = wp.media({title: 'Slider-eko argazkiak aukeratu', button: {text: 'Aukeratu'}, multiple: true});
        frame.on('select', function() {
            var ids = frame.state().get('selection').map(function(a){ return a.id; }).join(',');
            document.getElementById('ongi_slider_ids').value = ids;
        });
        frame.open();
    }
    </script>
    <?php
}

add_action('save_post_page', function($post_id) {
    if (!isset($_POST['ongi_galeria_nonce']) || !wp_verify_nonce($_POST['ongi_galeria_nonce'], 'arratia_ongi_galeria_nonce')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;
    if (isset($_POST['ongi_slider_ids'])) {
        update_post_meta($post_id, '_ongi_slider_ids', sanitize_text_field($_POST['ongi_slider_ids']));
    }
});

// ─── Video embed helper ───────────────────────────────────────────────────────
// Detects URL format and renders appropriate embed or link
function arratia_render_video(string $url): string {
    if (!$url) return '';
    $url_clean = trim($url);

    // YouTube
    if (preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([A-Za-z0-9_-]{11})/', $url_clean, $m)) {
        $embed = 'https://www.youtube.com/embed/' . $m[1] . '?rel=0&modestbranding=1';
        return '<div class="video-embed-wrap"><iframe src="' . esc_url($embed) . '" title="Bideoa" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen loading="lazy"></iframe></div>';
    }

    // Vimeo
    if (preg_match('/vimeo\.com\/(\d+)/', $url_clean, $m)) {
        $embed = 'https://player.vimeo.com/video/' . $m[1];
        return '<div class="video-embed-wrap"><iframe src="' . esc_url($embed) . '" title="Bideoa" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen loading="lazy"></iframe></div>';
    }

    // Google Drive
    if (preg_match('/drive\.google\.com\/file\/d\/([^\/]+)/', $url_clean, $m)) {
        $embed = 'https://drive.google.com/file/d/' . $m[1] . '/preview';
        return '<div class="video-embed-wrap"><iframe src="' . esc_url($embed) . '" title="Bideoa" frameborder="0" allow="autoplay" allowfullscreen loading="lazy"></iframe></div>';
    }

    // Google Photos video (album/share link - embed not possible, show as link)
    if (strpos($url_clean, 'photos.google.com') !== false) {
        return '<a href="' . esc_url($url_clean) . '" target="_blank" rel="noopener" class="ekintza-link ekintza-link--video"><i class="fas fa-video"></i> Bideoa ikusi</a>';
    }

    // Direct video file (mp4, webm, ogg)
    if (preg_match('/\.(mp4|webm|ogv|ogg)(\?.*)?$/i', $url_clean)) {
        $type_map = ['mp4' => 'video/mp4', 'webm' => 'video/webm', 'ogv' => 'video/ogg', 'ogg' => 'video/ogg'];
        preg_match('/\.(mp4|webm|ogv|ogg)/i', $url_clean, $ext_m);
        $mime = $type_map[strtolower($ext_m[1])] ?? 'video/mp4';
        return '<div class="video-embed-wrap"><video controls preload="metadata"><source src="' . esc_url($url_clean) . '" type="' . esc_attr($mime) . '">Zure nabigatzaileak bideoa ez du onartzen.</video></div>';
    }

    // Fallback: plain link
    return '<a href="' . esc_url($url_clean) . '" target="_blank" rel="noopener" class="ekintza-link ekintza-link--video"><i class="fas fa-video"></i> Bideoa ikusi</a>';
}
