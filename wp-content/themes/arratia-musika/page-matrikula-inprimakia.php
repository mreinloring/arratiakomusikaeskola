<?php
/**
 * Template Name: Matrikula Inprimakia (Imprimible)
 */

// Solo usuarios con sesión iniciada
if ( ! is_user_logged_in() ) {
    wp_redirect( wp_login_url( get_permalink() ) );
    exit;
}

$logo_url = content_url( 'uploads/2023/06/LogoArratia-1.jpg' );

// Año académico
$now      = new DateTime();
$cur_yr   = (int) $now->format('Y');
$cur_mo   = (int) $now->format('n');
$ref_year = ( $cur_mo >= 3 ) ? $cur_yr : $cur_yr - 1;
$ikasturtea = $ref_year . '/' . ( $ref_year + 1 );
?><!DOCTYPE html>
<html lang="eu">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Arratia — Matrikula Inprimakia <?php echo esc_html($ikasturtea); ?></title>
<style>
  * { box-sizing: border-box; margin: 0; padding: 0; }
  body { font-family: Arial, sans-serif; font-size: 10pt; color: #111; background: #fff; }
  @page { size: A4; margin: 12mm 14mm; }
  @media print { .no-print { display: none !important; } body { font-size: 9.5pt; } }

  .no-print { text-align: center; padding: 10px; background: #f8f8f8; border-bottom: 1px solid #ddd; }
  .no-print button { padding: 8px 24px; background: #007B81; color: #fff; border: none;
                     border-radius: 4px; font-size: 13px; cursor: pointer; margin-right: 8px; }
  .no-print a { font-size: 12px; color: #888; text-decoration: none; }

  .wrap { padding: 10mm 12mm; max-width: 210mm; margin: 0 auto; }
  .header { display: flex; align-items: center; gap: 14px; border-bottom: 3px solid #007B81;
            padding-bottom: 8px; margin-bottom: 10px; }
  .header img { height: 60px; width: auto; }
  .header-text h1 { font-size: 14pt; color: #111; }
  .header-text h2 { font-size: 10.5pt; font-weight: normal; color: #555; }
  .header-text .curso { font-size: 8.5pt; color: #888; margin-top: 2px; }

  .section { margin-bottom: 9px; }
  .section-title { background: #007B81; color: #fff; font-weight: bold; font-size: 8.5pt;
                   padding: 3px 8px; margin-bottom: 5px; }

  .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 5px 14px; }
  .full { grid-column: 1 / -1; }

  .field { display: flex; flex-direction: column; }
  .field label { font-size: 7pt; color: #555; margin-bottom: 1px; }
  .field .line { border: none; border-bottom: 1px solid #999; height: 16px; width: 100%; }
  .field small { font-size: 6.5pt; color: #aaa; }

  .check-group { display: flex; flex-wrap: wrap; gap: 5px 12px; margin-top: 3px; }
  .check-group label { display: flex; align-items: center; gap: 3px; font-size: 8pt; }
  .check-group input[type="checkbox"] { width: 10px; height: 10px; }

  .sign-row { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-top: 8px; }
  .sign-box { border-bottom: 1px solid #999; height: 26px; }
  .sign-label { font-size: 7pt; color: #555; margin-top: 2px; }

  .legal { font-size: 6.5pt; color: #666; border: 1px solid #ddd; padding: 4px 6px;
           background: #fafafa; margin-top: 3px; line-height: 1.4; }
  .req { color: #007B81; }
  .footer-note { font-size: 7pt; color: #aaa; text-align: center; margin-top: 8px; }
</style>
</head>
<body>

<div class="no-print">
  <button onclick="window.print()">&#128438; Inprimatu / Imprimir</button>
  <a href="<?php echo esc_url( get_permalink() ); ?>">&#8635; Freskatu</a>
</div>

<div class="wrap">

<div class="header">
  <img src="<?php echo esc_url($logo_url); ?>" alt="Arratiako Musika Eskola">
  <div class="header-text">
    <h1>ARRATIAKO MUSIKA ESKOLA</h1>
    <h2>Matrikula Eskaera &nbsp;/&nbsp; Solicitud de Matrícula</h2>
    <div class="curso">Ikasturtea / Curso: <strong><?php echo esc_html($ikasturtea); ?></strong></div>
  </div>
</div>

<!-- 1. IKASLEAREN DATUAK -->
<div class="section">
  <div class="section-title">1. IKASLEAREN DATUAK &nbsp;/&nbsp; DATOS DEL ALUMNO/A</div>
  <div class="grid-2">
    <div class="field"><label>Izena <span class="req">*</span> / Nombre</label><div class="line"></div></div>
    <div class="field"><label>1. Abizena <span class="req">*</span> / Apellido 1</label><div class="line"></div></div>
    <div class="field"><label>2. Abizena <span class="req">*</span> / Apellido 2</label><div class="line"></div></div>
    <div class="field">
      <label>Jaiotze Data <span class="req">*</span> / Fecha de Nacimiento</label>
      <div class="line"></div><small>AAAA/HH/EE — AAAA/MM/DD</small>
    </div>
    <div class="field full"><label>Helbidea <span class="req">*</span> / Dirección</label><div class="line"></div></div>
    <div class="field full"><label>Udalerria <span class="req">*</span> / Municipio</label><div class="line"></div></div>
    <div class="field full"><label>Gurasoen / Tutoreen izenak / Nombre padres/tutores</label><div class="line"></div></div>
    <div class="field"><label>1. Telefonoa <span class="req">*</span> / Teléfono 1</label><div class="line"></div></div>
    <div class="field"><label>2. Telefonoa / Teléfono 2</label><div class="line"></div></div>
    <div class="field"><label>E-posta <span class="req">*</span> / Email</label><div class="line"></div></div>
    <div class="field"><label>2. E-posta / Email 2</label><div class="line"></div></div>
  </div>
</div>

<!-- 2. BANKUKO DATUAK -->
<div class="section">
  <div class="section-title">2. BANKUKO DATUAK &nbsp;/&nbsp; DATOS BANCARIOS</div>
  <div class="grid-2">
    <div class="field full">
      <label>IBAN <span class="req">*</span> &nbsp;<small>(ES__ ____ ____ ____ ____ ____)</small></label>
      <div class="line"></div>
    </div>
    <div class="field full"><label>Kontuaren Titularra <span class="req">*</span> / Titular de la cuenta</label><div class="line"></div></div>
  </div>
</div>

<!-- 3. MATRIKULA DATUAK -->
<div class="section">
  <div class="section-title">3. MATRIKULARAKO DATUAK &nbsp;/&nbsp; DATOS DE MATRÍCULA</div>
  <div style="margin-bottom:5px;">
    <div style="font-size:7.5pt;font-weight:bold;margin-bottom:2px;">Adina / Maila <span class="req">*</span> / Edad / Nivel</div>
    <div class="check-group">
      <label><input type="checkbox"> <strong>4–6 urte</strong> — Musika &amp; Mugimendua (HH4–LH1)</label>
      <label><input type="checkbox"> <strong>7 urte</strong> — Musika &amp; Mugimendua + Tresna aukera (LH2)</label>
      <label><input type="checkbox"> <strong>8–12 urte</strong> — Hizkuntza Musikala + Abesbatza + Tresna (LH3–LH6)</label>
      <label><input type="checkbox"> <strong>13+ urte</strong></label>
    </div>
  </div>
  <div class="grid-2">
    <div class="field">
      <label>Ikasgaia / Asignatura <em style="font-size:6.5pt;">(13+ urte)</em></label>
      <div class="check-group">
        <label><input type="checkbox"> Tresna bakarrik / Solo instrumento</label>
        <label><input type="checkbox"> Hizkuntza Musikala + Abesbatza</label>
        <label><input type="checkbox"> Hizkuntza Musikala (16 urtetik gora)</label>
        <label><input type="checkbox"> Armonia Modernoa (16 urtetik gora)</label>
      </div>
    </div>
    <div class="field">
      <label>Instrumentua <span class="req">*</span> / Instrumento <em style="font-size:6.5pt;">(8+ urte)</em></label>
      <div class="line"></div>
      <small>Akordeoia · Bateria · Biolina · Gitarra · Klarinete · Panderoa · Piano · Saxofoi · Trikirtixa · Tronboi · Tronpeta · Txalaparta · Txistu · Txirula · Beste bat</small>
    </div>
    <div class="field"><label>Ikastetxearen Izena / Centro escolar</label><div class="line"></div></div>
    <div class="field">
      <label>Ikasle mota <span class="req">*</span></label>
      <div class="check-group" style="margin-top:4px;">
        <label><input type="checkbox"> Ikasle berria / Alumno nuevo</label>
        <label><input type="checkbox"> Ikasle ohia / Ex alumno</label>
      </div>
    </div>
  </div>
</div>

<!-- 4. ARGAZKI BAIMENA -->
<div class="section">
  <div class="section-title">4. ARGAZKI BAIMENA &nbsp;/&nbsp; AUTORIZACIÓN FOTOGRAFÍAS</div>
  <div class="legal">Arratiako Musika Eskolak ateratako argazki eta bideoak erabiltzeko baimena eskatzen da, beti ere hezkuntza helburuarekin. / Se solicita autorización para el uso de fotografías y vídeos con fines educativos.</div>
  <div class="check-group" style="margin-top:4px;">
    <label><input type="checkbox"> <strong>Baimena ematen da / Sí autorizo</strong></label>
    <label><input type="checkbox"> <strong>Ez da baimenik ematen / No autorizo</strong></label>
  </div>
</div>

<!-- 5. PRIBATUTASUN POLITIKA -->
<div class="section">
  <div class="section-title">5. PRIBATUTASUN POLITIKA &nbsp;/&nbsp; POLÍTICA DE PRIVACIDAD</div>
  <div class="legal">Datu pertsonalen babesa eta pribatutasun politika irakurri eta onartzen dudala ziurtatzen dut. / He leído y acepto la política de privacidad y protección de datos.</div>
  <div class="check-group" style="margin-top:4px;">
    <label><input type="checkbox"> <strong>Onartu / Acepto <span class="req">*</span></strong></label>
  </div>
</div>

<!-- SINADURA -->
<div class="sign-row">
  <div><div class="sign-box"></div><div class="sign-label">Tokia eta data / Lugar y fecha</div></div>
  <div><div class="sign-box"></div><div class="sign-label">Sinadura / Firma (guraso/tutore edo ikaslea)</div></div>
</div>

<div class="footer-note">Arratiako Musika Eskola · www.arratiakomusikaeskola.eus</div>

</div><!-- .wrap -->
</body>
</html>
