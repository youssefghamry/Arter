<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 
/**
 * Arter Resume Widget.
 *
 * @since 1.0
 */
class Arter_Resume_Widget extends Widget_Base {

	public function get_name() {
		return 'arter-resume';
	}

	public function get_title() {
		return esc_html__( 'Resume', 'arter-plugin' );
	}

	public function get_icon() {
		return 'fas fa-university';
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
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter title', 'arter-plugin' ),
				'default'	=> esc_html__( 'Enter title', 'arter-plugin' ),
			]
		);

		$repeater->add_control(
			'subname', [
				'label'       => esc_html__( 'Subtitle', 'arter-plugin' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter subtitle', 'arter-plugin' ),
				'default'	=> esc_html__( 'Enter subtitle', 'arter-plugin' ),
			]
		);

		$repeater->add_control(
			'date', [
				'label'       => esc_html__( 'Date', 'arter-plugin' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => esc_html__( 'Enter date', 'arter-plugin' ),
				'default'	=> esc_html__( 'Enter date', 'arter-plugin' ),
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
				'default'	=> esc_html__( 'Button', 'arter-plugin' ),
			]
		);

		$repeater->add_control(
			'button_type', [
				'label'       => esc_html__( 'Button (Type)', 'arter-plugin' ),
				'type'        => Controls_Manager::SELECT,
				'default' => 'link',
				'options' => [
					'link'  => __( 'Link', 'arter-plugin' ),
					'image' => __( 'Image', 'arter-plugin' ),
					'testimonial' => __( 'Testimonial', 'arter-plugin' ),
				],
			]
		);

		$repeater->add_control(
			'link', [
				'label'       => esc_html__( 'Button (Link)', 'arter-plugin' ),
				'type' => Controls_Manager::URL,
				'show_external' => true,
				'condition' => [
					'button_type' => 'link'
				]
			]
		);

		$repeater->add_control(
			'image', [
				'label'       => esc_html__( 'Image', 'arter-plugin' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'button_type' => 'image'
				]
			]
		);

		$repeater->add_control(
			'rev_image', [
				'label' => esc_html__( 'Image', 'arter-plugin' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'button_type' => 'testimonial'
				]
			]
		);

		$repeater->add_control(
			'rev_name', [
				'label'       => esc_html__( 'Name', 'arter-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter name', 'arter-plugin' ),
				'default'	=> esc_html__( 'Enter name', 'arter-plugin' ),
				'condition' => [
					'button_type' => 'testimonial'
				]
			]
		);

		$repeater->add_control(
			'rev_subname', [
				'label'       => esc_html__( 'Subname', 'arter-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter subname', 'arter-plugin' ),
				'default'	=> esc_html__( 'Enter subname', 'arter-plugin' ),
				'condition' => [
					'button_type' => 'testimonial'
				]
			]
		);

		$repeater->add_control(
			'rev_desc', [
				'label'       => esc_html__( 'Description', 'arter-plugin' ),
				'type'        => Controls_Manager::WYSIWYG,
				'placeholder' => esc_html__( 'Enter description', 'arter-plugin' ),
				'default'	=> esc_html__( 'Enter description', 'arter-plugin' ),
				'condition' => [
					'button_type' => 'testimonial'
				]
			]
		);

		$repeater->add_control(
			'rev_rating', [
				'label'       => esc_html__( 'Rating', 'arter-plugin' ),
				'type'        => Controls_Manager::NUMBER,
				'placeholder' => esc_html__( 'Enter rating', 'arter-plugin' ),
				'default'	=> 5,
				'min' => 0,
				'max' => 5,
				'step' => 1,
				'condition' => [
					'button_type' => 'testimonial'
				]
			]
		);

		$this->add_control(
			'items',
			[
				'label' => esc_html__( 'Items', 'arter-plugin' ),
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
					'{{WRAPPER}} .art-section-title .art-title-h' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .art-section-title .art-title-h',
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
			'item_date_color',
			[
				'label'     => esc_html__( 'Date Color', 'arter-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .art-timeline .art-timeline-content .art-card-header .art-right-side .art-date' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'item_date_bgcolor',
			[
				'label'     => esc_html__( 'Date Background', 'arter-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .art-timeline .art-timeline-content .art-card-header .art-right-side .art-date' => 'background-color: {{VALUE}};',
				],
			]
		);		

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_date_typography',
				'label'     => esc_html__( 'Date Typography', 'arter-plugin' ),
				'selector' => '{{WRAPPER}} .art-timeline .art-timeline-content .art-card-header .art-right-side .art-date',
			]
		);

		$this->add_control(
			'item_name_color',
			[
				'label'     => esc_html__( 'Title Color', 'arter-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .art-timeline .art-timeline-content .art-card-header h5' => 'color: {{VALUE}};',
				],
			]
		);		

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_name_typography',
				'label'     => esc_html__( 'Title Typography', 'arter-plugin' ),
				'selector' => '{{WRAPPER}} .art-timeline .art-timeline-content .art-card-header h5',
			]
		);

		$this->add_control(
			'item_subname_color',
			[
				'label'     => esc_html__( 'Subtitle Color', 'arter-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .art-timeline .art-timeline-content .art-card-header .art-el-suptitle' => 'color: {{VALUE}};',
				],
			]
		);		

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_subname_typography',
				'label'     => esc_html__( 'Subtitle Typography', 'arter-plugin' ),
				'selector' => '{{WRAPPER}} .art-timeline .art-timeline-content .art-card-header .art-el-suptitle',
			]
		);

		$this->add_control(
			'item_desc_color',
			[
				'label'     => esc_html__( 'Description Color', 'arter-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .art-timeline .art-timeline-content .art-el-description' => 'color: {{VALUE}};',
				],
			]
		);		

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_desc_typography',
				'label'     => esc_html__( 'Description Typography', 'arter-plugin' ),
				'selector' => '{{WRAPPER}} .art-timeline .art-timeline-content .art-el-description',
			]
		);

		$this->add_control(
			'item_button_color',
			[
				'label'     => esc_html__( 'Button Color', 'arter-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .art-timeline .art-timeline-content .art-link' => 'color: {{VALUE}};',
				],
			]
		);		

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_button_typography',
				'label'     => esc_html__( 'Button Typography', 'arter-plugin' ),
				'selector' => '{{WRAPPER}} .art-timeline .art-timeline-content .art-link',
			]
		);

		$this->add_control(
			'rev_name_color',
			[
				'label'     => esc_html__( 'Testimonial Name Color', 'arter-plugin' ),
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
				'name'     => 'rev_name_typography',
				'label'     => esc_html__( 'Testimonial Name Typography', 'arter-plugin' ),
				'selector' => '{{WRAPPER}} .art-testimonial .testimonial-body h5',
			]
		);

		$this->add_control(
			'rev_subname_color',
			[
				'label'     => esc_html__( 'Testimonial Subname Color', 'arter-plugin' ),
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
				'name'     => 'rev_subname_typography',
				'label'     => esc_html__( 'Testimonial Subname Typography', 'arter-plugin' ),
				'selector' => '{{WRAPPER}} .art-testimonial .testimonial-body .art-el-suptitle',
			]
		);

		$this->add_control(
			'rev_desc_color',
			[
				'label'     => esc_html__( 'Testimonial Description Color', 'arter-plugin' ),
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
				'name'     => 'rev_desc_typography',
				'label'     => esc_html__( 'Testimonial Description Typography', 'arter-plugin' ),
				'selector' => '{{WRAPPER}} .art-testimonial .testimonial-body .art-el-description',
			]
		);
		
		$this->add_control(
			'rev_rating_color',
			[
				'label'     => esc_html__( 'Testimonial Rating Color', 'arter-plugin' ),
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

		$theme_lightbox = get_field( 'portfolio_lightbox_disable', 'option' );

		?>

		<?php if ( $settings['title'] ) : ?>
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
	  	<?php endif; ?>

        <!-- timeline -->
        <div class="art-timeline art-gallery">
          <?php if ( $settings['items'] ) : ?>
          <?php foreach ( $settings['items'] as $index => $item ) : $i = rand();
		  $item_name = $this->get_repeater_setting_key( 'name', 'items', $index );
		  $this->add_inline_editing_attributes( $item_name, 'none' );

		  $item_subname = $this->get_repeater_setting_key( 'subname', 'items', $index );
		  $this->add_inline_editing_attributes( $item_subname, 'none' );

		  $item_date = $this->get_repeater_setting_key( 'date', 'items', $index );
		  $this->add_inline_editing_attributes( $item_date, 'none' );

		  $item_desc = $this->get_repeater_setting_key( 'desc', 'items', $index );
		  $this->add_inline_editing_attributes( $item_desc, 'advanced' );

		  $item_button = $this->get_repeater_setting_key( 'button_label', 'items', $index );
		  $this->add_inline_editing_attributes( $item_button, 'none' );
		  ?>
          <div class="art-timeline-item">
            <div class="art-timeline-mark-light"></div>
            <div class="art-timeline-mark"></div>

            <div class="art-a art-timeline-content">
              <div class="art-card-header">
                <div class="art-left-side">
                  <?php if ( $item['name'] ) : ?>
                  <h5>
                  	<span <?php echo $this->get_render_attribute_string( $item_name ); ?>>
		        		<?php echo esc_html( $item['name'] ); ?>
		        	</span>
                  </h5>
                  <?php endif; ?>
                  <?php if ( $item['subname'] ) : ?>
                  <div class="art-el-suptitle mb-15">
                  	<span <?php echo $this->get_render_attribute_string( $item_subname ); ?>>
		        		<?php echo esc_html( $item['subname'] ); ?>
		        	</span>
                  </div>
                  <?php endif; ?>
                </div>
                <div class="art-right-side">
                  <?php if ( $item['date'] ) : ?>
                  <span class="art-date">
                  	<span <?php echo $this->get_render_attribute_string( $item_date ); ?>>
		        		<?php echo esc_html( $item['date'] ); ?>
		        	</span>
                  </span>
                  <?php endif; ?>
                </div>
              </div>
              <?php if ( $item['desc'] ) : ?>
              <div class="art-el-description">
              	<div <?php echo $this->get_render_attribute_string( $item_desc ); ?>>
	        		<?php echo wp_kses_post( $item['desc'] ); ?>
	        	</div>
	          </div>
              <?php endif; ?>
              <?php if ( $item['button_label'] ) : ?>
              <?php if ( $item['button_type'] == 'image' ) : ?>
              <a <?php if ( ! $theme_lightbox ) : ?> data-magnific-gallery<?php endif; ?> data-elementor-lightbox-slideshow="reviews" data-no-swup href="<?php echo esc_url( $item['image']['url'] ); ?>" class="art-link art-color-link art-w-chevron">
              <?php endif; ?>
              <?php if ( $item['button_type'] == 'link' ) : ?>
              <a<?php if ( $item['link'] ) : if ( $item['link']['is_external'] ) : ?> target="_blank"<?php endif; ?><?php if ( $item['link']['nofollow'] ) : ?> rel="nofollow"<?php endif; ?> href="<?php echo esc_url( $item['link']['url'] ); ?>"<?php endif; ?> class="art-link art-color-link art-w-chevron">
              <?php endif; ?>
              <?php if ( $item['button_type'] == 'testimonial' ) : ?>
              <a data-magnific-inline data-no-swup href="#art-recomendation-popup-<?php echo esc_attr( $i ); ?>" class="art-link art-color-link art-w-chevron">
              <?php endif; ?>
              	<span <?php echo $this->get_render_attribute_string( $item_button ); ?>>
	        		<?php echo esc_html( $item['button_label'] ); ?>
	        	</span>
              </a>
              <?php endif; ?>
            </div>

            <?php if ( $item['button_type'] == 'testimonial' ) : ?>
            <!-- popup -->
            <div class="art-recomendation-popup mfp-hide mfp-with-anim" id="art-recomendation-popup-<?php echo esc_attr( $i ); ?>">
              <!-- testimonial -->
              <div class="art-a art-testimonial">
                <!-- testimonial body -->
                <div class="testimonial-body">
                  <?php if ( $item['rev_image'] ) : $rev_image = wp_get_attachment_image_url( $item['rev_image']['id'], 'arter_140x140' ); ?>
                  <!-- photo -->
                  <img class="art-testimonial-face" src="<?php echo esc_url( $rev_image ); ?>" alt="<?php echo esc_attr( $item['rev_name'] ); ?>">
                  <?php endif; ?>
                  <?php if ( $item['rev_name'] ) : ?>
                  <!-- name -->
                  <h5><?php echo esc_html( $item['rev_name'] ); ?></h5>
                  <?php endif; ?>
                  <?php if ( $item['rev_subname'] ) : ?>
                  <div class="art-el-suptitle mb-15"><?php echo esc_html( $item['rev_subname'] ); ?></div>
                  <?php endif; ?>
                  <?php if ( $item['rev_desc'] ) : ?>
                  <!-- text -->
                  <div class="mb-15">
                  	<?php echo wp_kses_post( $item['rev_desc'] ); ?>
                  </div>
                  <?php endif; ?>
                </div>
                <!-- testimonial body end -->
                <!-- testimonial footer -->
                <div class="art-testimonial-footer">
                  <div class="art-left-side">
                  	<?php if ( $item['rev_rating'] ) : ?>
                    <!-- star rate -->
                    <ul class="art-star-rate">
                      <?php for ( $i = 1; $i <= 5; $i++ ) : ?>
	                  <?php if ( $item['rev_rating'] >= $i ) : ?>
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
            <!-- popup end -->
            <?php endif; ?>
          </div>
          <?php endforeach; ?>
          <?php endif; ?>
        </div>
        <!-- timeline end -->

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

		<# if ( settings.title ) { #>
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
	  	<# } #>

        <!-- timeline -->
        <div class="art-timeline art-gallery">
          <# if ( settings.items ) { var i = 0; #>
		  <# _.each( settings.items, function( item, index ) { 
		  	i++;
			var item_name = view.getRepeaterSettingKey( 'name', 'items', index );
			view.addInlineEditingAttributes( item_name, 'none' );

			var item_subname = view.getRepeaterSettingKey( 'subname', 'items', index );
			view.addInlineEditingAttributes( item_subname, 'none' );

			var item_date = view.getRepeaterSettingKey( 'date', 'items', index );
			view.addInlineEditingAttributes( item_date, 'none' );

			var item_desc = view.getRepeaterSettingKey( 'desc', 'items', index );
			view.addInlineEditingAttributes( item_desc, 'advanced' );

			var item_button = view.getRepeaterSettingKey( 'button_label', 'items', index );
			view.addInlineEditingAttributes( item_button, 'none' );

		  #>
          <div class="art-timeline-item">
            <div class="art-timeline-mark-light"></div>
            <div class="art-timeline-mark"></div>

            <div class="art-a art-timeline-content">
              <div class="art-card-header">
                <div class="art-left-side">
                  <# if ( item.name ) { #>
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
                </div>
                <div class="art-right-side">
                  <# if ( item.date ) { #>
                  <span class="art-date">
                  	<span {{{ view.getRenderAttributeString( item_date ) }}}>
						{{{ item.date }}}
					</span>
                  </span>
                  <# } #>
                </div>
              </div>
              <# if ( item.desc ) { #>
              <div class="art-el-description">
              	<div {{{ view.getRenderAttributeString( item_desc ) }}}>
					{{{ item.desc }}}
				</div>
	          </div>
              <# } #>
              <# if ( item.button_label ) { #>
              <# if ( item.button_type == 'image' ) { #>
              <a data-magnific-image data-elementor-lightbox-slideshow="reviews" data-no-swup href="{{{ item.image.url }}}" class="art-link art-color-link art-w-chevron">
              <# } #>
              <# if ( item.button_type == 'link' ) { #>
              <a<# if ( item.link ) { if ( item.link.is_external ) { #> target="_blank"<# } #><# if ( item.link.nofollow ) { #> rel="nofollow"<# } #> href="{{{ item.link.url }}}"<# } #> class="art-link art-color-link art-w-chevron">
              <# } #>
              <# if ( item.button_type == 'testimonial' ) { #>
              <a data-magnific-inline data-no-swup href="#art-recomendation-popup-{{{ i }}}" class="art-link art-color-link art-w-chevron">
              <# } #>
              	<span {{{ view.getRenderAttributeString( item_button ) }}}>
					{{{ item.button_label }}}
				</span>
              </a>
              <# } #>
            </div>

            <# if ( item.button_type == 'testimonial' ) { #>
            <!-- popup -->
            <div class="art-recomendation-popup mfp-hide mfp-with-anim" id="art-recomendation-popup-{{{ i }}}">

              <!-- testimonial -->
              <div class="art-a art-testimonial">
                <!-- testimonial body -->
                <div class="testimonial-body">
                  <# if ( item.rev_image ) { #>
                  <!-- photo -->
                  <img class="art-testimonial-face" src="{{{ item.rev_image.url }}}" alt="{{{ item.rev_name }}}">
                  <# } #>
                  <# if ( item.rev_name ) { #>
                  <!-- name -->
                  <h5>{{{ item.rev_name }}}</h5>
                  <# } #>
                  <# if ( item.rev_subname ) { #>
                  <div class="art-el-suptitle mb-15">
                  	{{{ item.rev_subname }}}
                  </div>
                  <# } #>
                  <# if ( item.rev_desc ) { #>
                  <!-- text -->
                  <div class="mb-15">
                  	{{{ item.rev_desc }}}
                  </div>
                  <# } #>
                </div>
                <!-- testimonial body end -->
                <!-- testimonial footer -->
                <div class="art-testimonial-footer">
                  <div class="art-left-side">
                  	<# if ( item.rev_rating ) { #>
                    <!-- star rate -->
                    <ul class="art-star-rate">
                      <# for ( var i = 0; i < 5; i++ ) { #>
		              <# if ( item.rev_rating >= i ) { #>
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
            <!-- popup end -->
            <# } #>
          </div>
          <# }); #>
          <# } #>
        </div>
        <!-- timeline end -->

		<?php 
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Arter_Resume_Widget() );