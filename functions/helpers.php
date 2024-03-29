<?php

/*
* GET SIMILIAR AREAS
*/

function getSimilarAreas($id = null)
{
   $id = $id ?: get_the_ID();

   // Get parent area
   $parent = wp_get_post_parent_id($id) ?: $id;

   // Get parent's children
   $children = new WP_Query(array(
      'post_type' => 'area',
      'posts_per_page' => -1,
      'post_status' => 'publish',
      'fields' => 'ids',
      'post_parent' => $parent
   ));
   $children_ids = $children->posts;

   // Remove current id from the list
   $pos = array_search($id, $children_ids);
   if ($pos !== false) unset($children_ids[$pos]);

   return $children_ids;
}


/*
* GET POSTS YEARS
*/

function getPostsYears($type = 'post', $cat = null)
{
   global $wpdb;
   if ($cat) {
      $sql = $wpdb->prepare("SELECT p.post_date, r.term_taxonomy_id FROM {$wpdb->prefix}posts p");
      $sql .= $wpdb->prepare(" INNER JOIN wp_term_relationships r ON r.object_id=p.ID");
   } else {
      $sql = $wpdb->prepare("SELECT p.post_date FROM {$wpdb->prefix}posts p");
   }
   $sql .= $wpdb->prepare(" WHERE p.post_type = '%s' AND p.post_date <= '%s'", $type, current_time('mysql'));
   if ($cat) $sql .= $wpdb->prepare(" AND r.term_taxonomy_id = %d", $cat);
   $sql .= " ORDER BY p.post_date DESC";
   $years = $wpdb->get_results($sql);
   $years = array_map(function ($year) {
      return date('Y', strtotime($year->post_date));
   }, $years);
   return array_unique($years);
}

/*
* GET QUERY PARAMS FROM STRING
*/

function getQueryParamsStr($str)
{
   $params = [];
   $query_str = strpos($str, '?') !== false ? substr($str, strpos($str, '?') + 1) : '';

   if ($query_str) {
      $query_strs = explode('&', $query_str);
      foreach ($query_strs as $q) {
         $q_values = explode('=', $q);
         $params[$q_values[0]] = isset($q_values[1]) && $q_values[1] ? $q_values[1] : '';
      }
   }

   return $params;
}

/*
* GET COLUMNS FOR CONTENT PARTS
*/
function getColumns($columns, $default)
{
   switch ($columns) {
      case '4':
         return 'cell large-3 medium-6';
      case '3':
         return 'cell large-4 medium-6';
      case '2':
         return 'cell large-6';
      case '1':
         return 'cell';
   }

   return $default;
}

/*
* MAKE PHONE NUMBER CLICKABLE
*/
function makePhoneClickable($num)
{
   $num = str_replace('(0)', '', $num);
   $num = str_replace(' ', '', trim($num));

   // Add +44 country code to the beginning if not there.
   if (!str_starts_with($num, '+44')) {
      $num = '+44' . $num;
   }

   return $num;
}

// Convert ACF DATE field to WP Date
function sqe_date_format($date)
{
   if ($date) {

      $date = strtr($date, '/', '-');
      $format_out = get_option('date_format');

      $output = date($format_out, strtotime($date));

      return $output;
   }
}

// Convert ACF TIME field to WP Time
function sqe_time_format($time)
{
   if ($time) {
      $format_out = get_option('time_format');
      $output = date($format_out, strtotime($time));

      return $output;
   }
}

/*
* GET PERSON YEARS
*/
function getPersonYears($id = null)
{
   if (!$id) $id = get_the_ID();

   $call_override = get_field('call_override', $id);
   $call = $call_override ? $call_override : get_field('call_year', $id);
   $silk = get_field('silk_year', $id);

   $years = [];
   if ($call) $years[] = __('Call: ', 'squareeye') . esc_html($call);
   if ($silk) $years[] = __('Silk: ', 'squareeye') . esc_html($silk);

   return implode(' | ', $years);
}


/*
* GET EVENT DATE 
*/
function getEventDate($id = null)
{
   $start_date = get_field('start_date', $id);
   $start_time = get_field('start_time', $id);


   $end_date = get_field('end_date', $id);
   $end_time = get_field('end_time', $id);


   // If no start date, then return nothing
   if (!$start_date) return '';

   // Convert to time objects
   $date_format = "d/m/Y";
   $start_date_obj = DateTime::createFromFormat($date_format, $start_date);
   $end_date_obj = DateTime::createFromFormat($date_format, $end_date);

   // Prepare date array
   $date_arr = [];

   // If no end date or end date = start date
   if (!$end_date_obj || $start_date_obj->format('Ymd') === $end_date_obj->format('Ymd')) {
      // Show just start date
      $date_arr[] = $start_date_obj->format('F j, Y');

      // If start time exists, then display start time
      // If end time exists, then add end time to start time
      if ($start_time)
         $date_arr[] = $end_time ? $start_time . ' - ' . $end_time : $start_time;
   } else {
      $date_str = $start_date_obj->format('F j, Y');

      if ($start_time) $date_str .= ' ' . $start_time;
      if ($end_date) $date_str .= ' - ' . $end_date_obj->format('F j, Y');
      if ($end_date && $end_time) $date_str .= ' ' . $end_time;

      $date_arr[] = $date_str;
   }

   return implode(' | ', $date_arr);
}

/*
* GET THUMBNAIL URL
*/
function sqeGetThumbnailURL($post_id = '', $thumbnail_size = 'medium')
{

   $post_id = $post_id ? $post_id : get_the_ID();
   $post_type = get_post_type($post_id);
   $fallback = $post_type . '_fallback';

   $related_fallback_image = get_field($fallback, 'option');

   $thumb_url = '';

   if (has_post_thumbnail($post_id)) {
      $thumb_url = get_the_post_thumbnail_url($post_id, $thumbnail_size);
   } elseif ($related_fallback_image) {
      $thumb_url = wp_get_attachment_image_url($related_fallback_image['ID'], $thumbnail_size);
   } else {
      $thumb_url = 'https://via.placeholder.com/600x533/CCC?text=?';
   }

   return $thumb_url;
}

/*
* GET RELATED CLERKS FROM SET CLERKING TEAMS AND RELATIONSHIP FIELD
*/
function getBarristerRelatedClerks($id = '')
{
   $id = $id ? $id : get_the_ID();

   // Array of Related Clerk IDs
   $clerkIDs = [];

   // $barrister_team = !empty(get_field('clerking_team', $id)) ? get_field('clerking_team', $id) : null;
   $clerking_teams = get_the_terms($id, 'clerking_team');

   // Barristers team list.
   $barrister_team = [];
   foreach ($clerking_teams as $team) {
      $barrister_team[] .= $team->slug;
   };

   // Get related clerks based on Clerking Team
   $clerks = new WP_Query([
      'post_type' => 'clerk',
      'post_status' => 'publish',
      'tax_query' => array(
         array(
            'taxonomy' => 'clerking_team',
            'field' => 'slug',
            'terms' => $barrister_team,
         )
      ),
   ]);
   if ($clerks->have_posts()) {
      while ($clerks->have_posts()) {
         $clerks->the_post();
         $clerkIDs[] .= get_the_ID();
      }
      wp_reset_postdata();
   }

   // Get clerks based on relationship field
   $additionalClerks = get_post_meta($id, 'related_clerks');
   foreach ($additionalClerks as $additionalClerk) {
      if (isset($additionalClerk)) {
         if (!in_array($additionalClerk['ID'], $clerkIDs)) {
            $clerkIDs[] .= $additionalClerk['ID'];
         }
      }
   }

   // Final query, of the related clerks by IDs
   $related_clerks = new WP_Query(array('post_type' => 'clerk', 'post__in' => $clerkIDs));

   echo '<h2>Contact the clerks</h2>';
   echo '<div class="cell">';

   if ($related_clerks->have_posts()) {
      while ($related_clerks->have_posts()) {
         $related_clerks->the_post();

         $args = array(
            'id' => get_the_ID()
         );

         get_template_part('parts/related-loop/related', 'clerk', $args);
      };
      wp_reset_postdata();
   };
   echo '</div>';
}
