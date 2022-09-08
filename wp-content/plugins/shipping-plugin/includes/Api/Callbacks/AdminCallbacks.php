<?php
/**
 * @package Shpiing-Plugin
 * 
 */

namespace Inc\Api\Callbacks;


class AdminCallbacks 
{
    public function AdminDashboard()
    {
        return require_once(PLUGIN_PATH. "/templates/admin.php" );
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
        $value = esc_attr(get_option('last_name'));
        echo'<input type="text" class="regular-text" name="last_name" value="'.  $value  .'" placeholder="Wirte SomeThing Here!">';
    }
    public function ShippingFirstName(){
        $value = esc_attr(get_option('first_name'));
        echo'<input type="text" class="regular-text" name="first_name" value="'.  $value  .'" placeholder="Wirte Your First Name Here!">';
    }
}