<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 
/**
 * Arter Numbers Widget.
 *
 * @since 1.0
 */
class Arter_Numbers_Widget extends Widget_Base {

	public function get_name() {
		return 'arter-numbers';
	}

	public function get_title() {
		return esc_html__( 'Numbers', 'arter-plugin' );
	}

	public function get_icon() {
		return 'fas fa-sort-numeric-down';
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
			'items_tab',
			[
				'label' => esc_html__( 'Items', 'arter-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'value', [
				'label'       => esc_html__( 'Number Value', 'arter-plugin' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter number value', 'arter-plugin' ),
				'default'	=> 99,
			]
		);

		$repeater->add_control(
			'after', [
				'label'       => esc_html__( 'After Text', 'arter-plugin' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter after text', 'arter-plugin' ),
			]
		);

		$repeater->add_control(
			'label', [
				'label'       => esc_html__( 'Label', 'arter-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter label', 'arter-plugin' ),
				'default'	=> esc_html__( 'Label', 'arter-plugin' ),
			]
		);

		$this->add_control(
			'items',
			[
				'label' => esc_html__( 'Numbers Items', 'arter-plugin' ),
				'type' => Controls_Manager::REPEATER,
				'prevent_empty' => false,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ label }}}',
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
			'item_value_color',
			[
				'label'     => esc_html__( 'Number Color', 'arter-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .art-counter-frame .art-counter-box .art-counter-plus, {{WRAPPER}} .art-counter-frame .art-counter-box .art-counter' => 'color: {{VALUE}};',
				],
			]
		);		

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_value_typography',
				'label'     => esc_html__( 'Number Typography', 'arter-plugin' ),
				'selector' => '{{WRAPPER}} .art-counter-frame .art-counter-box .art-counter-plus, {{WRAPPER}} .art-counter-frame .art-counter-box .art-counter',
			]
		);

		$this->add_control(
			'item_label_color',
			[
				'label'     => esc_html__( 'Label Color', 'arter-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .art-counter-frame h6' => 'color: {{VALUE}};',
				],
			]
		);		

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_label_typography',
				'label'     => esc_html__( 'Label Typography', 'arter-plugin' ),
				'selector' => '{{WRAPPER}} .art-counter-frame h6',
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
		  <?php foreach ( $settings['items'] as $index => $item ) : 
		  $item_value = $this->get_repeater_setting_key( 'value', 'items', $index );
		  $this->add_inline_editing_attributes( $item_value, 'none' );

		  $item_label = $this->get_repeater_setting_key( 'label', 'items', $index );
		  $this->add_inline_editing_attributes( $item_label, 'basic' );
		  ?>
		  <!-- col -->
		  <div class="col-md-3 col-6">
		    <!-- couner frame -->
		    <div class="art-counter-frame">
		      <!-- counter -->
		      <div class="art-counter-box">
		        <!-- counter number -->
		        <span class="art-counter">
		        	<span <?php echo $this->get_render_attribute_string( $item_value ); ?>>
		        		<?php echo esc_html( $item['value'] ); ?>
		        	</span>
		        </span>
		        <?php if ( $item['after'] ) : ?>
		        <span class="art-counter-plus"><?php echo esc_html( $item['after'] ); ?></span>
		    	<?php endif; ?>
		      </div>
		      <!-- counter end -->
		      <!-- title -->
		      <h6>
		      	<span <?php echo $this->get_render_attribute_string( $item_label ); ?>>
	        		<?php echo wp_kses_post( $item['label'] ); ?>
	        	</span>
		      </h6>
		    </div>
		    <!-- couner frame end -->

		  </div>
		  <!-- col end -->
		  <?php endforeach; ?>
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
		<div class="row p-30-0">

		  <!-- col -->
		  <div class="col-md-3 col-6">
		  	<# _.each( settings.items, function( item, index ) { 

		    var item_value = view.getRepeaterSettingKey( 'value', 'items', index );
		    view.addInlineEditingAttributes( item_value, 'none' );

		    var item_label = view.getRepeaterSettingKey( 'label', 'items', index );
		    view.addInlineEditingAttributes( item_label, 'basic' );

		    #>
		    <!-- couner frame -->
		    <div class="art-counter-frame">
		      <!-- counter -->
		      <div class="art-counter-box">
		        <!-- counter number -->
		        <span class="art-counter">
		        	<span {{{ view.getRenderAttributeString( item_value ) }}}>
		        		{{{ item.value }}}
		        	</span>
		        </span>
		        <# if ( item.after ) { #>
		        <span class="art-counter-plus">{{{ item.after }}}</span>
		    	<# } #>
		      </div>
		      <!-- counter end -->
		      <!-- title -->
		      <h6>
		      	<span {{{ view.getRenderAttributeString( item_label ) }}}>
	        		{{{ item.label }}}
	        	</span>
		      </h6>
		    </div>
		    <!-- couner frame end -->

		  </div>
		  <!-- col end -->
		  <# }); #>
		</div>
		<!-- row end -->
		<# } #>

		</div>
		<!-- container end -->

		<?php 
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Arter_Numbers_Widget() );