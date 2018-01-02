<?php
/*
Plugin Name: Code Highlight
Plugin URI: http://wpsites.net/
Description: Highlight your code using Googles Code Prettify Script. 
Version: 1.0.0
Author: <a href="http://wpsites.net/best-plugins/style-your-code-use-the-pre-quicktag-in-wordpress-to-highlight-it/">WP Sites</a> - Brad Dalton
Author URI: http://wpsites.net/
*/

add_action( 'wp_enqueue_scripts', 'wpsites_add_js' );
/** Load all JavaScript to header  */
function wpsites_add_js() {
	if ( ! is_admin() ) {
	
			wp_enqueue_script( 'run-prettify', plugins_url( 'js/run_prettify.js', __FILE__ ), '', '', true );
			wp_enqueue_style( 'style-code', plugins_url( 'css/style.css', __FILE__ ) );
			
		
	}
}

/**
 * Main API function for adding a button to Quicktags
 * @link http://codex.wordpress.org/Quicktags_API
 * Adds qt.Button or qt.TagButton depending on the args. The first three args are always required.
 * To be able to add button(s) to Quicktags, your script should be enqueued as dependent
 * on "quicktags" and outputted in the footer. If you are echoing JS directly from PHP,
 * use add_action( 'admin_print_footer_scripts', 'output_my_js', 100 ) or add_action( 'wp_footer', 'output_my_js', 100 )
 *
 * Minimum required to add a button that calls an external function:
 *     QTags.addButton( 'my_id', 'my button', my_callback );
 *     function my_callback() { alert('yeah!'); }
 *
 * Minimum required to add a button that inserts a tag:
 *     QTags.addButton( 'my_id', 'my button', '<span>', '</span>' );
 *     QTags.addButton( 'my_id2', 'my button', '<br />' );
 */

// Hook pre tag button in text editor to prettyprint script
function wpsites_add_pre_quicktags() {
    if (wp_script_is('quicktags')){
?>
    <script type="text/javascript">
    QTags.addButton( 'eg_pre', 'pre', '<pre class="prettyprint">', '</pre>', 'q', 'Code Pretty Tag', 111 );
    </script>
<?php
    }
}
add_action( 'admin_print_footer_scripts', 'wpsites_add_pre_quicktags' );