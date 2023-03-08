<?php

$individual_logos = !empty(get_field('individual_logos', 'option')) ? get_field('individual_logos', 'option') : '';
$barrister_logos = !empty(get_field('directory_logos')) ? get_field('directory_logos') : '';
$other_logos = !empty(get_field('logos')) ? get_field('logos') : null;
?>

<div class="cell grid-x small-12 medium-5 large-4 grid-margin-x grid-padding-y barrister__details__awards">
   <?php

   if ($barrister_logos) {

      foreach ($barrister_logos as $barrister_logo) {
         if (array_key_exists($barrister_logo, $individual_logos)) {
            echo '<div class="cell small-3 text-center">';
            echo wp_get_attachment_image($individual_logos[$barrister_logo]['id'], 'small');
            echo '</div>';
         }
      }
   }

   if ($other_logos) {
      foreach ($other_logos as $logo) {
         echo '<div class="cell small-3 text-center">';
         echo wp_get_attachment_image($logo['image']['id'], 'small');
         echo '</div>';
      }
   }

   ?>
</div>