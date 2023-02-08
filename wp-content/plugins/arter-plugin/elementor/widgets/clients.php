<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 
/**
 * Arter Clients Widget.
 *
 * @since 1.0
 */
class Arter_Clients_Widget extends Widget_Base {

	public function get_name() {
		return 'arter-clients';
	}

	public function get_title() {
		return esc_html__( 'Clients', 'arter-plugin' );
	}

	public function get_icon() {
		return 'fab fa-cuttlefish';
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
			'link', [
				'label' => esc_html__( 'URL', 'arter-plugin' ),
				'type' => Controls_Manager::URL,
				'show_external' => true,
			]
		);

		$this->add_control(
			'items',
			[
				'label' => esc_html__( 'Clients Items', 'arter-plugin' ),
				'type' => Controls_Manager::REPEATER,
				'prevent_empty' => false,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ name }}}',
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
		  <?php foreach ( $settings['items'] as $index => $item ) : ?>
		  <!-- col -->
		  <div class="col-6 col-lg-3">
		  	<?php if ( $item['image'] ) : $image = wp_get_attachment_image_url( $item['image']['id'], 'arter_256x256' ); ?>
		  	<?php if ( $item['link'] ) : ?>
			<a <?php if ( $item['link']['is_external'] ) : ?> target="_blank"<?php endif; ?><?php if ( $item['link']['nofollow'] ) : ?> rel="nofollow"<?php endif; ?> href="<?php echo esc_url( $item['link']['url'] ); ?>">
			<?php endif; ?>
		    <!-- brand -->
		    <img class="art-brand" src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $item['name'] ); ?>">
		    <?php if ( $item['link'] ) : ?>
			</a>
			<?php endif; ?>
		    <?php endif; ?>
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
		<div class="row">
		  <# _.each( settings.items, function( item, index ) { #>
		  <!-- col -->
		  <div class="col-6 col-lg-3">
		  	<# if ( item.image ) { #>
		  	<# if ( item.link ) { #>
			<a <# if ( item.link.is_external ) { #> target="_blank"<# } #><# if ( item.link.nofollow ) { #> rel="nofollow"<# } #> href="{{{ item.link.url }}}">
			<# } #>
		    <!-- brand -->
		    <img class="art-brand" src="{{{ item.image.url }}}" alt="{{{ item.name }}}">
		    <# if ( item.link ) { #>
			</a>
			<# } #>
		    <# } #>
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

Plugin::instance()->widgets_manager->register_widget_type( new Arter_Clients_Widget() );