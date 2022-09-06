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


class Shipping_Plugin
{
    public function __construct()
    {
        add_action('init', array($this,'custom_shipping_type'));
    }
    public function register()
    {
        //admin_enqueue_scripts => backend
        //admin_enqueue_scripts => frontend
        add_action('admin_enqueue_scripts', array($this,'enqueue'));
    }
    //activate
    public function activate()
    {
       //generated a CPT
        $this->custom_shipping_type();
       //flush rewrite rules
       flush_rewrite_rules();
    }

    //deactivate
    public function deactivate()
    {
        //flush rewrite rules
        flush_rewrite_rules();
    }

    //uninstall
    public function uninstall()
    {
        //delete CPT
        //delete add the plugin data from the DB   
    }
    public function custom_shipping_type()
    {
        register_post_type('shipping',['public'=>true, 'label'=>'Shipping']);
    }
    public function enqueue()
    {
        //enqueue all our scripts

        wp_enqueue_style('mypluginstyle',plugins_url('/assets/main.css',__FILE__));
        wp_enqueue_script('mypluginscript',plugins_url('/assets/main.js',__FILE__));
    }
}
if(class_exists('Shipping_Plugin'))
{
    $shipping = new Shipping_Plugin('Shipping Plugin initialized!');
    $shipping->register();
}

//activate
register_activation_hook(__FILE__, array($shipping,'activate'));


//deactivate
register_deactivation_hook(__FILE__,array($shipping, 'deactivate'));


//uninstall
register_uninstall_hook(__FILE__,$shipping,'uninstall');


// function customFunction($arg)
// {
//     echo $arg;
// }
// customFunction('this í my argument to echo');