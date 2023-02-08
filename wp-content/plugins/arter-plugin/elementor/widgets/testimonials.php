<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 
/**
 * Arter Testimonials Widget.
 *
 * @since 1.0
 */
class Arter_Testimonials_Widget extends Widget_Base {

	public function get_name() {
		return 'arter-testimonials';
	}

	public function get_title() {
		return esc_html__( 'Testimonials', 'arter-plugin' );
	}

	public function get_icon() {
		return 'far fa-comments';
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
			'subname', [
				'label'       => esc_html__( 'Subname', 'arter-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter subname', 'arter-plugin' ),
				'default'	=> esc_html__( 'Enter subname', 'arter-plugin' ),
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
			'rating', [
				'label'       => esc_html__( 'Rating', 'arter-plugin' ),
				'type'        => Controls_Manager::NUMBER,
				'placeholder' => esc_html__( 'Enter rating', 'arter-plugin' ),
				'default'	=> 5,
				'min' => 0,
				'max' => 5,
				'step' => 1,
			]
		);

		$this->add_control(
			'items',
			[
				'label' => esc_html__( 'Testimonials Items', 'arter-plugin' ),
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
				'label'     => esc_html__( 'Name Color', 'arter-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .art-testimonial .testimonial-body h5' => 'color: {{VALUE}};',
				],
			]
		);		

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_name_typography',
				'label'     => esc_html__( 'Name Typography', 'arter-plugin' ),
				'selector' => '{{WRAPPER}} .art-testimonial .testimonial-body h5',
			]
		);

		$this->add_control(
			'item_subname_color',
			[
				'label'     => esc_html__( 'Subname Color', 'arter-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .art-testimonial .testimonial-body .art-el-suptitle' => 'color: {{VALUE}};',
				],
			]
		);		

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_subname_typography',
				'label'     => esc_html__( 'Subname Typography', 'arter-plugin' ),
				'selector' => '{{WRAPPER}} .art-testimonial .testimonial-body .art-el-suptitle',
			]
		);

		$this->add_control(
			'item_desc_color',
			[
				'label'     => esc_html__( 'Description Color', 'arter-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .art-testimonial .testimonial-body .art-el-description' => 'color: {{VALUE}};',
				],
			]
		);		

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_desc_typography',
				'label'     => esc_html__( 'Description Typography', 'arter-plugin' ),
				'selector' => '{{WRAPPER}} .art-testimonial .testimonial-body .art-el-description',
			]
		);
		
		$this->add_control(
			'item_rating_color',
			[
				'label'     => esc_html__( 'Rating Color', 'arter-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .art-testimonial .art-testimonial-footer .art-star-rate' => 'color: {{VALUE}};',
				],
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

		  <!-- col -->
		  <div class="col-lg-12">
		  	<?php if ( $settings['items'] ) : ?>
		    <!-- slider container -->
		    <div class="swiper-container art-testimonial-slider" style="overflow: visible">
		      <!-- slider wrapper -->
		      <div class="swiper-wrapper">
		      	<?php foreach ( $settings['items'] as $index => $item ) : 
			    $item_name = $this->get_repeater_setting_key( 'name', 'items', $index );
			    $this->add_inline_editing_attributes( $item_name, 'none' );

			    $item_subname = $this->get_repeater_setting_key( 'subname', 'items', $index );
			    $this->add_inline_editing_attributes( $item_subname, 'none' );

			    $item_desc = $this->get_repeater_setting_key( 'desc', 'items', $index );
			    $this->add_inline_editing_attributes( $item_desc, 'advanced' );
			    ?>
		        <!-- slide -->
		        <div class="swiper-slide">

		          <!-- testimonial -->
		          <div class="art-a art-testimonial">
		            <!-- testimonial body -->
		            <div class="testimonial-body">
		              <?php if ( $item['image'] ) : $image = wp_get_attachment_image_url( $item['image']['id'], 'arter_140x140' ); ?>
		              <!-- photo -->
		              <img class="art-testimonial-face" src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $item['name'] ); ?>">
		              <?php endif; ?>
		              <?php if ( $item['name'] ) : ?>
		              <!-- name -->
		              <h5>
		              	<span <?php echo $this->get_render_attribute_string( $item_name ); ?>>
							<?php echo wp_kses_post( $item['name'] ); ?>
						</span>
		              </h5>
		              <?php endif; ?>
		              <?php if ( $item['subname'] ) : ?>
		              <div class="art-el-suptitle mb-15">
		              	<span <?php echo $this->get_render_attribute_string( $item_subname ); ?>>
							<?php echo wp_kses_post( $item['subname'] ); ?>
						</span>
		              </div>
		              <?php endif; ?>
		              <?php if ( $item['desc'] ) : ?>
		              <!-- text -->
		              <div class="mb-15 art-el-description">
		              	<div <?php echo $this->get_render_attribute_string( $item_desc ); ?>>
							<?php echo wp_kses_post( $item['desc'] ); ?>
						</div>
		              </div>
		              <?php endif; ?>
		            </div>
		            <!-- testimonial body end -->
		            <!-- testimonial footer -->
		            <div class="art-testimonial-footer">
		              <div class="art-left-side">
		                <?php if ( $item['rating'] ) : ?>
		                <!-- star rate -->
		                <ul class="art-star-rate">
		                  <?php for ( $i = 1; $i <= 5; $i++ ) : ?>
		                  <?php if ( $item['rating'] >= $i ) : ?>
		                  <li><i class="fas fa-star"></i></li>
		                  <?php else : ?>
		                  <li class="art-empty-item"><i class="fas fa-star"></i></li>
		              	  <?php endif; ?>
		                  <?php endfor; ?>
		                </ul>
		                <!-- star rate end -->
		            	<?php endif; ?>
		              </div>
		              <div class="art-right-side">

		              </div>
		            </div>
		            <!-- testimonial footer end -->
		          </div>
		          <!-- testimonial end -->

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
		        <div class="swiper-pagination art-testi-swiper-pagination"></div>

		      </div>
		      <!-- left side end -->

		      <!-- right side -->
		      <div class="art-sn-right">

		        <!-- slider navigation -->
		        <div class="art-slider-nav-frame">
		          <!-- prev -->
		          <div class="art-slider-nav art-testi-swiper-prev"><i class="fas fa-chevron-left"></i></div>
		          <!-- next -->
		          <div class="art-slider-nav art-testi-swiper-next"><i class="fas fa-chevron-right"></i></div>
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
		    <div class="swiper-container art-testimonial-slider" style="overflow: visible">
		      <!-- slider wrapper -->
		      <div class="swiper-wrapper">
		      	<# _.each( settings.items, function( item, index ) { 

			    var item_name = view.getRepeaterSettingKey( 'name', 'items', index );
			    view.addInlineEditingAttributes( item_name, 'none' );

			    var item_subname = view.getRepeaterSettingKey( 'subname', 'items', index );
			    view.addInlineEditingAttributes( item_subname, 'none' );

			    var item_desc = view.getRepeaterSettingKey( 'desc', 'items', index );
			    view.addInlineEditingAttributes( item_desc, 'advanced' );

			    #>
		        <!-- slide -->
		        <div class="swiper-slide">

		          <!-- testimonial -->
		          <div class="art-a art-testimonial">
		            <!-- testimonial body -->
		            <div class="testimonial-body">
		              <# if ( item.image ) { #>
		              <!-- photo -->
		              <img class="art-testimonial-face" src="{{{ item.image.url }}}" alt="{{{ item.name }}}">
		              <# } #>
		              <# if ( item.name ) { #>
		              <!-- name -->
		              <h5>
		              	<span {{{ view.getRenderAttributeString( item_name ) }}}>
							{{{ item.name }}}
						</span>
		              </h5>
		              <# } #>
		              <# if ( item.subname ) { #>
		              <div class="art-el-suptitle mb-15">
		              	<span {{{ view.getRenderAttributeString( item_subname ) }}}>
							{{{ item.subname }}}
						</span>
		              </div>
		              <# } #>
		              <# if ( item.desc ) { #>
		              <!-- text -->
		              <div class="mb-15 art-el-description">
		              	<div {{{ view.getRenderAttributeString( item_desc ) }}}>
							{{{ item.desc }}}
						</div>
		              </div>
		              <# } #>
		            </div>
		            <!-- testimonial body end -->
		            <!-- testimonial footer -->
		            <div class="art-testimonial-footer">
		              <div class="art-left-side">
		                <# if ( item.rating ) { #>
		                <!-- star rate -->
		                <ul class="art-star-rate">
		                  <# for ( var i = 0; i < 5; i++ ) { #>
		                  <# if ( item.rating >= i ) { #>
		                  <li><i class="fas fa-star"></i></li>
		                  <# } else { #>
		                  <li class="art-empty-item"><i class="fas fa-star"></i></li>
		                  <# } #>
		                  <# } #>
		                </ul>
		                <!-- star rate end -->
		            	<# } #>
		              </div>
		              <div class="art-right-side">

		              </div>
		            </div>
		            <!-- testimonial footer end -->
		          </div>
		          <!-- testimonial end -->

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
		        <div class="swiper-pagination art-testi-swiper-pagination"></div>

		      </div>
		      <!-- left side end -->

		      <!-- right side -->
		      <div class="art-sn-right">

		        <!-- slider navigation -->
		        <div class="art-slider-nav-frame">
		          <!-- prev -->
		          <div class="art-slider-nav art-testi-swiper-prev"><i class="fas fa-chevron-left"></i></div>
		          <!-- next -->
		          <div class="art-slider-nav art-testi-swiper-next"><i class="fas fa-chevron-right"></i></div>
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

Plugin::instance()->widgets_manager->register_widget_type( new Arter_Testimonials_Widget() );