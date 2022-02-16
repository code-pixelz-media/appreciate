<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://developerravi.com/
 * @since      1.0.0
 *
 * @package    Appreciate
 * @subpackage Appreciate/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Appreciate
 * @subpackage Appreciate/admin
 * @author     Ravi Khadka <ravik@codepixelzmedia.com.np>
 */
class Appreciate_Admin {

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
		 * defined in Appreciate_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Appreciate_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'assets/css/appreciate-admin.css', array(), $this->version, 'all' );

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
		 * defined in Appreciate_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Appreciate_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'assets/js/appreciate-admin.js', array( 'jquery' ), $this->version, false );

	}

}



/**
* Initialize Cpm_Plugin class
*/
if ( !class_exists('Cpm_Plugin') ) {

    class Cpm_Plugin {

        /**
        * Class constructor
        */
        function __construct() {

            add_action( 'admin_menu', array( $this, 'Cpm_Plugin_register_menu_page' ) );
            add_action( 'admin_enqueue_scripts', array( $this, 'Cpm_Plugin_admin_scripts_style' ) );

        }


        /**
        * Enqueue required admin styles and scripts.
        */
        public function Cpm_Plugin_admin_scripts_style() {
            wp_enqueue_style( 'admin-style', plugin_dir_url( __FILE__ ).'assets/css/admin-style.css' );
            wp_enqueue_style( 'admin-select2', plugin_dir_url( __FILE__ ).'assets/css/select2.min.css' );
            wp_enqueue_style( 'fonts', 'https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap' );

            wp_enqueue_script('jquery');
            wp_enqueue_script( 'jquery-ui-accordion');
			wp_enqueue_script( 'jquery-ui-tabs' );
            wp_enqueue_script( 'admin-script', plugin_dir_url( __FILE__ ).'assets/js/admin-script.js' );
            wp_enqueue_script( 'admin-select2', plugin_dir_url( __FILE__ ).'assets/js/select2.min.js' );
            wp_enqueue_script( 'chart-script', 'https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js' );
        }


        /**
        * Add menu page.
        */
        public function Cpm_Plugin_register_menu_page() {
            //add_menu_page( __( 'Appreciate', 'Cpm_Plugin'), 'Appreciate', 'manage_options', 'cpm-plugin', array($this, 'Cpm_Plugin_add_setting_page' ), '', 20 );
            
			add_submenu_page('options-general.php' ,__( 'Appreciate', 'Cpm_Plugin'), 'Appreciate', 'manage_options', 'appreciate', array($this, 'Cpm_Plugin_add_setting_page' ), '', 20 );
        }

        /**
        * Callback function of add_menu_page. Displays the page's content.
        */
        public function Cpm_Plugin_add_setting_page() {
            require plugin_dir_path( __FILE__ ).'cpm-plugin-settings.php';
        }


    }

    $Cpm_Plugin = new Cpm_Plugin();
}


//add_action('admin_init','get_all_post_type',999);
function appreciate_display_all_post_type() {
	$post_types = get_post_types( '', 'object' ); 
	//print_r($post_types);
	foreach ( $post_types as $post_type ) {
	 $cpm_post_type =$post_type->name;
	   //$hold_post[]= "<option value='$cpm_post_type'>" . $cpm_post_type . '</option>';
	  echo "<option value='$cpm_post_type'>" . $cpm_post_type . '</option>';
	}
	//return $hold_post; 
	
}

