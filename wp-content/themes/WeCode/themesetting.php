<?php 
//主题设置
// global $banner;
// $banner = array();
add_action('admin_menu', 'themeoptions_admin_menu');
function themeoptions_admin_menu()
{
// 在控制面板的侧边栏添加设置选项页链接
add_theme_page('主题设置', '主题选项', 'edit_themes', basename(__FILE__), 'themeoptions_page');
}
if ( $_POST['update_themeoptions'] == 'true' ) { themeoptions_update(); }
function themeoptions_page()
{
	
?>

<div class="wrap">
	<div id="icon-themes"><br></div>
	<h2>主题设置</h2>
	<div class="container">
		<form method='POST' action=''>
		<input type='hidden' name='update_themeoptions' value='true' />
		<div class="banbox">
			<div class="banner" id="banner1">
				<h4>图片广告位1</h4>
				<p>广告图片<input type='text' name='ad1image' id='ad1image' size='32' value='<?php echo get_option("ad1image"); ?>'/> <a id="ad1image" class="upload_button button" href="#">上传</a></p>
				<p>广告链接<input type='text' name='ad1url' id='ad1url' size='32' value='<?php echo get_option("ad1url"); ?>'/> </p>
				

			</div>
			<div class="banner" id="banner2">
				<h4>图片广告位2</h4>
				<p>广告图片<input type='text' name='ad2image' id='ad2image' size='32' value='<?php echo get_option("ad2image"); ?>'/> <a id="ad2image" class="upload_button button" href="#">上传</a></p>
				<p>广告链接<input type='text' name='ad2url' id='ad2url' size='32' value='<?php echo get_option("ad2url"); ?>'/> </p>
				

			</div>
			<div class="banner" id="banner3">
				<h4>图片广告位3</h4>
				<p>广告图片<input type='text' name='ad3image' id='ad3image' size='32' value='<?php echo get_option("ad3image"); ?>'/><a id="ad3image" class="upload_button button" href="#">上传</a> </p>
				<p>广告链接<input type='text' name='ad3url' id='ad3url' size='32' value='<?php echo get_option("ad3url"); ?>'/> </p>		

			</div>			
		</div>

		<p><input type='button' name='add_banner' value='添加广告位' class='button' id="add_banner" /></p>
		<p><input type='submit' name='updatebtn' value='更新数据' class='button button-primary'/></p>
		</form>		
	</div>

</div>
<?php wp_enqueue_media(); ?>

    <script>   

	    jQuery(document).ready(function(){   
		    var upload_frame;   
		    var value_id;   
		    jQuery('.upload_button').live('click',function(event){   
		        value_id =jQuery( this ).attr('id');       
		        event.preventDefault();   
		        if( upload_frame ){   
		            upload_frame.open();   
		            return;   
		        }   
		        upload_frame = wp.media({   
		            title: '选择图片',   
		            button: {   
		                text: '确定',   
		            },   
		            multiple: false   
		        });   
		        upload_frame.on('select',function(){   
		            attachment = upload_frame.state().get('selection').first().toJSON();   
		            jQuery('input[name='+value_id+']').val(attachment.url);   
		        });   		           
		        upload_frame.open();   	        

		    });   


			jQuery("#add_banner").click(function(){
			    var n = parseInt(jQuery(".banbox .banner").length)+1;
			    var newban = "<div class='banner' id='banner3'><h4>图片广告位"+n+"</h4><p>广告图片<input type='text' name='ad"+n+"image' id='ad"+n+"image' size='32'/>"+
				"<a id='ad"+n+"image' class='upload_button button' href='#''>上传</a> </p><p>广告链接<input type='text' name='ad"+n+"url' id='ad"+n+"url' size='32' /> </p></div>";
				// alert(newban);
				jQuery(".banbox").append(newban);
			});
	    });   
    </script>  
<?php 
	
}
function themeoptions_update()
{

// 数据更新验证
	$str = "<ul>";
	foreach ($_POST as $key => $value) {
		if($key != "update_themeoptions" && $key != "updatebtn" && $key != "add_banner"){
			update_option($key,$value);
		}
	}

	// update_option('ad1_img', $_POST['ad1image']);
	// update_option('ad1_url', $_POST['ad1url']);

	// update_option('ad2_img', $_POST['ad2image']);
	// update_option('ad2_url', $_POST['ad2url']);

	// update_option('ad3_img', $_POST['ad3image']);
	// update_option('ad3_url', $_POST['ad3url']);

}





?>