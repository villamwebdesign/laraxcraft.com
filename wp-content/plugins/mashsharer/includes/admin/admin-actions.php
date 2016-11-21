<?php
/**
 * Admin Actions
 *
 * @package     MASHSB
 * @subpackage  Admin/Actions
 * @copyright   Copyright (c) 2014, René Hermenau
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Processes all MASHSB actions sent via POST and GET by looking for the 'mashsb-action'
 * request and running do_action() to call the function
 *
 * @since 1.0
 * @return void
 */
function mashsb_process_actions() {
	if ( isset( $_POST['mashsb-action'] ) ) {
		do_action( 'mashsb_' . $_POST['mashsb-action'], $_POST );
	}

	if ( isset( $_GET['mashsb-action'] ) ) {
		do_action( 'mashsb_' . $_GET['mashsb-action'], $_GET );
	}
}
add_action( 'admin_init', 'mashsb_process_actions' );

/**
 * Arrange order of social network array when it is draged and droped
 * 
 * @global array $mashsb_options
 */
function mashsb_save_order(){
        global $mashsb_options;
        // Get all settings
        
        $current_list = get_option('mashsb_networks');
        $new_order = $_POST['mashsb_list'];
        $new_list = array();
        
        /* First write the sort order */
        foreach ($new_order as $n){
            if (isset($current_list[$n])){
                $new_list[$n] = $current_list[$n];
                
            }
        }
        /* Update sort order of networks */
        update_option('mashsb_networks', $new_list);
        die();
}
add_action ('wp_ajax_mashsb_update_order', 'mashsb_save_order');

/**
 * Force Facebook to rescrape site content after saving post
 * 
 * @todo check if blocking=>false is working as expected
 * @global array $post
 */
function mashsb_rescrape_fb_debugger(){
    global $post;
    if (!isset($post)){
        return;
    }
    $url = get_permalink($post->ID);
    $args = array('timeout' => 5, 'blocking' => false);
    $body = wp_remote_retrieve_body( wp_remote_get('https://graph.facebook.com/?id=' . $url, $args) );
}
add_action('save_post', 'mashsb_rescrape_fb_debugger' );

/**
 * Purge the MashShare Cache
 * 
 * @global array $post
 * @return bool false
 */
function mashsb_purge_cache(){
    global $post;
    
    if (!isset($post)){
        return;
    }
    
    update_post_meta($post->ID, 'mashsb_timestamp', '');
}
add_action('save_post', 'mashsb_purge_cache' );

/**
 * Create bitly or google shorturls and store them initially in post meta
 * 
 * @global array $post
 * @return string
 * 
 * @deprecated since 3.1.2
 */
//function mashsb_create_shorturls() {
//    global $mashsb_options, $post;
//    
//    if (!isset($post)){
//        return;
//    }
//
//    $shorturl = "";
//    $url = get_permalink($post->ID);
//
//    // bitly shortlink
//    if( isset( $mashsb_options['mashsu_methods'] ) && $mashsb_options['mashsu_methods'] === 'bitly' ) {
//        $shorturl = mashsb_get_bitly_link( $url );
//    }
//
//    // Google shortlink
//    if( isset( $mashsb_options['mashsu_methods'] ) && $mashsb_options['mashsu_methods'] === 'google' ) {
//        $shorturl = mashsb_get_google_link( $url );
//    }
//    if (!empty($shorturl)){
//    update_post_meta( $post->ID, 'mashsb_shorturl', $shorturl );
//    }
//}
