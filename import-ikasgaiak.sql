-- ============================================================
-- Arratiako Musika Eskola — Import Ikasgaiak
-- ============================================================
USE arratiakomusikaeskolaweb;

-- Helper: insert ikasgai + meta
-- Fields: title, slug, kategoria, irakaslea, azalpena, ordena

-- ── TALDE TEORIKO-PRAKTIKOA ──────────────────────────────────

INSERT INTO wp_posts (post_title,post_name,post_status,post_type,post_content,post_excerpt,post_date,post_date_gmt,post_modified,post_modified_gmt,to_ping,pinged,post_content_filtered,menu_order)
VALUES ('Musikarekin Kontaktua','musikarekin-kontaktua','publish','ikasgai','','',NOW(),NOW(),NOW(),NOW(),'','','',1);
SET @id = LAST_INSERT_ID();
INSERT INTO wp_postmeta (post_id,meta_key,meta_value) VALUES
(@id,'_ikasgai_kategoria','Taldean Teoriko-Praktikoa'),
(@id,'_ikasgai_irakaslea','Elisa Rodriguez, Iratze de Cavia, Izaskun Arriaga, Mª Eugenia Okamika, Lara Sagastizabal'),
(@id,'_ikasgai_azalpena','4–7 urte. Musikaren lehen hurbilketa, mugimendua eta entzumena lantzeko.'),
(@id,'_ikasgai_ordena','1');

INSERT INTO wp_posts (post_title,post_name,post_status,post_type,post_content,post_excerpt,post_date,post_date_gmt,post_modified,post_modified_gmt,to_ping,pinged,post_content_filtered,menu_order)
VALUES ('Hizkuntza Musikala','hizkuntza-musikala','publish','ikasgai','','',NOW(),NOW(),NOW(),NOW(),'','','',2);
SET @id = LAST_INSERT_ID();
INSERT INTO wp_postmeta (post_id,meta_key,meta_value) VALUES
(@id,'_ikasgai_kategoria','Taldean Teoriko-Praktikoa'),
(@id,'_ikasgai_irakaslea','Iratze de Cavia, Izaskun Arriaga, Mª Eugenia Okamika, Lara Sagastizabal'),
(@id,'_ikasgai_azalpena','8–12 urte. Teoria eta solfeo, musika-irakurketa eta idazketa.'),
(@id,'_ikasgai_ordena','2');

-- ── TALDEAN (TALDEAK / ENSEMBLES) ───────────────────────────

INSERT INTO wp_posts (post_title,post_name,post_status,post_type,post_content,post_excerpt,post_date,post_date_gmt,post_modified,post_modified_gmt,to_ping,pinged,post_content_filtered,menu_order)
VALUES ('Gorbeia Ensemble','gorbeia-ensemble','publish','ikasgai','','',NOW(),NOW(),NOW(),NOW(),'','','',3);
SET @id = LAST_INSERT_ID();
INSERT INTO wp_postmeta (post_id,meta_key,meta_value) VALUES
(@id,'_ikasgai_kategoria','Taldean'),
(@id,'_ikasgai_irakaslea','Iban Agirregoikoa'),
(@id,'_ikasgai_azalpena','Orkestra taldea, maila ertainetik gorakoentzat.'),
(@id,'_ikasgai_ordena','3');

INSERT INTO wp_posts (post_title,post_name,post_status,post_type,post_content,post_excerpt,post_date,post_date_gmt,post_modified,post_modified_gmt,to_ping,pinged,post_content_filtered,menu_order)
VALUES ('Itxina Ensemble','itxina-ensemble','publish','ikasgai','','',NOW(),NOW(),NOW(),NOW(),'','','',4);
SET @id = LAST_INSERT_ID();
INSERT INTO wp_postmeta (post_id,meta_key,meta_value) VALUES
(@id,'_ikasgai_kategoria','Taldean'),
(@id,'_ikasgai_irakaslea','Iban Agirregoikoa'),
(@id,'_ikasgai_azalpena','Orkestra taldea, maila aurreratuentzat.'),
(@id,'_ikasgai_ordena','4');

INSERT INTO wp_posts (post_title,post_name,post_status,post_type,post_content,post_excerpt,post_date,post_date_gmt,post_modified,post_modified_gmt,to_ping,pinged,post_content_filtered,menu_order)
VALUES ('Konboak','konboak','publish','ikasgai','','',NOW(),NOW(),NOW(),NOW(),'','','',5);
SET @id = LAST_INSERT_ID();
INSERT INTO wp_postmeta (post_id,meta_key,meta_value) VALUES
(@id,'_ikasgai_kategoria','Taldean'),
(@id,'_ikasgai_irakaslea','Egoitz Espiña, Elisa Rodriguez, Iban Agirregoikoa, Kepa Pinedo'),
(@id,'_ikasgai_azalpena','Tresna ezberdinetako ikasleak, talde-musika lantzeko.'),
(@id,'_ikasgai_ordena','5');

INSERT INTO wp_posts (post_title,post_name,post_status,post_type,post_content,post_excerpt,post_date,post_date_gmt,post_modified,post_modified_gmt,to_ping,pinged,post_content_filtered,menu_order)
VALUES ('Trikitixa Taldea','trikitixa-taldea','publish','ikasgai','','',NOW(),NOW(),NOW(),NOW(),'','','',6);
SET @id = LAST_INSERT_ID();
INSERT INTO wp_postmeta (post_id,meta_key,meta_value) VALUES
(@id,'_ikasgai_kategoria','Taldean'),
(@id,'_ikasgai_irakaslea','Gaizka Peñafiel, Iñaki Plaza'),
(@id,'_ikasgai_azalpena','Trikitixa eta panderoa elkarrekin.'),
(@id,'_ikasgai_ordena','6');

INSERT INTO wp_posts (post_title,post_name,post_status,post_type,post_content,post_excerpt,post_date,post_date_gmt,post_modified,post_modified_gmt,to_ping,pinged,post_content_filtered,menu_order)
VALUES ('Akordeoi Taldea','akordeoi-taldea','publish','ikasgai','','',NOW(),NOW(),NOW(),NOW(),'','','',7);
SET @id = LAST_INSERT_ID();
INSERT INTO wp_postmeta (post_id,meta_key,meta_value) VALUES
(@id,'_ikasgai_kategoria','Taldean'),
(@id,'_ikasgai_irakaslea','Juan Ma'),
(@id,'_ikasgai_azalpena','Akordeoijoleak taldean.'),
(@id,'_ikasgai_ordena','7');

INSERT INTO wp_posts (post_title,post_name,post_status,post_type,post_content,post_excerpt,post_date,post_date_gmt,post_modified,post_modified_gmt,to_ping,pinged,post_content_filtered,menu_order)
VALUES ('Flauta Taldea','flauta-taldea','publish','ikasgai','','',NOW(),NOW(),NOW(),NOW(),'','','',8);
SET @id = LAST_INSERT_ID();
INSERT INTO wp_postmeta (post_id,meta_key,meta_value) VALUES
(@id,'_ikasgai_kategoria','Taldean'),
(@id,'_ikasgai_irakaslea','Egoitz Espiña'),
(@id,'_ikasgai_azalpena','Flautistak taldean.'),
(@id,'_ikasgai_ordena','8');

INSERT INTO wp_posts (post_title,post_name,post_status,post_type,post_content,post_excerpt,post_date,post_date_gmt,post_modified,post_modified_gmt,to_ping,pinged,post_content_filtered,menu_order)
VALUES ('Perkusio Taldea','perkusio-taldea','publish','ikasgai','','',NOW(),NOW(),NOW(),NOW(),'','','',9);
SET @id = LAST_INSERT_ID();
INSERT INTO wp_postmeta (post_id,meta_key,meta_value) VALUES
(@id,'_ikasgai_kategoria','Taldean'),
(@id,'_ikasgai_irakaslea','Ander Lekue'),
(@id,'_ikasgai_azalpena','Perkusio-taldea.'),
(@id,'_ikasgai_ordena','9');

INSERT INTO wp_posts (post_title,post_name,post_status,post_type,post_content,post_excerpt,post_date,post_date_gmt,post_modified,post_modified_gmt,to_ping,pinged,post_content_filtered,menu_order)
VALUES ('Ahotsa','ahotsa','publish','ikasgai','','',NOW(),NOW(),NOW(),NOW(),'','','',10);
SET @id = LAST_INSERT_ID();
INSERT INTO wp_postmeta (post_id,meta_key,meta_value) VALUES
(@id,'_ikasgai_kategoria','Taldean'),
(@id,'_ikasgai_irakaslea','Maria Navarro'),
(@id,'_ikasgai_azalpena','Ahots-taldea, abesbatza lanetan.'),
(@id,'_ikasgai_ordena','10');

INSERT INTO wp_posts (post_title,post_name,post_status,post_type,post_content,post_excerpt,post_date,post_date_gmt,post_modified,post_modified_gmt,to_ping,pinged,post_content_filtered,menu_order)
VALUES ('Kirikinusi Korua','kirikinusi-korua','publish','ikasgai','','',NOW(),NOW(),NOW(),NOW(),'','','',11);
SET @id = LAST_INSERT_ID();
INSERT INTO wp_postmeta (post_id,meta_key,meta_value) VALUES
(@id,'_ikasgai_kategoria','Taldean'),
(@id,'_ikasgai_irakaslea','Beatriz Zurimendi'),
(@id,'_ikasgai_azalpena','8–16 urte. Haurren abesbatza.'),
(@id,'_ikasgai_ordena','11');

INSERT INTO wp_posts (post_title,post_name,post_status,post_type,post_content,post_excerpt,post_date,post_date_gmt,post_modified,post_modified_gmt,to_ping,pinged,post_content_filtered,menu_order)
VALUES ('Helduen Korua','helduen-korua','publish','ikasgai','','',NOW(),NOW(),NOW(),NOW(),'','','',12);
SET @id = LAST_INSERT_ID();
INSERT INTO wp_postmeta (post_id,meta_key,meta_value) VALUES
(@id,'_ikasgai_kategoria','Taldean'),
(@id,'_ikasgai_irakaslea','Maria Navarro'),
(@id,'_ikasgai_azalpena','Helduen abesbatza.'),
(@id,'_ikasgai_ordena','12');

-- ── BAKARKA - SOKAZKO TRESNAK ────────────────────────────────

INSERT INTO wp_posts (post_title,post_name,post_status,post_type,post_content,post_excerpt,post_date,post_date_gmt,post_modified,post_modified_gmt,to_ping,pinged,post_content_filtered,menu_order)
VALUES ('Biolina','biolina','publish','ikasgai','','',NOW(),NOW(),NOW(),NOW(),'','','',13);
SET @id = LAST_INSERT_ID();
INSERT INTO wp_postmeta (post_id,meta_key,meta_value) VALUES
(@id,'_ikasgai_kategoria','Bakarka - Sokazko Tresnak'),
(@id,'_ikasgai_irakaslea','Izaskun Payas'),
(@id,'_ikasgai_azalpena',''),
(@id,'_ikasgai_ordena','1');

INSERT INTO wp_posts (post_title,post_name,post_status,post_type,post_content,post_excerpt,post_date,post_date_gmt,post_modified,post_modified_gmt,to_ping,pinged,post_content_filtered,menu_order)
VALUES ('Biolontxeloa','biolontxeloa','publish','ikasgai','','',NOW(),NOW(),NOW(),NOW(),'','','',14);
SET @id = LAST_INSERT_ID();
INSERT INTO wp_postmeta (post_id,meta_key,meta_value) VALUES
(@id,'_ikasgai_kategoria','Bakarka - Sokazko Tresnak'),
(@id,'_ikasgai_irakaslea','Elisa Rodriguez'),
(@id,'_ikasgai_azalpena',''),
(@id,'_ikasgai_ordena','2');

-- ── BAKARKA - HAIZEZKO TRESNAK ───────────────────────────────

INSERT INTO wp_posts (post_title,post_name,post_status,post_type,post_content,post_excerpt,post_date,post_date_gmt,post_modified,post_modified_gmt,to_ping,pinged,post_content_filtered,menu_order)
VALUES ('Flauta','flauta','publish','ikasgai','','',NOW(),NOW(),NOW(),NOW(),'','','',15);
SET @id = LAST_INSERT_ID();
INSERT INTO wp_postmeta (post_id,meta_key,meta_value) VALUES
(@id,'_ikasgai_kategoria','Bakarka - Haizezko Tresnak'),
(@id,'_ikasgai_irakaslea','Egoitz Espiña'),
(@id,'_ikasgai_azalpena',''),
(@id,'_ikasgai_ordena','1');

INSERT INTO wp_posts (post_title,post_name,post_status,post_type,post_content,post_excerpt,post_date,post_date_gmt,post_modified,post_modified_gmt,to_ping,pinged,post_content_filtered,menu_order)
VALUES ('Saxofoia','saxofoia','publish','ikasgai','','',NOW(),NOW(),NOW(),NOW(),'','','',16);
SET @id = LAST_INSERT_ID();
INSERT INTO wp_postmeta (post_id,meta_key,meta_value) VALUES
(@id,'_ikasgai_kategoria','Bakarka - Haizezko Tresnak'),
(@id,'_ikasgai_irakaslea','Kepa Pinedo, Raul Fernandez'),
(@id,'_ikasgai_azalpena',''),
(@id,'_ikasgai_ordena','2');

INSERT INTO wp_posts (post_title,post_name,post_status,post_type,post_content,post_excerpt,post_date,post_date_gmt,post_modified,post_modified_gmt,to_ping,pinged,post_content_filtered,menu_order)
VALUES ('Klarinetea','klarinetea','publish','ikasgai','','',NOW(),NOW(),NOW(),NOW(),'','','',17);
SET @id = LAST_INSERT_ID();
INSERT INTO wp_postmeta (post_id,meta_key,meta_value) VALUES
(@id,'_ikasgai_kategoria','Bakarka - Haizezko Tresnak'),
(@id,'_ikasgai_irakaslea','Jon Ander Arcenillas'),
(@id,'_ikasgai_azalpena',''),
(@id,'_ikasgai_ordena','3');

INSERT INTO wp_posts (post_title,post_name,post_status,post_type,post_content,post_excerpt,post_date,post_date_gmt,post_modified,post_modified_gmt,to_ping,pinged,post_content_filtered,menu_order)
VALUES ('Tronpeta','tronpeta','publish','ikasgai','','',NOW(),NOW(),NOW(),NOW(),'','','',18);
SET @id = LAST_INSERT_ID();
INSERT INTO wp_postmeta (post_id,meta_key,meta_value) VALUES
(@id,'_ikasgai_kategoria','Bakarka - Haizezko Tresnak'),
(@id,'_ikasgai_irakaslea','Maddi Txurruka'),
(@id,'_ikasgai_azalpena',''),
(@id,'_ikasgai_ordena','4');

-- ── BAKARKA - TEKLATU ETA KORDA ──────────────────────────────

INSERT INTO wp_posts (post_title,post_name,post_status,post_type,post_content,post_excerpt,post_date,post_date_gmt,post_modified,post_modified_gmt,to_ping,pinged,post_content_filtered,menu_order)
VALUES ('Akordeoia','akordeoia','publish','ikasgai','','',NOW(),NOW(),NOW(),NOW(),'','','',19);
SET @id = LAST_INSERT_ID();
INSERT INTO wp_postmeta (post_id,meta_key,meta_value) VALUES
(@id,'_ikasgai_kategoria','Bakarka - Teklatu eta Korda'),
(@id,'_ikasgai_irakaslea','Juan Ma'),
(@id,'_ikasgai_azalpena',''),
(@id,'_ikasgai_ordena','1');

INSERT INTO wp_posts (post_title,post_name,post_status,post_type,post_content,post_excerpt,post_date,post_date_gmt,post_modified,post_modified_gmt,to_ping,pinged,post_content_filtered,menu_order)
VALUES ('Pianoa','pianoa','publish','ikasgai','','',NOW(),NOW(),NOW(),NOW(),'','','',20);
SET @id = LAST_INSERT_ID();
INSERT INTO wp_postmeta (post_id,meta_key,meta_value) VALUES
(@id,'_ikasgai_kategoria','Bakarka - Teklatu eta Korda'),
(@id,'_ikasgai_irakaslea','Iban Agirregoikoa, Iratze de Cavia, Izaskun Arriaga, Mª Eugenia Okamika, Lara Sagastizabal, Victor Dominguez'),
(@id,'_ikasgai_azalpena',''),
(@id,'_ikasgai_ordena','2');

INSERT INTO wp_posts (post_title,post_name,post_status,post_type,post_content,post_excerpt,post_date,post_date_gmt,post_modified,post_modified_gmt,to_ping,pinged,post_content_filtered,menu_order)
VALUES ('Gitarra','gitarra','publish','ikasgai','','',NOW(),NOW(),NOW(),NOW(),'','','',21);
SET @id = LAST_INSERT_ID();
INSERT INTO wp_postmeta (post_id,meta_key,meta_value) VALUES
(@id,'_ikasgai_kategoria','Bakarka - Teklatu eta Korda'),
(@id,'_ikasgai_irakaslea','Luis Alberto Garcia, Jorge Sotres, Sergio Llamas'),
(@id,'_ikasgai_azalpena',''),
(@id,'_ikasgai_ordena','3');

INSERT INTO wp_posts (post_title,post_name,post_status,post_type,post_content,post_excerpt,post_date,post_date_gmt,post_modified,post_modified_gmt,to_ping,pinged,post_content_filtered,menu_order)
VALUES ('Gitarra Elektrikoa','gitarra-elektrikoa','publish','ikasgai','','',NOW(),NOW(),NOW(),NOW(),'','','',22);
SET @id = LAST_INSERT_ID();
INSERT INTO wp_postmeta (post_id,meta_key,meta_value) VALUES
(@id,'_ikasgai_kategoria','Bakarka - Teklatu eta Korda'),
(@id,'_ikasgai_irakaslea','Luis Alberto Garcia, Jorge Sotres, Sergio Llamas'),
(@id,'_ikasgai_azalpena',''),
(@id,'_ikasgai_ordena','4');

INSERT INTO wp_posts (post_title,post_name,post_status,post_type,post_content,post_excerpt,post_date,post_date_gmt,post_modified,post_modified_gmt,to_ping,pinged,post_content_filtered,menu_order)
VALUES ('Bajo Elektrikoa','bajo-elektrikoa','publish','ikasgai','','',NOW(),NOW(),NOW(),NOW(),'','','',23);
SET @id = LAST_INSERT_ID();
INSERT INTO wp_postmeta (post_id,meta_key,meta_value) VALUES
(@id,'_ikasgai_kategoria','Bakarka - Teklatu eta Korda'),
(@id,'_ikasgai_irakaslea','Luis Alberto Garcia, Jorge Sotres, Sergio Llamas'),
(@id,'_ikasgai_azalpena',''),
(@id,'_ikasgai_ordena','5');

-- ── BAKARKA - AHOTSA ─────────────────────────────────────────

INSERT INTO wp_posts (post_title,post_name,post_status,post_type,post_content,post_excerpt,post_date,post_date_gmt,post_modified,post_modified_gmt,to_ping,pinged,post_content_filtered,menu_order)
VALUES ('Kantua','kantua','publish','ikasgai','','',NOW(),NOW(),NOW(),NOW(),'','','',24);
SET @id = LAST_INSERT_ID();
INSERT INTO wp_postmeta (post_id,meta_key,meta_value) VALUES
(@id,'_ikasgai_kategoria','Bakarka - Ahotsa'),
(@id,'_ikasgai_irakaslea','Maria Navarro'),
(@id,'_ikasgai_azalpena',''),
(@id,'_ikasgai_ordena','1');

-- ── BAKARKA - PERKUSIO MODERNOA ──────────────────────────────

INSERT INTO wp_posts (post_title,post_name,post_status,post_type,post_content,post_excerpt,post_date,post_date_gmt,post_modified,post_modified_gmt,to_ping,pinged,post_content_filtered,menu_order)
VALUES ('Bateria','bateria','publish','ikasgai','','',NOW(),NOW(),NOW(),NOW(),'','','',25);
SET @id = LAST_INSERT_ID();
INSERT INTO wp_postmeta (post_id,meta_key,meta_value) VALUES
(@id,'_ikasgai_kategoria','Bakarka - Perkusio Modernoa'),
(@id,'_ikasgai_irakaslea','Ander Lekue, Unai Olabarri'),
(@id,'_ikasgai_azalpena',''),
(@id,'_ikasgai_ordena','1');

INSERT INTO wp_posts (post_title,post_name,post_status,post_type,post_content,post_excerpt,post_date,post_date_gmt,post_modified,post_modified_gmt,to_ping,pinged,post_content_filtered,menu_order)
VALUES ('Perkusioa','perkusioa','publish','ikasgai','','',NOW(),NOW(),NOW(),NOW(),'','','',26);
SET @id = LAST_INSERT_ID();
INSERT INTO wp_postmeta (post_id,meta_key,meta_value) VALUES
(@id,'_ikasgai_kategoria','Bakarka - Perkusio Modernoa'),
(@id,'_ikasgai_irakaslea','Ander Lekue'),
(@id,'_ikasgai_azalpena',''),
(@id,'_ikasgai_ordena','2');

-- ── BAKARKA - EUSKAL TRESNAK ─────────────────────────────────

INSERT INTO wp_posts (post_title,post_name,post_status,post_type,post_content,post_excerpt,post_date,post_date_gmt,post_modified,post_modified_gmt,to_ping,pinged,post_content_filtered,menu_order)
VALUES ('Alboka','alboka','publish','ikasgai','','',NOW(),NOW(),NOW(),NOW(),'','','',27);
SET @id = LAST_INSERT_ID();
INSERT INTO wp_postmeta (post_id,meta_key,meta_value) VALUES
(@id,'_ikasgai_kategoria','Bakarka - Euskal Tresnak'),
(@id,'_ikasgai_irakaslea','Asier Gonzalez'),
(@id,'_ikasgai_azalpena',''),
(@id,'_ikasgai_ordena','1');

INSERT INTO wp_posts (post_title,post_name,post_status,post_type,post_content,post_excerpt,post_date,post_date_gmt,post_modified,post_modified_gmt,to_ping,pinged,post_content_filtered,menu_order)
VALUES ('Panderoa','panderoa','publish','ikasgai','','',NOW(),NOW(),NOW(),NOW(),'','','',28);
SET @id = LAST_INSERT_ID();
INSERT INTO wp_postmeta (post_id,meta_key,meta_value) VALUES
(@id,'_ikasgai_kategoria','Bakarka - Euskal Tresnak'),
(@id,'_ikasgai_irakaslea','Iñaki Plaza'),
(@id,'_ikasgai_azalpena',''),
(@id,'_ikasgai_ordena','2');

INSERT INTO wp_posts (post_title,post_name,post_status,post_type,post_content,post_excerpt,post_date,post_date_gmt,post_modified,post_modified_gmt,to_ping,pinged,post_content_filtered,menu_order)
VALUES ('Trikitixa','trikitixa','publish','ikasgai','','',NOW(),NOW(),NOW(),NOW(),'','','',29);
SET @id = LAST_INSERT_ID();
INSERT INTO wp_postmeta (post_id,meta_key,meta_value) VALUES
(@id,'_ikasgai_kategoria','Bakarka - Euskal Tresnak'),
(@id,'_ikasgai_irakaslea','Gaizka Peñafiel, Iñaki Plaza'),
(@id,'_ikasgai_azalpena',''),
(@id,'_ikasgai_ordena','3');

INSERT INTO wp_posts (post_title,post_name,post_status,post_type,post_content,post_excerpt,post_date,post_date_gmt,post_modified,post_modified_gmt,to_ping,pinged,post_content_filtered,menu_order)
VALUES ('Txistua','txistua','publish','ikasgai','','',NOW(),NOW(),NOW(),NOW(),'','','',30);
SET @id = LAST_INSERT_ID();
INSERT INTO wp_postmeta (post_id,meta_key,meta_value) VALUES
(@id,'_ikasgai_kategoria','Bakarka - Euskal Tresnak'),
(@id,'_ikasgai_irakaslea','Iker Sagala'),
(@id,'_ikasgai_azalpena',''),
(@id,'_ikasgai_ordena','4');

SELECT COUNT(*) as total_ikasgaiak FROM wp_posts WHERE post_type='ikasgai' AND post_status='publish';
