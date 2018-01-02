<?php get_header(); ?>
<?php if ( is_user_logged_in() ) : ?>
	<?php get_template_part( 'ucenter', '' ); ?>
<?php else : ?>
	
	<div class="wrapper" id="main">

	    <div class="unlogined">
	    	<div class="tit">
	    		<h2>未登录</h2>
	    	</div>
	    	<div class="login-control">
	    		<a href="<?php echo wp_login_url(get_permalink()); ?>" class="loginbtn">登录</a>
	    	</div>
	        <div class="login-control">
	        	<a href="" class="registerbtn">注册</a>
	        </div>
	        
	    </div>
	    
	</div>
	
<?php endif; ?>
<?php get_footer(); ?>