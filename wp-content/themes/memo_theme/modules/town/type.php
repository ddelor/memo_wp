<?php

function town_type()
{
    $labels =
    array(
        'name'               => 'Communes',
        'singular_name'      => 'Commune',
        'add_new'            => 'Ajouter une commune',
        'add_new_item'       => 'Ajouter une commune',
        'edit_item'          => 'Modifier l\'commune',
        'new_item'           => 'Nouvelle commune',
        'view_item'          => 'Voir l\'commune',
        'search_items'       => 'Recherche une commune',
        'not_found'          => 'Aucune commune',
        'not_found_in_trash' => 'Aucune commune',
        'parent_item_colon'  => ''
    );

    $args =
    array(
        'labels'            => $labels,
        'rewrite'           => array('slug' => 'commune'),
        'public'            => true,
        'publicly_queryable'=> true,
        'show_ui'           => true,
        'query_var'         => true,
        'capability_type'   => 'post',
        'hierarchical'      => false,
        'menu_position'     => 4,
        'supports'          => array('title',),
        'menu_icon'         => ''
    );

    register_post_type('town', $args);
}

add_action('init', 'town_type');
