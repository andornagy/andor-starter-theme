<?php
add_action('wp_ajax_process_ajax_newsletter', 'newsletterAjaxProcessor');
add_action('wp_ajax_nopriv_process_ajax_newsletter', 'newsletterAjaxProcessor');

function newsletterAjaxProcessor()
{
   // Check for nonce security      
   if (!wp_verify_nonce($_POST['nonce'], 'ajax-nonce'))
      wp_die(json_encode([
         'status' => 0,
         'message' => 'Nonce error'
      ]));

   $form_id = $_POST['form_id'];


   if (!$form_id) wp_die(json_encode([
      'status' => 0,
      'message' => 'Form ID is not provided'
   ]));

   $inputs = [];

   foreach ($_POST as $key => $value) {
      if (strpos($key, 'input_') === 0) {
         $inputs[$key] = $value;
      }
   }



   // Empty $_POST object, cuz otherwise it messes with GFAPI::submit_form function
   $_POST = [];

   $result = GFAPI::submit_form(
      $form_id,
      $inputs
   );

   if (is_wp_error($result))
      wp_die(json_encode([
         'status' => 1,
         'message' => $result->get_error_message()
      ]));

   if (!rgar($result, 'is_valid'))
      wp_die(json_encode([
         'status' => 1,
         // 'message' => 'Submission is invalid'
         'message' => rgar($result, 'validation_messages', array())
      ]));

   $confirmation_message = rgar($result, 'confirmation_message');

   wp_die(json_encode([
      'status' => 1,
      'result' => $result,
      'message' => strip_tags($confirmation_message)
   ]));
}
