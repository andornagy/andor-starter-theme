<?php
function displaySiteLogo()
{
   return '<a href="' . site_url() . '" class="site-logo"><img src="' . get_stylesheet_directory_uri() . '/assets/imgs/logo.png" alt="' . get_bloginfo('name') . '" /></a>';
}

add_shortcode('site_logo', 'displaySiteLogo');

/* Display current year  ________________________________________________________ */

function displayCurrentYear()
{
   return date('Y');
}

add_shortcode('current_year', 'displayCurrentYear');


/* Display barrister call & silk years  ________________________________________________________ */


function displayBarristerYears($atts)
{
   $a = shortcode_atts(array(
      'class' => null,
      'id' => get_the_ID()
   ), $atts);

   $output = '';

   if (function_exists('get_field')) {
      $call = get_field('call_year', $a['id']);
      $calloverride = get_field('call_override', $a['id']);
      if ($calloverride) {
         $call = $calloverride;
      }
      $silk = get_field('silk_year', $a['id']);

      if ($call || $silk) {
         $output .= $a['class'] ? '<span class="' . esc_attr($a['class']) . '">' : '<span>';

         $years = array();
         if ($silk) $years[] = sprintf(__('Silk: %s', 'squareeye'), $silk);
         if ($call) $years[] = sprintf(__('Call: %s', 'squareeye'), $call);
         $output .= implode(' | ', $years);

         $output .= '</span>';
      }
   }

   return $output;
}

add_shortcode('barrister_years', 'displayBarristerYears');


/* Chambers contact details  ________________________________________________________ */


function displayChambersContacts()
{
   $address = array(
      array(
         'organisation'
      ),
      array(
         'address1',
         'address2',
      ),
      array(
         'city',
         'postcode',
         'country'
      ),
      array(
         'email'
      ),
      array(
         'phone'
      ),
      array(

         'dx'
      ),
   );

   $address_arr = array();

   foreach ($address as $key => $address_block) {
      foreach ($address_block as $field) {
         $value = get_field($field, 'options');
         if ($value) {
            if (!isset($address_arr[$key])) $address_arr[$key] = array();
            if ($field == 'dx') $value = 'DX: ' . $value;
            if ($field == 'phone') $value = sprintf(__('Tel. : %s', 'squareeye'), $value);
            if ($field == 'email') {
               $email = antispambot($value);
               $value = '<a href="mailto:' . $email . '">' . $email . '</a>';
            }
            $address_arr[$key][] = $value;
         }
      }
   }

   if ($address_arr) {
      $output = '<div class="chamber-contacts">';
      foreach ($address_arr as $address_block) {
         if (is_array($address_block) && $address_block) {
            echo '<div>' . implode(', ', $address_block) . '</div>';
         }
      }
      $output .= '</div>';
   }

   return $output;
}

add_shortcode('chambers_contacts', 'displayChambersContacts');


/* Accordion  ________________________________________________________ */


function DisplayAccordion($atts)
{

   $atts = shortcode_atts(array(
      'openfirst' => false,
   ), $atts);

   $openfirst = $atts['openfirst'];

   $output = '<ul class="accordion" data-accordion data-multi-expand="true" data-allow-all-closed="true" data-deep-link="true">';

   $counter = 0;

   while (have_rows('accordion_sections')) : the_row();

      $counter++;

      $heading = get_sub_field('heading');
      $text = get_sub_field('text');
      $image = get_sub_field('image');

      $output .= '<li class="accordion-item';
      if ($openfirst && $counter == 1) {
         $output .= ' is-active';
      }
      $output .= '" data-accordion-item>';
      $output .= '<a href="#" class="accordion-title">' . $heading . '</a>';
      $output .= '<div class="accordion-content" data-tab-content>';
      if ($image) {
         $imgurl = $image['sizes']['medium'];
         $output .= '<img src="' . $imgurl . '" alt="' . $heading . '" />';
      }
      $output .= $text;
      $output .= '</div>';
      $output .= '</li>';

   endwhile;

   $output .= '</ul>';

   return $output;
}

add_shortcode('accordion', 'DisplayAccordion');




/* Display event date(s)  ________________________________________________________ */
function DisplayEventDates($atts)
{
   $a = shortcode_atts(array(
      'class' => null,
      'id' => get_the_ID()
   ), $atts);

   $output = '';

   if (function_exists('get_field')) {

      $startdate = get_field('start_date');
      $startdate = str_replace('/', '-', $startdate);
      $startdate = date("d M Y", strtotime($startdate));
      $starttime = get_field('start_time');
      $enddate = get_field('end_date');
      if ($enddate) {
         $enddate = str_replace('/', '-', $enddate);
         $enddate = date("d M Y", strtotime($enddate));
      }
      $endtime = get_field('end_time');

      $output .= $a['class'] ? '<span class="' . esc_attr($a['class']) . '">' : '<span>';

      $output .= $startdate;
      if ($starttime) {
         $output .= ', ' . $starttime;
      }
      if ($enddate || $endtime) {
         $output .= ' to ';
         if ($enddate && ($enddate <> $startdate)) {
            $output .= $enddate;
         }
         if ($enddate && $endtime && ($enddate <> $startdate)) {
            $output .= ', ';
         }
         if ($endtime) {
            $output .= $endtime;
         }
      }

      $output .= '</span>';
   }
}


add_shortcode('event_dates', 'DisplayEventDates');
