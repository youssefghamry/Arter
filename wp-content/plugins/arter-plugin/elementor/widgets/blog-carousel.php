<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 
/**
 * Arter Blog Carousel Widget.
 *
 * @since 1.0
 */
class Arter_Blog_Carousel_Widget extends Widget_Base {

	public function get_name() {
		return 'arter-blog-carousel';
	}

	public function get_title() {
		return esc_html__( 'Blog (Carousel)', 'arter-plugin' );
	}

	public function get_icon() {
		return 'far fa-newspaper';
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
			'heading_tab',
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

		$this->add_control(
			'title_show',
			[
				'label' => esc_html__( 'Show Title', 'arter-plugin' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'arter-plugin' ),
				'label_off' => __( 'Hide', 'arter-plugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
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

		$this->add_control(
			'source',
			[
				'label'       => esc_html__( 'Source', 'arter-plugin' ),
				'type'        => Controls_Manager::SELECT,
				'default' => 'all',
				'options' => [
					'all'  => __( 'All', 'arter-plugin' ),
					'categories' => __( 'Categories', 'arter-plugin' ),
				],
			]
		);

		$this->add_control(
			'source_categories',
			[
				'label'       => esc_html__( 'Source', 'arter-plugin' ),
				'type'        => Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => $this->get_blog_categories(),
				'condition' => [
		            'source' => 'categories'
		        ],
			]
		);

		$this->add_control(
			'limit',
			[
				'label'       => esc_html__( 'Number of Items', 'arter-plugin' ),
				'type'        => Controls_Manager::NUMBER,
				'placeholder' => 6,
				'default'     => 6,
			]
		);

		$this->add_control(
			'sort',
			[
				'label'       => esc_html__( 'Sorting By', 'arter-plugin' ),
				'type'        => Controls_Manager::SELECT,
				'default' => 'date',
				'options' => [
					'date'  => __( 'Date', 'arter-plugin' ),
					'title' => __( 'Title', 'arter-plugin' ),
					'rand' => __( 'Random', 'arter-plugin' ),
					'menu_order' => __( 'Order', 'arter-plugin' ),
				],
			]
		);

		$this->add_control(
			'order',
			[
				'label'       => esc_html__( 'Order', 'arter-plugin' ),
				'type'        => Controls_Manager::SELECT,
				'default' => 'desc',
				'options' => [
					'asc'  => __( 'ASC', 'arter-plugin' ),
					'desc' => __( 'DESC', 'arter-plugin' ),
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
			'item_details_color',
			[
				'label'     => esc_html__( 'Details Color', 'arter-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .art-blog-card .art-project-category' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'item_details_bg',
			[
				'label'     => esc_html__( 'Details Background', 'arter-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .art-blog-card .art-project-category' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_details_typography',
				'label'     => esc_html__( 'Details Typography', 'arter-plugin' ),
				'selector' => '{{WRAPPER}} .art-blog-card .art-project-category',
			]
		);

		$this->add_control(
			'item_title_color',
			[
				'label'     => esc_html__( 'Title Color', 'arter-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .art-blog-card h5, {{WRAPPER}} .art-blog-card a' => 'color: {{VALUE}};',
				],
			]
		);		

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_title_typography',
				'label'     => esc_html__( 'Title Typography', 'arter-plugin' ),
				'selector' => '{{WRAPPER}} .art-blog-card h5',
			]
		);

		$this->add_control(
			'item_text_color',
			[
				'label'     => esc_html__( 'Text Color', 'arter-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .art-blog-card .art-el-description p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_text_typography',
				'label'     => esc_html__( 'Text Typography', 'arter-plugin' ),
				'selector' => '{{WRAPPER}} .art-blog-card .art-el-description p',
			]
		);

		$this->add_control(
			'item_readmore_color',
			[
				'label'     => esc_html__( 'Readmore Color', 'arter-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .art-blog-card .art-el-description .art-link' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_readmore_typography',
				'label'     => esc_html__( 'Readmore Typography', 'arter-plugin' ),
				'selector' => '{{WRAPPER}} .art-blog-card .art-el-description .art-link',
			]
		);
		
		$this->end_controls_section();
	}

	/**
	 * Render Categories List.
	 *
	 * @since 1.0
	 */
	protected function get_blog_categories() {
		$categories = [];

		$args = array(
			'type'			=> 'post',
			'child_of'		=> 0,
			'parent'		=> '',
			'orderby'		=> 'name',
			'order'			=> 'DESC',
			'hide_empty'	=> 1,
			'hierarchical'	=> 1,
			'taxonomy'		=> 'category',
			'pad_counts'	=> false 
		);

		$blog_categories = get_categories( $args );

		foreach ( $blog_categories as $category ) {
			$categories[$category->term_id] = $category->name;
		}

		return $categories;
	}

	/**
	 * Render widget output on the frontend.
	 *
	 * @since 1.0
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$this->add_inline_editing_attributes( 'title', 'basic' );

		$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
		$page_id = get_the_ID();

		if ( $settings['source'] == 'all' ) {
			$cat_ids = '';
		} else {
			$cat_ids = $settings['source_categories'];
		}

		$cat_args = array(
			'type'			=> 'post',
			'child_of'		=> 0,
			'parent'		=> '',
			'orderby'		=> 'name',
			'order'			=> 'DESC',
			'hide_empty'	=> 1,
			'hierarchical'	=> 1,
			'taxonomy'		=> 'category',
			'pad_counts'	=> false,
			'include'		=> $cat_ids
		);

		$bp_categories = get_categories( $cat_args );

		$args = array(
			'post_type'			=> 'post',
			'post_status'		=> 'publish',
			'orderby'			=> $settings['sort'],
			'order'				=> $settings['order'],
			'posts_per_page'	=> $settings['limit'],
			'paged' 			=> $paged
		);

		if( $settings['source'] == 'categories' ) {
			$tax_array = array(
				array(
					'taxonomy' => 'category',
					'field'    => 'id',
					'terms'    => $cat_ids
				)
			);

			$args += array('tax_query' => $tax_array);
		}

		$q = new \WP_Query( $args );

		?>

		<!-- container -->
		<div class="container-fluid">

		<!-- row -->
		<div class="row">
		  <?php if ( $settings['title'] && $settings['title_show'] == 'yes' ) : ?>
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
          	<?php if ( $q->have_posts() ) : ?>
            <!-- slider container -->
            <div class="swiper-container art-blog-slider" style="overflow: visible">
              <!-- slider wrapper -->
              <div class="swiper-wrapper">
                <?php while ( $q->have_posts() ) : $q->the_post(); ?>
                <!-- slide -->
                <div class="swiper-slide">

                  <?php get_template_part( 'template-parts/content' ); ?>

                </div>
                <!-- slide end -->
                <?php endwhile; ?>
                
              </div>
              <!-- slider wrapper end -->
            </div>
            <!-- slider container end -->
            <?php endif; wp_reset_postdata(); ?>
          </div>
          <!-- col end -->

          <!-- col -->
          <div class="col-lg-12">

            <!-- slider navigation -->
            <div class="art-slider-navigation">

              <!-- left side -->
              <div class="art-sn-left">

                <!-- slider pagination -->
                <div class="swiper-pagination"></div>

              </div>
              <!-- left side end -->

              <!-- right side -->
              <div class="art-sn-right">

                <!-- slider navigation -->
                <div class="art-slider-nav-frame">
                  <!-- prev -->
                  <div class="art-slider-nav art-blog-swiper-prev"><i class="fas fa-chevron-left"></i></div>
                  <!-- next -->
                  <div class="art-slider-nav art-blog-swiper-next"><i class="fas fa-chevron-right"></i></div>
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

Plugin::instance()->widgets_manager->register_widget_type( new Arter_Blog_Carousel_Widget() );