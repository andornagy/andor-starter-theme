<?php get_header();

$id = get_the_id();

$video_text = get_field('video_text');
$video = get_field('video');


?>

<?php get_template_part('parts/title/title', 'event'); ?>

<main class="section grid-container">

   <?php get_template_part('parts/layout/breadcrumbs'); ?>

   <section class="grid-x grid-padding-x grid-padding-y main">

      <div class="cell small-12 medium-8 large-8 content  grid-padding-y">
         <div class="cell thumbnail">
            <?php the_post_thumbnail('landscape'); ?>
         </div>
         <div class="cell thumbnail">
            <?php the_content(); ?>
         </div>
         <div class="cell video">
            <?php
            if ($video) {
               echo '<h2>Watch the video</h2>';
               echo '<p>' . esc_html($video_text) . '</p>';
               echo $video;
            }
            ?>
         </div>

         <?php get_template_part('parts/layout/share'); ?>

      </div>

      <div class="cell small-12 medium-4 large-4">
         <?php get_sidebar('event'); ?>
      </div>

   </section>

</main>

<?php get_footer(); ?>