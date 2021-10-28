<div class="cron_fn_sidebar">
	<div class="cron_fn_sidebar_in">
		<div class="forheight">

				<?php 

				global $woocommerce, $post;
				if(is_page()){

					
					if(is_page_template() == 'page-service.php'){
						if ( is_active_sidebar( 'service-single-sidebar' ) ){
							dynamic_sidebar('Service Single Sidebar');
						}
					}else{
						/* Page Sidebar */
						if (function_exists( 'generated_dynamic_sidebar' )){
							generated_dynamic_sidebar();
						}
					}
					
					

				}else if($woocommerce && is_shop() || $woocommerce && is_product_category() || $woocommerce && is_product_tag() || $woocommerce && is_product()) {

					if ( is_active_sidebar( 'woocommerce-sidebar' ) ){
						dynamic_sidebar('WooCommerce Sidebar');
					}; 

				}else if(is_single()){
					$post_type = get_post_type();
					if($post_type == 'cron-service'){
						if ( is_active_sidebar( 'service-single-sidebar' ) ){
							dynamic_sidebar('Service Single Sidebar');
						}; 
					}else{
						/* Page Sidebar */
						if ( is_active_sidebar( 'main-sidebar' ) ){
							dynamic_sidebar('Main Sidebar');
						}; 
					}
					
				}else {

					/* Main Sidebar */

					if ( is_active_sidebar( 'main-sidebar' ) ){
						dynamic_sidebar('Main Sidebar');
					}; 
				}
				?>
		</div>
	</div>
</div>