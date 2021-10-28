<?php
/*
	Template Name: Full Width Page
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
		<div class="cron_fn_all_pages" <?php echo esc_attr($cron_fn_page_spaces); ?>>
			<div class="cron_fn_all_pages_inner">
				<!-- PAGE -->
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
				<!-- /PAGE -->
			</div>
		</div>		
		<!-- /ALL PAGES -->
	</div>
<?php } ?>

<?php get_footer(); ?>  