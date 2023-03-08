<?php

$socials = ['twitter', 'linkedin', 'facebook'];

foreach ($socials as $social) {
   $link = get_field($social, 'option');
   if (!$link) continue;

   echo '<a href="' . esc_url($link) . '" title="Follow us on ' . esc_attr($social) . '" target="_blank" rel="noopener noreferrer"><span class="show-for-sr">' . esc_html($social) . '</span><i class="fa-brands fa-2x fa-' . $social . ' fa-fw"></i></a>';
}
