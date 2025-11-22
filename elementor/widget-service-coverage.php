<?php
if (!defined('ABSPATH')) exit;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

class Widget_Service_Coverage extends Widget_Base
{

    public function get_name()
    {
        return 'widget_service_coverage';
    }

    public function get_title()
    {
        return __('Service Coverage Slider', 'fv');
    }

    public function get_icon()
    {
        return 'eicon-slider-push';
    }

    public function get_categories()
    {
        return ['general'];
    }

    protected function register_controls()
    {

        // SECTION TITLE
        $this->start_controls_section(
            'title_section',
            [
                'label' => __('Section Title', 'fv'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label' => __('Subtitle', 'fv'),
                'type'  => Controls_Manager::TEXT,
                'default' => 'Safe Transportation & Logistics',
            ]
        );

        $this->add_control(
            'title_text',
            [
                'label' => __('Main Title', 'fv'),
                'type'  => Controls_Manager::TEXTAREA,
                'default' => 'Fastest & Secured Logistics Solution & Services',
            ]
        );

        $this->add_control(
            'title_text_ar',
            [
                'label' => __('العنوان الرئيسي (بالعربي)', 'fv'),
                'type' => Controls_Manager::TEXT,
                'default' => 'أسرع وآمن الحلول اللوجستية والخدمات',
            ]
        );

        $this->end_controls_section();

        // SERVICE REPEATER
        $this->start_controls_section(
            'services_section',
            [
                'label' => __('Services List', 'fv'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'image',
            [
                'label' => __('Service Image', 'fv'),
                'type'  => Controls_Manager::MEDIA,
            ]
        );

        $repeater->add_control(
            'icon',
            [
                'label' => __('Service Icon', 'fv'),
                'type'  => Controls_Manager::MEDIA,
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label' => __('Title', 'fv'),
                'type'  => Controls_Manager::TEXT,
                'default' => 'Service Title',
            ]
        );

        $repeater->add_control(
            'desc',
            [
                'label' => __('Short Description', 'fv'),
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label' => __('Link', 'fv'),
                'type' => Controls_Manager::URL,
                'placeholder' => 'https://',
            ]
        );

        $this->add_control(
            'services',
            [
                'label' => __('Service Items', 'fv'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $s = $this->get_settings_for_display();
?>

        <section class="service-three pt-140 overflow-hidden">
            <div class="container">

                <!-- TITLE -->
                <div class="max-w-856-px mx-auto text-center tw-pb-16 tw-mb-6">
                    <span class="splitTextStyleTwo cursor-small tw-text-xl fw-bold fst-italic text-decoration-underline text-main-600 tw-mb-305">
                        <?= esc_html($s['subtitle']) ?>
                    </span>

                    <h1 class="splitTextStyleOne cursor-big">
                        <?= esc_html(substr(get_locale(), 0, 2) == "ar" ? $s['title_text_ar'] : $s['title_text']) ?>
                    </h1>
                </div>

                <!-- SLIDER -->
                <div class="position-relative">

                    <div class="service-three-slider swiper">
                        <div class="swiper-wrapper">

                            <?php foreach ($s['services'] as $i => $item): ?>
                                <?php
                                $link = $item['link']['url'] ?? '#';
                                ?>
                                <div class="swiper-slide aos-init"
                                    data-aos="fade-up"
                                    data-aos-duration="1000"
                                    data-aos-delay="<?= ($i + 1) * 100 ?>">

                                    <div class="service-three-item tw-pb-13 overflow-hidden position-relative group">

                                        <a href="<?= esc_url($link) ?>"
                                            class="triangle-before position-relative w-100 h-100 p-2 bg-white overflow-hidden">

                                            <?php if (!empty($item['image']['url'])): ?>
                                                <img src="<?= esc_url($item['image']['url']); ?>" alt="" class="w-100 h-100 object-fit-cover">
                                            <?php endif; ?>
                                        </a>

                                        <div class="service-three-item__content tw-duration-500 tw-ps-4 position-absolute bottom-0 tw-start-0 tw-end-0 w-100">

                                            <div class="bg-white triangle-two-before position-relative z-1 border-bottom border-main-600 common-shadow-five two tw-py-405 tw-mx-32-px d-flex align-items-start tw-gap-405 tw-pe-6">

                                                <span class="tw-h-85-px tw-w-85-px bg-main-600 tw-rounded d-flex justify-content-center align-items-center tw--ms-16-px cursor-big flex-shrink-0 group-hover-bg-main-two-600 tw-duration-500">
                                                    <?php if (!empty($item['icon']['url'])): ?>
                                                        <img src="<?= esc_url($item['icon']['url']); ?>" alt="">
                                                    <?php endif; ?>
                                                </span>

                                                <div class="tw-py-605 flex-grow-1">
                                                    <h6 class="tw-mb-8 cursor-big tw-text-lg">
                                                        <a href="<?= esc_url($link) ?>" class="line-clamp-2 hover-text-main-600">
                                                            <?= esc_html($item['title']) ?>
                                                        </a>
                                                    </h6>

                                                    <p class="text-neutral-1000 cursor-small line-clamp-3">
                                                        <?= esc_html($item['desc']) ?>
                                                    </p>

                                                    <a href="<?= esc_url($link) ?>"
                                                        class="cursor-big d-flex align-items-center tw-gap-3 text-main-two-600 fw-semibold tw-mt-4 hover-text-main-600">
                                                        Explore More
                                                        <span><img src="assets/images/icons/arrow-long.svg" alt=""></span>
                                                    </a>
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>
                            <?php endforeach; ?>

                        </div>
                    </div>

                    <!-- ARROWS -->
                    <div class="cursor-big service-three-button-prev tw-w-14 tw-h-14 rounded-circle tw-text-xl text-white bg-main-600 tw-mt-705 hover-bg-main-600 d-flex justify-content-center align-items-center tw-duration-300 position-absolute top-50 tw--translate-y-50 tw-end-full tw-me-8">
                        <i class="ph ph-arrow-left"></i>
                    </div>

                    <div class="cursor-big service-three-button-next tw-w-14 tw-h-14 rounded-circle tw-text-xl text-white bg-main-600 tw-mt-705 hover-bg-main-600 d-flex justify-content-center align-items-center tw-duration-300 position-absolute top-50 tw--translate-y-50 tw-start-full tw-ms-8">
                        <i class="ph ph-arrow-right"></i>
                    </div>

                </div>

            </div>
        </section>

<?php
    }
}
?>