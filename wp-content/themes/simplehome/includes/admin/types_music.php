<?php
// 音乐
function post_type_musics() {
register_post_type(
					'musics_mu', 
					array( 
					'public' => true,
					'publicly_queryable' => true,
					'hierarchical' => false,
					'labels'=>array(
									'name' => _x('音乐', 'post type general name'),
									'singular_name' => _x('音乐', 'post type singular name'),
									'add_new' => _x('添加音乐', '音乐'),
									'add_new_item' => __('添加音乐'),
									'edit_item' => __('编辑音乐'),
									'new_item' => __('新的音乐'),
									'view_item' => __('预览音乐'),
									'search_items' => __('搜索音乐'),
									'not_found' =>  __('您还没有发布音乐'),
									'not_found_in_trash' => __('回收站中没有音乐'), 
									'parent_item_colon' => ''
									),
					'show_ui' => true,
					'menu_position'=>5,
					'has_archive' => true,
					'menu_icon' => get_bloginfo('template_url') .'/images/music_ic.png',
					'supports' => array(
								'title',
								'author', 
								'thumbnail',
								'editor', 
								'comments',
								'custom-fields',
								) ,
				   )
				);

}

add_action('init', 'post_type_musics');

function create_music_taxonomy() 
{	
	
	$labels = array(
					'name' => _x( '音乐分类', 'taxonomy general name' ),
					'singular_name' => _x( 'musics_mu', 'taxonomy singular name' ),
					'search_items' =>  __( '搜索分类' ),
					'all_items' => __( '全部分类' ),
					'parent_item' => __( '父级分类目录' ),
					'parent_item_colon' => __( '父级分类目录:' ),
					'edit_item' => __( '编辑音乐分类' ), 
					'update_item' => __( '更新' ),
					'add_new_item' => __( '添加新音乐分类' ),
					'new_item_name' => __( 'New Genre Name' ),
					); 
  
// Tags
register_taxonomy(
		'musics_mu_tags',
		'musics_mu',
		array(
			'hierarchical' => false,
			'label' => '音乐标签',
			'query_var' => true,
			'rewrite' => true
		)
	);
	register_taxonomy(
	'musics_cat',
	array('musics_mu'), 
	array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'query_var' => true,
		//'rewrite' => array( 'slug' => 'musics_cat' ),
  ));
}
add_action( 'init', 'create_music_taxonomy', 0 );



/**********文章***********/
add_filter( 'manage_edit-musics_mu_columns', 'my_columns' );
function my_columns( $columns ) {
    $columns['artist_value'] = '艺术家';
	$columns['categories'] = '分类目录';
    unset( $columns['comments'] );
    return $columns;
}
add_action( 'manage_posts_custom_column', 'populate_columns' );
function populate_columns( $column ) {
    if ( 'artist_value' == $column ) {
        $movie_director = esc_html( get_post_meta( get_the_ID(), 'artist_value', true ) );
        echo $movie_director;
    }
   if ( 'categories' == $column ) {
        $movie_rating = esc_html( get_post_meta( get_the_ID(), 'musics_cat', true) );
        echo $movie_rating . ' stars';
    }
}

?>