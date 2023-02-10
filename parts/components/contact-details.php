<?php
$contactDetails = ['phone', 'fax', 'email', 'dx'];

foreach ($contactDetails as $info) {
   $link = get_field($info, 'option');
   if (!$link) continue;

   switch ($info) {
      case 'phone':
         echo '<li><a href="tel:' . esc_html($link) . '" title="' . esc_attr($info) . '" target="_blank" rel="noopener noreferrer"><span class="show-for-sr">' . esc_html($info) . '</span><i class="fa-solid fa-phone"></i>' . esc_html($link) . '</a></li>';
         break;

      case 'email':
         echo '<li><a href="mailto:' . esc_html($link) . '" title="' . esc_attr($info) . '" target="_blank" rel="noopener noreferrer"><span class="show-for-sr">' . esc_html($info) . '</span><i class="fa-solid fa-envelope"></i>' . esc_html($link) . '</a></li>';
         break;

      case 'fax':
         echo '<li><a href="fax:' . esc_html($link) . '" title="' . esc_attr($info) . '" target="_blank" rel="noopener noreferrer"><i class="fa-solid fa-fax"></i>' . esc_html($link) . '</a></li>';
         break;

      case 'dx':
         echo '<li><span class="show-for-sr">' . esc_html($info) . '</span><i class="fa-solid fa-inbox"></i>' . esc_html($link) . '</li>';
         break;
   }
}
