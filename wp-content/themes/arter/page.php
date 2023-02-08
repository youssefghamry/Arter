<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
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

	  <!-- col -->
	  <div class="col-lg-12">
	  	<div class="art-a art-card">
			<?php get_template_part( 'template-parts/content', 'page' ); ?>
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
	
	<?php endwhile; ?>

<?php
get_footer();
