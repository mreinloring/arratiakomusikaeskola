<?php
/**
 * Template Name: Non Gaude
 */
get_header();

$base = 'https://www.arratiakomusikaeskola.eu/wp-content/uploads/2023/07/';

$herriak = [
    ['izena' => 'Arantzazu', 'escudo' => $base.'Escudo_de_Arantzazu.png', 'lat' => '43.15642267433537', 'lng' => '-2.7901581535321154'],
    ['izena' => 'Areatza',   'escudo' => $base.'Escudo_de_Areatza.png',   'lat' => '43.120755114925146','lng' => '-2.767879321921424'],
    ['izena' => 'Artea',     'escudo' => $base.'Escudo_de_Artea.png',     'lat' => '43.13356166113269', 'lng' => '-2.784799632359127'],
    ['izena' => 'Bedia',     'escudo' => $base.'Escudo_de_Bedia.png',     'lat' => '43.208201629743364','lng' => '-2.801592507210843'],
    ['izena' => 'Dima',      'escudo' => $base.'Escudo_de_Dima.png',      'lat' => '43.14209312469822', 'lng' => '-2.7495947871366626'],
    ['izena' => 'Igorre',    'escudo' => $base.'Escudo_de_Igorre.png',    'lat' => '43.160016',         'lng' => '-2.777416'],
    ['izena' => 'Lemoa',     'escudo' => $base.'Escudo_de_Lemoa.png',     'lat' => '43.209216863039074','lng' => '-2.7712459751498737'],
    ['izena' => 'Otxandio',  'escudo' => $base.'Escudo_de_Otxandio.png',  'lat' => '43.04025079536868', 'lng' => '-2.655274874200698'],
    ['izena' => 'Zeanuri',   'escudo' => $base.'Escudo_de_Zeanuri.png',   'lat' => '43.09823512216252', 'lng' => '-2.749435001440934'],
    ['izena' => 'Zeberio',   'escudo' => $base.'Escudo_de_Zeberio.png',   'lat' => '43.14748910638358', 'lng' => '-2.84847495337315'],
];
?>

<div class="nongaude-page">
    <div class="container">

        <?php arratia_page_hero('Non Gaude', 'Non Gaude'); ?>

        <div class="nongaude-grid">
        <?php foreach ($herriak as $h):
            $map_src = 'https://maps.google.com/maps?q=' . $h['lat'] . '%2C%20' . $h['lng'] . '&t=m&z=15&output=embed&iwloc=near';
            // Optional school photo from WP option
            $foto = get_option('arratia_nongaude_foto_' . sanitize_key($h['izena']), '');
        ?>
        <div class="nongaude-herria">
            <h2 class="nongaude-izena"><?php echo esc_html($h['izena']); ?></h2>
            <div class="nongaude-row">

                <!-- Flip card: escudo → foto -->
                <div class="nongaude-flip-wrap">
                    <div class="flip-card nongaude-flip">
                        <div class="flip-card-inner">
                            <div class="flip-card-front nongaude-front">
                                <img src="<?php echo esc_url($h['escudo']); ?>" alt="<?php echo esc_attr($h['izena']); ?> escudoa">
                            </div>
                            <div class="flip-card-back nongaude-back">
                                <?php if ($foto): ?>
                                    <img src="<?php echo esc_url($foto); ?>" alt="<?php echo esc_attr($h['izena']); ?> eskola">
                                <?php else: ?>
                                    <div class="nongaude-no-foto">
                                        <i class="fas fa-school"></i>
                                        <span><?php echo esc_html($h['izena']); ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mapa -->
                <div class="nongaude-map-wrap">
                    <iframe
                        src="<?php echo esc_url($map_src); ?>"
                        title="<?php echo esc_attr($h['izena']); ?>"
                        loading="lazy"
                        allowfullscreen
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>

            </div>
        </div>
        <?php endforeach; ?>
        </div>

    </div>
</div>

<?php get_footer(); ?>
