<?php get_header();
$content = get_the_content();
$sections = get_field('profile_sections');
$areas = get_field('area_sections');

$related_news = new WP_Query([
   'post_type' => 'post',
   'post_status' => 'publish',
   'posts_per_page' => 6,
   'orderby' => 'date',
   'order' => 'desc',
   'meta_query' => [
      [
         'key' => 'related_barristers',
         'value' => get_the_ID(),
         'compare' => '='
      ]
   ]
]);

$related_events = new WP_Query([
   'post_type' => 'event',
   'post_status' => 'publish',
   'posts_per_page' => 6,
   'orderby' => 'start_date',
   'order' => 'asc',
   'meta_query' => [
      [
         'key' => 'related_barristers',
         'value' => get_the_ID(),
         'compare' => '='
      ]
   ]
]);

$related_cases = new WP_Query([
   'post_type' => 'case',
   'post_status' => 'publish',
   'posts_per_page' => 6,
   'orderby' => 'start_date',
   'order' => 'asc',
   'meta_query' => [
      [
         'key' => 'related_barristers',
         'value' => get_the_ID(),
         'compare' => '='
      ]
   ]
]);

$related_newsletters = new WP_Query([
   'post_type' => 'newsletter',
   'post_status' => 'publish',
   'posts_per_page' => 6,
   'orderby' => 'start_date',
   'order' => 'asc',
   'meta_query' => [
      [
         'key' => 'related_barristers',
         'value' => get_the_ID(),
         'compare' => '='
      ]
   ]
]);

$related_publications = new WP_Query([
   'post_type' => 'publication',
   'post_status' => 'publish',
   'posts_per_page' => 6,
   'orderby' => 'start_date',
   'order' => 'asc',
   'meta_query' => [
      [
         'key' => 'related_barristers',
         'value' => get_the_ID(),
         'compare' => '='
      ]
   ]
]);
?>

<main class="section grid-container">

   <?php get_template_part('parts/person/banner', 'person'); ?>

   <?php get_template_part('parts/layout/breadcrumbs'); ?>

   <section class="grid-x grid-padding-x grid-padding-y main">

      <div class="grid-container">
         <div class="grid-x grid-margin-x grid-margin-y">
            <div class="cell large-4 show-for-large">

               <ul class="vertical tabs show-for-large sidebar-widget heading-line" data-tabs id="profile-tabs" data-deep-link="true" data-deep-link-smudge="true" data-deep-link-smudge-offset="200" data-deep-link-smudge-delay="600">
                  <li class="tabs-title is-active">
                     <a href="#overview" aria-selected="true">
                        <h2><?php _e('Overview', 'squareeye'); ?></h2>
                     </a>
                  </li>
                  <?php

                  if ($areas) {
                     $current_area_i = 1;
                     foreach ($areas as $area) {
                        if ($area['hide_from_barrister']) continue;
                        $area_title = $area['title_variation'] ? $area['title_variation'] : get_the_title($area['area']->ID);
                        $area_slug = sanitize_title($area_title) . '-' . $current_area_i;
                        $current_area_i++;
                        echo '<li class="tabs-title"><a href="#' . esc_attr($area_slug) . '" title="' . esc_attr($area_title) . '"><h2>' . $area_title . '</h2></a></li>';
                     }
                  }

                  if ($sections) {
                     foreach ($sections as $section) {
                        echo '<li class="tabs-title"><a href="#' . sanitize_title($section['heading']) . '" title="' . esc_attr($section['heading']) . '"><h2>' . esc_html($section['heading']) . '</h2></a></li>';
                     }
                  }

                  if ($related_news->have_posts()) {
                     echo '<li class="tabs-title"><a href="#news" title="' . __('News', 'squareeye') . '"><h2>' . __('News', 'squareeye') . '</h2></a></li>';
                  }

                  if ($related_events->have_posts()) {
                     echo '<li class="tabs-title"><a href="#events" title="' . __('Events', 'squareeye') . '"><h2>' . __('Events', 'squareeye') . '</h2></a></li>';
                  }

                  if ($related_cases->have_posts()) {
                     echo '<li class="tabs-title"><a href="#cases" title="' . __('Cases', 'squareeye') . '"><h2>' . __('Cases', 'squareeye') . '</h2></a></li>';
                  }

                  if ($related_publications->have_posts()) {
                     echo '<li class="tabs-title"><a href="#publications" title="' . __('Publications', 'squareeye') . '"><h2>' . __('Publications', 'squareeye') . '</h2></a></li>';
                  }

                  if ($related_newsletters->have_posts()) {
                     echo '<li class="tabs-title"><a href="#newsletters" title="' . __('Newsletters', 'squareeye') . '"><h2>' . __('Newsletters', 'squareeye') . '</h2></a></li>';
                  }
                  ?>
               </ul>

               <?php getClerkingTeam($id); ?>

            </div>
            <div class="cell large-8">
               <div class="tabs-content tabs-content--responsive vertical" data-tabs-content="profile-tabs">
                  <div class="tabs-panel is-active" id="overview">
                     <div class="person-overview">
                        <?php the_content(); ?>
                     </div>
                  </div>
                  <?php
                  if ($areas) {
                     $current_area_i = 1;
                     foreach ($areas as $area) {
                        if ($area['hide_from_barrister']) continue;
                        $area_title = $area['title_variation'] ? $area['title_variation'] : get_the_title($area['area']->ID);
                        $area_slug = sanitize_title($area_title) . '-' . $current_area_i;
                        $current_area_i++;



                        $area_text = $area['text'];
                        // $cases = $area['cases'];

                        echo '<div class="tabs-panel" id="' . $area_slug . '">';
                        echo '<h2>' . esc_html($area_title) . '</h2>';
                        echo wpautop(wp_kses_post($area_text));
                        // if ($cases) {
                        //    echo '<h4>' . __('Featured cases', 'squareeye') . '</h4>';
                        //    echo wpautop(wp_kses_post($cases));
                        // }
                        echo '</div>';
                     }
                  }

                  if ($sections) {
                     foreach ($sections as $section) {
                        $heading = $section['heading'];
                        $text = $section['text'];

                        echo '<div class="tabs-panel" id="' . sanitize_title($heading) .  '">';

                        echo '<h2>' . esc_html($heading) . '</h2>';
                        echo wpautop(wp_kses_post($text));

                        echo '</div>';
                     }
                  }

                  if ($related_news->have_posts()) {
                     echo '<div class="tabs-panel" id="news">';
                     echo '<h2>Related news</h2>';

                     echo '<ul class="posts-list">';
                     while ($related_news->have_posts()) {
                        $related_news->the_post();
                        get_template_part('parts/loop/loop', 'list');
                     }
                     echo '</ul>';
                     echo '</div>';
                     wp_reset_postdata();
                  }

                  if ($related_events->have_posts()) {
                     echo '<div class="tabs-panel" id="events">';
                     echo '<h2>Related events</h2>';

                     echo '<ul class="posts-list">';
                     while ($related_events->have_posts()) {
                        $related_events->the_post();
                        get_template_part('parts/loop/loop', 'list');
                     }
                     echo '</ul>';
                     echo '</div>';
                     wp_reset_postdata();
                  }

                  if ($related_cases->have_posts()) {
                     echo '<div class="tabs-panel" id="cases">';
                     echo '<h2>Related cases</h2>';

                     echo '<ul class="posts-list">';
                     while ($related_cases->have_posts()) {
                        $related_cases->the_post();
                        get_template_part('parts/loop/loop', 'list');
                     }
                     echo '</ul>';
                     echo '</div>';
                     wp_reset_postdata();
                  }

                  if ($related_publications->have_posts()) {
                     echo '<div class="tabs-panel" id="publications">';
                     echo '<h2>Related publications</h2>';

                     echo '<ul class="posts-list">';
                     while ($related_publications->have_posts()) {
                        $related_publications->the_post();
                        get_template_part('parts/loop/loop', 'list');
                     }
                     echo '</ul>';
                     echo '</div>';
                     wp_reset_postdata();
                  }

                  if ($related_newsletters->have_posts()) {
                     echo '<div class="tabs-panel" id="newsletters">';

                     echo '<h2>Related newsletter</h2>';
                     echo '<ul class="posts-list">';
                     while ($related_newsletters->have_posts()) {
                        $related_newsletters->the_post();
                        get_template_part('parts/loop/loop', 'list');
                     }
                     echo '</ul>';
                     echo '</div>';
                     wp_reset_postdata();
                  }
                  ?>
               </div>
               <?php get_template_part('parts/layout/share'); ?>
            </div>

         </div>
      </div>

   </section>

</main>

<?php get_footer(); ?>