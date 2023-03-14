<?php
/*
* Template name: Staff
*/

get_header();

$people = getQuery('person');

$people_cats = getPublicBarristerCategories('people'); // query.php

?>

<?php get_template_part('parts/title/title'); ?>

<main class="section">
   <div class="grid-container">
      <?php get_template_part('parts/layout/breadcrumbs'); ?>
      <section class="grid-x grid-padding-x grid-padding-y main">

         <div class="cell">
            <div id="response" class="grid-x grid-padding-x grid-margin-y">
               <?php

               if ($people->have_posts()) {
                  if (!empty($people_cats)) {
                     while ($people->have_posts()) {
                        $people->the_post();
                        foreach ($people_cats as $i => $cat) {
                           if (has_term($cat['slug'], 'people_category')) {
                              ob_start();
                              get_template_part('parts/loop/loop', 'person');
                              $people_cats[$i]['output'][] = ob_get_contents();
                              ob_end_clean();
                           }
                        }
                     }

                     wp_reset_postdata();

                     foreach ($people_cats as $cat) {
                        if (isset($cat['output']) && $cat['output']) {
                           echo '<div class="cell"><h2>' . esc_html($cat['title']) . '</h2></div>';
                           echo implode('', $cat['output']);
                        }
                     }
                  } else {
                     while ($people->have_posts()) {
                        $people->the_post();
                        get_template_part('parts/loop/loop', 'person');
                     }
                  }
               }
               ?>
            </div>
         </div>
      </section>
   </div>
</main>

<?php get_footer(); ?>