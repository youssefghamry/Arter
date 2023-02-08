<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 
/**
 * Arter Services Widget.
 *
 * @since 1.0
 */
class Arter_Services_Widget extends Widget_Base {

	public function get_name() {
		return 'arter-services';
	}

	public function get_title() {
		return esc_html__( 'Services', 'arter-plugin' );
	}

	public function get_icon() {
		return 'fas fa-concierge-bell';
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
			'name', [
				'label'       => esc_html__( 'Title', 'arter-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter title', 'arter-plugin' ),
				'default'	=> esc_html__( 'Enter title', 'arter-plugin' ),
			]
		);

		$repeater->add_control(
			'desc', [
				'label'       => esc_html__( 'Description', 'arter-plugin' ),
				'type'        => Controls_Manager::WYSIWYG,
				'placeholder' => esc_html__( 'Enter description', 'arter-plugin' ),
				'default'	=> esc_html__( 'Enter description', 'arter-plugin' ),
			]
		);

		$repeater->add_control(
			'button_label', [
				'label'       => esc_html__( 'Button (Label)', 'arter-plugin' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Button Label', 'arter-plugin' ),
				'default'	=> esc_html__( 'Order now', 'arter-plugin' ),
			]
		);

		$repeater->add_control(
			'link', [
				'label'       => esc_html__( 'Button (Link)', 'arter-plugin' ),
				'type' => Controls_Manager::URL,
				'show_external' => true,
			]
		);

		$this->add_control(
			'items',
			[
				'label' => esc_html__( 'Services Items', 'arter-plugin' ),
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
					'{{WRAPPER}} .art-service-icon-box .art-service-ib-content h5' => 'color: {{VALUE}};',
				],
			]
		);		

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_title_typography',
				'label'     => esc_html__( 'Title Typography', 'arter-plugin' ),
				'selector' => '{{WRAPPER}} .art-service-icon-box .art-service-ib-content h5',
			]
		);

		$this->add_control(
			'item_desc_color',
			[
				'label'     => esc_html__( 'Description Color', 'arter-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .art-service-icon-box .art-service-ib-content div.mb-15' => 'color: {{VALUE}};',
				],
			]
		);		

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_desc_typography',
				'label'     => esc_html__( 'Description Typography', 'arter-plugin' ),
				'selector' => '{{WRAPPER}} .art-service-icon-box .art-service-ib-content div.mb-15',
			]
		);

		$this->add_control(
			'item_button_color',
			[
				'label'     => esc_html__( 'Button Color', 'arter-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .art-service-icon-box .art-service-ib-content .art-link, {{WRAPPER}} .art-service-icon-box .art-service-ib-content .art-link:after' => 'color: {{VALUE}};',
				],
			]
		);		

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_button_typography',
				'label'     => esc_html__( 'Button Typography', 'arter-plugin' ),
				'selector' => '{{WRAPPER}} .art-service-icon-box .art-service-ib-content .art-link',
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
		  $item_name = $this->get_repeater_setting_key( 'name', 'items', $index );
		  $this->add_inline_editing_attributes( $item_name, 'basic' );

		  $item_desc = $this->get_repeater_setting_key( 'desc', 'items', $index );
		  $this->add_inline_editing_attributes( $item_desc, 'advanced' );

		  $item_button = $this->get_repeater_setting_key( 'button_label', 'items', $index );
		  $this->add_inline_editing_attributes( $item_button, 'none' );
		  ?>
		  <!-- col -->
		  <div class="col-lg-4 col-md-6">

		    <!-- service -->
		    <div class="art-a art-service-icon-box">
		      <!-- service content -->
		      <div class="art-service-ib-content">
		        <?php if ( $item['name'] ) : ?>
		        <!-- title -->
		        <h5 class="mb-15">
		        	<span <?php echo $this->get_render_attribute_string( $item_name ); ?>>
		        		<?php echo wp_kses_post( $item['name'] ); ?>
		        	</span>
		        </h5>
		        <?php endif; ?>
		        <?php if ( $item['desc'] ) : ?>
		        <!-- text -->
		        <div class="mb-15">
		        	<div <?php echo $this->get_render_attribute_string( $item_desc ); ?>>
		        		<?php echo wp_kses_post( $item['desc'] ); ?>
		        	</div>
		        </div>
		        <?php endif; ?>
		        <?php if ( $item['button_label'] ) : ?>
		        <!-- button -->
		        <div class="art-buttons-frame">
		        	<a<?php if ( $item['link'] ) : if ( $item['link']['is_external'] ) : ?> target="_blank"<?php endif; ?><?php if ( $item['link']['nofollow'] ) : ?> rel="nofollow"<?php endif; ?> href="<?php echo esc_url( $item['link']['url'] ); ?>"<?php endif; ?> class="art-link art-color-link art-w-chevron">
		        		<span <?php echo $this->get_render_attribute_string( $item_button ); ?>>
			        		<?php echo wp_kses_post( $item['button_label'] ); ?>
			        	</span>
		        	</a>
		        </div>
		        <?php endif; ?>
		      </div>
		      <!-- service content end -->
		    </div>
		    <!-- service end -->

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
		view.addInlineEditingAttributes( 'subtitle', 'basic' );
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

			var item_name = view.getRepeaterSettingKey( 'name', 'items', index );
			view.addInlineEditingAttributes( item_name, 'basic' );

			var item_desc = view.getRepeaterSettingKey( 'desc', 'items', index );
			view.addInlineEditingAttributes( item_desc, 'advanced' );

			var item_button = view.getRepeaterSettingKey( 'button_label', 'items', index );
			view.addInlineEditingAttributes( item_button, 'none' );

			#>
		  <!-- col -->
		  <div class="col-lg-4 col-md-6">

		    <!-- service -->
		    <div class="art-a art-service-icon-box">
		      <!-- service content -->
		      <div class="art-service-ib-content">
		        <# if ( item.name ) { #>
		        <!-- title -->
		        <h5 class="mb-15">
		        	<span {{{ view.getRenderAttributeString( item_name ) }}}>
						{{{ item.name }}}
					</span>
		        </h5>
		        <# } #>
		        <# if ( item.desc ) { #>
		        <!-- text -->
		        <div class="mb-15">
		        	<div {{{ view.getRenderAttributeString( item_desc ) }}}>
						{{{ item.desc }}}
					</div>
		        </div>
		        <# } #>
		        <# if ( item.button_label ) { #>
		        <!-- button -->
		        <div class="art-buttons-frame">
		        	<a<# if ( item.link ) { if ( item.link.is_external ) { #> target="_blank"<# } #><# if ( item.link.nofollow ) { #> rel="nofollow"<# } #> href="{{{ item.link.url }}}"<# } #> class="art-link art-color-link art-w-chevron">
		        		<span {{{ view.getRenderAttributeString( item_button ) }}}>
							{{{ item.button_label }}}
						</span>
		        	</a>
		        </div>
		        <# } #>
		      </div>
		      <!-- service content end -->
		    </div>
		    <!-- service end -->

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

Plugin::instance()->widgets_manager->register_widget_type( new Arter_Services_Widget() );