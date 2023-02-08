<?php
/*
* Template name: Areas
*/
get_header();

$areas = new WP_Query(array(
   'post_type' => 'area',
   'posts_per_page' => -1,
   'post_status' => 'publish',
   'orderby' => 'menu_order',
   'order' => 'ASC',
   'tax_query' => array(
      array(
         'taxonomy' => 'area_category',
         'field' => 'slug',
         'terms' => 'primary',
      )
   )
));

get_template_part('parts/titles/title-area');
?>
<main class="section">
   <div class="grid-container">
      <div class="grid-x grid-padding-x grid-padding-y">
         <div class="cell">
            <?php get_template_part('parts/page/breadcrumbs'); ?>
         </div>
         <?php
         if ($areas->have_posts()) {
            echo '<div class="cell large-6">';
            echo '<h3 class="header--underline">Practice areas</h3>';
            echo '<div class="grid-x grid-margin-x">';
            $total = $areas->found_posts;
            $per_column = ceil($total / 2);
            echo '<div class="cell medium-6 flex-container flex-dir-column">';
            while ($areas->have_posts()) {
               $areas->the_post();
               $link = get_the_permalink();
               $title = get_the_title();
               echo '<a href="' . esc_url($link) . '" title="' . esc_attr($title) . '">' . esc_html($title) . '</a>';
               if ($areas->current_post && ($areas->current_post + 1) % $per_column === 0) echo '</div><div class="cell medium-6 flex-container flex-dir-column">';
            }
            echo '</div>';
            echo '</div>';
            echo '</div>';
            wp_reset_postdata();
         }
         ?>
      </div>
   </div>
</main>
<?php
get_footer();
?>