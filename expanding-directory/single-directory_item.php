<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Single Posts Template
 *
 * @file           single-directory_item.php
 * @copyright      2013 Nels Noseworthy
 * @license        license.txt
 * @version        Release: 1.0
 * @filesource     wp-content/themes/responsive/single.php
 * @link           http://codex.wordpress.org/Theme_Development#Single_Post_.28single.php.29
 */
?>
<?php get_header(); ?>
<div id="content" class="grid col-740">
<?php if (have_posts()) : ?>
    
  <?php while (have_posts()) : the_post();
    $didetails = get_post_meta($post->ID);
    $current = get_the_ID(); ?>
    <div id="post-<?php the_ID(); ?>" <?php post_class('vcard'); ?>>
        <h1 class="post-title fn org"><?php if (get_field('display_title')) { the_field('display_title'); } else { the_title(); } ?></h1>
      <?php if(isset($didetails['dir_website'])) { ?>
        <div class="url"><a class="url" href="<?php print $didetails['dir_website'][0] ?>"><?php print $didetails['dir_website'][0] ?></a></div>
      <?php } ?>
      <?php if(isset($didetails['dir_phone'])) { ?>
        <div class="tel"><?php print $didetails['dir_phone'][0] ?></div>
      <?php } ?>
      <?php if(isset($didetails['dir_email'])) { ?>
        <div class="email"><?php print $didetails['dir_email'][0] ?></div>
      <?php } ?>
      <?php if(isset($didetails['dir_address']) || isset($didetails['dir_city']) || isset($didetails['dir_zip'])) { ?>
        <dir class="adr">
        <?php if(isset($didetails['dir_address'])) { ?>
          <span class="street-address"><?php print $didetails['dir_address'][0] ?></span>
        <?php } ?>
        <?php if(isset($didetails['dir_city'])) { ?>
          <span class="locality"><?php print $didetails['dir_city'][0] ?></span>
        <?php } ?>
        <?php if(isset($didetails['dir_zip'])) { ?>
          <span class="postal-code"><?php print $didetails['dir_zip'][0] ?></div>
        <?php } ?>
        </div>
      <?php } ?>
      <div class="post-entry">
        <?php the_content(__('Read more &#8250;', 'responsive')); ?>
                    
        <?php wp_link_pages(array('before' => '<div class="pagination">' . __('Pages:', 'responsive'), 'after' => '</div>')); ?>
      </div><!-- end of .post-entry -->
                
      <?php /*                 
      <div class="post-data">
      <?php the_tags(__('Tagged with:', 'responsive') . ' ', ', ', '<br />'); ?> 
      <?php printf(__('Posted in %s', 'responsive'), get_the_category_list(', ')); ?> 
      </div><!-- end of .post-data --> 
      */ ?>

      <div class="post-edit"><?php edit_post_link(__('Edit', 'responsive')); ?></div>             
    </div><!-- end of #post-<?php the_ID(); ?> -->
            
  <?php endwhile; ?> 

</div><!-- end of #content -->
<?php get_sidebar(); ?>
<?php else : ?>

        <h1 class="title-404"><?php _e('404 &#8212; Fancy meeting you here!', 'responsive'); ?></h1>
        <p><?php _e('Don&#39;t panic, we&#39;ll get through this together. Let&#39;s explore our options here.', 'responsive'); ?></p>
        <h6><?php _e( 'You can return', 'responsive' ); ?> <a href="<?php echo home_url(); ?>/" title="<?php esc_attr_e( 'Home', 'responsive' ); ?>"><?php _e( '&larr; Home', 'responsive' ); ?></a> <?php _e( 'or search for the page you were looking for', 'responsive' ); ?></h6>
        <?php get_search_form(); ?>

        </div><!-- end of #content -->
<?php endif; ?>  
      
<?php get_footer(); ?>