<?php
/**
 * @file
 * The primary PHP file for this theme.
 */
/**
 * Implements hook_preprocess_page().
 *
 * @see page.tpl.php
 */
function mytheme_preprocess_page(&$variables) {
	$search_form = drupal_get_form('search_form');
  $search_form_box = drupal_render($search_form);
  $variables['mysearch'] = $search_form_box;
}

/**
 * Implements hook_process_page().
 *
 * @see page.tpl.php
 */
function mytheme_process_page(&$variables) {
	// Hide title 'Home' at front page
	if (drupal_is_front_page()) {
    $variables['title'] = NULL;
  }
  drupal_add_js(drupal_get_path('theme', 'mytheme') . '/js/jquery.mousewheel-3.0.6.pack.js');
  drupal_add_js(drupal_get_path('theme', 'mytheme') . '/js/fancybox/jquery.fancybox.pack.js');
  drupal_add_css(drupal_get_path('theme', 'mytheme') . '/js/fancybox/jquery.fancybox.css');
  $fancybox = "jQuery(document).ready(function() {
    jQuery('.fancybox').fancybox();
  });";
  drupal_add_js($fancybox, 'inline');
}

/**
 * Implements hook_menu_link__main_menu().
 */
function mytheme_menu_link__main_menu($variables) {
  $element = $variables['element'];
  $sub_menu = '';
  
  if ($element['#below']) {
    // Prevent dropdown functions from being added to management menu so it
    // does not affect the navbar module.
    if (($element['#original_link']['menu_name'] == 'management') && (module_exists('navbar'))) {
      $sub_menu = drupal_render($element['#below']);
    } elseif ((!empty($element['#original_link']['depth'])) && $element['#original_link']['depth'] > 1) {
      // Add our own wrapper.
      unset($element['#below']['#theme_wrappers']);
      $sub_menu = '<ul class="dropdown-menu">' . drupal_render($element['#below']) . '</ul>';
      $element['#attributes']['class'][] = 'dropdown-submenu';
      $element['#localized_options']['html'] = TRUE;
      $element['#localized_options']['attributes']['class'][] = 'dropdown-toggle';
      $element['#localized_options']['attributes']['data-toggle'] = 'dropdown';
    } else {
      unset($element['#below']['#theme_wrappers']);
      $sub_menu = '<ul class="dropdown-menu">' . drupal_render($element['#below']) . '</ul>';
      $element['#title'] .= ' <span class="caret"></span>';
      $element['#attributes']['class'][] = 'dropdown';
      $element['#localized_options']['html'] = TRUE;
      $element['#localized_options']['attributes']['class'][] = 'dropdown-toggle';
      $element['#localized_options']['attributes']['data-toggle'] = 'dropdown';
    }
  }
  if (($element['#href'] == $_GET['q'] || ($element['#href'] == '<front>' && drupal_is_front_page())) && (empty($element['#localized_options']['language']))) {
    $element['#attributes']['class'][] = 'active';
  }
  $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}

/**
 * Implements hook_preprocess_node().
 */
function mytheme_preprocess_node(&$variables) {
	//dsm($variables['theme_hook_suggestions']);
  //$variables['theme_hook_suggestions'][] = 'node__'. $variables['node']->type;
}

/**
 * Implements hook_form_alter().
 */
function mytheme_form_alter(&$form, &$form_state, $form_id) {
	$arg = arg();
	$default_value = ($arg[0] == 'recuiter' && $arg[1] == 'register') ? 1: 0;
  if ($form_id == 'user_register_form') {
	  $form['registration_type'] = array(
	    '#type' => 'radios',
	    '#default_value' => $default_value,
	    '#options' => array('Register As Athlete', 'Register As Coach'),
	    '#weight' => -1000,
	  );	
	}
}
