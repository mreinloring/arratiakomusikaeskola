SET NAMES utf8mb4;
SET sql_mode = '';

-- ── 1. Ikasurtea terms ────────────────────────────────────────
INSERT IGNORE INTO wp_terms (term_id, name, slug, term_group) VALUES
  (50, '2025/2026', '2025-2026', 0),
  (51, '2024/2025', '2024-2025', 0),
  (52, '2023/2024', '2023-2024', 0),
  (53, '2022/2023', '2022-2023', 0);

INSERT IGNORE INTO wp_term_taxonomy (term_taxonomy_id, term_id, taxonomy, description, parent, count) VALUES
  (50, 50, 'ikasurtea', '', 0, 0),
  (51, 51, 'ikasurtea', '', 0, 0),
  (52, 52, 'ikasurtea', '', 0, 0),
  (53, 53, 'ikasurtea', '', 0, 0);

-- ── 2. Posts ──────────────────────────────────────────────────
INSERT IGNORE INTO wp_posts
  (ID, post_author, post_date, post_date_gmt, post_content, post_title, post_excerpt,
   post_status, comment_status, ping_status, post_name, post_type,
   post_modified, post_modified_gmt, to_ping, pinged, post_content_filtered)
VALUES
-- 2025/2026
(5270,1,'2026-04-19 10:00:00','2026-04-19 08:00:00','','EGUZKILORE 2026','','publish','closed','closed','eguzkilore-2026','ekintza',NOW(),NOW(),'','',''),
(5271,1,'2026-04-17 10:00:00','2026-04-17 08:00:00','Apirilaren 17tik 19ra Tarragonako Musika Eskolakoek bisitan etorriko dira eta hainbat ekintza prestatu ditugu eurekin egiteko.','ELKARTRUKE 2026','','publish','closed','closed','elkartruke-2026','ekintza',NOW(),NOW(),'','',''),
(5272,1,'2026-04-10 10:00:00','2026-04-10 08:00:00','Oingo barikuan, Bixer tabernan urteko kontzertua eskeiniko dute gure ikasle nagusienak. 19:30etan izango da eta giro aparta egongo da!','NAGUSIEN KONTZERTUA','','publish','closed','closed','nagusien-kontzertua-2026','ekintza',NOW(),NOW(),'','',''),
(5273,1,'2026-03-27 08:00:00','2026-03-27 06:00:00','Korrika Arratiara heltzen da martxoaren 27an goizeko 8etan eta Arratiko Musika Eskolak lekukoa hartuko dau Bedian 2478. kilometroan.','KORRIKA 2026','','publish','closed','closed','korrika-2026','ekintza',NOW(),NOW(),'','',''),
(5274,1,'2026-03-14 17:00:00','2026-03-14 15:00:00','Martxoaren 14an Ipuin Musikala eskainiko dugu 17:00etan eta 19:00etan.','IPUIN MUSIKALA 2026','','publish','closed','closed','ipuin-musikala-2026','ekintza',NOW(),NOW(),'','',''),
(5275,1,'2026-03-08 10:00:00','2026-03-08 08:00:00','','EHU 2026 - Martxoaren 8a','','publish','closed','closed','ehu-2026-martxoa','ekintza',NOW(),NOW(),'','',''),
(5276,1,'2025-12-20 10:00:00','2025-12-20 08:00:00','','ETZANDERAK AGURRA','','publish','closed','closed','etzanderak-agurra','ekintza',NOW(),NOW(),'','',''),
-- 2024/2025
(5280,1,'2025-04-20 10:00:00','2025-04-20 08:00:00','','EGUZKILORE 2025','','publish','closed','closed','eguzkilore-2025','ekintza',NOW(),NOW(),'','',''),
(5281,1,'2025-04-10 10:00:00','2025-04-10 08:00:00','','ELKARTRUKE 2025','','publish','closed','closed','elkartruke-2025','ekintza',NOW(),NOW(),'','',''),
(5282,1,'2025-03-20 10:00:00','2025-03-20 08:00:00','','UPV-EHU 2025','','publish','closed','closed','upv-ehu-2025','ekintza',NOW(),NOW(),'','',''),
(5283,1,'2025-03-14 17:00:00','2025-03-14 15:00:00','','IPUIN MUSIKALA 2025','','publish','closed','closed','ipuin-musikala-2025','ekintza',NOW(),NOW(),'','',''),
(5284,1,'2025-02-10 10:00:00','2025-02-10 08:00:00','','GOAZEN SOLASALDIA','','publish','closed','closed','goazen-solasaldia','ekintza',NOW(),NOW(),'','',''),
(5285,1,'2025-06-10 10:00:00','2025-06-10 08:00:00','','HELDUEN KONTZERTUA 2025','','publish','closed','closed','helduen-kontzertua-2025','ekintza',NOW(),NOW(),'','',''),
-- 2023/2024
(5290,1,'2024-04-20 10:00:00','2024-04-20 08:00:00','','EGUZKILORE 2024','','publish','closed','closed','eguzkilore-2024','ekintza',NOW(),NOW(),'','',''),
(5291,1,'2024-03-14 17:00:00','2024-03-14 15:00:00','','IPUIN MUSIKALA 2024','','publish','closed','closed','ipuin-musikala-2024','ekintza',NOW(),NOW(),'','',''),
(5292,1,'2024-06-10 10:00:00','2024-06-10 08:00:00','','KONTZERTUAK 2024','','publish','closed','closed','kontzertuak-2024','ekintza',NOW(),NOW(),'','',''),
-- 2022/2023
(5295,1,'2023-04-20 10:00:00','2023-04-20 08:00:00','','EGUZKILORE 2023','','publish','closed','closed','eguzkilore-2023','ekintza',NOW(),NOW(),'','',''),
(5296,1,'2023-06-10 10:00:00','2023-06-10 08:00:00','','KONTZERTUAK 2023','','publish','closed','closed','kontzertuak-2023','ekintza',NOW(),NOW(),'','','');

-- ── 3. Post meta ─────────────────────────────────────────────
INSERT IGNORE INTO wp_postmeta (post_id, meta_key, meta_value) VALUES
(5273,'_ekintza_argazkiak','https://photos.app.goo.gl/kqkgG4wVCJStmmnE6'),
(5273,'_ekintza_bideoa','https://photos.app.goo.gl/2Y8Le9coXmdHdDm2A'),
(5274,'_ekintza_argazkiak','https://photos.app.goo.gl/fcfiTNaHaq79AFm38'),
(5274,'_ekintza_bideoa','https://youtu.be/UUEGZ-z6mbM'),
(5275,'_ekintza_argazkiak','https://photos.app.goo.gl/6iaVxgLuRzdcxUnL7'),
(5276,'_ekintza_argazkiak','https://photos.app.goo.gl/omF82MTgVUpZkV1h8'),
(5281,'_ekintza_argazkiak','https://photos.app.goo.gl/kgRJahkZ3gPUnaY5A'),
(5283,'_ekintza_argazkiak','https://photos.app.goo.gl/ckRfo4Vxto5TgkCp8'),
(5284,'_ekintza_argazkiak','https://photos.app.goo.gl/uRX9STsBGTTdkGL48'),
(5285,'_ekintza_argazkiak','https://photos.app.goo.gl/HN3mLa1KTV469vz56'),
(5282,'_ekintza_argazkiak','https://photos.app.goo.gl/szpisiQYfzWi9BGg9');

-- ── 4. Ikasurtea relationships ────────────────────────────────
INSERT IGNORE INTO wp_term_relationships (object_id, term_taxonomy_id, term_order) VALUES
(5270,50,0),(5271,50,0),(5272,50,0),(5273,50,0),(5274,50,0),(5275,50,0),(5276,50,0),
(5280,51,0),(5281,51,0),(5282,51,0),(5283,51,0),(5284,51,0),(5285,51,0),
(5290,52,0),(5291,52,0),(5292,52,0),
(5295,53,0),(5296,53,0);

-- ── 5. Hilabetea relationships ────────────────────────────────
-- apirila=34, martxoa=30, abendua=24, ekaina=39, otsaila=29
INSERT IGNORE INTO wp_term_relationships (object_id, term_taxonomy_id, term_order) VALUES
(5270,34,0),(5271,34,0),(5272,34,0),
(5273,30,0),(5274,30,0),(5275,30,0),
(5276,24,0),
(5280,34,0),(5281,34,0),(5282,30,0),
(5283,30,0),(5284,29,0),(5285,39,0),
(5290,34,0),(5291,30,0),(5292,39,0),
(5295,34,0),(5296,39,0);

-- ── 6. Update counts ─────────────────────────────────────────
UPDATE wp_term_taxonomy SET count = (
  SELECT COUNT(*) FROM wp_term_relationships WHERE term_taxonomy_id = wp_term_taxonomy.term_taxonomy_id
) WHERE taxonomy IN ('ikasurtea','hilabetea');
