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
}
add_action('add_meta_boxes', 'projects_type_register_metabox', $priority = 10, $accepted_args = 0);

// Display metabox
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

// Save metabox
function projects_type_save_metabox_info($post_id, $post) {

    if (isset($_POST['project_nonce_info'])) {

        if (current_user_can('edit_posts', $post_id)) {

            if (isset($_POST['project_sources']) && !empty($_POST['project_sources'])) {
                update_post_meta($post_id, '_project_sources', $_POST['project_sources']);
            }

            if (isset($_POST['project_demo']) && !empty($_POST['project_demo'])) {
                update_post_meta($post_id, '_project_demo', $_POST['project_demo']);
            }
        }
    }
}
add_action('save_post_projects', 'projects_type_save_metabox_info', $priority = 10, $accepted_args = 2);
