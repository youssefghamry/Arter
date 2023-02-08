<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package arter
 */

?>

<?php

/* post content */
$current_categories = get_the_terms( get_the_ID(), 'portfolio_categories' );
$categories_string = '';
$categories_slugs_string = '';
if ( $current_categories && ! is_wp_error( $current_categories ) ) {
	$arr_keys = array_keys( $current_categories );
	$last_key = end( $arr_keys );
	foreach ( $current_categories as $key => $value ) {
		if ( $key == $last_key ) {
			$categories_string .= $value->name . ' ';
		} else {
			$categories_string .= $value->name . ', ';
		}
		$categories_slugs_string .= 'category-' . $value->slug . ' ';
	}
}

$image = get_the_post_thumbnail_url( get_the_ID(), 'arter_800x800' );
$title = get_the_title();
$info = get_field( 'short_description' );
$video = get_field( 'video_link_popup' );
$href = get_the_permalink();

$theme_lightbox = get_field( 'portfolio_lightbox_disable', 'option' );

?>


<!-- grid item -->
<div class="art-grid-item <?php echo esc_attr( $categories_slugs_string ); ?>">
  <?php if ( $image ) : ?>
  <!-- grid item frame -->
  <?php if ( $video == '' ) : ?>
  <a<?php if ( ! $theme_lightbox ) : ?> data-magnific-gallery<?php endif; ?> data-no-swup data-elementor-lightbox-slideshow="gallery" data-elementor-lightbox-title="<?php echo esc_attr( $title ); ?>" href="<?php echo esc_url( $image ); ?>" class="art-a art-portfolio-item-frame">
  <?php endif; ?>
  <?php if ( $video ) : ?>
  <a data-magnific-video href="<?php echo esc_url( $video ); ?>" class="art-a art-portfolio-item-frame">
  <?php endif; ?>
    <!-- img -->
    <img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $title ); ?>">
    <!-- zoom icon -->
    <span class="art-item-hover"><i class="fas fa-expand"></i></span>
  </a>
  <!-- grid item frame end -->
  <?php endif; ?>
  <!-- description -->
  <div class="art-item-description">
  	<?php if ( $title ) : ?>
    <!-- title -->
    <h5 class="mb-15"><?php echo esc_html( $title ); ?></h5>
    <?php endif; ?>
    <?php if ( $info ) : ?>
    <div class="mb-15"><?php echo esc_html( $info ); ?></div>
    <?php endif; ?>
    <!-- button -->
    <a href="<?php echo esc_url( $href ); ?>" class="art-link art-color-link art-w-chevron"><?php echo esc_html__( 'Read more', 'arter' ); ?></a>
  </div>
  <!-- description end -->

</div>
<!-- grid item end -->