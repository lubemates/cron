<?php
add_action( 'wp_enqueue_scripts', 'cron_fn_enqueue_styles' );
function cron_fn_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}
?>