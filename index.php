<?php get_header(); ?>
    <div class="layout-content">
        <div class="cover">
            <div class="cover-wrapper">
                <div class="cover-background">
                    <?php
                        $coverImg01 = get_option("_cover_image_01", "");
                        if (!empty($coverImg01)) {
                            echo "<img src='". $coverImg01 . "' />";
                        }

                        $coverImg02 = get_option("_cover_image_02", "");
                        if (!empty($coverImg02)) {
                            echo "<img src='". $coverImg02 . "' />";
                        }

                        $coverImg03 = get_option("_cover_image_03", "");
                        if (!empty($coverImg03)) {
                            echo "<img src='". $coverImg03 . "' />";
                        }
                    ?>
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
                        <?= stripcslashes(get_option("_about_text", "")); ?>
                    </div>
                    <div class="about-content-skills">
                        <?php
                            for ($i=1; $i<=4; $i++) {
                        ?>
                        <div class="about-content-skills-item">
                            <a href="<?= get_the_permalink(get_option("_skill_link_0" . $i, "")); ?>">
                                <div class="about-content-skills-item-title">
                                    <h2><?= get_option("_skill_title_0" . $i, ""); ?></h2>
                                </div>
                                <div class="about-content-skills-item-image">
                                    <img src="<?= get_option("_skill_image_0" . $i, ""); ?>" alt="<?= get_option("_skill_title_0" . $i, ""); ?>">
                                </div>
                            </a>
                        </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="section projects">
            <div class="section-wrapper">
                <h2>Nos derniers projets</h2>
                <div class="projects-content">
                    <?php
                        $args = array(
                            "posts_per_page" => 8,
                            "post_type" => "projects"
                        );
                        query_posts($args);

                        if (have_posts()): while (have_posts()): the_post();
                    ?>
                    <div class="project-item">
                        <a href="<?php the_permalink(); ?>" class="project-link">
                            <div class="project-header">
                                <div class="project-category">
                                    <?php
                                        $categories = wp_get_object_terms($post->ID, "projects-categories");
                                        $categoriesLenght = count($categories);
                                        $count = 1;

                                        foreach ($categories as $category) {
                                            echo $category->name;
                                            if ($count < $categoriesLenght) {
                                                echo ", ";
                                            }
                                            $count++;
                                        }
                                    ?>
                                </div>
                                <?php the_post_thumbnail("project-teaser"); ?>
                            </div>
                            <div class="project-details">
                                <div class="project-title">
                                    <?php the_title(); ?>
                                </div>
                                <div class="project-excerpt">
                                    <?php the_excerpt(); ?>
                                </div>
                                <button class="button">En savoir plus</button>
                            </div>
                        </a>
                    </div>
                    <?php
                        endwhile;
                        endif;
                        wp_reset_query();
                    ?>
                </div>
            </div>
        </div>
        <div class="section blog">
            <div class="section-wrapper">
                <h2>Blog</h2>
                <div class="blog-content">
                    <?php
                        $args = array(
                            "posts_per_page" => 8,
                            "post_type" => "post"
                        );
                        query_posts($args);

                        if (have_posts()): while (have_posts()): the_post();
                    ?>
                    <div class="blog-item">
                        <a href="<?php the_permalink(); ?>" class="blog-link">
                            <div class="blog">
                                <div class="blog-header">
                                    <div class="blog-category">
                                        <?php
                                            $categories = wp_get_post_categories($post->ID);
                                            $categoriesLenght = count($categories);
                                            $count = 1;

                                            foreach ($categories as $category) {
                                                $category = get_category($category);
                                                echo $category->name;
                                                if ($count < $categoriesLenght) {
                                                    echo ", ";
                                                }
                                                $count++;
                                            }
                                        ?>
                                    </div>
                                    <?php the_post_thumbnail("blog-teaser"); ?>
                                </div>
                                <div class="blog-details">
                                    <div class="blog-title">
                                        <?php the_title(); ?>
                                    </div>
                                    <div class="blog-excerpt">
                                        <?php the_excerpt(); ?>
                                    </div>
                                    <button class"button">En savoir plus</button>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php
                        endwhile;
                        endif;
                        wp_reset_query();
                    ?>
                </div>
            </div>
        </div>
        <div class="section contact">
            <div class="section-wrapper">
                <h2>Nous contacter</h2>
                <div class="contact-form">
                    <?php echo FrmFormsController::get_form_shortcode( array('id' => 1, 'title' => false, 'description' => false )); ?>
                </div>
            </div>
        </div>
        <div class="section map">
            <div id="contact-map" class="contact-map" style="width: 100%; height: 400px;"></div>
            <script type="text/javascript">
                var map = L.map('contact-map').setView([49.77413, 4.72486], 18);
                var markerMcl = L.marker([49.77391, 4.72542]).addTo(map);
                var markerMediatheque = L.marker([49.77425, 4.72432]).addTo(map);

                var osmLayer = L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap contributors',
                    maxZoom: 20
                }).addTo(map);
            </script>
        </div>
    </div>
<?php get_footer(); ?>
