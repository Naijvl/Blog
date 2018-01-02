<?php 
//创建音乐字段


$new_meta_boxes_mu =      
	array(      
		"music_url_mu" => array(      
			"name" => "music_url_mu",      
			"std" => "音乐",      
			"title" => "音乐地址："),
		"artist" => array(
			"name"=> "artist",
			"std"=> "艺术家",
			"title"=> "艺术家名称："
		),
		
		
	);
//create meta box
function create_meta_box_mu() {    
    if ( function_exists('add_meta_box') ) { 
        add_meta_box( 'new_meta_boxes_mu', '音乐地址设置', 'new_meta_boxes_mu', 'musics_mu', 'side', 'high' ); 
    }   
}  
function new_meta_boxes_mu() {      
	global $post, $new_meta_boxes_mu;      
	foreach($new_meta_boxes_mu as $meta_box) {      
		$meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);          
		echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';      
		echo'<h4>'.$meta_box['std'].'</h4>';      
		echo '<textarea cols="31" rows="3" name="'.$meta_box['name'].'_value">'.$meta_box_value.'</textarea><br />';
		
	}      
}

//save post meta data
function save_postdata_mu( $post_id ) {      
	global $post, $new_meta_boxes_mu;      
	foreach($new_meta_boxes_mu as $meta_box) {      
		if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) ))  {      
			return $post_id;      
		}      
		if ( 'page' == $_POST['post_type'] ) {      
			if ( !current_user_can( 'edit_page', $post_id ))      
				return $post_id;      
		}       
		else
		{      
			if ( !current_user_can( 'edit_post', $post_id ))      
				return $post_id;      
		}      
		$data = $_POST[$meta_box['name'].'_value'];      
         
		if(get_post_meta($post_id, $meta_box['name'].'_value') == "")      
			add_post_meta($post_id, $meta_box['name'].'_value', $data, true);      
		elseif($data != get_post_meta($post_id, $meta_box['name'].'_value', true))      
			update_post_meta($post_id, $meta_box['name'].'_value', $data);      
		elseif($data == "")      
			delete_post_meta($post_id, $meta_box['name'].'_value', get_post_meta($post_id, $meta_box['name'].'_value', true));      
	}      
}
add_action('admin_menu', 'create_meta_box_mu');      
add_action('save_post', 'save_postdata_mu');





?>