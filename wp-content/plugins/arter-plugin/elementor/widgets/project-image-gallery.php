<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 
/**
 * Arter Project Image Gallery Widget.
 *
 * @since 1.0
 */
class Arter_Project_Image_Gallery_Widget extends Widget_Base {

	public function get_name() {
		return 'arter-project-image-gallery';
	}

	public function get_title() {
		return esc_html__( 'Project Image Gallery', 'arter-plugin' );
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

		$repeater->add_control(
			'type', [
				'label'       => esc_html__( 'Type', 'arter-plugin' ),
				'type'        => Controls_Manager::SELECT,
				'default' => 'horizontal',
				'options' => [
					'horizontal'  => __( 'Horizontal', 'arter-plugin' ),
					'vertical' => __( 'Vertical', 'arter-plugin' ),
				],
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

		  <?php if ( $settings['items'] ) : ?>
		  <div class="art-grid art-grid-2-col art-gallery">
		  	<?php foreach ( $settings['items'] as $index => $item ) : ?>
		    <!-- grid item -->
		    <div class="art-grid-item">
		      <?php if ( $item['image'] ) :  $image = wp_get_attachment_image_url( $item['image']['id'], 'arter_950xAuto' ); $image_full = wp_get_attachment_image_url( $item['image']['id'], 'arter_1920xAuto' ); ?>
		      <!-- grid item frame -->
		      <a<?php if ( ! $theme_lightbox ) : ?> data-magnific-gallery<?php endif; ?> data-elementor-lightbox-slideshow="gallery" data-no-swup href="<?php echo esc_url( $image_full ); ?>" class="art-a art-portfolio-item-frame<?php if ( $item['type'] == 'horizontal' ) : ?> art-horizontal<?php else : ?> art-vertical<?php endif; ?>">
		        <!-- img -->
		        <img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $item['name'] ); ?>">
		        <!-- zoom icon -->
		        <span class="art-item-hover"><i class="fas fa-expand"></i></span>
		      </a>
		      <!-- grid item frame end -->
		      <?php endif; ?>
		    </div>
		    <!-- grid item end -->
			<?php endforeach; ?>
		  </div>
		  <?php endif; ?>
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

		  <# if ( settings.items ) { #>
		  <div class="art-grid art-grid-2-col art-gallery">
		  	<# _.each( settings.items, function( item, index ) { #>
		    <!-- grid item -->
		    <div class="art-grid-item">
		      <# if ( item.image ) { #>
		      <!-- grid item frame -->
		      <a data-magnific-gallery data-elementor-lightbox-slideshow="gallery" data-no-swup href="{{{ item.image.url }}}" class="art-a art-portfolio-item-frame<# if ( item.type == 'horizontal' ) { #> art-horizontal<# } else { #> art-vertical<# } #>">
		        <!-- img -->
		        <img src="{{{ item.image.url }}}" alt="{{{ item.name }}}">
		        <!-- zoom icon -->
		        <span class="art-item-hover"><i class="fas fa-expand"></i></span>
		      </a>
		      <!-- grid item frame end -->
		      <# } #>
		    </div>
		    <!-- grid item end -->
		    <# }); #>
		  </div>
		  <# } #>
		</div>
		<!-- row end -->

		</div>
		<!-- container end -->

		<?php 
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Arter_Project_Image_Gallery_Widget() );