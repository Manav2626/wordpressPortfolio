<!DOCTYPE html>
<html lang="en">

<head>
  <?php wp_head(); ?>
</head>

<body>
<header class="site-header">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>">
                <?php
                if (function_exists('the_custom_logo') && has_custom_logo()) {
                    the_custom_logo();
                } else {
                    bloginfo('name');
                }
                ?>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <?php
                $menu_id = get_theme_mod('header_menu_setting');
                if ($menu_id) {
                    wp_nav_menu(array(
                        'menu' => $menu_id,
                        'menu_class' => 'navbar-nav me-auto mb-2 mb-lg-0',
                        'container' => false,
                        'walker' => new WP_Bootstrap_Navwalker(),
                        'fallback_cb' => '__return_false',
                        'link_before' => '',
                        'link_after' => '',
                    ));
                }
                ?>
                <div class="d-flex ">
                <input class="form-control me-2" type="Search" placeholder="Search" aria-label="Search">
                <?php 
                if(is_user_logged_in()) { ?>
                  <a href="<?php echo wp_logout_url() ?>" type="button" class="btn btn-warning">Logout
                  </a>
                <?php }else{ ?>
                  <a href="<?php echo wp_login_url() ?>" type="button" class="btn btn-success mx-2">Login</a>
                <a href="<?php echo wp_registration_url(); ?>" type="button" class="btn btn-warning mx-2">Signup</a>
                <?php }
                ?>
                
                </div>
            </div>
        </div>
    </nav>
</header>
