<?php
$id = isset($args['id']) && $args['id'] ? $args['id'] : get_the_ID();


?>
<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" id="post-<?php the_ID(); ?>" class="cell posts-item__list">
   <div class="posts-item__content">
      <h3 class="posts-item__title">
         <?php the_title(); ?>
      </h3>
   </div>
</a>