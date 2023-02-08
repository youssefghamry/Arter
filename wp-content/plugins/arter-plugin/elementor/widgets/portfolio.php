<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 
/**
 * Arter Portfolio Widget.
 *
 * @since 1.0
 */
class Arter_Portfolio_Widget extends Widget_Base {

	public function get_name() {
		return 'arter-portfolio';
	}

	public function get_title() {
		return esc_html__( 'Portfolio', 'arter-plugin' );
	}

	public function get_icon() {
		return 'fas fa-suitcase';
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
			'filters_tab',
			[
				'label' => esc_html__( 'Filters', 'arter-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'filters_note',
			[
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'raw' => esc_html__( 'Filters show only with pagination "Button" or "No"', 'arter-plugin' ),
				'content_classes' => 'elementor-descriptor',
			]
		);

		$this->add_control(
			'filters',
			[
				'label' => esc_html__( 'Show Filters', 'arter-plugin' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'arter-plugin' ),
				'label_off' => __( 'Hide', 'arter-plugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'filters_align',
			[
				'label' => esc_html__( 'Align', 'arter-plugin' ),
				'type'        => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left'  => __( 'Left', 'arter-plugin' ),
					'right_f' => __( 'Right Floating', 'arter-plugin' ),
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
				'options' => $this->get_portfolio_categories(),
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
				'placeholder' => 8,
				'default'     => 8,
			]
		);

		$this->add_control(
			'sort',
			[
				'label'       => esc_html__( 'Sorting By', 'arter-plugin' ),
				'type'        => Controls_Manager::SELECT,
				'default' => 'menu_order',
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
				'default' => 'asc',
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
				'label'       => esc_html__( 'Pagination', 'arter-plugin' ),
				'type'        => Controls_Manager::SELECT,
				'default' => 'no',
				'options' => [
					'no'  => __( 'No', 'arter-plugin' ),
					'pages' => __( 'Pages', 'arter-plugin' ),
					'button' => __( 'Button', 'arter-plugin' ),
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

		$this->add_control(
			'masonry',
			[
				'label' => esc_html__( 'Masonry Grid', 'arter-plugin' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Enable', 'arter-plugin' ),
				'label_off' => __( 'Disable', 'arter-plugin' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'show_item_details',
			[
				'label' => esc_html__( 'Show Item Details?', 'arter-plugin' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'arter-plugin' ),
				'label_off' => __( 'Hide', 'arter-plugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_item_name',
			[
				'label' => esc_html__( 'Show Item Name?', 'arter-plugin' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'arter-plugin' ),
				'label_off' => __( 'Hide', 'arter-plugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
		            'show_item_details' => 'yes'
		        ],
			]
		);

		$this->add_control(
			'show_item_desc',
			[
				'label' => esc_html__( 'Show Item Description?', 'arter-plugin' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'arter-plugin' ),
				'label_off' => __( 'Hide', 'arter-plugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
		            'show_item_details' => 'yes'
		        ],
			]
		);

		$this->add_control(
			'show_item_link',
			[
				'label' => esc_html__( 'Show Item Link?', 'arter-plugin' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'arter-plugin' ),
				'label_off' => __( 'Hide', 'arter-plugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
		            'show_item_details' => 'yes'
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
			'filters_styling',
			[
				'label'     => esc_html__( 'Filters', 'arter-plugin' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'filters_color',
			[
				'label'     => esc_html__( 'Color', 'arter-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .art-filter a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'filters_hover_color',
			[
				'label'     => esc_html__( 'Hover Color', 'arter-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .art-filter a.art-current, {{WRAPPER}} .art-filter a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'filters_typography',
				'selector' => '{{WRAPPER}} .art-filter a',
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
					'{{WRAPPER}} .art-grid .art-grid-item .art-item-description h5' => 'color: {{VALUE}};',
				],
			]
		);		

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_title_typography',
				'label'     => esc_html__( 'Title Typography', 'arter-plugin' ),
				'selector' => '{{WRAPPER}} .art-grid .art-grid-item .art-item-description h5',
			]
		);

		$this->add_control(
			'item_text_color',
			[
				'label'     => esc_html__( 'Text Color', 'arter-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .art-grid .art-grid-item .art-item-description div' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_text_typography',
				'label'     => esc_html__( 'Text Typography', 'arter-plugin' ),
				'selector' => '{{WRAPPER}} .art-grid .art-grid-item .art-item-description div',
			]
		);

		$this->add_control(
			'item_btn_color',
			[
				'label'     => esc_html__( 'Button Color', 'arter-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .art-grid .art-grid-item .art-item-description a.art-link' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_btn_typography',
				'label'     => esc_html__( 'Button Typography', 'arter-plugin' ),
				'selector' => '{{WRAPPER}} .art-grid .art-grid-item .art-item-description a.art-link',
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
	protected function get_portfolio_categories() {
		$categories = [];

		$args = array(
			'type'			=> 'post',
			'child_of'		=> 0,
			'parent'		=> '',
			'orderby'		=> 'name',
			'order'			=> 'DESC',
			'hide_empty'	=> 1,
			'hierarchical'	=> 1,
			'taxonomy'		=> 'portfolio_categories',
			'pad_counts'	=> false 
		);

		$portfolio_categories = get_categories( $args );

		foreach ( $portfolio_categories as $category ) {
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
			'taxonomy'		=> 'portfolio_categories',
			'pad_counts'	=> false,
			'include'		=> $cat_ids
		);

		$pf_categories = get_categories( $cat_args );

		$args = array(
			'post_type'			=> 'portfolio',
			'post_status'		=> 'publish',
			'orderby'			=> $settings['sort'],
			'order'				=> $settings['order'],
			'posts_per_page'	=> $settings['limit'],
			'paged' 			=> $paged
		);

		if( $settings['source'] == 'categories' ) {
			$tax_array = array(
				array(
					'taxonomy' => 'portfolio_categories',
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
		      
		      <?php if ( $settings['filters'] && $pf_categories && $settings['filters_align'] == 'right_f' && $settings['pagination'] != 'pages' ) : ?>
		      <!-- right frame -->
              <div class="art-right-frame">
                <!-- filter -->
                <div class="art-filter">
                  <!-- filter link -->
                  <a href="#" data-filter="*" class="art-link art-current"><?php echo esc_html__( 'All Categories', 'arter-plugin' ); ?></a>
                  <?php foreach ( $pf_categories as $category ) : ?>
			      <!-- filter link -->
			      <a href="#" data-filter=".category-<?php echo esc_attr( $category->slug ); ?>" class="art-link"><?php echo esc_html( $category->name ); ?></a>
			      <?php endforeach; ?>
	                </div>
                <!-- filter end -->
              </div>
              <!-- right frame end -->
          	  <?php endif; ?>
		    </div>
		    <!-- section title end -->
		  </div>
		  <!-- col end -->
		  <?php endif; ?>

		  <?php if ( $settings['filters'] && $pf_categories && $settings['filters_align'] == 'left' && $settings['pagination'] != 'pages' ) : ?>
		  <!-- col -->
		  <div class="col-lg-12">

		    <!-- filter -->
		    <div class="art-filter mb-30">
		      <!-- filter link -->
		      <a href="#" data-filter="*" class="art-link art-current"><?php echo esc_html__( 'All Categories', 'arter-plugin' ); ?></a>
		      <?php foreach ( $pf_categories as $category ) : ?>
		      <!-- filter link -->
		      <a href="#" data-filter=".category-<?php echo esc_attr( $category->slug ); ?>" class="art-link"><?php echo esc_html( $category->name ); ?></a>
		      <?php endforeach; ?>
		    </div>
		    <!-- filter end -->

		  </div>
		  <!-- col end -->
		  <?php endif; ?>

		  <?php if ( $q->have_posts() ) : ?>
		  <div class="art-grid<?php if ( $settings['layout'] == 'column-2' ) : ?> art-grid-2-col<?php endif; ?><?php if ( $settings['layout'] == 'column-3' ) : ?> art-grid-3-col<?php endif; ?> art-gallery<?php if ( $settings['masonry'] == 'yes' ) : ?> art-grid-masonry<?php endif; ?><?php if ( $settings['show_item_details'] != 'yes' ) : ?> art-grid-hide-details<?php endif; ?><?php if ( $settings['show_item_name'] != 'yes' ) : ?> art-grid-hide-name<?php endif; ?><?php if ( $settings['show_item_desc'] != 'yes' ) : ?> art-grid-hide-desc<?php endif; ?><?php if ( $settings['show_item_link'] != 'yes' ) : ?> art-grid-hide-link<?php endif; ?>">
		  	<?php while ( $q->have_posts() ) : $q->the_post();
				get_template_part( 'template-parts/content', 'portfolio' );
			endwhile; ?>
		  </div>
		  <?php if ( $settings['pagination'] == 'pages' ) : ?>
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
				) ); ?>
		  </div>
		  <?php endif; ?>
		  <?php if ( $settings['pagination'] == 'button' && $settings['more_btn_link'] ) : ?>
		  <div class="art-bts text-center">
			<a class="art-btn art-btn-md" href="<?php echo esc_url( $settings['more_btn_link']['url'] ); ?>"<?php if ( $settings['more_btn_link']['is_external'] ) : ?> target="_blank"<?php endif; ?><?php if ( $settings['more_btn_link']['nofollow'] ) : ?> rel="nofollow"<?php endif; ?>><span><?php echo esc_html( $settings['more_btn_txt'] ); ?></span></a>
		  </div>
		  <?php endif; ?>
		  <?php else :
				get_template_part( 'template-parts/content', 'none' );
			endif; wp_reset_postdata();
		  ?>
		</div>
		<!-- row end -->

		</div>
		<!-- container end -->

		<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Arter_Portfolio_Widget() );