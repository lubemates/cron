<?php

get_header();

global $post, $cron_fn_option;

$curauth = get_userdata(get_query_var('author'));
$project_archive_title = esc_html__('Project Archive', 'cron');
if(isset($cron_fn_option['project_archive_title'])){
	$project_archive_title = $cron_fn_option['project_archive_title'];
}
?>
        
    
        <div class="cron_fn_content_archive cron_fn_all_pages_content">
			<div class="cron_fn_pagetitle">
				<div class="container">
					<div class="title_holder">
						<h3>
							<?php echo esc_html($project_archive_title);?>
						</h3>
						<?php cron_fn_breadcrumbs();?>
					</div>
				</div>
			</div>
			
			<div class="cron_fn_all_pages">
				<div class="container">
					<div class="cron_fn_all_pages_inner">
					
					
						<div class="cron_fn_without_sidebar_page">
							<div class="inner">
								<ul class="cron_fn_archive_list cron_fn_masonry">
								<?php
								if (have_posts()) : while (have_posts()) : the_post(); ?>
								<li class="cron_fn_masonry_in">
									<article  id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
										<div class="cron_fn_post">
										   <?php if(has_post_thumbnail()){ ?>
											<div class="img_holder">
												<a href="<?php the_permalink(); ?>">
													<?php 
														the_post_thumbnail('full');
													?>
												</a>
											</div>
											<?php } ?>
										   <div class="title_holder">
												<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
												<p><?php echo cron_fn_excerpt(22,get_the_id()); ?></p>
												<div class="read_more">
													<a href="<?php the_permalink(); ?>"><?php esc_html_e('Read More', 'cron') ?></a>
												</div>
											</div>

										</div>
									</article>
								</li><?php 

								endwhile; endif; ?>
							</ul>

							<?php cron_fn_pagination(); wp_reset_postdata(); ?>
							</div>
						</div>
						
					</div>
				</div>
			</div>
       
        </div>
		<!-- /MAIN CONTENT -->
        
<?php get_footer(); ?>   