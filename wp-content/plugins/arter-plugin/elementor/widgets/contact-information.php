<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 
/**
 * Arter Contact Information Widget.
 *
 * @since 1.0
 */
class Arter_Contact_Info_Widget extends Widget_Base {

	public function get_name() {
		return 'arter-contact-info';
	}

	public function get_title() {
		return esc_html__( 'Contact Information', 'arter-plugin' );
	}

	public function get_icon() {
		return 'far fa-list-alt';
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
			'desc', [
				'label'       => esc_html__( 'Description', 'arter-plugin' ),
				'type'        => Controls_Manager::WYSIWYG,
				'placeholder' => esc_html__( 'Enter description', 'arter-plugin' ),
				'default'	=> esc_html__( 'Enter description', 'arter-plugin' ),
			]
		);

		$this->add_control(
			'items',
			[
				'label' => esc_html__( 'Contact Information Items', 'arter-plugin' ),
				'type' => Controls_Manager::REPEATER,
				'prevent_empty' => false,
				'fields' => $repeater->get_controls(),
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

		$this->start_controls_section(
			'items_styling',
			[
				'label'     => esc_html__( 'Items', 'arter-plugin' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'item_title_color',
			[
				'label'     => esc_html__( 'Title Color', 'arter-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .art-table strong' => 'color: {{VALUE}};',
				],
			]
		);		

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_title_typography',
				'label'     => esc_html__( 'Title Typography', 'arter-plugin' ),
				'selector' => '{{WRAPPER}} .art-table strong',
			]
		);

		$this->add_control(
			'item_desc_color',
			[
				'label'     => esc_html__( 'Text Color', 'arter-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .art-table' => 'color: {{VALUE}};',
				],
			]
		);		

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_desc_typography',
				'label'     => esc_html__( 'Text Typography', 'arter-plugin' ),
				'selector' => '{{WRAPPER}} .art-table',
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
		  <?php foreach ( $settings['items'] as $index => $item ) :
		  $item_desc = $this->get_repeater_setting_key( 'desc', 'items', $index );
		  $this->add_inline_editing_attributes( $item_desc, 'advanced' );
		  ?>
		  <!-- col -->
		  <div class="col-lg-4">
		    <!-- contact card -->
		    <div class="art-a art-card">
		      <div class="art-table p-15-15">
		        <div <?php echo $this->get_render_attribute_string( $item_desc ); ?>>
	        		<?php echo wp_kses_post( $item['desc'] ); ?>
	        	</div>
		      </div>
		    </div>
		    <!-- contact card end -->
		  </div>
		  <!-- col end -->
		  <?php endforeach; ?>
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
		  <# _.each( settings.items, function( item, index ) { 

		  var item_desc = view.getRepeaterSettingKey( 'desc', 'items', index );
		  view.addInlineEditingAttributes( item_desc, 'advanced' );

		  #>
		  <!-- col -->
		  <div class="col-lg-4">
		    <!-- contact card -->
		    <div class="art-a art-card">
		      <div class="art-table p-15-15">
		        <div {{{ view.getRenderAttributeString( item_desc ) }}}>
					{{{ item.desc }}}
				</div>
		      </div>
		    </div>
		    <!-- contact card end -->
		  </div>
		  <!-- col end -->
		  <# }); #>
		  <# } #>

		  </div>
		  <!-- row end -->

		</div>
		<!-- container end -->

		<?php 
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Arter_Contact_Info_Widget() );