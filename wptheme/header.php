<!DOCTYPE html >
<html <?php language_attributes(); ?>><head>
<?php 
	global $cron_fn_option, $post;	
?>

<meta charset="<?php esc_attr(bloginfo( 'charset' )); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<?php wp_head(); ?>

</head>

<body <?php body_class();?>>


<?php 
	
	// NAVIGATIONS ----------------------------------------------------------------------------------
	$main_nav 			= array('theme_location'  => 'main_menu','menu_class' => 'cron_fn_main_nav vert_nav');
	
	
	// navigation skin
	$nav_skin 			= 'light';
	if(isset($cron_fn_option['nav_skin'])){
		$nav_skin 		= $cron_fn_option['nav_skin'];
	}
	if(function_exists('rwmb_meta')){
		$nav_skin 		= get_post_meta(get_the_ID(),'cron_fn_page_nav_color', true);
		if($nav_skin === 'default' && isset($cron_fn_option['nav_skin'])){
			$nav_skin 	= $cron_fn_option['nav_skin'];
		}
	}
	if(isset($cron_fn_option['nav_skin'])){
		if($nav_skin === 'undefined' || $nav_skin === ''){
			$nav_skin 	= $cron_fn_option['nav_skin'];
		}
	}
	
	if(isset($cron_fn_option)){$cron_theme = 'cron-theme';}else{$cron_theme	= '';}
	
	$hAddress		 	= 'disable';
	$hContact		 	= 'disable';
	$hTollFree		 	= 'disable';
	$hWHours		 	= 'disable';
	$hList			 	= 'disable';
	$hSocial		 	= 'disable';
	$hRating		 	= 'disable';
	$hSwitch		 	= 'disable';
	if(isset($cron_fn_option)){
		$hAddress 		= $cron_fn_option['helpful_address'];
		$hContact 		= $cron_fn_option['helpful_contact'];
		$hTollFree 		= $cron_fn_option['helpful_tollfree'];
		$hWHours 		= $cron_fn_option['helpful_working_hours'];
		$hList	 		= $cron_fn_option['helpful_list_switch'];
		$hSocial 		= $cron_fn_option['helpful_social_switch'];
		$hRating 		= $cron_fn_option['helpful_rating_switch'];
		$hSwitch 		= $cron_fn_option['helpful_switch'];
	}
	
?>

<!-- WRAPPER ALL -->
<div class="cron_fn_wrapper_all <?php echo esc_attr($cron_theme);?>" 
	data-nav-skin="<?php echo esc_attr($nav_skin); ?>" 
	data-helpful-address="<?php echo esc_attr($hAddress); ?>" 
	data-helpful-contact="<?php echo esc_attr($hContact); ?>" 
	data-helpful-tollfree="<?php echo esc_attr($hTollFree); ?>" 
	data-helpful-whours="<?php echo esc_attr($hWHours); ?>" 
	data-helpful-list="<?php echo esc_attr($hList); ?>" 
	data-helpful-social="<?php echo esc_attr($hSocial); ?>" 
	data-helpful-rating="<?php echo esc_attr($hRating); ?>" 
	data-helpful-switch="<?php echo esc_attr($hSwitch); ?>" 
	>

	
	<!-- WRAPPER -->
	<div class="cron_fn_wrapper">
		
		<div id="cron_fn_fixedsub">
   			<ul></ul>
   		</div>
		
		<?php get_template_part('inc/templates/cron_fn_header_opener'); ?>
		
		
		<!-- LEFT PART -->
		<div class="cron_fn_leftpart">
			<?php get_template_part('inc/templates/cron_fn_leftpart'); ?>
		</div>
		<!-- /LEFT PART -->
	
	
		<div class="cron_fn_rightpart">
			
			<!-- MOBILE MENU -->
			<div class="cron_fn_mobilemenu_wrap">
				<?php get_template_part('inc/templates/cron_fn_mobilemenu'); ?>
			</div>
			<!-- /MOBILE MENU -->
			
			<!-- BACKGROUND FOR HELPFUL BAR -->
			<div class="cron_fn_bghelp"></div>
			<!-- /BACKGROUND FOR HELPFUL BAR -->
			
			
			<!-- WRAPPER for HEIGHT -->
			<div class="cron_fn_wfh">
			
				<!-- DESKTOP HEADER -->
				<?php get_template_part('inc/templates/cron_fn_desktopmenu'); ?>
				<!-- /DESKTOP HEADER -->