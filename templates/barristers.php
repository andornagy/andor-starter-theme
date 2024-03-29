<?php
/*
* Template name: Barristers
*/

$barristers = getQuery('barrister');

$barristers_cats = getBarristersByShowOnArchive(); // query.php

get_header(); ?>

<?php get_template_part('parts/title/title'); ?>

<main class="section">
   <div class="grid-container">
      <?php get_template_part('parts/layout/breadcrumbs'); ?>
      <section class="grid-x grid-padding-x grid-padding-y main">

         <div class="cell">
            <?php ajaxFilters('barrister'); ?>
         </div>

         <div class="cell">
            <div id="response" class="grid-x grid-padding-x grid-margin-y">
               <?php

               if ($barristers->have_posts()) {
                  if (!empty($barristers_cats)) {
                     while ($barristers->have_posts()) {
                        $barristers->the_post();
                        foreach ($barristers_cats as $i => $cat) {
                           if (has_term($cat['slug'], 'barrister_category')) {
                              ob_start();
                              get_template_part('parts/loop/loop', 'barrister');
                              $barristers_cats[$i]['output'][] = ob_get_contents();
                              ob_end_clean();
                           }
                        }
                     }

                     wp_reset_postdata();

                     foreach ($barristers_cats as $cat) {
                        if (isset($cat['output']) && $cat['output']) {
                           echo '<div class="cell"><h2>' . esc_html($cat['title']) . '</h2></div>';
                           echo implode('', $cat['output']);
                        }
                     }
                  } else {
                     while ($barristers->have_posts()) {
                        $barristers->the_post();
                        get_template_part('parts/loop/loop', 'barrister');
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