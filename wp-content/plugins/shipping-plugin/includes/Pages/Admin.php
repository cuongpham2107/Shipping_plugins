<?php

namespace Inc\Pages;
/**
 * 
 * 
 */
class Admin
{
    
    public function register()
    {
        add_action('admin_menu',array($this, 'add_admin_pages'));
    }
    public function add_admin_pages()
    {
        add_menu_page(
            'Shipping Plugin',
            'Shipping',
            'manage_options',
            'shipping_plugin',
            array($this, 'admin_index'), //đường dẫn khi ấn vào thì sẽ trả về 1 hàm
            'dashicons-cart', //icon https://developer.wordpress.org/resource/dashicons/#cart
            null
        );
    }
    public function admin_index()
    {
        require_once PLUGIN_PATH.'templates/admin.php'; // sử dụng lại PLUGIN_PATH
    }
}