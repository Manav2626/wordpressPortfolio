<?php 

function lux_stylesheet() {
    wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css', array(), null, 'all');
    wp_enqueue_script('bootstrapScript', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js', array('jquery'), null, true);
    // Enqueue Bootstrap Icons CSS
    wp_enqueue_style('bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css', array(), null, 'all');
    // Custom CSS
    wp_enqueue_style('styles', get_theme_file_uri("/css/custom-style.css"));

    wp_enqueue_style('custom-style', get_theme_file_uri() . '/build/style-index.css');
    wp_enqueue_style('custom-extra-style', get_theme_file_uri() . '/css/style.css');
    wp_enqueue_script('custom-script', get_theme_file_uri() . '/src/index.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'lux_stylesheet');

// Register Theme Support for Menus and Custom Logo
function my_theme_setup() {
    register_nav_menus(array(
        'header-menu' => __('Header Menu', 'my-theme')
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
    add_submenu_page(
        'my_theme_options', // Parent menu slug
        'Register Products', // Page title
        'Register Products', // Menu title
        'manage_options', // Capability required to access
        'register_products', // Menu slug
        'render_product_registration_page' // Callback function to render page content
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

// Add classes to menu links
function add_link_atts($atts, $item, $args) {
    if ($args->theme_location == 'header-menu') {
        $atts['class'] = 'nav-link ' . (is_page($item->object_id) ? 'text-dark' : 'text-white');
    }
    return $atts;
}
add_filter('nav_menu_link_attributes', 'add_link_atts', 10, 3);

require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';

// Register the primary menu
register_nav_menus(array(
    'menu-1' => esc_html__('Primary', 'textdomain'),
));


// Register Subscriber redirect to home page
add_action('admin_init', 'redirectSubsToHomePage');

function redirectSubsToHomePage(){
    $ourCurrentUser = wp_get_current_user();

    if(count($ourCurrentUser->roles)==1 AND $ourCurrentUser->roles[0]=='subscriber'){
        wp_redirect(site_url('/'));
        exit; 
    }

}
add_action('wp_loaded', 'noSubsAdminBar');

function noSubsAdminBar(){
    $ourCurrentUser = wp_get_current_user();

    if(count($ourCurrentUser->roles)==1 AND $ourCurrentUser->roles[0]=='subscriber'){
        show_admin_bar(false);
    }

}

//customised login screen and logo
add_filter('login_headerurl', 'ourHeaderUrl');

function ourHeaderUrl(){
    return esc_url(site_url('/'));
}

add_filter('login_headertitle', 'ourLogintitle');

function ourLogintitle(){
    return get_bloginfo('name');
}


function custom_login_logo() {
    $custom_logo_id = get_theme_mod( 'custom_logo' );
    $logo_url = wp_get_attachment_image_url( $custom_logo_id, 'full' );
    ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url('<?php echo $logo_url; ?>');
            background-size: contain;
            width: 80px; /* Adjust width as needed */
            height: 80px; /* Adjust height as needed */
            border-radius: 8px;
        }
        #loginform #wp-submit {
            background-color: #343a40; /* Dark background color */
            border-color: #343a40; /* Border color */
        }
        #loginform #wp-submit:hover {
            background-color: #23272b; /* Darker background color on hover */
            border-color: #23272b; /* Darker border color on hover */
        }
        #loginform input:focus,
        #loginform input[type="text"]:focus,
        #loginform input[type="password"]:focus {
            border-color: #343a40; /* Dark border color for active text fields */
            box-shadow: 0 0 0 0.25rem rgba(52, 58, 64, 0.25); /* Dark box shadow for active text fields */
        }
    </style>
    <?php
}
add_action( 'login_enqueue_scripts', 'custom_login_logo' );

//Code for Product Registration


function render_product_registration_page() {
    ?>
    <div class="wrap">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
        <form method="post" action="">
            <!-- Add form fields for product details here -->
            <input type="text" name="product_name" placeholder="Product Name">
            <input type="text" name="product_description" placeholder="Product Description">
            <!-- Add more custom fields as needed -->
            <button type="submit" name="submit_product">Create Product</button>
        </form>
    </div>
    <?php
}

function render_product_management_page() {
    ?>
    <div class="wrap">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
        
        <!-- Create New Product Form -->
        <h2>Create New Product</h2>
        <form method="post" action="">
            <!-- Add form fields for product details here -->
            <input type="text" name="product_name" placeholder="Product Name">
            <input type="text" name="product_description" placeholder="Product Description">
            <input type="number" name="product_price" placeholder="Product Price">
            <!-- Add more custom fields as needed -->
            <button type="submit" name="submit_product">Create Product</button>
        </form>
        
        <!-- Display Registered Products -->
        <h2>Registered Products</h2>
        <!-- Display registered products here -->
    </div>
    <?php
}

function process_product_management() {
    // Process form submission to create new product
    if ( isset( $_POST['submit_product'] ) ) {
        // Retrieve and sanitize form data
        $product_name = sanitize_text_field( $_POST['product_name'] );
        $product_description = sanitize_text_field( $_POST['product_description'] );
        $product_price = floatval( $_POST['product_price'] );

        // Insert new product into database
        $product_id = wp_insert_post( array(
            'post_title'   => $product_name,
            'post_content' => $product_description,
            'post_type'    => 'product', // Customize post type as needed
            'post_status'  => 'publish'
        ) );

        // Optionally, save additional custom fields using update_post_meta()
        // update_post_meta( $product_id, 'custom_field_name', $custom_field_value );

        if ( $product_id ) {
            // Product created successfully, display success message or redirect
            echo '<div class="notice notice-success"><p>Product created successfully!</p></div>';
        } else {
            // Product creation failed, display error message
            echo '<div class="notice notice-error"><p>Failed to create product. Please try again.</p></div>';
        }
    }
}

add_action( 'admin_init', 'process_product_management' );
