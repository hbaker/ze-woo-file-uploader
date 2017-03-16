<?php
if ( ! defined( 'ABSPATH' ) ) { 
    exit; // Exit if accessed directly
}
/**
 * Plugin Name:     Ze Woo File Uploader
 * Plugin URI:      
 * Description:     A file upload plugin for WooCommerce
 * Author:          Hosea Baker
 * Author URI:      https://hoseabaker.com
 * Text Domain:     ze-woo-file-uploader
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Ze_Woo_File_Uploader
 */

// CHECK IF WOOCOMMERCE IS ACTIVE
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

    /**
     * Adds a custom order action in the "Recent Orders" table of the WooCommerce account
     *   if a download ID is entered as a "ze_woo_download_id" order custom field
     * Button downloads custom files for the order
     * Requires Download Monitor
     *
     * @param array $actions the actions available for the order
     * @param \WC_Order $order the order object for this row
     * @return array the updated order actions
     */
    function ze_woo_add_custom_download_action( $actions, $order ) {
  
  // add our action if the order has the ze_woo_download_id field set
  if ( $file_id = get_post_meta( $order->id, 'ze_woo_custom_file_upload', true ) ) {
    $actions['files'] = array(
      'url' => trailingslashit( get_site_url() ) . $file_id,
      'name'  => __( 'Download Ready', 'ze-woo-file-uploader' ),
    );
  }
  
  return $actions;

}

add_filter( 'woocommerce_my_account_my_orders_actions', 'ze_woo_add_custom_download_action', 10, 2 );

}
// END CHECK IF WOOCOMMERCE IS ACTIVE