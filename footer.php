<?php

if (is_front_page()) {
    $footer_title = 'footer';
} else {
    $footer_title = 'footer';
}

$footer_query = new WP_Query(array(
    'post_type' => 'footer',
    'posts_per_page' => 1, // Adjust the number of posts to display as needed
    'post_title'     => $footer_title,
));

if ($footer_query->have_posts()) {
    while ($footer_query->have_posts()) : $footer_query->the_post();
        the_content();
    endwhile;
    wp_reset_postdata();
}
?>

</div><!-- content div -->
</div><!-- main-wrapper div -->

<!-- Jquery js -->
<script src="<?php echo THEME_URL; ?>/assets/js/jquery-3.7.1.min.js"></script>
<!-- phosphor Js -->
<script src="<?php echo THEME_URL; ?>/assets/js/phosphor-icon.js"></script>
<!-- Bootstrap Bundle Js -->
<script src="<?php echo THEME_URL; ?>/assets/js/boostrap.bundle.min.js"></script>
<!-- swiper slider Js -->
<script src="<?php echo THEME_URL; ?>/assets/js/swiper-bundle.min.js"></script>
<!-- Split Text -->
<script src="<?php echo THEME_URL; ?>/assets/js/SplitText.min.js"></script>
<!-- Scroll Trigger -->
<script src="<?php echo THEME_URL; ?>/assets/js/ScrollTrigger.min.js"></script>
<!-- Gsap js -->
<script src="<?php echo THEME_URL; ?>/assets/js/gsap.min.js"></script>
<!-- custom gsap -->
<script src="<?php echo THEME_URL; ?>/assets/js/custom-gsap.js"></script>
<!-- aos -->
<!-- <script src="<?php echo THEME_URL; ?>/assets/js/aos.js"></script> -->
<!-- Circle Progress bar -->
<script src="<?php echo THEME_URL; ?>/assets/js/animated-radial-progress.js"></script>
<!-- counter up -->
<script src="<?php echo THEME_URL; ?>/assets/js/counterup.min.js"></script>
<!-- magnific popup -->
<script src="<?php echo THEME_URL; ?>/assets/js/magnific-popup.min.js"></script>
<!-- marquee -->
<script src="<?php echo THEME_URL; ?>/assets/js/jquery.marquee.min.js"></script>

<!-- main js -->
<script src="<?php echo THEME_URL; ?>/assets/js/main.js"></script>

</body>

</html>


<?php

wp_footer();
