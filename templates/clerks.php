<?php
/*
* Template name: Clerks
*/
get_header();

$clerks = getQuery('clerk');

get_template_part('parts/titles/title-clerks');
?>
<main class="section grid-container">
   <div class="grid-x grid-padding-x grid-padding-y">
      <div class="cell">
         <?php get_template_part('parts/page/breadcrumbs'); ?>
      </div>
      <div class="cell">
         <div id="response" class="grid-x grid-padding-x grid-margin-y">

            <?php
            if ($clerks->have_posts()) {
               while ($clerks->have_posts()) {
                  $clerks->the_post();
                  get_template_part('parts/loop/loop', 'clerk');
               }
               wp_reset_postdata();
            } else {
               echo '<div class="cell"><h2>' . __('No clerks found.', 'squareeye') . '</h2></div>';
            }
            ?>
         </div>
      </div>
   </div>
</main>
<?php
get_footer();
?>