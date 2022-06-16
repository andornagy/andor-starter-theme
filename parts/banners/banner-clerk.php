<?php
	
	$id = get_the_id();
	
	$jobtitle = get_field('job_title');
	
	$phone = get_field('phone');
	$mobile = get_field('mobile');
	$email = get_field('email');
	
	$linkedin = get_field('linkedin');
	$twitter = get_field('twitter');
	
	$imgurl = get_the_post_thumbnail_url($id,'medium'); // change size as needed
	
	$clerkingteam = get_terms(['taxonomy' => 'clerking_team']);

?>

<section class="section banner banner-person banner-clerk">
    <div class="grid-container">
        <div class="grid-x grid-padding-x grid-padding-y">
            <div class="cell">
                <h1><?php the_title(); ?></h1>
            </div>
        </div>
    </div>
</section>