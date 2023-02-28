<div class="grid-x grid-padding-x grid-padding-y crumbs-wrapper">
   <div class="cell">
      <?php
      global $post;

      $separator = '<li class="separator">></li>';

      echo '<ul class="breadcrumbs">';
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
         echo '<li>' . __('Search Results', 'squareeye') . '</li>';
      } else {
         echo '<li><a href="';
         echo home_url();
         echo '">';
         echo __('Home', 'squareeye');
         echo '</a></li>' . $separator;
         if (is_home()) {
            echo '<li>' . get_the_title(get_option('page_for_posts', true)) . '</li>';
         } elseif (is_singular('area')) {
            echo '<li><a href="' . site_url('areas') . '" title="' . __('Areas', 'squareeye') . '">' . __('Areas', 'squareeye') . '</a></li>' . $separator;
            echo '<li>' . get_the_title() . '</li>';
         } elseif (is_singular('barrister')) {
            echo '<li><a href="' . site_url('barristers') . '" title="' . __('Barristers', 'squareeye') . '">' . __('Barristers', 'squareeye') . '</a></li>' . $separator;
            echo '<li>' . get_the_title() . '</li>';
         } elseif (is_singular('case')) {
            echo '<li><a href="' . site_url('cases') . '" title="' . __('Cases', 'squareeye') . '">' . __('Cases', 'squareeye') . '</a></li>' . $separator;
            echo '<li>' . get_the_title() . '</li>';
         } elseif (is_singular('clerk')) {
            echo '<li><a href="' . site_url('clerks') . '" title="' . __('Clerks', 'squareeye') . '">' . __('Clerks', 'squareeye') . '</a></li>' . $separator;
            echo '<li>' . get_the_title() . '</li>';
         } elseif (is_singular('publication')) {
            echo '<li><a href="' . site_url('publications') . '" title="' . __('Publications', 'squareeye') . '">' . __('Publications', 'squareeye') . '</a></li>' . $separator;
            echo '<li>' . get_the_title() . '</li>';
         } elseif (is_singular('event')) {
            echo '<li><a href="' . site_url('events') . '" title="' . __('Events', 'squareeye') . '">' . __('Events', 'squareeye') . '</a></li>' . $separator;
            echo '<li>' . get_the_title() . '</li>';
         } elseif (is_single()) {
            $blog_id = get_option('page_for_posts', true);
            echo '<li><a href="' . get_the_permalink($blog_id) . '" title="' . get_the_title($blog_id) . '">' . get_the_title($blog_id) . '</a></li>' . $separator;
            echo '<li>' . get_the_title() . '</li>';
         } elseif (is_tax() || is_category()) {
            echo '<li>';
            $term = get_queried_object();
            echo $term->name;
            echo '</li>';
         } elseif (is_page()) {
            if ($post->post_parent) {
               $anc = get_post_ancestors($post->ID);
               $title = get_the_title();
               foreach ($anc as $ancestor) {
                  $output = '<li><a href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '">' . get_the_title($ancestor) . '</a></li> ' . $separator;
               }
               echo $output;
               echo $title;
            } else {
               echo '<li>' . get_the_title() . '</li>';
            }
         }
      }
      echo '</ul>';

      ?>

   </div>
</div>