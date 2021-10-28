<?php
/*
	Template Name: Service Page
*/
get_header();

global $post, $cron_fn_option;
$cron_fn_pagetitle = '';
$cron_fn_top_padding = '';
$cron_fn_bot_padding = '';
$cron_fn_page_spaces = '';

if(function_exists('rwmb_meta')){
	$cron_fn_pagetitle 			= get_post_meta(get_the_ID(),'cron_fn_page_title', true);
	$cron_fn_top_padding 		= get_post_meta(get_the_ID(),'cron_fn_page_padding_top', true);
	$cron_fn_bot_padding 		= get_post_meta(get_the_ID(),'cron_fn_page_padding_bottom', true);
	
	$cron_fn_page_spaces = 'style=';
	if($cron_fn_top_padding != ''){$cron_fn_page_spaces .= 'padding-top:'.$cron_fn_top_padding.'px;';}
	if($cron_fn_bot_padding != ''){$cron_fn_page_spaces .= 'padding-bottom:'.$cron_fn_bot_padding.'px;';}
	if($cron_fn_top_padding == '' && $cron_fn_bot_padding == ''){$cron_fn_page_spaces = '';}
	
}
// QUERY ARGUMENTS
if(isset($cron_fn_option['service_perpage'])){
	$cron_fn_service_perpage = $cron_fn_option['service_perpage'];
}else{
	$cron_fn_service_perpage = 6;
}

if(is_front_page()) { $paged = (get_query_var('page')) ? get_query_var('page') : 1;	} else { $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;}
$query_args = array(
	'post_type' 			=> 'cron-service', 
	'paged' 				=> $paged, 
	'posts_per_page' 		=> $cron_fn_service_perpage,
	'post_status' 			=> 'publish',
);
// QUERY WITH ARGUMENTS
$cron_fn_loop = new WP_Query($query_args);

if(isset($cron_fn_option['service_layout'])){
	$service_layout = $cron_fn_option['service_layout'];
}else{
	$service_layout = 'list';
}
if(isset($_GET['service_layout'])){$service_layout = $_GET['service_layout'];}


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
<div class="cron_fn_all_pages_content service_layout_<?php echo esc_attr($service_layout);?>">
	<?php if($cron_fn_pagetitle !== 'disable'){ ?>
		<!-- PAGE TITLE -->
		<div class="cron_fn_pagetitle">
			<div class="container">
				<div class="title_holder">
					<h3><?php the_title(); ?></h3>
					<?php cron_fn_breadcrumbs();?>
				</div>
			</div>
		</div>
		<!-- /PAGE TITLE -->
	<?php } ?>
	
	<!-- ALL PAGES -->		
	<div class="cron_fn_all_pages">
		<div>
			<div class="cron_fn_all_pages_inner">
				
				<?php if($service_layout === 'masonry'){ ?>
				<!-- WITHOUT SIDEBAR -->
				<div class="cron_fn_without_sidebar_page" <?php echo esc_attr($cron_fn_page_spaces); ?>>
					<div class="inner">
						
						<div class="cron_fn_service_page">
							
							<!-- SERVICE LIST -->
							<div class="service_list">
								<div class="container">
									<ul class="cron_fn_service_list cron_fn_masonry">
										<?php 
											if ($cron_fn_loop->have_posts()) : while ($cron_fn_loop->have_posts()) : $cron_fn_loop->the_post(); 

											$imageURL = NULL;
											$imageURL = get_the_post_thumbnail_url(get_the_id(),'cron_fn_thumb-800-800');
											if($imageURL == '' || $imageURL == 'undefined' || $imageURL == 'unknown'){
												$noImg = 'no_img';
											}else{
												$noImg = 'have_img';
											}
										?>
										<li class="cron_fn_masonry_in <?php echo esc_attr($noImg);?>">
											<div class="item">
											
												<?php if($noImg === 'have_img'){ ?>
													<div class="img_holder">
														<img src="<?php echo get_template_directory_uri() .'/framework/img/thumb/thumb-560-285.jpg'; ?>" alt="<?php  esc_attr(bloginfo('description')); ?>" />
														<div class="img_abs" data-fn-bg-img="<?php echo esc_url($imageURL); ?>"></div>
														<a href="<?php the_permalink(); ?>"></a>
													</div>
												<?php } ?>

												<div class="title_holder">
													<div class="title_in">
														<div class="title">
															<h3><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h3>
															<p><?php echo cron_fn_excerpt(25,get_the_id()); ?></p>
														</div>
														<div class="read_more">
															<a href="<?php the_permalink(); ?>"><?php esc_html_e('Read More', 'cron'); ?></a>
														</div>
													</div>
													<span class="roof"></span>
												</div>
												
											</div>
										</li>
										<?php endwhile; endif;?>
									</ul>
								</div>
							</div>
							<!-- /SERVICE LIST -->
							
							<div class="container">
								<?php cron_fn_pagination($cron_fn_loop->max_num_pages); wp_reset_postdata();?>
							</div>
						</div>

					</div>					
				</div>
				<!-- /WITHOUT SIDEBAR -->
				<?php }else{ ?>
				
				<div class="cron_fn_sidebarpage">
					<div class="container">
						<div class="s_inner">

							<div class="cron_fn_leftsidebar" <?php echo esc_attr($cron_fn_page_spaces); ?>>
								
								<div class="default_service_content">
									<?php
										while ( have_posts() ) : the_post();
										the_content();
										endwhile; 
										wp_reset_query(); 
									?>
								</div>
								
								<div class="clearfix"></div>
								
								<ul class="cron_fn_service_list_default">
									<?php 
										if ($cron_fn_loop->have_posts()) : while ($cron_fn_loop->have_posts()) : $cron_fn_loop->the_post(); 

										$imageURL = NULL;
										$imageURL = get_the_post_thumbnail_url(get_the_id(),'cron_fn_thumb-800-800');
										if($imageURL == '' || $imageURL == 'undefined' || $imageURL == 'unknown'){
											$noImg = 'no_img';
										}else{
											$noImg = 'have_img';
										}
									?>
									<li class="<?php echo esc_attr($noImg);?>">
										<div class="item">
											<div class="item_in">
												<?php if($noImg === 'have_img'){ ?>
												<div class="img_holder">
													<div class="img_abs" data-fn-bg-img="<?php echo esc_url($imageURL); ?>"></div>
													<a href="<?php the_permalink(); ?>"></a>
												</div>
												<?php } ?>
												<div class="title">
													<h3><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h3>
													<p><?php echo cron_fn_excerpt(25,get_the_id()); ?></p>
												</div>
												<div class="read_more">
													<a href="<?php the_permalink(); ?>"><?php esc_html_e('Read More', 'cron'); ?></a>
												</div>
											</div>
										</div>
									</li>
									<?php endwhile; endif;?>
								</ul>
								<div class="clearfix"></div>
								<?php cron_fn_pagination($cron_fn_loop->max_num_pages); wp_reset_postdata();?>
							</div>

							<div class="cron_fn_rightsidebar" <?php echo esc_attr($cron_fn_page_spaces); ?>>
								<?php cron_fn_service_single_list();?>
								<?php get_sidebar(); ?>
							</div>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>		
	<!-- /ALL PAGES -->
</div>
<?php } ?>

<?php get_footer(); ?>  