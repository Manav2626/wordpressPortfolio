<?php 

function lux_stylesheet() {
    wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css', array(), null, 'all');
    wp_enqueue_script('bootstrapScript', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js', array('jquery'), null, true);
    // Enqueue Bootstrap Icons CSS
    wp_enqueue_style('bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css', array(), null, 'all');
    //custom css
    wp_enqueue_style('styles', get_theme_file_uri("/css/custom-style.css"));
}

add_action('wp_enqueue_scripts', 'lux_stylesheet');
?>
