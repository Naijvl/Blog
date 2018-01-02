<?php
add_action('admin_menu', 'mytheme_page');
function mytheme_page (){
	if ( count($_POST) > 0 && isset($_POST['mytheme_settings']) ){
		//custom options
		$options = array ('keywords','description','skincolor','qq','weichat','weiboshow','owner','analysis','mi_css','lgimg','mi_favicon','mi_banq','mi_beian');
		//foreach options
		foreach ( $options as $opt ){
			//update_option ( 'mytheme_'.$opt, $_POST[$opt] );
		    delete_option ( 'mytheme_'.$opt, $_POST[$opt] ); //delete
			add_option( 'mytheme_'.$opt, $_POST[$opt] );
				//add
			
		}//end foreach
           
	}
	if ( count($_POST) > 0 && isset($_POST['update_themeoptions']) ){
		//custom options
		$options = array ('category_blog','category_index','category_img','fo2_focus','fo2_focus_flexslider','d_sideroll_b','d_sideroll_1','d_sideroll_2','nav_cai_mi');
		//foreach options
		foreach ( $options as $opt ){
			//update_option ( 'mytheme_'.$opt, $_POST[$opt] );
		    delete_option ($opt, $_POST[$opt] ); //delete
			add_option($opt, $_POST[$opt] );
				//add
			
		}//end foreach
           
	}
	
	//站点公告的插入函数
if ( $_POST['update_themeoptions_ac'] == 'true' ) { 

	$num = get_option('themes_fo2_ac_num');
	for($i=1; $i<=$num; $i++){
		delete_option('themes_fo2_top_ac' . $i . '_text', stripslashes($_POST['fo2_top_ac' . $i . '_text']));
		add_option('themes_fo2_top_ac' . $i . '_text', stripslashes($_POST['fo2_top_ac' . $i . '_text']));
		if ($_POST['fo2_top_ac' . $i . '_display']=='on') { $display1 = "checked"; } else { $display1 = ""; }
		delete_option('themes_fo2_top_ac' . $i . '_display', $display1);
		add_option('themes_fo2_top_ac' . $i . '_display', $display1);
	}
	delete_option('themes_fo2_ac_num', $_POST['fo2_ac_num']);
	add_option('themes_fo2_ac_num', $_POST['fo2_ac_num']);


}
	
	add_menu_page('SM主题设置', 'SM主题设置', 'administrator', 'theme_config' ,'mytheme_settings', '' . get_bloginfo('template_url') .'/images/fo_tm.png', 59);
	add_submenu_page('theme_config',__('主题显示设置'), __('主题显示设置'), 'edit_themes', 'thset', 'mytheme_settings_miued');
	add_submenu_page('theme_config',__('站点公告'), __('站点公告'), 'edit_themes', 'thac', 'themeoptions_ms_ac');
	add_submenu_page('theme_config',__('SM主题更新'), __('SM主题更新'), 'edit_themes', 'smgeng', 'themeoptions_page_get');
	  //add_submenu_page('theme_config','站点公告设置','站点公告','administrator','themes_ac','themeoptions_page_ac');
}
function mytheme_settings(){
	include_once(TEMPLATEPATH.'/includes/admin/panel.php');
	
}
function mytheme_settings_miued(){
	include_once(TEMPLATEPATH.'/includes/admin/admin_miued.php');
	
}
function themeoptions_ms_ac(){
	include_once(TEMPLATEPATH.'/includes/admin/themes_ac.php');
	
}
function themeoptions_page_get()
{
	include_once( TEMPLATEPATH.'/includes/admin/themes_get.php');
}
?>
