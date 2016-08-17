<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Archive Template
 *
 *
 * @file           archive.php
 * @package        Responsive 
 * @author         Emil Uzelac 
 * @copyright      2003 - 2013 ThemeID
 * @license        license.txt
 * @version        Release: 1.1
 * @filesource     wp-content/themes/responsive/archive.php
 * @link           http://codex.wordpress.org/Theme_Development#Archive_.28archive.php.29
 * @since          available since Release 1.0
 */
?>
<?php get_header(); ?>

  <div id="directory" class="grid col-740">

    <?php if (have_posts()) : ?>
	  <h1>Directory</h1>
      <?php 
      $tags = wp_tag_cloud(array('format' => 'array' , 'number' => 0));
      $orderedlist = array();
      foreach ($tags as $tag) {
        $tag = strip_tags($tag);
        $orderedlist[$tag][0] = '';
      }
      while (have_posts()) : the_post(); 
        $postid = get_the_ID();
        $posttitle = get_the_title();
        $didetails = get_post_meta($postid);
        $tags = wp_get_post_tags($postid);
        $output = '';
        foreach ($tags as $tag) {
          if(!isset($orderedlist[$tag->name][1])) {
            $orderedlist[$tag->name][1] = '<span class="toggle collapsed" onclick="toggleDiv(\'' . $tag->slug . '\')" id="' . $tag->slug . '-toggle">' . $tag->name . '</span>';
            $orderedlist[$tag->name][1] = '<div id="' . $tag->slug . '-wrapper" class="directory-wrapper" style="height:0px; overflow:hidden;">';
            $orderedlist[$tag->name][1] = '<div id="' . $tag->slug . '" style="float:left;">';
          }
          $orderedlist[$tag->name][$posttitle] = '<div id="post-' . $postid . '" class="';
          $classes = get_post_class('vcard');
          foreach ($classes as $class) {
            $orderedlist[$tag->name][$posttitle] = $class . ' ';
          }
          $orderedlist[$tag->name][$posttitle] = '">';
          $orderedlist[$tag->name][$posttitle] = '<h4 class="post-title business-name">' . get_the_title() . '</h4>';
          if(isset($didetails['dir_website'])) {
            $url = $didetails['dir_website'][0];
            if (!preg_match('/^http/', $url)) { $url = 'http://'.$url; }
            $orderedlist[$tag->name][$posttitle] = '<div class="url"><a class="url" href="' . $url . '" target="_blank">' . $didetails['dir_website'][0] . '</a></div>';
          }
          if(isset($didetails['dir_phone'])) {
            $orderedlist[$tag->name][$posttitle] = '<div class="tel">' . $didetails['dir_phone'][0] . '</div>';
          }
          if(isset($didetails['dir_mobile'])) {
            $orderedlist[$tag->name][$posttitle] = '<div class="tel">' . $didetails['dir_mobile'][0] . '</div>';
          }
          if(isset($didetails['dir_fax'])) {
            $orderedlist[$tag->name][$posttitle] = '<div class="fax">' . $didetails['dir_fax'][0] . '</div>';
          }
          if(isset($didetails['dir_email'])) {
            $orderedlist[$tag->name][$posttitle] = '<div class="email">' . $didetails['dir_email'][0] . '</div>';
          }
          if(isset($didetails['dir_address']) || isset($didetails['dir_city']) || isset($didetails['dir_zip']) || isset($didetails['dir_zip'])) {
            $orderedlist[$tag->name][$posttitle] = '<div class="adr">';
            if(isset($didetails['dir_address'])) { 
              $orderedlist[$tag->name][$posttitle] = '<span class="street-address" style="display:inline-block;">' . $didetails['dir_address'][0] . '</span> ';
            }
            if(isset($didetails['dir_city'])) {
              $orderedlist[$tag->name][$posttitle] = '<span class="locality" style="display:inline-block;">' . $didetails['dir_city'][0] . '</span> ';
            }
            if(isset($didetails['dir_state'])) {
              $orderedlist[$tag->name][$posttitle] = '<span class="region" style="display:inline-block;">' . $didetails['dir_state'][0] . '</span> ';
            }
            if(isset($didetails['dir_zip'])) {
              $orderedlist[$tag->name][$posttitle] = '<span class="postal-code" style="display:inline-block;">' . $didetails['dir_zip'][0] . '</span> ';
            }
            $orderedlist[$tag->name][$posttitle] = '</div>';
          }

          $orderedlist[$tag->name][$posttitle] = '</div><!-- end of #post-' . $postid . '-->';
        }

        foreach (array_keys($orderedlist) as $group) {
          ksort($orderedlist[$group]);
        }
        foreach ($orderedlist as $part) {
          if (isset($part[1])) {
            foreach ($part as $piece) {
              $output .= $piece;
            }
            $output .= '</div></div>';
            $output .= '<span class="clearfix"></span>';
          }
        }
      endwhile;
      echo $output;
      wp_reset_query(); ?>
      
  <?php else : ?>

    <h1 class="title-404">404 &#8212; Fancy meeting you here!'</h1>
    <p>Sorry, no directory items have been added yet</p>
    <?php get_search_form(); ?>

  <?php endif; ?>  
      
  </div><!-- end of #content-archive -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>