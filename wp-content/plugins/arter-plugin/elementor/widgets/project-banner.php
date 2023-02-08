<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 
/**
 * Arter Project Banner Widget.
 *
 * @since 1.0
 */
class Arter_Project_Banner_Widget extends Widget_Base {

	public function get_name() {
		return 'arter-project-banner';
	}

	public function get_title() {
		return esc_html__( 'Project Banner', 'arter-plugin' );
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
			'subtitle',
			[
				'label'       => esc_html__( 'Subtitle', 'arter-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter text', 'arter-plugin' ),
				'default'     => esc_html__( 'Text', 'arter-plugin' ),
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

		$this->end_controls_section();

		$this->start_controls_section(
			'background_tab',
			[
				'label' => esc_html__( 'Background', 'arter-plugin' ),
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
		$this->add_inline_editing_attributes( 'subtitle', 'basic' );
		$this->add_inline_editing_attributes( 'button', 'none' );

		?>
		
		<!-- container -->
		<div class="container-fluid">
			<!-- row -->
			<div class="row">
			  <!-- col -->
			  <div class="col-lg-12">

			    <!-- call to action -->
			    <div class="art-a art-banner"<?php if ( $settings['bg_image'] ) : ?> style="background-image: url(<?php echo esc_url( $settings['bg_image']['url'] ); ?>)"<?php endif; ?>>
			      <!-- banner overlay -->
			      <div class="art-banner-overlay">
			        <!-- main title -->
			        <div class="art-banner-title text-center">
			          <?php if ( $settings['title'] ) : ?>
			          <!-- title -->
			          <<?php echo esc_attr( $settings['title_tag'] ); ?> class="art-banner-title-h mb-15">
			          <span <?php echo $this->get_render_attribute_string( 'title' ); ?>>
			          	<?php echo wp_kses_post( $settings['title'] ); ?>
			          </span>
			          </<?php echo esc_attr( $settings['title_tag'] ); ?>>
			      	  <?php endif; ?>
			      	  <?php if ( $settings['subtitle'] ) : ?>
			          <!-- suptitle -->
			          <div class="art-lg-text art-code mb-25">
			          	<span <?php echo $this->get_render_attribute_string( 'subtitle' ); ?>>
				          	<?php echo wp_kses_post( $settings['subtitle'] ); ?>
				        </span>
			          </div>
			          <?php endif; ?>
			          <?php if ( $settings['button'] ) : ?>
			          <!-- button -->
			          <a<?php if ( $settings['link'] ) : if ( $settings['link']['is_external'] ) : ?> target="_blank"<?php endif; ?><?php if ( $settings['link']['nofollow'] ) : ?> rel="nofollow"<?php endif; ?> href="<?php echo esc_url( $settings['link']['url'] ); ?>"<?php endif; ?> class="art-btn art-btn-md">
			            	<span <?php echo $this->get_render_attribute_string( 'button' ); ?>>
			          			<?php echo esc_html( $settings['button'] ); ?>
			          		</span>
			          </a>
			          <?php endif; ?>
			        </div>
			        <!-- main title end -->
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
		view.addInlineEditingAttributes( 'subtitle', 'basic' );
		view.addInlineEditingAttributes( 'button', 'none' );
		#>

		<!-- container -->
		<div class="container-fluid">
			<!-- row -->
			<div class="row">
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
			        <div class="art-banner-title text-center">
			          <# if ( settings.title ) { #>
			          <!-- title -->
			          <{{{ settings.title_tag }}} class="art-banner-title-h mb-15">
			          <span {{{ view.getRenderAttributeString( 'title' ) }}}>
			          	{{{ settings.title }}}
			          </span>
			          </{{{ settings.title_tag }}}>
			      	  <# } #>
			      	  <# if ( settings.subtitle ) { #>
			          <!-- suptitle -->
			          <div class="art-lg-text art-code mb-25">
			          	<span {{{ view.getRenderAttributeString( 'subtitle' ) }}}>
				          	{{{ settings.subtitle }}}
				        </span>
			          </div>
			          <# } #>
			          <# if ( settings.button ) { #>
			          <!-- button -->
			          <a<# if ( settings.link ) { if ( settings.link.is_external ) { #> target="_blank"<# } #><# if ( settings.link.nofollow ) { #> rel="nofollow"<# } #> href="{{{ settings.link.url }}}"<# } #> class="art-btn art-btn-md">
			            	<span {{{ view.getRenderAttributeString( 'button' ) }}}>
					          	{{{ settings.button }}}
					        </span>
			          </a>
			          <# } #>
			        </div>
			        <!-- main title end -->
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

Plugin::instance()->widgets_manager->register_widget_type( new Arter_Project_Banner_Widget() );