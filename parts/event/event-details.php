<?php
$id = get_the_ID();

$today =  date('Ymd');

$start_date = sqe_date_format(get_field('start_date', $id));
$start_time = get_field('start_time', $id);

$end_date = sqe_date_format(get_field('end_date', $id));
$end_time = get_field('end_time', $id);

$venue = get_field('venue', $id);

$speakers = get_field('speakers', $id);

$booking_url = get_field('booking_url', $id);

?>

<div class="cell event__details">
   <h2>Event details</h2>
   <ul>
      <?php

      if ($start_date)
         echo '<li><i class="fa-solid fa-calendar-days"></i>' . $start_date . '</li>';

      if ($start_time)
         echo '<li><i class="fa-solid fa-timer"></i> ' .  $start_time . ' to ' .  $end_time . '</li>';

      if ($venue)
         echo '<li><i class="fa-solid fa-location-dot"></i>' . $venue . '</li>';

      if ($speakers)
         echo '<li><i class="fa-solid fa-microphone-stand"></i>' . $speakers . '</li>';

      ?>

   </ul>

   <?php

   if ($booking_url && ($start_date > $today)) {
      echo '<a href="' . $booking_url . '" title="Book your ticket for ' . get_the_title($id) . '." class="button" target="_blank">Book now</a>';
   }

   ?>

</div>