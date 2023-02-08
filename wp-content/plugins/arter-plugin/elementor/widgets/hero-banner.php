<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 
/**
 * Arter Hero Banner Widget.
 *
 * @since 1.0
 */
class Arter_Hero_Banner_Widget extends Widget_Base {

	public function get_name() {
		return 'arter-hero-banner';
	}

	public function get_title() {
		return esc_html__( 'Hero Banner', 'arter-plugin' );
	}

	public function get_icon() {
		return 'fas fa-chalkboard-teacher';
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
				'placeholder' => esc_html__( 'Enter your title', 'arter-plugin' ),
				'default'     => esc_html__( 'Title', 'arter-plugin' ),
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label'       => esc_html__( 'Title Tag', 'arter-plugin' ),
				'type'        => Controls_Manager::SELECT,
				'default' => 'h1',
				'options' => [
					'h1'  => __( 'H1', 'arter-plugin' ),
					'h2' => __( 'H2', 'arter-plugin' ),
					'h3' => __( 'H3', 'arter-plugin' ),
					'div' => __( 'DIV', 'arter-plugin' ),
				],
			]
		);
		
		$this->end_controls_section();

		$this->start_controls_section(
			'subtitle_tab',
			[
				'label' => esc_html__( 'Subtitle', 'arter-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'subtitle_show',
			[
				'label' => esc_html__( 'Show Subtitle', 'arter-plugin' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'arter-plugin' ),
				'label_off' => __( 'Hide', 'arter-plugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'subtitle_start',
			[
				'label'       => esc_html__( 'Start Text', 'arter-plugin' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter text', 'arter-plugin' ),
				'default'     => esc_html__( 'Text', 'arter-plugin' ),
				'condition' => [
		            'subtitle_show' => 'yes'
		        ],
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'text', [
				'label'       => esc_html__( 'Text', 'arter-plugin' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter text', 'arter-plugin' ),
				'default'	=> esc_html__( 'Text', 'arter-plugin' ),
			]
		);

		$this->add_control(
			'subtitle_rotate',
			[
				'label'       => esc_html__( 'Rotate Text', 'arter-plugin' ),
		        'type' => Controls_Manager::REPEATER,
				'prevent_empty' => false,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ text }}}',
				'condition' => [
		            'subtitle_show' => 'yes'
		        ],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'button_tab',
			[
				'label' => esc_html__( 'Button', 'arter-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'button',
			[
				'label'       => esc_html__( 'Button (label)', 'arter-plugin' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Button', 'arter-plugin' ),
				'default'	=> esc_html__( 'Button', 'arter-plugin' ),
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
		
		$this->add_control(
			'sec_button_true',
			[
				'label' => esc_html__( 'Show Second Button', 'arter-plugin' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'arter-plugin' ),
				'label_off' => __( 'Hide', 'arter-plugin' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		
		$this->add_control(
			'sec_button',
			[
				'label'       => esc_html__( 'Second Button (label)', 'arter-plugin' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Button', 'arter-plugin' ),
				'default'	=> esc_html__( 'Button', 'arter-plugin' ),
				'condition' => [
		            'sec_button_true' => 'yes'
		        ],
			]
		);

		$this->add_control(
			'sec_link',
			[
				'label'       => esc_html__( 'Second Button (link)', 'arter-plugin' ),
				'type' => Controls_Manager::URL,
				'show_external' => true,
				'condition' => [
		            'sec_button_true' => 'yes'
		        ],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'background_tab',
			[
				'label' => esc_html__( 'Background & Photo', 'arter-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'bg_image',
			[
				'label'       => esc_html__( 'Background Image', 'arter-plugin' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'image',
			[
				'label'       => esc_html__( 'Photo', 'arter-plugin' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
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
					'{{WRAPPER}} .art-banner .art-banner-overlay .art-banner-title .art-banner-title-h' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .art-banner .art-banner-overlay .art-banner-title .art-banner-title-h',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'subtitle_styling',
			[
				'label'     => esc_html__( 'Subtitle', 'arter-plugin' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'subtitle_color',
			[
				'label'     => esc_html__( 'Color', 'arter-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .art-banner .art-banner-overlay .art-banner-title .art-code' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'subtitle_typography',
				'selector' => '{{WRAPPER}} .art-banner .art-banner-overlay .art-banner-title .art-code',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'button_styling',
			[
				'label'     => esc_html__( 'Button', 'arter-plugin' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'button_color',
			[
				'label'     => esc_html__( 'Color', 'arter-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .art-banner .art-banner-overlay .art-btn' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_bg_color',
			[
				'label'     => esc_html__( 'Background Color', 'arter-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .art-banner .art-banner-overlay .art-btn' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'button_typography',
				'selector' => '{{WRAPPER}} .art-banner .art-banner-overlay .art-btn',
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

		$text_rotate = '';
		$i = 0;
		foreach ( $settings['subtitle_rotate'] as $item ) {
			$i++;
			$text_rotate .= '"' . $item['text'] . '"';
			if ( $i != count( $settings['subtitle_rotate'] ) ) {
				$text_rotate .= ',';
			}
		}

		?>

		<!-- container -->
		<div class="container-fluid">
			<!-- row -->
			<div class="row p-30-0 p-lg-30-0 p-md-15-0">
			  <!-- col -->
			  <div class="col-lg-12">

			    <!-- banner -->
			    <div class="art-a art-banner"<?php if ( $settings['bg_image'] ) : ?> style="background-image: url(<?php echo esc_url( $settings['bg_image']['url'] ); ?>)"<?php endif; ?>>
			      <!-- banner back -->
			      <div class="art-banner-back"></div>
			      <!-- banner dec -->
			      <div class="art-banner-dec"></div>
			      <!-- banner overlay -->
			      <div class="art-banner-overlay">
			        <!-- main title -->
			        <div class="art-banner-title">
			          <?php if ( $settings['title'] ) : ?>
			          <!-- title -->
			          <<?php echo esc_attr( $settings['title_tag'] ); ?> class="art-banner-title-h mb-15">
			          <span <?php echo $this->get_render_attribute_string( 'title' ); ?>>
			          	<?php echo wp_kses_post( $settings['title'] ); ?>
			          </span>
			          </<?php echo esc_attr( $settings['title_tag'] ); ?>>
			      	  <?php endif; ?>
			      	  <?php if ( $settings['subtitle_show'] == 'yes' ) : ?>
			          <!-- suptitle -->
			          <div class="art-lg-text art-code mb-25">
			          	&lt;<i><?php echo esc_html__( 'code', 'arter-plugin' ); ?></i>&gt; 
			          	<?php echo esc_html( $settings['subtitle_start'] ); ?>
			          	<?php if ( $settings['subtitle_rotate'] ) : ?>
			          	<span class="txt-rotate" data-period="2000"
			              data-rotate='[ <?php echo esc_attr( $text_rotate ); ?> ]'></span>
			            <?php endif; ?>
			            &lt;/<i><?php echo esc_html__( 'code', 'arter-plugin' ); ?></i>&gt;
			          </div>
			          <?php endif; ?>
			          <?php if ( $settings['button'] ) : ?>
			          <div class="art-buttons-frame">
			            <!-- button -->
			            <a<?php if ( $settings['link'] ) : if ( $settings['link']['is_external'] ) : ?> target="_blank"<?php endif; ?><?php if ( $settings['link']['nofollow'] ) : ?> rel="nofollow"<?php endif; ?> href="<?php echo esc_url( $settings['link']['url'] ); ?>"<?php endif; ?> class="art-btn art-btn-md"><span><?php echo esc_html( $settings['button'] ); ?></span></a>
			          </div>
			          <?php endif; ?>
					  <?php if ( $settings['sec_button'] && $settings['sec_button_true'] ) : ?>
			          <div class="art-buttons-frame second">
			            <!-- button -->
			            <a<?php if ( $settings['sec_link'] ) : if ( $settings['sec_link']['is_external'] ) : ?> target="_blank"<?php endif; ?><?php if ( $settings['sec_link']['nofollow'] ) : ?> rel="nofollow"<?php endif; ?> href="<?php echo esc_url( $settings['sec_link']['url'] ); ?>"<?php endif; ?> class="art-btn art-btn-md"><span><?php echo esc_html( $settings['sec_button'] ); ?></span></a>
			          </div>
			          <?php endif; ?>
			        </div>
			        <!-- main title end -->
			        <?php if ( $settings['image'] ) : ?>
			        <!-- photo -->
			        <img src="<?php echo esc_url( $settings['image']['url'] ); ?>" class="art-banner-photo" alt="<?php echo esc_html__( 'Photo', 'arter-plugin' ); ?>">
			        <?php endif; ?>
			      </div>
			      <!-- banner overlay end -->
			    </div>
			    <!-- banner end -->

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

		var text_rotate = '';
		_.each( settings.subtitle_rotate, function( item, index ) {
			text_rotate += '"' + item.text + '"';
			if ( index != settings.subtitle_rotate.length-1 ) {
				text_rotate += ',';
			}
		});
		#>

		<!-- container -->
		<div class="container-fluid">
			<!-- row -->
			<div class="row p-30-0 p-lg-30-0 p-md-15-0">
			  <!-- col -->
			  <div class="col-lg-12">

			    <!-- banner -->
			    <div class="art-a art-banner"<# if ( settings.bg_image ) { #> style="background-image: url({{{ settings.bg_image.url }}})"<# } #>>
			      <!-- banner back -->
			      <div class="art-banner-back"></div>
			      <!-- banner dec -->
			      <div class="art-banner-dec"></div>
			      <!-- banner overlay -->
			      <div class="art-banner-overlay">
			        <!-- main title -->
			        <div class="art-banner-title">
			          <# if ( settings.title ) { #>
			          <!-- title -->
			          <{{{ settings.title_tag }}} class="art-banner-title-h mb-15">
			          <span {{{ view.getRenderAttributeString( 'title' ) }}}>
			          	{{{ settings.title }}}
			          </span>
			          </{{{ settings.title_tag }}}>
			      	  <# } #>
			      	  <# if ( settings.subtitle_show == 'yes' ) { #>
			          <!-- suptitle -->
			          <div class="art-lg-text art-code mb-25">
			          	&lt;<i>code</i>&gt; 
			          	{{{ settings.subtitle_start }}}
			          	<# if ( settings.subtitle_rotate ) { #>
			          	<span class="txt-rotate" data-period="2000"
			              data-rotate='[ {{{ text_rotate }}} ]'></span>
			            <# } #>
			            &lt;/<i>code</i>&gt;
			          </div>
			          <# } #>
			          <# if ( settings.button ) { #>
			          <div class="art-buttons-frame">
			            <!-- button -->
			            <a<# if ( settings.link ) { if ( settings.link.is_external ) { #> target="_blank"<# } #><# if ( settings.link.nofollow ) { #> rel="nofollow"<# } #> href="{{{ settings.link.url }}}"<# } #> class="art-btn art-btn-md"><span>{{{ settings.button }}}</span></a>
			          </div>
			          <# } #>
					  <# if ( settings.sec_button && settings.sec_button_true ) { #>
			          <div class="art-buttons-frame">
			            <!-- button -->
			            <a<# if ( settings.sec_link ) { if ( settings.sec_link.is_external ) { #> target="_blank"<# } #><# if ( settings.sec_link.nofollow ) { #> rel="nofollow"<# } #> href="{{{ settings.sec_link.url }}}"<# } #> class="art-btn art-btn-md"><span>{{{ settings.sec_button }}}</span></a>
			          </div>
			          <# } #>
			        </div>
			        <!-- main title end -->
			        <# if ( settings.image ) { #>
			        <!-- photo -->
			        <img src="{{{ settings.image.url }}}" class="art-banner-photo" alt="Photo">
			        <# } #>
			      </div>
			      <!-- banner overlay end -->
			    </div>
			    <!-- banner end -->

			  </div>
			  <!-- col end -->
			</div>
			<!-- row end -->
		</div>
		<!-- container end -->

		<?php 
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Arter_Hero_Banner_Widget() );