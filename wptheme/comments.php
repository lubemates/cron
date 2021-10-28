<?php // Custom Comment template
function cron_fn_comment( $comment, $args, $depth ) {
   $GLOBALS['comment'] = $comment; 
   	switch ( $comment->comment_type ) {
		case 'pingback' :
		case 'trackback' : ?> <li class="post pingback"><div><p><?php esc_html_e( 'Pingback:', 'cron' ); ?> <?php esc_url(comment_author_link()); ?><?php edit_comment_link( esc_html__( 'Edit', 'cron' ), '<span class="edit-link">', '</span>' ); ?></p></div></li><?php
		break;
			
		default :

    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
        <div id="comment-<?php comment_ID(); ?>" class="comment-body">
            <div class="comment-avatar"><?php echo get_avatar( $comment, $size='80' ); ?></div>
            <div class="commment-text-wrap">
            	
                <div class="comment-data">
					<p>
						<span class="author"><?php esc_url(comment_author_link()) ?></span> 
						<span class="time"><?php esc_html_e('at ', 'cron'); printf('%3$s', get_comment_time('g:i a'), get_comment_ID(), get_comment_date('g:i a, F j, Y') );?></span>
						<span class="fn_reply">
							<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'])));  edit_comment_link(esc_html__('edit', 'cron'),'&nbsp;','');?>
                    	</span>
					</p>
				</div>
                
                
                <div class="comment-text">
                	<?php if ($comment->comment_approved == '0') : ?>
                    <span class="waiting"><?php esc_html_e('Your comment is awaiting moderation', 'cron') ?></span>
                    <?php endif; ?>
                    <?php comment_text() ?>
                    
                </div>
            </div>
        </div>
    
<?php }} ?>

<?php
// Do not delete these lines

	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php esc_html_e('This post is password protected. Enter the password to view comments.', 'cron'); ?></p>
	<?php
		return;
	}
?>

<!-- You can start editing here. -->

<?php if ( have_comments() ) : ?>
	<div class="comment_list">
		<?php if(wp_count_comments() !== 0){?>
			<h3 class="comment-title"><?php comments_number( '0', esc_html__( 'One Comment', 'cron' ), esc_html__( '% Comments', 'cron' ) );?> <?php //echo esc_html__('Comments', 'cron') ?></h3>
		<?php }?>
		<ul class="commentlist">
			<?php wp_list_comments('type=all&callback=cron_fn_comment'); ?>
		</ul>
	</div>
    <?php
		// Are there comments to navigate through?
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
	?>
	<nav class="comment-navigation">
		<div class="nav-previous"><?php previous_comments_link( __( 'Older Comments', 'cron' ) ); ?></div>
		<div class="nav-next"><?php next_comments_link( __( 'Newer Comments', 'cron' ) ); ?></div>
	</nav><!-- .comment-navigation -->
	<?php endif; // Check for comment navigation ?>

<?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : ?>
		<!-- If comments are open, but there are no comments. -->
	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p class="nocomments"><?php esc_html_e('Comments are closed.', 'cron'); ?></p>

	<?php endif; ?>
<?php endif; ?>


<?php 
	$comment_form = array( 
		'fields' => apply_filters( 'comment_form_default_fields', array(
			'author' => '<div class="input-holder input-name"><div class="input"><input  placeholder="'.esc_attr__('Name', 'cron').'" class="com-text" id="author" name="author" type="text"  value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" tabindex="1" /></div></div>',
						
			'email'  => '<div class="input-holder input-email"><div class="input"><input  placeholder="'.esc_attr__('Email', 'cron').'" class="com-text" id="emailme" name="email" type="text"  value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" tabindex="2" /></div></div>',
						
			'url'    => '<div class="input-holder input-url"><div class="input"><input placeholder="'.esc_attr__('URL', 'cron').'" class="com-text" id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" tabindex="3" /></div></div>',)),
			
			'comment_field' => '<div class="input-holder"><textarea id="comment" placeholder="'.esc_attr__('Comment', 'cron').'" name="comment" aria-required="true" rows="10"></textarea></div>',
			'comment_notes_before' => '',
			'comment_notes_after' => '',
			'title_reply'=>'<span class="comment-title">'. esc_html__('Leave a comment', 'cron') .'</span>'
	);
	comment_form($comment_form, $post->ID);
?>