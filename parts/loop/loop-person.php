<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" id="post-<?php the_ID(); ?>" <?php post_class('posts-item cell large-2 medium-4 small-6'); ?>>
   <div class="square-img margin-bottom-1" style="background-color: #002C30;">
      <?php the_post_thumbnail('landscape'); ?>
   </div>
   <h5 class="posts-item__title"><?php the_title(); ?></h5>
   <?php
   echo do_shortcode('[barrister_years class="barrister-years"]');
   ?>
</a>