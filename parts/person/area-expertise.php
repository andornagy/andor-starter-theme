<?php
$id = get_the_id();

?>
<div class="profile-sections-wrapper margin-top-2">
   <ul class="accordion" data-accordion data-allow-all-closed="true">
      <?php if (have_rows('area_sections')) : ?>
         <?php while (have_rows('area_sections')) : the_row(); ?>
            <?php if (get_sub_field('hide_from_barrister')) continue; ?>
            <?php $post_object = get_sub_field('area'); ?>
            <?php if ($post_object) : ?>
               <?php // override $post
               $post = $post_object;
               setup_postdata($post);
               if (get_sub_field('title_variation')) {
                  $title = get_sub_field('title_variation');
               } else {
                  $title = get_the_title();
               }
               ?>
               <li class="accordion-item" data-accordion-item>
                  <a href="#" class="accordion-title"><?php echo $title; ?><i class="fa-solid fa-chevron-down"></i></a>
                  <div class="accordion-content" data-tab-content>
                     <?php echo wpautop(wp_kses_post(get_sub_field('text'))); ?>
                  </div>
               </li>
               <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly 
               ?>
            <?php endif; ?>
         <?php endwhile; ?>
      <?php endif; ?>
   </ul>
</div>