<?php

    function hacklab_settings_page() {
        wp_enqueue_media();

        if (isset($_POST['settings-update'])) {
            for ($i=1; $i<=3; $i++) {
                update_option('_cover_image_0' . $i, $_POST['cover-img0' . $i]);
            }

            update_option('_about_text', $_POST['about-text']);

            for ($i=1; $i<=4; $i++) {
                update_option('_skill_title_0' . $i, $_POST['skill-title-0' . $i]);
                update_option('_skill_image_0' . $i, $_POST['skill-img-0' . $i]);
                update_option('_skill_link_0' . $i, $_POST['skill-link-0' . $i]);
            }
        }
?>

        <div class='wrap'>
            <h1>Paramètres du thème</h1>
            <form method='post' action='#'>
                <table class='form-table' role='presentation'>
                    <tbody>

         <!-- Cover section -->
         <tr>
             <td colspan='2'>
                 <h2>Section &laquo;&nbsp;Couverture&nbsp;&raquo;</h2>
             </td>
         </tr>
         <?php
            for ($i=1; $i<=3; $i++) {
         ?>
            <tr>
                <th scope='row'>
                    <label for='cover-img0<?= $i; ?>'>Image #<?= $i; ?></label>
                </th>
                <td>
                    <input type='text' id='cover-img0<?= $i; ?>' name='cover-img0<?= $i; ?>' class='regular-text' value='<?= get_option("_cover_image_0" . $i, "") ?>' />
                    <a href='#' class='button addmediabutton' data-editor='content' title='Ajouter une image'>
                        <span class='wp-media-buttons-icon'></span> Importer un média
                    </a>
                </td>
            </tr>
        <?php
            }
        ?>
            <!-- About section -->
            <tr>
                <td colspan='2'>
                    <h2>Section &laquo;&nbsp;À propos&nbsp;&raquo;</h2>
                    </td>
            </tr>
            <tr>
                <th scope='row'>
                    <label for='about-text'>Texte de présentation</label>
                </th>
                <td>
                    <textarea id='about-text' name='about-text' class='large-text' rows='10'><?= stripcslashes(get_option("_about_text", "")) ?></textarea>
                </td>
            </tr>
<?php
        for ($i=1; $i<=4; $i++) {
?>
            <tr>
                <td colspan='2'>
                    <h4>Compétence #<?= $i; ?></h4>
                </td>
            </tr>
            <tr>
                    <th scope='row'>
                        <label for='skill-title-0<?= $i; ?>'>Titre</label>
                    </th>
                    <td>
                        <input type='text' id='skill-title-0<?= $i; ?>' name='skill-title-0<?= $i; ?>' class='regular-text' value='<?= stripcslashes(get_option("_skill_title_0" . $i, "")) ?>' />
                    </td>
            </tr>
            <tr>
                <th scope='row'>
                    <label for='skill-img-0<?= $i; ?>'>Logo</label>
                </th>
                <td>
                    <input type='text' id='skill-img-0<?= $i; ?>' name='skill-img-0<?= $i; ?>' class='regular-text' value='<?= get_option("_skill_image_0" . $i, "") ?>' />
                    <a href='#' class='button addmediabutton' data-editor='content' title='Ajouter une image'>
                        <span class='wp-media-buttons-icon'></span> Importer un média
                    </a>
                </td>
            </tr>
            <tr>
                <th scope='row'>
                    <label for='skill-link-0<?= $i; ?>'>Lien</label>
                </th>
                <td>
                    <select id="skill-link-0<?= $i; ?>" name="skill-link-0<?= $i; ?>">
                        <?php
                            $pageID = get_option("_skill_link_0" . $i, "");
                            if (!empty($pageID)) {
                                echo "<option value='". $pageID . "'>" . get_the_title($pageID) . "</option>";
                            }
                        ?>
                        <optgroup label="Liste des pages">
                            <?php
                                $args = array(
                                    "posts_per_page" => -1,
                                    "post_type" => "page"
                                );
                                query_posts($args);

                                if (have_posts()): while (have_posts()): the_post(); global $post;

                                echo "<option value='" . $post->ID . "'>" . get_the_title() . "</option>";

                            endwhile; endif;

                            wp_reset_query();
                            ?>
                        </optgroup>
                    </select>
                </td>
            </tr>
<?php
        }
?>
                    </tbody>
                </table>
            <p class='submit'><input type='submit' class='button button-primary' id='settings-update' name='settings-update' value='Enregistrer les modifications' /></p>
            </form>
        </div>
<?php
    }

    function hacklab_settings_menu() {
        add_options_page('Paramètres du thème', 'Paramètres du thème', 'edit_posts', 'theme-settings', 'hacklab_settings_page');
    }
    add_action('admin_menu', 'hacklab_settings_menu', $priority = 10, $accepted_args = 0);
