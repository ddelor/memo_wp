<?php

function get_slide_title($slide)
{
    $title       = '<span>' . $slide->post_title . '</span>';
    $slide_title = (IS_MOBILE and !IS_TABLET) ? $slide->SL_single_push_title_mobile : $slide->SL_single_push_title;

    if (!empty($slide_title))
    {
        $title             = '';
        $slide_title_exp = explode(PHP_EOL, $slide_title);

        foreach ($slide_title_exp as $key => $value) {
            if ($key == 0) {
                $title .= '<span>' . $value . '</span><br>';
            } else {
                $title .= $value;
                if (($key + 1) < count($slide_title_exp)) {
                    $title .= '<br>';
                }
            }
        }
    }

    return $title;
}
