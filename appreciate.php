<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://developerravi.com/
 * @since             1.0.0
 * @package           Appreciate
 *
 * @wordpress-plugin
 * Plugin Name:       Appreciate
 * Plugin URI:        https://codepixelzmedia.com/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Ravi Khadka
 * Author URI:        https://developerravi.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       appreciate
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'appreciate_version', '1.0.0' );
define( 'APPRECIATE', 'appreciate' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-appreciate-activator.php
 */
function activate_appreciate() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-appreciate-activator.php';
	Appreciate_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-appreciate-deactivator.php
 */
function deactivate_appreciate() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-appreciate-deactivator.php';
	Appreciate_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_appreciate' );
register_deactivation_hook( __FILE__, 'deactivate_appreciate' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-appreciate.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_appreciate() {

	$plugin = new Appreciate();
	$plugin->run();

}
run_appreciate();

/* total upvote/downvote */
if ( ! function_exists( 'appreciate_total_vote' ) ) :
	function appreciate_total_vote( $appreciate_current_pid ) {
		// get all upvote
		$appreciate_vote_keys = array( 'appreciate_upvote', 'appreciate_downvote' );

		foreach ( $appreciate_vote_keys as $appreciate_vote_key ) {
			$appreciate_count_vote = get_users(
				array(
					'meta_query' => array(
						array(
							'key'   => $appreciate_vote_key,
							'value' => $appreciate_current_pid,
						),
					),
				)
			);
			if ( $appreciate_vote_key == 'appreciate_upvote' ) {
				$appreciate_total_upvote = count( $appreciate_count_vote );
			}
			if ( $appreciate_vote_key == 'appreciate_downvote' ) {
				$appreciate_total_downvote = count( $appreciate_count_vote );
			}
		}

		$appreciate_final_vote = $appreciate_total_upvote - $appreciate_total_downvote;

		return intval( $appreciate_final_vote );
	}
endif;

/* vote status */
if ( ! function_exists( 'appreciate_vote_status' ) ) :
	function appreciate_vote_status( $pid, $cuid ) {

		$appreciate_vote_keys          = array( 'appreciate_upvote', 'appreciate_downvote' );
		$get_appreciate_upvote         = esc_attr(get_user_meta( $cuid, 'appreciate_upvote', false ),'APPRECIATE');
		$get_appreciate_downvote       = esc_attr(get_user_meta( $cuid, 'appreciate_downvote', false ),'APPRECIATE');
		$appreciate_check_upvote_pid   = $get_appreciate_upvote;
		$appreciate_check_downvote_pid = $get_appreciate_downvote;
		$appreciate_vote_status        = __('none','APPRECIATE');
if ( is_array( $appreciate_check_upvote_pid ) ) {
		if ( in_array( $pid, $appreciate_check_upvote_pid ) ) {
			$appreciate_vote_status = 'appreciate_upvote';
		}
	}
	if ( is_array( $appreciate_check_downvote_pid ) ) {
		if ( in_array( $pid, $appreciate_check_downvote_pid ) ) {
			$appreciate_vote_status = 'appreciate_downvote';
		}
	}
		return esc_html__($appreciate_vote_status,'APPRECIATE');
	

	}
endif;
/* check my vote */
if ( ! function_exists( 'appreciate_my_vote' ) ) :
	function appreciate_my_vote( $pid, $cuid, $appreciate_get_vote_type ) {
		$appreciate_vote_status = appreciate_vote_status( $pid, $cuid );
		$appreciate_get_votes   = get_users(
			array(
				'meta_query' => array(
					array(
						'key'   => $appreciate_get_vote_type,
						'value' => $pid,
					),
				),
			)
		);
		$appreciate_uids        = [];
		foreach ( $appreciate_get_votes as $appreciate_get_vote ) {
			$appreciate_uids[] = $appreciate_get_vote->ID;
		}

		if ( in_array( $cuid, $appreciate_uids ) ) {
			$appreciate_total_votes = appreciate_total_vote( $pid );
			delete_user_meta( $cuid, $appreciate_get_vote_type, $pid );
			if( $appreciate_vote_status !== $appreciate_get_vote_type ) {
				delete_user_meta( $cuid, $appreciate_vote_status, $pid );
			
			}
			if ( $appreciate_vote_status == $appreciate_get_vote_type ) {
				
				delete_user_meta( $cuid, $appreciate_get_vote_type, $pid );
			}
	
		}
		 else {
			add_user_meta( $cuid, $appreciate_get_vote_type, $pid, false );

			if( $appreciate_vote_status !== $appreciate_get_vote_type ) {
				delete_user_meta( $cuid, $appreciate_vote_status, $pid );
		
			}

		}
		return $appreciate_total_votes;
	}
endif;


//display__voting
function cspd_after_post_content($content){
    if (is_single()) {  
        $content .= do_shortcode("[display__voting]");
    }
    return $content;
}
add_filter( "the_content", "cspd_after_post_content" );