<?php

namespace Inc\Pages;


use \Inc\Base\BaseController;
use \Inc\Api\SettingsApi;
use \Inc\Api\Callbacks\AdminCallbacks;

class Admin extends BaseController
{
    public $settings ;

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
        
        $this->settings->AddPages( $this->pages)->WithSubPage('Dashboard')->AddSubMenuPages($this->subpages)->register();

        add_action('admin_init', array($this, 'setSetting'));

        add_action('admin_init', array($this, 'setSection'));

        add_action('admin_init', array($this, 'setField'));

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
                'option_name'       => 'text_example',
                'callback'          => array($this->callbacks,'ShippingOptionGroup'),
            ),
            array(
                'option_group'      => 'alecaddd_options_group',
                'option_name'       => 'first_name',
            )
        );
        foreach($args as $setting)
        {
          
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
                'title'     => 'Settings',
                'callback'  => array($this->callbacks,'ShippingAdminSection'),
                'page'      => 'shipping_plugin',
            )
        );
        //add settings section
        foreach($args as $section)
        {
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
                'id'        => 'text_example',
                'title'     => 'Text_example',
                'callback'  => array($this->callbacks,'ShippingTextExample'),
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
                    'callback'  => array($this->callbacks,'ShippingFirstName'),
                    'page'      => 'shipping_plugin',
                    'section'   => 'shipping_admin_index',
                    'args'      => array(
                        'label_for' => 'first_name',
                        'class'     => 'example-class',
    
                    )
                )
        );
        
         //add settings field
         foreach($args as $field)
         {
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
        require_once PLUGIN_PATH.'templates/admin.php'; // sử dụng lại PLUGIN_PATH
    }
    public function shipping_plugin_setting()
    {
        echo"cpt";
    }
    
    
}