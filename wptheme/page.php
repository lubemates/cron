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
<div class="cron_fn_all_pages_content">


	<!-- ALL PAGES -->		
	<div class="cron_fn_all_pages">
		<div class="cron_fn_all_pages_inner">

			<?php if($cron_fn_pagestyle == 'full' || $cron_fn_pagestyle == ''){ ?>

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
					
						
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<?php the_content(); ?>
							<div class="fn_link_pages">
								<?php wp_link_pages(
									array(
										'before'      => '<div class="cron_fn_pagelinks"><span class="title">' . __( 'Pages:', 'cron' ). '</span>',
										'after'       => '</div>',
										'link_before' => '<span class="number">',
										'link_after'  => '</span>',
									)
								); ?>
							</div>
							<?php if ( comments_open() || get_comments_number()){?>
							<!-- Comments -->
							<div class="cron_fn_comment" id="comments">
								<?php comments_template(); ?>
							</div>
							<!-- /Comments -->
							<?php } ?>

						<?php endwhile; endif; ?>

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
							</div>
							<?php cron_fn_breadcrumbs();?>
						</div>
						<!-- /PAGE TITLE -->
					<?php } ?>
					<div class="s_inner">

						<div class="cron_fn_leftsidebar" <?php echo esc_attr($cron_fn_page_spaces); ?>>
							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

								<?php the_content(); ?>

								<?php if ( comments_open() || get_comments_number()){?>
								<!-- Comments -->
								<div class="cron_fn_comment" id="comments">
									<?php comments_template(); ?>
								</div>
								<!-- /Comments -->
							<?php } ?>

							<?php endwhile; endif; ?>
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