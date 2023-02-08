<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package arter
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<!-- info bar -->
<div class="art-info-bar art-sidebar">
  <!-- menu bar frame -->
  <div class="art-info-bar-frame">
    
    <!-- info bar header -->
    <div class="art-info-bar-header">
      <!-- info bar button -->
      <a class="art-info-bar-btn">
        <!-- icon -->
        <i class="fas fa-ellipsis-v"></i>
      </a>
      <!-- info bar button end -->
    </div>
    <!-- info bar header end -->

    <!-- info bar header -->
    <div class="art-header">
      <!-- name -->
      <h5 class="art-name mb-10"><a href="<?php echo esc_url( home_url() ); ?>"><?php echo esc_html( bloginfo( 'name' ) ); ?></a></h5>
      <!-- post -->
      <div class="art-sm-text"><?php echo esc_html( bloginfo( 'description' ) ); ?></div>
    </div>
    <!-- info bar header end -->

  
    <!-- scroll frame -->
    <div id="scrollbar2" class="art-scroll-frame">
    	<div class="content-sidebar">
			<aside id="secondary" class="widget-area">
				<?php dynamic_sidebar( 'sidebar-1' ); ?>
			</aside>
		</div>
    </div>
  </div>
  <!-- menu bar frame end -->

</div>
<!-- info bar end -->