<?php 
global $cron_fn_option;
$footer_subscribe_area 			= '';
$footer_widget_switch 			= '';
$footer_bottom_widget_switch 	= '';
$totop_switch 					= '';
$footer_copyright_switch 		= '';
$footerSwitch 					= '';
	
if(function_exists('rwmb_meta')){
	$footerSwitch 		= get_post_meta(get_the_ID(),'cron_fn_page_footer_switch', true);
}
if(isset($cron_fn_option['footer_switch'])){
	if($footerSwitch === 'undefined' || $footerSwitch === ''){
		$footerSwitch 			= $cron_fn_option['footer_switch'];
	}
}
// footer subscribe area switch
if(isset($cron_fn_option['footer_subscribe_area'])){
	$footer_subscribe_area 		= $cron_fn_option['footer_subscribe_area'];
}
// footer triple widget switch
if(isset($cron_fn_option['footer_widget_switch'])){
	$footer_widget_switch 		= $cron_fn_option['footer_widget_switch'];
}
// footer bottom widget switch
if(isset($cron_fn_option['footer_bottom_widget_switch'])){
	$footer_bottom_widget_switch = $cron_fn_option['footer_bottom_widget_switch'];
}
// footer copyright switch
if(isset($cron_fn_option['footer_copyright_switch'])){
	$footer_copyright_switch 	= $cron_fn_option['footer_copyright_switch'];
}
// footer totop switch
if(isset($cron_fn_option['totop_switch'])){
	$totop_switch 				= $cron_fn_option['totop_switch'];
}
if(isset($cron_fn_option['footer_bg']['url']) && $cron_fn_option['footer_bg']['url'] !== ''){
	$footer_bg 					= $cron_fn_option['footer_bg']['url'];
}else{
	$footer_bg 					= get_template_directory_uri().'/framework/img/footer-bg.jpg';
}
?>	
			</div>
			<!-- /WRAPPER for HEIGHT -->


			<?php if($footerSwitch !== 'disable'){ ?>
				<!-- FOOTER -->
				<footer class="cron_fn_footer" data-subscribe="<?php echo esc_attr($footer_subscribe_area); ?>" data-triple="<?php echo esc_attr($footer_widget_switch); ?>" data-b-widget="<?php echo esc_attr($footer_bottom_widget_switch); ?>" data-copy="<?php echo esc_attr($footer_copyright_switch); ?>">

					<?php if(isset($cron_fn_option)){ ?>
					<div class="top_footer">
						<div class="top_footer_img" data-fn-bg-img="<?php echo esc_url($footer_bg);?>"></div>

						<?php if(isset($cron_fn_option['footer_subscribe_area']) &&  $cron_fn_option['footer_subscribe_area'] === 'enable'){?>
						<!-- SUBSCRIBE -->
						<div class="subscribe_f">
							<div class="container">
								<div class="subscribe_in">
									<div class="s_left">
										<img class="cron_fn_svg" src="<?php echo get_template_directory_uri().'/framework/svg/open-book.svg'; ?>" alt="<?php echo esc_attr__('svg', 'cron');?>" />
										<p>
											<?php 
												if(isset($cron_fn_option['footer_subscribe_text'])){ 
													echo wp_kses_post($cron_fn_option['footer_subscribe_text']);

												}else{ 
													esc_html_e('Newsletter get updates with latest topics', 'cron');
												} 
											?>

										</p>
									</div>
									<div class="s_right">
										<?php 
											if ( is_active_sidebar( 'footer-subscribe-widget' )){ 
												dynamic_sidebar( 'footer-subscribe-widget' );
											}
										?>
									</div>
								</div>
							</div>
						</div>
						<!-- /SUBSCRIBE -->
						<?php }?>

						<?php if($footer_widget_switch === 'enable'){ ?>
						<!-- TRIPLE WIDGET -->
						<div class="footer_widget">
							<div class="container">
								<div class="inner">
									<ul class="widget_area">
										<?php
										for($counter = 1; $counter <= 3; $counter++){
										?>

										<?php if ( is_active_sidebar( 'footer-widget-'.$counter )){ ?>
										<li>
											<div class="item"><?php dynamic_sidebar( 'footer-widget-'.$counter ); ?></div>
										</li>
										<?php } ?>

										<?php
										}	
										?>
									</ul>
								</div>
							</div>
						</div>
						<!-- /TRIPLE WIDGET -->
						<?php } ?>

					</div>
					<?php } ?>



					<!-- BOTTOM -->
					<div class="footer_bottom">
						<div class="container">
							<div class="footer_bottom_in">
								<div class="bottom_widget">
								<?php 
									if ( is_active_sidebar( 'footer-bottom-widget' )){ 
										dynamic_sidebar( 'footer-bottom-widget' );
									}
								?>
								</div>
								<?php if($footer_copyright_switch !== 'disable'){ ?>
								<div class="footer_copyright">
									<p>
										<?php 
											if(isset($cron_fn_option['footer_copyright'])){ 
												echo wp_kses_post($cron_fn_option['footer_copyright']);

											}else{ 
												esc_html_e('1934 - 2018 Cron, LCC. All rights reserved. Theme has been designed by Frenify', 'cron');
											}
										?>
									</p>
								</div>
								<?php }?>

								<?php if($totop_switch !== 'disable'){ ?>
								<a class="cron_fn_totop">
									<span class="top"></span>
									<span class="text">
										<?php 
											if(isset($cron_fn_option['totop_text'])){ 
												echo wp_kses_post($cron_fn_option['totop_text']);
											}else{ 
												esc_html_e('To Top', 'cron');
											} 
										?>
									</span>
								</a>
								<?php } ?>

						   </div>
						</div>
					</div>
					<!-- /BOTTOM -->

				</footer>
				<!-- /FOOTER -->
			<?php } ?>
		
		
		
		</div>
	</div>
</div>
<!-- / WRAPPER ALL -->


<?php wp_footer(); ?>
</body>
</html>