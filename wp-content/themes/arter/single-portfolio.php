<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-portfolio
 *
 * @package arter
 */

get_header();
?>
	
	<?php while ( have_posts() ) : the_post(); ?>
		<!-- container -->
		<div class="container-fluid">

		<!-- row -->
		<div class="row p-30-0">

		  <!-- col -->
		  <div class="col-lg-12">

		    <!-- section title -->
		    <div class="art-section-title">
		      <!-- title frame -->
		      <div class="art-title-frame">
		        <!-- title -->
		        <h1><?php the_title(); ?></h1>
		      </div>
		      <!-- title frame end -->
		      <!-- right frame -->
		      <div class="art-right-frame">
		        <?php
				$categories_list = get_the_terms( get_the_ID(), 'portfolio_categories' );
				if ( $categories_list ) :
					$total = count( $categories_list );
					$i = 0;
					echo '<div class="art-project-category">';
					foreach ( $categories_list as $category ) { $i++;
						if ( $total != $i ) {
							echo esc_html( $category->name ) . ', ';
						} else {
							echo esc_html( $category->name );
						}
					}
					echo '</div>';
				endif;
				?>
		      </div>
		      <!-- right frame end -->
		    </div>
		    <!-- section title end -->

		  </div>
		  <!-- col end -->
		</div>
        <!-- row end -->

        </div>
        <!-- container end -->

		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php the_content(); ?>
		</div><!-- #post-<?php the_ID(); ?> -->

		<?php arter_single_navigantion(); ?>

	<?php endwhile; ?>

<?php
get_footer();