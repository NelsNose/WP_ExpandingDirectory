<?php
/*
Plugin Name: Expanding Directory
Description: Creates a custom Post Type for Directory listings, displayed in groups by Tag, supporting multiple lists. [expdirectory (cat="num/slug")]
Version: 1.2
Author: Nels Noseworthy
Author URI: http://nelsnose.net
License: GPL2
*/

/*  Copyright 2012  Nels Noseworthy  (email : nels@nelsnose.net)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

add_action( 'init', 'expandingdirectory_item_post_type' );
function expandingdirectory_item_post_type() {
  $directory_item_params = array(
    'labels' => array(
      'name' => __( 'Directory Items' ),
      'singular_name' => __( 'Directory Item' ),
    ),
    'public' => true,
    'has_archive' => true,
    'rewrite' => array('slug' => 'directory'),
    'capability_type' => 'post',
    'supports' => array('title',
      'editor',
      'author',
      'thumbnail',
      'custom-fields'),
    'taxonomies' => array('category', 'post_tag')
  );
  register_post_type( 'directory_item', apply_filters('expandingdirectory_item_params', $directory_item_params));
}

// Add the Meta Boxes
function expandingdirectory_meta_boxes() {
    add_meta_box(
        'dir_website', // $id
        'Website', // $title
        'dir_website', // $callback
        'directory_item', // $page
        'normal', // $context
        'high'); // $priority
    add_meta_box(
        'dir_phone', // $id
        'Phone', // $title
        'dir_phone', // $callback
        'directory_item', // $page
        'normal', // $context
        'high'); // $priority
    add_meta_box(
        'dir_mobile', // $id
        'Mobile', // $title
        'dir_mobile', // $callback
        'directory_item', // $page
        'normal', // $context
        'high'); // $priority
    add_meta_box(
        'dir_fax', // $id
        'Fax', // $title
        'dir_fax', // $callback
        'directory_item', // $page
        'normal', // $context
        'high'); // $priority
    add_meta_box(
        'dir_email', // $id
        'Email', // $title
        'dir_email', // $callback
        'directory_item', // $page
        'normal', // $context
        'high'); // $priority
    add_meta_box(
        'dir_address', // $id
        'Address', // $title
        'dir_address', // $callback
        'directory_item', // $page
        'normal', // $context
        'high'); // $priority
    add_meta_box(
        'dir_city', // $id
        'City', // $title
        'dir_city', // $callback
        'directory_item', // $page
        'normal', // $context
        'high'); // $priority
    add_meta_box(
        'dir_state', // $id
        'State', // $title
        'dir_state', // $callback
        'directory_item', // $page
        'normal', // $context
        'high'); // $priority
    add_meta_box(
        'dir_zip', // $id
        'Zip Code', // $title
        'dir_zip', // $callback
        'directory_item', // $page
        'normal', // $context
        'high'); // $priority
}
add_action('add_meta_boxes', 'expandingdirectory_meta_boxes');

/* Prints the box content */
function dir_website( $post ) {
  // Use nonce for verification
  wp_nonce_field( plugin_basename( __FILE__ ), 'dir_noncename' );
  $value = get_post_meta($post->ID, 'dir_website') ? get_post_meta($post->ID, 'dir_website', TRUE) : NULL;
  // The actual fields for data entry
  echo '<label for="dir_website_field">';
  echo 'Website';
  echo '</label> ';
  echo '<input type="text" id="dir_website_field" name="dir_website_field" size="35" value="' . $value .'" />';
}

function dir_phone( $post ) {
  // Use nonce for verification
  wp_nonce_field( plugin_basename( __FILE__ ), 'dir_noncename' );
  $value = get_post_meta($post->ID, 'dir_phone') ? get_post_meta($post->ID, 'dir_phone', TRUE) : NULL;
  // The actual fields for data entry
  echo '<label for="dir_phone_field">';
  echo 'Phone number';
  echo '</label> <br/>';
  echo '<input type="tel" id="dir_phone_field" name="dir_phone_field" size="25" value="' . $value .'" /><br/>';
}

function dir_mobile( $post ) {
  // Use nonce for verification
  wp_nonce_field( plugin_basename( __FILE__ ), 'dir_noncename' );
  $value = get_post_meta($post->ID, 'dir_mobile') ? get_post_meta($post->ID, 'dir_mobile', TRUE) : NULL;
  // The actual fields for data entry
  echo '<label for="dir_mobile_field">';
  echo 'Mobile number';
  echo '</label> <br/>';
  echo '<input type="tel" id="dir_mobile_field" name="dir_mobile_field" size="25" value="' . $value .'" /><br/>';
}

function dir_fax( $post ) {
  // Use nonce for verification
  wp_nonce_field( plugin_basename( __FILE__ ), 'dir_noncename' );
  $value = get_post_meta($post->ID, 'dir_fax') ? get_post_meta($post->ID, 'dir_fax', TRUE) : NULL;
  // The actual fields for data entry
  echo '<label for="dir_fax_field">';
  echo 'Fax number';
  echo '</label> <br/>';
  echo '<input type="tel" id="dir_fax_field" name="dir_fax_field" size="25" value="' . $value .'" /><br/>';
}

function dir_email( $post ) {
  // Use nonce for verification
  wp_nonce_field( plugin_basename( __FILE__ ), 'dir_noncename' );
  $value = get_post_meta($post->ID, 'dir_email') ? get_post_meta($post->ID, 'dir_email', TRUE) : NULL;
  // The actual fields for data entry
  echo '<label for="dir_email_field">';
  echo 'Email Address';
  echo '</label> ';
  echo '<input type="email" id="dir_email_field" name="dir_email_field" size="35" value="' . $value .'" />';
}

function dir_address( $post ) {
  // Use nonce for verification
  wp_nonce_field( plugin_basename( __FILE__ ), 'dir_noncename' );
  $value = get_post_meta($post->ID, 'dir_address') ? get_post_meta($post->ID, 'dir_address', TRUE) : NULL;
  // The actual fields for data entry
  echo '<label for="dir_address_field">';
  echo 'Street Address';
  echo '</label> ';
  echo '<input type="text" id="dir_address_field" name="dir_address_field" size="45" value="' . $value .'" />';
}

function dir_city( $post ) {
  // Use nonce for verification
  wp_nonce_field( plugin_basename( __FILE__ ), 'dir_noncename' );
  $options = get_option('expand_dir_options');
  global $pagenow;
  if (in_array( $pagenow, array( 'post-new.php' ))) {
    $defaultcity = $options['expand_dir_text_city'];
  }
  else {
    $defaultcity = NULL;
  }
  $value = get_post_meta($post->ID, 'dir_city') ? get_post_meta($post->ID, 'dir_city', TRUE) : $defaultcity;
  // The actual fields for data entry
  echo '<label for="dir_city_field">';
  echo 'City';
  echo '</label> ';
  echo '<input type="text" id="dir_city_field" name="dir_city_field" size="18" value="' . $value .'" />';
}

function dir_state( $post ) {
  // Use nonce for verification
  wp_nonce_field( plugin_basename( __FILE__ ), 'dir_noncename' );
  $options = get_option('expand_dir_options');
  global $pagenow;
  if (in_array( $pagenow, array( 'post-new.php' ))) {
    $defaultstate = $options['expand_dir_text_state'];
  }
  else {
    $defaultstate = NULL;
  }
  $value = get_post_meta($post->ID, 'dir_state') ? get_post_meta($post->ID, 'dir_state', TRUE) : $defaultstate;
  // The actual fields for data entry
  echo '<label for="dir_state_field">';
  echo 'State';
  echo '</label> ';
  echo '<input type="text" id="dir_state_field" name="dir_state_field" size="2" value="' . $value .'" />';
}

function dir_zip( $post ) {
  // Use nonce for verification
  wp_nonce_field( plugin_basename( __FILE__ ), 'dir_noncename' );
  $options = get_option('expand_dir_options');
  global $pagenow;
  if (in_array( $pagenow, array( 'post-new.php' ))) {
    $defaultzip = $options['expand_dir_text_zip'];
  }
  else {
    $defaultzip = NULL;
  }
  $value = get_post_meta($post->ID, 'dir_zip') ? get_post_meta($post->ID, 'dir_zip', TRUE) : $defaultzip;
  // The actual fields for data entry
  echo '<label for="dir_zip_field">';
  echo 'Zip Code';
  echo '</label> <br/>';
  echo '<input type="number" id="dir_zip_field" name="dir_zip_field" size="6" value="' . $value .'" /><br/>';
}

/* When the post is saved, saves our custom data */
function expandingdirectory_item_save_postdata( $post_id, $post, $update ) {
  // verify if this is an auto save routine.
  // If it is our form has not been submitted, so we dont want to do anything
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
    return;

  // verify this came from the our screen and with proper authorization,
  // because save_post can be triggered at other times

  if (!isset($_POST['dir_noncename']) || !wp_verify_nonce( $_POST['dir_noncename'], plugin_basename( __FILE__ ) ) )
    return;

  // Check permissions
  if ( 'directory_item' != $_POST['post_type'] ) {
    return;
  }
  else
  {
    if ( !current_user_can( 'edit_post', $post_id ) )
      return;
  }

  // OK, we're authenticated: we need to find and save the data
  $post_ID = $_POST['post_ID'];
  $dir_website = $_POST['dir_website_field'];
  $dir_phone = $_POST['dir_phone_field'];
  $dir_mobile = $_POST['dir_mobile_field'];
  $dir_fax = $_POST['dir_fax_field'];
  $dir_email = $_POST['dir_email_field'];
  $dir_address = $_POST['dir_address_field'];
  $dir_city = $_POST['dir_city_field'];
  $dir_state = $_POST['dir_state_field'];
  $dir_zip = $_POST['dir_zip_field'];

  if (isset($dir_website)) {
    update_post_meta($post_ID, 'dir_website', $dir_website);
  }
  else {
    delete_post_meta($post_ID, 'dir_website');
  }
  if (isset($dir_phone)) {
    update_post_meta($post_ID, 'dir_phone', $dir_phone);
  }
  else {
    delete_post_meta($post_ID, 'dir_phone');
  }
  if (isset($dir_mobile)) {
    update_post_meta($post_ID, 'dir_mobile', $dir_mobile);
  }
  else {
    delete_post_meta($post_ID, 'dir_mobile');
  }
  if (isset($dir_fax)) {
    update_post_meta($post_ID, 'dir_fax', $dir_fax);
  }
  else {
    delete_post_meta($post_ID, 'dir_fax');
  }
  if (isset($dir_email)) {
    update_post_meta($post_ID, 'dir_email', $dir_email);
  }
  else {
    delete_post_meta($post_ID, 'dir_email');
  }
  if (isset($dir_address)) {
    update_post_meta($post_ID, 'dir_address', $dir_address);
  }
  else {
    delete_post_meta($post_ID, 'dir_address');
  }
  if (isset($dir_city)) {
    update_post_meta($post_ID, 'dir_city', $dir_city);
  }
  else {
    delete_post_meta($post_ID, 'dir_city');
  }
  if (isset($dir_zip)) {
    update_post_meta($post_ID, 'dir_zip', $dir_zip);
  }
  else {
    delete_post_meta($post_ID, 'dir_zip');
  }

  $tags = $_POST['tax_input']['post_tag'];
  if (isset($tags)) {
    if (!is_array($tags)) {
      $tags = explode(',', $tags);
    }
    foreach($tags as $tag) {
      $tag = trim($tag);

      if (is_numeric($tag)) {
        $tag = get_term_by('id', $tag, 'post_tag');
        $tag = $tag->name;
      }

      $term = get_term_by('name', $tag, 'category');

      if (!($term)) {
        $niceterm = str_replace(' ', '-', strtolower($tag));
        $newcat = array(
          'cat_name' => $tag,
          'category_description' => 'auto-gen',
          'category_nicename' => $niceterm,
          'category_parent' => 23,
          'taxonomy' => 'category'
        );
        $my_cat_id = wp_insert_category($newcat, TRUE);
        $newcatid = intval($my_cat_id);
      }
      else {
        $newcatid = intval($term->term_id);
      }

      wp_set_object_terms( $post_ID, $newcatid, 'category', TRUE );
    }
  }
}
add_action( 'save_post', 'expandingdirectory_item_save_postdata', 10, 3);

function expandingdirectory_clear_cache( $post_id ) {
  if (get_post_type($post_id) == 'directory_item') {
    delete_transient('expanding_dir');
    $category = get_the_category($post_id);
    foreach ($category as $i => $cat) {
      delete_transient('expanding_dir_' . $cat->cat_ID);
      delete_transient('expanding_dir_' . $cat->slug);
    }
  }
}
add_action ('wp_insert_post', 'expandingdirectory_clear_cache');
add_action ('pre_post_update', 'expandingdirectory_clear_cache');
add_action ('private_to_published', 'expandingdirectory_clear_cache');
add_action ('wp_trash_post', 'expandingdirectory_clear_cache');
add_action ('delete_post', 'expandingdirectory_clear_cache');

add_filter('query_vars', 'expandingdirectory_queryvars' );

function expandingdirectory_queryvars( $vars ) {
  $vars[] = "dir_search_term";
  return $vars;
}

function order_by_tag($query) {
  if ((isset($query->query['post_type'])) && ($query->query['post_type'] == 'directory_item')) {
    $query->set('orderby', 'tag');
  }
  return;
}
add_action( 'pre_get_posts', 'order_by_tag');

function archive_takes_all($query) {
  if (is_post_type_archive('directory_item')) {
    $query->set('posts_per_page', '-1');
    return;
  }
}
add_action( 'pre_get_posts', 'archive_takes_all');

function expandingdirectory_templates($template_path ) {
  if ( get_post_type() == 'directory_item' ) {
    if ( is_single() ) {
      if ( $theme_file = locate_template( array( 'single-directory_item.php' ) ) ) {
        $template_path = $theme_file;
      }
      else {
        $template_path = plugin_dir_path( __FILE__ ) .'single-directory_item.php';
      }
    }
    else {
      if ($theme_file = locate_template( array( 'archive-directory_item.php' ) ) ) {
        $template_path = $theme_file;
      }
      else {
        $template_path = plugin_dir_path( __FILE__ ) .'archive-directory_item.php';
      }
    }
  }
  return $template_path;
}
add_filter( 'template_include','expandingdirectory_templates', 1 );

function expandingdirectory_scripts() {
  wp_enqueue_style('expand-dir-css', plugins_url('/css/expand_dir.css', __FILE__));
  wp_enqueue_script('expand-dir-js', plugins_url('/js/expand_dir.js', __FILE__),array('jquery'));
}
add_action('wp_enqueue_scripts', 'expandingdirectory_scripts');

function expandingdirectory_shortcode($atts) {
  extract(shortcode_atts(array(
    'cat' => NULL,
    'search' => NULL,
    'submit' => NULL,
    'submittext' => 'Submit a listing',
    'feedback' => NULL,
    'feedbacktext' => 'Feedback',
  ), $atts));

  $directory_submission_received = FALSE;
  $directory_feedback_received = FALSE;

  $output = '';
  // process listing submission
  if (isset($_POST['dir_noncename']) && wp_verify_nonce($_POST['dir_noncename'], plugin_basename( __FILE__ )) && !empty($_POST['dir_title_field'])) {
    // check for title and that listing doesn't exist
    if (!empty($_POST['dir_title_field']) && NULL == get_page_by_title($_POST['dir_title_field'], 'OBJECT', 'directory_item' )) {
      $dir_name = $_POST['dir_title_field'];
      $dir_website = sanitize_meta('dir_website', $_POST['dir_website_field'], 'directory_item');
      $dir_phone = sanitize_meta('dir_phone', $_POST['dir_phone_field'], 'directory_item');
      $dir_mobile = sanitize_meta('dir_mobile', $_POST['dir_mobile_field'], 'directory_item');
      $dir_fax = sanitize_meta('dir_fax', $_POST['dir_fax_field'], 'directory_item');
      $dir_email = sanitize_meta('dir_email', $_POST['dir_email_field'], 'directory_item');
      $dir_address = sanitize_meta('dir_address', $_POST['dir_address_field'], 'directory_item');
      $dir_city = sanitize_meta('dir_city', $_POST['dir_city_field'], 'directory_item');
      $dir_state = sanitize_meta('dir_state', $_POST['dir_state_field'], 'directory_item');
      $dir_zip = sanitize_meta('dir_zip', $_POST['dir_zip_field'], 'directory_item');
      $dir_category = isset($_POST['dir_category']) ? $_POST['dir_category'] : '';
      $post_id = wp_insert_post(
        array(
          'comment_status' => 'closed',
          'ping_status'    => 'closed',
          'post_title'     => $dir_name,
          'post_content'   => $_POST['dir_body_field'],
          'post_status'    => 'pending',
          'post_type'      => 'directory_item',
          'post_category'  => array($dir_category),
          'meta_input'     => array(
            'dir_website' => $dir_website,
            'dir_phone'   => $dir_phone,
            'dir_mobile'  => $dir_mobile,
            'dir_fax'     => $dir_fax,
            'dir_email'   => $dir_email,
            'dir_address' => $dir_address,
            'dir_city'    => $dir_city,
            'dir_state'   => $dir_state,
            'dir_zip'     => $dir_zip,
          ),
        )
      );
      // if adding the listing was successful.
      if ($post_id > 0) {
        // get the admin email
        $options = get_option('expand_dir_options');
        $to = (NULL == $options['expand_dir_admin_email']) ? get_option('admin_email') : $options['expand_dir_admin_email'];
//        $to = get_option( 'admin_email' );
        $subject = get_bloginfo( 'name' ) . ' - Directory Item Submitted : ' . $dir_name;
        $message = "A new Directory Item is Pending administrative action. Here are the details:\r\n\r\nNAME   : " . $dir_name . "\r\n";
        if (!empty($_POST['dir_body_field'])) {
          $message .= "ABOUT  : " . $_POST['dir_body_field'] . "\r\n";
        }
        if (!empty($dir_website)) {
          $message .= "WEBSITE: " . $dir_website . "\r\n";
        }
        if (!empty($dir_phone) || !empty($dir_mobile) || !empty($dir_fax) || !empty($dir_email)) {
          $message .= "CONTACT:\r\n";
        }
        if (!empty($dir_phone)) {
          $message .= "\t  PHONE: " . $dir_phone . "\r\n";
        }
        if (!empty($dir_mobile)) {
          $message .= "\t MOBILE: " . $dir_mobile . "\r\n";
        }
        if (!empty($dir_fax)) {
          $message .= "\t    FAX: " . $dir_fax . "\r\n";
        }
        if (!empty($dir_email)) {
          $message .= "\t  EMAIL: " . $dir_email . "\r\n";
        }
        $message .= "\r\nTo approve this submission, assign the appropriate Category and Tag, then Publish.\r\n" . site_url('wp-admin/post.php?post=' . $post_id . '&action=edit');
        wp_mail( $to, $subject, $message );
        $directory_submission_received = TRUE;
      }
    }
  }

  // process feedback form
  if (isset($_POST['dirfeedback_noncename']) && wp_verify_nonce($_POST['dirfeedback_noncename'], plugin_basename( __FILE__ )) && !empty($_POST['dir_feedback_field'])) {
    $feedback_from = isset($_POST['dir_feedback_from']) ? $_POST['dir_feedback_from'] : 'no-email';
    $options = get_option('expand_dir_options');
    $to = (NULL == $options['expand_dir_admin_email']) ? get_option('admin_email') : $options['expand_dir_admin_email'];
//    $to = get_option( 'admin_email' );
    $subject = get_bloginfo( 'name' ) . ' - Directory Feedback (' . $_POST['dir_feedback_type'] . ') Submitted by "' . $feedback_from . '"';
    $message = '';
    if (isset($_POST['dir_feedback_category'])) {
      $message .= 'Category: ' . $_POST['dir_feedback_category'] . "\r\n\r\n";
    }
    $message .= $_POST['dir_feedback_field'];
    wp_mail( $to, $subject, $message );
    $directory_feedback_received = TRUE;
  }

  $search_term = get_query_var('dir_search_term', NULL);
  $dirArgs = array();
  $dirArgs['post_type'] = 'directory_item';
  $category = isset($cat) ? $cat : NULL;
  $display_search = isset($search) ? $search : FALSE;
  $display_submit = isset($submit) ? $submit : FALSE;
  $display_feedback = isset($feedback) ? $feedback : FALSE;

  if(!is_null($category)) {
    $cached_output = get_transient('expanding_dir_' . $category);
    if (empty($search_term) && $cached_output !== FALSE) {
      if ($display_search) {
        $cached_output = expandingdirectory_search_form() . $cached_output;
      }
      if ($display_submit || $display_feedback) {
        $cached_output .= '<div class="directory-forms">';
        if ($display_submit) {
          $cached_output .= expandingdirectory_submission_form($category, $submittext);
        }
        if ($display_feedback) {
          $cached_output .= expandingdirectory_feedback_form($category, $feedbacktext);
        }
        $cached_output .= '</div>';
      }
      return $cached_output;
    }
    if(is_numeric($category)) {
      $dirArgs['cat'] = $category;
    }
    else {
      $dirArgs['category_name'] = $category;
    }
  }
  else {
    $cached_output = get_transient('expanding_dir');
    if (empty($search_term) && $cached_output !== FALSE) {
      if ($display_search) {
        $cached_output = expandingdirectory_search_form() . $cached_output;
      }
      if ($display_submit || $display_feedback) {
        $cached_output .= '<div class="directory-forms">';
        if ($display_submit) {
          $cached_output .= expandingdirectory_submission_form($category, $submittext);
        }
        if ($display_feedback) {
          $cached_output .= expandingdirectory_feedback_form($category, $feedbacktext);
        }
        $cached_output .= '</div>';
      }
      return $cached_output;
    }
  }

  $dirArgs['posts_per_page'] = '-1';
  $dirArgs['orderby'] = 'title';
  $dirArgs['order'] = 'ASC';

  if (!empty($search_term)) {
    $dirArgs['s'] = $search_term;
  }

  $dirQuery = new wp_Query($dirArgs);

  $output = '';

  if (!empty($search_term)) {
    $output .= '<h2>' . $dirQuery->post_count . ' Search results for <i>"' . $search_term . '"</i></h2>';
  }

  $tags = get_terms('post_tag');
  $orderedlist = array();
  $options = FALSE; // need to build in some addition options for display
  if (isset($tags)) {
    foreach ($tags as $tag) {
      $orderedlist[$tag->slug][0] = '';
    }
  }

  if ($dirQuery->have_posts()) :
    while ($dirQuery->have_posts()) : $dirQuery->the_post();
      $postid = get_the_ID();
      $posttitle = preg_replace('/^\*/', '1 ', get_the_title());
      $didetails = get_post_meta($postid);
      $tags = wp_get_post_tags($postid);
      $collapsed = 'collapsed';
      if (!empty($search_term) && $dirQuery->post_count < 6) {
        $collapsed = 'expanded';
      }
      foreach ($tags as $tag) {
        if(!isset($orderedlist[$tag->slug][1])) {
          $orderedlist[$tag->slug][1] = '<div class="directory-section"><div class="toggle ' . $collapsed . '" onclick="toggleDiv(\'' . $tag->slug . '\')" id="' . $tag->slug . '-toggle">' . $tag->name . '</div>';
          $orderedlist[$tag->slug][1] .= '<div id="' . $tag->slug . '-wrapper" class="directory-wrapper" style="'; if ($collapsed == 'collapsed') { $orderedlist[$tag->slug][1] .= 'height:0px; ';} $orderedlist[$tag->slug][1] .= 'overflow:hidden;">';
          $orderedlist[$tag->slug][1] .= '<div id="' . $tag->slug . '">';
        }
        $orderedlist[$tag->slug][$posttitle] = '<div id="post-' . $postid . '" class="';
        $classes = get_post_class('vcard');
        foreach ($classes as $class) {
          $orderedlist[$tag->slug][$posttitle] .= $class . ' ';
        }
        $orderedlist[$tag->slug][$posttitle] .= '">';
        $orderedlist[$tag->slug][$posttitle] .= '<h4 class="post-title business-name">' . get_the_title() . '</h4>';
        if(isset($didetails['dir_website'])) {
          $url = $didetails['dir_website'][0];
          if (!preg_match('/^http/', $url)) { $url = 'http://'.$url; }
          $orderedlist[$tag->slug][$posttitle] .= '<div class="url"><a class="url" href="' . $url . '" target="_blank">' . $didetails['dir_website'][0] . '</a></div>';
        }
        if($didetails['dir_phone'][0] != NULL) {
          $orderedlist[$tag->slug][$posttitle] .= '<div class="tel">P: ' . $didetails['dir_phone'][0] . '</div>';
        }
        if($didetails['dir_mobile'][0] != NULL) {
          $orderedlist[$tag->slug][$posttitle] .= '<div class="tel">C: ' . $didetails['dir_mobile'][0] . '</div>';
        }
        if($didetails['dir_fax'][0] != NULL) {
          $orderedlist[$tag->slug][$posttitle] .= '<div class="fax">F: ' . $didetails['dir_fax'][0] . '</div>';
        }
        if($didetails['dir_email'][0] != NULL) {
          $orderedlist[$tag->slug][$posttitle] .= '<div class="email">' . $didetails['dir_email'][0] . '</div>';
        }
        if(($options === TRUE) && (isset($didetails['dir_address']) || isset($didetails['dir_city']) || isset($didetails['dir_zip']) || isset($didetails['dir_zip']))) {
          $orderedlist[$tag->slug][$posttitle] .= '<div class="adr">';
          if(isset($didetails['dir_address'])) {
            $orderedlist[$tag->slug][$posttitle] .= '<span class="street-address" style="display:inline-block;">' . $didetails['dir_address'][0] . '</span> ';
          }
          if(isset($didetails['dir_city'])) {
            $orderedlist[$tag->slug][$posttitle] .= '<span class="locality" style="display:inline-block;">' . $didetails['dir_city'][0] . '</span> ';
          }
          if(isset($didetails['dir_state'])) {
            $orderedlist[$tag->slug][$posttitle] .= '<span class="region" style="display:inline-block;">' . $didetails['dir_state'][0] . '</span> ';
          }
          if(isset($didetails['dir_zip'])) {
            $orderedlist[$tag->slug][$posttitle] .= '<span class="postal-code" style="display:inline-block;">' . $didetails['dir_zip'][0] . '</span> ';
          }
          $orderedlist[$tag->slug][$posttitle] .= '</div>';
        }
//tooltip
        $orderedlist[$tag->slug][$posttitle] .= '<div id="tooltip-' . $postid . '" class="directory-item-tooltip" style="display:none;">';
        $orderedlist[$tag->slug][$posttitle] .= '<h4 class="post-title business-name">' . get_the_title() . '</h4>';
        if(isset($didetails['dir_website'])) {
          $url = $didetails['dir_website'][0];
          if (!preg_match('/^http/', $url)) { $url = 'http://'.$url; }
          $orderedlist[$tag->slug][$posttitle] .= '<div class="url"><a class="url" href="' . $url . '" target="_blank">' . $didetails['dir_website'][0] . '</a></div>';
        }
        if($didetails['dir_phone'][0] != NULL) {
          $orderedlist[$tag->slug][$posttitle] .= '<div class="tel">P: ' . $didetails['dir_phone'][0] . '</div>';
        }
        if($didetails['dir_mobile'][0] != NULL) {
          $orderedlist[$tag->slug][$posttitle] .= '<div class="tel">C: ' . $didetails['dir_mobile'][0] . '</div>';
        }
        if($didetails['dir_fax'][0] != NULL) {
          $orderedlist[$tag->slug][$posttitle] .= '<div class="fax">F: ' . $didetails['dir_fax'][0] . '</div>';
        }
        if($didetails['dir_email'][0] != NULL) {
          $orderedlist[$tag->slug][$posttitle] .= '<div class="email">' . $didetails['dir_email'][0] . '</div>';
        }
        if(($didetails['dir_address'][0] != NULL) || ($didetails['dir_city'][0] != NULL) || ($didetails['dir_zip'][0] != NULL) || ($didetails['dir_zip'][0] != NULL)) {
          $orderedlist[$tag->slug][$posttitle] .= '<div class="adr">';
          if($didetails['dir_address'][0] != NULL) {
            $orderedlist[$tag->slug][$posttitle] .= '<span class="street-address" style="display:inline-block;">' . $didetails['dir_address'][0] . '</span> ';
          }
          if(isset($didetails['dir_city'][0]) && $didetails['dir_city'][0] != NULL) {
            $orderedlist[$tag->slug][$posttitle] .= '<span class="locality" style="display:inline-block;">' . $didetails['dir_city'][0] . '</span> ';
          }
          if(isset($didetails['dir_state'][0]) && $didetails['dir_state'][0] != NULL) {
            $orderedlist[$tag->slug][$posttitle] .= '<span class="region" style="display:inline-block;">' . $didetails['dir_state'][0] . '</span> ';
          }
          if(isset($didetails['dir_zip'][0]) &&$didetails['dir_zip'][0] != NULL) {
            $orderedlist[$tag->slug][$posttitle] .= '<span class="postal-code" style="display:inline-block;">' . $didetails['dir_zip'][0] . '</span> ';
          }
          $orderedlist[$tag->slug][$posttitle] .= '</div>';
        }
        $more = 1;
        $itemdesc = get_the_content();
        if($itemdesc) {
          $orderedlist[$tag->slug][$posttitle] .= '<div class="description">' . $itemdesc . '</div>';
        }
        $orderedlist[$tag->slug][$posttitle] .= '</div>';

//tooltip
        $orderedlist[$tag->slug][$posttitle] .= '</div><!-- end of #post-' . $postid . '-->';
      }
    endwhile;
    foreach (array_keys($orderedlist) as $group) {
          ksort($orderedlist[$group], SORT_STRING);
    }

  foreach ($orderedlist as $part) {
    if (count($part) > 2) {
      foreach ($part as $piece) {
        $output .= $piece;
      }
      $output .= '</div></div></div>';
      $nooutput = '<span class="clearfix"></span>';
    }
  }
  endif;
  wp_reset_postdata();

  if (is_null($search_term)) {
    if (isset($category)) {
      set_transient('expanding_dir_' . $category, $output);
    }
    else {
      set_transient('expanding_dir', $output);
    }
  }

  if ($directory_submission_received) {
    $output = '<div id="message" class="updated">Your directory submission has been received.</div> ' . $output;
  }

  if ($directory_feedback_received) {
    $output = '<div id="message" class="updated">Thank you! Your feedback has been received.</div> ' . $output;
  }

  if ($display_search) {
    $output = expandingdirectory_search_form() . $output;
  }

  if ($display_submit || $display_feedback) {
    $output .= '<div class="directory-forms">';
    if ($display_submit) {
      $output .= expandingdirectory_submission_form($category, $submittext);
    }

    if ($display_feedback) {
      $output .= expandingdirectory_feedback_form($category, $feedbacktext);
    }
    $output .= '</div>';
  }

  return $output;
}

add_shortcode('expdirectory', 'expandingdirectory_shortcode');

function expandingdirectory_search_form() {
  $output = '<div class="directory-search">';
  $output .= '<form method="get" >'; //action="http://' . $_SERVER["HTTP_HOST"] . $_SERVER["REDIRECT_URL"] . '">';
  $output .= '<input type="search" name="dir_search_term" value="' . get_query_var('dir_search_term', NULL) .'" />';
  $output .= '<input type="submit" value="Search" />';
  $output .= '</form>';
  $output .= '</div>';
  return $output;
}

function expandingdirectory_submission_form($category = NULL, $submittext = 'Submit a listing') {
  $output = '<div class="directory-section submit" style="max-width: 50%; min-width: 20em;">';
  $output .= '<div class="toggle collapsed" id="submit-listing-toggle" onClick="toggleDiv(\'submit-listing\')">' . $submittext . '</div>';
  $output .= '<div class="submit-wrapper" id="submit-listing-wrapper" style="height:0px; overflow:hidden">';
  $output .= '<div id="submit-listing">';
  $output .= '<div class="help"><p>Please complete and submit this form to be included in our directory.<br/>All submissions are reviewed before publishing.</p></div>';
  $output .= '<form method="post" action="" id="submission_form">';
  $output .= '<label for="dir_title_field">Business Name</label> ';
  $output .= '<input type="text" id="dir_title_field" name="dir_title_field" size="35" value="" />';
  $output .= '<label for="dir_body_field">About</label> ';
  $output .= '<textarea id="dir_body_field" name="dir_body_field" form="submission_form"></textarea>';
  ob_start();
  $new_listing = new stdClass();
  $new_listing->ID = -1;
  dir_website($new_listing);
  dir_phone($new_listing);
  dir_mobile($new_listing);
//  dir_fax($new_listing);
  dir_email($new_listing);
  dir_address($new_listing);
  dir_city($new_listing);
  dir_state($new_listing);
  dir_zip($new_listing);
  $output .= ob_get_contents();
  ob_end_clean();
  if (!is_null($category)) {
    if (!is_numeric($category)) {
      $cat = get_category_by_slug($category);
      $category = $cat->term_id;
    }
    $output .= '<input type="hidden" name="dir_category" value="' . $category . '">';
  }
  $output .= '<input type="submit" value="Submit" />';
  $output .= '</form>';
  $output .= '</div></div>';
  $output .= '</div>';
  return $output;
}

function expandingdirectory_feedback_form($category = NULL, $submittext = 'Submit a listing') {
  $output = '<div class="directory-section feedback" style="max-width: 50%; min-width: 20em;">';
  $output .= '<div class="toggle collapsed" id="feedback-toggle" onClick="toggleDiv(\'feedback\')">' . $submittext . '</div>';
  $output .= '<div class="feedback-wrapper" id="feedback-wrapper" style="height:0px; overflow:hidden">';
  $output .= '<div id="feedback">';
  $output .= '<div class="help"><p>Comments about or problem with a listing?<br/>Please let us know!</p></div>';
  $output .= '<form method="post" id="feedback_form">';
  $output .= wp_nonce_field( plugin_basename( __FILE__ ), 'dirfeedback_noncename' );
  $output .= '<input class="dir_feedback_type" type="radio" name="dir_feedback_type" value="comment" checked> Comment';
  $output .= ' <input class="dir_feedback_type" type="radio" name="dir_feedback_type" value="complaint"> Complaint<br/>';
  $output .= '<label for="dir_feedback_from">Your email address</label> <br/>';
  $output .= '<input type="email" id="dir_feedback_from" name="dir_email_field" size="35" value="" required/><br/>';
  $output .= '<label for="dir_feedback_field">Feedback</label> ';
  $output .= '<textarea id="dir_feedback_field" name="dir_feedback_field" form="feedback_form" required></textarea>';

  if (!is_null($category)) {
    if (is_numeric($category)) {
      $cat = get_the_category_by_ID($category);
      $category = $cat->slug;
    }
    $output .= '<input type="hidden" name="dir_feedback_category" value="' . $category . '">';
  }
  $output .= '<input type="submit" value="Submit" />';
  $output .= '</form>';
  $output .= '</div></div>';
  $output .= '</div>';
  return $output;
}

// add the admin options page
add_action('admin_menu', 'expandingdirectory_admin_add_page');


function expandingdirectory_admin_add_page() {
  add_options_page('Directory Item Defaults', 'Directory Item Defaults', 'manage_options', 'expanding-directory', 'expandingdirectory_options_page');
  add_submenu_page('edit.php?post_type=directory_item', 'Download Directory Items', 'Download Directory Items', 'manage_options', 'expanding-directory-download', 'expandingdirectory_download_page');
}

// display the admin options page
function expandingdirectory_options_page() {
  echo "<div>\n<h2>Expanding Directory</h2>\n";
  echo "<form action=\"options.php\" method=\"post\">\n";
  settings_fields('expand_dir_options');
  do_settings_sections('expand_dir');
  echo '<input name="Submit" type="submit" value="' . esc_attr('Save Changes') . '" />';
  echo "\n</form></div>";
}

// display the admin download page
function expandingdirectory_download_page() {

  echo "<div>\n<h2>Expanding Directory Export</h2>\n";
  echo "<form action=\"\" method=\"post\">\n";
  $cats = get_categories();

  echo "<b>Category: </b><select id='directory_category' name='directory_category'>\n";
  // foreach tag as Option
  $cats = get_categories();
  echo "  <option value='all'>- All -</option>\n";
  foreach ($cats as $cat) {
    echo "  <option value='".$cat->term_id."'>".$cat->name."</option>\n";
  }
  echo "</select>\n";

  echo "<b>Tag: </b><select id='directory_tag' name='directory_tag'>\n";
  // foreach tag as Option
  $tags = get_tags();
  echo "  <option value='all'>- All -</option>\n";
  foreach ($tags as $tag) {
    echo "  <option value='".$tag->term_id."'>".$tag->name."</option>\n";
  }
  echo "</select>\n";
  echo '<b>Field seperator: </b><input id="directory_seperator" name="directory_seperator" type="text" size="1" value=";">'."\n";

  $filename = get_bloginfo('name');
  $filename = preg_replace('/\s/', '_', strtolower($filename)."-directory_items");
  echo '<b>Filename: </b><input id="directory_filename" name="directory_filename" type="text" size="30" value="'.$filename.'">'."\n";
  echo '<input type="hidden" name="directory_download" value="download">'."\n";
  echo '<input name="Submit" type="submit" value="' . esc_attr('Download Now') . '" />'."\n";
  echo "\n</form></div>";
}

// add the admin settings and such
add_action('admin_init', 'expandingdirectory_admin_init');

function expandingdirectory_admin_init(){
  register_setting( 'expand_dir_options', 'expand_dir_options', 'expand_dir_options_validate' );
  add_settings_section('expand_dir_main', 'Defaults', 'expand_dir_section_text', 'expand_dir');
  add_settings_field('expand_dir_text_city', 'Default City', 'expand_dir_setting_city', 'expand_dir', 'expand_dir_main');
  add_settings_field('expand_dir_text_state', 'Default State', 'expand_dir_setting_state', 'expand_dir', 'expand_dir_main');
  add_settings_field('expand_dir_text_zip', 'Default Postal Code', 'expand_dir_setting_zip', 'expand_dir', 'expand_dir_main');
  add_settings_field('expand_dir_admin_email', 'Admin Notification Email Address', 'expand_dir_admin_email', 'expand_dir', 'expand_dir_main');
}

function expand_dir_section_text() {
  echo '<p>Defaults for Directory Items.</p>';
}

function expand_dir_setting_city() {
  $options = get_option('expand_dir_options');
  echo "<input id='expand_dir_text_city' name='expand_dir_options[expand_dir_text_city]' size='40' type='text' value='{$options['expand_dir_text_city']}' />";
}

function expand_dir_setting_state() {
  $options = get_option('expand_dir_options');
  echo "<input id='expand_dir_text_state' name='expand_dir_options[expand_dir_text_state]' size='20' type='text' value='{$options['expand_dir_text_state']}' />";
}

function expand_dir_setting_zip() {
  $options = get_option('expand_dir_options');
  echo "<input id='expand_dir_text_zip' name='expand_dir_options[expand_dir_text_zip]' size='10' type='text' value='{$options['expand_dir_text_zip']}' />";
}

function expand_dir_admin_email() {
  $options = get_option('expand_dir_options');
  $value = (NULL == $options['expand_dir_admin_email']) ? get_option('admin_email') : $options['expand_dir_admin_email'];
  echo "<input id='expand_dir_admin_email' name='expand_dir_options[expand_dir_admin_email]' size='30' type='text' value='{$value}' />";
}

function expand_dir_options_validate($input) {
  $options = get_option('expand_dir_options');

  $options['expand_dir_text_city'] = trim($input['expand_dir_text_city']);

  if(!preg_match('/^[a-z0-9\s-]{3,48}$/i', $options['expand_dir_text_city'])) {
    $options['expand_dir_text_city'] = '';
  }

  $options['expand_dir_text_state'] = trim($input['expand_dir_text_state']);
  if(!preg_match('/^[a-z0-9\s-]{2,32}$/i', $options['expand_dir_text_state'])) {
    $options['expand_dir_text_state'] = '';
  }

  $options['expand_dir_text_zip'] = trim($input['expand_dir_text_zip']);
  if(!preg_match('/^[a-z0-9-]{5,10}$/i', $options['expand_dir_text_zip'])) {
    $options['expand_dir_text_zip'] = '';
  }

  $options['expand_dir_admin_email'] = trim($input['expand_dir_admin_email']);
  if (!is_email($options['expand_dir_admin_email'])) {
    $options['expand_dir_admin_email'] = get_option('admin_email');
  }


  return $options;
}

class expanding_directory_export{

  private $separator;

  function __construct($category = null, $tag = null, $sep = ';', $filename = null){
    $this->separator = $sep;

    if (null == $filename) {
      $filename = strtolower(get_blog_info())."-directory_items";
      $filename = preg_replace('/\s/', '_', $filename);
    }

    $generatedDate = date('d-m-Y_His');

    $csvFile = $this->generate_csv($category, $tag);
    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: private", false);
    header("Content-Type: application/octet-stream");
    header("Content-Disposition: attachment; filename=\"" . $filename . "-" . $generatedDate . ".csv\";" );
    header("Content-Transfer-Encoding: binary");

    echo $csvFile;
    exit;
  }

  function generate_csv($category = null, $tag = null){
    $dirArgs = array();
    $dirArgs['post_type'] = 'directory_item';

    if (!is_null($category) && $category != 'all') {
      if (is_numeric($category)) {
        $dirArgs['cat'] = $category;
      }
      else {
        $dirArgs['category_name'] = $category;
      }
    }

    if (!is_null($tag) && $tag != 'all') {
      if (is_numeric($tag)) {
        $dirArgs['tag_id'] = $tag;
      }
      else {
        $dirArgs['tag'] = $tag;
      }
    }

    $dirArgs['posts_per_page'] = '-1';
    $dirArgs['orderby'] = 'title';
    $dirArgs['order'] = 'ASC';

    $dirQuery = new wp_Query($dirArgs);

    $sep = $this->separator;
    $output = 'ID'.$sep.'Business Name'.$sep.'Website'.$sep.'Phone'.$sep.'Mobile'.$sep.'Fax'.$sep.'Email'.$sep.'Street'.$sep.'City'.$sep.'State'.$sep.'Zip'.$sep.'Tags'."\r\n";

    if ($dirQuery->have_posts()) :
      while ($dirQuery->have_posts()) : $dirQuery->the_post();
        $postid = get_the_ID();
        $posttitle = preg_replace('/^\*/', '1 ', get_the_title());
        $didetails = get_post_meta($postid);
        $tags = wp_get_post_tags($postid);

        $url = (isset($didetails['dir_website'])) ? $didetails['dir_website'][0] : '';
        if (!preg_match('/^http/', $url)) {
          $url = 'http://'.$url; 
        }

        $phone = (isset($didetails['dir_phone'][0])) ? $didetails['dir_phone'][0] : '';
        $mobile = (isset($didetails['dir_mobile'][0])) ? $didetails['dir_mobile'][0] : '';
        $fax = (isset($didetails['dir_fax'][0])) ? $didetails['dir_fax'][0] : '';
        $email = (isset($didetails['dir_email'][0])) ? $didetails['dir_email'][0] : '';
        $address = (isset($didetails['dir_address'][0])) ? $didetails['dir_address'][0] : '';
        $city = (isset($didetails['dir_city'][0])) ? $didetails['dir_city'][0] : '';
        $state = (isset($didetails['dir_state'][0])) ? $didetails['dir_state'][0] : '';
        $zip = (isset($didetails['dir_zip'][0])) ? $didetails['dir_zip'][0] : '';

        $export_tags = '';
        foreach ($tags as $tag) {
          $export_tags .= $tag->name . ', ';
        }
        $export_tags = rtrim(',', rtrim($export_tags));

        $output .= $postid . $sep . 
          '"' . get_the_title() . '"' . $sep .
          '"' . $url . '"' . $sep .
          '"' . $phone . '"' . $sep .
          '"' . $mobile . '"' . $sep .
          '"' . $fax . '"' . $sep .
          '"' . $email . '"' . $sep .
          '"' . $address . '"' . $sep .
          '"' . $city . '"' . $sep .
          '"' . $state . '"' . $sep .
          '"' . $zip . '"' . $sep .
          '"' . $export_tags . '"' . "\r\n";

      endwhile;
    endif;
    wp_reset_postdata();
    return $output;
  }
}

add_action('init', 'export_directory_items');
function export_directory_items() {
  if(isset($_POST['directory_download']) && $_POST['directory_download'] == 'download'){
    $exportCSV = new expanding_directory_export($_POST['directory_category'], $_POST['directory_tag'], $_POST['directory_seperator'], $_POST['directory_filename']);
  }
}
?>