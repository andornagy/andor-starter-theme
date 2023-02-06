<?php
/*
* Template name: Contact
*/
get_header();

get_template_part('parts/titles/title');
?>
<main class="section grid-container">
   <div class="grid-x grid-padding-x grid-padding-y">
      <div class="cell">
         <?php get_template_part('parts/page/breadcrumbs'); ?>
      </div>
      <div class="cell">
         <?php the_content(); ?>
      </div>
   </div>
</main>
<?php
get_footer();
?>