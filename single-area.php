<?php get_header();

$id = get_the_ID();
$area_id = $id;
?>

<?php get_template_part('parts/banners/banner', 'area'); ?>

<main class="section grid-container">

   <?php get_template_part('parts/layout/breadcrumbs'); ?>

   <section class="grid-x grid-padding-x grid-padding-y main">

      <div class="cell small-12 medium-2 large-3">
         <?php get_sidebar('left'); ?>
      </div>

      <div class="cell small-12 medium-8 large-6 content">

         <?php the_post_thumbnail('landscape'); ?>

         <?php the_content(); ?>

         <?php get_template_part('parts/layout/accordion'); ?>

         <?php get_template_part('parts/layout/share'); ?>

         <div class="cell related-content">
            <?php
            // WP_Query arguments
            $args = array(
               'post_type' => 'barrister',
               'nopaging'               => true,
               'posts_per_page'         => '-1',
               'order'                  => 'ASC',
               'orderby'                => 'menu_order',
               'meta_query' => array(
                  array(
                     'key'     => 'related_areas',
                     'value'   => $id,
                  ),
               ),
            );

            $pa = isset($_REQUEST['pa']);
            if ($pa) {
               $args['tax_query'] = array(
                  array(
                     'taxonomy' => 'barrister_category',
                     'field'    => 'slug',
                     'terms'    => 'public-access',
                  ),
               );
            }

            // The Query
            $barristers = new WP_Query($args);

            // The Loop
            if ($barristers->have_posts()) { ?>

               <div class="team margin-top-2">
                  <h3 class="heading-line">Our team</h3>
                  <div class="grid-x related-items grid-margin-x grid-margin-y">

                     <?php
                     while ($barristers->have_posts()) {
                        $barristers->the_post();

                        $args = array(
                           'id' => get_the_id(),
                           'columns' => 3
                        );

                        get_template_part('parts/loop/loop', 'barrister', $args);
                     }

                     // Restore original Post Data
                     wp_reset_postdata();
                     ?>
                  </div>
               </div>
            <?php } ?>

            <?php
            $related_clerks = get_post_meta($id, 'related_clerks');
            if ($related_clerks) { ?>
               <div class="team margin-top-2">
                  <h2>Contact the Clerks</h2>
                  <div class="grid-x related-items grid-margin-x grid-margin-y">
                     <?php foreach ($related_clerks as $related_clerk) {
                        if (isset($related_clerk)) {
                           $args = array(
                              'id' => $related_clerk['ID'],
                              'columns' => 3
                           );
                           get_template_part('parts/loop/loop', 'clerk', $args);
                        }
                     } ?>
                  </div>
               </div>
            <?php } ?>

            <?php

            // Related News
            $related_news = getRelatedQuery(
               array(
                  'type' => 'post',
                  'limit' => -1,
                  'orderby' => 'date',
                  'order' => 'DESC',
               )
            );

            if ($related_news->have_posts()) {

               echo '<h2 class="margin-top-2">Related news</h2>';
               echo '<div class="grid-x related-items__small grid-margin-x grid-margin-y margin-top-1">';

               $total_news = $related_news->found_posts;
               while ($related_news->have_posts()) {
                  $related_news->the_post();

                  $args = array(
                     'id' => get_the_ID(),
                     'columns' => 3,
                  );

                  get_template_part('parts/loop/loop', '', $args);
                  if ($related_news->current_post >= 2) break;
               }

               if ($total_news > 3) { ?>
                  <p class="cell"><a class="tiny button" href="<?php echo get_permalink(get_option('page_for_posts')); ?>?a=<?php echo $area_id; ?>">All <?php echo get_the_title($area_id) ?> news</a></p>
            <?php }

               echo '</div>';

               wp_reset_query();
            } ?>

            <?php

            // Related publications
            $related_publications = getRelatedQuery(
               array(
                  'type' => 'publication',
                  'limit' => -1,
                  'orderby' => 'date',
                  'order' => 'DESC',
               )
            );

            if ($related_publications->have_posts()) {

               echo '<h2 class="margin-top-2">Related publications</h2>';
               echo '<div class="grid-x related-items__small grid-margin-x grid-margin-y margin-top-1">';

               $total_publications = $related_publications->found_posts;
               while ($related_publications->have_posts()) {
                  $related_publications->the_post();

                  $args = array(
                     'id' => get_the_ID(),
                     'columns' => 3,
                  );

                  get_template_part('parts/loop/loop', '', $args);
                  if ($related_publications->current_post >= 2) break;
               }

               if ($total_publications > 3) { ?>
                  <p class="cell"><a class="tiny button" href="<?php echo get_permalink(get_option('page_for_posts')); ?>?a=<?php echo $area_id; ?>">All <?php echo get_the_title($area_id) ?> Publications</a></p>
            <?php }

               echo '</div>';

               wp_reset_query();
            } ?>
            <?php
            // Related Events
            $related_events = getRelatedQuery(
               array(
                  'type' => 'event',
                  'limit' => -1,
                  'orderby' => 'meta_value',
                  'metakey' => 'start_date',
                  'order' => 'DESC',
               )
            );

            if ($related_events->have_posts()) {
               echo '<h2 class="margin-top-2">Related events</h2>';
               echo '<div class="grid-x related-items__small grid-margin-x grid-margin-y margin-top-1">';

               $total_events = $related_events->found_posts;
               while ($related_events->have_posts()) {
                  $related_events->the_post();

                  $args = array(
                     'id' => get_the_ID(),
                     'columns' => 3
                  );

                  get_template_part('parts/loop/loop', 'event', $args);

                  if ($related_events->current_post >= 3) break;
               }

               if ($total_events > 3) { ?>
                  <p class="cell"><a class="tiny button" href="<?php echo esc_url(home_url('/news-events/events/')); ?>?a=<?php echo $area_id; ?>">All <?php echo get_the_title($area_id) ?> events</a></p>

            <?php }

               echo '</div>';
            }

            wp_reset_query();
            ?>
         </div>

      </div>

      <div class="cell small-12 medium-2 large-3">
         <?php get_sidebar('right'); ?>
      </div>

   </section>

</main>

<?php get_footer(); ?>