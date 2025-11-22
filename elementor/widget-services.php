<?php
if (!defined('ABSPATH')) exit;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

class Widget_Services extends Widget_Base
{

    public function get_name()
    {
        return 'services_four';
    }

    public function get_title()
    {
        return __('Services Four Slider', 'fv');
    }

    public function get_icon()
    {
        return 'eicon-slider-push';
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

        /* -------- SECTION HEADER -------- */
        $this->start_controls_section(
            'section_header',
            ['label' => __('Section Header', 'fv')]
        );

        $this->add_control(
            'subtitle',
            [
                'label' => __('Subtitle', 'fv'),
                'type' => Controls_Manager::TEXT,
                'default' => 'Services'
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __('Main Title', 'fv'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Our Service For You'
            ]
        );

        $this->add_control(
            'title_ar',
            [
                'label' => __('العنوان الرئيسي (بالعربي)', 'fv'),
                'type' => Controls_Manager::TEXT,
                'default' => 'خدماتنا لك',
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => __('Button Text', 'fv'),
                'type' => Controls_Manager::TEXT,
                'default' => 'View All Services'
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label' => __('Button Link', 'fv'),
                'type' => Controls_Manager::URL,
                'default' => ['url' => '#']
            ]
        );

        $this->end_controls_section();


        /* -------- SERVICES REPEATER -------- */
        $this->start_controls_section(
            'services_section',
            ['label' => __('Service Items', 'fv')]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'service_icon',
            [
                'label' => __('Icon Image', 'fv'),
                'type' => Controls_Manager::MEDIA
            ]
        );

        $repeater->add_control(
            'service_title',
            [
                'label' => __('Service Title', 'fv'),
                'type' => Controls_Manager::TEXT,
                'default' => 'Service Title'
            ]
        );

        $repeater->add_control(
            'service_desc',
            [
                'label' => __('Description', 'fv'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Service description here...'
            ]
        );

        $repeater->add_control(
            'service_link',
            [
                'label' => __('Details Link', 'fv'),
                'type' => Controls_Manager::URL,
                'default' => ['url' => '#']
            ]
        );

        $repeater->add_control(
            'background_img',
            [
                'label' => __('Background Image', 'fv'),
                'type' => Controls_Manager::MEDIA
            ]
        );

        $repeater->add_control(
            'corner_shape',
            [
                'label' => __('Corner Shape Image', 'fv'),
                'type' => Controls_Manager::MEDIA
            ]
        );

        $this->add_control(
            'service_items',
            [
                'label' => __('Services', 'fv'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
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

        $subtitle = $s['subtitle'];
        $title = substr(get_locale(), 0, 2) == "ar" ? $s['title_ar'] : $s['title'];
        $button_text = $s['button_text'];
        $button_link = $s['button_link']['url'] ?? '#';

        $items = $s['service_items'] ?? [];

?>
        <div class="pt-120">
            <section class="pb-120 overflow-hidden">
                <div class="container">
                    <div class="row align-items-center">

                        <!-- LEFT TEXT -->
                        <div class="col-xl-6 col-lg-8 col-md-7">
                            <div class="tw-mb-6 aos-init" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                                <span class="splitTextStyleTwo cursor-small tw-text-xl fw-bold fst-italic text-decoration-underline text-main-600 tw-mb-305">
                                    <?php echo esc_html($subtitle); ?>
                                </span>

                                <h1 class="splitTextStyleOne cursor-big tw-mb-8">
                                    <?php echo wp_kses_post($title); ?>
                                </h1>
                            </div>
                        </div>

                        <!-- RIGHT BUTTON -->
                        <div class="col-xl-6 col-lg-4 col-md-5">
                            <div class="d-flex justify-content-end aos-init" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                                <a href="<?php echo esc_url($button_link); ?>" class="cursor-small btn btn-main hover-style-one button--stroke tw-py-405 d-inline-flex align-items-center justify-content-center tw-gap-5 group active--translate-y-2" data-block="button">
                                    <span class="button__flair"></span>
                                    <span class="button__label"><?php echo esc_html($button_text); ?></span>
                                    <span class="tw-w-7 tw-h-7 bg-white text-main-600 tw-text-sm tw-rounded d-flex justify-content-center align-items-center position-relative group-hover-bg-main-600 group-hover-text-white tw-duration-500">
                                        <i class="ph-bold ph-check"></i>
                                    </span>
                                </a>
                            </div>
                        </div>

                    </div>



                    <!-- SLIDER -->
                    <div class="row gx-0">
                        <div class="col-xxl-12">
                            <div class="service-four-slider tw-mx--30-px position-relative overflow-hidden aos-init" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">

                                <div class="service-four-active tw-m-30-25-px swiper-container">
                                    <div class="swiper-wrapper">

                                        <?php foreach ($items as $item):
                                            $icon = $item['service_icon']['url'] ?? '';
                                            $bg = $item['background_img']['url'] ?? '';
                                            $shape = $item['corner_shape']['url'] ?? '';
                                            $link = $item['service_link']['url'] ?? '#';
                                        ?>

                                            <div class="service-four-wrapper swiper-slide bg-img tw-rounded-lg tw-p-36-px position-relative z-1"
                                                data-background-image="<?php echo esc_url($bg); ?>"
                                                style="background:url('<?php echo esc_url($bg); ?>');">

                                                <div class="tw-mb-6">
                                                    <?php if ($icon): ?>
                                                        <span><img src="<?php echo esc_url($icon); ?>" alt="icon"></span>
                                                    <?php endif; ?>
                                                </div>

                                                <h5 class="service-four-title tw-mb-4 tw-transition-common">
                                                    <a href="<?php echo esc_url($link); ?>">
                                                        <?php echo esc_html($item['service_title']); ?>
                                                    </a>
                                                </h5>

                                                <p class="service-four-paragraph tw-border-bottom tw-mb-6 tw-pb-6 tw-transition-common">
                                                    <?php echo esc_html($item['service_desc']); ?>
                                                </p>

                                                <div>
                                                    <a class="service-four-button d-flex align-items-center justify-content-between fw-bold text-main-600"
                                                        href="<?php echo esc_url($link); ?>">
                                                        Read More
                                                        <span class="tw-w-26-px tw-h-26-px d-inline-flex align-items-center justify-content-center bg-main-600 text-white rounded-circle">
                                                            <i class="ph ph-arrow-right"></i>
                                                        </span>
                                                    </a>
                                                </div>

                                                <?php if ($shape): ?>
                                                    <div class="service-four-shape position-absolute top-0 end-0">
                                                        <img src="<?php echo esc_url($shape); ?>" alt="">
                                                    </div>
                                                <?php endif; ?>
                                            </div>

                                        <?php endforeach; ?>

                                    </div>

                                    <span class="swiper-notification"></span>
                                </div>

                                <div class="service-four-dots text-center dots-color tw-mt-15 swiper-pagination-clickable swiper-pagination-bullets swiper-pagination-horizontal"></div>

                            </div>
                        </div>
                    </div>

                </div>
            </section>
        </div>

<?php
    }
}
?>