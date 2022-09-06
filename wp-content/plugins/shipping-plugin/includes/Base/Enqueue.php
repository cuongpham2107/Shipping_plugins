<?php
/**
 * @package Shpiing-Plugin
 * 
 */

 namespace Inc\Base;


 class Enqueue
 {
    public function register()
    {
        add_action('admin_enqueue_scripts', array($this,'enqueue'));
    }
    public function enqueue()
    {
        //enqueue all our scripts

        wp_enqueue_style('mypluginstyle',PLUGIN_URL .'/assets/main.css');
        wp_enqueue_script('mypluginscript',PLUGIN_URL .'/assets/main.js');
    }
 }