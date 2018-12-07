<?php /* Template Name: Share Your Voice */ ?>
<?php get_header(); ?>
    <div id="container" class="right_container">
        <div id="content" class="content" role="main">
            <h1 class="page-title"><?php the_title()?></h1>


            <?php $acsessuar = new WP_Query(array('post_type' => 'share_your_voice', 'posts_per_page' => 5)); ?>

            <?php while ($acsessuar->have_posts()) : $acsessuar->the_post(); ?>

                <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <?php if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail())) : ?>
                        <a class="post_thumbnail" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"
                           alt=""><?php the_post_thumbnail(array(234, 124)); ?></a>
                    <?php endif; ?>
                    <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
                </div><!-- post -->
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>

            <!-- Заканчивается петля -->
        </div><!-- #content -->
    </div><!-- #container -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>