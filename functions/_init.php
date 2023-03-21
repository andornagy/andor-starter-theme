<?php

add_action('after_setup_theme', 'sqe_theme_features');

function sqe_theme_features()
{
   add_theme_support('title-tag');
   add_theme_support('responsive-embeds');
   add_theme_support('post-thumbnails');
   add_theme_support('editor-styles');
}


/**
 * Clean up WordPress defaults
 */
if (!function_exists('sqe_theme_start_cleanup')) :
   function sqe_theme_start_cleanup()
   {

      // Launching operation cleanup.
      add_action('init', 'sqe_theme_cleanup_head');

      // Remove WP version from RSS.
      add_filter('the_generator', 'sqe_theme_remove_rss_version');

      // Remove pesky injected css for recent comments widget.
      add_filter('wp_head', 'sqe_theme_remove_wp_widget_recent_comments_style', 1);

      // Clean up comment styles in the head.
      add_action('wp_head', 'sqe_theme_remove_recent_comments_style', 1);
   }
   add_action('after_setup_theme', 'sqe_theme_start_cleanup');
endif;

/**
 * Clean up head.
 * ----------------------------------------------------------------------------
 */

if (!function_exists('sqe_theme_cleanup_head')) :
   function sqe_theme_cleanup_head()
   {

      // EditURI link.
      remove_action('wp_head', 'rsd_link');

      // Category feed links.
      remove_action('wp_head', 'feed_links_extra', 3);

      // Post and comment feed links.
      remove_action('wp_head', 'feed_links', 2);

      // Windows Live Writer.
      remove_action('wp_head', 'wlwmanifest_link');

      // Index link.
      remove_action('wp_head', 'index_rel_link');

      // Previous link.
      remove_action('wp_head', 'parent_post_rel_link', 10);

      // Start link.
      remove_action('wp_head', 'start_post_rel_link', 10);

      // Canonical.
      remove_action('wp_head', 'rel_canonical', 10);

      // Shortlink.
      remove_action('wp_head', 'wp_shortlink_wp_head', 10);

      // Links for adjacent posts.
      remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);

      // WP version.
      remove_action('wp_head', 'wp_generator');

      // Emoji detection script.
      remove_action('wp_head', 'print_emoji_detection_script', 7);

      // Emoji styles.
      remove_action('wp_print_styles', 'print_emoji_styles');
   }
endif;

// Remove WP version from RSS.
if (!function_exists('sqe_theme_remove_rss_version')) :
   function sqe_theme_remove_rss_version()
   {
      return '';
   }
endif;

// Remove injected CSS for recent comments widget.
if (!function_exists('sqe_theme_remove_wp_widget_recent_comments_style')) :
   function sqe_theme_remove_wp_widget_recent_comments_style()
   {
      if (has_filter('wp_head', 'wp_widget_recent_comments_style')) {
         remove_filter('wp_head', 'wp_widget_recent_comments_style');
      }
   }
endif;

// Remove injected CSS from recent comments widget.
if (!function_exists('sqe_theme_remove_recent_comments_style')) :
   function sqe_theme_remove_recent_comments_style()
   {
      global $wp_widget_factory;
      if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
         remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
      }
   }
endif;

// Check if wp_body_open hook exists or not, if missing add it.
if (!function_exists('wp_body_open')) {
   function wp_body_open()
   {
      /**
       * Triggered after the opening body tag.
       *
       * @since 5.2.0
       */
      do_action('wp_body_open');
   }
}

// Disable Gutenberg style files
add_filter('wp_enqueue_scripts', function () {
   wp_dequeue_style('wp-block-library');
   wp_dequeue_style('wp-block-library-theme');
}, 100);
