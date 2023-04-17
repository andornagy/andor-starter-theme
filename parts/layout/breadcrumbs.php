<?php
global $post;

$title = wp_trim_words(get_the_title(), 6, '...');

$separator = '<li class="separator">></li>';

echo '<div class="container">';

echo '<ul class="breadcrumbs">';
if (!is_front_page()) {
   echo '<li><a href="';
   echo get_option('home');
   echo '">';
   echo __('Home', 'squareeye');
   echo '</a></li>' . $separator;
}

if (is_tag()) {
   single_tag_title();
} elseif (is_day()) {
   echo '<li>' . sprintf(__('Archive for %s', 'squareeye'), get_the_time('F jS, Y')) . '</li>';
} elseif (is_month()) {
   echo '<li>' . sprintf(__('Archive for %s', 'squareeye'), get_the_time('F, Y')) . '</li>';
} elseif (is_year()) {
   echo '<li>' . sprintf(__('Archive for %s', 'squareeye'), get_the_time('Y')) . '</li>';
} elseif (is_author()) {
   echo '<li>' . __('Author Archive', 'squareeye') . '</li>';
} elseif (is_search()) {
   echo '<li>' . __('Search results', 'squareeye') . '</li>';
} else {

   $dispay_title = true;

   if (is_home()) {
      echo '<li>' . get_the_title(get_option('page_for_posts', true)) . '</li>';
      $dispay_title = false;

      // Single barrister
   } elseif (is_singular('barrister')) {
      echo '<li><a href="' . site_url('people/barristers') . '" title="' . __('Barristers', 'squareeye') . '">' . __('Barristers', 'squareeye') . '</a></li>' . $separator;

      // Single clerk
   } elseif (is_singular('clerk')) {
      echo '<li><a href="' . site_url('people/clerks') . '" title="' . __('Clerks', 'squareeye') . '">' . __('Clerks', 'squareeye') . '</a></li>' . $separator;

      // Single area
   } elseif (is_singular('area')) {
      echo '<li><a href="' . site_url('expertise') . '" title="' . __('Expertise', 'squareeye') . '">' . __('Expertise', 'squareeye') . '</a></li>' . $separator;

      // Single event
   } elseif (is_singular('event')) {
      echo '<li><a href="' . site_url('events') . '" title="' . __('Events', 'squareeye') . '">' . __('Events', 'squareeye') . '</a></li>' . $separator;

      // Single publication
   } elseif (is_singular('publication')) {
      echo '<li><a href="' . site_url('publications') . '" title="' . __('Publications', 'squareeye') . '">' . __('Publications', 'squareeye') . '</a></li>' . $separator;

      // Single book
   } elseif (is_singular('book')) {
      echo '<li><a href="' . site_url('books') . '" title="' . __('Books', 'squareeye') . '">' . __('Books', 'squareeye') . '</a></li>' . $separator;

      // Single post
   } elseif (is_single()) {

      if (in_category('articles')) {
         $archive_link = site_url('publications/articles');
         $archive_title = __('Articles', 'squareeye');
      } else if (in_category('presentations')) {
         $archive_link = site_url('publications/presentations');
         $archive_title = __('Presentations', 'squareeye');
      } else {
         $blog_id = get_option('page_for_posts', true);
         $archive_link = get_the_permalink($blog_id);
         $archive_title = get_the_title($blog_id);
      }


      echo '<li><a href="' . $archive_link . '" title="' . $archive_title . '">' . $archive_title . '</a></li>' . $separator;

      // Taxonomy or category
   } elseif (is_tax() || is_category()) {
      $term = get_queried_object();
      echo '<li>' . $term->name . '</li>';
      $dispay_title = false;
   } elseif (is_404()) {
      echo '<li>404</li>';
      $dispay_title = false;
   } elseif (is_page()) {
      if ($post->post_parent) {
         $anc = get_post_ancestors($post->ID);
         $title = $title;
         foreach ($anc as $ancestor) {
            $output = '<li><a href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '">' . get_the_title($ancestor) . '</a></li> ' . $separator;
         }
         echo $output;
      }
   }

   if ($dispay_title) echo '<li>' . $title . '</li>';
}
echo '</ul>';
echo '</div>';
