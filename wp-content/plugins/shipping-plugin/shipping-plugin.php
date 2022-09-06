<?php
/**
*@package Shipping
*/
/*
Plugin Name:       Shipping Plugin
Plugin URI:        https://shipping.com/plugins/shipping-plugin
Description:       Handle the basics with this plugin.
Version:           1.0.0
Requires at least: 5.2
Requires PHP:      7.4
Author:            Cường Phạm
Author URI:        https://www.facebook.com/cadissney.21/
License:           GPL v1 or later
License URI:       https://shipping.com/plugins/shipping-plugin
Plugin URI:        https://shipping.com/plugins/shipping-plugin
Text Domain:       shipping-plugin
Domain Path:       /languages
*/


// if(!defined('ABSPATH')){
//     die;
// }

// defined('ABSPATH') or die('Hey, you cant access this file, you silly human!');

// if(! function_exists('add_action')){
//     echo'Hey, you cant access this file, you silly human!';
//     exit;
// }
if(file_exists(dirname(__FILE__).'/vendor/autoload.php'))
{
    require_once dirname(__FILE__).'/vendor/autoload.php';
}

define('PLUGIN_PATH',plugin_dir_path(__FILE__));
define('PLUGIN_URL', plugin_dir_url(__FILE__));

if(class_exists('Inc\\Init')){
    Inc\Init::register_servives();
}
