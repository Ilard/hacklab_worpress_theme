<?php

/*
 *  Register post type
 */
function projects_type_register_post_type() {

    $labels = array(
        'name'               => 'Tous les projets',
        'singular_name'      => 'Tous les projets',
        'menu_name'          => 'Projets',
        'name_admin_bar'     => 'Projets',
        'add_new'            => 'Ajouter un nouveau projet',
        'add_new_item'       => 'Ajouter un nouveau projet',
        'new_item'           => 'Nouveau projet',
        'edit_item'          => 'Modifier le projet',
        'view_item'          => 'Voir le projet',
        'all_items'          => 'Tous les projets',
        'search_items'       => 'Rechercher un projet',
        'not_found'          => 'Aucun projet',
        'not_found_in_trash' => 'Aucun projet dans la corbeille'
    );

    $args = array(
        'labels'             => $labels,
        'description'        => 'Projets réalisés par le Hacklab d\'ILArd',
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'projects' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'thumbnail')
    );

    register_post_type( 'projects', $args );
}
add_action('init', 'projects_type_register_post_type', $priority = 10, $accepted_args = 0);

/*
 *  Register taxonomy
 */
function projects_type_register_taxonomy() {
    $labels = array(
		'name'              => 'Catégories',
		'singular_name'     => 'Catégories',
		'search_items'      => 'Rechercher une catégorie',
		'all_items'         => 'Toutes les catégories',
		'parent_item'       => 'Catégorie parente',
		'edit_item'         => 'Modifier la catégorie',
		'update_item'       => 'Mettre à jour la catégorie',
		'add_new_item'      => 'Ajouter une nouvelle catégorie',
		'new_item_name'     => 'Nom de la nouvelle catégorie',
		'menu_name'         => 'Catégories',
	);

    $args = array(
        'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'project-categories' ),
    );

    register_taxonomy('projects-categories', 'projects', $args);
}
add_action( 'init', 'projects_type_register_taxonomy', $priority = 10, $accepted_args = 0 );

/*
 *  Custom fields
 */
// Register metabox
function projects_type_register_metabox() {
    add_meta_box( 'projects_informations', 'Informations complémentaires', 'projects_type_display_metabox_info', 'projects', 'normal', 'high', null );
    add_meta_box( 'projects_medias', 'Médias', 'projects_type_display_metabox_medias', 'projects', 'normal', 'high', null );
}
add_action('add_meta_boxes', 'projects_type_register_metabox', $priority = 10, $accepted_args = 0);

// Display metabox info
function projects_type_display_metabox_info($post) {
    wp_nonce_field('project_info', $name = "project_nonce_info");

    $project_sources = "";
    if (!empty(get_post_meta($post->ID, '_project_sources', true))) {
        $project_sources = get_post_meta($post->ID, '_project_sources', true);
    }

    echo "<div class='meta-box-item-title'>";
    echo "<h4>Sources du projet</h4>";
    echo "</div>";
    echo "<div class='meta-box-item-content'>";
    echo "<input type='text' name='project_sources' style='width: 100%;' value='" . $project_sources . "'/>";
    echo "</div>";

    $project_demo = "";
    if (!empty(get_post_meta($post->ID, '_project_demo', true))) {
        $project_demo = get_post_meta($post->ID, '_project_demo', true);
    }

    echo "<div class='meta-box-item-title'>";
    echo "<h4>Démo du projet</h4>";
    echo "</div>";
    echo "<div class='meta-box-item-content'>";
    echo "<input type='text' name='project_demo' style='width: 100%;' value='" . $project_demo . "'/>";
    echo "</div>";
}
 // Display metabox medias
function projects_type_display_metabox_medias($post) {
    wp_nonce_field('project_medias', $name = "project_nonce_medias");

    $project_media_link = "";
    if (isset($content) && !empty($content)) {
        $project_media_link = $content;
    }

    $project_medias = "";
    if (!empty(get_post_meta($post->ID, '_projects_media', true))) {
        $project_medias = get_post_meta($post->ID, '_projects_media', true);
    } else {
        $project_medias = array();
    }

    // $project_edit_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
    //
    // if (isset($_GET['id'])) {
    //     function projects_type_remove_media($post_id) {
    //         unset($project_medias[$_GET['id']]);
    //         update_post_meta($post->ID, '_projects_media', $project_medias);
    //         // wp_safe_redirect($_GET['url'], 301);
    //     }
    //     do_action('save_post', 'projects_type_remove_media');
    // }
    //
    // print_r($project_medias);

    echo "<div class='meta-box-item-title'>";
    echo "<h4>Médias du projet</h4>";
    echo "</div>";
    echo "<div class='meta-box-item-content'>";
    echo "<input type='text' id='projects_media' name='projects_media' style='width: 60%;' value='" . $project_media_link . "' />";
    echo "<a href='#' class='button button-primary addmediabutton' data-editor='content' title='Add Media'>";
    echo "<span class='wp-media-buttons-icon'></span> Importer un média";
    echo "</a>";
    echo "</div>";
    echo "<div class='meta-box-item-content meta-box-item-medias'>";
    $project_attachments = get_attached_media('image', $post->ID);
    echo "<pre>";
    print_r($project_attachments);
    echo "</pre>";
    echo "<div class='meta-box-item-content'>";
    echo "<table class='wp-list-table widefat'>";
    echo "<tbody>";
    foreach ($project_attachments as $project_attachment) {
        echo "<tr>";
        echo "<td>";
        // wp_get_attachment_image($project_attachment->ID, $size = 'thumbnail', $icon = false, $attr = '');
        echo $project_attachment->ID;
        echo "</td>";
        echo "<td>";
        echo "<a class='button-primary'>Supprimer</a>";
        echo "</td>";
        echo "</tr>";
    //     echo "<a href='" . $project_edit_url . "&id=" . $key . "&url=" . $project_edit_url . "'>Supprimer</a>";
    //     echo "<img src='" . $value . "' />";
    }
    echo "</tbody>";
    echo "</table>";
    echo "</div>";
    echo "</div>";
}

// Save metabox info
function projects_type_save_metabox_info($post_id, $post) {

    if (isset($_POST['project_sources']) || isset($_POST['project_demo']) || !wp_verify_nonce('project_nonce_info', 'project_info')) {
        $post_type = $post->post_type;
        if (current_user_can('edit_posts', $post_id)) {
            update_post_meta($post_id, '_project_sources', $_POST['project_sources']);
            update_post_meta($post_id, '_project_demo', $_POST['project_demo']);
        }
    }
}
add_action('save_post', 'projects_type_save_metabox_info', $priority = 10, $accepted_args = 2);

// Save metabox medias
function projects_type_save_metabox_medias($post_id, $post) {
    if (isset($_POST['projects_media']) || !wp_verify_nonce('project_nonce_medias', 'project_medias')) {
        if (current_user_can('edit_posts', $post_id)) {
            if (!empty(get_post_meta($post->ID, '_projects_media', true))) {
                $project_medias = get_post_meta($post->ID, '_projects_media', true);
            } else {
                $project_medias = array();
            }
            array_push($project_medias, $_POST['projects_media']);
            update_post_meta( $post_id, '_projects_media', $project_medias);
        }
    }
}
add_action('save_post', 'projects_type_save_metabox_medias', $priority = 10, $accepted_args = 2);
