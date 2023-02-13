<?php get_header();

?>

<main class="section grid-container">

   <?php get_template_part('parts/person/banner', 'person'); ?>

   <?php get_template_part('parts/layout/breadcrumbs'); ?>

   <section class="grid-x grid-padding-x grid-padding-y main">

      <div class="cell small-12 medium-2 large-3">
         <?php get_sidebar('left-barrister'); ?>
      </div>

      <div class="cell small-12 medium-8 large-6 content">

         <?php get_template_part('parts/person/area-expertise'); ?>

         <?php get_template_part('parts/person/profile-sections'); ?>

         <?php get_template_part('parts/layout/share'); ?>

      </div>

      <div class="cell small-12 medium-2 large-3">
         <?php get_sidebar('right-barrister'); ?>
      </div>

   </section>

</main>

<?php get_footer(); ?>