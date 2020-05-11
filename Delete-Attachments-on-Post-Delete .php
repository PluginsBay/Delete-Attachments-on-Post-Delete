<?php
/**
 * Plugin Name:       Delete Attachments on Post Delete
 * Plugin URI:        Delete all attachments on post delete in WordPress
 * Version:           1.0.0
 * Author:            PluginsBay
 * Author URI:        https://pluginsbay.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

class DeleteMedia{
	function __construct() {
		add_action( 'before_delete_post', array($this, 'remove_attachment_with_post'), 10 );
	}

	public function remove_attachment_with_post($post_id){
		$attachments = get_attached_media( '', $post_id );

		if(is_array($attachments) && sizeof($attachments) > 0){
			foreach ($attachments as $attachment){
				$attachment_id = $attachment->ID;

				wp_delete_attachment($attachment_id, true);
			}
		}
	}
}

new DeleteMedia();
