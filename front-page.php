<?php get_header(); ?>
<main class="section grid-container">
   <div class="grid-x grid-margin-x grid-padding-y">
      <div class="cell content">
         <?php
         echo '<pre>';
         print_r(getSubMenu(7));
         echo '</pre>';
         ?>
         <?php the_content(); ?>
      </div>
   </div>
</main>
<?php get_footer(); ?>