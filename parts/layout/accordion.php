<?php

$position = get_field('accordion_position');
$openfirst = get_field('open_first');

if ($position == 'bottom' && have_rows('accordion_sections')) {

   echo '<ul class="accordion" data-accordion data-allow-all-closed="true" data-deep-link="true">';

   $counter = 0;

   while (have_rows('accordion_sections')) : the_row();

      $counter++;

      $heading = get_sub_field('heading');
      $text = get_sub_field('text');

      $deeplink = strtolower($heading);
      $deeplink = str_replace(' ', '-', $deeplink);
      $deeplink = str_replace(',', '', $deeplink);
      $deeplink = str_replace('&', '-', $deeplink);
      $deeplink = str_replace('---', '-', $deeplink);

      echo '<li class="accordion-item';
      if ($openfirst && $counter == 1) {
         echo ' is-active';
      }
      echo '" data-accordion-item>';
      echo '<a href="#' . $deeplink . '" class="accordion-title">' . $heading . '</a>';
      echo '<div class="accordion-content" data-tab-content id="' . $deeplink . '">';
      echo $text;
      echo '</div>';
      echo '</li>';

   endwhile;

   echo '</ul>';
}
