<?php

if (! defined('ABSPATH')) exit;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

class Widget_Brands extends Widget_Base
{

    public function get_name()
    {
        return 'brand_three';
    }

    public function get_title()
    {
        return __('Brand Three Slider', 'fv');
    }

    public function get_icon()
    {
        return 'eicon-carousel';
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

        $this->start_controls_section(
            'brand_items_section',
            [
                'label' => __('Brand Logos', 'fv'),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'brand_logo',
            [
                'label' => __('Logo Image', 'fv'),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'brand_items',
            [
                'label' => __('Logos', 'fv'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [],
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
        $items = $s['brand_items'] ?? [];
?>

        <div class="brand-three-slider-wrapper tw-mt-13">
            <div class="container">
                <div class="brand-three-slider swiper swiper-initialized swiper-horizontal swiper-backface-hidden">
                    <div class="swiper-wrapper align-items-center"
                        style="cursor: grab; transition-duration: 1500ms; transform: translate3d(-259.2px, 0px, 0px);"
                        id="swiper-wrapper-a5660ef10da34bf75" aria-live="off">
                        <?php
                        $delay = 100;
                        foreach ($items as $i => $item):
                            $img = $item['brand_logo']['url'] ?? '';
                            if (empty($img)) continue;
                        ?>
                            <div class="swiper-slide me-0 aos-init swiper-slide-prev" data-aos="fade-up"
                                data-aos-duration="1000" data-aos-delay="<?php echo esc_attr($delay); ?>" role="group"
                                aria-label="1 / 6" data-swiper-slide-index="0">
                                <div class="text-center cursor-big">
                                    <img src="<?php echo esc_url($img); ?>" alt="" class="max-w-175-px">
                                </div>
                            </div>

                        <?php
                            $delay += 100;
                        endforeach;
                        ?>
                    </div>
                    <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                </div>
            </div>
        </div>


<?php
    }
}
