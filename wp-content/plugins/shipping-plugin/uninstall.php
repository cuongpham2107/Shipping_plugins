<?php 
/**
 * Trigger this file on Plugin uninstall
 * 
 * @package Shipping Plugin
 *  
 */
if(!defined('WP_UNINSTALL_PLUGIN'))
{
    die;
}
//Clear Database stored data
$shipping = get_posts(array('post_type' => 'shipping','numberposts' => -1));

foreach($shipping as $value){
    wp_delete_post($value->ID,true);
}


//Access the database via SQL
global $wpdb;
$wpdb->query("DELETE FROM wp_posts WHERE post_type = 'shipping'");
$wpdb->query("DELETE FROM wp_postmeta WHERE post_id NOT IN(SELECT id FROM wp_posts)");
$wpdb->query("DELETE FROM wp_term_relationships WHERE object_id NOT IN(SELECT id FROM wp_posts)")

?>