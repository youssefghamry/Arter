<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package arter
 */

get_header();
?>

<?php

$blog_featured_img = get_field( 'blog_featured_img', 'option' );
$theme_lightbox = get_field( 'portfolio_lightbox_disable', 'option' );

?>

	<?php while ( have_posts() ) : the_post(); ?>
		<!-- container -->
		<div class="container-fluid">

		<!-- row -->
		<div class="row p-30-0">

		  <!-- col -->
		  <div class="col-lg-12">
			  
			<?php
			if ( function_exists('yoast_breadcrumb') ) {
			  yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
			}
			?>

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
		        <div class="art-project-category">
		        	<?php the_date(); ?>
				</div>
		      </div>
		      <!-- right frame end -->
		    </div>
		    <!-- section title end -->

		  </div>
		  <!-- col end -->

		  <?php if ( has_post_thumbnail() && ! $blog_featured_img ) : ?>
		  <!-- col -->
		  <div class="col-lg-12">
		  	<!-- project cover -->
            <div class="art-a art-project-cover">
              <!-- item frame -->
              <a<?php if ( ! $theme_lightbox ) : ?> data-magnific-image<?php endif; ?> data-no-swup href="<?php the_post_thumbnail_url( 'arter_1920xAuto' ); ?>" class="art-portfolio-item-frame art-horizontal">
                <!-- img -->
                <?php the_post_thumbnail( 'arter_1920xAuto', array(
					'alt' => the_title_attribute( array(
						'echo' => false,
					)),
				) ); ?>
                <!-- zoom icon -->
                <span class="art-item-hover"><i class="fas fa-expand"></i></span>
              </a>
              <!-- item end -->
            </div>
            <!-- project cover end -->
		  </div>
		  <!-- col end -->
		  <?php endif; ?>
		</div>
        <!-- row end -->

        </div>
        <!-- container end -->

        <!-- container -->
		<div class="container-fluid">

		<!-- row -->
		<div class="row">

		  <!-- col -->
		  <div class="col-lg-12">
		  	<div class="art-a art-card">
				<?php get_template_part( 'template-parts/content', 'single' ); ?>
			</div>
		  </div>
		  <!-- col end -->
		</div>
        <!-- row end -->

        </div>
        <!-- container end -->

        <?php if ( comments_open() || get_comments_number() ) : ?>
        <!-- container -->
		<div class="container-fluid">

		<!-- row -->
		<div class="row">

		  <!-- col -->
		  <div class="col-lg-12">
		    <?php
			// If comments are open or we have at least one comment, load up the comment template.
			comments_template();
		    ?>
		  </div>
		  <!-- col end -->
		</div>
        <!-- row end -->

        </div>
        <!-- container end -->
        <?php endif; ?>

		<?php arter_single_navigantion(); ?>

	<?php endwhile; ?>

<?php
get_footer();