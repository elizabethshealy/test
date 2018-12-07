<?php
/* Template Name: Blog */

get_header(); ?>
<div class="blog-posts">
    <?php $blog_page_background = get_field('blog_page_background', 'option');
    if (!empty($blog_page_background)): ?>
        <div class="space-header" style="background-image:url('<?php echo $blog_page_background; ?>');"></div>
    <?php endif; ?>

    <?php // Display blog posts on any page @ http://m0n.co/l
    $temp = $wp_query;
    $wp_query = null;
    $wp_query = new WP_Query();
    $wp_query->query('showposts=5' . '&paged=' . $paged);
    while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-9 content-padder">
                    <article>
                        <div class="entry-content">
                            <div class="image-block"
                                 style="background-image:url('<?php echo get_the_post_thumbnail_url() ?>');">
                            </div>
                            <div class="content-block" id="my-content">
                                <div class="content">

                                    <h1 class="page-title">
                                        <a href="<?php the_permalink(); ?>" rel="bookmark">
                                            <?php the_title(); ?>
                                        </a>
                                    </h1>
                                    <p class="short-description"><?php echo get_the_content(); ?></p>
                                    <div class="button">
                                        <a href="<?php the_permalink(); ?>">Read More</a>
                                    </div>
                                </div>

                                <?php _tk_link_pages(); ?>
                            </div>


                        </div>
                    </article>
                </div>
            </div>
        </div>

    <?php endwhile; ?>

    <?php if ($paged > 1) { ?>

        <nav id="nav-posts">
            <div class="prev"><?php next_posts_link('&laquo; Previous Posts'); ?></div>
            <div class="next"><?php previous_posts_link('Newer Posts &raquo;'); ?></div>
        </nav>

    <?php } else { ?>

        <nav id="nav-posts">
            <div class="prev"><?php next_posts_link('&laquo; Previous Posts'); ?></div>
        </nav>

    <?php } ?>

    <?php wp_reset_postdata(); ?>


</div>


<?php get_footer(); ?>
