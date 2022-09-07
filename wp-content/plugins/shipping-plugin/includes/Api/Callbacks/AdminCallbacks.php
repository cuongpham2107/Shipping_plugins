<?php
/**
 * @package Shpiing-Plugin
 * 
 */

namespace Inc\Api\Callbacks;

use Inc\Base\BaseController;

class AdminCallbacks extends BaseController
{
    public function AdminDashboard()
    {
        return require_once( "$this->plugin_path/templates/admin.php" );
    }
    public function ShippingOptionGroup($input)
    {
        return $input;
    }
    public function ShippingAdminSection()
    {
        echo"Check this section!";
    }
    public function ShippingTextExample()
    {
        $value = esc_attr(get_option('text_example'));
        echo'<input type="text" class="regular-text" name="text_example" value="'.  $value  .'" placeholder="Wirte SomeThing Here!">';
    }
}