<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package _tk
 */
?>

<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4"><p><?php the_field('footer_title', 'option'); ?></p></div>

            <div class="col-lg-4"></div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <ul class="list-inline">
                    <li class="col-sm-8"><a id="ednc_title"><?php the_field('footer_menu_title', 'option'); ?></a>
                        <?php wp_nav_menu(
                            array(
                                'theme_location' => 'secondary',
//                        'container_class' => 'footer-menu',
                                'fallback_cb' => 'wp_bootstrap_navwalker::fallback',
                                'depth' => 2,
                                'walker' => new wp_bootstrap_navwalker(),
                                'menu' => '',
                                'container' => 'div',
                                'container_id' => '',
                                'menu_class' => 'footer-menu',
                                'menu_id' => '',
                            )
                        ); ?>
                    </li>
                </ul>
            </div>


            <div class="col-md-4">
                <?php if (have_rows('footer_social_links', 'option')): ?>

                    <ul class="list-inline social-buttons">
                        <?php while (have_rows('footer_social_links', 'option')): the_row(); ?>
                            <li class="list-inline-item">
                                <a href="<?php the_sub_field('social_href', 'option'); ?>" target="_blank">
                                    <i class="fa <?php the_sub_field('social_icon', 'option'); ?>"></i>
                                </a>
                            </li>
                        <?php endwhile; ?>
                    </ul>

                <?php endif; ?>

            </div>

            <?php
            if (is_active_sidebar('footer-sidebar-3')) {
                dynamic_sidebar('footer-sidebar-3');
            }
            ?>
        </div>
    </div>
</footer>


<?php wp_footer(); ?>

</body>
</html>
