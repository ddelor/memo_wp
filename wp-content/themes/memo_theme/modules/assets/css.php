<?php

function loadCss()
{
    wp_register_style('style', get_template_directory_uri() . '/dist/style.css', null, false);

    wp_enqueue_style('style');
}

function adminLoadCss()
{
    wp_register_style('style', get_template_directory_uri() . '/app/admin/style.css', null, false);

    wp_enqueue_style('style');
}

add_action('wp_enqueue_scripts', 'loadCss');
add_action('admin_print_scripts', 'adminLoadCss');
