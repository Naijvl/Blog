<?php 
//创建音乐字段


$new_meta_boxes_thumb =      
	array(      
		"dis_url_thumb" => array(      
			"name" => "dis_url_thumb",      
			"std" => "开启不显示缩略图",      
			"title" => "开启："),
		
		
	);
//create meta box
function create_meta_box_thumb() {    
    if ( function_exists('add_meta_box') ) { 
        add_meta_box( 'new_meta_boxes_thumb', '文章缩略图显示设置', 'new_meta_boxes_thumb', 'post', 'side', 'high' ); 
    }   
}  
function new_meta_boxes_thumb() {      
	global $post, $new_meta_boxes_thumb;      
	foreach($new_meta_boxes_thumb as $meta_box) {      
		$meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);          
		echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
		echo '<label for="thumbnails_dis_input" title="首页及文章头部将不显示大缩略图">'; 
		echo '<input name="'.$meta_box['name'].'_value"'.'type="checkbox" value="'.$meta_box_value.'" id="thumbnails_dis_input" />'; 
		echo'<span>'.$meta_box['std'].'</span>'; 
		echo '</label>'; 
		
		
		
		echo '
  <script type="text/javascript">
  
		if(jQuery("#thumbnails_dis_input").val()=="1"){
					jQuery("#thumbnails_dis_input").attr("checked",true);
				}else{
     				jQuery("#thumbnails_dis_input").attr("checked",false);
				}
			
			
			jQuery("#thumbnails_dis_input").click(function(){
				if(!jQuery(this).is(":checked")){
					jQuery(this).attr("checked",false);
					jQuery(this).val("0")
				}else{
     				jQuery(this).attr("checked",true);
					jQuery(this).val("1")
				}
			});
</script>';
	}      
}

//save post meta data
function save_postdata_thumb( $post_id ) {      
	global $post, $new_meta_boxes_thumb;      
	foreach($new_meta_boxes_thumb as $meta_box) {      
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
add_action('admin_menu', 'create_meta_box_thumb');      
add_action('save_post', 'save_postdata_thumb');





?>