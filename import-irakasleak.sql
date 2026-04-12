USE arratiakomusikaeskolaweb;

-- IRAKASLEAK

INSERT INTO wp_posts (post_title,post_name,post_status,post_type,post_content,post_excerpt,post_date,post_date_gmt,post_modified,post_modified_gmt,to_ping,pinged,post_content_filtered,menu_order) VALUES ('Raul Fernandez','raul-fernandez','publish','irakaslea','','',NOW(),NOW(),NOW(),NOW(),'','','',1);
SET @id=LAST_INSERT_ID(); INSERT INTO wp_postmeta(post_id,meta_key,meta_value) VALUES (@id,'_irakaslea_ikasgaiak','Saxofoia'),(@id,'_irakaslea_rola','irakaslea'),(@id,'_irakaslea_kargua','');

INSERT INTO wp_posts (post_title,post_name,post_status,post_type,post_content,post_excerpt,post_date,post_date_gmt,post_modified,post_modified_gmt,to_ping,pinged,post_content_filtered,menu_order) VALUES ('Maddi Txurruka','maddi-txurruka','publish','irakaslea','','',NOW(),NOW(),NOW(),NOW(),'','','',2);
SET @id=LAST_INSERT_ID(); INSERT INTO wp_postmeta(post_id,meta_key,meta_value) VALUES (@id,'_irakaslea_ikasgaiak','Tronpeta\nTronboia'),(@id,'_irakaslea_rola','irakaslea'),(@id,'_irakaslea_kargua','');

INSERT INTO wp_posts (post_title,post_name,post_status,post_type,post_content,post_excerpt,post_date,post_date_gmt,post_modified,post_modified_gmt,to_ping,pinged,post_content_filtered,menu_order) VALUES ('Jon Ander Arcenillas','jon-ander-arcenillas','publish','irakaslea','','',NOW(),NOW(),NOW(),NOW(),'','','',3);
SET @id=LAST_INSERT_ID(); INSERT INTO wp_postmeta(post_id,meta_key,meta_value) VALUES (@id,'_irakaslea_ikasgaiak','Klarinetea'),(@id,'_irakaslea_rola','irakaslea'),(@id,'_irakaslea_kargua','');

INSERT INTO wp_posts (post_title,post_name,post_status,post_type,post_content,post_excerpt,post_date,post_date_gmt,post_modified,post_modified_gmt,to_ping,pinged,post_content_filtered,menu_order) VALUES ('Egoitz Espina','egoitz-espina','publish','irakaslea','','',NOW(),NOW(),NOW(),NOW(),'','','',4);
SET @id=LAST_INSERT_ID(); INSERT INTO wp_postmeta(post_id,meta_key,meta_value) VALUES (@id,'_irakaslea_ikasgaiak','Flauta\nSaxofoia'),(@id,'_irakaslea_rola','irakaslea'),(@id,'_irakaslea_kargua','');

INSERT INTO wp_posts (post_title,post_name,post_status,post_type,post_content,post_excerpt,post_date,post_date_gmt,post_modified,post_modified_gmt,to_ping,pinged,post_content_filtered,menu_order) VALUES ('Kepa Pinedo','kepa-pinedo','publish','irakaslea','','',NOW(),NOW(),NOW(),NOW(),'','','',5);
SET @id=LAST_INSERT_ID(); INSERT INTO wp_postmeta(post_id,meta_key,meta_value) VALUES (@id,'_irakaslea_ikasgaiak','Pianoa'),(@id,'_irakaslea_rola','irakaslea'),(@id,'_irakaslea_kargua','');

INSERT INTO wp_posts (post_title,post_name,post_status,post_type,post_content,post_excerpt,post_date,post_date_gmt,post_modified,post_modified_gmt,to_ping,pinged,post_content_filtered,menu_order) VALUES ('Iban Agirregoikoa','iban-agirregoikoa','publish','irakaslea','','',NOW(),NOW(),NOW(),NOW(),'','','',6);
SET @id=LAST_INSERT_ID(); INSERT INTO wp_postmeta(post_id,meta_key,meta_value) VALUES (@id,'_irakaslea_ikasgaiak','Pianoa\nHizkuntza Musikala\nMusikarekin Kontaktua\nGorbeia & Itxina Ensemble'),(@id,'_irakaslea_rola','irakaslea'),(@id,'_irakaslea_kargua','');

INSERT INTO wp_posts (post_title,post_name,post_status,post_type,post_content,post_excerpt,post_date,post_date_gmt,post_modified,post_modified_gmt,to_ping,pinged,post_content_filtered,menu_order) VALUES ('Izaskun Arriaga','izaskun-arriaga','publish','irakaslea','','',NOW(),NOW(),NOW(),NOW(),'','','',7);
SET @id=LAST_INSERT_ID(); INSERT INTO wp_postmeta(post_id,meta_key,meta_value) VALUES (@id,'_irakaslea_ikasgaiak','Pianoa\nHizkuntza Musikala\nMusikarekin Kontaktua'),(@id,'_irakaslea_rola','irakaslea'),(@id,'_irakaslea_kargua','');

INSERT INTO wp_posts (post_title,post_name,post_status,post_type,post_content,post_excerpt,post_date,post_date_gmt,post_modified,post_modified_gmt,to_ping,pinged,post_content_filtered,menu_order) VALUES ('Ma Eugenia Okamika','ma-eugenia-okamika','publish','irakaslea','','',NOW(),NOW(),NOW(),NOW(),'','','',8);
SET @id=LAST_INSERT_ID(); INSERT INTO wp_postmeta(post_id,meta_key,meta_value) VALUES (@id,'_irakaslea_ikasgaiak','Pianoa\nHizkuntza Musikala\nMusikarekin Kontaktua'),(@id,'_irakaslea_rola','irakaslea'),(@id,'_irakaslea_kargua','');

INSERT INTO wp_posts (post_title,post_name,post_status,post_type,post_content,post_excerpt,post_date,post_date_gmt,post_modified,post_modified_gmt,to_ping,pinged,post_content_filtered,menu_order) VALUES ('Lara Sagastizabal','lara-sagastizabal','publish','irakaslea','','',NOW(),NOW(),NOW(),NOW(),'','','',9);
SET @id=LAST_INSERT_ID(); INSERT INTO wp_postmeta(post_id,meta_key,meta_value) VALUES (@id,'_irakaslea_ikasgaiak','Pianoa\nHizkuntza Musikala\nMusikarekin Kontaktua'),(@id,'_irakaslea_rola','irakaslea'),(@id,'_irakaslea_kargua','');

INSERT INTO wp_posts (post_title,post_name,post_status,post_type,post_content,post_excerpt,post_date,post_date_gmt,post_modified,post_modified_gmt,to_ping,pinged,post_content_filtered,menu_order) VALUES ('Iratze de Cavia','iratze-de-cavia','publish','irakaslea','','',NOW(),NOW(),NOW(),NOW(),'','','',10);
SET @id=LAST_INSERT_ID(); INSERT INTO wp_postmeta(post_id,meta_key,meta_value) VALUES (@id,'_irakaslea_ikasgaiak','Kantua\nAhozko Teknika'),(@id,'_irakaslea_rola','irakaslea'),(@id,'_irakaslea_kargua','');

INSERT INTO wp_posts (post_title,post_name,post_status,post_type,post_content,post_excerpt,post_date,post_date_gmt,post_modified,post_modified_gmt,to_ping,pinged,post_content_filtered,menu_order) VALUES ('Maria Navarro','maria-navarro','publish','irakaslea','','',NOW(),NOW(),NOW(),NOW(),'','','',11);
SET @id=LAST_INSERT_ID(); INSERT INTO wp_postmeta(post_id,meta_key,meta_value) VALUES (@id,'_irakaslea_ikasgaiak','Kantua\nHelduen Korua\nAhotsa'),(@id,'_irakaslea_rola','irakaslea'),(@id,'_irakaslea_kargua','');

INSERT INTO wp_posts (post_title,post_name,post_status,post_type,post_content,post_excerpt,post_date,post_date_gmt,post_modified,post_modified_gmt,to_ping,pinged,post_content_filtered,menu_order) VALUES ('Beatriz Zurimendi','beatriz-zurimendi','publish','irakaslea','','',NOW(),NOW(),NOW(),NOW(),'','','',12);
SET @id=LAST_INSERT_ID(); INSERT INTO wp_postmeta(post_id,meta_key,meta_value) VALUES (@id,'_irakaslea_ikasgaiak','Kirikinusi Korua'),(@id,'_irakaslea_rola','irakaslea'),(@id,'_irakaslea_kargua','');

INSERT INTO wp_posts (post_title,post_name,post_status,post_type,post_content,post_excerpt,post_date,post_date_gmt,post_modified,post_modified_gmt,to_ping,pinged,post_content_filtered,menu_order) VALUES ('Izaskun Payas','izaskun-payas','publish','irakaslea','','',NOW(),NOW(),NOW(),NOW(),'','','',13);
SET @id=LAST_INSERT_ID(); INSERT INTO wp_postmeta(post_id,meta_key,meta_value) VALUES (@id,'_irakaslea_ikasgaiak','Biolina\nMusikarekin Kontaktua'),(@id,'_irakaslea_rola','irakaslea'),(@id,'_irakaslea_kargua','');

INSERT INTO wp_posts (post_title,post_name,post_status,post_type,post_content,post_excerpt,post_date,post_date_gmt,post_modified,post_modified_gmt,to_ping,pinged,post_content_filtered,menu_order) VALUES ('Elisa Rodriguez','elisa-rodriguez','publish','irakaslea','','',NOW(),NOW(),NOW(),NOW(),'','','',14);
SET @id=LAST_INSERT_ID(); INSERT INTO wp_postmeta(post_id,meta_key,meta_value) VALUES (@id,'_irakaslea_ikasgaiak','Biolontxeloa'),(@id,'_irakaslea_rola','irakaslea'),(@id,'_irakaslea_kargua','');

INSERT INTO wp_posts (post_title,post_name,post_status,post_type,post_content,post_excerpt,post_date,post_date_gmt,post_modified,post_modified_gmt,to_ping,pinged,post_content_filtered,menu_order) VALUES ('Sergio Llamas','sergio-llamas','publish','irakaslea','','',NOW(),NOW(),NOW(),NOW(),'','','',15);
SET @id=LAST_INSERT_ID(); INSERT INTO wp_postmeta(post_id,meta_key,meta_value) VALUES (@id,'_irakaslea_ikasgaiak','Gitarra\nGitarra Elektrikoa\nBajo Elektrikoa'),(@id,'_irakaslea_rola','irakaslea'),(@id,'_irakaslea_kargua','');

INSERT INTO wp_posts (post_title,post_name,post_status,post_type,post_content,post_excerpt,post_date,post_date_gmt,post_modified,post_modified_gmt,to_ping,pinged,post_content_filtered,menu_order) VALUES ('Jorge Sotres','jorge-sotres','publish','irakaslea','','',NOW(),NOW(),NOW(),NOW(),'','','',16);
SET @id=LAST_INSERT_ID(); INSERT INTO wp_postmeta(post_id,meta_key,meta_value) VALUES (@id,'_irakaslea_ikasgaiak','Gitarra\nGitarra Elektrikoa\nBajo Elektrikoa'),(@id,'_irakaslea_rola','irakaslea'),(@id,'_irakaslea_kargua','');

INSERT INTO wp_posts (post_title,post_name,post_status,post_type,post_content,post_excerpt,post_date,post_date_gmt,post_modified,post_modified_gmt,to_ping,pinged,post_content_filtered,menu_order) VALUES ('Luis Alberto Garcia','luis-alberto-garcia','publish','irakaslea','','',NOW(),NOW(),NOW(),NOW(),'','','',17);
SET @id=LAST_INSERT_ID(); INSERT INTO wp_postmeta(post_id,meta_key,meta_value) VALUES (@id,'_irakaslea_ikasgaiak','Gitarra\nGitarra Elektrikoa\nBajo Elektrikoa'),(@id,'_irakaslea_rola','irakaslea'),(@id,'_irakaslea_kargua','');

INSERT INTO wp_posts (post_title,post_name,post_status,post_type,post_content,post_excerpt,post_date,post_date_gmt,post_modified,post_modified_gmt,to_ping,pinged,post_content_filtered,menu_order) VALUES ('Gaizka Penafiel','gaizka-penafiel','publish','irakaslea','','',NOW(),NOW(),NOW(),NOW(),'','','',18);
SET @id=LAST_INSERT_ID(); INSERT INTO wp_postmeta(post_id,meta_key,meta_value) VALUES (@id,'_irakaslea_ikasgaiak','Trikitixa\nPanderoa'),(@id,'_irakaslea_rola','irakaslea'),(@id,'_irakaslea_kargua','');

INSERT INTO wp_posts (post_title,post_name,post_status,post_type,post_content,post_excerpt,post_date,post_date_gmt,post_modified,post_modified_gmt,to_ping,pinged,post_content_filtered,menu_order) VALUES ('Inaki Plaza','inaki-plaza','publish','irakaslea','','',NOW(),NOW(),NOW(),NOW(),'','','',19);
SET @id=LAST_INSERT_ID(); INSERT INTO wp_postmeta(post_id,meta_key,meta_value) VALUES (@id,'_irakaslea_ikasgaiak','Trikitixa\nPanderoa'),(@id,'_irakaslea_rola','irakaslea'),(@id,'_irakaslea_kargua','');

INSERT INTO wp_posts (post_title,post_name,post_status,post_type,post_content,post_excerpt,post_date,post_date_gmt,post_modified,post_modified_gmt,to_ping,pinged,post_content_filtered,menu_order) VALUES ('Iker Sagala','iker-sagala','publish','irakaslea','','',NOW(),NOW(),NOW(),NOW(),'','','',20);
SET @id=LAST_INSERT_ID(); INSERT INTO wp_postmeta(post_id,meta_key,meta_value) VALUES (@id,'_irakaslea_ikasgaiak','Txistua'),(@id,'_irakaslea_rola','irakaslea'),(@id,'_irakaslea_kargua','');

INSERT INTO wp_posts (post_title,post_name,post_status,post_type,post_content,post_excerpt,post_date,post_date_gmt,post_modified,post_modified_gmt,to_ping,pinged,post_content_filtered,menu_order) VALUES ('Asier Gonzalez','asier-gonzalez','publish','irakaslea','','',NOW(),NOW(),NOW(),NOW(),'','','',21);
SET @id=LAST_INSERT_ID(); INSERT INTO wp_postmeta(post_id,meta_key,meta_value) VALUES (@id,'_irakaslea_ikasgaiak','Alboka'),(@id,'_irakaslea_rola','irakaslea'),(@id,'_irakaslea_kargua','');

INSERT INTO wp_posts (post_title,post_name,post_status,post_type,post_content,post_excerpt,post_date,post_date_gmt,post_modified,post_modified_gmt,to_ping,pinged,post_content_filtered,menu_order) VALUES ('Ander Lekue','ander-lekue','publish','irakaslea','','',NOW(),NOW(),NOW(),NOW(),'','','',22);
SET @id=LAST_INSERT_ID(); INSERT INTO wp_postmeta(post_id,meta_key,meta_value) VALUES (@id,'_irakaslea_ikasgaiak','Bateria\nPerkusioa'),(@id,'_irakaslea_rola','irakaslea'),(@id,'_irakaslea_kargua','');

INSERT INTO wp_posts (post_title,post_name,post_status,post_type,post_content,post_excerpt,post_date,post_date_gmt,post_modified,post_modified_gmt,to_ping,pinged,post_content_filtered,menu_order) VALUES ('Unai Olabarri','unai-olabarri','publish','irakaslea','','',NOW(),NOW(),NOW(),NOW(),'','','',23);
SET @id=LAST_INSERT_ID(); INSERT INTO wp_postmeta(post_id,meta_key,meta_value) VALUES (@id,'_irakaslea_ikasgaiak','Bateria'),(@id,'_irakaslea_rola','irakaslea'),(@id,'_irakaslea_kargua','');

INSERT INTO wp_posts (post_title,post_name,post_status,post_type,post_content,post_excerpt,post_date,post_date_gmt,post_modified,post_modified_gmt,to_ping,pinged,post_content_filtered,menu_order) VALUES ('Juan Ma','juan-ma','publish','irakaslea','','',NOW(),NOW(),NOW(),NOW(),'','','',24);
SET @id=LAST_INSERT_ID(); INSERT INTO wp_postmeta(post_id,meta_key,meta_value) VALUES (@id,'_irakaslea_ikasgaiak','Akordeoia\nAkordeoi Taldea'),(@id,'_irakaslea_rola','irakaslea'),(@id,'_irakaslea_kargua','');

-- ZUZENDARITZA
INSERT INTO wp_posts (post_title,post_name,post_status,post_type,post_content,post_excerpt,post_date,post_date_gmt,post_modified,post_modified_gmt,to_ping,pinged,post_content_filtered,menu_order) VALUES ('Victor Dominguez','victor-dominguez','publish','irakaslea','','',NOW(),NOW(),NOW(),NOW(),'','','',1);
SET @id=LAST_INSERT_ID(); INSERT INTO wp_postmeta(post_id,meta_key,meta_value) VALUES (@id,'_irakaslea_ikasgaiak','Pianoa'),(@id,'_irakaslea_rola','zuzendaritza'),(@id,'_irakaslea_kargua','Zuzendaria');

INSERT INTO wp_posts (post_title,post_name,post_status,post_type,post_content,post_excerpt,post_date,post_date_gmt,post_modified,post_modified_gmt,to_ping,pinged,post_content_filtered,menu_order) VALUES ('Ainhize Hurtado','ainhize-hurtado','publish','irakaslea','','',NOW(),NOW(),NOW(),NOW(),'','','',2);
SET @id=LAST_INSERT_ID(); INSERT INTO wp_postmeta(post_id,meta_key,meta_value) VALUES (@id,'_irakaslea_ikasgaiak',''),(@id,'_irakaslea_rola','zuzendaritza'),(@id,'_irakaslea_kargua','Administrazioa');

SELECT COUNT(*) as total FROM wp_posts WHERE post_type='irakaslea' AND post_status='publish';
