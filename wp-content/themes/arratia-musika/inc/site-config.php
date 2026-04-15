<?php
/**
 * Arratiako Musika Eskola — Konfigurazio nagusia
 *
 * Hemen aldatu behar dira web osoan eragina duten datu guztiak:
 * telefonoa, emaila, helbidea, sare sozialak, ordutegia, eta abar.
 *
 * ⚠️  Ez aldatu beste fitxategietan —  aldaketa guztiak hemen egin.
 */

// ─── Kontaktua ─────────────────────────────────────────────────────────────────

define( 'ARRATIA_TELEFONO',      '946 317 352' );
define( 'ARRATIA_TELEFONO_HREF', 'tel:+34946317352' );
define( 'ARRATIA_EMAIL',         'info@arratiakomusikaeskola.eu' );
define( 'ARRATIA_EMAIL_ADMIN',   'info@arratiakomusikaeskola.eu' );  // emailak jasotzen ditu

// ─── Helbidea ──────────────────────────────────────────────────────────────────

define( 'ARRATIA_HELBIDEA',      'Herriko Plaza 1 · 48142 Artea · Bizkaia' );
define( 'ARRATIA_HERRIA',        'Artea · Bizkaia' );

// ─── Sare sozialak ─────────────────────────────────────────────────────────────

define( 'ARRATIA_INSTAGRAM_URL',    'https://www.instagram.com/arratiakomusikaeskola/' );
define( 'ARRATIA_INSTAGRAM_HANDLE', '@arratiakomusikaeskola' );
define( 'ARRATIA_FACEBOOK_URL',     'https://www.facebook.com/arratiakomusikaeskola' );
define( 'ARRATIA_FACEBOOK_NAME',    'Arratiako Musika Eskola' );
define( 'ARRATIA_YOUTUBE_URL',      'https://www.youtube.com/@arratiakomusikaeskola' );  // aldatu zure kanalaren URLa
define( 'ARRATIA_YOUTUBE_NAME',     'Arratiako Musika Eskola' );

// ─── Ordutegia ─────────────────────────────────────────────────────────────────
// Hemen idatzi ordutegia erakusteko. Hutsik utzi erakutsi nahi ez bada.

define( 'ARRATIA_ORDUTEGIA', '' );   // adib. 'Al-Os: 16:00–21:00'

// ─── Ikasturte-data ────────────────────────────────────────────────────────────

define( 'ARRATIA_IKASTURTE',          '2025–2026' );
define( 'ARRATIA_MATRIKULA_HASIERA',  '' );   // adib. '2025-06-02'  (YYYY-MM-DD)
define( 'ARRATIA_MATRIKULA_BUKAERA',  '' );   // adib. '2025-06-30'
