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
      // define the woocommerce_my_account_my_orders_actions callback 

      // BEGIN ORDER LIST CUSTOM DOWNLOAD BUTTON DISPLAY
      // BEGIN ORDER LIST CUSTOM DOWNLOAD BUTTON DISPLAY
      function ze_woo_add_custom_download_list_links( $actions, $order ) {
        // only add our button if the order is paid for
        // if using WC 2.5+, can simplify this to: if ( ! $order->is_paid() )
        if ( ! ( $order->has_status( 'processing' ) || $order->has_status( 'completed' ) ) ) {
          return $actions;
        }
        
        // add our action if the order has the custom_file field set
        if ( $file_id = get_post_meta( $order->id, 'ze_woo_custom_file_upload', true ) ) {
          
          $zfile        = get_field('ze_woo_custom_file_upload', $order->id);
          $zurl        = $zfile['url'];

          $actions['files'] = array(
            'url' => $zurl,
            'name'  => __( 'Download File(s)', 'ze-woo-file-uploader' ),
          );
        }
        
        return $actions;
      }
      add_filter( 'woocommerce_my_account_my_orders_actions', 'ze_woo_add_custom_download_list_links', 10, 2 );
      // END ORDER LIST CUSTOM DOWNLOAD BUTTON DISPLAY
      // END ORDER LIST CUSTOM DOWNLOAD BUTTON DISPLAY

      // BEGIN ORDER DETAIL CUSTOM DOWNLOAD LINK DISPLAY
      // BEGIN ORDER DETAIL CUSTOM DOWNLOAD LINK DISPLAY
      add_action ('woocommerce_order_details_after_order_table', 'ze_woo_add_custom_download', 20);
    
        function ze_woo_add_custom_download( $order ) {
        
        // OPTIONAL: ONLY DISPLAY THE DOWNLOAD LINK IF THE ORDER STATUS IS COMPLETE
        // UNCOMMENT THIS CODE TO MIRROR ORDER STATUS
        // if ( ! $order->is_paid() ) {
        // return;
        // }

        if (get_field('ze_woo_custom_file_upload', $order->id)) { // Only show if field is filled
       
        ?>

          <?php 

          $zfile        = get_field('ze_woo_custom_file_upload', $order->id);
          $zurl        = $zfile['url'];
          $ztitle       = $zfile['title'];
          $zcaption = $zfile['caption'];

          ?>

          <h2>Completed Plans</h2>

          <table class="shop_table order_details">
              <tbody>
                  <tr>
                      <th align="right">Download Link:</th>
                      <td><a href="<?php echo $zurl; ?>" title="<?php echo $ztitle; ?>" class="button files">Get File</a></br>
                      <p style="font-size: 75%; margin-top: .5em; opacity: 0.5;">(right-click and save as)</p></td>
                  </tr>

                  <?php if( $zcaption ): ?>

                      <tr>
                          <th align="right">Notes:</th>
                          <td><?php echo $zcaption; ?></td>
                      </tr>

                  <?php endif; ?>

              </tbody>
          </table>

          <?php 
          
        }

      }
      // END ORDER DETAIL CUSTOM DOWNLOAD LINK DISPLAY
      // END ORDER DETAIL CUSTOM DOWNLOAD LINK DISPLAY

}
// END CHECK IF WOOCOMMERCE IS ACTIVE