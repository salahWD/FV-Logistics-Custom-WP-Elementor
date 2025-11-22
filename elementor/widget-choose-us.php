<?php
if (!defined('ABSPATH')) exit;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

class Widget_ChooseUs extends Widget_Base
{

    public function get_name()
    {
        return 'chooseus_five';
    }

    public function get_title()
    {
        return __('Choose Us Five', 'fv');
    }

    public function get_icon()
    {
        return 'eicon-star';
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
            ['label' => __('Header', 'fv')]
        );

        $this->add_control(
            'bg_image',
            [
                'label' => __('Background Image', 'fv'),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label' => __('Subtitle', 'fv'),
                'type' => Controls_Manager::TEXT,
                'default' => 'Why Choose Us'
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __('Main Title (supports HTML)', 'fv'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Why Choose For Us'
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => __('Description', 'fv'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Dramatically enhance interactive metrics for reliable services.'
            ]
        );

        $this->end_controls_section();



        /* -------- LEFT FEATURES -------- */
        $this->start_controls_section(
            'left_features_section',
            ['label' => __('Left Features', 'fv')]
        );

        $left = new Repeater();

        $left->add_control(
            'icon',
            [
                'label' => __('Icon Image', 'fv'),
                'type' => Controls_Manager::MEDIA
            ]
        );

        $left->add_control(
            'title',
            [
                'label' => __('Title', 'fv'),
                'type' => Controls_Manager::TEXT,
                'default' => 'Fast Transportation Service'
            ]
        );

        $left->add_control(
            'desc',
            [
                'label' => __('Description', 'fv'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Enhance interactive metrics for reliable services.'
            ]
        );

        $this->add_control(
            'left_features',
            [
                'label' => __('Left Items', 'fv'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $left->get_controls(),
            ]
        );

        $this->end_controls_section();



        /* -------- CENTER IMAGE -------- */
        $this->start_controls_section(
            'center_image_section',
            ['label' => __('Center Image', 'fv')]
        );

        $this->add_control(
            'center_image',
            [
                'label' => __('Image', 'fv'),
                'type' => Controls_Manager::MEDIA
            ]
        );

        $this->end_controls_section();



        /* -------- RIGHT FEATURES -------- */
        $this->start_controls_section(
            'right_features_section',
            ['label' => __('Right Features', 'fv')]
        );

        $right = new Repeater();

        $right->add_control(
            'icon',
            [
                'label' => __('Icon Image', 'fv'),
                'type' => Controls_Manager::MEDIA
            ]
        );

        $right->add_control(
            'title',
            [
                'label' => __('Title', 'fv'),
                'type' => Controls_Manager::TEXT,
                'default' => '24/7 Online Support'
            ]
        );

        $right->add_control(
            'desc',
            [
                'label' => __('Description', 'fv'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Enhance interactive metrics for reliable services.'
            ]
        );

        $this->add_control(
            'right_features',
            [
                'label' => __('Right Items', 'fv'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $right->get_controls(),
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

        $bg = $s['bg_image']['url'] ?? '';
        $subtitle = $s['subtitle'];
        $title = $s['title'];
        $description = $s['description'];

        $left_items = $s['left_features'] ?? [];
        $right_items = $s['right_features'] ?? [];
        $center_img = $s['center_image']['url'] ?? '';

?>
        <div class="pt-120 tw-pb-165-px bg-img"
            data-background-image="<?php echo esc_url($bg); ?>"
            style="background:url('<?php echo esc_url($bg); ?>');">

            <div class="container">

                <div class="row justify-content-center">
                    <div class="col-xl-7">
                        <div class="tw-mb-80-px text-center aos-init"
                            data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">

                            <span class="splitTextStyleTwo cursor-small tw-text-xl fw-bold fst-italic text-decoration-underline text-main-600 tw-mb-305">
                                <?php echo esc_html($subtitle); ?>
                            </span>

                            <h2 class="tw-text-60-px splitTextStyleOne cursor-big tw-mb-4 text-white">
                                <?php echo wp_kses_post($title); ?>
                            </h2>

                            <p class="cursor-small tw-ps-205 font-weight-bold text-white">
                                <?php echo wp_kses_post(nl2br($description)); ?>
                            </p>

                        </div>
                    </div>
                </div>


                <div class="row align-items-end">

                    <div class="col-xl-1 col-lg-1 col-md-1"></div>

                    <!-- LEFT COLUMN -->
                    <div class="col-xl-4 col-lg-4 col-md-4">
                        <div data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100" class="aos-init">

                            <?php foreach ($left_items as $item):
                                $icon = $item['icon']['url'] ?? '';
                            ?>
                                <div class="chooseus-five-wrap d-flex tw-gap-5 tw-mb-7">
                                    <div class="feature-four-icon chooseus-five-icon position-relative z-1 tw-mb-3">
                                        <span class="cursor-big bg-main-600 tw-w-50-px tw-h-50-px d-flex justify-content-center align-items-center rounded-circle tw-duration-300 bg-main-two-60">
                                            <?php if ($icon): ?>
                                                <img src="<?php echo esc_url($icon); ?>" alt="icon">
                                            <?php endif; ?>
                                        </span>
                                    </div>
                                    <div>
                                        <h6 class="text-white tw-mb-3">
                                            <?php echo esc_html($item['title']); ?>
                                        </h6>
                                        <p class="text-neutral-1000">
                                            <?php echo esc_html($item['desc']); ?>
                                        </p>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                        </div>
                    </div>

                    <div class="col-xl-2 col-lg-2 col-md-2"></div>

                    <!-- RIGHT COLUMN -->
                    <div class="col-xl-4 col-lg-4 col-md-4">
                        <div data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300" class="aos-init">

                            <?php foreach ($right_items as $item):
                                $icon = $item['icon']['url'] ?? '';
                            ?>
                                <div class="chooseus-five-wrap d-flex tw-gap-5 tw-mb-7">
                                    <div class="feature-four-icon chooseus-five-icon position-relative z-1 tw-mb-3">
                                        <span class="cursor-big bg-main-600 tw-w-50-px tw-h-50-px d-flex justify-content-center align-items-center rounded-circle tw-duration-300 bg-main-two-60">
                                            <?php if ($icon): ?>
                                                <img src="<?php echo esc_url($icon); ?>" alt="icon">
                                            <?php endif; ?>
                                        </span>
                                    </div>
                                    <div>
                                        <h6 class="text-white tw-mb-3">
                                            <?php echo esc_html($item['title']); ?>
                                        </h6>
                                        <p class="text-neutral-1000">
                                            <?php echo esc_html($item['desc']); ?>
                                        </p>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                        </div>
                    </div>

                    <div class="col-xl-1 col-lg-1 col-md-1"></div>

                </div>

            </div>
        </div>

<?php
    }
}
?>