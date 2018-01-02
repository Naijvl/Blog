<?php 

//为文章添加字段(幻灯片)
add_action( 'add_meta_boxes', 'fo_add_custom_box' );
add_action( 'save_post', 'fo_save_postdata' );

function fo_add_custom_box() {
  add_meta_box(
    'fo_sectionid',
    '[miued]幻灯片图片设置', // 可自行修改标题文字
    'fo_inner_custom_box',
    'post'
  );
}


function fo_inner_custom_box( $post ) {
  global $wpdb;
   
  wp_nonce_field( plugin_basename( __FILE__ ), 'fo_noncename' );
  
  $flag = getNewKeys($post->ID,'flag');
  $flashPic = getNewKeys($post->ID,'flashPic');
  
  echo '
  <script type="text/javascript">
  
    var ashu_upload_frame;   
    var value_id;   
    jQuery(".button-secondary").live("click",function(event){   
        value_id =jQuery( this ).attr("id");       
        event.preventDefault();   
        if( ashu_upload_frame ){   
            ashu_upload_frame.open();   
            return;   
        }   
        ashu_upload_frame = wp.media({   
            title: "Insert image",   
            button: {   
                text: "Insert",   
            },   
            multiple: false   
        });   
        ashu_upload_frame.on("select",function(){   
            attachment = ashu_upload_frame.state().get("selection").first().toJSON();   
            //jQuery("#"+value_id+"_input").val(attachment.url).trigger("change");   
            jQuery("input[name="+value_id+"]").val(attachment.url).trigger("change");   
        });   
           
        ashu_upload_frame.open();   
    }); 
 
jQuery(function($){
	$("#flag-1").click(function(){
		$(".flash_con_box").show(300);
	})
	
	$("#flag-0").click(function(){
		$(".flash_con_box").hide(300);
	})
	
	var fis = setInterval(flashImgShow,1000)
	function flashImgShow(){
		var src = $("#flashPic_new_field").val();
		$("#flash_image").attr("src",src)
	}
});
</script>';

		//推送类型框架
  echo '<p>设置为：';
  echo '<input type="radio" name="flag_new_field" class="post-format" id="flag-0" value="." '.is_radio_flag('',$flag).'>
  		<label for="flag-0" class="post-format-standard">默认</label> 
		<input type="radio" name="flag_new_field" class="post-format" id="flag-1" value="f" '.is_radio_flag('f',$flag).'> 		
		<label for="flag-1" class="post-format-standard">幻灯</label></p>';	
		//幻灯缩略图框架开始
  if(is_radio_flag('f',$flag)){ echo '<div class="flash_con_box">';}else{ echo '<div class="flash_con_box" style="display:none;">';}
  echo '<p><label for="description_new_field">幻灯图片：</label> ';
  echo '<input type="text" id="flashPic_new_field" name="flashPic_new_field_var" value="'.$flashPic.'" size="28" /><a id="flashPic_new_field_var" class="button-secondary button">调用图像</a><br/></p><img id="flash_image" width="254" src="'.$flashPic.'"/></div>';//幻灯缩略图框架结束
  
}
  //flag选中判断处理函数
function is_radio_flag($flag,$getVal){
	if($getVal == $flag) return 'checked="checked"';
}

/* 文章提交更新后，保存固定字段的值 */
function fo_save_postdata( $post_id ) {
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
      return;

  if ( !wp_verify_nonce( $_POST['fo_noncename'], plugin_basename( __FILE__ ) ) )
      return;
 
  // 权限验证
  if ( 'post' == $_POST['post_type'] ) {
    if ( !current_user_can( 'edit_post', $post_id ) )
        return;
  }
  // 获取编写文章时填写的固定字段的值，多个字段依此类推
  $blogUrl = 'http://'.$_SERVER['HTTP_HOST'];
  
  $flag = $_POST['flag_new_field'];
  $flashPic = str_replace($blogUrl,'',$_POST['flashPic_new_field_var']);
  setNewKeys($post_id,'flag',$flag);
  setNewKeys($post_id,'flashPic',$flashPic);
}		

function getNewKeys($postID,$count_key){
  $count = get_post_meta($postID, $count_key, true);
  if($count ==''){
	  delete_post_meta($postID, $count_key);
	  add_post_meta($postID, $count_key, '.');
	  return '';
  }
  return $count;
}

function setNewKeys($postID,$count_key,$countinput) {
  $count = get_post_meta($postID, $count_key, true);
  if($count ==''){
	  delete_post_meta($postID, $count_key);
	  add_post_meta($postID, $count_key, '.');
  }else{
	  update_post_meta($postID, $count_key,$countinput);
  }
}

//查找postmeta特定值，获取文章ID
function select_postmeta_key($key,$value){
	global $wpdb;
	$table_name = $wpdb->prefix;
	$object_id = $wpdb->get_col("SELECT post_id FROM ".$table_name."postmeta WHERE `meta_key` = '".$key."' AND `meta_value` ='".$value."'");
	return $object_id;
}

//调用所有的分类id
function show_category_id() {
	global $wpdb;
	$request = "SELECT $wpdb->terms.term_id, name FROM $wpdb->terms ";
	$request .= " LEFT JOIN $wpdb->term_taxonomy ON $wpdb->term_taxonomy.term_id = $wpdb->terms.term_id ";
	$request .= " WHERE $wpdb->term_taxonomy.taxonomy = 'category' ";
	$request .= " ORDER BY term_id asc";
	$categorys = $wpdb->get_results($request);
	foreach ($categorys as $category) { //调用菜单
		$output = $category->term_id.',';
		$category_id .= $output;
	};
	return $category_id;
}

 ?>