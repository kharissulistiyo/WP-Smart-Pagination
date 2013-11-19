<?php

/*
Plugin Name: WP Smart Pagination
Plugin URI: https://github.com/kharissulistiyo/WP-Smart-Pagination
Description: Smart WordPress post pagination with input number filed.
Author: Kharis Sulistiyono
Version: 0.1
Author URI: http://kharisulistiyo.github.io
*/


/*
* Front-end style
*/

if(!function_exists('wp_smart_pagination_style')){

	function wp_smart_pagination_style(){
		
		wp_enqueue_style( 'wp-smart-pagination', plugins_url( 'wp-smart-pagination.css' , __FILE__ ) );
	
	}

}

add_action( 'wp_enqueue_scripts', 'wp_smart_pagination_style' ); 



// Function

if ( ! function_exists( 'wp_smart_pagination' ) ) :
	function wp_smart_pagination() {
		global $wp_query;
		
		echo '<div class="wp-smart-pagination">';
		echo '<div class="wpsp-page-nav">';
		$big = 999999999; // need an unlikely integer
		
		echo paginate_links( array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, get_query_var('paged') ),
			'total' => $wp_query->max_num_pages
		) ); ?>
		</div><!-- /.wpsp-page-nav -->
		
		<form class="wpsp-page-nav-form" action="<?php echo $_SERVER['REQUEST_URI'];?>" method="get">
			<label for="sortby" class="wpsp-label wpsp-hidden"><?php _e('Go to', 'wp-smart-pagination'); ?></label>
			<input class="wpsp-input-number" type="text" placeholder="Jump to" size="6" name="paged" />
			<input class="wpsp-button" value="Go" type="submit" > 
		</form>
		
		</div><!-- /.wp-smart-pagination -->
	
<?php	
	
	}
endif;


// Shortcode

add_shortcode( 'wpsp', 'wp_smart_pagination' );

?>