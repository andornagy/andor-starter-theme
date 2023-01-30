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
	
	// Fix sorting
	$args['ignore_custom_sort'] = true;

    // Page slug (used for ajax)
    $page_slug = isset($_REQUEST['slug']) ? $_REQUEST['slug'] : basename(get_permalink(get_the_ID()));

    // Post type
    $args['post_type'] = $type;
	
	// Sticky posts
    if ($type === 'post') $args['enable_sticky_posts'] = true;

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
* STICKY POSTS
*/
add_action('pre_get_posts', 'stickyPostsFunctionality');

function stickyPostsFunctionality($query)
{
    if ($query->get('enable_sticky_posts')) {
        // avoid infinite loop
        remove_action('pre_get_posts', __FUNCTION__);

        // get the number of posts per page
        $posts_per_page = $query->get('posts_per_page');

        // get sticky posts array
        $sticky_posts = get_option('sticky_posts');

        // Check if sticky posts exists
        if (is_array($sticky_posts) && $sticky_posts) {

            // count the number of sticky posts
            $sticky_count = count($sticky_posts);
            // trim sticky posts to posts_per_page, so they displayed only on the first page
            if ($sticky_count > $posts_per_page) {
                $sticky_posts = array_slice($sticky_posts, 0, $posts_per_page);
                $sticky_count = $posts_per_page;
            }


            // If not paged or first page
            if (!$query->is_paged()) {
                // Get normal posts ids to fill in the first page
                $normal_posts_args = $query->query_vars;
                $normal_posts_args['fields'] = 'ids';
                $normal_posts_args['post__not_in'] = $sticky_posts;
                $normal_posts = new WP_Query($normal_posts_args);
                $normal_posts_ids = $normal_posts->posts && is_array($normal_posts->posts) ? array_slice($normal_posts->posts, 0, $posts_per_page - $sticky_count) : [];

                // Get sticky posts ids to sort those by date
                $sticky_posts = new WP_Query([
                    'post_type' => 'post',
                    'post_status' => 'publish',
                    'posts_per_page' => -1,
                    'orderby' => 'date',
                    'order' => 'DESC',
                    'post__in' => $sticky_posts,
                    'fields' => 'ids'
                ]);
                $sticky_posts_ids = $sticky_posts->posts && is_array($sticky_posts->posts) ? $sticky_posts->posts : [];

                // Get final ids
                $posts_ids = array_merge($sticky_posts_ids, $normal_posts_ids);

                $query->set('post__in', $posts_ids);
                $query->set('orderby', 'post__in');
                $query->set('order', 'ASC');
            } else {
                // Can't use "paged" with offset, so need to real offset manually
                $current_page = $query->get('paged');
                // Take previous page as we can't set negative offset
                $current_page = $current_page - 1;
                // Calc offset
                $offset = (($current_page - 1) * $posts_per_page) + ($posts_per_page - $sticky_count);

                // Set offset and remove all sticky posts
                $query->set('offset',  $offset);
                $query->set('post__not_in', $sticky_posts);
            }
        }
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
      $keywords = explode(' ', trim($search_term));

      $where .= ' AND (';

      $keywords_sql = [];
      foreach ($keywords as $keyword) {
         $keywords_sql[] = $wpdb->posts . '.post_title LIKE \'%' . esc_sql($wpdb->esc_like($keyword)) . '%\'';
      }
      $where .= implode(' AND ', $keywords_sql);

      $where .= ')';
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
