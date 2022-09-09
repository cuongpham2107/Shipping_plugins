<?php

namespace Inc\Pages;


use \Inc\Base\BaseController;
use \Inc\Api\SettingsApi;
use \Inc\Api\Callbacks\AdminCallbacks;

class Admin extends BaseController
{
    public $settings;

    public $callbacks;

    public $pages = array();

    public $subpages = array();


    public function register()
    {
        // add_action('admin_menu',array($this, 'add_admin_pages'));

        $this->settings = new SettingsApi();

        $this->callbacks = new AdminCallbacks();

        $this->setPages();

        $this->setSubPages();

        $this->settings->AddPages($this->pages)->WithSubPage('Dashboard')->AddSubMenuPages($this->subpages)->register();

        add_action('admin_init', array($this, 'setSetting'));

        add_action('admin_init', array($this, 'setSection'));

        add_action('admin_init', array($this, 'setField'));

        add_action('wp_ajax_my_tag_count', array($this,'my_ajax_handler'));
        
    }

    function my_ajax_handler()
    {
        
        check_ajax_referer('title_example');
        update_user_meta(get_current_user_id(), 'title_preference', $_POST['title']);
        $args      = array(
            'tag' => $_POST['title'],
        );
        $the_query = new \WP_Query($args);
        echo $_POST['title'] . ' (' . $the_query->post_count . ') ';
        wp_die(); // all ajax handlers should die when finished
    }


    public function setPages()
    {
        $this->pages = array(

            array(
                'page_title'    => 'Shipping Plugin',
                'menu_title'    => 'Shipping',
                'capability'    => 'manage_options',
                'menu_slug'     => 'shipping_plugin',
                'callback'      =>  array($this->callbacks, 'AdminDashboard'),
                'icon_url'      => 'dashicons-cart',
                'position'      => 110,
            ),
        );
    }
    public function setSubPages()
    {
        $this->subpages = array(
            array(
                'parent_slug'   =>   'shipping_plugin',
                'page_title'    =>   'Setting Shipping Plugin',
                'menu_title'    =>   'Setting Plugin',
                'capability'    =>   'manage_options',
                'menu_slug'     =>   'setting_plugin',
                'callback'      =>   array($this, 'shipping_plugin_setting')
            ),
        );
    }
    public function setSetting()
    {
        $args = array(
            array(
                'option_group'      => 'alecaddd_options_group',
                'option_name'       => 'last_name',
                'callback'          => array($this->callbacks, 'ShippingOptionGroup'),
            ),
            array(
                'option_group'      => 'alecaddd_options_group',
                'option_name'       => 'first_name',
            )

        );
        foreach ($args as $setting) {

            register_setting(
                $setting["option_group"],
                $setting["option_name"],
                (isset($setting["callback"]) ? $setting["callback"] : '')
            );
        }
    }
    public function setSection()
    {
        $args = array(
            array(
                'id'        => 'shipping_admin_index',
                'title'     => 'Setting Plugin',
                'callback'  => array($this->callbacks, 'ShippingAdminSection'),
                'page'      => 'shipping_plugin',
            )
        );
        //add settings section
        foreach ($args as $section) {
            add_settings_section(
                $section["id"],
                $section["title"],
                (isset($section["callback"]) ? $section["callback"] : ''),
                $section["page"],
            );
        }
    }
    public function setField()
    {
        $args = array(
            array(
                'id'        => 'last_name',
                'title'     => 'Last_name',
                'callback'  => array($this->callbacks, 'ShippingTextExample'),
                'page'      => 'shipping_plugin',
                'section'   => 'shipping_admin_index',
                'args'      => array(
                    'label_for' => 'text_example',
                    'class'     => 'example-class',

                )
            ),
            array(
                'id'        => 'first_name',
                'title'     => 'First Name',
                'callback'  => array($this->callbacks, 'ShippingFirstName'),
                'page'      => 'shipping_plugin',
                'section'   => 'shipping_admin_index',
                'args'      => array(
                    'label_for' => 'first_name',
                    'class'     => 'example-class',

                )
            ),
            array(
                'id'        => 'so_dien_thoai',
                'title'     => 'Số Điện Thoại',
                'callback'  => array($this->callbacks, 'ShippingSDT'),
                'page'      => 'shipping_plugin',
                'section'   => 'shipping_admin_index',
                'args'      => array(
                    'label_for' => 'sdt',
                    'class'     => 'example-class',

                )
            )
        );

        //add settings field
        foreach ($args as $field) {
            add_settings_field(
                $field["id"],
                $field["title"],
                (isset($field["callback"]) ? $field["callback"] : ''),
                $field["page"],
                $field["section"],
                (isset($field["args"]) ? $field["args"] : ''),
            );
        }
    }

    public function shipping_plugin_index()
    {
        require_once PLUGIN_PATH . 'templates/admin.php'; // sử dụng lại PLUGIN_PATH
    }
    public function shipping_plugin_setting()
    {
        require_once PLUGIN_PATH . 'templates/setting.php'; // sử dụng lại PLUGIN_PATH
    }

  
}
