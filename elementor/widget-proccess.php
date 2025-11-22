<?php
if (!defined('ABSPATH')) exit;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;


class Widget_Proccess extends Widget_Base
{

    public function get_name()
    {
        return 'proccess_widget';
    }

    public function get_title()
    {
        return __('Proccess Section', 'fv');
    }

    public function get_icon()
    {
        return 'eicon-tools';
    }

    public function get_categories()
    {
        return ['general'];
    }

    protected function register_controls()
    {

        // SECTION CONTENT
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'fv'),
                'tab'   => Controls_Manager::TAB_CONTENT,
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
            'title',
            [
                'label' => __('Title', 'fv'),
                'type'  => Controls_Manager::TEXT,
                'default' => 'Introducing The most modern way of Transportation',
            ]
        );

        $this->add_control(
            'title_ar',
            [
                'label' => __('العنوان الرئيسي (بالعربي)', 'fv'),
                'type' => Controls_Manager::TEXT,
                'default' => 'تقديم احدث طرق الشحن',
            ]
        );

        $this->add_control(
            'bg_image',
            [
                'label' => __('Background Image', 'fv'),
                'type'  => Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'plane_image',
            [
                'label' => __('Plane Image (left)', 'fv'),
                'type'  => Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'line_image',
            [
                'label' => __('Right Line Image', 'fv'),
                'type'  => Controls_Manager::MEDIA,
            ]
        );

        $this->end_controls_section();

        // REPEATER FOR STEPS
        $this->start_controls_section(
            'steps_section',
            [
                'label' => __('Steps', 'fv'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'step_icon',
            [
                'label' => __('Step Icon', 'fv'),
                'type'  => Controls_Manager::MEDIA,
            ]
        );

        $repeater->add_control(
            'step_title',
            [
                'label' => __('Step Title', 'fv'),
                'type'  => Controls_Manager::TEXT,
                'default' => 'Step title',
            ]
        );

        $repeater->add_control(
            'step_text',
            [
                'label' => __('Step Description', 'fv'),
                'type'  => Controls_Manager::TEXTAREA,
                'default' => 'Short description...',
            ]
        );

        $this->add_control(
            'steps',
            [
                'label' => __('Steps', 'fv'),
                'type'  => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'step_title' => 'Replenishment and picking',
                        'step_text'  => 'Temperate ocean-bass sea chub bass sea chub treefish eulachon tidewater goby.'
                    ],
                    [
                        'step_title' => 'Warehousing operation',
                        'step_text'  => 'Temperate ocean-bass sea chub bass sea chub treefish eulachon tidewater goby.'
                    ],
                    [
                        'step_title' => 'Transportation Processing',
                        'step_text'  => 'Temperate ocean-bass sea chub bass sea chub treefish eulachon tidewater goby.'
                    ],
                ],
                'title_field' => '{{{ step_title }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {

        $s = $this->get_settings_for_display();
?>

        <section class="py-140 bg-img position-relative overflow-hidden"
            data-background-image="<?php echo esc_url($s['bg_image']['url']); ?>"
            style="background:url('<?php echo esc_url($s['bg_image']['url']); ?>');">

            <?php if (!empty($s['plane_image']['url'])) : ?>
                <img src="<?php echo esc_url($s['plane_image']['url']); ?>" alt=""
                    class="plan-down position-absolute tw-start-0 top-0">
            <?php endif; ?>

            <?php if (!empty($s['line_image']['url'])) : ?>
                <img src="<?php echo esc_url($s['line_image']['url']); ?>" alt=""
                    class="cursor-small d-lg-block d-none position-absolute tw-end-0 top-50 tw--translate-y-50 tw-me-15">
            <?php endif; ?>

            <div class="container">
                <div class="max-w-840-px mx-auto text-center tw-mb-15">

                    <span class="splitTextStyleTwo cursor-small tw-text-xl fw-bold fst-italic text-decoration-underline text-main-600 tw-mb-305">
                        <?php echo esc_html($s['subtitle']); ?>
                    </span>

                    <h1 class="splitTextStyleOne cursor-big tw-mb-8">
                        <?= esc_html(substr(get_locale(), 0, 2) == "ar" ? $s['title_ar'] : $s['title']) ?>
                    </h1>

                </div>

                <div class="how-it-work-item-wrapper">
                    <div class="row gy-4">

                        <?php if (!empty($s['steps'])) : ?>
                            <?php foreach ($s['steps'] as $index => $step) : ?>

                                <div class="col-lg-4 col-sm-6 aos-init aos-animate"
                                    data-aos="fade-up"
                                    data-aos-duration="1000"
                                    data-aos-delay="<?php echo esc_attr(($index + 1) * 100); ?>">

                                    <div class="transport-card position-relative">
                                        <div class="how-it-work-item animation-item position-relative">

                                            <div class="half-bg-white z-1 position-relative">
                                                <span class="how-it-work-item__icon cursor-big bg-main-600 tw-w-114-px tw-h-114-px d-flex justify-content-center align-items-center rounded-circle tw-ms-10 tw-duration-300">
                                                    <?php if (!empty($step['step_icon']['url'])) : ?>
                                                        <img src="<?php echo esc_url($step['step_icon']['url']); ?>" alt="" class="animate__heartBeat">
                                                    <?php endif; ?>
                                                </span>
                                            </div>

                                            <div class="bg-white tw-px-10 tw-py-15 tw-pt-8 position-relative">
                                                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/shapes/curve-arrow-right.png'); ?>" alt="" class="position-absolute top-0 tw-end-0 tw-me-15 animate__wobble__two z-1">

                                                <h5 class="splitTextStyleTwo tw-mb-5 cursor-big max-w-200-px">
                                                    <?php echo esc_html($step['step_title']); ?>
                                                </h5>

                                                <p class="text-neutral-1000 cursor-small">
                                                    <?php echo esc_html($step['step_text']); ?>
                                                </p>
                                            </div>

                                        </div>
                                    </div>

                                </div>

                            <?php endforeach; ?>
                        <?php endif; ?>

                    </div>
                </div>

            </div>
        </section>

<?php
    }
}
?>