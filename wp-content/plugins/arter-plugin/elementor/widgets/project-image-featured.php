<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 
/**
 * Arter Hero Banner Widget.
 *
 * @since 1.0
 */
class Arter_Project_Image_Featured_Widget extends Widget_Base {

	public function get_name() {
		return 'arter-project-image-featured';
	}

	public function get_title() {
		return esc_html__( 'Project Image', 'arter-plugin' );
	}

	public function get_icon() {
		return 'fas fa-project-diagram';
	}

	public function get_categories() {
		return [ 'arter-category' ];
	}

	/**
	 * Register widget controls.
	 *
	 * @since 1.0
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'content_tab',
			[
				'label' => esc_html__( 'Image', 'arter-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'image',
			[
				'label'       => esc_html__( 'Image', 'arter-plugin' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'title',
			[
				'label'       => esc_html__( 'Title', 'arter-plugin' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter title', 'arter-plugin' ),
				'default'     => esc_html__( 'Title', 'arter-plugin' ),
			]
		);

		$this->end_controls_section();
	}


	/**
	 * Render widget output on the frontend.
	 *
	 * @since 1.0
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$theme_lightbox = get_field( 'portfolio_lightbox_disable', 'option' );
		
		?>

		<!-- container -->
		<div class="container-fluid">

		<!-- row -->
		<div class="row">

		  <!-- col -->
		  <div class="col-lg-12">

		    <!-- project cover -->
		    <div class="art-a art-project-cover">
		      <?php if ( $settings['image'] ) :  $image = wp_get_attachment_image_url( $settings['image']['id'], 'arter_1920xAuto' ); ?>
		      <!-- item frame -->
		      <a<?php if ( ! $theme_lightbox ) : ?> data-magnific-image<?php endif; ?> data-no-swup href="<?php echo esc_url( $image ); ?>" class="art-portfolio-item-frame art-horizontal">
		        <!-- img -->
		        <img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $settings['title'] ); ?>">
		        <!-- zoom icon -->
		        <span class="art-item-hover"><i class="fas fa-expand"></i></span>
		      </a>
		      <!-- item end -->
		  	  <?php endif; ?>
		    </div>
		    <!-- project cover nd -->

		  </div>
		  <!-- col end -->

		</div>
		<!-- row end -->

		</div>
		<!-- container end -->

		<?php
	}

	/**
	 * Render widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function content_template() {
		?>

		<!-- container -->
		<div class="container-fluid">

		<!-- row -->
		<div class="row">

		  <!-- col -->
		  <div class="col-lg-12">

		    <!-- project cover -->
		    <div class="art-a art-project-cover">
		      <# if ( settings.image ) { #>
		      <!-- item frame -->
		      <a data-magnific-image data-no-swup href="{{{ settings.image.url }}}" class="art-portfolio-item-frame art-horizontal">
		        <!-- img -->
		        <img src="{{{ settings.image.url }}}" alt="{{{ settings.title }}}">
		        <!-- zoom icon -->
		        <span class="art-item-hover"><i class="fas fa-expand"></i></span>
		      </a>
		      <!-- item end -->
		  	  <# } #>
		    </div>
		    <!-- project cover nd -->

		  </div>
		  <!-- col end -->

		</div>
		<!-- row end -->

		</div>
		<!-- container end -->

		<?php 
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Arter_Project_Image_Featured_Widget() );