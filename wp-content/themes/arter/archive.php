<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package arter
 */

get_header();
?>
	
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
	        <h4><?php echo esc_html( get_the_archive_title() ); ?></h4>
	      </div>
	      <!-- title frame end -->
	    </div>
	    <!-- section title end -->

	  </div>
	  <!-- col end -->
	
	</div>
    <!-- row end -->

    </div>
    <!-- container end -->
	

	<!-- container -->
	<div class="container-fluid">

	<!-- row -->
	<div class="row">

	  <?php if ( have_posts() ) : ?>		
			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post(); ?>

			<!-- col -->
	  		<div class="<?php if ( get_field( 'vcard_name', 'option' ) ) : ?>col-lg-6<?php else : ?>col-lg-12<?php endif; ?>">
	  			<?php
				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content' );
				?>
			</div>
			<!-- col end -->
			<?php endwhile; ?>
			
			<?php if ( get_the_posts_pagination() ) : ?>
			<!-- col -->
			<div class="col-lg-12">	
				<div class="art-a art-pagination">
					<?php
						echo paginate_links( array(
							'prev_text'		=> esc_html__( 'Prev', 'arter' ),
							'next_text'		=> esc_html__( 'Next', 'arter' ),
						) );
					?>
				</div>
			</div>
			<!-- col end -->
			<?php endif; ?>

		<?php else : ?>
			<!-- col -->
	  		<div class="col-lg-12">
				<?php get_template_part( 'template-parts/content', 'none' ); ?>
			</div>
			<!-- col end -->
		<?php endif; ?>
	
	</div>
    <!-- row end -->

    </div>
    <!-- container end -->
<?php
get_footer();