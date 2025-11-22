<?php

if (! defined('ABSPATH')) exit;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Widget_Banner_Three extends Widget_Base
{

    public function get_name()
    {
        return 'banner_three';
    }

    public function get_title()
    {
        return __('Banner Three', 'fv');
    }

    public function get_icon()
    {
        return 'eicon-slider-full-screen';
    }

    public function get_categories()
    {
        return ['general'];
    }

    /* -----------------------------------------
        Controls
    ----------------------------------------- */
    protected function register_controls()
    {

        /* -----------------------------------------
            Section: Content
        ----------------------------------------- */
        $this->start_controls_section(
            'banner_content',
            [
                'label' => __('Content', 'fv'),
            ]
        );

        $this->add_control(
            'small_text',
            [
                'label' => __('Small Label', 'fv'),
                'type' => Controls_Manager::TEXT,
                'default' => 'Delivery service',
            ]
        );

        $this->add_control(
            'title_text',
            [
                'label' => __('Main Title', 'fv'),
                'type' => Controls_Manager::TEXT,
                'default' => 'A Modern logistic solution',
            ]
        );

        $this->add_control(
            'title_text_ar',
            [
                'label' => __('العنوان الرئيسي (بالعربي)', 'fv'),
                'type' => Controls_Manager::TEXT,
                'default' => 'حلول لوجستية حديثة',
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => __('Button Text', 'fv'),
                'type' => Controls_Manager::TEXT,
                'default' => 'Get started now',
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label' => __('Button Link', 'fv'),
                'type' => Controls_Manager::URL,
                'placeholder' => 'https://',
            ]
        );

        $this->add_control(
            'secondary_link_text',
            [
                'label' => __('Secondary Link Text', 'fv'),
                'type' => Controls_Manager::TEXT,
                'default' => 'Watch Video',
            ]
        );

        $this->add_control(
            'secondary_link_url',
            [
                'label' => __('Secondary Link URL', 'fv'),
                'type' => Controls_Manager::URL,
                'placeholder' => 'https://',
            ]
        );

        $this->end_controls_section();

        /* -----------------------------------------
            Section: Images
        ----------------------------------------- */
        $this->start_controls_section(
            'banner_images',
            [
                'label' => __('Images', 'fv'),
            ]
        );

        $this->add_control(
            'bg_image',
            [
                'label' => __('Background Image', 'fv'),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'bg_image_ar',
            [
                'label' => __('Background Image (Horizontally Flipped For ar)', 'fv'),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'track_image',
            [
                'label' => __('Track Image', 'fv'),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'road_image',
            [
                'label' => __('Road Image', 'fv'),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'plane_image',
            [
                'label' => __('Plane Image', 'fv'),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $this->end_controls_section();
    }

    /* -----------------------------------------
        Render
    ----------------------------------------- */
    protected function render()
    {

        $s = $this->get_settings_for_display();
?>

        <section class="banner-three bg-img overflow-hidden position-relative z-1"
            data-background-image="<?= esc_url(substr(get_locale(), 0, 2) == "ar" ? $s['bg_image_ar']['url'] : $s['bg_image']['url'] ?? ''); ?>"
            style="background: url('<?= esc_url(substr(get_locale(), 0, 2) == "ar" ? $s['bg_image_ar']['url'] : $s['bg_image']['url'] ?? ''); ?>');">
            <div class="ar-flip">
                <img src="<?php echo esc_url($s['track_image']['url'] ?? ''); ?>" alt=""
                    class="only-track position-absolute tw-start-0 bottom-0 max-w-64-percent tw-z-2"
                    style="translate: none; rotate: none; scale: none; transform: translate3d(-227.395px, 0px, 0px);">
            </div>
            <img src="<?php echo esc_url($s['road_image']['url'] ?? ''); ?>" alt=""
                class="curve-road position-absolute tw-end-0 bottom-0 tw-mb-142-px">
            <img src="<?php echo esc_url($s['plane_image']['url'] ?? ''); ?>" alt=""
                class="banner-three-plane position-absolute tw-end-0 top-0 tw-mt-254-px"
                style="translate: none; rotate: none; scale: none; transform: translate(80px) scale(0.6);">


            <div data-aos="zoom-in" data-aos-duration="1500" class="aos-init aos-animate">
            </div>


            <div class="container">
                <div class="row gy-4 justify-content-end">
                    <div class="col-lg-7 position-relative z-2">
                        <?php if (!empty($s['small_text'])) : ?>
                            <span class="d-block text-white text-24 mb-16 fw-medium">
                                <?php echo esc_html($s['small_text']); ?>
                            </span>
                        <?php endif; ?>
                        <h1 class="splitTextStyleOne cursor-big text-white tw-text-80-px">
                            <?= esc_html(substr(get_locale(), 0, 2) == "ar" ? $s['title_text_ar'] : $s['title_text']) ?>
                        </h1>

                        <div class="d-flex tw-gap-11 tw-mt-13 flex-wrap">
                            <?php if (!empty($s['button_text'])) : ?>
                                <a href="<?php echo esc_url($s['button_link']['url'] ?? '#'); ?>"
                                    class="cursor-small btn btn-main hover-style-two button--stroke d-inline-flex align-items-center justify-content-center tw-gap-5 group active--translate-y-2"
                                    data-block="button">
                                    <span class="button__flair"
                                        style="translate: none; rotate: none; scale: none; transform: translate(-20%, 34.0278%) scale(0);"></span>
                                    <span class="button__label"><?php echo esc_html($s['button_text']); ?></span>
                                    <span
                                        class="tw-w-7 tw-h-7 bg-white text-main-600 tw-text-sm tw-rounded d-flex justify-content-center align-items-center position-relative group-hover-bg-main-600 group-hover-text-white tw-duration-500">
                                        <i class="ph-bold ph-check"></i>
                                    </span>
                                </a>
                            <?php endif; ?>

                            <?php if (!empty($s['secondary_link_text'])) : ?>
                                <a href="<?php echo esc_url($s['secondary_link_url']['url'] ?? '#'); ?>"
                                    class="cursor-small d-inline-flex align-items-center tw-gap-2 text-white fw-semibold hover-text-main-600 group active--translate-y-2 aos-init aos-animate"
                                    data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">
                                    <?php echo esc_html($s['secondary_link_text']); ?>
                                    <span class="text-main-600 d-flex group-hover-text-white tw-duration-200 tw-text-base">
                                        <i class="ph-fill ph-caret-circle-right"></i>
                                    </span>

                                </a>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
        </section>
<?php
    }
}
