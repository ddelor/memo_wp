<?php

function get_related_town_antenna()
{
    header('Content-Type: application/json');

    $error            = true;
    $antenna_name     = '';
    $antenna_lat      = '';
    $antenna_lng      = '';
    $selected_town_id = $_POST['selected_town_id'];

    $args = array(
        'post_type'      => 'town',
        'posts_per_page' => 1,
        'post_status'    => 'publish',
        'meta_query'     => array(
            array(
                'key'   => 'SL_town_related',
                'value' => $selected_town_id
            )
        )
    );
    $antenna = get_posts($args);

    if (!empty($antenna))
    {
        $error        = false;
        $antenna      = current($antenna);
        $antenna_name = $antenna->post_name;
        $antenna_lat  = $antenna->SL_town_antenna_latitude;
        $antenna_lng  = $antenna->SL_town_antenna_longitude;
    }

    echo json_encode(array(
        'error'   => $error,
        'antenna' => array(
            'id'   => $antenna->ID,
            'name' => $antenna_name,
            'lat'  => $antenna_lat,
            'lng'  => $antenna_lng
        )
    ));

    exit();
}

add_action('wp_ajax_get_related_town_antenna', 'get_related_town_antenna');
add_action('wp_ajax_nopriv_get_related_town_antenna', 'get_related_town_antenna');
