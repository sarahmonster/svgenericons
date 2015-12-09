<?php
/**
 * Social Menu.
 *
 * This feature will only be activated for themes that declare their support.
 * This can be done by adding code similar to the following during the
 * 'after_setup_theme' action:
 *
 * add_theme_support( 'social-menu' );
 */

/**
 * Activate the Social Menu plugin.
 *
 * @uses current_theme_supports()
 */
function jetpack_social_menu_init() {
	// Only load our code if our theme declares support
	if ( ! current_theme_supports( 'jetpack-social-menu' ) ) {
		return;
	}

	/*
	 * Social Menu description.
	 *
	 * Rename the social menu description.
	 *
	 * @module theme-tools
	 */
	$social_menu_description = apply_filters( 'jetpack_social_menu_description', __( 'Jetpack Social Menu', 'jetpack' ) );

	// Register a new menu location
	register_nav_menus( array(
		'jetpack-social-menu' => esc_html( $social_menu_description ),
	) );

	// Enqueue CSS
	add_action( 'wp_enqueue_scripts', 'jetpack_social_menu_script' );
}
add_action( 'after_setup_theme', 'jetpack_social_menu_init', 99 );

/* Function to enqueue CSS */
function jetpack_social_menu_script() {
	// If we're using the new svgenericons, we'll need a slightly different CSS file
	if ( current_theme_supports( 'jetpack-svgenericons' ) ) :
		wp_enqueue_style( 'jetpack-social-menu-svgenericons', plugins_url( 'social-menu-svgenericons.css', __FILE__ ), array(), '1.0' );
	// Otherwise, enqueue our standard CSS, and old-style genericons
	else:
		wp_enqueue_style( 'jetpack-social-menu', plugins_url( 'social-menu.css', __FILE__ ), array( 'genericons' ), '1.0' );
	endif;
}

/* Create the function */
function jetpack_social_menu() {
	if ( has_nav_menu( 'jetpack-social-menu' ) ) : ?>
		<nav class="jetpack-social-navigation" role="navigation">
			<?php
			if ( current_theme_supports( 'jetpack-svgenericons' ) ) :
				$args = array(
					'theme_location'  => 'jetpack-social-menu',
					'link_before'     => '',
					'link_after'      => '',
					'depth'           => 1,
				);
				else :
					$args = array(
						'theme_location'  => 'jetpack-social-menu',
						'link_before'     => '<span class="screen-reader-text">',
						'link_after'      => '</span>',
						'depth'           => 1,
					);
				endif;
				wp_nav_menu( $args );
			?>
		</nav><!-- .jetpack-social-navigation -->
	<?php endif;
}

/*
 * We're going to need a custom walker to make SVG
 * work in a way that makes sense. Ready, steady, go!
 */
function jetpack_social_svgenericons_menu( $items ) {
	if ( current_theme_supports( 'jetpack-svgenericons' ) ) :
	 	foreach ( $items as $item ) :
	 		$subject = $item->url;
			$feed_pattern = '/\/feed\/?/i';
			$mail_pattern = '/mailto/i';
			$skype_pattern = '/skype/i';
	 		$domain_pattern = '/([a-z]*)(\.com|\.org|\.io|\.tv|\.co)/i';
			$domains = array( 'codepen', 'digg', 'dribbble', 'dropbox', 'facebook', 'flickr', 'foursquare', 'github', 'plus.google', 'instagram', 'linkedin', 'path', 'pinterest', 'getpocket', 'polldaddy', 'reddit', 'spotify', 'stumbleupon', 'tumblr', 'twitch', 'twitter', 'vimeo', 'vine', 'wordpress', 'youtube' );
			// Match feed URLs
			if ( preg_match( $feed_pattern, $subject, $matches ) ) :
	 			$icon = get_jetpack_svgenericon( 'feed' );
			// Match a mailto link
			elseif ( preg_match( $mail_pattern, $subject, $matches ) ) :
	 			$icon = get_jetpack_svgenericon( 'mail' );
			// Match a Skype link
			elseif ( preg_match( $skype_pattern, $subject, $matches ) ) :
	 			$icon = get_jetpack_svgenericon( 'skype' );
			// Match various domains
	 		elseif ( preg_match( $domain_pattern, $subject, $matches ) && in_array( $matches[1], $domains ) ) :
	 			$icon = get_jetpack_svgenericon( $matches[1] );
			// Fall back to our default share icon
			else :
				$icon = get_jetpack_svgenericon( 'share' );
	 		endif;
			$item->title = $icon . '<span class="screen-reader-text">' . $item->title . '</span>';
	 	endforeach;
	endif;
	return $items;
 }
add_filter( 'wp_nav_menu_objects', 'jetpack_social_svgenericons_menu' );
