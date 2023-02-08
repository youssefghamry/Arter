<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package arter
 */

?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="content-box">
		<div class="single-post-text">
			<?php
				the_content(); 

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'arter' ),
					'after'  => '</div>',
				) );
			?>
		</div>
		<div class="post-text-bottom">	
			<?php arter_entry_footer(); ?>
		</div>
	</div>
</div><!-- #post-<?php the_ID(); ?> -->