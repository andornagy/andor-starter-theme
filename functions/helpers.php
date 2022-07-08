<?php

/*
* GET SIMILIAR AREAS
*/

use function PHPSTORM_META\map;

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
    return $num;
}
