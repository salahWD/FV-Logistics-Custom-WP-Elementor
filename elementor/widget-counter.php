<?php
if (! defined('ABSPATH')) exit;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;


class Counter_Section_Widget extends Widget_Base
{

    public function get_name()
    {
        return 'counter_section_widget';
    }

    public function get_title()
    {
        return __('Counter Section', 'fv');
    }

    public function get_icon()
    {
        return 'eicon-counter';
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
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        // Small Title
        $this->add_control(
            'small_title',
            [
                'label' => __('Small Title', 'fv'),
                'type' => Controls_Manager::TEXT,
                'default' => 'Safe Transportation & Logistics',
                'label_block' => true,
            ]
        );

        // Main Title
        $this->add_control(
            'title_text',
            [
                'label' => __('Main Title', 'fv'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'We Provide Full Assistance in Freight & Warehousing',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'title_text_ar',
            [
                'label' => __('العنوان الرئيسي (بالعربي)', 'fv'),
                'type' => Controls_Manager::TEXT,
                'default' => 'نحن نقدم المساعدة الكاملة في الشحن والتخزين',
            ]
        );

        // Description
        $this->add_control(
            'description',
            [
                'label' => __('Description', 'fv'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Temperate ocean-bass sea chub unicorn fish treefish eulachon tidewater...',
                'label_block' => true,
            ]
        );

        // Left Image
        $this->add_control(
            'left_image',
            [
                'label' => __('Left Image', 'fv'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ]
            ]
        );

        // Background Image (Right Side)
        $this->add_control(
            'bg_image',
            [
                'label' => __('Right Background Image', 'fv'),
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

        <section class="counter d-lg-flex is-visible" style="visibility: visible;">

            <div class="w-100 lg-w-50 position-relative">
                <?php if (! empty($s['left_image']['url'])) : ?>
                    <img src="<?php echo esc_url($s['left_image']['url']); ?>" alt="" class="w-100 h-100 object-fit-cover">
                <?php endif; ?>
            </div>

            <div class="w-100 tw-ps-110-px lg-w-50 bg-img py-120 position-relative z-1 h-auto d-flex flex-column justify-content-center overflow-hidden"
                data-background-image="<?php echo esc_url($s['bg_image']['url']); ?>"
                style="background: url('<?php echo esc_url($s['bg_image']['url']); ?>');">

                <div class="max-w-632-px">
                    <div class="">

                        <?php if (! empty($s['small_title'])) : ?>
                            <span class="splitTextStyleTwo cursor-small tw-text-xl fw-bold fst-italic text-decoration-underline text-main-600 tw-mb-305">
                                <?php echo esc_html($s['small_title']); ?>
                            </span>
                        <?php endif; ?>


                        <h1 class="splitTextStyleOne cursor-big tw-mb-8">
                            <?= esc_html(substr(get_locale(), 0, 2) == "ar" ? $s['title_text_ar'] : $s['title_text']) ?>
                        </h1>

                        <?php if (! empty($s['description'])) : ?>
                            <p class="cursor-small text-neutral-900">
                                <?php echo esc_html($s['description']); ?>
                            </p>
                        <?php endif; ?>

                    </div>
                </div>

            </div>

        </section>

<?php
    }
}
?>