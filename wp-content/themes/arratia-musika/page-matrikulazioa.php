<?php
/**
 * Template Name: Matrikulazioa
 */
get_header();
?>

<div class="matrikula-page">
    <div class="container">

        <?php arratia_page_hero('Izena Eman', arratia_t('Matrikula', 'Matrícula')); ?>

        <!-- Intro banner -->
        <div class="matrikula-intro-banner">
            <i class="fas fa-info-circle"></i>
            <p><?php echo arratia_t(
                'Matrikulatu aurretik, ikasgai eta adinaren araberako informazioa irakurtzea gomendatzen dizugu. Dudarik izanez gero, jarri gurekin kontaktuan.',
                'Antes de matricularte, te recomendamos leer la información según la asignatura y la edad. Si tienes dudas, contacta con nosotros.'
            ); ?>
               <br><em><?php echo arratia_t(
                'Formularioa helduendako ere baliozko da.',
                'El formulario también es válido para adultos.'
               ); ?></em>
               <br><a href="<?php echo esc_url(home_url('/hezkuntza-antolaketa/')); ?>" style="color:var(--accent);font-weight:600;text-decoration:underline;">
                   <i class="fas fa-sitemap" style="margin-right:4px;"></i><?php echo arratia_t('Hezkuntza Antolaketa ikusi →', 'Ver Organización educativa →'); ?>
               </a>
            </p>
        </div>

        <!-- Main two-column grid -->
        <div class="matrikula-main-grid">

            <!-- LEFT: Steps -->
            <div class="matrikula-steps-col">
                <h2 class="matrikula-section-title"><i class="fas fa-mouse-pointer"></i> <?php echo arratia_t('Nola matrikulatu on-line', 'Cómo matricularse on-line'); ?></h2>
                <ol class="matrikula-steps">
                    <li>
                        <?php if (get_option('arratia_matrikula_open', '1')): ?>
                        <a href="<?php echo esc_url(home_url('/matrikula-eskaera/')); ?>" class="btn btn-accent" style="font-size:.9rem;padding:.55rem 1.4rem;">
                            <i class="fas fa-edit"></i> «<?php echo arratia_t('MATRIKULATU ON-LINE', 'MATRICULARSE ON-LINE'); ?>»
                        </a>
                        <?php else: ?>
                        <strong>«<?php echo arratia_t('MATRIKULATU ON-LINE', 'MATRICULARSE ON-LINE'); ?>»</strong>
                        <em style="color:#999;font-size:.85em;">(<?php echo arratia_t('itxita', 'cerrado'); ?>)</em>
                        <?php endif; ?>
                    </li>
                    <li><?php echo arratia_t(
                        'Laukiz lauki <strong>datu guztiak bete</strong>:',
                        'Rellena <strong>todos los datos</strong> campo por campo:'
                    ); ?>
                        <ul>
                            <li><?php echo arratia_t('Ikaslearen datuak', 'Datos del alumno/a'); ?></li>
                            <li><?php echo arratia_t('Bankuko datuak', 'Datos bancarios'); ?></li>
                            <li><?php echo arratia_t('Matrikularako datuak: adinaren arabera klikatu dagokion tokian', 'Datos de matrícula: haz clic según la edad correspondiente'); ?></li>
                        </ul>
                    </li>
                    <li><?php echo arratia_t(
                        '<strong>«Izena Eman»</strong> botoian sakatu',
                        'Haz clic en el botón <strong>«Izena Eman»</strong>'
                    ); ?></li>
                    <li><?php echo arratia_t(
                        'Mezua helduko zaizu datuak zehaztuz, idatzi duzun korreora',
                        'Recibirás un correo de confirmación con tus datos en la dirección indicada'
                    ); ?></li>
                </ol>

                <div class="matrikula-note-box">
                    <i class="fas fa-mobile-alt"></i>
                    <p><?php echo arratia_t(
                        'Matrikula eskaria egiteko smartphone, tableta edo ordenagailua beharko duzu internetarekin. Bete beharreko izen-ematea <strong>behin-behineko eskaera</strong> izango da.',
                        'Para realizar la solicitud de matrícula necesitarás un smartphone, tableta u ordenador con internet. La inscripción que debes rellenar será una <strong>solicitud provisional</strong>.'
                    ); ?></p>
                </div>

                <!-- Info links -->
                <h2 class="matrikula-section-title" style="margin-top:1.75rem;"><i class="fas fa-file-alt"></i> <?php echo arratia_t('Informazioa', 'Información'); ?></h2>
                <div class="matrikula-links-grid" style="grid-template-columns: repeat(2, 1fr);">
                    <a href="<?php echo esc_url(home_url('/tasak/')); ?>" class="matrikula-link-card">
                        <i class="fas fa-euro-sign"></i>
                        <span>2026/2027 <?php echo arratia_t('Tasak', 'Tasas'); ?></span>
                    </a>
                    <?php $antolaketa_img = get_option('arratia_antolaketa_img', ''); if ($antolaketa_img): ?>
                    <a href="<?php echo esc_url(home_url('/hezkuntza-antolaketa/')); ?>" class="matrikula-link-card">
                        <i class="fas fa-sitemap"></i>
                        <span><?php echo arratia_t('Hezkuntza Antolaketa 2025/2026', 'Organización Educativa 2025/2026'); ?></span>
                    </a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- RIGHT: Course requirements + info -->
            <div class="matrikula-info-col">

                <h2 class="matrikula-section-title"><i class="fas fa-graduation-cap"></i> <?php echo arratia_t('Adinaren arabera', 'Según la edad'); ?></h2>
                <div class="matrikula-maila-list">

                    <div class="matrikula-maila-item">
                        <span class="matrikula-maila-badge">4–7 <?php echo arratia_t('urte', 'años'); ?></span>
                        <span>Musika &amp; Mugimendua</span>
                    </div>
                    <div class="matrikula-maila-item">
                        <span class="matrikula-maila-badge">7 <?php echo arratia_t('urte', 'años'); ?></span>
                        <div>
                            <p><?php echo arratia_t('Tresna (aukerakoa)', 'Instrumento (opcional)'); ?></p>
                            <p class="matrikula-maila-note"><?php echo arratia_t('Plazarik badago.', 'Si hay plazas disponibles.'); ?></p>
                        </div>
                    </div>

                    <div class="matrikula-maila-item">
                        <span class="matrikula-maila-badge">8+ <?php echo arratia_t('urte', 'años'); ?></span>
                        <div>
                            <p><?php echo arratia_t('Hizkuntza musikala + abesbatza + tresna', 'Lenguaje musical + coro + instrumento'); ?></p>
                            <p class="matrikula-maila-note"><?php echo arratia_t(
                                'Tresna aukeratuz gero, Hizkuntza musikala eta abesbatza derrigorrak.',
                                'Si se elige instrumento, lenguaje musical y coro son obligatorios.'
                            ); ?></p>
                            <p class="matrikula-maila-note"><?php echo arratia_t(
                                'Hizkuntza musikala eta abesbatza aukeran, tresnarik gabe.',
                                'Lenguaje musical y coro también pueden cursarse sin instrumento.'
                            ); ?></p>
                        </div>
                    </div>
                    <div class="matrikula-maila-item">
                        <span class="matrikula-maila-badge">13+ <?php echo arratia_t('urte', 'años'); ?></span>
                        <div>
                            <p><?php echo arratia_t('Tresna', 'Instrumento'); ?></p>
                            <p class="matrikula-maila-note"><?php echo arratia_t(
                                'Hizkuntza musikala eta abesbatza ez dira derrigorrak.',
                                'Lenguaje musical y coro no son obligatorios.'
                            ); ?></p>
                        </div>
                    </div>

                </div>

                <!-- Dates -->
                <div class="matrikula-epea-card">
                    <div class="matrikula-epea-header">
                        <i class="fas fa-calendar-alt"></i> <?php echo arratia_t('Matrikulazio epea 2026/2027', 'Período de matriculación 2026/2027'); ?>
                    </div>
                    <div class="matrikula-epea-body">
                        <?php echo arratia_t('Maiatzaren 15 – Ekainaren 5 (2026)', '15 de mayo – 5 de junio (2026)'); ?>
                    </div>
                </div>

            </div>
        </div>

        <!-- Notes section -->
        <div class="matrikula-oharrak">
            <h2 class="matrikula-section-title"><i class="fas fa-exclamation-triangle"></i> <?php echo arratia_t('Ikasleari oharrak', 'Avisos al alumno/a'); ?></h2>
            <div class="matrikula-oharrak-grid">
                <div class="matrikula-ohar-item">
                    <i class="fas fa-check-circle"></i>
                    <p><?php echo arratia_t(
                        'Matrikulatu ahal izateko, aurreko ikasturteko <strong>kuota guztiak ordainduta</strong> egon beharko dira.',
                        'Para poder matricularse, deberán estar pagadas <strong>todas las cuotas</strong> del curso anterior.'
                    ); ?></p>
                </div>
                <div class="matrikula-ohar-item">
                    <i class="fas fa-calendar-check"></i>
                    <p><?php echo arratia_t(
                        'Ikasturtearen hasiera: <strong>web orrian argitaratuko da.</strong>',
                        'Inicio del curso: <strong>se publicará en la web.</strong>'
                    ); ?></p>
                </div>
                <div class="matrikula-ohar-item matrikula-ohar-highlight">
                    <i class="fas fa-handshake"></i>
                    <p><?php echo arratia_t(
                        'Matrikulatzen den ikasleak, <strong>ikasturte osoa betetzeko konpromisoa</strong> hartzen du.',
                        'El alumno/a que se matricule adquiere el <strong>compromiso de completar el curso completo</strong>.'
                    ); ?></p>
                </div>
                <div class="matrikula-ohar-item">
                    <i class="fas fa-door-open"></i>
                    <p><?php echo arratia_t(
                        '<strong>Baja epea: Urriaren 31a.</strong> Epe hau pasata, ezin izango da bajarik eman. Bajak eskaria aurkezten den hurrengo hilabetetik izango ditu ondorioak.',
                        '<strong>Plazo de baja: 31 de octubre.</strong> Pasado este plazo no se podrá dar de baja. La baja tendrá efecto a partir del mes siguiente a la solicitud.'
                    ); ?></p>
                </div>
                <div class="matrikula-ohar-item">
                    <i class="fas fa-envelope"></i>
                    <p><?php echo arratia_t(
                        'Ikasturteko egutegia, <strong>ikasturte hasieran emailez</strong> bidaliko da.',
                        'El calendario del curso se enviará <strong>por email al inicio del curso</strong>.'
                    ); ?></p>
                </div>
                <div class="matrikula-ohar-item">
                    <i class="fas fa-users"></i>
                    <p><?php echo arratia_t(
                        'Ikasle <strong>kopuru minimoa</strong> behar izango da ikasgaia eman ahal izateko.',
                        'Se necesitará un <strong>número mínimo de alumnos</strong> para poder impartir la asignatura.'
                    ); ?></p>
                </div>
                <div class="matrikula-ohar-item">
                    <i class="fas fa-list-ol"></i>
                    <p><?php echo arratia_t(
                        '<strong>Itxaron zerrenda:</strong> plazarik ezean edo epez kanpo matrikulatu ezkero, zerrenda honetan sartuko da.',
                        '<strong>Lista de espera:</strong> si no hay plazas o la matrícula se realiza fuera de plazo, se incluirá en esta lista.'
                    ); ?></p>
                </div>
            </div>
        </div>

        <!-- CTA -->
        <div class="matrikula-cta">
        <?php if (get_option('arratia_matrikula_open', '1')): ?>
            <a href="<?php echo esc_url(home_url('/matrikula-eskaera/')); ?>" class="btn btn-accent btn-lg">
                <i class="fas fa-edit"></i> <?php echo arratia_t('Matrikulatu On-Line', 'Matricularse On-Line'); ?>
            </a>
        <?php else: ?>
            <div class="matrikula-closed-notice">
                <i class="fas fa-lock"></i>
                <div>
                    <strong><?php echo arratia_t('Matrikula aldia itxita dago', 'El período de matriculación está cerrado'); ?></strong>
                </div>
            </div>
        <?php endif; ?>
        </div>

    </div>
</div>

<?php get_footer(); ?>
