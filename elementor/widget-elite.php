<?php
if (! defined('ABSPATH')) exit;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Icons_Manager;


class About_Elite_Widget extends Widget_Base
{

    public function get_name()
    {
        return 'about_elite_section';
    }

    public function get_title()
    {
        return __('About Elite Section', 'fv');
    }

    public function get_icon()
    {
        return 'eicon-info-box';
    }

    public function get_categories()
    {
        return ['general'];
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'fv'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        // Small title
        $this->add_control(
            'small_title',
            [
                'label' => __('Small Title', 'fv'),
                'type' => Controls_Manager::TEXT,
                'default' => 'About Us',
                'label_block' => true,
            ]
        );

        // Main Title
        $this->add_control(
            'title_text',
            [
                'label' => __('Main Title', 'fv'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Elite Global Logistics & Transport Solutions',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'title_text_ar',
            [
                'label' => __('العنوان الرئيسي (بالعربي)', 'fv'),
                'type' => Controls_Manager::TEXT,
                'default' => 'النخبة العالمية لحلول النقل والخدمات اللوجستية',
            ]
        );

        // Paragraph
        $this->add_control(
            'description',
            [
                'label' => __('Description', 'fv'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Objectively transition 24/365 e-tailers before cross functional collaboration...',
                'label_block' => true,
            ]
        );

        // Button Label
        $this->add_control(
            'button_label',
            [
                'label' => __('Button Label', 'fv'),
                'type' => Controls_Manager::TEXT,
                'default' => 'View services',
                'label_block' => true,
            ]
        );

        // Button URL
        $this->add_control(
            'button_url',
            [
                'label' => __('Button URL', 'fv'),
                'type' => Controls_Manager::URL,
                'placeholder' => 'https://your-link.com',
            ]
        );

        // Main Right-side Image
        $this->add_control(
            'main_image',
            [
                'label' => __('Main Image', 'fv'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ]
            ]
        );

        // Shape 1
        $this->add_control(
            'shape_image_1',
            [
                'label' => __('Shape Image 1', 'fv'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ]
            ]
        );

        // Shape 2
        $this->add_control(
            'shape_image_2',
            [
                'label' => __('Shape Image 2', 'fv'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ]
            ]
        );

        $this->end_controls_section();
    }



    protected function render()
    {
        $s = $this->get_settings_for_display();
?>

        <section class="py-120 overflow-hidden">
            <div class="container">
                <div class="row align-items-center">

                    <!-- LEFT TEXT COLUMN -->
                    <div class="col-xl-7 col-lg-7 col-md-10">
                        <div class="about-four-wrapper ps-xl-5" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                            <div class="tw-mb-6">

                                <?php if (!empty($s['small_title'])): ?>
                                    <span class="splitTextStyleTwo cursor-small tw-text-xl fw-bold fst-italic text-decoration-underline text-main-600 tw-mb-305">
                                        <?= esc_html($s['small_title']); ?>
                                    </span>
                                <?php endif; ?>

                                <h2 class="tw-text-60-px splitTextStyleOne cursor-big tw-mb-4">
                                    <?= esc_html(substr(get_locale(), 0, 2) == "ar" ? $s['title_text_ar'] : $s['title_text']) ?>
                                </h2>

                                <?php if (!empty($s['description'])): ?>
                                    <p class="cursor-small tw-ps-205 text-heading font-weight-bold">
                                        <?= esc_html($s['description']); ?>
                                    </p>
                                <?php endif; ?>
                            </div>

                            <div class="d-flex align-items-center tw-gap-56-px tw-mt-10 flex-wrap">
                                <?php if (!empty($s['button_label'])): ?>
                                    <a href="<?= esc_url($s['button_url']['url']); ?>"
                                        class="cursor-small btn btn-main-two hover-style-three button--stroke d-inline-flex align-items-center justify-content-center tw-gap-5 group rounded-0"
                                        data-block="button" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                                        <span class="button__flair"></span>
                                        <span class="button__label"><?= esc_html($s['button_label']); ?></span>
                                        <span class="tw-w-7 tw-h-7 bg-white text-main-600 tw-text-sm tw-rounded d-flex justify-content-center align-items-center position-relative tw-duration-500">
                                            <i class="ph-bold ph-check"></i>
                                        </span>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>


                    <!-- RIGHT IMAGE COLUMN -->
                    <div class="col-xl-5 col-lg-5 col-md-10">
                        <div class="about-five-thumb position-relative z-1" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">

                            <?php if (!empty($s['main_image']['url'])): ?>
                                <img src="<?= esc_url($s['main_image']['url']); ?>" alt="thumb">
                            <?php endif; ?>

                            <div>
                                <?php if (!empty($s['shape_image_1']['url'])): ?>
                                    <img class="about-five-shape-1 position-absolute end-0"
                                        src="<?= esc_url($s['shape_image_1']['url']); ?>" alt="thumb">
                                <?php endif; ?>

                                <?php if (!empty($s['shape_image_2']['url'])): ?>
                                    <img class="about-five-shape-2 position-absolute top-0 end-0"
                                        src="<?= esc_url($s['shape_image_2']['url']); ?>" alt="thumb">
                                <?php endif; ?>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </section>

<?php
    }
}
?>