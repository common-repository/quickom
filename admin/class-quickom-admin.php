<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://quickom.com
 * @since      1.0.0
 *
 * @package    Quickom
 * @subpackage Quickom/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Quickom
 * @subpackage Quickom/admin
 * @author     Quickom <khoa@quickom.com>
 */
class Quickom_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		add_action( 'wp_footer',array( $this, 'Float_Block_Footer' ) );
		add_action( 'admin_menu',array( $this, 'Quickom_Menu' ) );

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Quickom_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Quickom_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/quickom-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Quickom_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Quickom_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/quickom-admin.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name."qrcode", plugin_dir_url( __FILE__ ) . 'js/qrcode.min.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name."awesome-qr", plugin_dir_url( __FILE__ ) . 'js/awesome-qr.min.js', array( 'jquery' ), $this->version, false );
		

	}

	
 
	public function Quickom_Menu() {
        add_menu_page('Quickom Plugin Settings', 'Quickom setting', 'administrator', __FILE__, array( $this, 'quickom_settings_page' ),plugins_url('/images/icon_b.png', __FILE__));
		add_action( 'admin_init', array( $this, 'register_quickom_settings' ));
        
	}

	public function Float_Block_Footer()
	{
	 	
	 	$img_qr = plugin_dir_url( dirname( __FILE__ ) );	 
	 	$get_quickom_link = '';
	 	if(get_option('quickom_link')){
	 		$get_quickom_link = get_option('quickom_link');
	 	}
	 	//icon_quickom.png
	 	$string='';//<img class="qr-code" style="display: inline-block;" src="'.$img_qr.'public/images/quickom_qrcode.png">
	 	$string.='<a href="'.$get_quickom_link.'" target="_blank" class="floating-support d-flex align-items-center flex-column"><div id="qrcode_quickom" class="box d-flex align-items-center"></div><div class="text">Live Support</div></a>';
	 	echo $string;
	 	?>
	 	<script> 		
	 		
	 		var get_quickom_link = "<?php echo $get_quickom_link; ?>";
	 		
			var qrcode = new QRCode("qrcode_quickom");
			qrcode.makeCode(get_quickom_link);
		</script>
		<?php 
	 	
	 }

	 function quickom_settings_page() { ?>
		<div class="wrap">
			<h2>Config Quickom Link</h2>
			<?php if( isset($_GET['settings-updated']) ) { ?>
				<div id="message" class="updated">
					<p><strong><?php _e('Settings saved.') ?></strong></p>
				</div>
			<?php } ?>
			<form method="post" action="options.php">
				<?php settings_fields( 'quickom-settings-group' ); ?>
				<table class="form-table">
					<tr valign="top">
					<th scope="row" style="text-align: right">Set quickom link</th>
					<td><input style="width: 100%; height: 40px;" type="text" name="quickom_link" value="<?php echo get_option('quickom_link'); ?>" /></td>
					</tr>
				</table>
				<?php submit_button(); ?>
			</form>
		</div>
		
	<?php } 


	function register_quickom_settings(){
		register_setting( 'quickom-settings-group', 'quickom_link' ); 
		// dòng 1 là group name, dòng 2 là option name , dòng 3 là phần mở rộng, mình chưa có nhé.
	}

}




