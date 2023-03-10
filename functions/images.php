<?php

/* Image sizes  ________________________________________________________ */

function sqe_thumbnail_sizes()
{
   add_image_size('landscape', 800, 300, true); // (cropped)
   add_image_size('square', 600, 600, true); // (cropped)
}


add_action('after_setup_theme', 'sqe_thumbnail_sizes');
