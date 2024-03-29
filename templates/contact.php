<?php
/*
* Template name: Contact
*/
get_header();

get_template_part('parts/titles/title');
?>
<main class="section">
   <div class="grid-container">
      <?php get_template_part('parts/layout/breadcrumbs'); ?>
      <section class="grid-x grid-padding-x grid-padding-y main">
         <div class="cell">
            <?php the_content(); ?>
         </div>
      </section>
   </div>
</main>
<?php
get_footer();
?>