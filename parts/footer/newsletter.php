<?php

// Set form id here
$form_id = 4;
// Set email field's id here
$email_field_id = 3;
// Set name field's id here
$name_field_id = 4;
// Set org field's id here
$org_field_id = 5;
/*
Important parts:
- add #newsletter to the form
- add div.newsletter__notification at the bottom of the form
- email input should have a name "input_<?php echo $email_field_id; />"
- add hidden field for form_id
*/

?>
<form class="newsletter" id="newsletter">
   <h2>Subscribe</h2>
   <div class="newsletter__inner">
      <input type="hidden" name="form_id" value="<?php echo $form_id; ?>" />
      <input type="text" class="sqe_gf_input_name" name="input_<?php echo $name_field_id; ?>" placeholder="Your name" />
      <input type="text" class="sqe_gf_input_org" name="input_<?php echo $org_field_id; ?>" placeholder="Your organisation" />
      <input type="text" class="sqe_gf_input_email" name="input_<?php echo $email_field_id; ?>" placeholder="Your email" />
      <button type="submit"><span class="show-for-sr">Submit</span><i class="fa-solid fa-magnifying-glass fa-2x"></i></i></button>
   </div>
   <div class="newsletter__notification"></div>
</form>