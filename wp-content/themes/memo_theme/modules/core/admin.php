<?php

function removeDashboardWidgets()
{
  remove_meta_box('dashboard_right_now', 'dashboard', 'normal');
  remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
  remove_meta_box('dashboard_primary', 'dashboard', 'side');
  remove_meta_box('dashboard_secondary', 'dashboard', 'side');
  remove_meta_box('dashboard_activity', 'dashboard', 'normal');
}

function removeEditorMenu()
{
    remove_action('admin_menu', '_add_themes_utility_last', 101);
}

function menuPages()
{
    remove_menu_page('edit-comments.php');
    // remove_menu_page('plugins.php');

    // remove_menu_page('index.php');
    // remove_menu_page('themes.php');
    // remove_menu_page('edit.php');
    // remove_submenu_page( 'edit.php', 'edit-tags.php?taxonomy=post_tag' );   // Remove posts->tags submenu
    // remove_submenu_page( 'edit.php', 'edit-tags.php?taxonomy=category' );   // Remove posts->categories submenu
}

function adminBarRender()
{
    global $wp_admin_bar;

    $wp_admin_bar->remove_menu('comments');
    $wp_admin_bar->remove_menu('new-content');
    $wp_admin_bar->remove_menu('wp-logo');
}

function menuOrder($menu_ord) {
   if (!$menu_ord) return true;

   return array(
       'index.php', // Dashboard
       'separator1', // First separator
       'edit.php', // Posts
       'edit.php?post_type=town', // Town
       'edit.php?post_type=page', // Pages
       'link-manager.php', // Links
       'upload.php', // Media
       'edit-comments.php', // Comments
       'separator2', // Second separator
       'themes.php', // Appearance
       'plugins.php', // Plugins
       'users.php', // Users
       'tools.php', // Tools
       'options-general.php', // Settings
       'separator-last', // Last separator
   );
}

function revcon_change_post_label()
{
    global $menu;
    global $submenu;
    $menu[5][0] = 'Actualités';
    $submenu['edit.php'][5][0] = 'Actualités';
    $submenu['edit.php'][10][0] = 'Ajouter';
    echo '';
}

function revcon_change_post_object()
{
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = 'Actualités';
    $labels->singular_name = 'Actualités';
    $labels->add_new = 'Ajouter';
    $labels->add_new_item = 'Ajouter une actualité';
    $labels->edit_item = 'Modifier l\'Actualité';
    $labels->new_item = 'Actualités';
    $labels->view_item = 'Voir les Actualités';
    $labels->search_items = 'Rechercher une Actualité';
    $labels->not_found = 'Aucune Actualité trouvé';
    $labels->not_found_in_trash = 'Aucune Actualité trouvé dans la Corbeille';
    $labels->all_items = 'Toutes les Actualités';
    $labels->menu_name = 'Actualités';
    $labels->name_admin_bar = 'Actualités';
}

add_action('wp_dashboard_setup', 'removeDashboardWidgets');
add_action('admin_menu', 'menuPages');
add_action('admin_menu', 'removeEditorMenu');
add_action('admin_menu', 'revcon_change_post_label');
add_action('init', 'revcon_change_post_object');
add_action('wp_before_admin_bar_render', 'adminBarRender');
add_filter('menu_order', 'menuOrder');
add_filter('custom_menu_order', 'menuOrder');
