<?php
/**
 * Skin
**/
if ( function_exists( 'get_field' ) ) {
	/**
	 * Dark Version
	 */

	$theme_ui = get_field( 'theme_ui', 'option' );

	if ( $theme_ui ) {
		function arter_light_stylesheets() {
			wp_enqueue_style( 'arter-light', get_template_directory_uri() . '/assets/css/light.css', '1.0' );
		}
		add_action( 'wp_enqueue_scripts', 'arter_light_stylesheets', 10 );
	}
}

function arter_skin() {
	$theme_ui = get_field( 'theme_ui', 'option' );
	$theme_color = get_field( 'theme_color', 'options' );
	$heading_color = get_field( 'heading_color', 'options' );
	$text_color = get_field( 'text_color', 'options' );
	$menu_font_color = get_field( 'menu_font_color', 'options' );
	
	$heading_font_family = get_field( 'heading_font_family', 'options' );
	$text_font_family = get_field( 'text_font_family', 'options' );
	$menu_font_family = get_field( 'menu_font_family', 'options' );

	$heading_font_size = get_field( 'heading_font_size', 'options' );
	$text_font_size = get_field( 'text_font_size', 'options' );
	$menu_font_size = get_field( 'menu_font_size', 'options' );

	if ( $theme_ui ) {
		$heading_color = get_field( 'heading_light_color', 'options' );
		$text_color = get_field( 'text_light_color', 'options' );
		$menu_font_color = get_field( 'menu_font_light_color', 'options' );
	}
?>

<style>
	<?php if ( $heading_color ) : ?>
	/* Heading Color */
	h1,
	h2,
	h3,
	h4,
	h5,
	h6,
	.art-banner .art-banner-overlay .art-banner-title h1,
	.content-sidebar .widget-title {
		color: <?php echo esc_attr( $heading_color ); ?>;
	}
	@media (max-width: 1600px) {
		.art-banner .art-banner-overlay .art-banner-title h1 {
			color: <?php echo esc_attr( $heading_color ); ?>;
		}
	}
	@media (max-width: 1400px) {
		.art-banner .art-banner-overlay .art-banner-title h1 {
			color: <?php echo esc_attr( $heading_color ); ?>;
		}
	}
	@media (max-width: 920px) {
		.art-banner .art-banner-overlay .art-banner-title h1 {
			color: <?php echo esc_attr( $heading_color ); ?>;
		}
	}
	<?php endif; ?>

	<?php if ( $heading_font_family ) : ?>
	/* Heading Font Family */
	h1,
	h2,
	h3,
	h4,
	h5,
	h6,
	.art-banner .art-banner-overlay .art-banner-title h1,
	.content-sidebar .widget-title {
		font-family: '<?php echo esc_attr( $heading_font_family['font_name'] ); ?>';
	}
	<?php endif; ?>

	<?php if ( $heading_font_size ) : ?>
	/* Heading Font Size */
	h3,
	h4,
	.art-banner .art-banner-overlay .art-banner-title h1,
	.content-sidebar .widget-title {
		font-size: <?php echo esc_attr( $heading_font_size ); ?>px;
	}
	<?php endif; ?>

	<?php if ( $text_color ) : ?>
	/* Text Color */
	body,
	a,
	.art-table,
	.art-link,
	.art-preloader .art-preloader-content .art-preloader-load .progressbar-text,
	.art-info-bar .art-header .art-avatar .art-lamp-light .art-available-lamp:after,
	.art-info-bar .art-lang-skills .art-lang-skills-item .art-cirkle-progress .progressbar-text,
	.art-info-bar .art-hard-skills .art-hard-skills-item .art-line-progress .progressbar-text,
	.art-info-bar .art-knowledge-list li,
	.art-info-bar .art-ls-social a,
	.art-menu-bar nav .main-menu .menu-item a,
	.art-menu-bar nav .main-menu .menu-item.current-menu-item .sub-menu .menu-item a,
	.art-menu-bar nav .main-menu .menu-item.current-menu-parent .sub-menu .menu-item a,
	.art-contact-form label,
	.art-pagination span.dots,
	.footer,
	.art-filter a,
	.wp-block-categories-list li, .wp-block-archives-list li, .widget.widget_nav_menu ul li, .widget.widget_pages ul li, .widget_categories ul li,
	.comment-info,
	.art-blog-card .art-project-category {
		color: <?php echo esc_attr( $text_color ); ?>;
	}
	.art-menu-bar-btn span,
	.art-menu-bar-btn span:after,
	.art-menu-bar-btn span:before,
	.art-slider-navigation .swiper-pagination-bullet {
		background: <?php echo esc_attr( $text_color ); ?>;
	}
	<?php endif; ?>

	<?php if ( $text_font_family ) : ?>
	/* Text Font Family */
	body,
	.art-counter-frame .art-counter-box .art-counter,
	.art-counter-frame .art-counter-box .art-counter-plus {
		font-family: '<?php echo esc_attr( $text_font_family['font_name'] ); ?>';
	}
	<?php endif; ?>

	<?php if ( $text_font_size ) : ?>
	/* Text Font Size */
	body,
	h6,
	.content-sidebar select, .wp-block-archives-dropdown select, .wp-block-categories select
	.art-table,
	.art-table ul li strong,
	.art-price .art-price-body .art-price-cost .art-number span.art-number-span,
	.content-sidebar table caption,
	.content-sidebar th,
	.content-sidebar td,
	.single-post-text table th,
	.single-post-text table td,
	.single-post-text table caption,
	.wp-caption,
	.wp-caption-text,
	.wp-block-image figcaption,
	.wp-block-video figcaption,
	.wp-block-embed figcaption,
	.comment-reply-link:after,
	.post-comments .post-comment .desc .name,
	a.rsswidget,
	.rss-date,
	.widget_rss cite,
	blockquote cite,
	pre.wp-block-code, pre {
		font-size: <?php echo esc_attr( $text_font_size ); ?>px;
	}
	<?php endif; ?>

	<?php if ( $menu_font_color ) : ?>
	/* Menu Color */
	.art-menu-bar nav .main-menu,
	.art-menu-bar nav .main-menu .menu-item a {
		color: <?php echo esc_attr( $menu_font_color ); ?>;
	}
	<?php endif; ?>

	<?php if ( $menu_font_family ) : ?>
	/* Menu Font Family */
	.art-menu-bar nav .main-menu,
	.art-menu-bar nav .main-menu .menu-item a {
		font-family: '<?php echo esc_attr( $menu_font_family['font_name'] ); ?>';
	}
	<?php endif; ?>

	<?php if ( $menu_font_size ) : ?>
	/* Menu Font Size */
	.art-menu-bar nav .main-menu,
	.art-menu-bar nav .main-menu .menu-item a {
		font-size: <?php echo esc_attr( $menu_font_size ); ?>px;
	}
	<?php endif; ?>

	<?php if ( $theme_color ) : ?>
	/* Theme Color */
	.art-btn,
	.art-info-bar .art-header .art-avatar .art-lamp-light .art-available-lamp,
	.art-menu-bar .art-language-change li.art-active-lang,
	.art-price.art-popular-price:before,
	.art-slider-navigation .swiper-pagination-bullet.swiper-pagination-bullet-active,
	.art-contact-form .art-input.art-active+label,
	.art-contact-form .art-input:focus+label,
	.art-contact-form label.focused,
	.content-sidebar td#today,
	.single-post-text table td#today,
	.single-post-text ul>li:before,
	.comment-text ul>li:before,
	.comment-form .btn.fill, form.post-password-form input[type="submit"],
	.sticky:before,
	.wp-block-button a.wp-block-button__link,
	.wp-block-button.is-style-outline a.wp-block-button__link,
	.art-menu-bar .cart-btn .cart-icon .cart-count,
	.woocommerce #respond input#submit, 
	.woocommerce a.button, 
	.woocommerce button.button, 
	.woocommerce input.button
	.woocommerce-mini-cart__buttons #respond input#submit, 
	.woocommerce-mini-cart__buttons a.button, 
	.woocommerce-mini-cart__buttons button.button, 
	.woocommerce-mini-cart__buttons input.button,
	.woocommerce #respond input#submit:hover, 
	.woocommerce a.button:hover, 
	.woocommerce button.button:hover, 
	.woocommerce input.button:hover
	.woocommerce-mini-cart__buttons #respond input#submit:hover, 
	.woocommerce-mini-cart__buttons a.button:hover, 
	.woocommerce-mini-cart__buttons button.button:hover, 
	.woocommerce-mini-cart__buttons input.button:hover,
	.woocommerce span.onsale, 
	.woocommerce #respond input#submit.alt, 
	.woocommerce a.button.alt, 
	.woocommerce button.button.alt, 
	.woocommerce input.button.alt,
	.woocommerce div.product .woocommerce-tabs ul.tabs li.active a,
	.woocommerce-MyAccount-navigation li.woocommerce-MyAccount-navigation-link.is-active a {
		background-color: <?php echo esc_attr( $theme_color ); ?>;
	}
	.art-link.art-color-link,
	.art-link.art-color-link:hover,
	.art-info-bar .art-name:hover a,
	.art-info-bar .art-knowledge-list li:before,
	.art-code i,
	.art-counter-frame .art-counter-box .art-counter,
	.art-counter-frame .art-counter-box .art-counter-plus,
	.art-price .art-price-body .art-price-cost .art-number,
	.art-price .art-price-body .art-price-list ul li:before,
	.art-price .art-price-body .art-price-list ul li.art-empty-item:before,
	.art-testimonial .art-testimonial-footer .art-star-rate,
	.post-page-numbers.current,
	.art-pagination span,
	.art-pagination a.next,
	.art-pagination a.prev,
	.art-pagination a.next:hover,
	.art-pagination a.prev:hover,
	.single-post-text p a,
	.comment-text p a,
	.post-text-bottom span.cat-links a,
	.post-text-bottom .tags-links a,
	.post-text-bottom .tags-links span,
	.content-sidebar .tagcloud a,
	.wp-block-tag-cloud .tag-cloud-link,
	.content-sidebar a:hover,
	.wp-block-button.is-style-outline a.wp-block-button__link,
	.error-page__num,
	.woocommerce-mini-cart__buttons #respond input#submit, 
	.woocommerce-mini-cart__buttons a.button, 
	.woocommerce-mini-cart__buttons button.button, 
	.woocommerce-mini-cart__buttons input.button, 
	.woocommerce .star-rating, 
	.woocommerce p.stars a,
	.art-info-bar .art-knowledge-list li i {
		color: <?php echo esc_attr( $theme_color ); ?>;
	}
	.art-custom-list li:before,
	.art-timeline .art-timeline-item .art-timeline-mark,
	.art-form-field textarea.art-active,
	.art-form-field textarea:focus,
	.post-text-bottom .tags-links a,
	.post-text-bottom .tags-links span,
	.content-sidebar .tagcloud a,
	.wp-block-tag-cloud .tag-cloud-link,
	.wp-block-pullquote blockquote {
		border-color: <?php echo esc_attr( $theme_color ); ?>;
	}
	.art-preloader-load path:last-child,
	.art-line-progress path:last-child,
	.art-cirkle-progress path:last-child {
		stroke: <?php echo esc_attr( $theme_color ); ?>;
	}
	<?php endif; ?>

</style>

<?php
}
add_action( 'wp_head', 'arter_skin', 10 );