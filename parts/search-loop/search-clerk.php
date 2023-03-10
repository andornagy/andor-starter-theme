<?php

/**
 * Search loop item: Clerk
 */

$call = get_field('call_year');
$silk = get_field('silk_year');
$years = '';
if ($call > 0 || $silk > 0) {
   $years = ' (' . $call;
   if ($silk > 0) {
      $years .= ' | ' . $silk;
   }
   $years .= ')';
}

?>

<figure id="post-<?php the_ID(); ?>" <?php post_class('posts-item posts-item--vertical posts-item--vertical--img img-zoom cell large-4 medium-6'); ?>>
   <div class="posts-item__img-wrapper">
      <?php
      if (has_post_thumbnail()) {
         echo '<div class="posts-item__img ie-object-fit">' . get_the_post_thumbnail(null, 'medium') . '</div>';
      } else {
         echo '<div class="posts-item__img section--gradient section--pattern"></div>';
      }
      ?>
   </div>
   <div class="posts-item__inner">
      <h3 class="posts-item__title">
         <?php
         echo get_the_title();
         if ($years) echo $years;
         ?>
      </h3>
      <p><?php echo has_excerpt() ? get_the_excerpt() : wp_trim_words(get_the_content(), 30); ?></p>
      <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="posts-item__link"></a>
   </div>
</figure>