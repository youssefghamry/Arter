<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package arter
 */

?>

<?php

$footer_text = get_field( 'footer_text', 'option' );

if ( ! $footer_text ) {
  $footer_text = esc_html__( '&copy; 2020. All rights reserved', 'arter' );
}

$footer_text2 = get_field( 'footer_text2', 'option' );

?>

    			        <!-- container -->
                  <div class="container-fluid">

                    <!-- footer -->
                    <footer class="footer">
                      <!-- copyright -->
                      <div <?php if ( ! $footer_text2 ) : ?>class="align-center"<?php endif; ?>><?php echo wp_kses_post( $footer_text ); ?></div>
                      <?php if ( $footer_text2 ) : ?>
                      <div><?php echo wp_kses_post( $footer_text2 ); ?></div>
                      <?php endif; ?>
                    </footer>
                    <!-- footer end -->

                  </div>
                  <!-- container end -->

    			     </div>
                <!-- scroll frame end -->

              </div>
              <!-- swup container end -->

    		</div>
        <!-- content end -->

      </div>
      <!-- app container end -->

    </div>
    <!-- app wrapper end -->
    
  </div>
  <!-- app end -->
	
<?php wp_footer(); ?>

</body>
</html>