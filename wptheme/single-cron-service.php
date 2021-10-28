<?php

get_header();

global $post, $cron_fn_option;
$cron_fn_pagetitle = '';
$cron_fn_top_padding = '';
$cron_fn_bot_padding = '';
$cron_fn_page_spaces = '';
$cron_fn_pagestyle = '';

if(function_exists('rwmb_meta')){
	$cron_fn_pagetitle 			= get_post_meta(get_the_ID(),'cron_fn_page_title', true);
	$cron_fn_top_padding 		= get_post_meta(get_the_ID(),'cron_fn_page_padding_top', true);
	$cron_fn_bot_padding 		= get_post_meta(get_the_ID(),'cron_fn_page_padding_bottom', true);
	
	$cron_fn_page_spaces = 'style=';
	if($cron_fn_top_padding != ''){$cron_fn_page_spaces .= 'padding-top:'.$cron_fn_top_padding.'px;';}
	if($cron_fn_bot_padding != ''){$cron_fn_page_spaces .= 'padding-bottom:'.$cron_fn_bot_padding.'px;';}
	if($cron_fn_top_padding == '' && $cron_fn_bot_padding == ''){$cron_fn_page_spaces = '';}
	
	// page styles
	$cron_fn_pagestyle 			= get_post_meta(get_the_ID(),'cron_fn_page_style', true);
}
// CHeck if page is password protected	
if(post_password_required($post)){
	echo '<div class="cron_fn_password_protected">
		 	<div class="in">
				<div>
					<div class="message_holder">
						'.get_the_password_form().'
						<div class="icon_holder"><i class="xcon-lock"></i></div>
					</div>
				</div>
		  	</div>
		  </div>';
}
else
{

?>
<div class="cron_fn_all_pages_content service_single">


	<!-- ALL PAGES -->		
	<div class="cron_fn_all_pages">
		<div class="cron_fn_all_pages_inner">
			<?php if($cron_fn_pagetitle !== 'disable'){ ?>
				<!-- PAGE TITLE -->
				<div class="container">
					<div class="cron_fn_pagetitle">
						<div class="title_holder">
							<h3><?php the_title(); ?></h3>
							<?php cron_fn_breadcrumbs();?>
						</div>
					</div>
				</div>
				<!-- /PAGE TITLE -->
			<?php } ?>

			<!-- WITH SIDEBAR -->
			<div class="cron_fn_sidebarpage">
				<div class="container">
					<div class="s_inner">

						<div class="cron_fn_leftsidebar" <?php echo esc_attr($cron_fn_page_spaces); ?>>
								
								
								<div class="lp_inner">
									<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

										<?php $postid 		= get_the_ID(); ?>
										<?php the_content(); ?>

										<?php if ( comments_open() || get_comments_number()){?>
										<!-- Comments -->
										<div class="cron_fn_comment" id="comments">
											<?php comments_template(); ?>
										</div>
										<!-- /Comments -->

									<?php } ?>
								</div>


								
										<?php
											// QUERY ARGUMENTS
											$other_services_perpage = 2;
											$query_args = array(
												'post_type' 			=> 'cron-service',
												'posts_per_page' 		=> $other_services_perpage,
												'post_status' 			=> 'publish',
												'orderby'				=> 'rand',
												'post__not_in'			=> array($postid)
											);
											// QUERY WITH ARGUMENTS
											$cron_fn_loop 	= new WP_Query($query_args);
 											$randomList		= '';
											if ($cron_fn_loop->have_posts()) : while ($cron_fn_loop->have_posts()) : $cron_fn_loop->the_post();
 
 											$randomList 	.= '<li>
																	<div class="item">
																		<div class="title">
																			<h3><a href="'.get_the_permalink().'">'.get_the_title().'</a></h3>
																			<p>'.cron_fn_excerpt(22,get_the_id()).'</p>
																		</div>
																		<div class="read_more">
																			<a href="'.get_the_permalink().'">'.esc_html__('Read More', 'cron').'</a>
																		</div>
																	</div>
																</li>';
										?>
										
									<?php endwhile; endif;?>
											
										<?php 
 											if($randomList != ''){ ?>
											<div class="other_services">
												<h3><?php esc_html_e('Other Services', 'cron');?></h3>
												<div class="os_list">
													<ul>
										<?php 
												echo wp_kses_post($randomList);?>
													</ul>
												</div>
											</div>
										<?php 
											}
										?>
						</div>

						<div class="cron_fn_rightsidebar" <?php echo esc_attr($cron_fn_page_spaces); ?>>
							<?php
								$commonClass 	= 'fn-service-'.$postid;
							?>
							<?php cron_fn_service_single_list(esc_attr($commonClass));?>
							<?php get_sidebar(); ?>
						</div>
					</div>
				</div>
			</div>
			<!-- /WITH SIDEBAR -->

			<?php endwhile; endif; ?>
		</div>
	</div>		
	<!-- /ALL PAGES -->
</div>
<?php } ?>

<?php get_footer(); ?>  