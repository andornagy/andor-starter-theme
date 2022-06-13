<?php
if (function_exists('acf_add_options_page')) {

  $parent = acf_add_options_page(array(
    'page_title' => WEBSITE_NAME,
    'menu_title' => WEBSITE_NAME,
    'menu_slug' => 'theme-general-settings',
    'capability' => 'edit_posts',
    'redirect' => true,
    'icon_url' => 'dashicons-admin-generic',
    'position' => 3
  ));
  
   acf_add_options_sub_page(array(
    'page_title'  => __('Defaults'),
    'menu_title'  => __('Defaults'),
    'parent_slug' => $parent['menu_slug'],
  ));

  acf_add_options_sub_page(array(
    'page_title'  => __('Contact details'),
    'menu_title'  => __('Contact details'),
    'parent_slug' => $parent['menu_slug'],
  ));

  acf_add_options_sub_page(array(
    'page_title'  => __('Footer'),
    'menu_title'  => __('Footer'),
    'parent_slug' => $parent['menu_slug'],
  ));
}
