<?php 
define('VRESION','2.1.0.6'); // Define the Theme's Version


/**
 * //禁止后台加载谷歌字体
 */
function remove_open_sans_miued() {
    wp_deregister_style( 'open-sans' );
    wp_register_style( 'open-sans', false );
    wp_enqueue_style('open-sans','');
}
add_action( 'init', 'remove_open_sans_miued' );


 
add_filter('the_content', 'fo_image_alt_tag'); //文章中的图片添加上alt
add_filter('comment_text', 'fo_image_alt_tag');//评论中的图片添加上alt
function fo_image_alt_tag($content){
	//非后端页面操作
	if( !is_admin() ) {
		//全局量
		global $post;
		//文章标题
		$post_title = $post -> post_title;
		// 获取博客名称
		$blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);
		//获取文章图片数目
		$num = preg_match_all( '/<img.*?>/i', $content, $matches );
		
		$temp = '*@@##@@*';
		for( $i = 1; $i <= $num; $i++ ) {
			// Get original title and alt
			preg_match( '/<img.*?>/', $content, $match_img );
			$img = isset( $match_img[0] ) ? $match_img[0] : '';

			preg_match( '/<img.*?title=[\"\'](.*?)[\"\'].*?>/', $img, $match_title );
			$title = isset( $match_title[1] ) ? $match_title[1] : '';

			preg_match( '/<img.*?alt=[\"\'](.*?)[\"\'].*?>/', $img, $match_alt );
			$alt = isset( $match_alt[1] ) ? $match_alt[1] : '';

			// 清空文章图片title与alt
			if( $title )
				$content = preg_replace( '/(<img.*?) title=["\'].*?["\']/i', '${1}', $content, 1 );
			if( $alt )
				$content = preg_replace( '/(<img.*?) alt=["\'].*?["\']/i','${1}', $content, 1 );

			//设置文章图片title与alt
			$title = $post_title.' - '.$blogname.' - '.$i;
			$alt = $post_title.' - '.$blogname.' - '.$i;

			// 构建替换目标
			$replace = '<' . $temp . ' title="' . $title . '" alt="' . $alt . '"';
			$content = preg_replace( '/<img/i', $replace, $content, 1 );
		}

		$content = str_replace( $temp, 'img', $content );
	}
	return $content;
};

/**
 * Name : mixianji	
 * Description:自动为保存草稿/发布新文章的时候自动添加以往使用过的标签(tag)做标签
 */
add_action('save_post', 'fo_auto_add_tags');
function fo_auto_add_tags(){
	$tags = get_tags( array('hide_empty' => false) );
	$post_id = get_the_ID();
	$post_content = get_post($post_id) -> post_content;
	$post_content = strtolower($post_content);
	
	if ($tags) {
		foreach ( $tags as $tag ) {
			if ( strpos($post_content, strtolower($tag->name)) !== false)
				wp_set_post_tags( $post_id, $tag->name, true );
		}
	}
}

//获取文章第一张图片，如果没有图，就不显示图
//文章中第一张图片获取图片
function catch_that_image() { 
 global $post, $posts; 
 $first_img = ''; 
 ob_start(); 
 ob_end_clean(); 
 $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*width=[\'"]([0-9]+)[\'"].*height=[\'"]([0-9]+)[\'"].*>/i', $post->post_content, $matches); 
 $first_img = $matches[1][0]; 
 $first_img_width = $matches[2][0];
 $first_img_height = $matches[3][0]; 
 if(empty($first_img)){  
   $first_img = bloginfo('template_url'). '/images/default-thumb.jpg'; 
 }else{
	 $first_img_html .= '<div class="pic_border_out" style="width:'.($first_img_width+22).'px">';
	 $first_img_html .= '<div class="pic_border_in" style="width:'.($first_img_width).'px;height:'.$first_img_height.'px;">';
	 $first_img_html .= '<div id="preview">';
	 $first_img_html .= '<img src="'.$first_img.'" style="width:'.($first_img_width).'px;height:'.$first_img_height.'px;">';
	 $first_img_html .= '</div>';
	 $first_img_html .= '</div>';
	 $first_img_html .= '</div>';
	 }
 return $first_img_html; 
 } 
//---------获取图片地址-----------//
function get_image_url(){
	 global $post, $posts; 
	 $first_img = ''; 
	 ob_start(); 
	 ob_end_clean(); 
	 $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*width=[\'"]([0-9]+)[\'"].*height=[\'"]([0-9]+)[\'"].*>/i', $post->post_content, $matches); 
	 $info['img'] = $matches[1][0];
	 $info['width'] = $matches[2][0];
     $info['height'] = $matches[3][0];  
	 return $info;
	}
//end


//13to@搜索结果排除所有页面
function search_filter_page($query) {
	if ($query->is_search) {
		$query->set('post_type', 'post');
	}
	return $query;
}
add_filter('pre_get_posts','search_filter_page');



//输出缩略图地址
function post_thumbnail_src(){
    global $post;
	if( $values = get_post_custom_values("thumb") ) {	//输出自定义域图片地址
		$values = get_post_custom_values("thumb");
		$post_thumbnail_src = $values [0];
	} elseif( has_post_thumbnail() ){    //如果有特色缩略图，则输出缩略图地址
        $thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
		$post_thumbnail_src = $thumbnail_src [0];
    } else {
		$post_thumbnail_src = '';
		ob_start();
		ob_end_clean();
		$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
		$post_thumbnail_src = $matches [1] [0];   //获取该图片 src
		if(empty($post_thumbnail_src)){	//如果日志中没有图片，则显示随机图片
			return false;
			//$random = mt_rand(1, 10);
			//echo get_bloginfo('template_url');
			//echo '/img/pic/'.$random.'.jpg';
			//如果日志中没有图片，则显示默认图片
			//echo '/img/thumbnail.png';
		}
	};
	//return($kong);
	return $post_thumbnail_src;
}


//去除头部冗余代码
remove_action( 'wp_head', 'feed_links_extra', 3 ); // Display the links to the extra feeds such as category feeds

remove_action( 'wp_head', 'feed_links', 2 ); // Display the links to the general feeds: Post and Comment Feed

remove_action( 'wp_head', 'rsd_link' ); // Display the link to the Really Simple Discovery service endpoint, EditURI link

remove_action( 'wp_head', 'wlwmanifest_link' ); // Display the link to the Windows Live Writer manifest file.

remove_action( 'wp_head', 'index_rel_link' ); // index link

remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // prev link

remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // start link

remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); // Display relational links for the posts adjacent to the current post.

remove_action( 'wp_head', 'wp_generator' ); // Display the XHTML generator that is generated on the wp_head hook, WP version

	remove_action('wp_head', 'mediaelement');


//移除js等版本号
if(!function_exists('cwp_remove_script_version')){
    function cwp_remove_script_version( $src ){  return remove_query_arg( 'ver', $src ); }
    add_filter( 'script_loader_src', 'cwp_remove_script_version' );
    add_filter( 'style_loader_src', 'cwp_remove_script_version' );
}


//增强编辑器开始

function add_editor_buttons($buttons) {

$buttons[] = 'fontselect';
$buttons[] = 'fontsizeselect';
$buttons[] = 'cleanup';
$buttons[] = 'styleselect';
$buttons[] = 'hr';
$buttons[] = 'del';
$buttons[] = 'sub';
$buttons[] = 'sup';
$buttons[] = 'copy';
$buttons[] = 'paste';
$buttons[] = 'cut';
$buttons[] = 'undo';
$buttons[] = 'image';
$buttons[] = 'anchor';
$buttons[] = 'backcolor';
$buttons[] = 'wp_page';
$buttons[] = 'charmap';
return $buttons;

}

add_filter("mce_buttons_3", "add_editor_buttons");




//关键字
//add_action('wp_head','deel_keywords');   

//网站描述 
//add_action('wp_head','deel_description');  
//关键字
function deel_keywords() {
  global $s, $post;
  $keywords = '';
  if ( is_single() ) {
	if ( get_the_tags( $post->ID ) ) {
	  foreach ( get_the_tags( $post->ID ) as $tag ) $keywords .= $tag->name . ', ';
	}
	foreach ( get_the_category( $post->ID ) as $category ) $keywords .= $category->cat_name . ', ';
	$keywords = substr_replace( $keywords , '' , -2);
  } elseif ( is_home () )    { $keywords = get_option('d_keywords');
  } elseif ( is_tag() )      { $keywords = single_tag_title('', false);
  } elseif ( is_category() ) { $keywords = single_cat_title('', false);
  } elseif ( is_search() )   { $keywords = esc_html( $s, 1 );
  } else { $keywords = trim( wp_title('', false) );
  }
  if ( $keywords ) {
	//echo "<meta name=\"keywords\" content=\"$keywords\">\n";
	return $deel_keywords;
  }
}
//网站描述
function deel_description() {
  global $s, $post;
  $description = '';
  $blog_name = get_bloginfo('name');
  if ( is_singular() ) {
	if( !empty( $post->post_excerpt ) ) {
	  $text = $post->post_excerpt;
	} else {
	  $text = $post->post_content;
	}
	$description = trim( str_replace( array( "\r\n", "\r", "\n", "　", " "), " ", str_replace( "\"", "'", strip_tags( $text ) ) ) );
	if ( !( $description ) ) $description = $blog_name . "-" . trim( wp_title('', false) );
  } elseif ( is_home () )    { $description = get_option('d_description'); // 首頁要自己加
  } elseif ( is_tag() )      { $description = $blog_name . "'" . single_tag_title('', false) . "'";
  } elseif ( is_category() ) { $description = trim(strip_tags(category_description()));
  } elseif ( is_archive() )  { $description = $blog_name . "'" . trim( wp_title('', false) ) . "'";
  } elseif ( is_search() )   { $description = $blog_name . ": '" . esc_html( $s, 1 ) . "' 的搜索結果";
  } else { $description = $blog_name . "'" . trim( wp_title('', false) ) . "'";
  }
  $description = mb_substr( $description, 0, 220, 'utf-8' );
  return $description;
}




function ttsign(){
	global $s, $post;
  $description = '';
  $blog_name = get_bloginfo('name');
  if ( is_singular() ) {
	  if( !empty( $post->post_excerpt ) ) {
	  $text = $post->post_excerpt;
	} else {
	  $text = $post->post_content;
	}
	$description = trim( str_replace( array( "\r\n", "\r", "\n", "　", " "), " ", str_replace( "\"", "'", strip_tags( $text ) ) ) );
	if ( !( $description ) ) $description = $blog_name . "-" . trim( wp_title('', false) );
	
	  }else{
		   $description = $blog_name . "'" . trim( wp_title('', false) ) . "'";
		  }
	$description = mb_substr( $description, 0, 220, 'utf-8' );
	return $description;
}

//文章（包括feed）末尾加版权说明
function deel_copyright($content) {
	if( !is_page() ){
		$pid = get_the_ID();
		$name = get_post_meta($pid, 'from.name', true);
		$link = get_post_meta($pid, 'from.link', true);
		$show = false;
		if( $name ){
			$show = $name;
			if( $link ){
				$show = '<a target="_blank" href="'.$link.'">'.$show.'</a>';
			}
		}else if( $link ){
			$show = '<a target="_blank" href="'.$link.'">'.$link.'</a>';
		}
		if( $show ){
			$content.= '<p>来源：'.$show.'</p>';
		}
		$content.= '<p>转载请注明：<a href="'.get_bloginfo('url').'">'.get_bloginfo('name').'</a> &raquo; <a href="'.get_permalink().'">'.get_the_title().'</a></p>';
	}
	return $content;
}

//阻止站内文章Pingback 
function deel_noself_ping( &$links ) {
  $home = get_option( 'home' );
  foreach ( $links as $l => $link )
  if ( 0 === strpos( $link, $home ) )
  unset($links[$l]);
}

//修改默认发信地址
function deel_res_from_email($email) {
	$wp_from_email = get_option('admin_email');
	return $wp_from_email;
}
function deel_res_from_name($email){
	$wp_from_name = get_option('blogname');
	return $wp_from_name;
}
//评论回应邮件通知
function comment_mail_notify($comment_id) {
  $admin_notify = '1'; // admin 要不要收回复通知 ( '1'=要 ; '0'=不要 )
  $admin_email = get_bloginfo ('admin_email'); // $admin_email 可改为你指定的 e-mail.
  $comment = get_comment($comment_id);
  $comment_author_email = trim($comment->comment_author_email);
  $parent_id = $comment->comment_parent ? $comment->comment_parent : '';
  global $wpdb;
  if ($wpdb->query("Describe {$wpdb->comments} comment_mail_notify") == '')
	$wpdb->query("ALTER TABLE {$wpdb->comments} ADD COLUMN comment_mail_notify TINYINT NOT NULL DEFAULT 0;");
  if (($comment_author_email != $admin_email && isset($_POST['comment_mail_notify'])) || ($comment_author_email == $admin_email && $admin_notify == '1'))
	$wpdb->query("UPDATE {$wpdb->comments} SET comment_mail_notify='1' WHERE comment_ID='$comment_id'");
  $notify = $parent_id ? get_comment($parent_id)->comment_mail_notify : '0';
  $spam_confirmed = $comment->comment_approved;
  if ($parent_id != '' && $spam_confirmed != 'spam' && $notify == '1') {
	$wp_email = 'no-reply@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME'])); // e-mail 发出点, no-reply 可改为可用的 e-mail.
	$to = trim(get_comment($parent_id)->comment_author_email);
	$subject = 'Hi，您在 [' . get_option("blogname") . '] 的留言有人回复啦！';
	$message = '
	<div style="color:#333;font:100 14px/24px microsoft yahei;">
	  <p>' . trim(get_comment($parent_id)->comment_author) . ', 您好!</p>
	  <p>您曾在《' . get_the_title($comment->comment_post_ID) . '》的留言:<br /> &nbsp;&nbsp;&nbsp;&nbsp; '
	   . trim(get_comment($parent_id)->comment_content) . '</p>
	  <p>' . trim($comment->comment_author) . ' 给您的回应:<br /> &nbsp;&nbsp;&nbsp;&nbsp; '
	   . trim($comment->comment_content) . '<br /></p>
	  <p>点击 <a href="' . htmlspecialchars(get_comment_link($parent_id)) . '">查看回应完整內容</a></p>
	  <p>欢迎再次光临 <a href="' . get_option('home') . '">' . get_option('blogname') . '</a></p>
	  <p style="color:#999">(此邮件由系统自动发出，请勿回复.)</p>
	</div>';
	$from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
	$headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
	wp_mail( $to, $subject, $message, $headers );
	//echo 'mail to ', $to, '<br/> ' , $subject, $message; // for testing
  }
};

//去掉WP-Syntax 自带的css
add_action( 'wp_print_styles', 'my_deregister_styles', 100 );    
function my_deregister_styles() {  
	wp_deregister_style( 'wp-syntax-css' );  //件WP-Syntax 自带的css
};

//加载主题自定义样式
function myPrintCss() {
	//wp_register_style( 'miued', get_template_directory_uri() . '/css/miued.css'); 
	 wp_enqueue_style( 'miued', get_template_directory_uri() . '/css/miued.css'); 
	 }
add_action( 'wp_enqueue_scripts', 'myPrintCss');

//加载主题自定义样式
function myPrintCss_admin() {
	//wp_register_style( 'miued', get_template_directory_uri() . '/css/miued.css'); 
	 wp_enqueue_style( 'miued', get_template_directory_uri() . '/includes/admin/admin.css'); 
	 }
add_action( 'admin_enqueue_scripts', 'myPrintCss_admin');


add_filter( 'template_include', 'include_template_function', 1 );
function include_template_function( $template ) {

    if ( get_post_type() == 'musics_mu' ) {
         $new_template = '';
		// single post template
		if( is_category() ) {
		  global $post;
		  // 'wordpress' is category slugs
		
			// use template file single-wordpress.php
			$new_template = locate_template(array('taxonomy-musics_mu.php' ));
		  
		}
    }
     return ('' != $new_template) ? $new_template : $template;
}


function get_category_root_slug($cat)
{
$this_category = get_category($cat);   // 取得当前分类
while($this_category->category_parent) // 若当前分类有上级分类时，循环
{
$this_category = get_category($this_category->category_parent); // 将当前分类设为上级分类（往上爬）
}
return $this_category->slug;//返回跟分类的别名
}
function link_at(){
    if ( get_option('permalink_structure') != '' ){
          return "?";
    }else{
          return "&";
    }
}
?>
