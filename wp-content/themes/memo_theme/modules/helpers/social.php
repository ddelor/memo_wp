<?php

function get_social_urls()
{
    $facebook_url  = 'https://www.facebook.com/211982662152792';

    return array(
        'facebook_url'  => $facebook_url,
    );
}

function nice_time($time)
{
    $delay   = time() - $time;
    $minutes = $delay / 60;
    if($minutes <= 1){
        return "à l'instant";
    }elseif($minutes < 60){
        return "Il y a " . floor($minutes) . " min";
    }elseif($minutes >= 60 && $minutes < 1440){
        $heures = $minutes / 60;
        return "Il y a " . floor($heures) . " h";
    }elseif($minutes > 1440 && ($minutes / 1440) <= 31){
        $jours = $minutes / 1440;
        return "Il y a " . floor($jours) . " jours";
    }elseif( ($minutes / 1440) > 30.5 && ($minutes / 1440) <= 365 ){
        $mois = ($minutes / 1440) / 30.5;
        return "Il y a " . floor($mois) . " mois";
    }elseif( ($minutes / 1440) > 365 ){
        $ans = ($minutes / 1440) / 365;
        if( floor($ans) == 1 ){
            return "Il y a " . floor($ans) . " an";
        }
        return "Il y a " . floor($ans) . " ans";
    }
    return "Il y a 0 min";
}

function filename($module)
{
    $wp_upload_dir = wp_upload_dir();
    $dir           = $wp_upload_dir['basedir'] . '/cache';

    if (!is_dir($dir)) {
        @mkdir($dir, 0755);
    }

    return $dir . '/social_' . $module;
}

function get_cache($module)
{
    $filename = filename($module);

    $expire   = time() -3600 ;

    if(file_exists($filename) and filemtime($filename) > $expire) {
        return json_decode(file_get_contents($filename));
    }

    return false;
}

function set_cache($module, $content)
{
    $filename = filename($module);

    file_put_contents(
        $filename,
        $content
    );
}

function get_facebook_last_posts($limit)
{
    $module_name = 'facebook';

    $response    = get_cache($module_name);

    if (!$response) {
        $page_id    = '211982662152792';
        $app_id     = '355241041596241';
        $app_secret = 'c969cc3b72400b95753fe3c4029b4570';

        $path       = "https://graph.facebook.com/" . $page_id . "/posts?access_token=" . $app_id . "|" . $app_secret . "&fields=full_picture,message,created_time,story&lang=FR";
        $data       = file_get_contents($path);

        $result     = json_decode($data);

        set_cache($module_name, $data);
    } else {
        $result = $response;
    }

    $last_posts = array();

    if ($result) {
        $last_posts = array_slice($result->data, 0, $limit);
    }

    return $last_posts;
}
