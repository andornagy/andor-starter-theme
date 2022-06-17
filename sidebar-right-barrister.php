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
	
?>


<div class="sidebar sidebar-right">
	
	<div class="callout contacts">
		<ul>
			<?php
				
				if ($email) { echo '<li><a href="mailto:'.$email.'"><i class="fa-solid fa-envelope"></i> '.$email.'</a></li>'; }
				if ($phone) { echo '<li><a href="tel:'.$phone.'"><i class="fa-solid fa-phone"></i> '.$phone.'</a></li>'; }
				if ($linkedin) { echo '<li><a href="'.$linkedin.'"><i class="fa-brands fa-linkedin"></i> '.$linkedin.'</a></li>'; }
				if ($twitter) { echo '<li><a href="tel:'.$twitter.'"><i class="fa-brands fa-twitter-square"></i> '.$twitter.'</a></li>'; }
				echo '<li><a href="#"><i class="fa-solid fa-address-card"></i> Download vCard</a></li>';
				echo '<li><a href="#"><i class="fa-solid fa-file-pdf"></i> Save as PDF</a></li>';
			?>
		</ul>
	</div>
	
</div>