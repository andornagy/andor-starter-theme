<?php
	
	$id = get_the_id();
	
	$call = get_field('call_year');
	$callextra = get_field('call_extra_info');
	$silk = get_field('silk_year');
	
	$phone = get_field('phone');
	$mobile = get_field('mobile');
	$email = get_field('email');
	
	$linkedin = get_field('linkedin');
	$twitter = get_field('twitter');
	
	$clerk = get_field('related_clerk');
	$clerkteam = get_field('related_clerking_team');
	
	$imgurl = get_the_post_thumbnail_url($id,'medium'); // change size as needed
	
	$categories = get_terms(['taxonomy' => 'barrister_category']);

?>

<section class="section banner banner-person banner-barrister">
    <div class="grid-container">
        <div class="grid-x grid-padding-x grid-padding-y">
            <div class="cell">
                <h1><?php the_title(); ?></h1>
            </div>
        </div>
    </div>
</section>