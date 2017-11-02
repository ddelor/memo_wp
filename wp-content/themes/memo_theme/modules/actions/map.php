<?php

function get_town_map()
{
    $args = array(
        'post_type'      => 'town',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'meta_query'     => array(
            array(
                'key'     => 'SL_town_related',
                'compare' => 'EXISTS'
            )
        )
    );

    $towns    = get_content_type_posts('town', -1);
    $antennas = get_posts($args);

    if (!empty($antennas)) {
        include __DIR__ . '/../../templates/partials/town-map.php';
    }
}

add_action('town_map', 'get_town_map');
