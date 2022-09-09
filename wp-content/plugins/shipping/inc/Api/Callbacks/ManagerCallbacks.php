<?php 
/**
 * @package  AlecadddPlugin
 */
namespace Inc\Api\Callbacks;

use Inc\Base\BaseController;

class ManagerCallbacks extends BaseController
{
	public function checkboxSanitize( $input )
    {
        // return filter_var($input, FILTER_SANITIZE_NUMBER_INT);
        return ( isset($input) ? true : false );
    }
    public function adminSectionManager()
    {
       echo"Manager the Sections and Features of this plugin";
    }
    public function checkboxField($args)
    {
        var_dump($args);
        return;
    }
}