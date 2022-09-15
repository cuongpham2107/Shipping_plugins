<?php 
/**
 * @package  AlecadddPlugin
 */
namespace Inc\Base;

use Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use Inc\Api\Callbacks\AdminCallbacks;

/**
* 
*/
class CustomLoginController extends BaseController
{
	public $callbacks;

	public $subpages = array();

	public function register()
	{
		if ( ! $this->activated( 'custom_login' ) ) return;

		$this->settings = new SettingsApi();

		$this->callbacks = new AdminCallbacks();

		$this->setSubpages();

		$this->setSettings();

		$this->setSections();
		
		$this->setFields();

		$this->settings->addSubPages( $this->subpages )->register();

		add_action( 'login_enqueue_scripts', array($this,'my_login_logo') );
	}

	public function setSubpages()
	{
		$this->subpages = array(
			array(
				'parent_slug' => 'alecaddd_plugin', 
				'page_title' => 'Custom Login', 
				'menu_title' => 'Custom Login', 
				'capability' => 'manage_options', 
				'menu_slug' => 'custom_login', 
				'callback' => array( $this->callbacks, 'adminCustomLogin' )
			)
		);
	}
    public function setSettings()
    {
        $settings = array(
            array(
                'option_group'  => 'custom_login_settings',
                'option_name'   => 'custom_login',
            )
           
        );
        $this->settings->setSettings($settings);
    }
    public function setSections()
    {
        $sections = array(
            array(
                'id'            => 'custom_login_index',
                'title'   		=> 'Settings Login',
                // 'callback'      => array( $this->callbacks_manager, 'adminSectionCustomLogin' ),
                'page'          =>'custom_login'
            )
        );
        $this->settings->setSections( $sections );
    }
    public function setFields()
    {
        $fields = array(
            array(
                'id' =>  'background_color_login',
				'title' =>  'Background Color Login',
				'callback' => array( $this, 'background_color_login' ),
				'page' => 'custom_login',
				'section' => 'custom_login_index',
				'args' => array(
					'label_for' =>  'background_color_login',
					'class'		=> 'ui-toggle'
				)
            ),
            array(
                'id' =>  'logo_login',
				'title' =>  'Logo Login',
				'callback' => array( $this, 'logo_login' ),
				'page' => 'custom_login',
				'section' => 'custom_login_index',
				'args' => array(
					'label_for' =>  'logo_login',
					'class'		=> 'ui-toggle'
				)
            ),
        );
        $this->settings->setFields( $fields );
    }
	public function logo_login($data)
    {
       
        $name = $data['label_for']; //option name //logo_login
        $image = get_option($name);//option value
        ?>
        <div class="mb-8">
            <!-- <label class="text-sm font-semibold" for="">Upload Logo</label> -->
            <input type="hidden" name="<?php echo $name ?>" value="<?php echo $image ?>" id="value_logo">
            <button type="button" class="px-2 py-2 bg-blue-500 rounded text-white" id="btnImage" >Upload image</button>
            <img src="<?php echo $image ?>" alt="" id="getImage" style="width: 100px;height: 100px;">
        </div>
        <?php
    }
	public function background_color_login($data)
	{
		$name = $data['label_for'];
        $color = get_option($name);
        // var_dump($color);
        ?>
       <div class="mb-8">
            <!-- <label class="text-sm font-semibold" for="">Mầu nền:</label> -->
            <input type="text" id="txtMau" name="<?php echo $name ?>" value="<?php echo $color ?>" placeholder="#000000" >
        </div>
        <?php
	}


	function my_login_logo() { 
		$url_logo = get_option('logo_login');
		$color_background = get_option('background_color_login');
		if(isset( $url_logo ) && isset( $color_background )){
			?> 
			<style type="text/css">
				#login h1 a, .login h1 a {
					background-image: url(<?php echo $url_logo; ?>);
					height:65px;
					width:320px;
					background-size: 190px 100px;
					background-repeat: no-repeat;
					padding-bottom: 30px;
				}
				body.login.js.login-action-login.wp-core-ui.locale-vi {
					background: <?php echo $color_background ?>;
				}
			</style>
		<?php 
		}
	}
}