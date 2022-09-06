<?php
/**
 * 
 * @package Shipping Plugin
 */
namespace Inc;

final class Init
{
    /**
     * Store all the classes inside an array
     * 
     * @return array Full list of classes
     */
    public static function get_services()
    {
        return [
            Pages\Admin::class,
            Base\Enqueue::class
        ];
    }
    /**
     * Loop through the classes, initialize them, and call the register() method if it exists
     * 
     * @return
     */
    public static function register_servives ()
    {
        foreach (self::get_services() as $key => $class) {
            $service = self::instantiate($class);
            if(method_exists($service, 'register')){
                $service->register();
            }
        }   
    } 
    /**
     * Initialize the class
     * @param class $class class from the services array
     * @return class instance new instance of the class
     * 
     */
    private static function instantiate($class)
    {
       $service = new $class();
       return $service;
    }
}
// use Inc\Base\Activate;
// use Inc\Base\Deactivate;
// use Inc\Pages\Admin;

// if(!class_exists('Shipping_Plugin'))
// {
   
//     class Shipping_Plugin 
//     {
//         public $plugin;

//         public function __construct()
//         {
//             $this->plugin = plugin_basename(__FILE__);
//         }
        
//         public function register()
//         {
//             //admin_enqueue_scripts => backend
//             //admin_enqueue_scripts => frontend
//             add_action('admin_enqueue_scripts', array($this,'enqueue'));

//             add_action( 'admin_menu', array($this,'add_admin_pages'));

//             // echo $this->plugin;
//             // add_filter('plugin_action_links_NAME-OF-MY-PLUGIN', array($this, 'settings_link'));
//             //add_filter('plugin_action_links_'. $this->plugin , array($this, 'settings_link')); // cách 1
//             add_filter("plugin_action_links_$this->plugin", array($this, 'settings_link')); //cách 2
//         }
//         public function settings_link($links)
//         {
//             //add custom settings link

//             $settings_link = '<a href="options-general.php?page=shipping_plugin">Settings</a>';
//             array_push($links, $settings_link);
//             return $links;
//         }
//         public function add_admin_pages()
//         {
//             add_menu_page(
//                 'Shipping Plugin',
//                 'Shipping',
//                 'manage_options',
//                 'shipping_plugin',
//                 array($this, 'admin_index'), //đường dẫn khi ấn vào thì sẽ trả về 1 hàm
//                 'dashicons-cart', //icon https://developer.wordpress.org/resource/dashicons/#cart
//                 null
//             );
//         }
//         public function admin_index()
//         {
//             require_once plugin_dir_path(__FILE__).'templates/admin.php';
//         }
//         /**
//          * sử dụng file riêng để xử lý cơ chế kích hoạt huỷ kích hoạt plugin
//         // activate
//         // public function activate()
//         // {
//         //    //generated a CPT
//         //     $this->custom_shipping_type();
//         //    //flush rewrite rules
//         //    flush_rewrite_rules();
//         // }

//         // deactivate
//         // public function deactivate()
//         // {
//         //     //flush rewrite rules
//         //     flush_rewrite_rules();
//         // }

//         // uninstall
//         // public function uninstall()
//         // {
//         //     //delete CPT
//         //     //delete add the plugin data from the DB   
//         // }
//         */
//         protected function create_post_shipping()
//         {
//             add_action('init', array($this,'custom_shipping_type'));

//         }
//         public function custom_shipping_type()
//         {
//             register_post_type('shipping',['public'=>true, 'label'=>'Shipping']);
//         }
//         public function enqueue()
//         {
//             //enqueue all our scripts

//             wp_enqueue_style('mypluginstyle',plugins_url('/assets/main.css',__FILE__));
//             wp_enqueue_script('mypluginscript',plugins_url('/assets/main.js',__FILE__));
//         }
//         public function activate()
//         {
//             // require_once plugin_dir_path(__FILE__).'includes/shipping-plugin-activate.php';
//             Activate::activate();
//         }
//         public function deactivate()
//         {
//             // require_once plugin_dir_path(__FILE__).'includes/shipping-plugin-deactivate.php';
//             Deactivate::deactivate();
//         }
//     }

//     $shipping = new Shipping_Plugin('Shipping Plugin initialized!');
//     $shipping->register();


//     //activate
//     register_activation_hook(__FILE__, array($shipping,'activate'));

//     //deactivate
//     register_deactivation_hook(__FILE__,array($shipping, 'deactivate'));


//     //uninstall
//     register_uninstall_hook(__FILE__,$shipping,'uninstall');

// }