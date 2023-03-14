<?php

$id = get_the_id();
$name = get_the_title();

$firstname = strtok($name, " ");

if (have_rows('profile_sections')) {

   while (have_rows('profile_sections')) {
      the_row();

      $heading = get_sub_field('heading');
      $text = get_sub_field('text');
?>
      <h2><?php echo $heading; ?></h2>
      <p>
         <?php echo $text; ?>
      </p>
<?php
   }
}
