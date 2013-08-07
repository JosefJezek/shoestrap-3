<?php

function shoestrap_nav_class_pull() {
  if ( shoestrap_getVariable( 'navbar_nav_right' ) == '1' ) {
    $ul = 'nav navbar-nav pull-right';
  } else {
    $ul = 'nav navbar-nav';
  }
  return $ul;
}

/*
 * The template for the primary navbar searchbox
 */
function shoestrap_navbar_pre_searchbox() {
  if ( shoestrap_getVariable( 'navbar_nav_right' ) == '1' ) {
    $show_searchbox = shoestrap_getVariable( 'navbar_search' );
    if ( $show_searchbox == '1' ) { ?>
      <form role="search" method="get" id="searchform" class="form-search pull-right navbar-form" action="<?php echo home_url('/'); ?>">
        <label class="hide" for="s"><?php _e('Search for:', 'roots'); ?></label>
        <input type="text" value="<?php if (is_search()) { echo get_search_query(); } ?>" name="s" id="s" class="form-control search-query" placeholder="<?php _e('Search', 'roots'); ?> <?php bloginfo('name'); ?>">
      </form>
      <?php
    }
  }
}
add_action( 'shoestrap_pre_main_nav', 'shoestrap_navbar_pre_searchbox', 11 );




/*
 * The template for the primary navbar searchbox
 */
function shoestrap_navbar_post_searchbox() {
  if ( shoestrap_getVariable( 'navbar_nav_right' ) != '1' ) {
    $show_searchbox = shoestrap_getVariable( 'navbar_search' );
    if ( $show_searchbox == '1' ) { ?>
      <ul class="pull-right nav nav-collapse clearfix"><li>
      <?php do_action('shoestrap_pre_searchform'); ?>
      <form role="search" method="get" id="searchform" class="form-search navbar-search" action="<?php echo home_url('/'); ?>">
        <label class="hide" for="s"><?php _e('Search for:', 'shoestrap'); ?></label>
        <input type="text" value="<?php if (is_search()) { echo get_search_query(); } ?>" name="s" id="s" class="search-query" placeholder="<?php _e('Search', 'shoestrap'); ?> <?php bloginfo('name'); ?>">
      </form>
      <?php do_action('shoestrap_after_searchform'); ?>
      </li></ul>
      <?php
    }
  }
}
add_action( 'shoestrap_post_main_nav', 'shoestrap_navbar_post_searchbox', 11 );

function shoestrap_navbar_class( $navbar = 'main') {
  $fixed    = shoestrap_getVariable( 'navbar_fixed' );
  $fixedpos = shoestrap_getVariable( 'navbar_fixed_position' );
  $style    = shoestrap_getVariable( 'navbar_style' );

  if ( $fixed != 1 ) {
    $class = 'navbar navbar-static-top';
  } else {
    if ( $fixedpos == 1 )
      $class = 'navbar navbar-fixed-bottom';
    else
      $class = 'navbar navbar-fixed-top';
  }

  if ( $navbar != 'secondary' )
    return $class . ' ' . $style;
  else
    return 'navbar ' . $style;
}

function shoestrap_navbar_css() {
  $opacity = (intval(shoestrap_getVariable( 'navbar_bg_opacity' )))/100;
  $style = "";

  if ( ($opacity != 1 && $opacity != "") || (shoestrap_getVariable( 'navbar_margin_bottom' ) != 0) ) {
    $bg = shoestrap_getVariable( 'navbar_bg');
    $rgb = shoestrap_get_rgb($bg, true);
      $style .= '.navbar{';
        if ($opacity != 1 && $opacity != "") {
          $style .= 'background: rgb('.$rgb.');';
          $style .= 'background: rgba('.$rgb.', '.$opacity.');';
        } else {
          $style .= 'background: '.$bg.';';
        }
        if ( shoestrap_getVariable( 'navbar_margin_bottom' ) != 0 ) {
          $style .= 'margin-bottom:'. shoestrap_getVariable( 'navbar_margin_bottom' ) .'px !important;';
        }
      $style .= '}';
  }

  if ( shoestrap_getVariable( 'logo_top_margin' ) != 1 ) {
  	$style .= '.navbar a.navbar-brand.logo {margin-top:' . shoestrap_getVariable( 'logo_top_margin' ) . 'px; }';
  }

  wp_add_inline_style( 'shoestrap_css', $style );

}
add_action( 'wp_enqueue_scripts', 'shoestrap_navbar_css', 101 );
