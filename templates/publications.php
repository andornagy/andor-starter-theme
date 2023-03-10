<?php get_header();
/*
* Template name: Publications
*/

$publications = getQuery('publication');
?>

<?php get_template_part('parts/titles/title'); ?>

<main class="section">
   <div class="grid-container">
      <?php get_template_part('parts/layout/breadcrumbs'); ?>
      <section class="grid-x grid-padding-x grid-padding-y main">
         <div class="cell small-12">
            <?php ajaxFilters('publication'); ?>
         </div>

         <div class="cell small-12 content">

            <div class="cell">
               <div id="response" class="grid-x grid-padding-x grid-padding-y">
                  <?php
                  if ($publications->have_posts()) {
                     while ($publications->have_posts()) {
                        $publications->the_post();
                        $args = array(
                           'excerpt' => true,
                           'columns' => 4,
                        );
                        get_template_part('parts/loop/loop', get_post_type(), $args);
                     }
                  } else {
                     echo '<div class="cell"><h2>' . __('No posts found.', 'squareeye') . '</h2></div>';
                  }
                  echo ajaxPagination('publication');
                  ?>

               </div>
            </div>

         </div>

      </section>
   </div>
</main>

<?php get_footer(); ?>