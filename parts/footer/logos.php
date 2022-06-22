<?php
	
	// Check rows exists.
if( have_rows('footer_logos','option') ):

	echo '<div class="grid-x grid-padding-x grid-padding-y footer-logos-wrapper">';
	
		echo '<div class="cell text-center">';
		
			echo '<ul class="menu align-center footer-logos">';
					
		    // Loop through rows.
		    while( have_rows('footer_logos','option') ) : the_row();
		
				$image = get_sub_field('image');
				$imgurl = $image['sizes']['medium'];	
		        $title = get_sub_field('title');
		        $url = get_sub_field('url');
		        
		        echo '<li>';
		        if ($url) { '<a href="'.$url.'">'; }
		        echo '<img src="'.$imgurl.'" alt="'.$title.'" />'; 
		        if ($url) { echo '</a>'; }
		        echo '</li>';
		
		    // End loop.
		    endwhile;
		
			echo '</ul>';
	
		echo '</div>';
	
	echo '</div>';
	
endif;

?>