<?php 

function lux_stylesheet() {
    wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css', array(), null, 'all');
    wp_enqueue_script('bootstrapScript', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js', array('jquery'), null, true);
    // Enqueue Bootstrap Icons CSS
    wp_enqueue_style('bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css', array(), null, 'all');
    //custom css
    wp_enqueue_style('styles', get_theme_file_uri("/css/custom-style.css"));

    wp_enqueue_style('custom-style', get_theme_file_uri() . '/build/style-index.css');
    wp_enqueue_style('custom-extra-style', get_theme_file_uri() . '/css/style.css');
    wp_enqueue_script('custom-script', get_theme_file_uri() . '/src/index.js', array('jquery'), '1.0', true);
    
}

add_action('wp_enqueue_scripts', 'lux_stylesheet');


// Register Theme Support for Menus
function my_theme_setup() {
    register_nav_menus(array(
        'header-menu' => __('Header Menu', 'my-theme')
    ));
    add_theme_support('custom-logo', array(
        'height'      => 50, // Adjust the height as needed
        'width'       => 50, // Adjust the width as needed
        'flex-height' => true,
        'flex-width'  => true,
    ));
}
add_action('after_setup_theme', 'my_theme_setup');

// Add Theme Options Page and Submenu
function my_theme_options_page() {
    add_menu_page(
        'My Theme',
        'My Theme',
        'manage_options',
        'my_theme_options',
        'my_theme_options_page_callback',
        'dashicons-admin-appearance',
        20
    );
    add_submenu_page(
        'my_theme_options',
        'Customize',
        'Customize',
        'manage_options',
        'customize.php'
    );
}
add_action('admin_menu', 'my_theme_options_page');

function my_theme_options_page_callback() {
    wp_redirect(admin_url('customize.php'));
    exit;
}

// Add Customizer Settings and Controls
function my_theme_customize_register($wp_customize) {
    
    
    $wp_customize->add_section('header_settings_section', array(
        'title' => __('Header Settings', 'my-theme'),
        'priority' => 30,
    ));

    $wp_customize->add_setting('header_menu_setting', array(
        'default' => '',
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('header_menu_control', array(
        'label' => __('Select Header Settings', 'my-theme'),
        'section' => 'header_settings_section',
        'settings' => 'header_menu_setting',
        'type' => 'select',
        'choices' => wp_list_pluck(wp_get_nav_menus(), 'name', 'term_id'),
    ));
}
add_action('customize_register', 'my_theme_customize_register');

require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';

?>
