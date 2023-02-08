<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 
/**
 * Arter Project Image Carousel Widget.
 *
 * @since 1.0
 */
class Arter_Project_Image_Carousel_Widget extends Widget_Base {

	public function get_name() {
		return 'arter-project-image-carousel';
	}

	public function get_title() {
		return esc_html__( 'Project Image Carousel', 'arter-plugin' );
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
			'title_tab',
			[
				'label' => esc_html__( 'Title', 'arter-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title',
			[
				'label'       => esc_html__( 'Title', 'arter-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter title', 'arter-plugin' ),
				'default'     => esc_html__( 'Title', 'arter-plugin' ),
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label'       => esc_html__( 'Title Tag', 'arter-plugin' ),
				'type'        => Controls_Manager::SELECT,
				'default' => 'h4',
				'options' => [
					'h1'  => __( 'H1', 'arter-plugin' ),
					'h2' => __( 'H2', 'arter-plugin' ),
					'h3' => __( 'H3', 'arter-plugin' ),
					'h4' => __( 'H4', 'arter-plugin' ),
					'div' => __( 'DIV', 'arter-plugin' ),
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'items_tab',
			[
				'label' => esc_html__( 'Items', 'arter-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'image', [
				'label' => esc_html__( 'Image', 'arter-plugin' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'name', [
				'label'       => esc_html__( 'Name', 'arter-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter name', 'arter-plugin' ),
				'default'	=> esc_html__( 'Enter name', 'arter-plugin' ),
			]
		);

		$this->add_control(
			'items',
			[
				'label' => esc_html__( 'Images', 'arter-plugin' ),
				'type' => Controls_Manager::REPEATER,
				'prevent_empty' => false,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ name }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'title_styling',
			[
				'label'     => esc_html__( 'Title', 'arter-plugin' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Color', 'arter-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .art-section-title .art-title-frame .art-title-h' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .art-section-title .art-title-frame .art-title-h',
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
		$this->add_inline_editing_attributes( 'title', 'basic' );

		$theme_lightbox = get_field( 'portfolio_lightbox_disable', 'option' );
		
		?>

		<!-- container -->
		<div class="container-fluid">

		<!-- row -->
		<div class="row">

		  <?php if ( $settings['title'] ) : ?>
		  <!-- col -->
		  <div class="col-lg-12">

		    <!-- section title -->
		    <div class="art-section-title">
		      <!-- title frame -->
		      <div class="art-title-frame">
		        <!-- title -->
		        <<?php echo esc_attr( $settings['title_tag'] ); ?> class="art-title-h">
		    	<span <?php echo $this->get_render_attribute_string( 'title' ); ?>>
		          	<?php echo wp_kses_post( $settings['title'] ); ?>
		         </span>
		    	</<?php echo esc_attr( $settings['title_tag'] ); ?>>
		      </div>
		      <!-- title frame end -->
		    </div>
		    <!-- section title end -->

		  </div>
		  <!-- col end -->
		  <?php endif; ?>

		  <!-- col -->
		  <div class="col-lg-12">
		  	<?php if ( $settings['items'] ) : ?>
		    <!-- slider container -->
		    <div class="swiper-container art-works-slider" style="overflow: visible">
		      <!-- slider wrapper -->
		      <div class="swiper-wrapper">
				<?php foreach ( $settings['items'] as $index => $item ) : ?>
		        <!-- slide -->
		        <div class="swiper-slide">
		          <?php if ( $item['image'] ) :  $image = wp_get_attachment_image_url( $item['image']['id'], 'arter_1920xAuto' ); $image_full = wp_get_attachment_image_url( $item['image']['id'], 'arter_1920xAuto' ); ?>
		          <!-- item frame -->
		          <a<?php if ( ! $theme_lightbox ) : ?> data-magnific-gallery<?php endif; ?> data-elementor-lightbox-slideshow="carousel" data-no-swup href="<?php echo esc_url( $image_full ); ?>" class="art-a art-portfolio-item-frame art-horizontal">
		            <!-- img -->
		            <img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $item['name'] ); ?>">
		            <!-- zoom icon -->
		            <span class="art-item-hover"><i class="fas fa-expand"></i></span>
		          </a>
		          <!-- item end -->
		          <?php endif; ?>
		        </div>
		        <!-- slide end -->
		        <?php endforeach; ?>
		      </div>
		      <!-- slider wrapper end -->
		    </div>
		    <!-- slider container end -->
		    <?php endif; ?>
		  </div>
		  <!-- col end -->

		  <!-- col -->
		  <div class="col-lg-12">

		    <!-- slider navigation -->
		    <div class="art-slider-navigation">

		      <!-- left side -->
		      <div class="art-sn-left">

		        <!-- slider pagination -->
		        <div class="swiper-pagination"></div>

		      </div>
		      <!-- left side end -->

		      <!-- right side -->
		      <div class="art-sn-right">

		        <!-- slider navigation -->
		        <div class="art-slider-nav-frame">
		          <!-- prev -->
		          <div class="art-slider-nav art-works-swiper-prev"><i class="fas fa-chevron-left"></i></div>
		          <!-- next -->
		          <div class="art-slider-nav art-works-swiper-next"><i class="fas fa-chevron-right"></i></div>
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
		<#
		view.addInlineEditingAttributes( 'title', 'basic' );
		#>

		<!-- container -->
		<div class="container-fluid">

		<!-- row -->
		<div class="row">

		  <# if ( settings.title ) { #>
		  <!-- col -->
		  <div class="col-lg-12">

		    <!-- section title -->
		    <div class="art-section-title">
		      <!-- title frame -->
		      <div class="art-title-frame">
		        <!-- title -->
		        <{{{ settings.title_tag }}} class="art-title-h">
		    	<span {{{ view.getRenderAttributeString( 'title' ) }}}>
		          	{{{ settings.title }}}
		         </span>
		    	</{{{ settings.title_tag }}}>
		      </div>
		      <!-- title frame end -->
		    </div>
		    <!-- section title end -->

		  </div>
		  <!-- col end -->
		  <# } #>

		  <!-- col -->
		  <div class="col-lg-12">
		  	<# if ( settings.items ) { #>
		    <!-- slider container -->
		    <div class="swiper-container art-works-slider" style="overflow: visible">
		      <!-- slider wrapper -->
		      <div class="swiper-wrapper">
				
				<# _.each( settings.items, function( item, index ) { #>
		        <!-- slide -->
		        <div class="swiper-slide">
		          <# if ( item.image ) { #>
		          <!-- item frame -->
		          <a data-magnific-gallery data-elementor-lightbox-slideshow="gallery" data-no-swup href="{{{ item.image.url }}}" class="art-a art-portfolio-item-frame art-horizontal">
		            <!-- img -->
		            <img src="{{{ item.image.url }}}" alt="{{{ item.name }}}">
		            <!-- zoom icon -->
		            <span class="art-item-hover"><i class="fas fa-expand"></i></span>
		          </a>
		          <!-- item end -->
		          <# } #>
		        </div>
		        <!-- slide end -->
		        <# }); #>
		      </div>
		      <!-- slider wrapper end -->
		    </div>
		    <!-- slider container end -->
		    <# } #>
		  </div>
		  <!-- col end -->

		  <!-- col -->
		  <div class="col-lg-12">

		    <!-- slider navigation -->
		    <div class="art-slider-navigation">

		      <!-- left side -->
		      <div class="art-sn-left">

		        <!-- slider pagination -->
		        <div class="swiper-pagination"></div>

		      </div>
		      <!-- left side end -->

		      <!-- right side -->
		      <div class="art-sn-right">

		        <!-- slider navigation -->
		        <div class="art-slider-nav-frame">
		          <!-- prev -->
		          <div class="art-slider-nav art-works-swiper-prev"><i class="fas fa-chevron-left"></i></div>
		          <!-- next -->
		          <div class="art-slider-nav art-works-swiper-next"><i class="fas fa-chevron-right"></i></div>
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

		</div>
		<!-- container end -->

		<?php 
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Arter_Project_Image_Carousel_Widget() );