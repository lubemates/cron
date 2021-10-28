<?php

get_header();

global $post, $cron_fn_option;


$cron_fn_post_type = '';
if(isset($_GET['post_type'])) {
	$cron_fn_post_type = $_GET['post_type'];
}

?>
        
        
        
<!-- MAIN CONTENT -->
<section class="cron_fn_content">

	<div class="container"> 


		<!-- SEARCH -->
		
		<div class="cron_fn_pagetitle index_page">
			<div class="title_holder">
				<h3><?php printf( esc_html__('Search results for "%s"', 'cron'), get_search_query() ); ?></h3>
			</div>
			
		</div>
		
		
		<div class="cron_fn_searchpagelist">
			<?php if (have_posts()){ ?>
				<?php while (have_posts()) : the_post(); ?>
				<article  id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="cron_fn_searchpagelist_item">
						<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
						<span class="sub"><span><?php the_time(get_option('date_format')); ?></span></span>
						<?php 
							$thecontent = get_the_content();	
							if(!empty($thecontent)){?>
								<p><?php echo cron_fn_excerpt(60,get_the_id());?></p>
						<?php }?>
						<a href="<?php the_permalink(); ?>" class="read_more"><?php esc_html_e('Read More', 'cron') ?></a>
					</div>
				</article>
				<?php endwhile; ?>
			<?php 
			}else{
				$cron_fn_gotohome2 = '<a class="for_icon" title="'.esc_attr__('Go Home', 'cron').'" href="'.esc_url(home_url('/')).'"></a>';
				$inputSearch = '<div class="search2">
					<form action="'.esc_url(home_url("/")).'" method="get" >
						<input type="text"  placeholder="'.esc_attr__("Search", "cron").'..." class="ft" name="s"/>

						<input type="submit" value="" class="fs">

						<a class="fn_search" href="#"><img class="cron_fn_svg" src="'. get_template_directory_uri().'/framework/svg/search.svg" alt="'.esc_attr__("svg", "cron").'" /></a>
					</form>
				</div>';
				printf('<div class="cron_fn_searchpage_nothing"><div><p>%s</p><div>%s%s</div></div></div>', esc_html__('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'cron'), $inputSearch, $cron_fn_gotohome2);
			}
			?>
		</div>

		<?php cron_fn_pagination(); wp_reset_postdata();	?>

		<!-- /SEARCH -->

	</div>    
</section>
<!-- /MAIN CONTENT -->
        
<?php get_footer('null'); ?>   