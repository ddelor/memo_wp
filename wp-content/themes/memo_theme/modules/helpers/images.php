<?php

function get_image_by_id($id, $format)
{
    $img = wp_get_attachment_image_src($id, $format);
    $alt = get_post_meta($id, '_wp_attachment_image_alt', true);

    return array(
        'src'    => $img[0],
        'alt'    => $alt,
        'height' => $img[2]
    );
}
