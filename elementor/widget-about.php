<?php
if (!defined('ABSPATH')) exit;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

class Widget_About_Us extends Widget_Base
{

    public function get_name()
    {
        return 'about_us_section';
    }

    public function get_title()
    {
        return __('About Us Section', 'fv');
    }

    public function get_icon()
    {
        return 'eicon-person';
    }

    public function get_categories()
    {
        return ['general'];
    }


    /* ----------------------------------------------------
        Controls
    ---------------------------------------------------- */
    protected function register_controls()
    {

        $this->start_controls_section(
            'about_content',
            ['label' => __('About Section Content', 'fv')]
        );

        $this->add_control(
            'plane_image',
            [
                'label' => __('Plane Decorative Image', 'fv'),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'about_main_image',
            [
                'label' => __('Main About Image', 'fv'),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label' => __('Subtitle', 'fv'),
                'type' => Controls_Manager::TEXT,
                'default' => 'Safe Transportation & Logistics'
            ]
        );

        $this->add_control(
            'title_text',
            [
                'label' => __('Title Text (Auto Letter Split)', 'fv'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Modern transport system & secure packaging'
            ]
        );

        $this->add_control(
            'title_text_ar',
            [
                'label' => __('العنوان الرئيسي (بالعربي)', 'fv'),
                'type' => Controls_Manager::TEXT,
                'default' => 'نظام النقل الحديث والتغليف الآمن',
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => __('Description', 'fv'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Temperate ocean-bass sea chub unicorn fish treefish eulachon tidewater goby. Flier, bighe carp Devario shortnose sucker platy smalleye'
            ]
        );


        $right = new Repeater();

        $right->add_control(
            'title',
            [
                'label' => __('Title', 'fv'),
                'type' => Controls_Manager::TEXT,
                'default' => '24/7 Online Support'
            ]
        );

        $this->add_control(
            'right_features',
            [
                'label' => __('Right Features', 'fv'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $right->get_controls(),
                "default" => [
                    ["title" => "Awards Winning IT Solutions Company"],
                    ["title" => "We approached WiaTech with complex project deliver"],
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'about_CTA',
            ['label' => __('CTA Button', 'fv')]
        );

        $this->add_control(
            'cta_text',
            [
                'label' => __('Label', 'fv'),
                'type' => Controls_Manager::TEXT,
                'default' => 'Contact Us'
            ]
        );

        $this->add_control(
            'cta_link',
            [
                'label' => __('CTA Link', 'fv'),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        $this->end_controls_section();
    }


    /* ----------------------------------------------------
        Render
    ---------------------------------------------------- */
    protected function render()
    {
        $s = $this->get_settings_for_display();

        $plane_image = $s['plane_image']['url'] ?? '';
        $about_main_image = $s['about_main_image']['url'] ?? '';

        $subtitle = $s['subtitle'];
        $description = $s['description'];

        $right_items = $s['right_features'] ?? [];
?>
        <section class="about py-140 position-relative max-lg-overflow-hidden">

            <?php if ($plane_image): ?>
                <img src="<?php echo esc_url($plane_image); ?>" alt="" class="cursor-big about-plane position-absolute tw-start-0 top-50" style="translate: none; rotate: none; scale: none; transform: translate(-260px);">
            <?php endif; ?>

            <div class="container">
                <div class="row gy-5 flex-wrap-reverse">

                    <!-- LEFT IMAGE -->
                    <div class="col-lg-5 pe-xl-5">
                        <div class="position-relative tw-pb-11 h-100">
                            <div class="position-relative aos-init" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="200">
                                <?php if ($about_main_image): ?>
                                    <img src="<?php echo esc_url($about_main_image); ?>" alt="" class="w-100 h-100 object-fit-cover">
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- RIGHT TEXT CONTENT -->
                    <div class="col-lg-7 ps-lg-5">
                        <div class="">
                            <span class="splitTextStyleTwo cursor-small tw-text-xl fw-bold fst-italic text-decoration-underline text-main-600 tw-mb-305">
                                <?php echo esc_html($subtitle); ?>
                            </span>

                            <h1 class="splitTextStyleOne cursor-big tw-mb-8">
                                <?= esc_html(substr(get_locale(), 0, 2) == "ar" ? $s['title_text_ar'] : $s['title_text']) ?>
                            </h1>

                            <p class="cursor-small text-neutral-900 tw-ps-205 border-start border-main-600 border-2">
                                <?php echo esc_html($description); ?>
                            </p>
                            <span class="tw-my-7 border-bottom border-neutral-100 d-block"></span>

                            <?php if (count($right_items) > 0): ?>
                                <ul class="cursor-small d-flex flex-column tw-gap-2">
                                    <?php foreach ($right_items as $item): ?>
                                        <li class="d-flex align-items-center tw-gap-4 aos-init aos-animate" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                                            <span class="text-main-600 d-flex"><i class="ph-bold ph-check"></i></span>
                                            <span class="text-neutral-1000 fw-medium"><?= $item["title"] ?></span>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>

                            <?php if (isset($s["cta_text"]) && !empty($s["cta_text"])): ?>
                                <div class="d-flex align-items-center tw-gap-56-px tw-mt-10 flex-wrap">
                                    <a href="<?= esc_url($s["cta_link"]["url"]); ?>" class="cursor-small btn btn-main-two hover-style-three button--stroke d-inline-flex align-items-center justify-content-center tw-gap-5 group rounded-0 aos-init" data-block="button" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                                        <span class="button__flair" style="translate: none; rotate: none; scale: none; transform: translate(55.0119%, -20%) scale(0);"></span>
                                        <span class="button__label"><?= esc_html($s["cta_text"]); ?></span>
                                        <span class="tw-w-7 tw-h-7 bg-white text-main-600 tw-text-sm tw-rounded d-flex justify-content-center align-items-center position-relative tw-duration-500">
                                            <i class="ph-bold ph-check"></i>
                                        </span>
                                    </a>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>

                </div>
            </div>
        </section>

<?php
    }
}
?>