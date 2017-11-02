<?php

function registerMenus()
{
   register_nav_menus(
       array(
           'header' => __('Header Navigation'),
           'footer' => __('Footer Navigation'),
       )
   );
}

add_action('init', 'registerMenus');
