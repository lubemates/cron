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

// since cron
$project_video_text = esc_html__('See Our Work Process', 'cron');
if(isset($cron_fn_option['project_video_text'])){
	$project_video_text = $cron_fn_option['project_video_text'];
}

if(isset($cron_fn_option['project_single_caption'])){
	$cron_fn_portfolio_caption = $cron_fn_option['project_single_caption'];
}else{
	$cron_fn_portfolio_caption = 'disable';
}

if(isset($cron_fn_option['project_single_layout'])){
	$portfolio_single_layout = $cron_fn_option['project_single_layout'];
}else{
	$portfolio_single_layout = 'justified';
}
if(isset($_GET['project_single_layout'])){$portfolio_single_layout = $_GET['project_single_layout'];}

// Post Thumbnail		
$postid = get_the_ID();
$post_thumbnail_id = get_post_thumbnail_id( $postid );
$src = wp_get_attachment_image_src( $post_thumbnail_id, 'cron_fn_thumb-720-9999');

// Categories
$cron_fn_post_cats = cron_fn_taxanomy_list($postid, 'project_category', false);


// CHeck if page is password protected	
if(post_password_required($post)){
	echo '<div class="cron_fn_password_protected">
		 	<div class="container">
				<div class="in">
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

if (have_posts()) : while (have_posts()) : the_post();
?>

<div class="cron_fn_all_pages_content portfolio_single">


	<!-- ALL PAGES -->		
	<div class="cron_fn_all_pages">
		<div class="cron_fn_all_pages_inner">

			
			<div class="cron_fn_portfolio_justified">
				
				<div class="j_content" <?php echo esc_attr($cron_fn_page_spaces); ?>>
					<div>
						<div class="j_content_in">
							
							<div class="content_part">
								
								<div class="content_holder">
									<?php the_content(); ?>
								</div>
								<?php 
									$prevnext		= '';
									$previous_post 	= get_adjacent_post(false, '', true);
									$next_post 		= get_adjacent_post(false, '', false);

									if ($previous_post && $next_post) { 
										$prevnext	= 'yes';
									}else if(!$previous_post && $next_post){
										$prevnext	= 'next';
									}else if($previous_post && !$next_post){
										$prevnext	= 'prev';
									}else{
										$prevnext	= 'no';
									}
								?>
								
								<!-- PREVIOUS-NEXT BOX -->
								<div class="cron_fn_prevnext" data-switch="<?php echo esc_attr($prevnext); ?>">
									<div class="container">
										<ul>
											<li class="prev"><?php $prevtext = __('Prev', 'cron'); previous_post_link( '%link',$prevtext ) ?></li>
											<li class="h_prev">
												<span><?php esc_html_e('Prev', 'cron');?></span>
											</li>
											<li class="next"><?php $nexttext = __('Next', 'cron'); next_post_link('%link',$nexttext) ?></li>
											<li class="h_next">
												<span><?php esc_html_e('Next', 'cron');?></span>
											</li>
										</ul>
									</div>
								</div>
								<!-- /PREVIOUS-NEXT BOX -->
								
							</div>
						</div>
					</div>
				</div>
				
			</div>

			<?php endwhile; endif; ?>

		</div>
	</div>		
	<!-- /ALL PAGES -->
</div>
<?php } ?>

<?php get_footer(); ?>  