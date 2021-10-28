<?php
/*
	Template Name: Blog Page
*/
get_header();

global $post, $cron_fn_option;
$cron_fn_pagetitle = '';
$cron_fn_top_padding = '';
$cron_fn_bot_padding = '';
$cron_fn_page_spaces = '';
$cron_fn_pagestyle = 'ws';

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
if(isset($_GET['blog_layout'])){$cron_fn_pagestyle = $_GET['blog_layout'];}


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
<div class="cron_fn_all_pages_content fn_blogpage">


	<!-- ALL PAGES -->		
	<div class="cron_fn_all_pages">
		<div class="cron_fn_all_pages_inner">

			<?php if($cron_fn_pagestyle == 'full'){ ?>

			<!-- WITHOUT SIDEBAR -->
			<div class="cron_fn_without_sidebar_page">	
				<div class="container">
					<?php if($cron_fn_pagetitle !== 'disable'){ ?>
						<!-- PAGE TITLE -->
						<div class="cron_fn_pagetitle">
							<div class="title_holder">
								<h3><?php the_title(); ?></h3>
								<?php cron_fn_breadcrumbs();?>
							</div>
						</div>
						<!-- /PAGE TITLE -->
					<?php } ?>

					<div class="inner" <?php echo esc_attr($cron_fn_page_spaces); ?>>

						<ul class="cron_fn_postlist">

							<?php 
								if(is_front_page()) { $cron_fn_paged = (get_query_var('page')) ? get_query_var('page') : 1;	} else { $cron_fn_paged = (get_query_var('paged')) ? get_query_var('paged') : 1;}
								query_posts('posts_per_page=&paged='.esc_html($cron_fn_paged)); 

								if (have_posts()) : while (have_posts()) : the_post();
							?>
							<li id="post-<?php the_ID(); ?>">
								<div <?php post_class(); ?>>
									
									<div class="img_holder">
										<a href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail('full');?>
										</a>
										<span class="shape1"></span>
										<span class="shape2"></span>
									</div>
									<div class="content_holder">
										<div class="info_holder">
											<p class="t_header">
												<span class="t_author">
												<?php esc_html_e('By ', 'cron');?>
												<a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID')));?>">
												<?php echo esc_html(get_the_author_meta('user_nicename'));?></a>
												</span>
												<span class="t_category">
												<?php esc_html_e('In ', 'cron');?>
												<?php echo cron_fn_taxanomy_list(get_the_id(), 'category', true, 1)?>
												</span>
												<span class="t_date">
												<?php esc_html_e('On ', 'cron');?>
												<?php the_time(get_option('date_format'));?>
												</span>
											</p>
										</div>
										<div class="title">
											<h3>
												<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
											</h3>
										</div>
										<div class="excerpt_holder">
											<p><?php echo cron_fn_excerpt(30,get_the_id()); ?></p>
										</div>
										<div class="read_holder">
											<p>
												<a href="<?php the_permalink(); ?>"><?php esc_html_e('Read More', 'cron'); ?></a>
											</p>
										</div>
									</div>
								</div>
							</li>
							<?php endwhile; endif; wp_reset_postdata();?>

						</ul>
						<div class="clearfix"></div>
						<?php cron_fn_pagination(); ?>

					</div>
				</div>
			</div>
			<!-- /WITHOUT SIDEBAR -->

			<?php }else{ ?>

			<!-- WITH SIDEBAR -->
			<div class="cron_fn_sidebarpage">
				<div class="container">
					<?php if($cron_fn_pagetitle !== 'disable'){ ?>
						<!-- PAGE TITLE -->
						<div class="cron_fn_pagetitle">
							<div class="title_holder">
								<h3><?php the_title(); ?></h3>
								<?php cron_fn_breadcrumbs();?>
							</div>
						</div>
						<!-- /PAGE TITLE -->
					<?php } ?>
					<div class="s_inner">

						<div class="cron_fn_leftsidebar" <?php echo esc_attr($cron_fn_page_spaces); ?>>
							<ul class="cron_fn_postlist">

								<?php 
									if(is_front_page()) { $cron_fn_paged = (get_query_var('page')) ? get_query_var('page') : 1;	} else { $cron_fn_paged = (get_query_var('paged')) ? get_query_var('paged') : 1;}
									query_posts('posts_per_page=&paged='.esc_html($cron_fn_paged)); 

									if (have_posts()) : while (have_posts()) : the_post();
								?>
								<li id="post-<?php the_ID(); ?>">
									<div <?php post_class(); ?>>
										
										<div class="img_holder">
											<a href="<?php the_permalink(); ?>">
												<?php the_post_thumbnail('full');?>
											</a>
											<span class="shape1"></span>
											<span class="shape2"></span>
										</div>
										<div class="content_holder">
											<div class="info_holder">
												<p class="t_header">
													<span class="t_author">
													<?php esc_html_e('By ', 'cron');?>
													<a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID')));?>">
													<?php echo esc_html(get_the_author_meta('user_nicename'));?></a>
													</span>
													<span class="t_category">
													<?php esc_html_e('In ', 'cron');?>
													<?php echo cron_fn_taxanomy_list(get_the_id(), 'category', true, 1)?>
													</span>
													<span class="t_date">
													<?php esc_html_e('On ', 'cron');?>
													<?php the_time(get_option('date_format'));?>
													</span>
												</p>
											</div>
											<div class="title">
												<h3>
													<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
												</h3>
											</div>
											<div class="excerpt_holder">
												<p><?php echo cron_fn_excerpt(30,get_the_id()); ?></p>
											</div>
											<div class="read_holder">
												<p>
													<a href="<?php the_permalink(); ?>"><?php esc_html_e('Read More', 'cron'); ?></a>
												</p>
											</div>
										</div>
									</div>
								</li>
								<?php endwhile; endif; wp_reset_postdata();?>

							</ul>

							<?php cron_fn_pagination(); ?>
						</div>

						<div class="cron_fn_rightsidebar" <?php echo esc_attr($cron_fn_page_spaces); ?>>
							<?php get_sidebar(); ?>
						</div>
					</div>
				</div>
			</div>
			<!-- /WITH SIDEBAR -->

			<?php } ?>
		</div>
	</div>		
	<!-- /ALL PAGES -->
</div>
<?php } ?>

<?php get_footer(); ?>  