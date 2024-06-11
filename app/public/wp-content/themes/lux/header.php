<!DOCTYPE html>
<html lang="en">

<head>
    <?php wp_head(); ?>
</head>

<body>
<header class="site-header">
    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start bg-dark pt-3 pb-3">
        <?php
        // Display the custom logo if it is set
        if (function_exists('the_custom_logo') && has_custom_logo()) {
            the_custom_logo();
        } else {
            // Fallback to site title if no custom logo is set
            echo '<a href="' . esc_url(home_url('/')) . '" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">';
            echo '<h1>' . get_bloginfo('name') . '</h1>';
            echo '</a>';
        }
        ?>

        <?php
        $menu_id = get_theme_mod('header_menu_setting');
        if ($menu_id) {
            wp_nav_menu(array(
                'menu' => $menu_id,
                'menu_class' => 'nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0',
                'container' => false,
                'walker' => new WP_Bootstrap_Navwalker(), // Ensure this class is correctly defined and loaded
                'fallback_cb' => '__return_false',
                'link_before' => '<span class="' . (is_page(get_the_title()) ? 'text-white' : 'text-secondary') . '">', // Add class based on condition
        'link_after' => '</span>'
            ));
        }
        ?>

        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
            <input type="search" class="form-control form-control-dark" placeholder="Search..." aria-label="Search">
        </form>

        <div class="text-end">
            <button type="button" class="btn btn-outline-light me-2">Login</button>
            <button type="button" class="btn btn-warning">Sign-up</button>
        </div>
    </div>
</header>
