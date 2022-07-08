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



/*
* BUILD MENU ITEMS TREE
*/
function buildMenuItemsTree(array $elements, $parentId = 0)
{
  $branch = array();

  foreach ($elements as $element) {
    if ($element->menu_item_parent == $parentId) {
      $children = buildMenuItemsTree($elements, $element->ID);
      if ($children) {

        $element->children = $children;
      }
      $branch[] = $element;
    }
  }

  return $branch;
}

/**
 * GET SUB MENU
 * 
 * Returns standard WordPress menu items objects, but only under the provided parent and set in the parent-children tree hierarchy.
 * Element with children will have "children" key.
 *
 * @param int|string $parent Associated object ID or title of the menu item. Will display elements under this menu item. If null, then will use current page ID. Default: null.
 * @param string $menu Specify the menu slug or ID. If null, then will search all menus for a parent menu element. Default: null.
 * 
 * @return Array
 */

function getSubMenu($parent = null, $menu = null)
{
  $is_parent_numeric = true;
  $target_menu_items = null;

  // If no parent menu item set, then use current page id as an object_id
  if (!$parent) $parent = get_the_ID();
  // Else check if parent is numeric or string
  else if (!is_numeric($parent)) $is_parent_numeric = false;

  // if menu slug isn't set, then will go through all menus
  if (!$menu) {

    $target_menu_id = null;

    $menus = get_terms('nav_menu');

    // Get only menus ids
    $menus = wp_list_pluck($menus, 'term_id');

    foreach ($menus as $menu_id) {
      // Get menu items
      $menu_items = wp_get_nav_menu_items($menu_id);

      // Go through each menu item until we find the relevant, then break both loops
      foreach ($menu_items as $menu_item) {
        if (
          ($menu_item->object === 'page' || $menu_item->object === 'custom') &&
          ($is_parent_numeric && intval($menu_item->object_id) === intval($parent) ||
            !$is_parent_numeric && $menu_item->title === $parent
          )
        ) {
          // Set target menu ID
          $target_menu_id = $menu_id;
          // Set target menu items
          $target_menu_items = $menu_items;
          // Override parent with ID
          $parent = $menu_item->ID;
          // Break loops
          break 2;
        }
      }
    }

    // Set parent menu item
    if ($target_menu_id) $menu = $target_menu_id;
  }

  // Check if menu is set
  if (!$menu) return;

  // If menu items aren't set, then do it
  if ($target_menu_items === null) $target_menu_items = wp_get_nav_menu_items($menu);

  // If no menu items, then exit
  if (!$target_menu_items) return;

  // If parent isn't ID already, then need to loop through all items and set ID
  if (!is_numeric($parent)) {
    foreach ($target_menu_items as $menu_item) {
      if (($menu_item->object === 'page' || $menu_item->object === 'custom') && $menu_item->title === $parent) {
        $parent = $menu_item->ID;
      }
    }
  }

  // Build tree from menu items
  $menu_items_tree = buildMenuItemsTree($target_menu_items, $parent);

  // Return
  return $menu_items_tree;
}
