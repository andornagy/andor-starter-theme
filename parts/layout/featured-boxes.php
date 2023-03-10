<?php

if (have_rows('boxes')) : ?>

   <section class="grid-container featured-boxes">
      <div class="grid-x grid-padding-x grid-padding-y">

         <?php

         while (have_rows('boxes')) : the_row();

            $page = get_sub_field('page');
            if ($page) {
               $pageid = $page->ID;
               $heading = get_the_title($pageid);
               $imgurl = get_the_post_thumbnail_url($pageid, 'landscape');

               $link = get_the_permalink($pageid);
            }

            if (get_sub_field('heading')) {
               $heading = get_sub_field('heading');
            }
            $image = get_sub_field('image');
            if ($image) {
               $imgurl = $image['sizes']['landscape'];
            }

            if (get_sub_field('external_link')) {
               $link = get_sub_field('external_link');
            }

            $text = get_sub_field('text');

         ?>

            <div class="cell medium-4">
               <a href="<?php echo $link; ?>" title="<?php echo $heading; ?>">
                  <div class="card">
                     <!--<div class="card-divider"></div>-->
                     <?php
                     if (!empty($imgurl)) {
                        echo '<img src="' . $imgurl . '" alt="' . $heading . '" />';
                     }
                     ?>
                     <div class="card-section">
                        <h4><?php echo $heading; ?></h4>
                        <?php echo wpautop($text); ?>
                     </div>
                  </div>
               </a>
            </div>

         <?php endwhile; ?>

      </div>
   </section>

<?php endif; ?>