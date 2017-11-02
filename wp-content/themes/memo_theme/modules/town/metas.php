<?php

function register_town_meta_boxes($meta_boxes)
{
    // $meta_boxes[] = array(
    //     'id'       => 'town_hall_coords',
    //     'title'    => 'Coordonnées de la commune',
    //     'pages'    => array('town'),
    //     'context'  => 'normal',
    //     'priority' => 'high',
    //     'autosave' => true,

    //     'fields' => array(
    //         array(
    //             'name' => 'Rue',
    //             'id'   => PREFIX . "town_hall_street",
    //             'type' => 'text'
    //         ),
    //         array(
    //             'name' => 'Code postal',
    //             'id'   => PREFIX . "town_hall_postal_code",
    //             'type' => 'text'
    //         ),
    //         array(
    //             'name' => 'Ville',
    //             'id'   => PREFIX . "town_hall_city",
    //             'type' => 'text'
    //         ),
    //         array(
    //             'name' => 'Téléphone',
    //             'id'   => PREFIX . "town_hall_phone",
    //             'type' => 'text'
    //         ),
    //         array(
    //             'name' => 'Fax',
    //             'id'   => PREFIX . "town_hall_fax",
    //             'type' => 'text'
    //         ),
    //         array(
    //             'name' => 'Site web',
    //             'id'   => PREFIX . "town_hall_site",
    //             'type' => 'url'
    //         )
    //     )
    // );

    $meta_boxes[] = array(
        'id'       => 'town_antenna_coords',
        'title'    => 'Coordonnées de l\'antenne (à remplir uniquement si la ville dispose d\'une antenne)',
        'pages'    => array('town'),
        'context'  => 'normal',
        'priority' => 'high',
        'autosave' => true,

        'fields' => array(
            array(
                'name' => 'Rue',
                'id'   => PREFIX . "town_antenna_street",
                'type' => 'text'
            ),
            array(
                'name' => 'Code postal',
                'id'   => PREFIX . "town_antenna_postal_code",
                'type' => 'text'
            ),
            array(
                'name' => 'Ville',
                'id'   => PREFIX . "town_antenna_city",
                'type' => 'text'
            ),
            array(
                'name' => 'Téléphone',
                'id'   => PREFIX . "town_antenna_phone",
                'type' => 'text'
            ),
            array(
                'name' => 'Fax',
                'id'   => PREFIX . "town_antenna_fax",
                'type' => 'text'
            ),
            array(
                'name' => 'Latitude (N)',
                'id'   => PREFIX . 'town_antenna_latitude',
                'type' => 'text'
            ),
            array(
                'name' => 'Longitude (W)',
                'id'   => PREFIX . 'town_antenna_longitude',
                'type' => 'text'
            )
        )
    );

    $meta_boxes[] = array(
        'id'       => 'town_liaison',
        'title'    => 'Communes rattachées à l\'antenne (à remplir uniquement si la ville dispose d\'une antenne)',
        'pages'    => array('town'),
        'context'  => 'normal',
        'priority' => 'high',
        'autosave' => true,

        'fields' => array(
            array(
                'name'     => 'Communes',
                'id'       => PREFIX . 'town_related',
                'type'     => 'autocomplete',
                'multiple' => true,
                'options'  => get_content_type_list('town'),
            )
        )
    );

    return $meta_boxes;
}

add_filter('rwmb_meta_boxes', 'register_town_meta_boxes');
