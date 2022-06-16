<?php
	
	
/* Menus  ________________________________________________________ */


register_nav_menus(array(
    'main-menu' => 'Main menu',
    'top-menu' => 'Top menu',
    'footer-menu' => 'Footer menu'
));
    
    

/* Desktop menu  ________________________________________________________ */


class Desktop_Menu_Walker extends Walker_Nav_Menu
{

  function display_element($element, &$children_elements, $max_depth, $depth, $args, &$output)
  {
    if ($depth === 0) {
      $content = '';

      $current_id = get_the_ID();

      $is_parent_current = false;

      if (!is_array($element->classes)) return;

      if (in_array('current-menu-item', $element->classes)) $is_parent_current = true;

      $container_class = implode(' ', $element->classes);

      if (in_array('menu-item-has-children', $element->classes)) {

        $child_items = [];

        foreach ($children_elements as $children) {
          foreach ($children as $child) {
            if ($child->menu_item_parent == $element->ID) {
              if (in_array('current-menu-item', $child->classes)) $is_parent_current = true;
              $child_items[] = '<li class="' . implode(' ', $child->classes) . '"><a href="' . $child->url . '" title="' . $child->title . '">' . $child->title . '</a></li>';
            }
          }
        }

        $total = count($child_items);
        $per_column = ceil($total / 3);
        if ($child_items) {
          $content .= '<div class="grid-x grid-margin-x">';
          $content .= '<div class="cell large-4">';
          $content .= '<ul class="sub-menu__menu">';
          foreach ($child_items as $i => $child) {
            $content .= $child;
            if (($i + 1) % $per_column === 0) $content .= '</ul></div><div class="cell large-4"><ul class="sub-menu__menu">';
          }
          $content .= '</ul>';
          $content .= '</div>';
          $content .= '</div>';
        }
      }

      // Set parent active class
      if ($is_parent_current) $container_class .= ' current-menu-item';

      // Output desktop menu item
      $output .= '<li class="' . esc_attr($container_class) . '">';
      $output .= '<a href="' . $element->url . '">';
      $output .= $element->title;
      $output .= '</a>';
      if ($content) {
        $output .= '<div class="sub-menu">';
        $output .= '<div class="sub-menu__arrow"></div>';
        $output .= '<div class="grid-container padding-vertical-2">';
        $output .= '<div class="grid-x grid-margin-x grid-padding-y">';
        $output .= '<div class="cell large-4">';
        if ($element->description) {
          $output .= '<div class="sub-menu__description">' . $element->description . '</div>';
        }
        $output .= '<a href="' . $element->url . '" title="' . $element->title  . '" class="sub-menu__title">' . $element->title . '</a>';
        $output .= '</div>';
        $output .= '<div class="cell large-8">';
        $output .= '<div class="sub-menu__content">';
        $output .= $content;
        $output .= '</div>';
        $output .= '</div>';
        $output .= '</div>';
        $output .= '</div>';
        $output .= '</div>';
      }

      $output .= '</li>';
    }
  }
}


/* Mobile menu (remove this if ShiftNav is used)  ________________________________________________________ */

class Mobile_Menu_Walker extends Walker_Nav_Menu
{

  function display_element($element, &$children_elements, $max_depth, $depth, $args, &$output)
  {
    if ($depth === 0) {
      $content = '';

      $current_id = get_the_ID();

      $is_parent_current = false;

      $parent_classes = implode(' ', $element->classes);

      if (in_array('menu-item-has-children', $element->classes)) {
        $child_items = [];

        foreach ($children_elements as $children) {
          foreach ($children as $child) {
            if ($child->menu_item_parent == $element->ID) {
              if (in_array('current-menu-item', $child->classes)) $is_parent_current = true;
              $child_items[] = '<li class="' . implode(' ', $child->classes) . '"><a href="' . $child->url . '" title="' . $child->title . '">' . $child->title . '</a></li>';
            }
          }
        }

        if ($child_items) {
          $content .= '<ul class="menu vertical nested">';
          foreach ($child_items as $i => $child) {
            $content .= $child;
          }
          $content .= '</ul>';
        }
      }

      // Set parent active class
      if ($is_parent_current) $parent_classes .= ' current-menu-item';

      // Output menu item
      $output .= '<li class="' . esc_attr($parent_classes) . '">';
      $output .= '<a href="' . $element->url . '">' . $element->title . '</a>';
      if ($content) $output .= $content;
      $output .= '</li>';
    }
  }
}
