<?php
/**
 * Template Name: Pribatutasun Politika / Política de Privacidad
 */
get_header();
?>

<div class="privacy-page">
<div class="container" style="max-width:860px;">

    <?php arratia_page_hero('Pribatutasun Politika', 'Política de Privacidad'); ?>

    <p class="privacy-updated">Azken eguneraketa / Última actualización: <?php echo date('d/m/Y'); ?></p>

    <div class="privacy-lang-tabs">
        <button class="privacy-tab privacy-tab--active" data-lang="eu">Euskara</button>
        <button class="privacy-tab" data-lang="es">Castellano</button>
    </div>

    <!-- ══ EUSKARAZKO BERTSIOA ═══════════════════════════════════════════════ -->
    <div class="privacy-body" id="privacy-eu">

        <h2>1. Tratamenduaren arduraduna</h2>
        <table class="privacy-table">
            <tr><td>Izena</td><td>Arratiako Musika Eskola</td></tr>
            <tr><td>Helbidea</td><td><?php echo esc_html(ARRATIA_HELBIDEA); ?></td></tr>
            <tr><td>Telefonoa</td><td><?php echo esc_html(ARRATIA_TELEFONO); ?></td></tr>
            <tr><td>Helbide elektronikoa</td><td><a href="mailto:<?php echo esc_attr(ARRATIA_EMAIL); ?>"><?php echo esc_html(ARRATIA_EMAIL); ?></a></td></tr>
        </table>

        <h2>2. Tratamenduaren xedea</h2>
        <p>Matrikula-inprimakiaren bidez jasotako datu pertsonalak honako helburuetarako tratatzen dira:</p>
        <ul>
            <li>Arratiako Musika Eskolan matrikulatzeko eskaeraren kudeaketa.</li>
            <li>Hezkuntza-harremanari lotutako administrazio-, akademia- eta ekonomia-kudeaketa (kuoten kobraketa, ordutegiak, egutegia eta abar).</li>
            <li>Eskumena duten administrazio publikoekiko legezko betebeharren betetzea.</li>
            <li>Eskolaren jarduerari buruzko informazioaren bidaltzea.</li>
        </ul>

        <h2>3. Legitimazioa</h2>
        <ul>
            <li><strong>Kontratuaren betearazpena</strong> (DBEE 6.1.b art.): hezkuntzako zerbitzua emateko eta matrikula kudeatzeko beharrezkoa da.</li>
            <li><strong>Legezko betebeharra</strong> (DBEE 6.1.c art.): aplikagarria den hezkuntza- eta zerga-arautegiaren betebeharrak.</li>
            <li><strong>Baimena</strong> (DBEE 6.1.a art.): zabalkundea helburu duten irudiak eta/edo bideoak erabiltzeko.</li>
        </ul>

        <h2>4. Jasotako datuak</h2>
        <ul>
            <li>Identifikazio-datuak: izena, abizenak, helbidea, udalerria, jaiotze-data.</li>
            <li>Harremanetarako datuak: telefonoa, helbide elektronikoa.</li>
            <li>Legezko ordezkariaren datuak (adingabeen kasuan): aita/ama/tutorearen izena.</li>
            <li>Banku-datuak: IBAN eta kontuaren titularra, kuoten domizilaziorako.</li>
            <li>Akademia-datuak: ikasgaia, instrumentua, ikasle berria edo ohia.</li>
        </ul>

        <h2>5. Datuen komunikazioa hirugarrenei</h2>
        <ul>
            <li><strong>Arteako Udala</strong> (Herriko Plaza, 48142 Artea, Bizkaia): eskolaren titularra eta finantzatzailea den aldetik, administrazio-kudeaketarako, dirulaguntzen justifikaziorako eta EAEko musika-irakaskuntzari buruzko arautegia betetzeko.</li>
            <li><strong>Banku-erakundeak</strong>: kuoten domizilaziorako.</li>
            <li><strong>Administrazio publikoak</strong>: legezko betebeharra dagoenean (Ogasuna, Gizarte Segurantza, etab.).</li>
        </ul>
        <p>Ez da Europako Ekonomia Eremutik kanpora daturik transferituko.</p>

        <h2>6. Kontserbazio-epea</h2>
        <ul>
            <li>Kontabilitate- eta zerga-datuak: <strong>5 urte</strong> (Zerga Lege Orokorra).</li>
            <li>Banku-datuak: azken kobratzetik <strong>5 urte</strong>.</li>
            <li>Akademia-datuak: ikaslearen bajatik <strong>5 urte</strong>.</li>
        </ul>

        <h2>7. Interesdunaren eskubideak</h2>
        <p>DBEEaren eta LOPDGDDren arabera, honako eskubideak egikaritu ditzakezu <a href="mailto:<?php echo esc_attr(ARRATIA_EMAIL); ?>"><?php echo esc_html(ARRATIA_EMAIL); ?></a> helbidera idatziz edo posta bidez gure helbidean:</p>
        <ul>
            <li><strong>Sarbidea</strong>: zer datu tratatzen ditugun jakiteko.</li>
            <li><strong>Zuzenketa</strong>: datu okerrak edo osatugabeak zuzentzeko.</li>
            <li><strong>Ezabaketa</strong>: datuak beharrezkoak ez direnean ezabatzeko.</li>
            <li><strong>Mugapena</strong>: zenbait kasutan tratamendua geldiarazteko.</li>
            <li><strong>Eramangarritasuna</strong>: zure datuak formatu estandarrean jasotzeko.</li>
            <li><strong>Aurkaratzea</strong>: zenbait kasutan tratamenduaren aurka egiteko.</li>
        </ul>


        <h2>8. Adingabeak</h2>
        <p>14 urtetik beherako ikasleen kasuan, datuak gurasoen edo legezko tutoreen eskutik jasotzen dira, eta hauek arduratu behar dira emandako datuen zehaztasunaz.</p>

        <h2>9. Segurtasun-neurriak</h2>
        <p>Arratiako Musika Eskolak datu pertsonalen segurtasuna bermatzeko beharrezko neurri tekniko eta antolaketa-neurriak ezartzen ditu.</p>

    </div><!-- #privacy-eu -->

    <!-- ══ VERSIÓN CASTELLANO ═════════════════════════════════════════════════ -->
    <div class="privacy-body" id="privacy-es" style="display:none;">

        <h2>1. Responsable del tratamiento</h2>
        <table class="privacy-table">
            <tr><td>Denominación</td><td>Arratiako Musika Eskola</td></tr>
            <tr><td>Dirección</td><td><?php echo esc_html(ARRATIA_HELBIDEA); ?></td></tr>
            <tr><td>Teléfono</td><td><?php echo esc_html(ARRATIA_TELEFONO); ?></td></tr>
            <tr><td>Correo electrónico</td><td><a href="mailto:<?php echo esc_attr(ARRATIA_EMAIL); ?>"><?php echo esc_html(ARRATIA_EMAIL); ?></a></td></tr>
        </table>

        <h2>2. Finalidad del tratamiento</h2>
        <p>Los datos personales recogidos a través del formulario de matrícula se tratan con las siguientes finalidades:</p>
        <ul>
            <li>Gestión de la inscripción y matrícula en la Escuela de Música de Arratia.</li>
            <li>Gestión administrativa, académica y económica derivada de la relación educativa (cobro de cuotas, comunicación de horarios, calendario, etc.).</li>
            <li>Cumplimiento de las obligaciones legales ante las administraciones públicas competentes.</li>
            <li>Envío de información relacionada con las actividades de la escuela.</li>
        </ul>

        <h2>3. Legitimación</h2>
        <ul>
            <li><strong>Ejecución de un contrato</strong> (Art. 6.1.b RGPD): necesario para la prestación del servicio educativo y la gestión de la matrícula.</li>
            <li><strong>Obligación legal</strong> (Art. 6.1.c RGPD): cumplimiento de obligaciones derivadas de la legislación educativa y fiscal.</li>
            <li><strong>Consentimiento</strong> (Art. 6.1.a RGPD): para el uso de imágenes y/o vídeos con fines divulgativos.</li>
        </ul>

        <h2>4. Datos recogidos</h2>
        <ul>
            <li>Datos identificativos: nombre, apellidos, dirección, municipio, fecha de nacimiento.</li>
            <li>Datos de contacto: teléfono, correo electrónico.</li>
            <li>Datos del representante legal (menores): nombre de padre/madre/tutor.</li>
            <li>Datos bancarios: IBAN y titular de la cuenta, para la domiciliación de cuotas.</li>
            <li>Datos académicos: asignatura, instrumento, condición de alumno nuevo u anterior.</li>
        </ul>

        <h2>5. Comunicación de datos a terceros</h2>
        <ul>
            <li><strong>Ayuntamiento de Artea</strong> (Herriko Plaza, 48142 Artea, Bizkaia): en su condición de entidad titular y financiadora de la escuela, a efectos de gestión administrativa, justificación de subvenciones y cumplimiento de la normativa de enseñanzas musicales no regladas del País Vasco.</li>
            <li><strong>Entidades bancarias</strong>: para la domiciliación de cuotas.</li>
            <li><strong>Administraciones públicas</strong>: cuando sea exigido por obligación legal (Hacienda, Seguridad Social, etc.).</li>
        </ul>
        <p>No se realizarán transferencias internacionales de datos fuera del Espacio Económico Europeo.</p>

        <h2>6. Plazo de conservación</h2>
        <ul>
            <li>Datos contables y fiscales: <strong>5 años</strong> (Ley General Tributaria).</li>
            <li>Datos bancarios: <strong>5 años</strong> desde el último cobro.</li>
            <li>Datos académicos: <strong>5 años</strong> desde la baja del alumno/a.</li>
        </ul>

        <h2>7. Derechos de las personas interesadas</h2>
        <p>En virtud del RGPD y la LOPDGDD, puede ejercer los siguientes derechos dirigiéndose a <a href="mailto:<?php echo esc_attr(ARRATIA_EMAIL); ?>"><?php echo esc_html(ARRATIA_EMAIL); ?></a> o por correo postal:</p>
        <ul>
            <li><strong>Acceso</strong>: conocer qué datos suyos tratamos.</li>
            <li><strong>Rectificación</strong>: corregir datos inexactos o incompletos.</li>
            <li><strong>Supresión</strong>: solicitar la eliminación cuando ya no sean necesarios.</li>
            <li><strong>Limitación</strong>: solicitar que suspendamos el tratamiento en determinadas circunstancias.</li>
            <li><strong>Portabilidad</strong>: recibir sus datos en formato estructurado y de uso común.</li>
            <li><strong>Oposición</strong>: oponerse al tratamiento en determinadas circunstancias.</li>
        </ul>
        

        <h2>8. Menores de edad</h2>
        <p>En el caso de alumnos/as menores de 14 años, los datos son facilitados y el consentimiento prestado por sus padres o tutores legales, quienes asumen la responsabilidad de la veracidad de los datos aportados.</p>

        <h2>9. Medidas de seguridad</h2>
        <p>Arratiako Musika Eskola aplica las medidas técnicas y organizativas necesarias para garantizar la seguridad de los datos personales.</p>

    </div><!-- #privacy-es -->

</div>
</div>

<script>
(function(){
    var tabs  = document.querySelectorAll('.privacy-tab');
    var panels = { eu: document.getElementById('privacy-eu'), es: document.getElementById('privacy-es') };
    tabs.forEach(function(tab){
        tab.addEventListener('click', function(){
            tabs.forEach(function(t){ t.classList.remove('privacy-tab--active'); });
            tab.classList.add('privacy-tab--active');
            Object.keys(panels).forEach(function(k){ panels[k].style.display = 'none'; });
            panels[tab.dataset.lang].style.display = 'block';
        });
    });
})();
</script>

<?php get_footer(); ?>
