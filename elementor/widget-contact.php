<?php
if (!defined('ABSPATH')) exit;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

class Widget_Contact_Section extends Widget_Base
{

    public function get_name()
    {
        return 'contact_section_widget';
    }

    public function get_title()
    {
        return __('Contact Section', 'fv');
    }

    public function get_icon()
    {
        return 'eicon-form-horizontal';
    }

    public function get_categories()
    {
        return ['general'];
    }

    protected function register_controls()
    {

        /* ---------------------------
            LEFT CONTENT
        ----------------------------*/
        $this->start_controls_section(
            'left_section',
            [
                'label' => __('Left Column', 'fv'),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label' => __('Subtitle', 'fv'),
                'type'  => Controls_Manager::TEXT,
                'default' => 'Get In Touch',
            ]
        );

        $this->add_control(
            'title_text',
            [
                'label' => __('Title', 'fv'),
                'type'  => Controls_Manager::TEXTAREA,
                'default' => 'Contact Us',
            ]
        );

        $this->add_control(
            'title_text_ar',
            [
                'label' => __('العنوان الرئيسي (بالعربي)', 'fv'),
                'type' => Controls_Manager::TEXT,
                'default' => 'تواصل معنا',
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => __('Description', 'fv'),
                'type'  => Controls_Manager::TEXTAREA,
                'default' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.',
            ]
        );

        $this->end_controls_section();


        /* ---------------------------
            INFO BOXES
        ----------------------------*/
        $this->start_controls_section(
            'info_boxes',
            [
                'label' => __('Contact Info Items', 'fv'),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'icon_class',
            [
                'label' => __('Icon Class (Phosphor)', 'fv'),
                'type'  => Controls_Manager::TEXT,
                'default' => 'ph-bold ph-map-pin',
            ]
        );

        $repeater->add_control(
            'heading',
            [
                'label' => __('Heading', 'fv'),
                'type' => Controls_Manager::TEXT,
                'default' => 'Location',
            ]
        );

        $repeater->add_control(
            'content',
            [
                'label' => __('Content (HTML allowed)', 'fv'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => '55 Main street, 2nd block, Melbourne, Australia',
            ]
        );

        $this->add_control(
            'info_items',
            [
                'label'   => __('Items', 'fv'),
                'type'    => Controls_Manager::REPEATER,
                'fields'  => $repeater->get_controls(),
                'default' => [],
                'title_field' => '{{{ heading }}}'
            ]
        );

        $this->end_controls_section();


        /* ---------------------------
            SOCIAL LINKS
        ----------------------------*/
        $this->start_controls_section(
            'social_section',
            [
                'label' => __('Social Links', 'fv'),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );

        $social = new Repeater();

        $social->add_control(
            'social_icon',
            [
                'label' => __('Phosphor Icon Class', 'fv'),
                'type'  => Controls_Manager::TEXT,
                'default' => 'ph ph-facebook-logo',
            ]
        );

        $social->add_control(
            'social_link',
            [
                'label' => __('URL', 'fv'),
                'type' => Controls_Manager::URL,
                'placeholder' => 'https://',
            ]
        );

        $this->add_control(
            'social_items',
            [
                'label' => __('Social Icons', 'fv'),
                'type'  => Controls_Manager::REPEATER,
                'fields' => $social->get_controls(),
                'title_field' => '{{{ social_icon }}}',
            ]
        );

        $this->end_controls_section();


        /* ---------------------------
            FORM TEXT
        ----------------------------*/
        $this->start_controls_section(
            'form_section',
            [
                'label' => __('Form Settings', 'fv'),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );

        $this->add_control(
            'form_title',
            [
                'label' => __('Form Title', 'fv'),
                'type'  => Controls_Manager::TEXT,
                'default' => 'Fill Up The Form',
            ]
        );

        $this->add_control(
            'form_desc',
            [
                'label' => __('Form Description', 'fv'),
                'type'  => Controls_Manager::TEXTAREA,
                'default' => 'Your email address will not be published. Required fields are marked *',
            ]
        );

        $this->end_controls_section();
    }



    protected function render()
    {
        $s = $this->get_settings_for_display();
?>

        <section class="py-140">
            <div class="container">
                <div class="row gy-5">
                    <!-- LEFT COLUMN -->
                    <div class="col-lg-6">

                        <span class="splitTextStyleTwo cursor-small tw-text-xl fw-bold fst-italic text-decoration-underline text-main-600 tw-mb-305">
                            <?= esc_html($s['subtitle']) ?>
                        </span>

                        <h1 class="splitTextStyleOne cursor-big tw-mb-4">
                            <?= esc_html(substr(get_locale(), 0, 2) == "ar" ? $s['title_text_ar'] : $s['title_text']) ?>
                        </h1>

                        <p class="cursor-small text-neutral-900"><?= esc_html($s['description']) ?></p>


                        <!-- INFO GRID -->
                        <div class="xs-grid-cols-2 d-grid tw-mt-16 tw-gap-74-px">

                            <?php foreach ($s['info_items'] as $item): ?>
                                <div class="d-flex align-items-start tw-gap-6">
                                    <span class="tw-text-3xl text-main-600 d-flex cursor-small">
                                        <i class="<?= esc_attr($item['icon_class']); ?>"></i>
                                    </span>
                                    <div>
                                        <h6 class="tw-mb-4 cursor-big"><?= esc_html($item['heading']); ?></h6>
                                        <p class="text-neutral-1000 cursor-small"><?= wp_kses_post($item['content']); ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                            <!-- SOCIAL BLOCK -->
                            <div class="d-flex align-items-start tw-gap-6">
                                <span class="tw-text-3xl text-main-600 d-flex cursor-small">
                                    <i class="ph-bold ph-share-network"></i>
                                </span>

                                <div>
                                    <h6 class="tw-mb-4 cursor-big">Social</h6>

                                    <ul class="cursor-small d-flex align-items-center tw-gap-3 justify-content-center tw-mt-6">
                                        <?php foreach ($s['social_items'] as $social): ?>
                                            <li>
                                                <a href="<?= esc_url($social['social_link']['url'] ?? '#'); ?>"
                                                    class="tw-w-11 tw-h-11 border border-neutral-200 rounded-circle text-main-two-600 tw-text-xl d-flex justify-content-center align-items-center bg-white hover-bg-main-600 hover-text-white hover-border-main-600 active-scale-09 tw-duration-200">
                                                    <i class="<?= esc_attr($social['social_icon']); ?>"></i>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>

                        </div>

                    </div>


                    <!-- RIGHT FORM -->
                    <div class="col-lg-6">
                        <div class="bg-neutral-50 py-60 tw-px-54-px">

                            <h3 class="tw-mb-4 cursor-big"><?= esc_html($s['form_title']); ?></h3>
                            <p class="text-neutral-1000 cursor-small max-w-444-px"><?= esc_html($s['form_desc']); ?></p>

                            <!-- FORM NOTE: STATIC HTML (user will connect to CF7 or Elementor Pro) -->
                            <form class="tw-mt-70-px d-flex flex-column tw-gap-64-px">

                                <div class="position-relative">
                                    <input type="text" placeholder="Your Name*" required
                                        class="cursor-small focus-outline-0 bg-transparent border-0 tw-pb-5 tw-ps-9 w-100 border-bottom border-neutral-200 focus-border-main-600">
                                    <span class="tw-text-xl d-flex text-main-two-600 position-absolute top-0 tw-start-0">
                                        <i class="ph-bold ph-user"></i>
                                    </span>
                                </div>

                                <div class="position-relative">
                                    <input type="email" placeholder="Email Address*" required
                                        class="cursor-small focus-outline-0 bg-transparent border-0 tw-pb-5 tw-ps-9 w-100 border-bottom border-neutral-200 focus-border-main-600">
                                    <span class="tw-text-xl d-flex text-main-two-600 position-absolute top-0 tw-start-0">
                                        <i class="ph-bold ph-envelope"></i>
                                    </span>
                                </div>

                                <div class="position-relative">
                                    <textarea placeholder="Enter Your Message here"
                                        class="cursor-small focus-outline-0 bg-transparent border-0 tw-pb-5 tw-ps-9 w-100 border-bottom border-neutral-200 focus-border-main-600 tw-h-108-px"></textarea>
                                    <span class="tw-text-xl d-flex text-main-two-600 position-absolute top-0 tw-start-0">
                                        <i class="ph-bold ph-note-pencil"></i>
                                    </span>
                                </div>

                                <button type="submit"
                                    class="cursor-small btn btn-main hover-style-one button--stroke d-inline-flex align-items-center justify-content-center tw-gap-5 group active--translate-y-2 rounded-0">
                                    <span class="button__flair"></span>
                                    <span class="text-white tw-text-2xl group-hover-text-white tw-duration-500 position-relative">
                                        <i class="ph-bold ph-paper-plane-tilt"></i>
                                    </span>
                                    <span class="button__label">Get In Touch</span>
                                </button>

                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </section>

<?php
    }
}
?>