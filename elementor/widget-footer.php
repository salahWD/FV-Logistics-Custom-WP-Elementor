<?php

if (!defined('ABSPATH')) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

class Widget_Footer extends Widget_Base
{

    public function get_name()
    {
        return 'footer_full_widget';
    }

    public function get_title()
    {
        return __('Footer Full', 'custom-widgets');
    }

    public function get_icon()
    {
        return 'eicon-footer';
    }

    public function get_categories()
    {
        return ['custom-category'];
    }

    protected function _register_controls()
    {

        /* -------------------------------------------
         *  COLUMN 1
         * ------------------------------------------- */
        $this->start_controls_section('column1_section', [
            'label' => __('Column 1 (Logo + Text + Social)', 'custom-widgets'),
        ]);

        $this->add_control('col1_logo', [
            'label' => __('Logo Image', 'custom-widgets'),
            'type' => Controls_Manager::MEDIA,
        ]);

        $this->add_control('col1_text', [
            'label' => __('Description Text', 'custom-widgets'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => 'Our secure online donation platform allows you to make contributions quickly and safely.',
        ]);

        /* SOCIAL ICONS */
        $social = new Repeater();

        $social->add_control('social_icon', [
            'label' => __('Icon Class', 'custom-widgets'),
            'type' => Controls_Manager::TEXT,
            'default' => 'ph ph-facebook-logo',
        ]);

        $social->add_control('social_link', [
            'label' => __('URL', 'custom-widgets'),
            'type' => Controls_Manager::URL,
        ]);

        $this->add_control('col1_social_list', [
            'label' => __('Social Icons', 'custom-widgets'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $social->get_controls(),
            'default' => [],
        ]);

        $this->end_controls_section();



        /* -------------------------------------------
         *  COLUMN 2 – QUICK LINKS
         * ------------------------------------------- */
        $this->start_controls_section('column2_section', [
            'label' => __('Column 2 (Quick Links)', 'custom-widgets'),
        ]);

        $this->add_control('col2_title', [
            'label' => __('Title', 'custom-widgets'),
            'type' => Controls_Manager::TEXT,
            'default' => 'Quick Links',
        ]);

        $links = new Repeater();
        $links->add_control('link_label', [
            'label' => __('Label', 'custom-widgets'),
            'type' => Controls_Manager::TEXT,
        ]);
        $links->add_control('link_url', [
            'label' => __('URL', 'custom-widgets'),
            'type' => Controls_Manager::URL,
        ]);

        $this->add_control('col2_links', [
            'label' => __('Links', 'custom-widgets'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $links->get_controls(),
        ]);

        $this->end_controls_section();



        /* -------------------------------------------
         *  COLUMN 3 – MY ACCOUNT
         * ------------------------------------------- */
        $this->start_controls_section('column3_section', [
            'label' => __('Column 3 (My Account)', 'custom-widgets'),
        ]);

        $this->add_control('col3_title', [
            'label' => __('Title', 'custom-widgets'),
            'type' => Controls_Manager::TEXT,
            'default' => 'My Account',
        ]);

        $this->add_control('col3_links', [
            'label' => __('Links', 'custom-widgets'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $links->get_controls(),
        ]);

        $this->end_controls_section();



        /* -------------------------------------------
         *  COLUMN 4 – LATEST POSTS
         * ------------------------------------------- */
        $this->start_controls_section('column4_section', [
            'label' => __('Column 4 (Latest Posts)', 'custom-widgets'),
        ]);

        $this->add_control('col4_title', [
            'label' => __('Title', 'custom-widgets'),
            'type' => Controls_Manager::TEXT,
            'default' => 'Latest Post',
        ]);

        $posts = new Repeater();

        $posts->add_control('post_img', [
            'label' => __('Post Image', 'custom-widgets'),
            'type' => Controls_Manager::MEDIA,
        ]);

        $posts->add_control('post_date', [
            'label' => __('Date', 'custom-widgets'),
            'type' => Controls_Manager::TEXT,
        ]);

        $posts->add_control('post_title', [
            'label' => __('Post Title', 'custom-widgets'),
            'type' => Controls_Manager::TEXT,
        ]);

        $posts->add_control('post_link', [
            'label' => __('Post URL', 'custom-widgets'),
            'type' => Controls_Manager::URL,
        ]);

        $this->add_control('col4_posts', [
            'label' => __('Posts', 'custom-widgets'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $posts->get_controls(),
        ]);

        $this->end_controls_section();



        /* -------------------------------------------
         *  BOTTOM FOOTER
         * ------------------------------------------- */
        $this->start_controls_section('bottom_section', [
            'label' => __('Bottom Footer', 'custom-widgets'),
        ]);

        $this->add_control('bottom_logo', [
            'label' => __('Bottom Logo', 'custom-widgets'),
            'type' => Controls_Manager::MEDIA,
        ]);

        $this->add_control('bottom_text', [
            'label' => __('Copyright Text', 'custom-widgets'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => '© 2025 wowtheme7 - Logistic Service. All rights reserved.',
        ]);

        /* bottom links */
        $bottom = new Repeater();
        $bottom->add_control('bottom_label', [
            'label' => __('Label', 'custom-widgets'),
            'type' => Controls_Manager::TEXT,
        ]);
        $bottom->add_control('bottom_url', [
            'label' => __('URL', 'custom-widgets'),
            'type' => Controls_Manager::URL,
        ]);

        $this->add_control('bottom_links', [
            'label' => __('Bottom Links', 'custom-widgets'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $bottom->get_controls(),
        ]);

        $this->end_controls_section();
    }

    /* ---------------------------------------------------
     * RENDER WIDGET
     * --------------------------------------------------- */
    protected function render()
    {
        $s = $this->get_settings_for_display();
?>

        <!-- START FOOTER -->
        <footer id="footer" class="footer bg-main-two-600 position-relative z-1 mt-auto tw-pt-266-px">

            <div class="container">
                <div class="tw-pb-84-px">
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 gy-5">

                        <!-- COLUMN 1 -->
                        <div class="col">
                            <?php if (!empty($s['col1_logo']['url'])): ?>
                                <a href="#" class="cursor-big">
                                    <img src="<?= esc_url($s['col1_logo']['url']) ?>" alt="">
                                </a>
                            <?php endif; ?>

                            <p class="text-neutral-100 tw-mt-10 cursor-small">
                                <?= esc_html($s['col1_text']) ?>
                            </p>

                            <div class="tw-mt-9">
                                <ul class="cursor-small d-flex align-items-center tw-gap-3">
                                    <?php foreach ($s['col1_social_list'] as $item): ?>
                                        <li>
                                            <a href="<?= esc_url($item['social_link']['url']) ?>"
                                                class="tw-w-11 tw-h-11 border border-neutral-1100 rounded-circle text-white tw-text-xl d-flex justify-content-center align-items-center hover-bg-main-600 hover-text-white hover-border-main-600 active-scale-09 tw-duration-200">
                                                <i class="<?= esc_attr($item['social_icon']) ?>"></i>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>

                        <!-- COLUMN 2 -->
                        <div class="col">
                            <h5 class="text-white tw-mb-6 cursor-big splitTextStyleTwo">
                                <?= esc_html($s['col2_title']) ?>
                            </h5>
                            <ul class="d-flex flex-column tw-gap-6">
                                <?php foreach ($s['col2_links'] as $item): ?>
                                    <li>
                                        <a href="<?= esc_url($item['link_url']['url']) ?>" class="hover-arrow cursor-small position-relative text-neutral-500 hover-text-main-600 fw-semibold">
                                            <?= esc_html($item['link_label']) ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>

                        <!-- COLUMN 3 -->
                        <div class="col">
                            <h5 class="text-white tw-mb-6 cursor-big splitTextStyleTwo">
                                <?= esc_html($s['col3_title']) ?>
                            </h5>
                            <ul class="d-flex flex-column tw-gap-6">
                                <?php foreach ($s['col3_links'] as $item): ?>
                                    <li>
                                        <a href="<?= esc_url($item['link_url']['url']) ?>" class="hover-arrow cursor-small position-relative text-neutral-500 hover-text-main-600 fw-semibold">
                                            <?= esc_html($item['link_label']) ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>

                        <!-- COLUMN 4 -->
                        <div class="col">
                            <h5 class="text-white tw-mb-6 cursor-big splitTextStyleTwo">
                                <?= esc_html($s['col4_title']) ?>
                            </h5>
                            <div class="d-flex flex-column tw-gap-8">
                                <?php foreach ($s['col4_posts'] as $p): ?>
                                    <div class="d-flex align-items-center tw-gap-4">
                                        <span class="tw-w-70-px tw-h-70-px rounded-circle overflow-hidden flex-shrink-0">
                                            <img src="<?= esc_url($p['post_img']['url']) ?>" alt="" class="w-100 h-100 object-fit-cover">
                                        </span>
                                        <div>
                                            <div class="cursor-small d-flex align-items-center tw-gap-2">
                                                <span class="text-main-600 d-flex"><i class="ph-fill ph-calendar-blank"></i></span>
                                                <span class="text-neutral-600"><?= esc_html($p['post_date']) ?></span>
                                            </div>

                                            <h6 class="tw-mt-205">
                                                <a href="<?= esc_url($p['post_link']['url']) ?>" class="cursor-big tw-text-base text-white hover-text-main-600 line-clamp-2">
                                                    <?= esc_html($p['post_title']) ?>
                                                </a>
                                            </h6>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- BOTTOM FOOTER -->
            <div class="container">
                <div class="border-top border-dashed border-neutral-1100 border-0 tw-py-8">
                    <div class="container container-two">
                        <div class="d-flex align-items-center justify-content-between tw-gap-6 flex-wrap">

                            <div class="mb-0">
                                <?php if (!empty($s['bottom_logo']['url'])): ?>
                                    <a href="#" class="cursor-big">
                                        <img src="<?= esc_url($s['bottom_logo']['url']) ?>" alt="">
                                    </a>
                                <?php endif; ?>
                            </div>

                            <p class="text--white text-line-1 fw-normal cursor-small">
                                <?= wp_kses_post($s['bottom_text']) ?>
                            </p>

                            <div class="d-flex align-items-center tw-gap-6">
                                <?php foreach ($s['bottom_links'] as $b): ?>
                                    <a href="<?= esc_url($b['bottom_url']['url']) ?>" class="fw-semibold text-neutral-500 hover-text-white hover-underline cursor-small hover--translate-y-1">
                                        <?= esc_html($b['bottom_label']) ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </footer>

<?php
    }
}
