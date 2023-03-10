<?php
	
	$callout = get_field('cta_callout_box');
	$heading = get_field('cta_heading');
	$text = get_field('cta_text');
	$label = get_field('cta_button_label');
	$linkto = get_field('cta_link_to');
	
	$link = null;
	if ($linkto == 'external') { $link = get_field('cta_external_link'); }
	if ($linkto == 'internal') { $link = get_field('cta_internal_link'); }
	if ($linkto == 'file') { 
		$file = get_field('cta_file'); 
		$link = $field['URL'];
	}
	
	echo '<section class="cta">';
	
		if ($callout) { echo '<div class="callout">'; }
		
			if ($heading) { echo '<h2>'.$heading.'</h2>'; }
			
			echo wpautop($text);
		
			echo '<a href="'.$link.'" class="button">'.$label.'</a>';
		
		if ($callout) { echo '</div>'; }
	
	echo '</section>';

?>