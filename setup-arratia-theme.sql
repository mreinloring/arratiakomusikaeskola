-- ============================================================
-- Arratiako Musika Eskola — Theme Setup SQL
-- Run this with Laragon running (start Laragon first!)
-- Usage: from Laragon HeidiSQL or phpMyAdmin
-- ============================================================

USE arratiakomusikaeskolaweb;

-- 1. Activate the new theme
UPDATE wp_options SET option_value = 'arratia-musika' WHERE option_name = 'template';
UPDATE wp_options SET option_value = 'arratia-musika' WHERE option_name = 'stylesheet';

-- 2. Create required pages if they don't exist
-- (only inserts if slug doesn't already exist)

-- Hasiera (front page)
INSERT IGNORE INTO wp_posts (post_title, post_name, post_status, post_type, post_content, post_date, post_date_gmt, post_modified, post_modified_gmt, to_ping, pinged, post_content_filtered)
SELECT 'Hasiera','hasiera','publish','page','',NOW(),NOW(),NOW(),NOW(),'','',''
WHERE NOT EXISTS (SELECT 1 FROM wp_posts WHERE post_name='hasiera' AND post_type='page' AND post_status='publish');

-- Ikasgaiak
INSERT IGNORE INTO wp_posts (post_title, post_name, post_status, post_type, post_content, post_date, post_date_gmt, post_modified, post_modified_gmt, to_ping, pinged, post_content_filtered)
SELECT 'Ikasgaiak','ikasgaiak','publish','page','',NOW(),NOW(),NOW(),NOW(),'','',''
WHERE NOT EXISTS (SELECT 1 FROM wp_posts WHERE post_name='ikasgaiak' AND post_type='page' AND post_status='publish');

-- Ekintzak
INSERT IGNORE INTO wp_posts (post_title, post_name, post_status, post_type, post_content, post_date, post_date_gmt, post_modified, post_modified_gmt, to_ping, pinged, post_content_filtered)
SELECT 'Ekintzak','ekintzak','publish','page','',NOW(),NOW(),NOW(),NOW(),'','',''
WHERE NOT EXISTS (SELECT 1 FROM wp_posts WHERE post_name='ekintzak' AND post_type='page' AND post_status='publish');

-- Matrikulazioa
INSERT IGNORE INTO wp_posts (post_title, post_name, post_status, post_type, post_content, post_date, post_date_gmt, post_modified, post_modified_gmt, to_ping, pinged, post_content_filtered)
SELECT 'Matrikulazioa','matrikulazioa','publish','page','',NOW(),NOW(),NOW(),NOW(),'','',''
WHERE NOT EXISTS (SELECT 1 FROM wp_posts WHERE post_name='matrikulazioa' AND post_type='page' AND post_status='publish');

-- Matrikula Eskaera
INSERT IGNORE INTO wp_posts (post_title, post_name, post_status, post_type, post_content, post_date, post_date_gmt, post_modified, post_modified_gmt, to_ping, pinged, post_content_filtered)
SELECT 'Matrikula Eskaera','matrikula-eskaera','publish','page','',NOW(),NOW(),NOW(),NOW(),'','',''
WHERE NOT EXISTS (SELECT 1 FROM wp_posts WHERE post_name='matrikula-eskaera' AND post_type='page' AND post_status='publish');

-- Nortzuk gara
INSERT IGNORE INTO wp_posts (post_title, post_name, post_status, post_type, post_content, post_date, post_date_gmt, post_modified, post_modified_gmt, to_ping, pinged, post_content_filtered)
SELECT 'Nortzuk gara','nortzuk-gara','publish','page','',NOW(),NOW(),NOW(),NOW(),'','',''
WHERE NOT EXISTS (SELECT 1 FROM wp_posts WHERE post_name='nortzuk-gara' AND post_type='page' AND post_status='publish');

-- Kontaktua
INSERT IGNORE INTO wp_posts (post_title, post_name, post_status, post_type, post_content, post_date, post_date_gmt, post_modified, post_modified_gmt, to_ping, pinged, post_content_filtered)
SELECT 'Kontaktua','kontaktua','publish','page','',NOW(),NOW(),NOW(),NOW(),'','',''
WHERE NOT EXISTS (SELECT 1 FROM wp_posts WHERE post_name='kontaktua' AND post_type='page' AND post_status='publish');

-- 3. Assign page templates using postmeta
-- Get page IDs and set _wp_page_template

-- Ikasgaiak template
UPDATE wp_postmeta pm
JOIN wp_posts p ON p.ID = pm.post_id
SET pm.meta_value = 'page-ikasgaiak.php'
WHERE p.post_name = 'ikasgaiak' AND p.post_type = 'page' AND pm.meta_key = '_wp_page_template';

INSERT INTO wp_postmeta (post_id, meta_key, meta_value)
SELECT p.ID, '_wp_page_template', 'page-ikasgaiak.php'
FROM wp_posts p
WHERE p.post_name = 'ikasgaiak' AND p.post_type = 'page'
AND NOT EXISTS (SELECT 1 FROM wp_postmeta pm WHERE pm.post_id = p.ID AND pm.meta_key = '_wp_page_template');

-- Ekintzak template
UPDATE wp_postmeta pm
JOIN wp_posts p ON p.ID = pm.post_id
SET pm.meta_value = 'page-ekintzak.php'
WHERE p.post_name = 'ekintzak' AND p.post_type = 'page' AND pm.meta_key = '_wp_page_template';

INSERT INTO wp_postmeta (post_id, meta_key, meta_value)
SELECT p.ID, '_wp_page_template', 'page-ekintzak.php'
FROM wp_posts p
WHERE p.post_name = 'ekintzak' AND p.post_type = 'page'
AND NOT EXISTS (SELECT 1 FROM wp_postmeta pm WHERE pm.post_id = p.ID AND pm.meta_key = '_wp_page_template');

-- Matrikulazioa template
UPDATE wp_postmeta pm
JOIN wp_posts p ON p.ID = pm.post_id
SET pm.meta_value = 'page-matrikulazioa.php'
WHERE p.post_name = 'matrikulazioa' AND p.post_type = 'page' AND pm.meta_key = '_wp_page_template';

INSERT INTO wp_postmeta (post_id, meta_key, meta_value)
SELECT p.ID, '_wp_page_template', 'page-matrikulazioa.php'
FROM wp_posts p
WHERE p.post_name = 'matrikulazioa' AND p.post_type = 'page'
AND NOT EXISTS (SELECT 1 FROM wp_postmeta pm WHERE pm.post_id = p.ID AND pm.meta_key = '_wp_page_template');

-- Matrikula Eskaera template
UPDATE wp_postmeta pm
JOIN wp_posts p ON p.ID = pm.post_id
SET pm.meta_value = 'page-matrikula-eskaera.php'
WHERE p.post_name = 'matrikula-eskaera' AND p.post_type = 'page' AND pm.meta_key = '_wp_page_template';

INSERT INTO wp_postmeta (post_id, meta_key, meta_value)
SELECT p.ID, '_wp_page_template', 'page-matrikula-eskaera.php'
FROM wp_posts p
WHERE p.post_name = 'matrikula-eskaera' AND p.post_type = 'page'
AND NOT EXISTS (SELECT 1 FROM wp_postmeta pm WHERE pm.post_id = p.ID AND pm.meta_key = '_wp_page_template');

-- Nortzuk gara template
UPDATE wp_postmeta pm
JOIN wp_posts p ON p.ID = pm.post_id
SET pm.meta_value = 'page-nortzuk-gara.php'
WHERE p.post_name = 'nortzuk-gara' AND p.post_type = 'page' AND pm.meta_key = '_wp_page_template';

INSERT INTO wp_postmeta (post_id, meta_key, meta_value)
SELECT p.ID, '_wp_page_template', 'page-nortzuk-gara.php'
FROM wp_posts p
WHERE p.post_name = 'nortzuk-gara' AND p.post_type = 'page'
AND NOT EXISTS (SELECT 1 FROM wp_postmeta pm WHERE pm.post_id = p.ID AND pm.meta_key = '_wp_page_template');

-- Kontaktua template
UPDATE wp_postmeta pm
JOIN wp_posts p ON p.ID = pm.post_id
SET pm.meta_value = 'page-kontaktua.php'
WHERE p.post_name = 'kontaktua' AND p.post_type = 'page' AND pm.meta_key = '_wp_page_template';

INSERT INTO wp_postmeta (post_id, meta_key, meta_value)
SELECT p.ID, '_wp_page_template', 'page-kontaktua.php'
FROM wp_posts p
WHERE p.post_name = 'kontaktua' AND p.post_type = 'page'
AND NOT EXISTS (SELECT 1 FROM wp_postmeta pm WHERE pm.post_id = p.ID AND pm.meta_key = '_wp_page_template');

-- 4. Set front page as static page (Hasiera)
UPDATE wp_options SET option_value = 'page' WHERE option_name = 'show_on_front';
UPDATE wp_options SET option_value = (
    SELECT ID FROM wp_posts WHERE post_name = 'hasiera' AND post_type = 'page' AND post_status = 'publish' LIMIT 1
) WHERE option_name = 'page_on_front';

-- 5. Enable matrikula (open)
INSERT INTO wp_options (option_name, option_value, autoload)
VALUES ('arratia_matrikula_open', '1', 'yes')
ON DUPLICATE KEY UPDATE option_value = '1';

-- Done!
SELECT 'Theme setup complete!' AS result;
SELECT option_name, option_value FROM wp_options WHERE option_name IN ('template','stylesheet','show_on_front');
