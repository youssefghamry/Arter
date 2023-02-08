<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 
/**
 * Arter Blog Grid Widget.
 *
 * @since 1.0
 */
class Arter_Blog_Grid_Widget extends Widget_Base {

	public function get_name() {
		return 'arter-blog-grid';
	}

	public function get_title() {
		return esc_html__( 'Blog (Grid)', 'arter-plugin' );
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
			'pagination_tab',
			[
				'label' => esc_html__( 'Pagination', 'arter-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'pagination',
			[
				'label'       => esc_html__( 'Pagination Type', 'arter-plugin' ),
				'type'        => Controls_Manager::SELECT,
				'default' => 'pages',
				'options' => [
					'pages' => __( 'Pages', 'arter-plugin' ),
					'button' => __( 'Button', 'arter-plugin' ),
					'no' => __( 'No', 'arter-plugin' ),
				],
			]
		);

		$this->add_control(
			'more_btn_txt',
			[
				'label'       => esc_html__( 'Button (title)', 'arter-plugin' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter button', 'arter-plugin' ),
				'default'     => esc_html__( 'All Posts', 'arter-plugin' ),
				'condition' => [
		            'pagination' => 'button'
		        ],
			]
		);

		$this->add_control(
			'more_btn_link',
			[
				'label'       => esc_html__( 'Button (link)', 'arter-plugin' ),
				'type'        => Controls_Manager::URL,
				'show_external' => true,
				'condition' => [
		            'pagination' => 'button'
		        ],
			]
		);
		
		$this->end_controls_section();

		$this->start_controls_section(
			'settings_tab',
			[
				'label' => esc_html__( 'Settings', 'arter-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'layout',
			[
				'label'       => esc_html__( 'Layout', 'arter-plugin' ),
				'type'        => Controls_Manager::SELECT,
				'default' => 'column-2',
				'options' => [
					'column-2'  => __( '2 Columns', 'arter-plugin' ),
					'column-3' => __( '3 Columns', 'arter-plugin' ),
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

		$this->start_controls_section(
			'pagination_styling',
			[
				'label'     => esc_html__( 'Pagination', 'arter-plugin' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'pagination_color',
			[
				'label'     => esc_html__( 'Color', 'arter-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .art-pagination a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'pagination_typography',
				'selector' => '{{WRAPPER}} .art-pagination',
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

		  <?php if ( $q->have_posts() ) : ?>
		  <?php while ( $q->have_posts() ) : $q->the_post(); ?>
		  <!-- col -->
		  <div class="<?php if ( $settings['layout'] == 'column-2' ) : ?>col-lg-6<?php endif; ?><?php if ( $settings['layout'] == 'column-3' ) : ?>col-lg-4<?php endif; ?>">
		    <?php get_template_part( 'template-parts/content' ); ?>
		  </div>
		  <!-- col end -->
		  <?php endwhile; ?>
		  <?php else : ?>
		  	<div class="col-lg-12">
				<?php get_template_part( 'template-parts/content', 'none' ); ?>
			</div>
		  <?php endif; ?>
		</div>
		<!-- row end -->

		</div>
		<!-- container end -->

		<?php if ( $q->have_posts() ) : ?>
		<!-- container -->
		<div class="container-fluid">

		<!-- row -->
		<div class="row">

		  <!-- col -->
		  <div class="col-lg-12">

		  	<?php if ( $settings['pagination'] == 'pages' ) : ?>
		    <!-- pagination -->
		    <div class="art-a art-pagination">
		      	<?php
					$big = 999999999; // need an unlikely integer

					echo paginate_links( array(
						'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
						'format' => '?paged=%#%',
						'current' => max( 1, get_query_var('paged') ),
						'total' => $q->max_num_pages,
						'prev_text' => esc_html__( 'Prev', 'arter-plugin' ),
						'next_text' => esc_html__( 'Next', 'arter-plugin' ),
					) );
				?>
		    </div>
		    <!-- pagination end -->
		    <?php endif; ?>

		    <?php if ( $settings['pagination'] == 'button' && $settings['more_btn_link'] ) : ?>
			<div class="art-bts text-center">
				<a class="art-btn art-btn-md" href="<?php echo esc_url( $settings['more_btn_link']['url'] ); ?>"<?php if ( $settings['more_btn_link']['is_external'] ) : ?> target="_blank"<?php endif; ?><?php if ( $settings['more_btn_link']['nofollow'] ) : ?> rel="nofollow"<?php endif; ?>><span><?php echo esc_html( $settings['more_btn_txt'] ); ?></span></a>
			</div>
			<?php endif; ?>
		  </div>
		  <!-- col end -->

		</div>
		<!-- row end -->

		</div>
		<!-- container end -->
		<?php endif; wp_reset_postdata(); ?>

		<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Arter_Blog_Grid_Widget() );