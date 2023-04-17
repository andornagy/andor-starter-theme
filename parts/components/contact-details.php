<?php
$contactDetails = ['phone', 'fax', 'email', 'dx'];
echo '<ul class="contact-list">';
foreach ($contactDetails as $info) {
   $link = get_field($info, 'option');
   if (!$link) continue;

   switch ($info) {
      case 'phone':
         echo '<li><a href="tel:' . esc_html(makePhoneClickable($link)) . '" title="' . esc_attr($info) . '" target="_blank" rel="noopener noreferrer"><span class="show-for-sr">' . esc_html($info) . '</span><i class="fa-solid fa-phone fa-fw"></i>' . esc_html($link) . '</a></li>';
         break;

      case 'email':
         echo '<li><a href="mailto:' . esc_html($link) . '" title="' . esc_attr($info) . '" target="_blank" rel="noopener noreferrer"><span class="show-for-sr">' . esc_html($info) . '</span><i class="fa-solid fa-envelope fa-fw"></i>' . esc_html($link) . '</a></li>';
         break;

      case 'fax':
         echo '<li><a href="fax:' . esc_html($link) . '" title="' . esc_attr($info) . '" target="_blank" rel="noopener noreferrer"><i class="fa-solid fa-fax fa-fw"></i>' . esc_html($link) . '</a></li>';
         break;

      case 'dx':
         echo '<li><span class="show-for-sr">' . esc_html($info) . '</span><i class="fa-solid fa-inbox fa-fw"></i>' . esc_html($link) . '</li>';
         break;
   }
}
echo '</ul>';
