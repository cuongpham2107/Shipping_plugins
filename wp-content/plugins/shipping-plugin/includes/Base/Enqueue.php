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

        add_action('admin_enqueue_scripts', array($this,'my_enqueue'));

     
    }
    public function enqueue()
    {
        //enqueue all our scripts

        wp_enqueue_style('mypluginstyle',PLUGIN_URL .'/assets/main.css');
        wp_enqueue_script('mypluginscript',PLUGIN_URL .'/assets/main.js');
    }
    function my_enqueue($hook)
    {
        // if ('myplugin_settings.php' !== $hook) {
        //     return;
        // }
        
        wp_enqueue_script(
            'ajax-script',
            PLUGIN_URL .'assets/myjquery.js',
            array('jquery'),
            '1.0.0',
            true
        );
        $title_nonce = wp_create_nonce('title_example');
        wp_localize_script(
            'ajax-script',
            'my_ajax_obj',
            array(
                'ajax_url' => admin_url('admin-ajax.php'),
                'nonce'    => $title_nonce,
            )
        );
    }


    
 }