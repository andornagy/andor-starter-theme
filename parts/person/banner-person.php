<?php

$id = get_the_id();
$post_type = get_post_type();

$title = get_the_title();

$jobtitle = get_field('job_title');
$years = getPersonYears($id);
$policy = get_field('personal_privacy_policy');

$phone = get_field('phone');
$email = get_field('email');

$linkedin = get_field('linkedin');
$twitter = get_field('twitter');

$banner_image = get_field('banner_photo', $id);
$img = $banner_image ? wp_get_attachment_image($banner_image['id'], 'large') : get_the_post_thumbnail($id, 'large');

$banner_background = get_field('banner_background');
?>
<section class="section person-banner">
   <div class="person-banner__bg" <?php if ($banner_background) echo 'style="background-image:url(\'' . wp_get_attachment_url($banner_background) . '\');"'; ?>></div>
   <div class="grid-container person-banner__inner">
      <?php
      if ($img) {
         $img_style = $banner_background ? 'style="background-image:url(\'' . wp_get_attachment_url($banner_background) . '\');"' : '';
         echo '<div class="person-banner__img" ' . $img_style . '>' . $img . '</div>';
      }
      ?>
      <div class="person-banner__content">
         <h1 class="person-banner__title"><?php the_title(); ?></h1>
         <?php
         if ($years) echo '<div class="person-banner__subtitle">' . $years . '</div>';
         if ($jobtitle) echo '<div class="person-banner__subtitle">' . $jobtitle . '</div>';
         ?>
         <div class="person-banner__actions grid-x grid-margin-x">
            <?php
            // Contact details and action buttons

            // First collect list of all items
            $list = [];

            // email
            if ($email) $list[] = '<li><a href="mailto:' . esc_attr($email) . '" title="' . sprintf(__('Email %s', 'squareeye'), $title) . '"><i class="fa-solid fa-envelope fa-fw"></i>' . esc_html($email) . '</a></li>';
            // phone
            if ($phone) $list[] = '<li><a href="tel:' .  makePhoneClickable($phone) . '" title="' . sprintf(__('Call %s', 'squareeye'), $title) . '"><i class="fa-solid fa-phone fa-fw"></i>' . esc_html($phone) . '</a></li>';

            // twitter
            if ($twitter) $list[] = '<li><a href="https://twitter.com/' . esc_html($twitter) . '" title="' . __('Twitter', 'squareeye') . '" target="_blank"><i class="fa-brands fa-twitter fa-fw"></i>' . __('Twitter', 'squareeye') . '</a></li>';
            // linked
            if ($linkedin) $list[] = '<li><a href="' . esc_attr($linkedin) . '" title="' . __('LinkedIn', 'squareeye') . '" target="_blank"><i class="fa-brands fa-linkedin fa-fw"></i>' . __('LinkedIn', 'squareeye') . '</a></li>';

            if ($post_type === 'barrister') {
               // pdf 
               if (get_field('pdf_generation', 'option'))
                  $list[] = '<li><i class="fa-solid fa-file-pdf fa-fw"></i>' . do_shortcode(' [sqe-pdf-btn title="' . __('Save PDF', 'squareeye') . '" class="" container_class="" icon="" display="inline-block"]') . '</li>';

               // vcard
               if (get_field('vcard_module', 'option'))
                  $list[] = '<li><i class="fa-solid fa-address-card fa-fw"></i>' . do_shortcode('[sqe-vcard-btn title="' . __('Download vCard', 'squareeye') . '" class="" display="inline-block"]') . '</li>';


               if ($policy)  $list[] = '<li><a href="' . esc_attr($policy) . '" target="_blank"><i class="fa-solid fa-user-secret fa-fw"></i>' . __('Privacy policy', 'squareeye') . '</a></li>';
            }

            // Second, calculate columns
            $total = count($list);

            $per_column = ceil($total / 3); // three columns max

            $start_html = '<div class="cell large-4"><ul>';
            $end_html = '</ul></div>';

            echo $start_html;
            if ($list) {
               foreach ($list as $i => $item) {
                  echo $item;

                  if (($i + 1) !== $total && ($i + 1) % $per_column === 0) echo $end_html . $start_html;
               }
            }

            echo $end_html;
            ?>
         </div>
      </div>
   </div>
</section>