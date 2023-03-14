<?php
$insights = new WP_Query([
   'post_type' => 'post',
   'post_status' => 'publish',
   'posts_per_page' => 9,
   'orderby' => 'date',
   'order' => 'desc'
]);

if ($insights->have_posts()) {
?>
   <section class="section home-insights">
      <div class="grid-container">
         <div class="splide" role="group" aria-label="<?php _e('Insights carousel', 'squareye'); ?>" data-per-page="4" data-per-page-medium="2" data-per-page-small="1">
            <div class="flex-container align-middle align-justify margin-bottom-2">
               <h2 class="theme-title margin-bottom-0"><?php _e('Insights', 'squareeye'); ?></h2>
               <div class="splide__arrows"></div>
            </div>
            <div class="splide__track">
               <ul class="splide__list">
                  <?php
                  while ($insights->have_posts()) {
                     $insights->the_post();
                     echo '<li class="splide__slide">';
                     get_template_part('parts/loop/loop', '', ['no_columns' => true]);
                     echo '</li>';
                  }
                  ?>
               </ul>
            </div>
            <div class="flex-container flex-dir-column large-flex-dir-row align-top large-align-middle align-justify padding-top-1 large-padding-top-2">
               <a href="<?php echo site_url('insights'); ?>" title="<?php _e('All insights', 'squareeye'); ?>" class="button margin-right-1 large-margin-bottom-0 small-order-2 large-order-1"><?php _e('All insights', 'squareeye'); ?></a>
               <div class="splide__pagination small-order-1 large-order-2 margin-bottom-2 large-margin-bottom-0"></div>
            </div>
         </div>
      </div>
   </section>
<?php
   wp_reset_postdata();
}
?>