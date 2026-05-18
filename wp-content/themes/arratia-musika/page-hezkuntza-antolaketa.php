<?php
/**
 * Template Name: Hezkuntza Antolaketa
 */
get_header();

$ikasturtea   = get_option('arratia_antolaketa_ikasturtea', '2026/2027');
$base_year    = (int) explode('/', $ikasturtea)[0];
$nibela1_urte = ($base_year - 4) . ' – ' . ($base_year - 7);
$nibela2_urte = (string)($base_year - 8);
$ikasturtea   = esc_html($ikasturtea);
?>

<div class="hezant-page">
    <div class="container">

        <?php arratia_page_hero(arratia_t('Hezkuntza Antolaketa', 'Organización educativa'), ''); ?>

        <div class="hezant-scroll-wrap">
        <div class="hezant-chart">
        <div class="hezant-root">

            <div class="hezant-box hezant-box--title">
                HEZKUNTZA ANTOLAKETA <?php echo $ikasturtea; ?>
            </div>
            <div class="hezant-vline"></div>

            <div class="hezant-children">

                <!-- ── 1 NIBELA ── -->
                <div class="hezant-subtree">
                    <div class="hezant-box hezant-box--nibela">
                        <strong>1 NIBELA</strong>
                        <span><?php echo $nibela1_urte; ?> urte bitartean jaioak</span>
                        <small>(4 eta 7 urte bitartekoak)</small>
                    </div>
                    <div class="hezant-vline"></div>
                    <div class="hezant-children">
                        <!-- MUSIKAREKIN KONTAKTUA -->
                        <div class="hezant-subtree">
                            <div class="hezant-box hezant-box--orange">
                                <b>MUSIKAREKIN KONTAKTUA</b>
                                <span>Musika eta mugimendua</span>
                            </div>
                            <div class="hezant-dur">
                                <strong>45/60 min</strong>
                                <em>saioa bat</em>
                            </div>
                        </div>
                        <!-- HASTAPENA -->
                        <div class="hezant-subtree">
                            <div class="hezant-box hezant-box--orange">
                                <b>HASTAPENA</b>
                                <span>1.7 urte maila<br>7 urteko ikasleak</span>
                            </div>
                            <div class="hezant-vline"></div>
                            <div class="hezant-children">
                                <div class="hezant-subtree">
                                    <div class="hezant-box hezant-box--red">
                                        <b>MUSIKAREKIN KONTAKTUA</b>
                                    </div>
                                    <div class="hezant-dur">
                                        <strong>45/60 min</strong>
                                        <em>Ikasle kopuruaren arabera</em>
                                    </div>
                                </div>
                                <div class="hezant-subtree">
                                    <div class="hezant-box hezant-box--red">
                                        <b>MUSIKA TRESNA</b>
                                        <span>(aukeran)</span>
                                    </div>
                                    <div class="hezant-dur">
                                        <strong>30 min</strong>
                                        <em>Banakako saioak</em>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ── 2 NIBELA ── -->
                <div class="hezant-subtree">
                    <div class="hezant-box hezant-box--nibela">
                        <strong>2 NIBELA</strong>
                        <span><?php echo $nibela2_urte; ?> urtean jaioak<br>eta nagusiagoak, adin mugarik gabe</span>
                    </div>
                    <div class="hezant-vline"></div>
                    <div class="hezant-children">
                        <!-- 2.1-2.5 -->
                        <div class="hezant-subtree">
                            <div class="hezant-box hezant-box--orange">
                                <b>2.1.–2.5.</b>
                                <span>8 urtetik aurrera</span>
                            </div>
                            <div class="hezant-vline"></div>
                            <div class="hezant-children">
                                <div class="hezant-subtree">
                                    <div class="hezant-box hezant-box--red">
                                        <b>HIZKUNTZA MUSIKALA</b>
                                        <span>2.1 – 2.5</span>
                                    </div>
                                    <div class="hezant-dur">
                                        <strong>5 kurtso</strong>
                                        <strong>45/60 min</strong>
                                        <em>Ikasle kopuruaren arabera</em>
                                    </div>
                                </div>
                                <div class="hezant-subtree">
                                    <div class="hezant-box hezant-box--red">
                                        <b>MUSIKA TRESNA</b>
                                        <span>2.1 – 2.5</span>
                                    </div>
                                    <div class="hezant-dur">
                                        <strong>5 kurtso</strong>
                                        <strong>30 min</strong>
                                        <em>Banakako saioak</em>
                                    </div>
                                </div>
                                <div class="hezant-subtree">
                                    <div class="hezant-box hezant-box--red">
                                        <b>KORUA /<br>TALDE INSTRUMENTALA</b>
                                    </div>
                                    <div class="hezant-dur">
                                        <strong>3 kurtso</strong>
                                        <small>(Gutxienez)</small>
                                        <strong>30/60 min</strong>
                                        <em>Derrigorrezkoa</em>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ERREFORTSUA -->
                        <div class="hezant-subtree">
                            <div class="hezant-box hezant-box--orange">
                                <b>ERREFORTSUA</b>
                                <span>2.4 – 2.5</span>
                                <small>(sarbtide, froga prestak)</small>
                            </div>
                            <div class="hezant-dur">
                                <strong>90 min</strong>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ── 3 NIBELA ── -->
                <div class="hezant-subtree">
                    <div class="hezant-box hezant-box--nibela">
                        <strong>3 NIBELA</strong>
                        <span>2. nibela gaindituta</span>
                    </div>
                    <div class="hezant-vline"></div>
                    <div class="hezant-children">
                        <div class="hezant-subtree">
                            <div class="hezant-box hezant-box--orange">
                                <b>MUSIKA TRESNA</b>
                            </div>
                            <div class="hezant-dur">
                                <strong>30 min</strong>
                                <em>saioa bat</em>
                            </div>
                        </div>
                        <div class="hezant-subtree">
                            <div class="hezant-box hezant-box--orange">
                                <b>TALDEA</b>
                            </div>
                            <div class="hezant-dur">
                                <strong>30/60 min</strong>
                                <em>Ikasle kopuruaren arabera</em>
                            </div>
                        </div>
                    </div>
                </div>

            </div><!-- .hezant-children (nibelas) -->
        </div><!-- .hezant-root -->
        </div><!-- .hezant-chart -->
        </div><!-- .hezant-scroll-wrap -->

        <p class="hezant-oharra">
            <strong>OHARRA:</strong> 13 URTETIK AURRERA POSIBLE DA INSTRUMENTUA BAKARRIK EGITEA<br>
            TALDEA EGITEA ALA EZ IRAKASLEAK BALORATUKO DU
        </p>

        <?php $pdf = get_option('arratia_antolaketa_pdf', ''); if ($pdf): ?>
        <div style="margin-top:1.5rem;">
            <a href="<?php echo esc_url($pdf); ?>" class="btn btn-accent" target="_blank">
                <i class="fas fa-file-pdf"></i> <?php echo arratia_t('PDF deskargatu', 'Descargar PDF'); ?>
            </a>
        </div>
        <?php endif; ?>

    </div>
</div>

<?php get_footer(); ?>
