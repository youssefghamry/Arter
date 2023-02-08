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

$blog_categories = get_field( 'blog_categories', 'option' );
$blog_excerpt = get_field( 'blog_excerpt', 'option' );
$excerpt_text = get_the_excerpt();

?>

<!-- blog post card -->
<div class="art-a art-blog-card">
  <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	  <!-- post cover -->
	  <?php arter_post_thumbnail( 'blog' ); ?>
	  <!-- post cover end -->
	  <!-- post description -->
	  <div class="art-post-description">
	  	<?php if ( 'post' === get_post_type() ) : ?>
		<div class="art-project-category mb-15">
			<a href="<?php echo esc_url( get_permalink() ); ?>">
				<span class="art-el-date"><?php echo esc_html( get_the_date() ); ?></span>
			</a>
			<?php
			if( $blog_categories ) :
				$categories_list = get_the_category();
				if ( $categories_list ) :
					echo esc_html( ' / ', 'arter' );
					$total = count( $categories_list );
					$i = 0;
					echo '<span class="art-el-category">';
					foreach ( $categories_list as $category ) { $i++;
						if ( $total != $i ) {
							echo esc_html( $category->cat_name ) . ', ';
						} else {
							echo esc_html( $category->cat_name );
						}
					}
					echo '</span>';
				endif;
			endif;
			?>
		</div>
		<?php endif; ?>
	    <!-- title -->
	    <a href="<?php echo esc_url( get_permalink() ); ?>">
	      <h5 class="mb-15"><?php the_title(); ?></h5>
	    </a>
	    <?php if ( ! $blog_excerpt && $excerpt_text ) : ?>
	    <!-- text -->
	    <div class="art-el-description">
	    	<?php the_excerpt(); ?>
	    </div>
	    <?php endif; ?>
	  </div>
	  <!-- post description end -->
  </div>
</div>
<!-- blog post card end -->