<?php

$posts = getQuery('post', '', 4);

?>

<section class="section home-featured_news">
   <div class="grid-container">
      <h2 class="separator-left">Featured news</h2>
      <div class="grid-x grid-margin-x grid-padding-y">
         <?php
         if ($posts->have_posts()) {
            while ($posts->have_posts()) {
               $posts->the_post();
               $args = array(
                  'excerpt' => true,
                  'columns' => 4,
               );
               get_template_part('parts/loop/loop', get_post_type(), $args);
            }
         } else {
            echo '<div class="cell"><h2>' . __('No posts found.', 'squareeye') . '</h2></div>';
         }
         wp_reset_postdata();

         ?>
      </div>
   </div>
</section>