<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 
/**
 * Arter Clients Slider Widget.
 *
 * @since 1.0
 */
class Arter_ClientsSlider_Widget extends Widget_Base {

	public function get_name() {
		return 'arter-clients-slider';
	}

	public function get_title() {
		return esc_html__( 'Clients Carousel', 'arter-plugin' );
	}

	public function get_icon() {
		return 'fab fa-cuttlefish';
	}

	public function get_categories() {
		return [ 'arter-category' ];
	}

	/**
	 * Register widget controls.
	 *
	 * @since 1.0
	 */
	protected function _register_controls() {

		$this->start_controls_section(
			'items_tab',
			[
				'label' => esc_html__( 'Items', 'arter-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'items',
			[
				'label' => esc_html__( 'Clients Items', 'arter-plugin' ),
				'type' => Controls_Manager::REPEATER,
				'prevent_empty' => false,
				'fields' => [
					[
						'name' => 'image',
						'label' => esc_html__( 'Image', 'arter-plugin' ),
						'type' => Controls_Manager::MEDIA,
						'default' => [
							'url' => \Elementor\Utils::get_placeholder_image_src(),
						],
					],
					[
						'name' => 'name',
						'label'       => esc_html__( 'Name', 'arter-plugin' ),
						'type'        => Controls_Manager::TEXTAREA,
						'placeholder' => esc_html__( 'Enter name', 'arter-plugin' ),
						'default'	=> esc_html__( 'Enter name', 'arter-plugin' ),
					],
					[
						'name' => 'link',
						'label' => esc_html__( 'URL', 'arter-plugin' ),
						'type' => Controls_Manager::URL,
						'show_external' => true,
					],
				],
				'title_field' => '{{{ name }}}',
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
		<?php if ( $settings['items'] ) : ?>
		<!-- row -->
		<div class="row">
		  <!-- col -->
		  <div class="col-lg-12">
		    <!-- slider container -->
		    <div class="swiper-container art-clients-slider" style="overflow: visible">
		      <!-- slider wrapper -->
		      <div class="swiper-wrapper">
		      	<?php foreach ( $settings['items'] as $index => $item ) : ?>
		        <!-- slide -->
		        <div class="swiper-slide">
					<?php if ( $item['image'] ) : $image = wp_get_attachment_image_url( $item['image']['id'], 'arter_256x256' ); ?>
					<?php if ( $item['link'] ) : ?>
					<a <?php if ( $item['link']['is_external'] ) : ?> target="_blank"<?php endif; ?><?php if ( $item['link']['nofollow'] ) : ?> rel="nofollow"<?php endif; ?> href="<?php echo esc_url( $item['link']['url'] ); ?>">
					<?php endif; ?>
					<!-- brand -->
					<img class="art-brand" src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $item['name'] ); ?>">
					<?php if ( $item['link'] ) : ?>
					</a>
					<?php endif; ?>
					<?php endif; ?>
		        </div>
		        <!-- slide end -->
		        <?php endforeach; ?>
		      </div>
		      <!-- slider wrapper end -->
		    </div>
		    <!-- slider container end -->
		  </div>
		  <!-- col end -->

		  <!-- col -->
		  <div class="col-lg-12">

		    <!-- slider navigation -->
		    <div class="art-slider-navigation">

		      <!-- left side -->
		      <div class="art-sn-left">

		        <!-- slider pagination -->
		        <div class="swiper-pagination art-clients-swiper-pagination"></div>

		      </div>
		      <!-- left side end -->

		      <!-- right side -->
		      <div class="art-sn-right">

		        <!-- slider navigation -->
		        <div class="art-slider-nav-frame">
		          <!-- prev -->
		          <div class="art-slider-nav art-clients-swiper-prev"><i class="fas fa-chevron-left"></i></div>
		          <!-- next -->
		          <div class="art-slider-nav art-clients-swiper-next"><i class="fas fa-chevron-right"></i></div>
		        </div>
		        <!-- slider navigation -->

		      </div>
		      <!-- right side end -->

		    </div>
		    <!-- slider navigation end -->

		  </div>
		  <!-- col end -->
		</div>
		<!-- row end -->
		<?php endif; ?>
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
		<# if ( settings.items ) { #>
		<!-- row -->
		<div class="row">
		  <!-- col -->
		  <div class="col-lg-12">
		    <!-- slider container -->
		    <div class="swiper-container art-clients-slider" style="overflow: visible">
		      <!-- slider wrapper -->
		      <div class="swiper-wrapper">
				<# _.each( settings.items, function( item, index ) { #>
				  <!-- col -->
				  <div class="swiper-slide">
					<# if ( item.image ) { #>
					<# if ( item.link ) { #>
					<a <# if ( item.link.is_external ) { #> target="_blank"<# } #><# if ( item.link.nofollow ) { #> rel="nofollow"<# } #> href="{{{ item.link.url }}}">
					<# } #>
					<!-- brand -->
					<img class="art-brand" src="{{{ item.image.url }}}" alt="{{{ item.name }}}">
					<# if ( item.link ) { #>
					</a>
					<# } #>
					<# } #>
				  </div>
				  <!-- col end -->
				<# }); #>
		      </div>
		      <!-- slider wrapper end -->
		    </div>
		    <!-- slider container end -->
		  </div>
		  <!-- col end -->

		  <!-- col -->
		  <div class="col-lg-12">

		    <!-- slider navigation -->
		    <div class="art-slider-navigation">

		      <!-- left side -->
		      <div class="art-sn-left">

		        <!-- slider pagination -->
		        <div class="swiper-pagination art-clients-swiper-pagination"></div>

		      </div>
		      <!-- left side end -->

		      <!-- right side -->
		      <div class="art-sn-right">

		        <!-- slider navigation -->
		        <div class="art-slider-nav-frame">
		          <!-- prev -->
		          <div class="art-slider-nav art-clients-swiper-prev"><i class="fas fa-chevron-left"></i></div>
		          <!-- next -->
		          <div class="art-slider-nav art-clients-swiper-next"><i class="fas fa-chevron-right"></i></div>
		        </div>
		        <!-- slider navigation -->

		      </div>
		      <!-- right side end -->

		    </div>
		    <!-- slider navigation end -->

		  </div>
		  <!-- col end -->
		</div>
		<!-- row end -->
		<# } #>
		</div>
		<!-- container end -->

		<?php 
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Arter_ClientsSlider_Widget() );