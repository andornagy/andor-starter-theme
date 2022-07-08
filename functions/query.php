<?php

/*
* MODIFY QUERIES
*/
add_filter('pre_get_posts', function ($query) {
    // Search
    if (!is_admin() && $query->is_main_query() && $query->is_search) {
        $query->set('post_type', array('post', 'barrister', 'area'));
        $query->set('posts_per_page', 9);
        if ($query->query['s'] == '') {
            $query->set('post__in', [999999999]);
        }
    }

    return $query;
});

/*
* GET QUERY (FOR BOTH NORMAL AND AJAX QUERIES)
*/
function getQuery($type, $cat = null)
{
    // Default args
    $args = array(
        'post_status' => 'publish',
        'ignore_sticky_posts' => 1,
        'orderby' => 'menu_order',
        'order' => 'ASC'
    );

    // Page slug (used for ajax)
    $page_slug = isset($_REQUEST['slug']) ? $_REQUEST['slug'] : basename(get_permalink(get_the_ID()));

    // Post type
    $args['post_type'] = $type;

    // Posts per page
    $args['posts_per_page'] = $type === 'barrister' ? -1 : 12;

    // Current page
    if (isset($_REQUEST['pg']) && absint($_REQUEST['pg']) > 0) {
        $args['paged'] = absint($_REQUEST['pg']);
    } else {
        $args['paged'] = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;
    }

    // Categories
    if ($cat) {
        if (is_numeric($cat)) $args['cat'] = $cat;
        else $args['category_name'] = $cat;
    }

    // Barristers
    if (isset($_REQUEST['b']) && !empty($_REQUEST['b'])) {
        $args['meta_query'][] = array(
            'key' => 'related_barristers',
            'compare' => '=',
            'value' => absint($_REQUEST['b'])
        );
    }

    // Areas
    if (isset($_REQUEST['a']) && !empty($_REQUEST['a'])) {
        $args['meta_query'][] = array(
            'key' => 'related_areas',
            'compare' => '=',
            'value' => absint($_REQUEST['a'])
        );
    }

    // Search
    if (isset($_REQUEST['kw']) && !empty($_REQUEST['kw'])) {
        $args['s'] = $_REQUEST['kw'];
    }

    // Search by title
    if (isset($_REQUEST['title']) && !empty($_REQUEST['title'])) {
        $args['search_by_title'] = $_REQUEST['title'];
        add_filter('posts_where', 'searchByTitleFilter', 10, 2);
    }

    // Set meta query AND
    if (isset($args['meta_query']) && count($args['meta_query']) > 1) {
        $args['meta_query']['relation'] = 'AND';
    }

    // Set query
    $query = new WP_Query($args);

    // Remove Search By Title filter
    if (isset($_REQUEST['title']) && !empty($_REQUEST['title'])) {
        remove_filter('posts_where', 'searchByTitleFilter', 10, 2);
    }

    return $query;
}


/*
* RELATED QUERY
*/

function getRelatedQuery($params = NULL)
{

    if (is_array($params) && $params) {

        $default_params = array(
            'post_type' => get_post_type(),
            'type' => 'post',
            'limit' => -1,
            'id' => get_the_ID(), // If you set custom id, then set post_type as well
            'taxonomy' => null,
            'term' => null,
            'scope' => 'all', // Events: all, future, past
            'orderby' => 'menu_order',
            'order' => 'ASC',
            'return_query' => true, // If false, then returns final args
            'return_ids' => false, // Returns array of posts ids
        );

        $params = array_merge($default_params, $params);
        extract($params);

        $args = array(
            'post_type' => array($type),
            'posts_per_page' => $limit,
            'orderby' => $orderby,
            'order' => $order,
        );

        // Check if last letter of the provided post type is "s"
        $meta_key = substr($post_type, -1) == 's' ? 'related_' . $post_type : 'related_' . $post_type . 's';
        $args['meta_query'] = array(
            array(
                'key'     => $meta_key,
                'value'   => $id,
                'compare' => 'IN'
            )
        );

        // Category
        if ($taxonomy == 'category') {
            $args['category_name'] = $term;
        } elseif ($taxonomy) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => $taxonomy,
                    'field'    => 'slug',
                    'terms'    => $term,
                ),
            );
        }

        // If return just ids
        if ($return_ids) {
            $args['fields'] = 'ids';
        }

        // Return final query or args
        if ($return_query) {
            return new WP_Query($args);
        } else {
            return $args;
        }
    }
}


/*
* FILTER: SEARCH BY TITLE
*/
function searchByTitleFilter($where, \WP_Query $q)
{
    global $wpdb;
    if ($search_term = $q->get('search_by_title')) {
        $where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'%' . esc_sql($wpdb->esc_like($search_term)) . '%\'';
    }
    return $where;
}

/*
* GET LATEST POSTS
*/

function getLatestPosts($params = array())
{

    if (is_array($params)) {

        $default_params = array(
            'limit' => 2,
            'return_query' => true, // If false, then returns final args
            'return_ids' => false, // Returns array of posts ids
            'offset' => 0
        );

        $params = array_merge($default_params, $params);
        extract($params);

        $args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => $limit,
            'orderby' => 'date',
            'order' => 'DESC',
            'offset' => $offset
        );

        // If return just ids
        if ($return_ids) {
            $args['fields'] = 'ids';
        }

        // Return final query or args
        if ($return_query) {
            $latest_news = new WP_Query($args);
            return $latest_news;
        } else {
            return $args;
        }
    }
}

/*
* GET POSTS
*/
function getPosts($params = array())
{
    if (is_array($params)) {
        $default_params = array(
            'type' => 'post',
            'limit' => -1,
            'orderby' => 'menu_order',
            'order' => 'ASC',
            'taxonomy' => '',
            'terms' => '', // slugs
            'exclude' => '',
            'return_query' => true, // If false, then returns final args
            'return_ids' => false, // Returns array of posts ids
            'offset' => 0
        );

        $params = array_merge($default_params, $params);
        extract($params);

        $args = array(
            'post_type' => $type,
            'post_status' => 'publish',
            'posts_per_page' => $limit,
            'orderby' => $orderby,
            'order' => $order,
            'offset' => $offset
        );

        if ($taxonomy && $terms) {
            if ($taxonomy === 'category') {
                $args['category_name'] = $terms;
            } else {
                $args['tax_query'] = array(
                    array(
                        'taxonomy' => $taxonomy,
                        'field' => 'slug',
                        'terms' => $terms
                    )
                );
            }
        }

        if ($exclude) {
            $args['post__not_in'] = is_array($exclude) ? $exclude : [$exclude];
        }

        // If return just ids
        if ($return_ids) {
            $args['fields'] = 'ids';
        }

        // Return final query or args
        if ($return_query) {
            $posts = new WP_Query($args);
            return $posts;
        } else {
            return $args;
        }
    }
}


// Get barrister categories where 'show on filter' is set to 1
// Used to populate filter and list on barristers.php

function getPublicBarristerCategories() {
	
	$barcats = get_terms( array(
	    'taxonomy' => 'barrister_category',
	    'hide_empty' => true,
	));
	
	if (!empty($barcats)) {
		$filteredcats = array();
		foreach($barcats as $barcat) {
			
			$include = false;
			$include = get_term_meta($barcat->term_id, 'show_on_filter', true);
			
			if ($include) {
				$newdata =  array (
					'slug' => $barcat->slug,
					'title' => $barcat->name,
				);
				$filteredcats[] = $newdata;
			}
				
		}
	}
	
	return $filteredcats;
}


function getBarristersByCategory($bcat) {
	
	// WP_Query arguments
		$args = array(
			'post_type'              => array( 'barrister' ),
			'posts_per_page'         => '-1',
			'orderby'                => 'menu_order',
			'order'                => 'ASC',
		);
		
		if ($bcat) {
			$args['tax_query'] = array(
		        array (
		            'taxonomy' => 'barrister_category',
		            'field' => 'slug',
		            'terms' => $bcat,
		        )
		    );
		}
		
		// The Query
		$barristers = new WP_Query( $args );
		
		// The Loop
		if ( $barristers->have_posts() ) {
			
			while ( $barristers->have_posts() ) {
				$barristers->the_post();
				// do something
			}
		} else {
			// no posts found
		}
		
		// Restore original Post Data
		wp_reset_postdata();
		
		return $barristers;

}
