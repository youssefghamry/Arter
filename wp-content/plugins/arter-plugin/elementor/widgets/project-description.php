<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 
/**
 * Arter Project Description Widget.
 *
 * @since 1.0
 */
class Arter_Project_Description_Widget extends Widget_Base {

	public function get_name() {
		return 'arter-project-description';
	}

	public function get_title() {
		return esc_html__( 'Project Description', 'arter-plugin' );
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
			'content_tab',
			[
				'label' => esc_html__( 'Content', 'arter-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'description',
			[
				'label'       => esc_html__( 'Description', 'arter-plugin' ),
				'type'        => Controls_Manager::WYSIWYG,
				'placeholder' => esc_html__( 'Enter your description', 'arter-plugin' ),
				'default'     => esc_html__( 'Type your description here', 'arter-plugin' ),
			]
		);

		$this->add_control(
			'button',
			[
				'label'       => esc_html__( 'Button (label)', 'arter-plugin' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Button', 'arter-plugin' ),
			]
		);

		$this->add_control(
			'link',
			[
				'label'       => esc_html__( 'Button (link)', 'arter-plugin' ),
				'type' => Controls_Manager::URL,
				'show_external' => true,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'attrs_tab',
			[
				'label' => esc_html__( 'Attributes', 'arter-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'label', [
				'label'       => esc_html__( 'Label', 'arter-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter label', 'arter-plugin' ),
				'default'	=> esc_html__( 'Enter label', 'arter-plugin' ),
			]
		);

		$repeater->add_control(
			'value', [
				'label'       => esc_html__( 'Value', 'arter-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter value', 'arter-plugin' ),
				'default'	=> esc_html__( 'Enter value', 'arter-plugin' ),
			]
		);

		$this->add_control(
			'attrs',
			[
				'label' => esc_html__( 'Attributes', 'arter-plugin' ),
				'type' => Controls_Manager::REPEATER,
				'prevent_empty' => false,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ label }}}',
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
			'description_styling',
			[
				'label'     => esc_html__( 'Description', 'arter-plugin' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'description_color',
			[
				'label'     => esc_html__( 'Description Color', 'arter-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .single-post-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label'     => esc_html__( 'Description Typography', 'arter-plugin' ),
				'name'     => 'description_typography',
				'selector' => '{{WRAPPER}} .single-post-text',
			]
		);

		$this->add_control(
			'description_btn_color',
			[
				'label'     => esc_html__( 'Button Color', 'arter-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .art-link' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label'     => esc_html__( 'Button Typography', 'arter-plugin' ),
				'name'     => 'description_btn_typography',
				'selector' => '{{WRAPPER}} .art-link',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'attrs_styling',
			[
				'label'     => esc_html__( 'Attributes', 'arter-plugin' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'attrs_label_color',
			[
				'label'     => esc_html__( 'Attributes Label Color', 'arter-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .art-table li h5' => 'color: {{VALUE}};',
				],
			]
		);		

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label'     => esc_html__( 'Attributes Label Typography', 'arter-plugin' ),
				'name'     => 'attrs_label_typography',
				'selector' => '{{WRAPPER}} .art-table li h5',
			]
		);

		$this->add_control(
			'attrs_value_color',
			[
				'label'     => esc_html__( 'Attributes Value Color', 'arter-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .art-table li span' => 'color: {{VALUE}};',
				],
			]
		);		

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label'     => esc_html__( 'Attributes Value Typography', 'arter-plugin' ),
				'name'     => 'attrs_value_typography',
				'selector' => '{{WRAPPER}} .art-table li span',
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
		$this->add_inline_editing_attributes( 'button', 'none' );
		$this->add_inline_editing_attributes( 'description', 'advanced' );

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

		  <?php if ( $settings['description'] || $settings['button'] ) : ?>
		  <!-- col -->
		  <div class="<?php if ( count( $settings['attrs'] ) ) : ?>col-lg-8<?php else : ?>col-lg-12<?php endif; ?>">
		    <div class="art-a art-card art-fluid-card">
		      <?php if ( $settings['description'] ) : ?>
		      <div class="single-post-text">
		      	<div <?php echo $this->get_render_attribute_string( 'description' ); ?>>
		          	<?php echo wp_kses_post( $settings['description'] ); ?>
		        </div>
		      </div>
			  <?php endif; ?>
			  <?php if ( $settings['button'] ) : ?>
		      <!-- button -->
		      <div class="art-buttons-frame">
		      	<a<?php if ( $settings['link'] ) : if ( $settings['link']['is_external'] ) : ?> target="_blank"<?php endif; ?><?php if ( $settings['link']['nofollow'] ) : ?> rel="nofollow"<?php endif; ?> href="<?php echo esc_url( $settings['link']['url'] ); ?>"<?php endif; ?> class="art-link art-color-link art-w-chevron">
		      		<span <?php echo $this->get_render_attribute_string( 'button' ); ?>>
			          	<?php echo esc_html( $settings['button'] ); ?>
			        </span>
		      	</a>
		      </div>
		  	  <?php endif; ?>
		    </div>
		  </div>
		  <!-- col end -->
		  <?php endif; ?>

		  <?php if ( count( $settings['attrs'] ) ) : ?>
		  <!-- col -->
		  <div class="col-lg-4">

		    <div class="art-a art-card">
		      <!-- table -->
		      <div class="art-table p-15-15">
		        <ul>
		          <?php foreach ( $settings['attrs'] as $index => $item ) : 
				  $item_label = $this->get_repeater_setting_key( 'label', 'attrs', $index );
				  $this->add_inline_editing_attributes( $item_label, 'basic' );

				  $item_value = $this->get_repeater_setting_key( 'value', 'attrs', $index );
				  $this->add_inline_editing_attributes( $item_value, 'basic' );
				  ?>
		          <li>
		            <h6>
		            	<span <?php echo $this->get_render_attribute_string( $item_label ); ?>>
			        		<?php echo wp_kses_post( $item['label'] ); ?>
			        	</span>
		            </h6>
		            <span <?php echo $this->get_render_attribute_string( $item_value ); ?>>
		        		<?php echo wp_kses_post( $item['value'] ); ?>
		        	</span>
		          </li>
		          <?php endforeach; ?>
		        </ul>
		      </div>
		      <!-- table end -->
		    </div>

		  </div>
		  <!-- col end -->
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
		view.addInlineEditingAttributes( 'button', 'none' );
		view.addInlineEditingAttributes( 'description', 'advanced' );
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

		  <# if ( settings.description || settings.button ) { #>
		  <!-- col -->
		  <div class="<# if ( settings.attrs.length ) { #>col-lg-8<# } else { #>col-lg-12<# } #>">
		    <div class="art-a art-card art-fluid-card">
		      <# if ( settings.description ) { #>
		      <div class="single-post-text">
		        <div {{{ view.getRenderAttributeString( 'description' ) }}}>
					{{{ settings.description }}}
				</div>
		      </div>
			  <# } #>
			  <# if ( settings.button ) { #>
		      <!-- button -->
		      <div class="art-buttons-frame">
		      	<a<# if ( settings.link ) { if ( settings.link.is_external ) { #> target="_blank"<# } #><# if ( settings.link.nofollow ) { #> rel="nofollow"<# } #> href="{{{ settings.link.url }}}"<# } #> class="art-link art-color-link art-w-chevron">
			        <span {{{ view.getRenderAttributeString( 'button' ) }}}>
						{{{ settings.button }}}
					</span>
		      	</a>
		      </div>
		  	  <# } #>
		    </div>
		  </div>
		  <!-- col end -->
		  <# } #>

		  <# if ( settings.attrs.length ) { #>
		  <!-- col -->
		  <div class="col-lg-4">

		    <div class="art-a art-card">
		      <!-- table -->
		      <div class="art-table p-15-15">
		        <ul>
		          <# _.each( settings.attrs, function( item, index ) { 

					var item_label = view.getRepeaterSettingKey( 'label', 'attrs', index );
					view.addInlineEditingAttributes( item_label, 'basic' );

					var item_value = view.getRepeaterSettingKey( 'value', 'attrs', index );
					view.addInlineEditingAttributes( item_value, 'basic' );

				  #>
		          <li>
		          	<# if ( item.label ) { #>
		            <h6>
		            	<span {{{ view.getRenderAttributeString( item_label ) }}}>
							{{{ item.label }}}
						</span>
		            </h6>
		            <# } #>
		            <# if ( item.value ) { #>
		            <span {{{ view.getRenderAttributeString( item_value ) }}}>
						{{{ item.value }}}
					</span>
					<# } #>
		          </li>
		          <# }); #>
		        </ul>
		      </div>
		      <!-- table end -->
		    </div>

		  </div>
		  <!-- col end -->
		  <# } #>
		</div>
		<!-- row end -->

		</div>
		<!-- container end -->

		<?php 
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Arter_Project_Description_Widget() );