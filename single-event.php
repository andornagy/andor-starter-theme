<?php get_header();

$id = get_the_id();
$venue = get_field('venue');

$booking_url = get_field('booking_url');

$video = get_field('video_embed');
$slides = get_field('slides');

?>

<?php get_template_part('parts/title/title', 'event'); ?>

<main class="section grid-container">

   <?php get_template_part('parts/layout/breadcrumbs'); ?>

   <section class="grid-x grid-padding-x grid-padding-y main">

      <div class="cell small-12 medium-2 large-3">
         <?php get_sidebar('left'); ?>
      </div>

      <div class="cell small-12 medium-8 large-6 content">

         <?php the_post_thumbnail('landscape'); ?>

         <?php the_content(); ?>

         <?php

         $startdate = DateTime::createFromFormat('d/m/Y', get_field('start_date'));
         $startdateYmd = $startdate->format('Ymd');
         $today =  date('Ymd');

         if ($booking_url && ($startdateYmd > $today)) {
            echo '<p><a href="' . $booking_url . '" class="button" target="_blank">Book now</a></p>';
         }

         if ($slides) {
            echo '<p><a href="' . $slides['url'] . '" class="button">Download slides</a></p>';
         }

         if ($video) {
            echo '<h2>Watch the video</h2>';
            echo $video;
         }
         ?>

         <?php get_template_part('parts/layout/share'); ?>

      </div>

      <div class="cell small-12 medium-2 large-3">
         <?php get_sidebar('right'); ?>
      </div>

   </section>

</main>

<?php get_footer(); ?>