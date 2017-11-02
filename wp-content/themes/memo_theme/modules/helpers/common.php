<?php

function get_template_type($id)
{
    $post         = get_post($id);
    $template     = $post->_wp_page_template;
    $templateType = str_replace(array('template-page-', '.php'), array('', ''), $template);

    return $templateType;
}

function get_template_id($template_string)
{
    // $template_string - Ex : template-products.php
    global $wpdb;
    $template_id = $wpdb->get_var("SELECT pm.post_id FROM {$wpdb->base_prefix}postmeta pm, {$wpdb->base_prefix}posts p WHERE pm.meta_key = '_wp_page_template' AND pm.meta_value = '" . $template_string . "' AND p.post_status = 'publish' AND p.ID = pm.post_id");
    return $template_id;
}

function get_template_post($template_string)
{
    $template_id = get_template_id($template_string);
    if($template_id){
        return get_post(get_template_id($template_string));
    }
    return false;
}

function get_template_url($template_string)
{
    $template_id = get_template_id($template_string);
    if($template_id){
        return get_permalink(get_template_id($template_string));
    }
    return false;
}

function get_video($url)
{
    $videoID = null;
    $video   = null;
    $params  = null;

    if (!empty($url))
    {
        if (preg_match('/\byoutube\b/i', $url))
        {
            if (preg_match('/\bembed\b/i', $url)) {
                $videoID = str_replace('https://www.youtube.com/embed/', '', $url);
                $video   = $url;
            } else {
                $videoID = str_replace('https://www.youtube.com/watch?v=', '', $url);
                $video   = 'https://www.youtube.com/embed/' . $videoID;
            }
            $params = '?rel=0&wmode=transparent&autoplay=1';
        }
        elseif (preg_match('/\byoutu\b/i', $url))
        {
            $videoID = str_replace('https://youtu.be/', '', $url);
            $video   = 'https://www.youtube.com/embed/' . $videoID;
            $params = '?rel=0&wmode=transparent&autoplay=1';
        }
        elseif (preg_match('/\bvimeo\b/i', $url))
        {
            if (preg_match('/\bplayer\b/i', $url)) {
                $videoID = str_replace('https://player.vimeo.com/video/', '', $url);
                $video   = $url;
            } else {
                $videoID = str_replace('https://vimeo.com/', '', $url);
                $video   = 'https://player.vimeo.com/video/' . $videoID;
            }
            $params = '?byline=0&badge=0&autoplay=1';
        }
    }

    if (!is_null($video)) {
        $video     = $video . $params;
    }

    return array(
        'videoID'   => $videoID,
        'video'     => $video
    );
}

function truncate($string, $limit, $break=" ", $pad="...")
{
    if(strlen($string) <= $limit) return $string;

    if(false !== ($breakpoint = strpos($string, $break, $limit))) {
        if($breakpoint < strlen($string) - 1) {
            $string = substr($string, 0, $breakpoint) . $pad;
        }
    }

    return $string;
}

function cmp_order_array($a, $b)
{
    return strcmp($a['order'], $b['order']);
}

function cmp_order_object($a, $b)
{
    return strcmp($a->order, $b->order);
}
