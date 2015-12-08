<?php
/**
 * SVGenericons
 *
 * This feature will only be activated for themes that declare their support.
 * This can be done by adding code similar to the following during the
 * 'after_setup_theme' action:
 *
 * add_theme_support( 'jetpack-svgenericons' );
 */

/**
 * Activate the SVGenericons plugin.
 *
 * @uses current_theme_supports()
 */
function jetpack_svgenericons_init() {
	// Only load our code if our theme declares support
	if ( ! current_theme_supports( 'jetpack-svgenericons' ) ) {
		return;
	}
	add_action( 'wp_enqueue_scripts', 'jetpack_svgenericons_styles' );
}
add_action( 'after_setup_theme', 'jetpack_svgenericons_init', 99 );

/* Enqueue our CSS */
function jetpack_svgenericons_styles() {
	wp_enqueue_style( 'jetpack-svgenericons', plugins_url( 'svgenericons/svgenericons.css', __FILE__ ), array(), '1.0' );
}

/*
 * Inject our SVG sprite at the bottom of the page
 *
 * There is a possibility that this will cause issues with
 * older versions of Chrome. In which case, it may be
 * necessary to inject just after the </head> tag.
 * See: https://code.google.com/p/chromium/issues/detail?id=349175
 */
function jetpack_svgenericons_inject_sprite() {
	 $file_path = $dir = plugin_dir_path( __FILE__ );
	 include_once( $file_path .'svgenericons/svgenericons.svg' );
}
add_filter( 'wp_footer' , 'jetpack_svgenericons_inject_sprite' );

/*
 * Inject some header code to make IE play nice.
 *
 * This seems to do the trick, but may require more testing.
 * Also may not be something theme authors necessarily want
 * or need added to their headers, so we'll see.
 * See: https://github.com/jonathantneal/svg4everybody
 */
 function jetpack_svgenericons_ie_shim() {
	 echo '<meta http-equiv="x-ua-compatible" content="ie=edge">';
 }
 add_filter( 'wp_head' , 'jetpack_svgenericons_ie_shim' );

/*
 * This allows for easy injection of SVG references inline.
 * Usage: jetpack_svgenericon( 'name-of-icon' );
 */
 function jetpack_svgenericon( $name ) { ?>
	 <svg class="svgenericon">
		 <use xlink:href="#svgenericon-<?php echo $name; ?>" />
	 </svg>
 <?php }
