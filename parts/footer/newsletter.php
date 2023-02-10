<?php

// Set form id here
$form_id = 4;
// Set email field's id here
$email_field_id = 3;

/*
Important parts:
- add #newsletter to the form
- add div.newsletter__notification at the bottom of the form
- email input should have a name "input_<?php echo $email_field_id; />"
- add hidden field for form_id
*/

?>
<form class="newsletter" id="newsletter">
   <div class="newsletter__inner">
      <input type="hidden" name="form_id" value="<?php echo $form_id; ?>" />
      <input type="text" name="input_<?php echo $email_field_id; ?>" placeholder="Enter your email" />
      <button type="submit"><span class="show-for-sr">Submit</span><i class="fa-light fa-2x fa-circle-arrow-right"></i></button>
   </div>
   <div class="newsletter__notification"></div>
</form>