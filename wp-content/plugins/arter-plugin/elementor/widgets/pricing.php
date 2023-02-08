<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 
/**
 * Arter Pricing Widget.
 *
 * @since 1.0
 */
class Arter_Pricing_Widget extends Widget_Base {

	public function get_name() {
		return 'arter-pricing';
	}

	public function get_title() {
		return esc_html__( 'Pricing', 'arter-plugin' );
	}

	public function get_icon() {
		return 'fas fa-dollar-sign';
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
			'price', [
				'label'       => esc_html__( 'Price', 'arter-plugin' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => 100,
				'default'	=> 100,
			]
		);

		$repeater->add_control(
			'price_before', [
				'label'       => esc_html__( 'Price (before)', 'arter-plugin' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( '$', 'arter-plugin' ),
				'default'	=> esc_html__( '$', 'arter-plugin' ),
			]
		);

		$repeater->add_control(
			'price_after', [
				'label'       => esc_html__( 'Price (after)', 'arter-plugin' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'hour', 'arter-plugin' ),
				'default'	=> esc_html__( 'hour', 'arter-plugin' ),
			]
		);

		$repeater->add_control(
			'price_note', [
				'label'       => esc_html__( 'Price Note (*)', 'arter-plugin' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Price Note', 'arter-plugin' ),
				'default'	=> '',
			]
		);

		$repeater->add_control(
			'list', [
				'label'       => esc_html__( 'List', 'arter-plugin' ),
				'type' => Controls_Manager::WYSIWYG,
				'placeholder' => esc_html__( 'List', 'arter-plugin' ),
				'default'	=> '',
			]
		);

		$repeater->add_control(
			'button', [
				'label'       => esc_html__( 'Button (title)', 'arter-plugin' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Button Label', 'arter-plugin' ),
				'default'	=> esc_html__( 'Order Now', 'arter-plugin' ),
			]
		);

		$repeater->add_control(
			'link', [
				'label'       => esc_html__( 'Button (link)', 'arter-plugin' ),
				'type' => Controls_Manager::URL,
				'show_external' => true,
			]
		);

		$repeater->add_control(
			'badge', [
				'label'       => esc_html__( 'Popular Badge', 'arter-plugin' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'arter-plugin' ),
				'label_off' => __( 'Hide', 'arter-plugin' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'items',
			[
				'label' => esc_html__( 'Pricing Items', 'arter-plugin' ),
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
			'item_name_color',
			[
				'label'     => esc_html__( 'Title Color', 'arter-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .art-price .art-price-body h5' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label'     => esc_html__( 'Title Typography', 'arter-plugin' ),
				'name'     => 'item_name_typography',
				'selector' => '{{WRAPPER}} .art-price .art-price-body h5',
			]
		);

		$this->add_control(
			'item_price_color',
			[
				
				'label'     => esc_html__( 'Price Color', 'arter-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .art-price .art-price-body .art-price-cost .art-number' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_price_typography',
				'label'     => esc_html__( 'Price Typography', 'arter-plugin' ),
				'selector' => '{{WRAPPER}} .art-price .art-price-body .art-price-cost .art-number',
			]
		);

		$this->add_control(
			'item_price2_color',
			[
				
				'label'     => esc_html__( 'Price Secondary Color', 'arter-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .art-price .art-price-body .art-price-cost .art-number span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_price2_typography',
				'label'     => esc_html__( 'Price Secondary Typography', 'arter-plugin' ),
				'selector' => '{{WRAPPER}} .art-price .art-price-body .art-price-cost .art-number span',
			]
		);

		$this->add_control(
			'item_list_color',
			[
				
				'label'     => esc_html__( 'List Color', 'arter-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .art-price .art-price-body .art-price-list' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_list_typography',
				'label'     => esc_html__( 'List Typography', 'arter-plugin' ),
				'selector' => '{{WRAPPER}} .art-price .art-price-body .art-price-list',
			]
		);

		$this->add_control(
			'item_button_color',
			[
				
				'label'     => esc_html__( 'Button Color', 'arter-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .art-price .art-price-body .art-link' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_button_typography',
				'label'     => esc_html__( 'Button Typography', 'arter-plugin' ),
				'selector' => '{{WRAPPER}} .art-price .art-price-body .art-price-list',
			]
		);

		$this->add_control(
			'item_badge_color',
			[
				
				'label'     => esc_html__( 'Popular Badge Color', 'arter-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .art-price.art-popular-price:before' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'item_badge_bg_color',
			[
				
				'label'     => esc_html__( 'Popular Badge Background', 'arter-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .art-price.art-popular-price:before' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_badge_typography',
				'label'     => esc_html__( 'Popular Badge Typography', 'arter-plugin' ),
				'selector' => '{{WRAPPER}} .art-price.art-popular-price:before',
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
		<div class="row p-0-0">

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

		  $item_price = $this->get_repeater_setting_key( 'price', 'items', $index );
		  $this->add_inline_editing_attributes( $item_price, 'none' );

		  $item_price_before = $this->get_repeater_setting_key( 'price_before', 'items', $index );
		  $this->add_inline_editing_attributes( $item_price_before, 'none' );

		  $item_price_after = $this->get_repeater_setting_key( 'price_after', 'items', $index );
	 	  $this->add_inline_editing_attributes( $item_price_after, 'none' );
	 	  
	 	  $item_price_note = $this->get_repeater_setting_key( 'price_note', 'items', $index );
	 	  $this->add_inline_editing_attributes( $item_price_note, 'basic' );

	 	  $item_list = $this->get_repeater_setting_key( 'list', 'items', $index );
		  $this->add_inline_editing_attributes( $item_list, 'advanced' );

		  $item_button = $this->get_repeater_setting_key( 'button', 'items', $index );
		  $this->add_inline_editing_attributes( $item_button, 'none' );
		  ?>
		  <!-- col -->
		  <div class="col-lg-4">

		    <!-- price -->
		    <div class="art-a art-price<?php if ( $item['badge'] == 'yes' ) : ?> art-popular-price<?php endif; ?>">
		      <!-- price body -->
		      <div class="art-price-body">
		      	<?php if ( $item['name'] ) : ?>
		        <h5 class="mb-30">
		        	<span <?php echo $this->get_render_attribute_string( $item_name ); ?>>
						<?php echo wp_kses_post( $item['name'] ); ?>
					</span>
		        </h5>
		        <?php endif; ?>
		        <!-- price cost -->
		        <div class="art-price-cost">
		          <div class="art-number">
		          	<?php if ( $item['price_before'] ) : ?>
		          	<span class="art-number-span">
			          	<span <?php echo $this->get_render_attribute_string( $item_price_before ); ?>>
							<?php echo esc_html( $item['price_before'] ); ?>
						</span>
					</span>
					<?php endif; ?>
					<?php if ( $item['price'] ) : ?>
		          	<span <?php echo $this->get_render_attribute_string( $item_price ); ?>>
						<?php echo esc_html( $item['price'] ); ?>
					</span>
					<?php endif; ?>
					<?php if ( $item['price_after'] ) : ?>
		          	<span class="art-number-span">
			          	<span <?php echo $this->get_render_attribute_string( $item_price_after ); ?>>
							<?php echo esc_html( $item['price_after'] ); ?>
						</span>
					</span>
					<?php endif; ?>
		          	<?php if ( $item['price_note'] ) : ?>
		          	<sup><?php echo esc_html__('*', 'arter-plugin' ); ?></sup>
		          	<?php endif; ?>
		          </div>
		        </div>
		        <!-- price cost end -->
		        <?php if ( $item['list'] ) : ?>
		        <!-- price list -->
		        <div class="art-price-list">
		          	<div <?php echo $this->get_render_attribute_string( $item_list ); ?>>
						<?php echo wp_kses_post( $item['list'] ); ?>
					</div>
		        </div>
		        <!-- price list end -->
		        <?php endif; ?>
		        <?php if ( $item['button'] ) : ?>
		        <!-- button -->
		        <a<?php if ( $item['link'] ) : if ( $item['link']['is_external'] ) : ?> target="_blank"<?php endif; ?><?php if ( $item['link']['nofollow'] ) : ?> rel="nofollow"<?php endif; ?> href="<?php echo esc_url( $item['link']['url'] ); ?>"<?php endif; ?> class="art-link art-color-link art-w-chevron">
		        	<span <?php echo $this->get_render_attribute_string( $item_button ); ?>>
						<?php echo esc_html( $item['button'] ); ?>
					</span>
		        </a>
		        <?php endif; ?>
		        <?php if ( $item['price_note'] ) : ?>
		        <div class="art-asterisk"><sup><?php echo esc_html__('*', 'arter-plugin' ); ?></sup>
		        	<span <?php echo $this->get_render_attribute_string( $item_price_note ); ?>>
						<?php echo wp_kses_post( $item['price_note'] ); ?>
					</span>
		        </div>
		        <?php endif; ?>
		      </div>
		      <!-- price body end -->
		    </div>
		    <!-- price end -->

		  </div>
		  <!-- grid -->
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
		<div class="row p-0-0">

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

		    var item_price = view.getRepeaterSettingKey( 'price', 'items', index );
		    view.addInlineEditingAttributes( item_price, 'none' );

		    var item_price_before = view.getRepeaterSettingKey( 'price_before', 'items', index );
		    view.addInlineEditingAttributes( item_price_before, 'none' );

		    var item_price_after = view.getRepeaterSettingKey( 'price_after', 'items', index );
		    view.addInlineEditingAttributes( item_price_after, 'none' );

		    var item_price_note = view.getRepeaterSettingKey( 'price_note', 'items', index );
		    view.addInlineEditingAttributes( item_price_note, 'basic' );

		    var item_list = view.getRepeaterSettingKey( 'list', 'items', index );
		    view.addInlineEditingAttributes( item_list, 'advanced' );

		    var item_button = view.getRepeaterSettingKey( 'button', 'items', index );
		    view.addInlineEditingAttributes( item_button, 'none' );

		    #>
		  <!-- col -->
		  <div class="col-lg-4">

		    <!-- price -->
		    <div class="art-a art-price<# if ( item.badge == 'yes' ) { #> art-popular-price<# } #>">
		      <!-- price body -->
		      <div class="art-price-body">
		      	<# if ( item.name ) { #>
		        <h5 class="mb-30">
					<span {{{ view.getRenderAttributeString( item_name ) }}}>
						{{{ item.name }}}
					</span>
		        </h5>
		        <# } #>
		        <!-- price cost -->
		        <div class="art-price-cost">
		          <div class="art-number">
		          	<# if ( item.price_before ) { #>
		          	<span class="art-number-span">
						<span {{{ view.getRenderAttributeString( item_price_before ) }}}>
							{{{ item.price_before }}}
						</span>
					</span>
					<# } #>
					<# if ( item.price ) { #>
					<span {{{ view.getRenderAttributeString( item_price ) }}}>
						{{{ item.price }}}
					</span>
					<# } #>
					<# if ( item.price_after ) { #>
		          	<span class="art-number-span">
						<span {{{ view.getRenderAttributeString( item_price_after ) }}}>
							{{{ item.price_after }}}
						</span>
					</span>
					<# } #>
		          	<# if ( item.price_note ) { #>
		          	<sup>*</sup>
		          	<# } #>
		          </div>
		        </div>
		        <!-- price cost end -->
		        <# if ( item.list ) { #>
		        <!-- price list -->
		        <div class="art-price-list">
					<div {{{ view.getRenderAttributeString( item_list ) }}}>
						{{{ item.list }}}
					</div>
		        </div>
		        <!-- price list end -->
		        <# } #>
		        <# if ( item.button ) { #>
		        <!-- button -->
		        <a<# if ( item.link ) { #><# if ( item.link.is_external ) { #> target="_blank"<# } #><# if ( item.link.nofollow ) { #> rel="nofollow"<# } #> href="{{{ item.link.url }}}"<# } #> class="art-link art-color-link art-w-chevron">
					<span {{{ view.getRenderAttributeString( item_button ) }}}>
						{{{ item.button }}}
					</span>
		        </a>
		        <# } #>
		        <# if ( item.price_note ) { #>
		        <div class="art-asterisk"><sup><?php echo esc_html__('*', 'arter-plugin' ); ?></sup>
					<span {{{ view.getRenderAttributeString( item_price_note ) }}}>
						{{{ item.price_note }}}
					</span>
		        </div>
		        <# } #>
		      </div>
		      <!-- price body end -->
		    </div>
		    <!-- price end -->

		  </div>
		  <!-- grid -->
		  <# }); #>
		  <# } #>
		</div>
		<!-- row end -->

		</div>
		<!-- container end -->

		<?php 
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Arter_Pricing_Widget() );