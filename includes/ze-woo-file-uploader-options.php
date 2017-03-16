<?php function register_my_custom_submenu_page() {
    add_submenu_page( 'woocommerce', 'File Uploader', 'File Uploader Options', 'manage_options', 'ze-woo-submenu-page', 'ze_woo_submenu_page_callback' ); 
    }
    function ze_woo_submenu_page_callback() { 
      ?>
        <div class="wrap">
          <h1>Ze Woo File Uploader</h1>

          <form method="post" action="options.php">
              <?php settings_fields( 'ze-woo-option-group' ); ?>
              <?php do_settings_sections( 'ze-woo-plugin-settings-group' ); ?>
              <table class="form-table">
                  <tr valign="top">
                  <th scope="row">Custom Field Name</th>
                  <td><input type="text" name="ze_woo_custom_field_name" value="<?php echo esc_attr( get_option('ze_woo_custom_field_name') ); ?>" /></td>
                  </tr>

              </table>
              
              <?php submit_button(); ?>

          </form>
          </div>
    <?php }
    add_action('admin_menu', 'register_my_custom_submenu_page',99);
?>

<?php
    if ( is_admin() ){ // admin actions
        add_action( 'admin_init', 'register_mysettings' );
    } else {
        // non-admin enqueues, actions, and filters
    }
?>

<?php
function register_mysettings() { // whitelist options
  register_setting( 'ze-woo-option-group', 'ze_woo_custom_field_name' );
}
?>