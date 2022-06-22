<?php
function displaySiteLogo()
{
    return '<a href="' . site_url() . '" class="site-logo"><img src="' . get_stylesheet_directory_uri() . '/assets/imgs/logo.png" alt="' . get_bloginfo('name') . '" /></a>';
}

add_shortcode('site_logo', 'displaySiteLogo');

/*
* DISPLAY CURRENT YEAR
*/

function displayCurrentYear()
{
    return date('Y');
}

add_shortcode('current_year', 'displayCurrentYear');


/* Display barrister call & silk years  ________________________________________________________ */


function displayBarristerYears($atts)
{
    $a = shortcode_atts(array(
        'class' => null,
        'id' => get_the_ID()
    ), $atts);

    $output = '';

    if (function_exists('get_field')) {
        $call = get_field('call_year', $a['id']);
        $calloverride = get_field('call_override', $a['id']);
        if ($calloverride) { $call = $calloverride; }
        $silk = get_field('silk_year', $a['id']);

        if ($call || $silk) {
            $output .= $a['class'] ? '<span class="' . esc_attr($a['class']) . '">' : '<span>';

            $years = array();
            if ($silk) $years[] = sprintf(__('Silk: %s', 'squareeye'), $silk);
            if ($call) $years[] = sprintf(__('Call: %s', 'squareeye'), $call);
            $output .= implode(' | ', $years);

            $output .= '</span>';
        }
    }

    return $output;
}

add_shortcode('barrister_years', 'displayBarristerYears');




/* Chambers contact details  ________________________________________________________ */


function displayChambersContacts()
{
    $address = array(
        array(
            'organisation'
        ),
        array(
            'address1',
            'address2',
        ),
        array(
            'city',
            'postcode',
            'country'
        ),
        array(
            'email'
        ),
        array(
            'phone'
        ),
        array(

            'dx'
        ),
    );

    $address_arr = array();

    foreach ($address as $key => $address_block) {
        foreach ($address_block as $field) {
            $value = get_field($field, 'options');
            if ($value) {
                if (!isset($address_arr[$key])) $address_arr[$key] = array();
                if ($field == 'dx') $value = 'DX: ' . $value;
                if ($field == 'phone') $value = sprintf(__('Tel. : %s', 'squareeye'), $value);
                if ($field == 'email') {
                    $email = antispambot($value);
                    $value = '<a href="mailto:' . $email . '">' . $email . '</a>';
                }
                $address_arr[$key][] = $value;
            }
        }
    }

    if ($address_arr) {
        $output = '<div class="chamber-contacts">';
        foreach ($address_arr as $address_block) {
            if (is_array($address_block) && $address_block) {
                echo '<div>' . implode(', ', $address_block) . '</div>';
            }
        }
        $output .= '</div>';
    }

    return $output;
}

add_shortcode('chambers_contacts', 'displayChambersContacts');

/*
* ACCORDIONS
*/

function showAccordion($atts)
{

    $a = shortcode_atts(array(
        'openfirst' => false,
    ), $atts);

    $sections = get_field('accordion_sections');
    $openfirst = get_field('open_first');

    $output = '';


    if ($sections) {

        $output = '<ul class="accordion" data-multi-expand="true" data-accordion data-deep-link="true" data-allow-all-closed="true" role="tablist">';
        $counter = 0;
        foreach ($sections as $section) {
            $counter++;
            $title = $section['heading'];
            $slug = sanitize_title($title);
            $text = $section['text'];
            $output .= '<li class="accordion-item';
            if ($openfirst and ($counter == 1)) {
                $output .= ' is-active';
            }
            $output .= '" data-accordion-item>';
            $output .= '<a href="#' . $slug . '" class="accordion-title">' . $title . '</a>';
            $output .= '<div class="accordion-content" data-tab-content id="' . $slug . '">';
            $output .= $text;
            $output .= '</div>';
            $output .= '</li>';
        }
        $output .= '</ul>';
    }

    return $output;
}

add_shortcode('accordions', 'showAccordions');
