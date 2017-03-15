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

}
// END CHECK IF WOOCOMMERCE IS ACTIVE