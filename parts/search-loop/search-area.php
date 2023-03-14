<?php

/**
 * Search loop item: Area
 */

$id = get_the_ID();
$link = get_the_permalink();
?>
<figure id="post-<?php the_ID(); ?>" <?php post_class('posts-item cell large-4'); ?>>
   <a href="<?php echo $link; ?>" title="<?php the_title(); ?>">
      <h3 class="posts-item__title"><?php the_title(); ?></h3>
   </a>
   <p><?php echo has_excerpt() ? get_the_excerpt() : wp_trim_words(get_the_content(), 50, '...'); ?></p>
</figure>