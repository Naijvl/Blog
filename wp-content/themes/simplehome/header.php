<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=Edge，chrome=1">
<meta http-equiv="Cache-Control" content="no-cache" />
<title><?php bloginfo('name'); if (is_home()) {echo " | "; bloginfo('description');} wp_title( '|', true, 'left' ); ?></title>
<meta name="format-detection" content="telephone=no"/>
<meta name="apple-mobile-app-status-bar-style" content="black" />
<meta name="apple-touch-fullscreen" content="YES" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="viewport" content="width=device-width, initial-scale=1.0,  minimum-scale=1.0, maximum-scale=1.0" />
<?php if(is_home()){
$keywords = get_option('mytheme_keywords');
$description = get_option('mytheme_description');
}elseif(is_single() || is_page()){
$keywords = tagtext().'|'.deel_keywords();
$description = get_the_title().'|'.deel_description();
}elseif(is_category()){
$description = category_description().'|'.deel_description();
if (!empty($description) && get_query_var('paged')) {
    $description .= '(第'.get_query_var('paged').'页)';
    }
$keywords = single_cat_title('', false).'|'.deel_keywords();
}elseif (is_tag())
{
$description = tag_description().'|'.deel_description();
if (!empty($description) && get_query_var('paged')) {
$description .= '(第'.get_query_var('paged').'页)';
}
$keywords = single_tag_title('', false).'|'.deel_keywords();
}
?>
<meta name="keywords" content="<?php echo $keywords; ?>">
<meta name="description" content="<?php echo $description; ?>">
 <?php  if(get_option('mytheme_mi_favicon')){ 
	  $favicon_img=get_option('mytheme_mi_favicon');
  ?>
<link rel="icon" href="<?php echo $favicon_img; ?>" type="image/x-icon" />
  <?php }else{ ?>
<link rel="icon" href="<?php bloginfo('template_directory');?>/favicon.ico" type="image/x-icon" />
<?php }?>
<link href="<?php bloginfo('template_url'); ?>/css/tip-twitter/tip-twitter.css" rel="stylesheet">
<link href="<?php bloginfo('template_url'); ?>/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/tomorrow.css">
<?php wp_head(); ?>

<!--[if lte IE 8]>
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/scripts/html5.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/scripts/css3-mediaqueries.js"></script>
<![endif]-->
<script src="<?php bloginfo('template_url'); ?>/scripts/highlight.pack.js"></script>
<?php if(get_option('mytheme_mi_css')){echo "<style type='text/css'>" . stripslashes(get_option('mytheme_mi_css')) . "</style>";}?>
</head>

<body>
    <!--loading-->
    <div class="loading"></div>
    <div class="circle-loading"></div>
	<!-- float category -->
    <div class="list">
    	<ul>
			<?php wp_list_categories("orderby=order&title_li=0&hide_empty=0");?>
        </ul>
    </div>
    <!-- weiboshow -->
    <div class="weibo-show">
		<iframe name="weiboshow" width="100%" height="750" class="share_self"  frameborder="0" scrolling="no" src="<?=(get_option('mytheme_weiboshow'))?>"></iframe>
	</div>
    <!-- wider-switch -->
    <div class="wider-switch"><i class="fa fa-expand"></i></div>
    <header class="left">
    	<div id="categories"><i class="fa fa-bars"></i>
        <?php  if(get_option('nav_cai_mi')){ ?>
 			<select >
        	<option value="<?=(bloginfo('home_url'))?>">请选择</option>
        	<?php
			$args = array(
				'hide_empty'=>false
			);
			$header_categories = get_categories($args);
			foreach($header_categories as $category) {
			?>
            <option value="<?=(get_category_link( $category->term_id ))?>"><?=($category->name)?></option>
            <?php
			}
			?>
        </select>
  <?php }else{ ?>
  		<script type="text/javascript">	
		//设置导航栏
			jQuery(document).ready(function(){
				var navlen= jQuery('.nav>ul>li').length;
			jQuery('.nav>ul>li').each(function(index, element) {
				var href_nav=jQuery(this).find('a').attr('href');
				var name_nav=jQuery(this).find('a').html();
				//console.log(href_nav);
				jQuery("#categories").find('select').append('<option value="'+href_nav+'">'+name_nav+'</option>');
			});
		}); 
		</script>
  		<select>
          <option value="<?=(bloginfo('home_url'))?>">请选择</option>
            </select>
  <?php } ?>
        </div>
    	<div class="sns-icon">
        	<ul>
            	<li class="sns-weibo"><span>展开微博窗口</span></li>
                <li class="sns-qq"><span>QQ:<?=(get_option('mytheme_qq')!='' ? get_option('mytheme_qq') : '2662995277')?></span></li>
                <li class="sns-weichat"><span>微信:<?=(get_option('mytheme_weichat')!='' ? get_option('mytheme_weichat') : '蓝色早晨')?></span></li>
                <li class="icon-category"><span>展开分类目录</span></li>
            </ul>
        </div>
        
        <div class="to-top"><i class="fa fa-angle-up"></i></div>
    	<div class="face-area">
        	<div class="face-img">
            <a href="<?php echo home_url();?>" alt="回到首页" title="回到首页">
            <?php  if(get_option('mytheme_lgimg')){ 
				$logo_img=get_option('mytheme_lgimg');
			?>
				 <img src="<?php echo $logo_img; ?>" height="130" width="130"/>
			<?php }else{ ?>
				 <img src="<?php bloginfo('template_url'); ?>/images/face.png" />
				<?php }?>
            </a>
            </div>
            <div class="face-name"><?=(get_option('mytheme_owner')!='' ? get_option('mytheme_owner') : 'Miued')?></div>
             
        </div>
       
    	<div class="search">
        	<?php
				get_search_form();
			?>
        </div>
        <div class="nav">
        	<ul>
            	<?php wp_nav_menu(array('theme_location' => 'primary', 'container' => 'false', 'items_wrap' => '%3$s'));?>
            	<!--<li id="nav-current" class="nav-current"></li>-->
            </ul>
            
        </div>
        
    </header>