<?php

function get_content_type_posts($type, $limit)
{
    $arg = array(
        'post_type'      => $type,
        'posts_per_page' => $limit,
        'post_status'    => 'publish'
    );
    $posts = get_posts($arg);

    return $posts;
}

function get_content_type_list($type)
{
    $list  = array();
    $posts = get_content_type_posts($type, -1);

    foreach ($posts as $post) {
        $list[$post->ID] = $post->post_title;
    }

    return $list;
}

function get_all_contents_list()
{
    $list   = array();
    $pages  = get_content_type_posts('page', -1);
    $news   = get_content_type_posts('post', -1);
    $events = get_content_type_posts('event', -1);

    foreach ($pages as $post) {
        $list[$post->ID] = $post->post_title;
    }

    foreach ($news as $post) {
        $list[$post->ID] = $post->post_title;
    }

    foreach ($events as $post) {
        $list[$post->ID] = $post->post_title;
    }

    return $list;
}
