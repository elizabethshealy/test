<?php

get_header(); ?>
    <div class="container">
        <div class="row">
            <?php while (have_posts()) : the_post(); ?>

                <?php get_template_part('content', 'single'); ?>


            <?php endwhile; // end of the loop. ?>
        </div>
    </div>
<?php get_footer(); ?>