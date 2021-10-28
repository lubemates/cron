<?php

get_header();

global $post, $cron_fn_option;
$cron_fn_pagetitle = '';
$cron_fn_pagestyle = 'full';

if(function_exists('rwmb_meta')){
	$cron_fn_pagetitle 			= get_post_meta(get_the_ID(),'cron_fn_page_title', true);
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
<div class="cron_fn_all_pages_content blog_single_page">


	<!-- ALL PAGES -->		
	<div class="cron_fn_all_pages">
		<div class="cron_fn_all_pages_inner">

			<?php if($cron_fn_pagestyle == 'full'){ ?>

			<!-- WITHOUT SIDEBAR -->
			<div class="cron_fn_without_sidebar_page">
				<div class="container">
				<div class="inner">
					<div class="cron_fn_blog_single">
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							
							<div class="blog_single_title">
								<div class="title_holder">
									<h3><?php the_title(); ?></h3>
								</div>
								<p class="t_header">
									<span class="t_author">
									<?php esc_html_e('By ', 'cron');?>
									<a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID')));?>">
									<?php echo esc_html(get_the_author_meta('user_nicename'));?></a>
									</span>
									<span class="t_category">
									<?php esc_html_e('In ', 'cron');?>
									<?php echo cron_fn_taxanomy_list(get_the_id(), 'category', true, 999, ', ')?>
									</span>
									<span class="t_date">
									<?php esc_html_e('On ', 'cron');?>
									<?php the_time(get_option('date_format'));?>
									</span>
								</p>
							</div>
							<!-- POST HEADER -->
							<div class="post_header">
								<?php get_template_part( 'inc/post-format/format', get_post_format() );?>
							</div>
							<!-- /POST HEADER -->

							<!-- POST CONTENT -->
							<div class="post_content">

								<div class="content_holder"><?php the_content(); ?></div>
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

								<?php if(has_tag()){?>
									<div class="cron_fn_tags">
										<label><?php the_tags(esc_html_e('Tags:', 'cron').'</label>', ' '); ?>
									</div>
								<?php } ?>
							</div>
							<!-- /POST CONTENT -->
						</article>

						<?php if ( comments_open() || get_comments_number()){?>
						<!-- POST COMMENT -->
						<div class="cron_fn_comment_wrapper">

							<!-- WORDPRESS COMMENTS -->
							<div class="cron_fn_comment" id="comments">
								<?php comments_template(); ?>
							</div>
							<!-- /WORDPRESS COMMENTS -->

						</div>
						<!-- /POST COMMENT -->
						<?php } ?>

						<?php 
							endwhile; endif;
						?>
					</div>
				</div>
			</div>
			</div>
			<!-- /WITHOUT SIDEBAR -->

			<?php }else{ ?>

			<!-- WITH SIDEBAR -->
			<div class="cron_fn_sidebarpage">
				<div class="container">
					
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

					
					<div class="inner">

						<div class="cron_fn_leftsidebar">
							<div class="cron_fn_pagetitle blog_single_title">
								<div class="title_holder">
									<h3><?php the_title(); ?></h3>
								</div>
								<p class="t_header">
									<span class="t_author">
									<?php esc_html_e('By ', 'cron');?>
									<a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID')));?>">
									<?php echo esc_html(get_the_author_meta('user_nicename'));?></a>
									</span>
									<span class="t_category">
									<?php esc_html_e('In ', 'cron');?>
									<?php echo cron_fn_taxanomy_list(get_the_id(), 'category', true, 999, ', ')?>
									</span>
									<span class="t_date">
									<?php esc_html_e('On ', 'cron');?>
									<?php the_time(get_option('date_format'));?>
									</span>
								</p>
							</div>
							<div class="cron_fn_blog_single">

								<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
									
									<!-- POST HEADER -->
									<div class="post_header">
										<?php get_template_part( 'inc/post-format/format', get_post_format() );?>
									</div>
									<!-- /POST HEADER -->

									<!-- POST CONTENT -->
									<div class="post_content">

										<div class="content_holder"><?php the_content(); ?></div>
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

										<?php if(has_tag()){?>
											<div class="cron_fn_tags">
												<label><?php the_tags(esc_html_e('Tags:', 'cron').'</label>', ' '); ?>
											</div>
										<?php } ?>
									</div>
									<!-- /POST CONTENT -->
								</article>

								<?php if ( comments_open() || get_comments_number()){?>
								<!-- POST COMMENT -->
								<div class="cron_fn_comment_wrapper">

									<!-- WORDPRESS COMMENTS -->
									<div class="cron_fn_comment" id="comments">
										<?php comments_template(); ?>
									</div>
									<!-- /WORDPRESS COMMENTS -->

								</div>
								<!-- /POST COMMENT -->
								<?php } ?>

								<?php 
									endwhile; endif;
								?>
							</div>
						</div>

						<div class="cron_fn_rightsidebar">
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