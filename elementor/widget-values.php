<?php
if (!defined('ABSPATH')) exit;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;

class Widget_Values extends Widget_Base
{

    public function get_name()
    {
        return 'widget_values';
    }

    public function get_title()
    {
        return __('Values Widget', 'fv');
    }

    public function get_icon()
    {
        return 'eicon-number-field';
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
                'label' => __('Counters', 'fv'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        // Main Title
        $this->add_control(
            'title_text',
            [
                'label' => __('Section Title', 'fv'),
                'type' => Controls_Manager::TEXT,
                'default' => 'Our Values',
            ]
        );

        $this->add_control(
            'title_text_ar',
            [
                'label' => __('العنوان الرئيسي (بالعربي)', 'fv'),
                'type' => Controls_Manager::TEXT,
                'default' => 'قيمنا',
            ]
        );

        // REPEATER
        $repeater = new Repeater();

        $repeater->add_control(
            'icon',
            [
                'label' => __('Icon (SVG/PNG)', 'fv'),
                'type'  => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ]
            ]
        );

        $repeater->add_control(
            'number',
            [
                'label' => __('Number', 'fv'),
                'type'  => Controls_Manager::TEXT,
                'default' => '35+',
            ]
        );

        $repeater->add_control(
            'label',
            [
                'label' => __('Label', 'fv'),
                'type'  => Controls_Manager::TEXT,
                'default' => 'Main Warehouses',
            ]
        );

        $this->add_control(
            'counters',
            [
                'label' => __('Counter Items', 'fv'),
                'type'  => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    ['number' => '35+',  'label' => 'Main Warehouses'],
                    ['number' => '853+', 'label' => 'Supply Engineers'],
                    ['number' => '55+',  'label' => 'Countries Covered'],
                    ['number' => '40+',  'label' => 'Total Services'],
                ],
                'title_field' => '{{{ label }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $s = $this->get_settings_for_display();
?>

        <section class="pt-140 shape-bg-main-600 position-relative z-1 overflow-hidden tw-pb-6">

            <?php if (! empty($s['title_text'])) : ?>
                <h1 class="splitTextStyleOne cursor-big tw-mb-8 text-center">
                    <?= esc_html(substr(get_locale(), 0, 2) == "ar" ? $s['title_text_ar'] : $s['title_text']) ?>
                </h1>
            <?php endif; ?>

            <div class="container">
                <div class="row gy-4">

                    <?php if (! empty($s['counters'])) : ?>
                        <?php foreach ($s['counters'] as $index => $item) : ?>

                            <div class="col-lg-3 col-sm-6 col-xs-6">
                                <div class="counter-three-item common-shadow-five bg-white tw-duration-500 tw-rounded-lg tw-px-2 tw-pb-10 tw-pt-80-px animation-item position-relative text-center tw-mt-14 aos-init aos-animate"
                                    data-aos="fade-up"
                                    data-aos-duration="1000"
                                    data-aos-delay="<?php echo esc_attr(($index + 1) * 100); ?>">

                                    <span class="cursor-big bg-white common-shadow-four tw-w-108-px tw-h-108-px d-inline-flex justify-content-center align-items-center rounded-circle tw-duration-300 position-absolute top-0 tw-start-50 tw--translate-x-50 tw--mt-54-px">
                                        <?php if (! empty($item['icon']['url'])) : ?>
                                            <img src="<?php echo esc_url($item['icon']['url']); ?>" alt="" class="animate__heartBeat">
                                        <?php endif; ?>
                                    </span>

                                    <h3 class="tw-mb-5 cursor-big counter hover-text tw-duration-500">
                                        <?php echo esc_html($item['number']); ?>
                                    </h3>

                                    <p class="hover-text tw-duration-500 text-main-two-600 fw-medium cursor-small mx-auto">
                                        <?php echo esc_html($item['label']); ?>
                                    </p>

                                </div>
                            </div>

                        <?php endforeach; ?>
                    <?php endif; ?>

                </div>
            </div>
        </section>

<?php
    }
}
?>