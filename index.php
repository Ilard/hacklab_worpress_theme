<?php get_header(); ?>
    <div class="layout-content">
        <div class="cover">
            <div class="cover-wrapper">
                <div class="cover-background">

                </div>
                <div class="cover-calendar">
                    <div class="cover-calendar-event">
                        <h2>Prochain atelier</h2>
                        <?php
                            $args = array(
                                'posts_per_page'   => 1,
                                'post_type'        => 'event',
                                'event_start_after' => 'today',
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'event-category',
                                        'field' => 'slug',
                                        'terms' => 'atelier'
                                    )
                                 )
                            );
                            query_posts($args);

                            if (have_posts()): while (have_posts()): the_post();
                        ?>
                        <div class="cover-calendar-event-schedules">
                            <?= "Le " . eo_get_the_start('j F Y à G:i'); ?>
                        </div>
                        <div class="cover-calendar-event-venue">
                            <?= eo_venue_name(); ?>
                        </div>
                    <?php endwhile; endif; wp_reset_query(); ?>
                    </div>
                    <div class="cover-calendar-event">
                        <h2>Prochaine sortie</h2>
                        <?php
                            $args = array(
                                'posts_per_page'   => 1,
                                'post_type'        => 'event',
                                'event_start_after' => 'today',
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'event-category',
                                        'field' => 'slug',
                                        'terms' => 'sortie'
                                    )
                                 )
                            );
                            query_posts($args);

                            if (have_posts()): while (have_posts()): the_post();
                        ?>
                        <div class="cover-calendar-event-schedules">
                            <?= "Le " . eo_get_the_start('j F Y à G:i'); ?>
                        </div>
                        <div class="cover-calendar-event-venue">
                            <?= eo_venue_name(); ?>
                        </div>
                    <?php endwhile; endif; wp_reset_query(); ?>
                    </div>
                </div>
                <div class="cover-seemore">
                    <div class="cover-seemore-button">Découvrir !</div>
                </div>
            </div>
        </div>
        <div class="section about">
            <div class="section-wrapper">
                <h2>À propos de nous</h2>
                <div class="about-content">
                    <div class="about-content-introduction">

                    </div>
                    <div class="about-content-skills">

                    </div>
                </div>
            </div>
        </div>
        <div class="section projects">
            <div class="section-wrapper">
                <h2>Nos derniers projets</h2>
            </div>
        </div>
        <div class="section diary">
            <div class="section-wrapper">
                <h2>Agenda</h2>
            </div>
        </div>
        <div class="section blog">
            <div class="section-wrapper">
                <h2>Blog</h2>
            </div>
        </div>
        <div class="section contact">
            <div class="section-wrapper">
                <h2>Nous contacter</h2>
            </div>
        </div>
    </div>
<?php get_footer(); ?>
