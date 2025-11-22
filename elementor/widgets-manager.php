<?php
function register_new_widgets($widgets_manager)
{

    // Require the widget files
    require_once(__DIR__ . '/widget-header.php');
    require_once(__DIR__ . '/widget-footer.php');
    require_once(__DIR__ . '/widget-home-hero.php');
    require_once(__DIR__ . '/widget-brands.php');
    require_once(__DIR__ . '/widget-services.php');
    require_once(__DIR__ . '/widget-choose-us.php');
    require_once(__DIR__ . '/widget-about.php');
    require_once(__DIR__ . '/widget-counter.php');
    require_once(__DIR__ . '/widget-elite.php');
    require_once(__DIR__ . '/widget-values.php');
    require_once(__DIR__ . '/widget-proccess.php');
    require_once(__DIR__ . '/widget-service-coverage.php');
    require_once(__DIR__ . '/widget-contact.php');

    // Register the widgets
    $widgets_manager->register(new \Widget_Header_Menu());
    $widgets_manager->register(new \Widget_Footer());
    $widgets_manager->register(new \Widget_Banner_Three());
    $widgets_manager->register(new \Widget_Brands());
    $widgets_manager->register(new \Widget_Services());
    $widgets_manager->register(new \Widget_ChooseUs());
    $widgets_manager->register(new \Widget_About_Us());
    $widgets_manager->register(new \Counter_Section_Widget());
    $widgets_manager->register(new \About_Elite_Widget());
    $widgets_manager->register(new \Widget_Values());
    $widgets_manager->register(new \Widget_Proccess());
    $widgets_manager->register(new \Widget_Service_Coverage());
    $widgets_manager->register(new \Widget_Contact_Section());
}
add_action('elementor/widgets/register', 'register_new_widgets');
