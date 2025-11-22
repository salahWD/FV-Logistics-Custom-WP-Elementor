<?php


if (! defined('ABSPATH')) exit;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Repeater;

class Widget_Header_Menu extends Widget_Base
{

    public function get_name()
    {
        return 'header_menu';
    }

    public function get_title()
    {
        return __('Header Navigation', 'fv');
    }

    public function get_icon()
    {
        return 'eicon-navigation-horizontal';
    }

    public function get_categories()
    {
        return ['general'];
    }

    protected function register_controls()
    {

        $this->start_controls_section('section_logo', [
            'label' => __('Logo', 'fv'),
        ]);

        $this->add_control('logo', [
            'label' => __('Logo Image', 'fv'),
            'type' => Controls_Manager::MEDIA,
            'default' => [
                'url' => defined('THEME_URL') ? THEME_URL . '/<?= THEME_URL ?>/assets/images/logo.svg' : '',
            ],
        ]);

        $this->end_controls_section();

        /* -----------------------------------------
           SUBMENU ITEMS (Nested Repeater)
        ----------------------------------------- */
        $submenu_repeater = new Repeater();

        $submenu_repeater->add_control(
            'submenu_text',
            [
                'label' => __('Submenu Text', 'fv'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Submenu Item', 'fv'),
            ]
        );

        $submenu_repeater->add_control(
            'submenu_link',
            [
                'label' => __('Submenu URL', 'fv'),
                'type' => Controls_Manager::URL,
                'placeholder' => __('https://your-link.com', 'fv'),
            ]
        );

        /* -----------------------------------------
           MAIN MENU ITEMS (Repeater)
        ----------------------------------------- */
        $menu_repeater = new Repeater();

        $menu_repeater->add_control(
            'type',
            [
                'label' => __('Item Type', 'fv'),
                'type' => Controls_Manager::SELECT,
                'default' => 'link',
                'options' => [
                    'link'    => __('Single Link', 'fv'),
                    'submenu' => __('Dropdown Menu', 'fv'),
                ],
            ]
        );

        $menu_repeater->add_control(
            'title',
            [
                'label' => __('Title', 'fv'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Menu Item', 'fv'),
            ]
        );

        $menu_repeater->add_control(
            'link',
            [
                'label' => __('URL', 'fv'),
                'type' => Controls_Manager::URL,
                'condition' => [
                    'type' => 'link',
                ],
            ]
        );

        $menu_repeater->add_control(
            'submenu_items',
            [
                'label' => __('Submenu Items', 'fv'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $submenu_repeater->get_controls(),
                'condition' => [
                    'type' => 'submenu',
                ],
            ]
        );

        $this->start_controls_section(
            'menu_section',
            [
                'label' => __('Navigation Menu', 'fv'),
            ]
        );

        $this->add_control(
            'menu_items',
            [
                'label' => __('Menu Items', 'fv'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $menu_repeater->get_controls(),
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $menu_items = $settings['menu_items'];
?>

        <div class="absolute-headers md-bg-main-two-600 position-absolute top-0 tw-start-0 tw-end-0 w-100 tw-z-99 header py-0">
            <header class="transition-all links-white">
                <div class="tw-container-1760-px tw-px-4 pe-lg-0 mx-auto">
                    <nav class="bg-green d-flex justify-content-between tw-ps-3 tw-pe-100-px py-lg-0 py-3">

                        <div class="d-flex">

                            <!-- Logo Desktop -->
                            <a href="<?php echo home_url('/'); ?>"
                                class="cursor-big bg-main-600 d-lg-flex d-none justify-content-center align-items-center tw-ps-10 tw-pe-14 hexagon-right">
                                <img src="<?php echo esc_url($settings['logo']['url']); ?>" alt="Logo" class="max-w-175-px">
                            </a>

                            <!-- Logo Mobile -->
                            <a href="<?php echo home_url('/'); ?>"
                                class="d-lg-none d-flex justify-content-center align-items-center">
                                <img src="<?php echo esc_url($settings['logo']['url']); ?>" alt="Logo" class="max-w-175-px">
                            </a>

                            <!-- Desktop Menu -->
                            <div class="header-menu d-lg-block d-none ps-108-px">
                                <ul class="nav-menu cursor-small d-lg-flex align-items-center xl-tw-gap-12 tw-gap-4">

                                    <?php foreach ($menu_items as $item): ?>

                                        <?php if ($item['type'] === 'link'): ?>
                                            <li class="nav-menu__item">
                                                <a href="<?php echo esc_url($item['link']['url']); ?>"
                                                    class="nav-menu__link hover--translate-y-1 text-main-two-600 tw-py-9 fw-medium w-100">
                                                    <?php echo esc_html($item['title']); ?>
                                                </a>
                                            </li>

                                        <?php else: ?>
                                            <li class="nav-menu__item has-submenu position-relative">
                                                <a href="javascript:void(0)"
                                                    class="nav-menu__link hover--translate-y-1 text-main-two-600 tw-py-9 fw-medium w-100 tw-pe-4">
                                                    <?php echo esc_html($item['title']); ?>
                                                </a>

                                                <ul class="nav-submenu scroll-sm position-absolute start-0 top-100 tw-w-max bg-white tw-rounded-md overflow-hidden tw-p-2 tw-mt-4 tw-duration-200 tw-z-99">

                                                    <?php foreach ($item['submenu_items'] as $sub): ?>
                                                        <li class="nav-submenu__item d-block tw-rounded tw-duration-200 position-relative">
                                                            <a href="<?php echo esc_url($sub['submenu_link']['url']); ?>"
                                                                class="nav-submenu__link hover-bg-neutral-100 text-black fw-medium w-100 d-block tw-py-2 tw-px-305 tw-rounded">
                                                                <?php echo esc_html($sub['submenu_text']); ?>
                                                            </a>
                                                        </li>
                                                    <?php endforeach; ?>

                                                </ul>
                                            </li>

                                        <?php endif; ?>

                                    <?php endforeach; ?>

                                </ul>
                            </div>

                        </div>


                        <!-- Header Right start -->
                        <div class="d-flex gap-xxl-5 gap-3">
                            <div class="d-flex align-items-center tw-gap-36-px flex-shrink-0">
                                <!-- Language Start -->
                                <div class="cursor-small position-relative group-item hover-mt-0 xs-d-block d-none">
                                    <div class="d-flex align-items-center tw-gap-2">
                                        <?php
                                        // Detect language (simple version based on URL)
                                        $is_ar = preg_match('/^\/ar(\/|$)/', $_SERVER['REQUEST_URI']);

                                        // Current page path (without language prefix)
                                        $path = $_SERVER['REQUEST_URI'];
                                        $path = preg_replace('/^\/ar/', '', $path);       // remove /ar if exists
                                        $path = ltrim($path, '/');                        // remove leading /

                                        /* -----------------------------------------
                                                Build toggle URL
                                            ----------------------------------------- */

                                        // If currently Arabic → switch to English
                                        if ($is_ar) {
                                            $toggle_url = "/" . $path;        // English version
                                        }
                                        // If currently English → switch to Arabic
                                        else {
                                            $toggle_url = "/ar/" . $path;     // Arabic version
                                        }

                                        /* -----------------------------------------
                                                Choose flag + text
                                            ----------------------------------------- */
                                        if ($is_ar) {
                                            $lang_text = "English";
                                            $flag      = THEME_URL . "/assets/images/flag1.png";
                                        } else {
                                            $lang_text = "العربية";
                                            $flag      = THEME_URL . "/assets/images/flag2.png";
                                        }
                                        ?>
                                        <a href="<?= esc_url($toggle_url); ?>"
                                            class="selected-text text-white py-lg-4 d-flex align-items-center gap-2">
                                            <span
                                                class="tw-w-25-px tw-h-25-px border border-white border-2 rounded-circle common-shadow d-flex justify-content-center align-items-center">
                                                <img src="<?= esc_url($flag); ?>" alt=""
                                                    class="w-100 h-100 object-fit-cover rounded-circle">
                                            </span>
                                            <?= $lang_text ?>
                                        </a>
                                        <span class="text-white">
                                            <i class="ph-bold ph-caret-down"></i>
                                        </span>
                                    </div>
                                    <ul
                                        class="lang-dropdown tw-max-h-300-px overflow-y-auto scroll-sm bg-white common-shadow tw-px-4 tw-py-3 position-absolute tw-end-0 top-100 min-w-max tw-rounded-lg d-flex flex-column tw-gap-3 tw-invisible opacity-0 group-hover-item-visible group-hover-item-opacity-1 tw-duration-200 group-hover-item-mt-0 tw-mt-4 tw-z-99">
                                        <li>
                                            <a href="/"
                                                class="text-black d-flex align-items-center gap-2 hover-text-main-600 active--translate-y-1 tw-duration-150">
                                                <span
                                                    class="tw-w-25-px tw-h-25-px border border-white border-2 rounded-circle d-flex justify-content-center align-items-center">
                                                    <img src="<?= THEME_URL ?>/assets/images/flag1.png" alt=""
                                                        class="w-100 h-100 object-fit-cover rounded-circle">
                                                </span>
                                                English
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/ar"
                                                class="text-black d-flex align-items-center gap-2 hover-text-main-600 active--translate-y-1 tw-duration-150">
                                                <span
                                                    class="tw-w-25-px tw-h-25-px border border-white border-2 rounded-circle d-flex justify-content-center align-items-center">
                                                    <img src="<?= THEME_URL ?>/assets/images/flag2.png" alt=""
                                                        class="w-100 h-100 object-fit-cover rounded-circle">
                                                </span>
                                                العربية
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- Language End -->

                            </div>

                            <button type="button" class="toggle-mobileMenu leading-none d-lg-none text-white tw-text-9">
                                <i class="ph ph-list"></i>
                            </button>
                        </div>

                        <!-- Header Right End  -->


                    </nav>
                </div>
            </header>
        </div>

        <!-- ==================== Mobile Menu Start ==================== -->
        <div class="mobile-menu d-lg-none d-block scroll-sm position-fixed bg-white tw-w-300-px tw-h-screen overflow-y-auto tw-p-6 tw-z-999 tw--translate-x-full tw-pb-68">
            <button type="button"
                class="close-button position-absolute tw-end-0 top-0 tw-me-2 tw-mt-2 tw-w-605 tw-h-605 rounded-circle d-flex justify-content-center align-items-center text-main-two-600 bg-neutral-200 hover-bg-main-two-600 hover-text-white">
                <i class="ph ph-x"></i>
            </button>

            <?php
            /* ===========================================================
                    MOBILE MENU (Dynamic - Same Structure as Desktop Menu)
                =========================================================== */
            ?>

            <div class="mobile-menu__inner">

                <a href="<?php echo home_url('/'); ?>" class="mobile-menu__logo">
                    <img src="<?php echo THEME_URL; ?>/<?= THEME_URL ?>/assets/images/logo2.png" alt="Logo">
                </a>

                <div class="mobile-menu__menu">
                    <ul class="mobile-nav-menu">

                        <?php foreach ($menu_items as $item): ?>

                            <?php if ($item['type'] === 'link'): ?>

                                <li class="mobile-nav-item">
                                    <a href="<?php echo esc_url($item['link']['url']); ?>"
                                        class="mobile-nav-link">
                                        <?php echo esc_html($item['title']); ?>
                                    </a>
                                </li>

                            <?php else: ?>

                                <li class="mobile-nav-item has-submenu">
                                    <button class="mobile-submenu-toggle">
                                        <?php echo esc_html($item['title']); ?>
                                        <i class="ph ph-caret-down"></i>
                                    </button>

                                    <ul class="mobile-submenu">

                                        <?php foreach ($item['submenu_items'] as $sub): ?>
                                            <li class="mobile-submenu-item">
                                                <a href="<?php echo esc_url($sub['submenu_link']['url']); ?>"
                                                    class="mobile-submenu-link">
                                                    <?php echo esc_html($sub['submenu_text']); ?>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>

                                    </ul>
                                </li>

                            <?php endif; ?>

                        <?php endforeach; ?>

                    </ul>
                </div>

            </div>

        </div>
        <!-- ==================== Mobile Menu End ==================== -->



<?php
    }
}
