<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package arter
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<!-- Meta Data -->
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<?php

$default_scrolling = '';
if ( ! get_field( 'theme_scrolling', 'option' ) ) {
  $default_scrolling = 'default--scrolling';
}

?>

<body <?php body_class( $default_scrolling ); ?>>
	<?php wp_body_open(); ?>
	
  <!-- app -->
  <div class="art-app">

    <!-- mobile top bar -->
    <div class="art-mobile-top-bar"></div>

    <?php 

    $preloader_text = get_field( 'preloader_text', 'option' );

    ?>

    <!-- preloader -->
    <div class="art-preloader">
      <!-- preloader content -->
      <div class="art-preloader-content">
        <!-- title -->
        <h4><?php echo esc_html( $preloader_text ); ?></h4>
        <!-- progressbar -->
        <div id="preloader" class="art-preloader-load">
			<div class="art-preloader-load-first">
				<svg viewBox="0 0 100 1.7" preserveAspectRatio="none" style="width: 100%; height: 100%;"><path d="M 0,0.85 L 100,0.85" stroke="#eee" stroke-width="1.7" fill-opacity="0"></path></svg>
				<div class="progressbar-text">0 %</div>
			</div>
		</div>
      </div>
      <!-- preloader content end -->
    </div>
    <!-- preloader end -->

    <!-- app wrapper -->
    <div class="art-app-wrapper">

      <!-- app container end -->
      <div class="art-app-container">
        <?php
        if ( get_field( 'vcard_name', 'option' ) ) :
          get_template_part( 'template-parts/info-bar' );
        else : 
          get_sidebar();
        endif;
        ?>

        <!-- menu bar -->
		<div class="art-menu-bar-fix">
        <div class="art-menu-bar">

          <!-- menu bar frame -->
          <div class="art-menu-bar-frame">
			  
			<!-- Woocommerce cart -->
			<?php if ( class_exists( 'WooCommerce' ) ) : ?>
			  <?php if ( true == get_theme_mod( 'cart_shop', true ) ) : ?>
			  <div class="cart-btn">
				  <div class="cart-icon">
					  <span class="fas fa-shopping-cart"></span>
					  <span class="cart-count"><?php echo sprintf (_n( '%d', '%d', WC()->cart->get_cart_contents_count(), 'arter' ), WC()->cart->get_cart_contents_count() ); ?></span> 
				  </div>
				  <div class="cart-widget">
					  <?php woocommerce_mini_cart(); ?>
				  </div>
			  </div>
			  <?php endif; ?>
			<?php endif; ?>

            <!-- menu bar header -->
            <div class="art-menu-bar-header">
              <!-- menu bar button -->
              <a class="art-menu-bar-btn">
                <!-- icon -->
                <span></span>
              </a>
              <!-- menu bar button end -->
            </div>
            <!-- menu bar header end -->

            <!-- current page title -->
            <div class="art-current-page"></div>
            <!-- current page title end -->

            <!-- scroll frame -->
            <div class="art-scroll-frame">

              <!-- menu -->
              <nav id="swupMenu">
                <!-- menu list -->
                <?php
                if ( has_nav_menu( 'primary' ) ) :
                  wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'container' => '',
                    'menu_class' => 'main-menu',
                    'walker' => new arter_Topmenu_Walker(),
                  ) );
                endif;

                ?>
                <!-- menu list end -->
              </nav>
              <!-- menu end -->

            </div>
            <!-- scroll frame end -->

          </div>
          <!-- menu bar frame -->

        </div>
		</div>
        <!-- menu bar end -->

        <!-- content -->
        <div class="art-content">

          <!-- curtain -->
          <div class="art-curtain"></div>

          <?php

          $header_bg = get_field( 'header_bg', 'option' );

          ?>

          <!-- top background -->
          <div class="art-top-bg" style="background-image: url(<?php echo esc_url( $header_bg ); ?>)">
            <!-- overlay -->
            <div class="art-top-bg-overlay"></div>
            <!-- overlay end -->
          </div>
          <!-- top background end -->

          <!-- swup container -->
          <div class="transition-fade" id="swup">

            <!-- scroll frame -->
            <div id="scrollbar" class="art-scroll-frame">