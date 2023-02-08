<?php
/**
 * arter functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package arter
 */

if ( ! function_exists( 'arter_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function arter_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on arter, use a find and replace
		 * to change 'arter' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'arter', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary Menu', 'arter' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Image Sizes
		add_image_size( 'arter_140x140', 140, 140, true );
		add_image_size( 'arter_256x256', 256, 256, false );
		add_image_size( 'arter_950xAuto', 950, 9999, false );
		add_image_size( 'arter_1280x768', 1280, 768, true );
		add_image_size( 'arter_1920xAuto', 1920, 9999, false );
	}
endif;
add_action( 'after_setup_theme', 'arter_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function arter_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'arter_content_width', 900 );
}
add_action( 'after_setup_theme', 'arter_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function arter_widgets_init() {
	register_sidebar( array(
		'name'		  => esc_html__( 'Sidebar', 'arter' ),
		'id'			=> 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'arter' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'arter_widgets_init' );

/**
 * Register Default Fonts
 */
function arter_fonts_url() {
	$fonts_url = '';

	/* Translators: If there are characters in your language that are not
	 * supported by Lora, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$poppins = _x( 'on', 'Poppins: on or off', 'arter' );

	if ( 'off' !== $poppins ) {
		$font_families = array();

		$font_families[] = 'Poppins:100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic';
		$font_families[] = 'Courier+Prime:400,400italic,700,700italic';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}

/**
 * Enqueue scripts and styles.
 */
function arter_stylesheets() {
	// Web fonts
	wp_enqueue_style( 'arter-fonts', arter_fonts_url(), array(), null );

	$headingsFont =  get_field( 'heading_font_family', 'options' );
	$paragraphsFont =  get_field( 'text_font_family', 'options' );

	// Custom fonts
	if ( $headingsFont ) {
		wp_enqueue_style( 'arter-heading-font', $headingsFont['url'] , array(), null );
	}
	if ( $paragraphsFont ) {
		wp_enqueue_style( 'arter-paragraph-font', $paragraphsFont['url'] , array(), null );
	}

	/*Styles*/
	wp_enqueue_style( 'arter-style', get_stylesheet_uri(), array( 'bootstrap', 'arter-fontawesome-4', 'arter-fontawesome', 'arter-swiper', 'magnific-popup' ) );
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.css', '1.0' );
	wp_enqueue_style( 'arter-fontawesome-4', get_template_directory_uri() . '/assets/fonts/font-awesome/css/font-awesome-4.7.css', '1.0' );
	wp_enqueue_style( 'arter-fontawesome', get_template_directory_uri() . '/assets/fonts/font-awesome/css/font-awesome.css', '1.0' );
	wp_enqueue_style( 'arter-swiper', get_template_directory_uri() . '/assets/css/swiper.css', '1.0' );
	wp_enqueue_style( 'magnific-popup', get_template_directory_uri() . '/assets/css/magnific-popup.css', '1.0' );
}
add_action( 'wp_enqueue_scripts', 'arter_stylesheets' );

function arter_scripts() {
	/*Default Scripts*/
	wp_enqueue_script( 'arter-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	/*Theme Scripts*/
	wp_enqueue_script( 'anime', get_template_directory_uri() . '/assets/js/anime.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'progressbar', get_template_directory_uri() . '/assets/js/progressbar.js', array('jquery'), '1.0.0', true );
	if ( get_field( 'theme_scrolling', 'option' ) ) {
		wp_enqueue_script( 'smooth-scrollbar', get_template_directory_uri() . '/assets/js/smooth-scrollbar.js', array('jquery'), '1.0.0', true );
		wp_enqueue_script( 'overscroll', get_template_directory_uri() . '/assets/js/overscroll.js', array('jquery'), '1.0.0', true );
	}
	wp_enqueue_script( 'typing', get_template_directory_uri() . '/assets/js/typing.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'imagesloaded' );
	wp_enqueue_script( 'isotope', get_template_directory_uri() . '/assets/js/isotope.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'magnific-popup', get_template_directory_uri() . '/assets/js/magnific-popup.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'swiper', get_template_directory_uri() . '/assets/js/swiper.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'rrssb', get_template_directory_uri() . '/assets/js/rrssb.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'arter-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0.0', true );

	if ( get_field( 'theme_transition', 'option' ) ) {
		$swup_url_data = array(
			'url'   => get_template_directory_uri(),
		);

		wp_enqueue_script( 'swup', get_template_directory_uri() . '/assets/js/swup.js', array('jquery'), '1.0.0', true );
		wp_enqueue_script( 'swup-body-class-plugin', get_template_directory_uri() . '/assets/js/SwupBodyClassPlugin.js', array('jquery'), '1.0.0', true );
		wp_enqueue_script( 'swup-init', get_template_directory_uri() . '/assets/js/swup-init.js', array('jquery'), '1.0.0', true );
		wp_localize_script( 'swup', 'swup_url_data', $swup_url_data );
	}
}
add_action( 'wp_enqueue_scripts', 'arter_scripts' );

/**
 * TGM
 */
require get_template_directory() . '/inc/plugins/plugins.php';

/**
 * ACF Options
 */

function arter_acf_fa_version( $version ) {
 $version = 5;
 return $version;
}
add_filter( 'ACFFA_override_major_version', 'arter_acf_fa_version' );

function arter_acf_json_load_point( $paths ) {
	$paths = array( get_template_directory() . '/inc/acf-json' );
	if( is_child_theme() ) {
		$paths[] = get_stylesheet_directory() . '/inc/acf-json';
	}

	return $paths;
}

add_filter('acf/settings/load_json', 'arter_acf_json_load_point');

if ( function_exists( 'acf_add_options_page' ) ) {
	// Hide ACF field group menu item
	add_filter( 'acf/settings/show_admin', '__return_false' );

	// Add ACF Options Page
	acf_add_options_page( array(
		'page_title' 	=> esc_html__( 'Theme Options', 'arter' ),
		'menu_title'	=> esc_html__( 'Theme Options', 'arter' ),
		'menu_slug' 	=> 'theme-options',
		'capability'	=> 'edit_theme_options',
	) );
}

function arter_acf_json_save_point( $path ) {
	// update path
	$path = get_stylesheet_directory() . '/inc/acf-json';

	// return
	return $path;
}
add_filter( 'acf/settings/save_json', 'arter_acf_json_save_point' );

function arter_acf_fallback() {
	// ACF Plugin fallback
	if ( ! is_admin() && ! function_exists( 'get_field' ) ) {
		function get_field( $field = '', $id = false ) {
			return false;
		}
		function the_field( $field = '', $id = false ) {
			return false;
		}
		function have_rows( $field = '', $id = false ) {
			return false;
		}
		function has_sub_field( $field = '', $id = false ) {
			return false;
		}
		function get_sub_field( $field = '', $id = false ) {
			return false;
		}
		function the_sub_field( $field = '', $id = false ) {
			return false;
		}
	}
}
add_action( 'init', 'arter_acf_fallback' );

/**
 * OCDI
 */
require get_template_directory() . '/inc/ocdi-setup.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Include Skin Options
 */
require get_template_directory() . '/inc/skin-options.php';

/**
 * Get Archive Title
 */

function arter_archive_title( $title ) {
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_post_type_archive( 'portfolio' ) ) {
		$title = post_type_archive_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( esc_html__( 'Tag: ', 'arter' ), false );
	} elseif ( is_author() ) {
		$title = esc_html__( 'Author: ', 'arter' ) . get_the_author();
	}

	return $title;
}
add_filter( 'get_the_archive_title', 'arter_archive_title' );

/**
 * Excerpt
 */
function arter_custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'arter_custom_excerpt_length' );

function arter_new_excerpt_more( $more ) {
	return '... <div class="art-el-more"><a href="' . esc_url( get_permalink() ) . '" class="art-link art-color-link art-w-chevron">' . esc_html__( 'Read more', 'arter' ) . '</a></div>';
}
add_filter( 'excerpt_more', 'arter_new_excerpt_more' );

/**
 * Disable CF7 Auto Paragraph
 */
add_filter('wpcf7_autop_or_not', '__return_false');

/**
 * Top Menu Horizontal
 */
class arter_Topmenu_Walker extends Walker_Nav_menu {

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		global $wp_query;

		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$class_names = '';
		if ( isset( $args->link_after ) ) {
			$args->link_after = '';
		}

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$class_names = join(' ', $classes);

	   	$class_names = ' class="'. esc_attr( $class_names ) . '"';
		$attributes = ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';

		if ( has_nav_menu( 'primary' ) ) {
			$output .= $indent . '<li id="menu-item-'. esc_attr( $item->ID ) . '"' . $class_names . '>';

			$attributes .= ! empty( $item->url && $item->url != '#.' && $item->url != '#' ) ? ' href="' . esc_url( $item->url ) . '"' : '';

			$item_output = $args->before;
			$item_output .= '<a' . $attributes . '>';
			$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID );
			$item_output .= $args->link_after;
			$item_output .= '</a>';
			$item_output .= $args->after;

			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
	}
}

/**
 * Comments
 */
if ( ! function_exists( 'arter_comment' ) ) {
	function arter_comment( $comment, $args, $depth ) {
		?>
			<li <?php comment_class( 'post-comment' ); ?> id="li-comment-<?php comment_ID(); ?>" >
				<div id="comment-<?php comment_ID(); ?>" class="comment">
					<div class="comment-image image">
						<?php
							$avatar_size = 80;
							if ( '0' != $comment->comment_parent ){
								$avatar_size = 80;
							}
							echo get_avatar( $comment, $avatar_size );
						?>
					</div>
					<div class="comment-desc desc">
						<div class="comment-name name">
							<?php comment_author_link(); ?>
						</div>
						<div class="comment-text">
							<div class="single-post-text">
								<?php comment_text(); ?>
							</div>
						</div>
						<div class="comment-info">
							<span class="comment-time"><?php comment_time(); ?></span>
							<span class="comment-date"><?php comment_date(); ?></span>
							<span class="comment-reply">
								<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
							</span>
						</div>
					</div>
				</div>

		<?php
	}
}

function arter_add_no_swap($link, $args, $comment, $post){
  return str_replace("rel='nofollow'", "rel='nofollow' data-no-swup", $link);
}

add_filter('comment_reply_link', 'arter_add_no_swap', 420, 4);

/**
 * Woocommerce Support
 */

function arter_add_woocommerce_support() {
	add_theme_support( 'woocommerce', array(
		'thumbnail_image_width' => 800,
		'single_image_width' => 800,
		'product_grid' => array(
			'default_rows' => 3,
			'min_rows' => 3,
			'max_rows' => 3,
			'default_columns' => 3,
			'min_columns' => 3,
			'max_columns' => 3,
		),
	) );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'arter_add_woocommerce_support' );

/**
 * Update contents AJAX mini-cart
 */

function arter_woocommerce_update_count_mini_cart( $fragments ) {
	ob_start();
	?>

	<span class="cart-count">
		<?php echo sprintf (_n( '%d', '%d', WC()->cart->get_cart_contents_count(), 'arter' ), WC()->cart->get_cart_contents_count() ); ?>
	</span>

	<?php
	$fragments['span.cart-count'] = ob_get_clean();
	return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'arter_woocommerce_update_count_mini_cart' );

function arter_woocommerce_update_content_mini_cart( $fragments ) {
	ob_start();
	?>

	<div class="cart-widget">
       <?php woocommerce_mini_cart(); ?>
    </div>

	<?php
	$fragments['div.cart-widget'] = ob_get_clean();
	return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'arter_woocommerce_update_content_mini_cart' );
