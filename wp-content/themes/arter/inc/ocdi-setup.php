<?php

function arter_ocdi_import_files() {
    return array(
        array(
            'import_file_name'             => esc_attr__( 'Default', 'arter' ),
            'categories'                   => array( esc_attr__( 'Main', 'arter' ) ),
            'local_import_file'            => trailingslashit( get_template_directory() ) . 'demo/01/content.xml',
            'preview_url'                  => esc_url( 'https://bslthemes.com/arter-wp/' ),
        ),
    );
}
add_filter( 'pt-ocdi/import_files', 'arter_ocdi_import_files' );

function arter_ocdi_after_import_setup( $selected_import ) {
    // Assign menus to their locations.
    $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );

    set_theme_mod( 'nav_menu_locations', array(
            'primary' => $main_menu->term_id,
        )
    );

    // Assign front page and posts page (blog page).
    $front_page_id = get_page_by_title( 'Home' );

    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );
    update_option( 'posts_per_page', 6 );

    $ocdi_fields_static = array(
        'options_vcard_name' => 'Artur Carter',
        '_options_vcard_name' => 'field_5f35b0ba705a6',
        'options_vcard_short_desc' => 'Front-end Deweloper 
        Ui/UX Designer',
        '_options_vcard_short_desc' => 'field_5f35b0d2705a7',
        'options_vcard_available' => '1',
        '_options_vcard_available' => 'field_5f35bc9fd2ee1',
        'options_vcard_info_0_label' => 'Residence:',
        '_options_vcard_info_0_label' => 'field_5f35b17b705a9',
        'options_vcard_info_0_value' => 'Canada',
        '_options_vcard_info_0_value' => 'field_5f35b182705aa',
        'options_vcard_info_1_label' => 'City:',
        '_options_vcard_info_1_label' => 'field_5f35b17b705a9',
        'options_vcard_info_1_value' => 'Toronto',
        '_options_vcard_info_1_value' => 'field_5f35b182705aa',
        'options_vcard_info_2_label' => 'Age:',
        '_options_vcard_info_2_label' => 'field_5f35b17b705a9',
        'options_vcard_info_2_value' => '26',
        '_options_vcard_info_2_value' => 'field_5f35b182705aa',
        'options_vcard_info' => '3',
        '_options_vcard_info' => 'field_5f35b15e705a8',
        'options_vcard_skills_0_type' => 'circles',
        '_options_vcard_skills_0_type' => 'field_5f35b1b3705ac',
        'options_vcard_skills_0_items_0_label' => 'French',
        '_options_vcard_skills_0_items_0_label' => 'field_5f35b2e8705af',
        'options_vcard_skills_0_items_0_value' => '100',
        '_options_vcard_skills_0_items_0_value' => 'field_5f35b2ee705b0',
        'options_vcard_skills_0_items_1_label' => 'English',
        '_options_vcard_skills_0_items_1_label' => 'field_5f35b2e8705af',
        'options_vcard_skills_0_items_1_value' => '90',
        '_options_vcard_skills_0_items_1_value' => 'field_5f35b2ee705b0',
        'options_vcard_skills_0_items_2_label' => 'Spanish',
        '_options_vcard_skills_0_items_2_label' => 'field_5f35b2e8705af',
        'options_vcard_skills_0_items_2_value' => '70',
        '_options_vcard_skills_0_items_2_value' => 'field_5f35b2ee705b0',
        'options_vcard_skills_0_items' => '3',
        '_options_vcard_skills_0_items' => 'field_5f35b1b3705ad',
        'options_vcard_skills_1_type' => 'progress',
        '_options_vcard_skills_1_type' => 'field_5f35b1b3705ac',
        'options_vcard_skills_1_items_0_label' => 'html',
        '_options_vcard_skills_1_items_0_label' => 'field_5f35b2e8705af',
        'options_vcard_skills_1_items_0_value' => '90',
        '_options_vcard_skills_1_items_0_value' => 'field_5f35b2ee705b0',
        'options_vcard_skills_1_items_1_label' => 'CSS',
        '_options_vcard_skills_1_items_1_label' => 'field_5f35b2e8705af',
        'options_vcard_skills_1_items_1_value' => '95',
        '_options_vcard_skills_1_items_1_value' => 'field_5f35b2ee705b0',
        'options_vcard_skills_1_items_2_label' => 'Js',
        '_options_vcard_skills_1_items_2_label' => 'field_5f35b2e8705af',
        'options_vcard_skills_1_items_2_value' => '75',
        '_options_vcard_skills_1_items_2_value' => 'field_5f35b2ee705b0',
        'options_vcard_skills_1_items_3_label' => 'PHP',
        '_options_vcard_skills_1_items_3_label' => 'field_5f35b2e8705af',
        'options_vcard_skills_1_items_3_value' => '65',
        '_options_vcard_skills_1_items_3_value' => 'field_5f35b2ee705b0',
        'options_vcard_skills_1_items_4_label' => 'WordPress',
        '_options_vcard_skills_1_items_4_label' => 'field_5f35b2e8705af',
        'options_vcard_skills_1_items_4_value' => '85',
        '_options_vcard_skills_1_items_4_value' => 'field_5f35b2ee705b0',
        'options_vcard_skills_1_items' => '5',
        '_options_vcard_skills_1_items' => 'field_5f35b1b3705ad',
        'options_vcard_skills_2_type' => 'list',
        '_options_vcard_skills_2_type' => 'field_5f35b1b3705ac',
        'options_vcard_skills_2_items_0_label' => 'Bootstrap, Materialize',
        '_options_vcard_skills_2_items_0_label' => 'field_5f35b2e8705af',
        'options_vcard_skills_2_items_1_label' => 'Stylus, Sass, Less',
        '_options_vcard_skills_2_items_1_label' => 'field_5f35b2e8705af',
        'options_vcard_skills_2_items_2_label' => 'Gulp, Webpack, Grunt',
        '_options_vcard_skills_2_items_2_label' => 'field_5f35b2e8705af',
        'options_vcard_skills_2_items_3_label' => 'GIT knowledge',
        '_options_vcard_skills_2_items_3_label' => 'field_5f35b2e8705af',
        'options_vcard_skills_2_items' => '4',
        '_options_vcard_skills_2_items' => 'field_5f35b1b3705ad',
        'options_vcard_skills' => '3',
        '_options_vcard_skills' => 'field_5f35b1b2705ab',
        'options_vcard_buttons_0_label' => 'Download cv',
        '_options_vcard_buttons_0_label' => 'field_5f35b36f705b4',
        'options_vcard_buttons_0_url' => 'https://drive.google.com/',
        '_options_vcard_buttons_0_url' => 'field_5f35b413705b8',
        'options_vcard_buttons_0_icon' => 'fas fa-download',
        '_options_vcard_buttons_0_icon' => 'field_5f35bae7568c2',
        'options_vcard_buttons_0_attributes_download' => '0',
        '_options_vcard_buttons_0_attributes_download' => 'field_5f35b45d705ba',
        'options_vcard_buttons_0_attributes_new_window' => '1',
        '_options_vcard_buttons_0_attributes_new_window' => 'field_5f35b49a705bb',
        'options_vcard_buttons_0_attributes' => '',
        '_options_vcard_buttons_0_attributes' => 'field_5f35b420705b9',
        'options_vcard_buttons' => '1',
        '_options_vcard_buttons' => 'field_5f35b36f705b3',
        'options_footer_text' => '© 2020 All Rights Reserved.',
        '_options_footer_text' => 'field_5b68cceac1b66',
        'options_footer_text2' => 'Email: <a href="mailto:admin@bslthemes.com" target="_blank">admin@bslthemes.com</a>',
        '_options_footer_text2' => 'field_5f5892ca12b9a',
        'options_social_links_0_icon' => 'fab fa-linkedin',
        '_options_social_links_0_icon' => 'field_5d879352bc7a2',
        'options_social_links_0_url' => 'https://linkedin.com/',
        '_options_social_links_0_url' => 'field_5b68ccd7c1b65',
        'options_social_links_1_icon' => 'fab fa-dribbble',
        '_options_social_links_1_icon' => 'field_5d879352bc7a2',
        'options_social_links_1_url' => 'https://dribble.com/',
        '_options_social_links_1_url' => 'field_5b68ccd7c1b65',
        'options_social_links_2_icon' => 'fab fa-behance',
        '_options_social_links_2_icon' => 'field_5d879352bc7a2',
        'options_social_links_2_url' => 'https://behance.com/',
        '_options_social_links_2_url' => 'field_5b68ccd7c1b65',
        'options_social_links_3_icon' => 'fab fa-github',
        '_options_social_links_3_icon' => 'field_5d879352bc7a2',
        'options_social_links_3_url' => 'https://github.com/',
        '_options_social_links_3_url' => 'field_5b68ccd7c1b65',
        'options_social_links_4_icon' => 'fab fa-twitter',
        '_options_social_links_4_icon' => 'field_5d879352bc7a2',
        'options_social_links_4_url' => 'https://twitter.com/',
        '_options_social_links_4_url' => 'field_5b68ccd7c1b65',
        'options_social_links' => '5',
        '_options_social_links' => 'field_5b68ccabc1b63',
        'options_post_page' => '166',
        '_options_post_page' => 'field_5f588f84087e0',
        'options_blog_categories' => '1',
        '_options_blog_categories' => 'field_5b81b6d930cb9',
        'options_blog_excerpt' => '0',
        '_options_blog_excerpt' => 'field_5b81b7ca30cba',
        'options_blog_featured_img' => '0',
        '_options_blog_featured_img' => 'field_5ee8e1ce18975',
        'options_social_share' => 'a:5:{i:0;s:8:"facebook";i:1;s:7:"twitter";i:2;s:8:"linkedin";i:3;s:6:"reddit";i:4;s:9:"pinterest";}',
        '_options_social_share' => 'field_5c610c399cf20',
        'options_portfolio_page' => '162',
        '_options_portfolio_page' => 'field_5f58901c087e1',
        'options_portfolio_lightbox_disable' => '1',
        '_options_portfolio_lightbox_disable' => 'field_5f58eee9befad',
        'options_p404_title' => 'Whoops!',
        '_options_p404_title' => 'field_5d180fd559b7f',
        'options_p404_content' => 'The page you\'re looking for doesn\'t exist or has been moved.',
        '_options_p404_content' => 'field_5d180feb59b80',
        'options_preloader_text' => 'Artur Carter',
        '_options_preloader_text' => 'field_5f58b3fc5f79f',
    );
    $ocdi_fields_to_change = array();
    
    if( 'Default' === $selected_import['import_file_name'] ) {
        $ocdi_fields_to_change = array(
            'options_theme_transition' => '0',
            '_options_theme_transition' => 'field_5f5c89409b5e6',
            'options_theme_scrolling' => '0',
            '_options_theme_scrolling' => 'field_5f73a3eb21ad3',
            'options_theme_color' => '#FFC107',
            '_options_theme_color' => 'field_5b68d509665d9',
            'options_heading_color' => '#FFFFFF',
            '_options_heading_color' => 'field_5b68d5d8665da',
            'options_text_color' => '#8c8c8e',
            '_options_text_color' => 'field_5b68d617665db',
            'options_menu_font_color' => '#8c8c8e',
            '_options_menu_font_color' => 'field_5eea679c5ad20',
            'options_heading_font_size' => '',
            '_options_heading_font_size' => 'field_5eea66185ad1d',
            'options_text_font_size' => '',
            '_options_text_font_size' => 'field_5eea66ad5ad1e',
            'options_menu_font_size' => '',
            '_options_menu_font_size' => 'field_5eea67685ad1f',
            'options_heading_font_family' => '0',
            '_options_heading_font_family' => 'field_5b68cfc4906fc',
            'options_text_font_family' => '0',
            '_options_text_font_family' => 'field_5b68d188906fd',
            'options_menu_font_family' => '0',
            '_options_menu_font_family' => 'field_5eea67ef5ad21',
            'options_header_bg' => '64',
            '_options_header_bg' => 'field_5d11763c9ed10',
            'options_vcard_image' => '63',
            '_options_vcard_image' => 'field_5ed404ad72663',
            'options_vcard_full_image' => '63',
            '_options_vcard_full_image' => 'field_5f35af34705a5',
        );
    }

    global $wpdb;
    foreach ( array_merge( $ocdi_fields_static, $ocdi_fields_to_change ) as $field => $value ) {
        if ( $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM $wpdb->options WHERE option_name = %s", $field ) ) == 0 ) {
            $wpdb->query( $wpdb->prepare( "INSERT INTO $wpdb->options ( option_name, option_value, autoload ) VALUES (%s, %s, 'no')", $field, $value ) );
        } else {
            $wpdb->query( $wpdb->prepare( "UPDATE $wpdb->options SET option_value = %s WHERE option_name = %s", $value, $field ) );
        }
    }

}
add_action( 'pt-ocdi/after_import', 'arter_ocdi_after_import_setup' );