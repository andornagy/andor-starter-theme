<?php
$id = get_the_id();

?>
<div class="profile-sections-wrapper margin-top-2">
   <ul class="accordion" data-accordion data-allow-all-closed="false" data-multi-expand="false">
      <?php if (get_the_content($id)) { ?>
         <li class="accordion-item is-active" data-accordion-item>
            <a href="#" class="accordion-title">Overview<i class="fa-solid fa-chevron-down"></i></a>
            <div class="accordion-content" data-tab-content>
               <?php the_content($id) ?>
            </div>
         </li>
      <?php } ?>
      <?php if (have_rows('area_sections')) : ?>
         <?php while (have_rows('area_sections')) : the_row();

            if (get_sub_field('hide_from_barrister')) continue;

            $title = null;
            $area = get_sub_field('area');

            if (!$area) continue;
            $title = get_sub_field('title_variation') ? get_sub_field('title_variation') : get_the_title($area);

            if ($title) { ?>

               <li class="accordion-item" data-accordion-item>
                  <a href="#" class="accordion-title"><?php echo $title; ?><i class="fa-solid fa-chevron-down"></i></a>
                  <div class="accordion-content" data-tab-content>
                     <?php echo wpautop(wp_kses_post(get_sub_field('text'))); ?>
                  </div>
               </li>
      <?php }

         endwhile;
      endif;

      ?>
   </ul>
</div>