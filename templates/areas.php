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

get_template_part('parts/title/title');
?>
<main class="section">
   <div class="grid-container">
      <?php get_template_part('parts/layout/breadcrumbs'); ?>
      <section class="grid-x grid-padding-x grid-padding-y main">
         <?php
         if ($areas->have_posts()) {


            while ($areas->have_posts()) {
               $areas->the_post();
               get_template_part('parts/loop/loop', 'area');
            }

            wp_reset_postdata();
         }
         ?>
      </section>
   </div>
</main>
<?php
get_footer();
?>