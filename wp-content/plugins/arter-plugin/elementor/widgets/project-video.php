<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 
/**
 * Arter Hero Banner Widget.
 *
 * @since 1.0
 */
class Arter_Project_Video_Widget extends Widget_Base {

	public function get_name() {
		return 'arter-project-video';
	}

	public function get_title() {
		return esc_html__( 'Project Video', 'arter-plugin' );
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
			'video',
			[
				'label'       => esc_html__( 'Video Link or YT Embed', 'arter-plugin' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter link to video file or youtube', 'arter-plugin' ),
				'default'     => esc_html__( 'https://www.youtube.com/embed/S4L8T2kFFck', 'arter-plugin' ),
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
		?>

		<!-- container -->
		<div class="container-fluid">

		<!-- row -->
		<div class="row">

		  <!-- col -->
		  <div class="col-lg-12">

		    <!-- project cover -->
		    <div class="art-a art-project-cover">
		      <?php if ( $settings['video'] ) : ?>
		      <!-- item frame -->
		      <iframe frameborder="0" allowfullscreen="1" width="1080" height="640" src="<?php echo esc_url( $settings['video'] ); ?>"></iframe>
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
		      <# if ( settings.video ) { #>
		      <!-- item frame -->
		      <iframe frameborder="0" allowfullscreen="1" width="1080" height="640" src="settings.video.url"></iframe>
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

Plugin::instance()->widgets_manager->register_widget_type( new Arter_Project_Video_Widget() );