/*!
 * Documenter 2.0
 * http://rxa.li/documenter
 *
 * Copyright 2011, Xaver Birsak
 * http://revaxarts.com
 *
 */
 
jQuery(document).ready(function() {
	"use strict";
	// ACCORDION
	jQuery(".buildify_fn_accordion").buildify_fn_accordion({
		showIcon: false, //boolean	
		animation: true, //boolean
		closeAble: true, //boolean
        slideSpeed: 200 //integer, miliseconds
	});
	jQuery('.frenify_fn_documentation_anchors').onePageNav();
	
});