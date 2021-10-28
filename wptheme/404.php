<?php
	get_header();
?>
          	
       	<!-- ERROR PAGE -->
       	<div class="cron_fn_error_page">
       		<div class="container">
				<div class="error_wrap">
					<div class="error_box">
						<div class="title_holder">
							<h1>404</h1>
							<h3><?php esc_html_e('Page Not Found', 'cron') ?></h3>
							<p><?php esc_html_e('Sorry, but the page you are looking for was moved, removed, renamed or might never existed...', 'cron') ?></p>
						</div>
						<div class="search_holder">
							<form action="<?php echo esc_url(home_url('/')); ?>" method="get" >
								<div><input type="text" placeholder="<?php esc_attr_e('Search', 'cron');?>" name="s" autocomplete="off" /></div>
								<div><input type="submit" class="pe-7s-search" value="<?php esc_attr_e('Search', 'cron');?>" /></div>
							</form>
						</div>
					</div>
				</div>
       		</div>
       	</div>
       	<!-- /ERROR PAGE -->
        	
        
<?php get_footer(); ?>  