<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="robots" content="INDEX,FOLLOW">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php wp_head(); ?>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo THEME_URL; ?>/assets/images/logo/favicon.png">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?php echo THEME_URL; ?>/assets/css/bootstrap.min.css">
    <!-- Stoshi font -->
    <link rel="stylesheet" href="<?php echo THEME_URL; ?>/assets/css/satoshi.css">
    <!-- swiper Slider -->
    <link rel="stylesheet" href="<?php echo THEME_URL; ?>/assets/css/swiper-bundle.min.css">
    <!-- AOS -->
    <!-- <link rel="stylesheet" href="<?php echo THEME_URL; ?>/assets/css/aos.css"> -->
    <!-- Circle Progress -->
    <link rel="stylesheet" href="<?php echo THEME_URL; ?>/assets/css/animated-radial-progress.css">
    <!-- magnific -->
    <link rel="stylesheet" href="<?php echo THEME_URL; ?>/assets/css/magnific-popup.css">
    <!-- Main css -->
    <link rel="stylesheet" href="<?php echo THEME_URL; ?>/assets/css/main.css">
    <link rel="stylesheet" href="<?php echo THEME_URL; ?>/assets/css/style.css">
    <link rel="stylesheet" href="<?php echo THEME_URL; ?>/assets/css/style_006.css">
    <link rel="stylesheet" href="<?php echo THEME_URL; ?>/assets/css/style_005.css">
    <link rel="stylesheet" href="<?php echo THEME_URL; ?>/assets/css/style_004.css">
    <link rel="stylesheet" href="<?php echo THEME_URL; ?>/assets/css/style_003.css">
    <link rel="stylesheet" href="<?php echo THEME_URL; ?>/assets/css/style_002.css">


    <!--[if lt IE 9]><script src="https://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <!--[if lt IE 9]><script src="<?php echo THEME_URL; ?>/assets/js/respond.js"></script><![endif]-->

</head>

<?php

function add_language_class_to_body($classes)
{
    $current_lang = substr(get_locale(), 0, 2);

    // Add language class to body
    if ($current_lang == 'ar') {
        $classes[] = 'ar'; // Arabic
    } else {
        $classes[] = 'en'; // English or other languages
    }

    return $classes;
}
add_filter('body_class', 'add_language_class_to_body');


?>

<body <?php body_class(); ?>>

    <div class="main-wrapper <?php echo substr(get_locale(), 0, 2) === 'ar' ? 'rtl-style' : ''; ?>">

        <!--==================== Preloader Start ====================-->
        <div class="preloader bg-white tw-h-screen justify-content-center align-items-center tw-z-999 position-fixed top-0 tw-start-0 w-100 h-100" style="display: none;">
            <div class="car-road">
                <div class="car">
                    <div class="car-top">
                        <div class="window"></div>
                    </div>
                    <div class="car-base"></div>
                    <div class="wheel-left wheel">
                        <div class="wheel-spike"></div>
                        <div class="wheel-center"></div>
                    </div>
                    <div class="wheel-right wheel">
                        <div class="wheel-spike"></div>
                        <div class="wheel-center"></div>
                    </div>
                    <div class="head-light"></div>
                </div>
                <div class="road"></div>
            </div>
        </div>
        <!--==================== Preloader End ====================-->

        <div class="overlay"></div>

        <div class="side-overlay"></div>

        <div class="progress-wrap cursor-big">
            <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
                <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"></path>
            </svg>
        </div>

        <?php

        if (is_front_page()) {
            $header_slug = 'header';
        } else {
            $header_slug = 'header';
        }

        $header_query = new WP_Query(array(
            'post_type'         => 'header',
            'posts_per_page'    => 1,
            'name'              => $header_slug,
        ));

        if ($header_query->have_posts()) {
            while ($header_query->have_posts()) : $header_query->the_post();
                the_content();
            endwhile;
            wp_reset_postdata();
        }

        ?>


        <header id="header">
            <div class="header-inner">

            </div>
        </header>

        <div id="content">