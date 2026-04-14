<?php
/**
 * Template Name: Matrikulazioa
 */
get_header();
?>

<div class="matrikula-page">
    <div class="container">

        <?php arratia_page_hero('Izena Eman', 'Matrikula'); ?>

        <!-- Intro banner -->
        <div class="matrikula-intro-banner">
            <i class="fas fa-info-circle"></i>
            <p>Matrikulatu aurretik, ikasgai eta adinaren araberako informazioa irakurtzea gomendatzen dizugu.
               Dudarik izanez gero, jarri gurekin kontaktuan.
               <!-- ADULTS NOTE: quitar esta línea si no se quiere mostrar -->
               <br><em>Formularioa helduendako ere baliozko da / El formulario también es válido para adultos.</em>
            </p>
        </div>

        <!-- Main two-column grid -->
        <div class="matrikula-main-grid">

            <!-- LEFT: Steps -->
            <div class="matrikula-steps-col">
                <h2 class="matrikula-section-title"><i class="fas fa-mouse-pointer"></i> Nola matrikulatu on-line</h2>
                <ol class="matrikula-steps">
                    <li>
                        <?php if (get_option('arratia_matrikula_open', '1')): ?>
                        <a href="<?php echo esc_url(home_url('/matrikula-eskaera/')); ?>" class="btn btn-accent" style="font-size:.9rem;padding:.55rem 1.4rem;">
                            <i class="fas fa-edit"></i> «MATRIKULATU ON-LINE»-N sartu
                        </a>
                        <?php else: ?>
                        <strong>«MATRIKULATU ON-LINE»-N sartu</strong> <em style="color:#999;font-size:.85em;">(itxita / cerrado)</em>
                        <?php endif; ?>
                    </li>
                    <li>Laukiz lauki <strong>datu guztiak bete</strong>:
                        <ul>
                            <li>Ikaslearen datuak</li>
                            <li>Bankuko datuak</li>
                            <li>Matrikularako datuak: adinaren arabera klikatu dagokion tokian</li>
                        </ul>
                    </li>
                    <li><strong>«Izena Eman»</strong> botoian sakatu</li>
                    <li>Mezua helduko zaizu datuak zehaztuz, idatzi duzun korreora</li>
                </ol>

                <div class="matrikula-note-box">
                    <i class="fas fa-mobile-alt"></i>
                    <p>Matrikula eskaria egiteko smartphone, tableta edo ordenagailua beharko duzu internetarekin. Bete beharreko izen-ematea <strong>behin-behineko eskaera</strong> izango da.</p>
                </div>

                <!-- Info links -->
                <h2 class="matrikula-section-title" style="margin-top:1.75rem;"><i class="fas fa-file-alt"></i> Informazioa</h2>
                <div class="matrikula-links-grid" style="grid-template-columns: repeat(2, 1fr);">
                    <a href="<?php echo esc_url(home_url('/tasak/')); ?>" class="matrikula-link-card">
                        <i class="fas fa-euro-sign"></i>
                        <span>2026/2027 Tasak</span>
                    </a>
                    <?php $antolaketa_img = get_option('arratia_antolaketa_img', ''); if ($antolaketa_img): ?>
                    <a href="<?php echo esc_url(home_url('/hezkuntza-antolaketa/')); ?>" class="matrikula-link-card">
                        <i class="fas fa-sitemap"></i>
                        <span>Hezkuntza Antolaketa 2025/2026</span>
                    </a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- RIGHT: Course requirements + info -->
            <div class="matrikula-info-col">

                <h2 class="matrikula-section-title"><i class="fas fa-graduation-cap"></i> Adinaren arabera</h2>
                <div class="matrikula-maila-list">

                    <div class="matrikula-maila-item">
                        <span class="matrikula-maila-badge">4–7 urte</span>
                        <span>Musika &amp; Mugimendua</span>
                    </div>
                    <div class="matrikula-maila-item">
                        <span class="matrikula-maila-badge">7 urte</span>
                        <div>
                            <p>Tresna (aukerakoa)</p>
                            <p class="matrikula-maila-note">Plazarik badago.</p>
                        </div>
                    </div>

                    <div class="matrikula-maila-item">
                        <span class="matrikula-maila-badge">8+ urte</span>
                        <div>
                            <p>Hizkuntza musikala + abesbatza + tresna</p>
                            <p class="matrikula-maila-note">Tresna aukeratuz gero, Hizkuntza musikala eta abesbatza derrigorrak.</p>
                            <p class="matrikula-maila-note">Hizkuntza musikala eta abesbatza aukeran, tresnarik gabe.</p>
                        </div>
                    </div>
                    <div class="matrikula-maila-item">
                        <span class="matrikula-maila-badge">13+ urte</span>
                        <div>
                            <p>Tresna</p>
                            <p class="matrikula-maila-note">Hizkuntza musikala eta abesbatza ez dira derrigorrak.</p>
                        </div>
                    </div>

                </div>

                <!-- Dates -->
                <div class="matrikula-epea-card">
                    <div class="matrikula-epea-header">
                        <i class="fas fa-calendar-alt"></i> Matrikulazio epea 2026/2027
                    </div>
                    <div class="matrikula-epea-body">
                        Maiatzaren 15 – Ekainaren 5 (2026)
                    </div>
                </div>

            </div>
        </div>

        <!-- Notes section -->
        <div class="matrikula-oharrak">
            <h2 class="matrikula-section-title"><i class="fas fa-exclamation-triangle"></i> Ikasleari oharrak</h2>
            <div class="matrikula-oharrak-grid">
                <div class="matrikula-ohar-item">
                    <i class="fas fa-check-circle"></i>
                    <p>Matrikulatu ahal izateko, aurreko ikasturteko <strong>kuota guztiak ordainduta</strong> egon beharko dira.</p>
                </div>
                <div class="matrikula-ohar-item">
                    <i class="fas fa-calendar-check"></i>
                    <p>Ikasturtearen hasiera: <strong>web orrian argitaratuko da.</strong></p>
                </div>
                <div class="matrikula-ohar-item matrikula-ohar-highlight">
                    <i class="fas fa-handshake"></i>
                    <p>Matrikulatzen den ikasleak, <strong>ikasturte osoa betetzeko konpromisoa</strong> hartzen du.</p>
                </div>
                <div class="matrikula-ohar-item">
                    <i class="fas fa-door-open"></i>
                    <p><strong>Baja epea: Urriaren 31a.</strong> Epe hau pasata, ezin izango da bajarik eman. Bajak eskaria aurkezten den hurrengo hilabetetik izango ditu ondorioak.</p>
                </div>
                <div class="matrikula-ohar-item">
                    <i class="fas fa-envelope"></i>
                    <p>Ikasturteko egutegia, <strong>ikasturte hasieran emailez</strong> bidaliko da.</p>
                </div>
                <div class="matrikula-ohar-item">
                    <i class="fas fa-users"></i>
                    <p>Ikasle <strong>kopuru minimoa</strong> behar izango da ikasgaia eman ahal izateko.</p>
                </div>
                <div class="matrikula-ohar-item">
                    <i class="fas fa-list-ol"></i>
                    <p><strong>Itxaron zerrenda:</strong> plazarik ezean edo epez kanpo matrikulatu ezkero, zerrenda honetan sartuko da.</p>
                </div>
            </div>
        </div>

        <!-- CTA -->
        <div class="matrikula-cta">
        <?php if (get_option('arratia_matrikula_open', '1')): ?>
            <a href="<?php echo esc_url(home_url('/matrikula-eskaera/')); ?>" class="btn btn-accent btn-lg">
                <i class="fas fa-edit"></i> Matrikulatu On-Line
            </a>
        <?php else: ?>
            <div class="matrikula-closed-notice">
                <i class="fas fa-lock"></i>
                <div>
                    <strong>Matrikula aldia itxita dago</strong><br>
                    <em>El período de matriculación está cerrado</em>
                </div>
            </div>
        <?php endif; ?>
        </div>

    </div>
</div>

<?php get_footer(); ?>
