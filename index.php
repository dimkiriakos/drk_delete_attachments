<?php
/**
 * Plugin Name:       drk_delete_attachments
 * Description:       This plugin deletes the related attachments when we are deleting a post
 * Version:           1.0
 * Author:            Dimitrios Kyriakos
 * Author URI:        https://dimkiriakos.com
 * License:           MIT License
 * Text Domain:       drk_delete_attachments
 */


if (! defined('ABSPATH')){
    die("I'm just a plugin not much I can do when called directly.");
    exit;
}

class DRK_Delete_Attachments{
    public function __construct()
    {
        add_action('init', [$this, 'Init']);
    }

    public function Init(){
        add_action('before_delete_post', [$this, 'on_delete_post']);
    }
    
    public function on_delete_post($post_id){
        $attachments = get_attached_media( '', $post_id );
        foreach ($attachments as $attachment) {
            wp_delete_attachment( $attachment->ID, 'true' );
        }
    }

}

new DRK_Delete_Attachments(); 
