<?php 
/**
 * @package  AlecadddPlugin
 */
namespace Inc\Pages;

use Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use Inc\Api\Callbacks\AdminCallbacks;
use Inc\Api\Callbacks\ManagerCallbacks;

/**
* 
*/
class Admin extends BaseController
{
	public $settings;

	public $callbacks;

	public $callbacks_manager;

	public $pages = array();

	public $subpages = array();

	public function register() 
	{
		$this->settings = new SettingsApi();

		$this->callbacks = new AdminCallbacks();

		$this->callbacks_manager = new ManagerCallbacks();

		$this->setPages();

		$this->setSubpages();

		$this->setSettings();
		$this->setSections();
		$this->setFields();

		$this->settings->addPages( $this->pages )->withSubPage( 'Dashboard' )->addSubPages( $this->subpages )->register();
	}

	public function setPages() 
	{
		$this->pages = array(
			array(
				'page_title' => 'Alecaddd Plugin', 
				'menu_title' => 'Alecaddd', 
				'capability' => 'manage_options', 
				'menu_slug' => 'alecaddd_plugin', 
				'callback' => array( $this->callbacks, 'adminDashboard' ), 
				'icon_url' => 'dashicons-store', 
				'position' => 110
			)
		);
	}

	public function setSubpages()
	{
		$this->subpages = array(
			array(
				'parent_slug' => 'alecaddd_plugin', 
				'page_title' => 'Custom Post Types', 
				'menu_title' => 'CPT', 
				'capability' => 'manage_options', 
				'menu_slug' => 'alecaddd_cpt', 
				'callback' => array( $this->callbacks, 'adminCpt' )
			),
			array(
				'parent_slug' => 'alecaddd_plugin', 
				'page_title' => 'Custom Taxonomies', 
				'menu_title' => 'Taxonomies', 
				'capability' => 'manage_options', 
				'menu_slug' => 'alecaddd_taxonomies', 
				'callback' => array( $this->callbacks, 'adminTaxonomy' )
			),
			array(
				'parent_slug' => 'alecaddd_plugin', 
				'page_title' => 'Custom Widgets', 
				'menu_title' => 'Widgets', 
				'capability' => 'manage_options', 
				'menu_slug' => 'alecaddd_widgets', 
				'callback' => array( $this->callbacks, 'adminWidget' )
			)
		);
	}

	public function setSettings()
	{
		$args = array(
			array(
				'option_group' => 'alecaddd_pluggin_settings',
				'option_name' => 'cpt_manager',
				'callback' => array( $this->callbacks, 'checkboxSanitize' )
			),
			array(
				'option_group' => 'alecaddd_pluggin_settings',
				'option_name' => 'taxonomy_manager',
				'callback' => array( $this->callbacks, 'checkboxSanitize' )
			),
			array(
				'option_group' => 'alecaddd_pluggin_settings',
				'option_name' => 'media_widget',
				'callback' => array( $this->callbacks, 'checkboxSanitize' )
			),
			array(
				'option_group' => 'alecaddd_pluggin_settings',
				'option_name' => 'gallery_manager',
				'callback' => array( $this->callbacks, 'checkboxSanitize' )
			),
			array(
				'option_group' => 'alecaddd_pluggin_settings',
				'option_name' => 'testimoinal_manager',
				'callback' => array( $this->callbacks, 'checkboxSanitize' )
			),
			array(
				'option_group' => 'alecaddd_pluggin_settings',
				'option_name' => 'templates_manager',
				'callback' => array( $this->callbacks, 'checkboxSanitize' )
			),
			array(
				'option_group' => 'alecaddd_pluggin_settings',
				'option_name' => 'login_manager',
				'callback' => array( $this->callbacks, 'checkboxSanitize' )
			),
			array(
				'option_group' => 'alecaddd_pluggin_settings',
				'option_name' => 'membership_manager',
				'callback' => array( $this->callbacks, 'checkboxSanitize' )
			),
			array(
				'option_group' => 'alecaddd_pluggin_settings',
				'option_name' => 'chat_manager',
				'callback' => array( $this->callbacks, 'checkboxSanitize' )
			)
		);

		$this->settings->setSettings( $args );
	}

	public function setSections()
	{
		$args = array(
			array(
				'id' => 'alecaddd_admin_index',
				'title' => 'Settings Manager',
				'callback' => array( $this->callbacks_manager, 'adminSectionManager' ),
				'page' => 'alecaddd_plugin'
			)
		);

		$this->settings->setSections( $args );
	}

	public function setFields()
	{
		$args = array(
			array(
				'id' => 'cpt_manager',
				'title' => 'Active CPT Manager',
				'callback' => array( $this->callbacks_manager, 'checkboxField' ),
				'page' => 'alecaddd_plugin',
				'section' => 'alecaddd_admin_index',
				'args' => array(
					'label_for' => 'cpt_manager',
				)
			)
		);

		$this->settings->setFields( $args );
	}
}